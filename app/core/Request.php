<?php

namespace App\Core;

/**
 * Class Request
 *
 * Represents an HTTP request and provides methods to retrieve information about the request.
 */
class Request
{
    /**
     * Get the URI of the request.
     *
     * @return string The URI of the request.
     */
    public static function uri()
    {
        $uri = trim(
            parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH),
            '/'
        );
        return $uri;
    }

    /**
     * Get the request method.
     *
     * @return string The request method (e.g., GET, POST).
     */
    public static function method()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        return $method;
    }
}
