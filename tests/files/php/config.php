<?php

return [
    'driver' => 'mysql',
    'drivers' => [
        'sqlite' => [
            'database' => 'database.sqlite',
            'prefix' => '',
        ],
        'mysql' => [
            'host' => 'localhost',
            'database' => 'blog',
            'username' => 'blogger',
            'password' => 'hunter2',
            'charset' => 'utf8',
            'prefix' => '',
        ],
        'pgsql' => [
            'host' => 'localhost',
            'database' => 'blog',
            'username' => 'blogger',
            'password' => 'hunter2',
            'charset' => 'utf8',
            'prefix' => '',
        ],
    ],
];
