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

use Pocketframe\Middleware\CsrfMiddleware;

$router->get('/', 'App\Controllers\Web\HomeController@index');

// $router->group(['middleware' => [CsrfMiddleware::class]], function ($router) {
$router->get('/posts', 'App\Controllers\Web\Posts\PostsController@index');
$router->get('/posts/create', 'App\Controllers\Web\Posts\PostsController@create');
$router->post('/posts', 'App\Controllers\Web\Posts\PostsController@store');
$router->get('/posts/{id}', 'App\Controllers\Web\Posts\PostsController@show');
$router->get('/posts/{id}/edit', 'App\Controllers\Web\Posts\PostsController@edit');
$router->put('/posts/{id}', 'App\Controllers\Web\Posts\PostsController@update');
$router->delete('/posts/{id}', 'App\Controllers\Web\Posts\PostsController@destroy');
// });
