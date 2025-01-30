<?php
session_start();

const BASE_PATH = __DIR__ . '/';
require BASE_PATH . 'vendor/autoload.php';

require __DIR__ . '/vendor/williamug/versioning/src/functions.php';

// require BASE_PATH . 'app/helpers.php';

$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
$dotenv->load();
$dotenv->required([
    'APP_KEY',
])->notEmpty();

use Core\Routing\Router;


require base_path('bootstrap.php');

$router = new Router();

require base_path('routes.web.php');
require base_path('routes.api.php');

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router->route($uri, $method);
