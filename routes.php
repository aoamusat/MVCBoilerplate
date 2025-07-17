<?php

use App\Core\Router;
use App\Core\Middleware\RateLimitMiddleware;
use App\Core\Middleware\ThrottleMiddleware;

$router = new Router();

// Add global middlewares
$router->middleware(new RateLimitMiddleware(100, 60))  // 100 requests per minute
       ->middleware(new ThrottleMiddleware(1));         // 1 second between requests

$router->get('', 'PagesController@home');
$router->get('about', 'PagesController@about');
$router->get('contact', 'PagesController@contact');
$router->get('users', 'UserController@index');
$router->post('users', 'UserController@store');