<?php

namespace App\Core\Exceptions;

use Exception;

abstract class BaseException extends Exception
{
    protected $httpStatusCode = 500;
    
    public function getHttpStatusCode(): int
    {
        return $this->httpStatusCode;
    }
    
    public function toArray(): array
    {
        return [
            'error' => true,
            'message' => $this->getMessage(),
            'code' => $this->getCode(),
            'file' => $this->getFile(),
            'line' => $this->getLine()
        ];
    }
}