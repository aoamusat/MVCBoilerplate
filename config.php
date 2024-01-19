<?php

return [
    'database' => [
        'name' => 'dbname',
        'host' => 'localhost',
        'username' => 'root',
        'password' => '',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ],
    "redis" => [
        "host" => 'localhost',
        "port" => 6379,
    ]
];
