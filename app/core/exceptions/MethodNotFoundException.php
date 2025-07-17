<?php

namespace App\Core\Exceptions;

class MethodNotFoundException extends BaseException
{
    protected $httpStatusCode = 500;
    
    public function __construct(string $method = "", string $controller = "", int $code = 0, \Throwable $previous = null)
    {
        $message = "Method '{$method}' not found in controller '{$controller}'";
        parent::__construct($message, $code, $previous);
    }
}