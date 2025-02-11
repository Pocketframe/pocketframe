<?php

use Pocketframe\Container\Container;
use Pocketframe\Database\Database;
use Pocketframe\Database\DB;
use Pocketframe\Exceptions\Handler;
use Pocketframe\Logger\Logger;
use Pocketframe\Routing\Router;

$container = new Container();
$router = new Router($container);


$middlewareConfig = require config_path('middleware.php');

// Register global middleware
foreach ($middlewareConfig['global'] as $middleware) {
    $router->addGlobalMiddleware($middleware);
}

// Register middleware groups
$router->group(['middleware' => $middlewareConfig['groups']['web']], function () use ($router) {
    require routes_path('web.php');
});

$router->group(['middleware' => $middlewareConfig['groups']['api'], 'prefix' => 'api'], function () use ($router) {
    require routes_path('api.php');
});

$container->bind('exceptionHandler', function () {
    return new Handler();
});

$container->bind(Database::class, function () {
    $config = require base_path('config/database.php');
    return new Database($config['database']);
});

$container->bind(Logger::class, function () {
    return new Logger();
});

DB::setContainer($container);
