<?php

use Pocketframe\Container\Container;
use Pocketframe\Database\Database;
use Pocketframe\Exceptions\Handler;

$container = new Container();

$container->bind('exceptionHandler', function () {
    return new Handler();
});

$container->bind('Core\Database\Database', function () {
    $database = require base_path('config/database.php');
    return new Database($database['database']);
});
