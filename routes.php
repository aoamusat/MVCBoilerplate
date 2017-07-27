<?php
	
	/*
	|--------------------------------------------------------------------------
	| Web Routes
	|--------------------------------------------------------------------------
	|
	| Here is where you can register web routes for your application. These
	| routes are loaded by the Router class 
	|
	*/

	$router->get('', 'PagesController@home');
	$router->get('about', 'PagesController@about');
	$router->get('contact', 'PagesController@contact');
	$router->get('users', 'UsersController@index');
	$router->post('users', 'UsersController@store');