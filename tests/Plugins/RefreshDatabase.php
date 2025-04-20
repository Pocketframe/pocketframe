<?php

use Pocketframe\Console\Commands\SchemaCommand;

uses(Tests\TestCase::class)->beforeAll(function () {
    $useInMemory = getenv('DB_DATABASE') === ':memory:';
    $shouldRefresh = getenv('REFRESH_DB') === 'true';

    if ($useInMemory && $shouldRefresh) {
        (new SchemaCommand(['fresh']))->handle();
    }
});
