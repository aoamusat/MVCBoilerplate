<?php

namespace App\Core\Middleware;

use App\Core\Interfaces\MiddlewareInterface;
use App\Core\Request;
use App\Core\Exceptions\BaseException;

class ThrottleException extends BaseException
{
    protected $httpStatusCode = 429;
    
    public function __construct(string $message = "Request throttled", int $code = 429, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

class ThrottleMiddleware implements MiddlewareInterface
{
    private $minInterval;
    private $storage;

    public function __construct(int $minIntervalSeconds = 1)
    {
        $this->minInterval = $minIntervalSeconds;
        $this->storage = [];
    }

    public function handle(Request $request, \Closure $next)
    {
        $clientId = $this->getClientId($request);
        $currentTime = time();
        
        if (isset($this->storage[$clientId])) {
            $lastRequestTime = $this->storage[$clientId];
            $timeSinceLastRequest = $currentTime - $lastRequestTime;
            
            if ($timeSinceLastRequest < $this->minInterval) {
                $waitTime = $this->minInterval - $timeSinceLastRequest;
                
                $this->setHeaders([
                    'Retry-After' => $waitTime
                ], 429);
                
                throw new ThrottleException("Request throttled. Please wait {$waitTime} seconds before making another request.");
            }
        }

        $this->storage[$clientId] = $currentTime;
        
        return $next($request);
    }

    private function getClientId(Request $request): string
    {
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
        return md5($ip . $userAgent);
    }

    protected function setHeaders(array $headers, int $statusCode = null): void
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