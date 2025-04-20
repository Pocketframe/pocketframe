<?php

/**
 * Application configuration file
 * This file contains the configuration settings for the application.
 * It uses environment variables to set the configuration parameters.
 * @package Pocketframe
 */
return [
  'timezone' => date_default_timezone_set("Africa/Kampala"),

  'app_name' => env('APP_NAME', 'Pocketframe'),

  'app_key' => env('APP_KEY', 'your-secret-key'),
  'env'     => env('APP_ENV', 'production'),
  'debug'   => env('APP_DEBUG', false),
  'url'     => env('APP_URL', 'http://localhost'),

];
