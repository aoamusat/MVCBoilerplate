<?php
	
	require 'vendor/autoload.php';
	require 'app/core/bootstrap.php';

	Router::load('routes.php')->direct(Request::uri(), Request::method());