<?php
session_start();

const BASE_PATH = __DIR__ . '/';
require BASE_PATH . 'vendor/autoload.php';

use Pocketframe\Container\App;
use Pocketframe\Routing\Router;

require base_path('bootstrap.php');

$envPath = base_path('.env');
if (file_exists($envPath)) {
    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        putenv(trim($line));
    }
}

$router = new Router($container);

require base_path('routes/web.php');
require base_path('routes/api.php');

$app = new App($container, $router);
$app->run();
