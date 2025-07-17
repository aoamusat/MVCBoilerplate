<?php

namespace App\Core\Middleware;

use App\Core\Interfaces\MiddlewareInterface;
use App\Core\Request;
use App\Core\Exceptions\BaseException;

class RateLimitException extends BaseException
{
    protected $httpStatusCode = 429;
    
    public function __construct(string $message = "Too Many Requests", int $code = 429, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

class RateLimitMiddleware implements MiddlewareInterface
{
    private $maxRequests;
    private $windowSeconds;
    private $storage;

    public function __construct(int $maxRequests = 100, int $windowSeconds = 60)
    {
        $this->maxRequests = $maxRequests;
        $this->windowSeconds = $windowSeconds;
        $this->storage = [];
    }

    public function handle(Request $request, \Closure $next)
    {
        $clientId = $this->getClientId($request);
        $currentTime = time();
        
        if (!isset($this->storage[$clientId])) {
            $this->storage[$clientId] = [
                'count' => 1,
                'reset_time' => $currentTime + $this->windowSeconds
            ];
        } else {
            $clientData = $this->storage[$clientId];
            
            if ($currentTime > $clientData['reset_time']) {
                $this->storage[$clientId] = [
                    'count' => 1,
                    'reset_time' => $currentTime + $this->windowSeconds
                ];
            } else {
                $this->storage[$clientId]['count']++;
                
                if ($this->storage[$clientId]['count'] > $this->maxRequests) {
                    $resetTime = $clientData['reset_time'];
                    $retryAfter = $resetTime - $currentTime;
                    
                    $this->setHeaders([
                        'Retry-After' => $retryAfter,
                        'X-RateLimit-Limit' => $this->maxRequests,
                        'X-RateLimit-Remaining' => 0,
                        'X-RateLimit-Reset' => $resetTime
                    ], 429);
                    
                    throw new RateLimitException("Rate limit exceeded. Try again in {$retryAfter} seconds.");
                }
            }
        }

        $remaining = $this->maxRequests - $this->storage[$clientId]['count'];
        $this->setHeaders([
            'X-RateLimit-Limit' => $this->maxRequests,
            'X-RateLimit-Remaining' => $remaining,
            'X-RateLimit-Reset' => $this->storage[$clientId]['reset_time']
        ]);

        return $next($request);
    }

    private function getClientId(Request $request): string
    {
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
        return md5($ip . $userAgent);
    }

    protected function setHeaders(array $headers, ?int $statusCode = null): void
    {
        if (!headers_sent()) {
            if ($statusCode) {
                http_response_code($statusCode);
            }
            foreach ($headers as $name => $value) {
                header("{$name}: {$value}");
            }
        }
    }
}