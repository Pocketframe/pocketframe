<?php

/**
 * Database configuration file
 *
 * This file contains the database connection settings for the application.
 * It uses environment variables to set the connection parameters.
 *
 * @package Pocketframe
 */
return [
  'database' => [
    'driver'         => env('DB_CONNECTION', 'sqlite'),
    'host'           => env('DB_HOST', 'localhost'),
    'port'           => env('DB_PORT', '3306'),
    'database'       => env('DB_DATABASE', 'pocketframe'),
    'username'       => env('DB_USERNAME', 'root'),
    'password'       => env('DB_PASSWORD', ''),
    'charset'        => 'utf8mb4',
    'collation'      => 'utf8mb4_unicode_ci',
    'prefix'         => '',
    'prefix_indexes' => true,
    'strict'         => true,
    'engine'         => 'InnoDB',
  ],
];
