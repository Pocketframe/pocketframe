<?php

/**
 * Web Routes
 * 
 * Define your web routes here. Routes are registered with the Router
 * and can be assigned middleware for request filtering.
 * 
 * Example:
 * $router->get('/path', 'Controller@method');
 * $router->post('/form', 'Controller@handle', [Middleware::class]);
 */

$router->get('/api/v1/posts', 'App\Controllers\API\v1\Posts\PostsController@index');
