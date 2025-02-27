<?php
session_start();

const BASE_PATH = __DIR__ . '/';
require BASE_PATH . 'vendor/autoload.php';
require base_path('bootstrap.php');

error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
ini_set('error_log', base_path('logs/pocketframe.log'));



use Pocketframe\Container\App;
use Pocketframe\Database\DB;

$app = new App($container, $router);

DB::setContainer($container);
$databaseInstance = DB::getInstance();

$app->run();
