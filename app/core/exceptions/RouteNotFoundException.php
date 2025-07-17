<?php

namespace App\Core\Exceptions;

class RouteNotFoundException extends BaseException
{
    protected $httpStatusCode = 404;
    
    public function __construct(string $uri = "", int $code = 0, \Throwable $previous = null)
    {
        $message = "Route not found: " . $uri;
        parent::__construct($message, $code, $previous);
    }
}