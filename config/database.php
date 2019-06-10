<?php

return [
  //Default Database Connection Name --> Specify the database connection.
  'default' => env('DB_CONNECTION'),

  //Database Connections --> Database connections setup for your application.
  //All database work in Laravel is done through the PHP PDO facilities
  'connections' => [
    'sqlite' => [
      'driver'      => 'sqlite',
      'database'    => env('DB_DATABASE', database_path('database.sqlite')),
      'prefix'      => '',
    ],
    'mysql'  => [
      'driver'      => 'mysql',
      'host'        => env('DB_HOST'),
      'port'        => env('DB_PORT'),
      'database'    => env('DB_DATABASE'),
      'username'    => env('DB_USERNAME'),
      'password'    => env('DB_PASSWORD'),
      'unix_socket' => env('DB_SOCKET', ''),
      'charset'     => 'utf8mb4',
      'collation'   => 'utf8mb4_unicode_ci',
      'prefix'      => '',
      'strict'      => true,
      'engine'      => null,
    ],
  ],

  //Migration Repository Table --> Table that keeps track of all the migrations that have already run.
  'migrations' => 'migrations',

  //Redis Databases
  'redis' => [
    'client'  => 'predis',
    'default' => [
      'host'     => env('REDIS_HOST', '127.0.0.1'),
      'password' => env('REDIS_PASSWORD', null),
      'port'     => env('REDIS_PORT', 6379),
      'database' => 0,
    ],
  ],
];
