<?php

require_once __DIR__ . '/../vendor/autoload.php';

// Set up test environment
$_ENV['APP_ENV'] = 'testing';

// Mock global functions that might be needed in tests
if (!function_exists('header')) {
    function header($string, $replace = true, $response_code = null) {
        // Mock header function for testing
        return true;
    }
}

if (!function_exists('http_response_code')) {
    function http_response_code($response_code = null) {
        // Mock http_response_code function for testing
        return 200;
    }
}

if (!function_exists('headers_sent')) {
    function headers_sent() {
        // Mock headers_sent function for testing
        return false;
    }
}

if (!function_exists('header_remove')) {
    function header_remove($name = null) {
        // Mock header_remove function for testing
        return true;
    }
}