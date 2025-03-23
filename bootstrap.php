<?php

use Pocketframe\Container\Container;
use App\Container\ContainerRegister;
use Pocketframe\Container\ContainerRegister as PocketframeContainerRegister;
use Pocketframe\Database\DB;
use Pocketframe\Exceptions\ExceptionHandler;
use Pocketframe\Middleware\MiddlewareRegister\MiddlewareRegister;
use Pocketframe\PocketORM\Database\Connection;
use Pocketframe\Routing\Router;

$container = new Container();
$router    = new Router($container);

require base_path('routes/web.php');
require base_path('routes/api.php');

load_env(base_path('.env'));


set_exception_handler([ExceptionHandler::class, 'handle']);

Container::setInstance($container);

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

Connection::configure();
$pdo = Connection::getInstance();

/**
 * Set the container for the database
 */
DB::setContainer($container);

Container::setInstance($container);
