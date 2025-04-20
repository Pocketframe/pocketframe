<?php

use Pocketframe\Middleware\ApiAuthMiddleware;
use Pocketframe\Middleware\AuthMiddleware;
use Pocketframe\Middleware\CsrfMiddleware;
use Pocketframe\Middleware\SessionMiddleware;

return [
  /**
   * Global middleware that runs on every request
   *
   * @var array<class-string>
   */
  'global' => [
    CsrfMiddleware::class,
    SessionMiddleware::class,
  ],
  /**
   * Middleware groups
   * These middleware groups are applied to the routes in the web.php file
   *
   * @var array<string, array<class-string>>
   */
  'groups' => [
    'web' => [
      // AuthMiddleware::class,
    ],
    /**
     * Middleware for API routes
     *
     * These middleware groups are applied to the routes in the api.php file
     * @var array<class-string>
     */
    'api' => [
      // ApiAuthMiddleware::class,
    ],
  ],
];
