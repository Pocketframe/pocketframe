<?php
require BASE_PATH . '/vendor/pocketframe/framework/src/functions.php';

return [
  'database' => [
    'host'           => env('DB_HOST', 'localhost'),
    'port'           => env('DB_PORT', '3306'),
    'dbname'       => env('DB_DATABASE'),
    'username'       => env('DB_USERNAME'),
    'password'       => env('DB_PASSWORD'),
    'charset'        => 'utf8mb4',
    'collation'      => 'utf8mb4_unicode_ci',
    'prefix'         => '',
    'prefix_indexes' => true,
    'strict'         => true,
    'engine'         => 'InnoDB',
  ],
];
