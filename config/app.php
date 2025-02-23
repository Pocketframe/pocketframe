<?php

require BASE_PATH . '/vendor/pocketframe/framework/src/functions.php';

return [
    'timezone' => date_default_timezone_set("Africa/Kampala"),

    'app_name' => env('APP_NAME', 'Pocketframe'),

    'app_key' => env('APP_KEY', 'your-secret-key'),
    'env'     => env('APP_ENV', 'production'),
    'debug'   => env('APP_DEBUG', false),

];
