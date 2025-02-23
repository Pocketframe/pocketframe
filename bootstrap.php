<?php

use Pocketframe\Container\Container;
use App\Container\ContainerRegister;
use Pocketframe\Container\ContainerRegister as PocketframeContainerRegister;
use Pocketframe\Database\DB;
use Pocketframe\Middleware\MiddlewareRegister\MiddlewareRegister;
use Pocketframe\Routing\Router;

$container = new Container();
$router    = new Router($container);

require base_path('routes/web.php');
require base_path('routes/api.php');

load_env(base_path('.env'));

/**
 * Register middleware
 */
(new MiddlewareRegister())->register($router);

/**
 * Register framework-level container bindings for core services
 * like exception handling, database, and logging
 */
(new PocketframeContainerRegister())->register($container);

/**
 * Register application-specific container bindings
 * like custom services, repositories, and utilities
 */
(new ContainerRegister())->register($container);

/**
 * Set the container for the database
 */
DB::setContainer($container);
