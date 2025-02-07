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


$router->get('/', 'App\Controllers\Web\HomeController@index');
// $router->post('/submit', 'FormController@submit', [CsrfMiddleware::class]);
