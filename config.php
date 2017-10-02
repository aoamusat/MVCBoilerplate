<?php
	/*
	|--------------------------------------------------------------------------------------
	| Database Configuration
	|--------------------------------------------------------------------------------------
	|
	| Here you can configure your application database and its settings.
	|
	| 'name'        => 	string 		The name of the database.
	| 'host'        => 	string 		The database host.
	| 'username'	=> 	string 		The database username.
	| 'password'    => 	string 		The database password.
	| 'options '	=> 	array 		An array of extra attributes on the database handle.
	|                         		Refer to http://php.net/manual/en/pdo.setattribute.php.
	|
	*/
	return [
		'database' => [
			'name' => 'php_learning',
			'host' => 'localhost',
			'username' => 'root',
			'password' => '',
			'options' => [
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
			]
		]
	];