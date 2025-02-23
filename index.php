<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

const BASE_PATH = __DIR__ . '/';
require BASE_PATH . 'vendor/autoload.php';

ini_set('error_log', base_path('logs/pocketframe.log'));

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
