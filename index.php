<?php
session_start();

ini_set('log_errors', '1');

const BASE_PATH = __DIR__ . '/';
require BASE_PATH . 'vendor/autoload.php';

ini_set('error_log', BASE_PATH . 'logs/pocketframe.log');

ini_set('display_errors', '0');

use Pocketframe\Container\App;
use Pocketframe\Database\DB;

$envPath = base_path('.env');
if (file_exists($envPath)) {
    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        putenv(trim($line));
    }
}

require base_path('bootstrap.php');

require base_path('routes/web.php');
require base_path('routes/api.php');

$app = new App($container, $router);

DB::setContainer($container);
$databaseInstance = DB::getInstance();

$app->run();
