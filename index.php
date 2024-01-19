<?php

use App\Core\Request;
use App\Core\Router;

require 'vendor/autoload.php';
// require 'app/core/bootstrap.php';

$router = Router::load('routes.php')->direct(Request::uri(), Request::method());