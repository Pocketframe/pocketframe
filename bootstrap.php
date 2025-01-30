<?php

use Core\Container\App;
use Core\Container\Container;
use Core\Database\Database;

$container = new Container();

$container->bind('Core\Database\Database', function () {
    $database = require base_path('config/database.php');
    return new Database($database['database']);
});

App::setContainer($container);
