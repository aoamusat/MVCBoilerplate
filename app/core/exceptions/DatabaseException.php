<?php

namespace App\Core\Exceptions;

class DatabaseException extends BaseException
{
    protected $httpStatusCode = 500;
    
    public function __construct(string $message = "Database error occurred", int $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}