<?php

use App\Core\Router;

$router = new Router();

$router->get('', 'PageController@home');
$router->get('about', 'PageController@about');
$router->get('contact', 'PageController@contact');
$router->get('users', 'UserController@index');
$router->post('users', 'UserController@store');