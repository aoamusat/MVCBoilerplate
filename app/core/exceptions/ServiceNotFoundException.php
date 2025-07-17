<?php

namespace App\Core\Exceptions;

class ServiceNotFoundException extends BaseException
{
    protected $httpStatusCode = 500;
    
    public function __construct(string $service = "", int $code = 0, \Throwable $previous = null)
    {
        $message = "Service '{$service}' not found in the DI Container";
        parent::__construct($message, $code, $previous);
    }
}