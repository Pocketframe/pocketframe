# Pocketframe Documentation

### Table of Contents

- [Introduction](#introduction)
- [Getting Started](#getting-started)
- [Installation](#installation)
- [Configuration](#configuration)
- [Core Concepts](#core-concepts)
- [Service Container](#service-container)
- [Routing](#routing)
- [Middleware](#middleware)
- [Controllers](#controllers)
- [CSRF Protection](#csrf-protection)
- [Requests](#requests)
- [Responses](#responses)
- [Database](#database)
- [Error Handling](#error-handling)
- [Logging](#logging)
- [Views](#views)
- [Pocket View Templating](#pocket-views)
- [Session](#session)
- [Validation](#validation)
- [CLI](#cli)
<!-- - [Advanced Topics](#advanced-topics) -->
<!-- - [Custom Middleware](#custom-middleware) -->
- [Helper Functions](#helper-functions)
- [Contributing](#contributing)

---

## Getting Started

Pocketframe is a lightweight yet powerful PHP framework designed for building modern web applications. This section will help you get up and running with your first Pocketframe application.

### Prerequisites

Before you begin, ensure you have:
- PHP 8.1 or higher installed
- Composer package manager
- Basic understanding of PHP and MVC patterns


### Installation

To install Pocketframe, you need to have PHP and Composer installed on your system.

To create a new Pocketframe project, run the following command in your terminal:

```bash
composer create-project pocketframe/application demo-app --stability dev
```

### Set Up Environment:

Copy the `.env.example` to `.env` and configure your environment variables.

After adding you .env file, you can use the following command to generate an encryption key for your application:

```bash
php pocket add:key
```


### Run Your Server

To start the development server, run the following command:

```bash
php pocket serve
```

## Configuration

Pocketframe uses a configuration directory to manage settings.

### Key configuration files include:
- `config/app.php`: Application settings.
- `config/database.php`: Database connection settings.
- `config/middleware.php`: Middleware configuration.

## Core Concepts

### Service Container
The service container is a powerful tool for managing class dependencies and performing dependency injection (DI). It is used to bind and resolve classes throughout the application.

```php
$container->bind(Database::class, function () {
  $config = require config_path('database');
  return new Database($config['database']);
});
```

## Routing
Routing in Pocketframe is managed by the Router class. Routes are defined in routes/web.php and routes/api.php.

The Router class is responsible for handling HTTP requests and dispatching them to the appropriate controller action.

```php
$router->get('/', ['HomeController', 'index'], name: 'home.index');
```
> [!NOTE]
> The first parameter of the get method is the route **path**, the second parameter is an array containing the **controller** and **action**, and the third parameter is the **name** of the route.

You can also define middleware for routes using route groups.
```php
$router->group(['middleware' => 'auth'], function ($router) {
  $router->get('/dashboard', ['DashboardController', 'index'], name: 'dashboard.index');
});
  ```

If you want to define prefix routes, you can use the group method.

```php
$router->group(['prefix' => 'admin'], function ($router) {
  $router->get('/dashboard', ['DashboardController', 'index'], name: 'dashboard.index');
});
```

Apart from add prefixes and middlewares, you can also group routes by their controllers as follows:

```php
use App\Controllers\PostsController;

$router->group(['controller' => PostsController::class], function ($router) {
  $router->get('/posts', 'index', name: 'posts.index');
  $router->get('/posts/create', 'create', name: 'posts.create');
});
```

Combining all of these features, you can create a route like this:

```php
use App\Controllers\PostsController;

$router->group([
  'prefix'     => 'posts',
  'middleware' => [AuthMiddleware::class, CsrfMiddleware::class],
  'controller' => PostsController::class
  ], function ($router) {
  $router->get('/', 'index', name: 'posts.index');
  $router->get('/posts/create', 'create', name: 'posts.create');
});
```

**Available Methods:**

- `get()`: Define a route for GET requests.
- `post()`: Define a route for POST requests.
- `put()`: Define a route for PUT requests.
- `delete()`: Define a route for DELETE requests.
- `group()`: Define a group of routes.

## Middleware

Middleware provides a convenient mechanism for filtering HTTP requests entering your application. Global middleware is applied to all routes, while route-specific middleware can be applied to individual routes or groups.

**Global Middleware:**

All global middleware is defined in the `config/middleware.php` file. These middleware will run on every request through the application.

```php
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
];
```

**Route-Specific Middleware:**

You can apply middleware to a specific route or group of routes by using the group method with a closure. To apply middleware to a group of routes, you can use the group method. This is useful for applying middleware to a group of routes that share the same middleware.
```php
$router->group(['middleware' => [CsrfMiddleware::class]], function ($router) {
    $router->get('/posts', 'App\Controllers\Web\Posts\PostsController@index');
});
```

You can also define middleware groups in the `config/middleware.php` file. If you register middleware in the `config/middleware.php` file, it will be applied to the routes in the web.php file.

```php
/**
 * Middleware groups
 * These middleware groups are applied to the routes in the web.php file
 *
 * @var array<string, array<class-string>>
 */
'groups' => [
  'web' => [
    AuthMiddleware::class,
  ],
];
```

**Creating Middleware:**
On top of the all ready middleware, you can create your own middleware. That you can register in the `config/middleware.php` file or apply to a specific route or group of routes.

**Example:**
```php
<?php

namespace App\middleware;

use Closure;
use Pocketframe\Contracts\MiddlewareInterface;
use Pocketframe\Http\Request\Request;
use Pocketframe\Http\Response\Response;

class ExampleMiddleware implements MiddlewareInterface
{
  public function handle(Request $request, Closure $next): Response
  {
    // Pre-middleware logic
    $response = $next($request);

    // Post-middleware logic
    return $response;
  }
}
```

## Controllers
Controllers are responsible for handling incoming requests and returning responses. Controllers can group related request handling logic into a single class. They are stored in the app/Controllers directory.

**Creating a Controller:**

To help you create a controller, run the following pocket command:
```bash
php pocket controller:create HomeController
```
> [!IMPORTANT]
> All controllers are stored in the `app/Controllers` directory. Inside the Controllers directory, there are two subdirectories: `Web` and `Api`. The `Web` directory is used for web routes and the `Api` directory is used for API routes.

**Basic Controller Example:**

```php
<?php

namespace App\Controllers\Web\Posts;

use Pocketframe\Database\DB;
use Pocketframe\Http\Response\Response;

class PostsController
{
  public function index(): Response
  {
    $posts = DB::table('posts')
      ->select(['id', 'title'])
      ->orderByDesc('id')
      ->paginate(10);

    return Response::view('posts/index', [
      'posts' => $posts,
    ]);
  }
}
```
Once you have written a controller class and method, you may define a route to the controller method like so:

```php
$router->get('/posts', [PostsController::class, 'index']);
```
When a request is made to the `/posts` route, the `index()` method of the `PostsController` class will be executed.

### Single Action Controllers
Single action controllers are a simple way to define a controller that only has a single action. They are basically have a single method called `__invoke()` that handles the incoming request

To create a single action controller, you can run the following pocket command:
```bash
php pocket controller:create DashboardController --invokable
```
> [!TIP]
> You can also abbreviate the command to
>
> `php pocket controller:create DashboardController -i`

**Example:**
```php
use Pocketframe\Http\Request\Request;

class PostsController
{
   public function __invoke(Request $request)
    {
       //
    }
}
```

### Resource Controllers
Resource controllers are a type of controller that is used to handle CRUD operations. They are a great way to organize your code and make it easier to maintain.

If you want to generate a resource controller, you can run the following pocket command:
```bash
php pocket controller:create PostsController --resource
```

> [!TIP]
> You can also abbreviate the command to
>
> `php pocket controller:create PostsController -r`


Available actions in a resource controller:

| HTTP Verb | URI             | Action  | Route Name   |
| --------- | --------------- | ------- | ------------ |
| GET       | /post           | index   | post.index   |
| GET       | /post/create    | create  | post.create  |
| POST      | /post           | store   | post.store   |
| GET       | /post/{id}      | show    | post.show    |
| GET       | /post/{id}/edit | edit    | post.edit    |
| PUT       | /post/{id}      | update  | post.update  |
| DELETE    | /post/{id}      | destroy | post.destroy |

### API Controllers
You can also generate a controller specifically for the API. API controllers only contains `index`, `store`, `show`, `update` and `destroy` To do this, you can run the following pocket command:
```bash
php pocket controller:create PostsController --api
```

## CSRF Protection

Cross-site request forgeries are a type of malicious exploit whereby unauthorized action is performed on behalf of the user. In other words, a user is tricked into submitting a malicious form without their knowledge. By default, Pocketframe includes a middleware that will protect your application against cross-site request forgeries.

### Preventing CSRF Attacks
To prevent CSRF attacks, you should include a CSRF token in all your forms. You can generate a CSRF token using the `csrf_token()` helper function.

```php
<form method="POST" action="/profile">
    <% csrf_token() %>

    <!-- same as below -->
    <input type="hidden" name="_token" value="<% SESSION['csrf_token'] %>" />
</form>
```

> [!IMPORTANT]
> If you are using a framework like Vue or React, you should not use the `csrf_token()` helper function. Instead, you should use the `_token()` helper function. This will generate a CSRF token that is unique to the current user.

## Requests
This class is used to handle the incoming request. It allows you to access request data, headers, and more.

**How to use the Request class:**

You can access the request data using the `Request` class. The request class can be injected into the controller method. This is useful when you need to access the request data in the controller method and will allow you access all the methods and properties of the request class.

```php
<?php

namespace App\Controllers\Web\Posts;

use Pocketframe\Http\Request\Request;

class PostsController
{
  public function store(Request $request)
  {
    $request->post('title');
  }
}

```

**Available Methods:**

- **Get the HTTP method of the request (GET, POST, etc.)**

  If you want to get the HTTP method of the request, you can use the `method()` method.

  ```php
  $request->method();
  ```

- **Check the HTTP method of the request**

  If you want to check the HTTP method of the request, you can use the `isMethod($method)` method. This method will return true if the HTTP method of the request matches the method passed to the method.

  ```php
  $request->isMethod('get');
  ```

- **Get the URI of the request**

  If you want to get the URI of the request, you can use the `uri()` method. This method will return the URI of the request.

  ```php
  $request->uri();
  ```

- **Get all request data as an array (GET, POST, FILES)**

  If you want to get all the request data as an array, you can use the `all()` method. This method will return an array of all the request data.

  ```php
  $request->all();
  ```

 - **Get a value from the GET parameters**

    If you want to get a value from the GET parameters, you can use the `get($key)` method. This method will return the value of the GET parameter passed to the method.

    ```php
    $request->get($id);
    ```

- **Get a value from the POST parameters**

  If you want to get a value from the POST parameters, you can use the `post($key)` method. This method will return the value of the POST parameter passed to the method.

  ```php
  $request->post('name');
  ```

- **Get a value from the JSON request body**

  If you want to get a value from the JSON request body, you can use the `json($key)` method. This method will return the value of the JSON request body passed to the method.

  ```php
  $request->json('name');
  ```

- **Check if the request contains JSON data**

  If you want to check if the request contains JSON data, you can use the `isJson()` method. This method will return true if the request contains JSON data.

  ```php
  $request->isJson();
  ```

- **Get an uploaded file by key**

  If you want to get an uploaded file by key, you can use the `file($key)` method. This method will return the uploaded file passed to the method.

  ```php
  $request->file('image');
  ```

- **Check if a file was uploaded for the given key**

  If you want to check if a file was uploaded for the given key, you can use the `hasFile($key)` method. This method will return true if the file was uploaded for the given key.

  ```php
  $request->hasFile($key);
  ```

- **Check if a parameter exists in the request**

  If you want to check if a parameter exists in the request, you can use the `has($key)` method. This method will return true if the parameter exists in the request.

  ```php
  $request->has('name');
  ```

- **Check if parameter exists and is not empty**

  If you want to check if a parameter exists and is not empty, you can use the `filled($key)` method. This method will return true if the parameter exists and is not empty.


  ```php
  $request->filled('name');
  ```

- **Sanitize input data to prevent XSS attacks**

  If you want to sanitize input data to prevent XSS attacks, you can use the `sanitize($input)` method. This method will sanitize the input data passed to the method.

    ```php
    $request->sanitize('name');
  ```

- **Check if request expects JSON response**

  If you want to check if the request expects a JSON response, you can use the `expectsJson()` method. This method will return true if the request expects a JSON response.

  ```php
  $request->expectsJson();
  ```

- **Get a request header value**

  If you want to get a request header value, you can use the `header($key, $default)` method. This method will return the value of the request header passed to the method.

  ```php
  $request->header('X-Header-Name'
  ```

- **Get a cookie value**

  If you want to get a cookie value, you can use the `cookie($key, $default)` method. This method will return the value of the cookie passed to the method.


  ```php
  $request->cookie('name');
  ```

- **Check if request is an AJAX request**

  If you want to check if the request is an AJAX request, you can use the `isAjax()` method. This method will return true if the request is an AJAX request.


  ```php
  $request->isAjax();
  ```

- **Get the full URL of the request**

  If you want to get the full URL of the request, you can use the `url()` method. This method will return the full URL of the request.

  ```php
  $request->url();
  ```

- **Get the URL of the previous request**

  If you want to get the URL of the previous request, you can use the `previous()` method. This method will return the URL of the previous request.

  ```php
  $request->previous();
  ```

- **Create redirect response to previous URL**

  If you want to create a redirect response to the previous URL, you can use the `back()` method. This method will redirect the user to the previous URL.

  ```php
  $request->back();
  ```

- **Get the user agent string**

  If you want to get the user agent string, you can use the `userAgent()` method. This method will return the user agent string of the request.

  ```php
  $request->userAgent();
  ```

- **Get the client IP address**

  If you want to get the client IP address, you can use the `ip()` method. This method will return the client IP address of the request.

  ```php
  $request->ip();
  ```

- **Check if request was made over HTTPS**

  If you want to check if the request was made over HTTPS, you can use the `isSecure()` method. This method will return true if the request was made over HTTPS.

  ```php
  $request->isSecure();
  ```

- **Set session data**

  If you want to set session data, you can use the `setSession($data)` method. This method will set the session data passed to the method.

  ```php
  $request->setSession($data);
  ```

- **Get all session data**

  If you want to get all the session data, you can use the `session()` method. This method will return all the session data.

  ```php
  $request->session();
  ```

- **Check if request wants JSON response**

  If you want to check if the request wants a JSON response, you can use the `wantsJson()` method. This method will return true if the request wants a JSON response.

  ```php
  $request->wantsJson();
  ```


## Responses

Routes and controllers can return a response which will be sent to the user. The response class is used to send HTTP responses. It supports various response types, including views, JSON, redirects and more. This class also supports status codes and headers.

```php
return Response::view('home');
```

**Available status codes:**

This class has has the following status codes.

```php
Response::OK
Response::CREATED
Response::REDIRECT
Response::BAD_REQUEST
Response::UNAUTHORIZED
Response::FORBIDDEN
Response::NOT_FOUND
Response::METHOD_NOT_ALLOWED
Response::PAGE_EXPIRED
Response::INTERNAL_SERVER_ERROR

```

**Available Methods:**

- **Render a view with optional data and status code**

  If you want to render a view with optional data and status code, you can use the `view()` method. This method will render the view passed to the method and return a response.

  ```php
  Response::view('home', ['name' => 'John Doe']);
  ```

- **Return JSON response with optional status code**

  If you want to return a JSON response with optional status code, you can use the `json()` method. This method will return a JSON response with the data passed to the method and the status code passed to the method.

  ```php
  Response::json(['name' => 'John Doe']);
  ```

- **Send the response to the client**

  If you want to send the response to the client, you can use the `send()` method. This method will send the response to the client.

  ```php
  Response::send();
  ```

- **Redirect to a URL with optional status code**

  If you want to redirect to a URL with optional status code, you can use the `redirect()` method. This method will redirect the user to the URL passed to the method and the status code passed to the method.

  ```php
  Response::redirect('/posts');
  ```

- **Return plain text response with optional status code**

  If you want to return a plain text response with optional status code, you can use the `text()` method. This method will return a plain text response with the text passed to the method and the status code passed to the method.

  ```php
  Response::text('Hello, world!');
  ```

- **Return empty response with 204 status code**

  If you want to return an empty response with 204 status code, you can use the `noContent()` method. This method will return an empty response with the status code 204.

  ```php
  Response::noContent();
  ```

- **Return file download response**

  If you want to return a file download response, you can use the `file()` method. This method will return a file download response with the path passed to the method and the name passed to the method.

  ```php
  Response::file('path/to/file.pdf', 'file.pdf');
  ```

- **Stream response content**

  If you want to stream response content, you can use the `stream()` method. This method will stream the response content passed to the method.

  ```php
  Response::stream(function () {
    echo 'Hello, world!';
  });
  ```

- **Set response header**

  If you want to set a response header, you can use the `setHeader()` method. This method will set the header passed to the method.

  ```php
  Response::setHeader('X-Header-Name', 'X-Header-Value');
  ```

- **Get all response headers**

  If you want to get all response headers, you can use the `getHeaders()` method. This method will return an array of all the response headers.

  ```php
  Response::getHeaders();
  ```

- **Set response cookie**

  If you want to set a response cookie, you can use the `setCookie()` method. This method will set the cookie passed to the method. The cookie will be set for the current request.

  ```php
  Response::setCookie('name', 'value', 0, '/', '', false, false);
  ```
  **Parameters available:**

   - name: the name of the cookie
   - value: the value of the cookie
   - expire: the expiration date of the cookie
   - path: the path of the cookie
   - domain: the domain of the cookie
   - secure: whether the cookie is secure
   - httponly: whether the cookie is httponly

- **Enable response caching**

  If you want to enable response caching, you can use the `cacheFor()` method. This method will cache the response for the number of minutes passed to the method.

  ```php
  Response::cacheFor(10);
  ```

- **Disable response caching**

  If you want to disable response caching, you can use the `noCache()` method. This method will disable response caching.

  ```php
  Response::noCache();
  ```

- **Return JSONP response**

  If you want to return a JSONP response, you can use the `jsonp()` method. This method will return a JSONP response with the data passed to the method and the callback parameter passed to the method.

  ```php
  Response::jsonp(['name' => 'John Doe'], 'callback');
  ```

- **Return formatted JSON response**

  If you want to return a formatted JSON response, you can use the `prettyJson()` method. This method will return a formatted JSON response with the data passed to the method and the status code passed to the method.

  ```php
  Response::prettyJson(['name' => 'John Doe']);
  ```

- **Add response header**

  If you want to add a response header, you can use the `withHeader()` method. This method will add a response header with the name and value passed to the method.

  ```php
  Response::withHeader('X-Header-Name', 'X-Header-Value');
  ```

- **Check if response is successful**

  If you want to check if response is successful, you can use the `isOk()` method. This method will return true if the response is successful.

  ```php
  Response::isOk();
  ```

- **Check if response is redirect**

  If you want to check if response is redirect, you can use the `isRedirect()` method. This method will return true if the response is redirect.

  ```php
  Response::isRedirect();
  ```

- **Check if response is client error**

  If you want to check if response is client error, you can use the `isClientError()` method. This method will return true if the response is client error.

  ```php
  Response::isClientError();
  ```

- **Check if response is server error**

  If you want to check if response is server error, you can use the `isServerError()` method. This method will return true if the response is server error.

  ```php
  Response::isServerError();
  ```

- **Set response as file attachment**

  If you want to set response as file attachment, you can use the `attachment()` method. This method will set the response as a file attachment with the filename passed to the method.

  ```php
  Response::attachment('file.pdf');
  ```


## Database

#### Configuration

You can configure the database by adding the following to the `.env` file.

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

After configuring the database, you can use the `DB` class to interact with the database.


```php
$posts = DB::table('posts')->get();
```

**Available Methods:**

  - **table(string $table)**

    Sets the table name for the query. You can pass the table name to the method.
    ```php
    DB::table('users')
    ```
    **Parameters:**
    - `$table`: The name of the table to query.

  - **select(array $columns)**

    Specifies which columns to select from the table. You can pass an array of columns to select from the table.
    ```php
    DB::table('users')->select(['id', 'name', 'email'])
    ```
    **Parameters:**
    - `$columns`: An array of columns to select from the table.

  - **where(string $column, string $operator, mixed $value)**

    Adds a WHERE clause to filter results.
    ```php
    DB::table('users')->where('age', '>', 18)
    ```
    **Parameters:**
    - `$column`: The column to filter by.
    - `$operator`: The operator to use in the filter.
    - `$value`: The value to filter by.

  - **orWhere(string $column, string $operator, string $value)**

    Adds an OR WHERE clause to filter results.
    ```php
    DB::table('users')->where('age', '>', 18)->orWhere('role', '=', 'admin')
    ```
    **Parameters:**
    - `$column`: The column to filter by.
    - `$operator`: The operator to use in the filter.
    - `$value`: The value to filter by.

  - **andWhere(string $column, string $operator, string $value)**

    Adds an AND WHERE clause to filter results.
    ```php
    DB::table('users')->where('age', '>', 18)->andWhere('active', '=', 1)
    ```
    **Parameters:**
    - `$column`: The column to filter by.
    - `$operator`: The operator to use in the filter.
    - `$value`: The value to filter by.

  - **whereNull(string $column)**

    Adds a WHERE IS NULL clause.
    ```php
    DB::table('users')->whereNull('deleted_at')
    ```
    **Parameters:**
    - `$column`: The column to filter by.

  - **whereNotNull(string $column)**

    Adds a WHERE IS NOT NULL clause.
    ```php
    DB::table('users')->whereNotNull('email')
    ```
    **Parameters:**
    - `$column`: The column to filter by.

  - **andWhereNull(string $column)**

    Adds an AND WHERE IS NULL clause.
    ```php
    DB::table('users')->where('active', '=', 1)->andWhereNull('deleted_at')
    ```
    **Parameters:**
    - `$column`: The column to filter by.

  - **orIsNull(string $column)**

    Adds an OR WHERE IS NULL clause.
    ```php
    DB::table('users')->where('active', '=', 1)->orIsNull('deleted_at')
    ```
    **Parameters:**
    - `$column`: The column to filter by.

  - **orderByDesc(string $column)**

    Orders results by a column in descending order.
    ```php
    DB::table('users')->orderByDesc('created_at')
    ```
    **Parameters:**
    - `$column`: The column to order by.

  - **orderByAsc(string $column)**

    Orders results by a column in ascending order.
    ```php
    DB::table('users')->orderByAsc('name')
    ```
    **Parameters:**
    - `$column`: The column to order by.

  - **orWhereNotNull(string $column)**

    Adds an OR WHERE IS NOT NULL clause.
    ```php
    DB::table('users')->where('active', '=', 1)->orWhereNotNull('email')
    ```
    **Parameters:**
    - `$column`: The column to filter by.

  - **join(string $table, string $firstColumn, string $operator, string $secondColumn, string $type = 'INNER')**

    Adds a JOIN clause to the query.
    ```php
    DB::table('users')->join('posts', 'users.id', '=', 'posts.user_id')
    ```
    **Parameters:**
    - `$table`: The table to join.
    - `$firstColumn`: The first column to join on.
    - `$operator`: The operator to use in the join.
    - `$secondColumn`: The second column to join on.
    - `$type`: The type of join to use.

  - **limit(int $limit)**

    Limits the number of results returned.
    ```php
    DB::table('users')->limit(10)
    ```
    **Parameters:**
    - `$limit`: The number of results to return.

  - **offset(int $offset)**

    Sets the offset for the results.
    ```php
    DB::table('users')->offset(10)
    ```
    **Parameters:**
    - `$offset`: The offset to set for the results.
  - **get()**

    Executes the query and returns all results.
    ```php
    DB::table('users')->get()
    ```

  - **first()**

    Gets the first result from the query.
    ```php
    DB::table('users')->first()
    ```

  - **count()**

    Counts the number of results.
    ```php
    DB::table('users')->count()
    ```

  - **paginate(int $perPage = 15)**

    Paginates the results.
    ```php
    DB::table('users')->paginate(20)
    ```
    **Parameters:**
    - `$perPage`: The number of results to return per page.

  - **insert(string $table, array $columns)**

    Inserts a new record.
    ```php
    DB::insert('users',
    [
      'name' => 'John',
      'email' => 'john@example.com'
    ]);
    ```
    **Parameters:**
    - `$table`: The table to insert the record into.
    - `$columns`: An array of columns to insert into the table.

  - **update(string $table, array $sets, array $condition)**

    Updates existing records.
    ```php
    DB::update('users',
    [
      'name' => 'John',
      'email' => 'johndoe@example.com'
    ],
    [
      'id' => 1
    ]);
    ```
    **Parameters:**
    - `$table`: The table to update the record in.
    - `$sets`: An array of columns to update.
    - `$condition`: An array of conditions to update the record.

  - **delete(string $table, array $condition)**

    Soft deletes records (sets deleted_at).
    ```php
    DB::delete('users', ['id' => 1])
    ```
    **Parameters:**
    - `$table`: The table to delete the record from.
    - `$condition`: An array of conditions to delete the record.

  - **forceDelete(string $table, array $condition)**

    Permanently deletes records.
    ```php
    DB::forceDelete('users', ['id' => 1])
    ```
    **Parameters:**
    - `$table`: The table to delete the record from.
    - `$condition`: An array of conditions to delete the record.

  - **transaction(callable $callback)**

    Executes queries within a transaction.
    ```php
    DB::transaction(function() use($request) {
      // Insert a post
      $post = DB::insert('posts', [
        'user_id' => 1,
        'title' => $request->post('title'),
        'body' => $request->post('body'),
      ]);

      // Insert a comment
      DB::insert('comments', [
        'post_id' => $post->id,
        'body' => $request->post('body'),
      ]);
    })
    ```
    **Parameters:**
    - `$callback`: A callback function to execute the queries.

## Error Handling and Exceptions
By default, Pocketframe will display a generic error message for any unhandled exceptions. However, you can customize the error handling behavior by creating a custom error handler.

### Some of the built-in error handlers include:
- **DatabaseException**: Handles database-related errors.
- **AuthenticationException**: Handles authentication-related errors.
- **CacheException**: Handles cache-related errors.
- **ValidationException**: Handles validation-related errors.
- **ConfigurationException**: Handles configuration-related errors.
- **FileSystemException**: Handles file system-related errors.
- **HTTP Exception**: Handles HTTP-related errors.
- **MiddlewareException**: Handles middleware-related errors.

### Creating a Custom Error Handler
You can also create your own custom error handler by extending the `PocketframeException` class.

**Example:**
```php
<?php

namespace Pocketframe\Exceptions\HTTP;

use Pocketframe\Exceptions\PocketframeException;

class CustomException extends PocketframeException
{
  public function __construct($message = "Custom error message")
  {
    parent::__construct($message, 403);
  }
}
```

## Logging
Pocketframe provides a simple logging system that allows you to log messages to a file or the console.


## Views
Pocketframe has a simple and powerful view system that is called **Pocket View**

As you develop your application, you'll often need to display data to the user. Pocketframe provides a powerful view system that allows you to create and render views to your users. The views will not be mixed with the rest of your code, making it easy to manage and maintain your application. They usually separates your logic from your presentation.


```html
<!-- views/welcome.view.php -->

<html>
  <head>
    <title>Pocketframe</title>
  </head>
  <body>
    <h1>Welcome to <%= $name %>!</h1>
  </body>
</html>
```

Your views are stored in the `resources/views` directory of your application. You can create as many views as you need, and they will be automatically loaded by Pocketframe when you render them. You can also create subdirectories within the `resources/views` directory to organize your views into logical groups.

> [!TIP]
> Pocket View has an extension of **.view.php** and compiled into PHP files.

### Creating and Rendering Views
To create a view, you can simply run a command in your terminal:
```bash
php pocket view:create welcome
```
This will create a new view file in the `resources/views` directory. You can then render the view by return a response in your controller:
```php
<?php
namespace App\Controllers;
use Pocketframe\Http\Request;
use Pocketframe\Http\Response;

class WelcomeController
{
  public function index(Request $request)
  {
    return Response::view('welcome', ['name' => 'Pocketframe']);
  }
}
```

### Passing Data to Views
You can pass data to your views by passing an array of data to the view function:
```php
return Response::view('welcome', ['name' => 'Pocketframe']);
```

## Pocket View Template Engine
Pocket View uses a simple and powerful template engine that allows you to easily create and render views to your users. The template engine does not restrict to use PHP syntax, but you can use PHP syntax if you want. All templates are compiled into PHP files, making them fast and efficient.

### Template Inheritance
The engine supports template inheritance, which allows you to create a base template that other templates can extend. This makes it easy to create consistent layouts and styles across your application.

### Base Template
The framework provides a base template that you can extend in your views. The base template is located in the `resources/views/layouts` directory.
```html
<!-- resources/views/layouts/app.view.php -->

 <!DOCTYPE html>
 <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><% yield title %></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
  </head>
  <body>
      <div class="container">
        <% yield content %>
      </div>
  </body>
 </html>

  ```

### Rendering and displaying data
You can render and display data in your views by using the following syntax:
```php
return Response::view('welcome', ['name' => 'Pocketframe']);
```
```php
<%= $name %>
```
The `<%= %>` syntax is used to display data in your views. These are called echo statements which automatically escape the data by using PHP's built-in `htmlspecialchars` function to prevent XSS attacks.

### Displaying unescaped data
If you want to display unescaped data in your views, you can use the following syntax:
```php
<%! $name %>
```

> [!WARNING]
> You should use this syntax with caution as it can lead to security vulnerabilities if not used properly.

### Pocket View Syntax

The following syntax is supported by Pocket View:

  **`<%= %>`**

  **Echo statements**.

  These statements are used to display data escaped data in your views.

  **`<%! %>`**
  **Echo unescaped data**.
  These statements are used to display unescaped data in your views.

  **`<% %>`**
  **Control structures**.
  These statements are used to control the flow of your views.

  ```php
  // if statements

  <% if ($name === 'Pocketframe') %>
    <h1>Welcome to Pocketframe!</h1>
  <% else %>
    <h1>Welcome to my app!</h1>
  <% endif %>
  ```

```php
  // foreach loops

  <% foreach ($names as $name) %>
    <li><%= iterator() %></li>
    <li><%= $name %></li>
  <% endforeach %>
  ```

```php
  // route statements
<% route('post.show', $post['id']) %>
```

```php
// method spoofing

<% method('DELETE') %>
```

```php
<% csrf_token() %>
```

```php
<% php %>
  // Your PHP code here
  echo 'Hello, World!';
<% endphp %>
```

```html
<#-- single/block comment --#>
```

## Session
Pocketframe provides a simple and easy-to-use session management system that allows you to store and retrieve data between requests.

## Validation
Pocketframe comes packed with a powerful validation system that allows you to validate user input and ensure that it meets the required criteria.

### How validators work
To learn how validation works in Pocketframe, let's create a simple application that allows us to create a new post.

### Defining the route
First, we need to define a route in `web.php` that will handle the creation of a new post. We can do this by adding the following code to our routes file:

```php
<?php
use App\Controllers\PostController;

Route::get('/posts/create', [PostController::class, 'create']);
Route::post('/posts', [PostController::class, 'store']);
```
The `get` method is used to define a route that will be accessible via a GET request, while the `post` method is used to define a route that will be accessible via a POST request.

### Creating the controller
Next, we need to create a controller that will handle the creation of a new post. We can do this by creating a new file called `PostController.php` in the `app/Controllers` directory and adding the following code to it:

```php
<?php
namespace App\Controllers;

use Pocketframe\Http\Request;
use Pocketframe\Http\Response;

class PostController
{
  public function create()
  {
    return Response::view('posts.create');
  }

  public function store(Request $request)
  {
    // Logic goes here

    return Response::redirect('/posts');
  }
}
```

Adding valiadation
Now that we have defined the route and created the controller, we can add validation to the `store` method. We can do this by adding the following code to the `store` method:

```php
public function store(Request $request)
{
   (new Validator())->validate(
      $request->all(), [
        'title' => ['required', 'string'],
        'body'  => ['required'],
      ])->failed();

  ....

  return Response::redirect('/posts');
}
```

In this example, we are using the `Validator` class to validate the input data. We are passing the request data and an array of validation rules to the `validate` method. The `validate` method will return a `Validator` instance, which we can use to check if the validation failed or not.

### Defining validation errors
If the incoming request fails validation, we can display the validation errors to the user.

```html
<-- /resources/views/post/create.view.php -->

<form method="POST" action="<% route('posts.store') %>">
  <div>
    <label for="title">Post Title</label>
    <input id="title" type="text" name="title" />
    <%! display_errors('title') %>
  </div>
</form>
```

### Repopulating the form
If the validation fails, we can repopulate the form with the user's input by adding the following code in the form input.

```html
<!-- /resources/views/post/create.view.php -->
 <input id="title" type="text" name="title" value="<%= old('title') %>"/>
 ```

 ### Displaying customem error messages
 You can also display custom error messages for specific fields by calling a message method on the validator instance.

 ```php
(new Validator())->validate(
    $request->all(),
      [
        'title' => ['required', 'string'],
        'body'  => ['required'],
      ]
    )
      ->message([
        'title.required' => 'You need to fill this',
        'body.required'  => 'Body cannot be empty'
      ])
      ->failed();
```

### Available validation rules
Pocketframe provides a set of built-in validation rules that you can use to validate user input. Here are some of the most commonly used rules:

- `required`: This rule ensures that the field is not empty.
  **Example**:
  ```php
  'name' => ['required']
  ```
- `string`: This rule ensures that the field contains only strings.
  **Example**:
  ```php
  'name' => ['string']
  ```
- `email`: This rule ensures that the field contains a valid email address.
  **Example**:
  ```php
  'email' => ['email']
  ```
- `numeric`: This rule ensures that the field contains only numeric values.
  **Example**:
  ```php
  'age' => ['numeric']
  ```
- `min`: This rule ensures that the field contains a minimum number of characters.

  **Example**:
  ```php
  'password' => ['min:8']
  ```
- `max`: This rule ensures that the field contains a maximum number of characters.

  **Example**:
  ```php
  'username' => ['max:20']
  ```
- `Unique`: This rule ensures that the field contains a unique value.

  **Example**:
  ```php
  use Pocketframe\Validation\Rules\Unique;

  'email' => [new Unique('users', 'email')]
  ```

- `date`: This rule ensures that the field contains a valid date.

  **Example**:
  ```php
  'date_of_birth' => ['date']
  ```

- `image`: This rule ensures that the field contains a valid image file.

  **Example**:
  ```php
  'avatar' => ['image']
  ```
- `nullable`: This rule allows the field to be empty.

  **Example**:
  ```php
  'bio' => ['nullable']
  ```

- `lowercase`: This rule ensures that the field contains only lowercase characters.

  **Example**:
  ```php
  'username' => ['lowercase']
  ```

- `uppercase`: This rule ensures that the field contains only uppercase characters.
-
  **Example**:
  ```php
  'username' => ['uppercase']
  ```

- `sometime`: This rule ensures that the field contains only alphanumeric characters.
-
  **Example**:
  ```php
  'username' => ['sometime', 'required']
  ```

- `file`: This rule ensures that the field contains a valid file.

  **Example**:
   ```php
   'avatar' => ['file']
   ```


## CLI
Pocketframe provides a command-line interface (CLI) that allows you to perform various tasks, such as start the serve, creating new controllers, clearing cache, and more.

### Starting the server
To start the server, use the `serve` command:
```bash
php pocket serve
```

### Creating a new controller
To create a new controller, use the `controller:create` command:
```bash
php pocket controller:create PostController
```
The generated controller will be placed in the app/Controllers Web or API directory.

### Creating a middleware
To create a new middleware, use the `middleware:create` command:
```bash
php pocket middleware:create AuthMiddleware
```
The generated middleware will be placed in the app/Middleware directory.

### Clear Views
To clear the views cache, use the `clear:views` command:
```bash
php pocket clear:views
```
This will clear the views cache, which can be useful if you have made changes to your views and want to see the changes immediately.

### add:key
To add a new key to the .env file, use the `add:key` command:

```bash
php pocket add:key
```


### Helper Functions

Pocketframe includes several helper functions to simplify common tasks, such as base_path(), config_path(), and routes_path().

**Available Helper Functions:**

- **base_path()**

  Returns the absolute path from the base directory by appending the given path to the base path.
  ```php
  base_path('path/to/file');
  ```
  **Parameters:**
  - `$path`: The path to append to the base path.

- **urlIs()**

  Checks if the current URL matches a given path.
  ```php
  urlIs('/about');
  ```
  **Parameters:**
  - `$path`: The path to check if the current URL matches.

- **abort()**

  Aborts the request with an error page.
  ```php
  abort(404);
  ```
  **Parameters:**
  - `$code`: The HTTP status code to abort the request with.

- **authorize()**

  Checks a condition and aborts with an error if the condition is false.
  ```php
  authorize($user->isAdmin());
  ```
  **Parameters:**
  - `$condition`: The condition to check.

- **redirect()**

  Redirects to another URL path.
  ```php
  redirect('/login');
  ```
  **Parameters:**
  - `$url`: The URL to redirect to.

- **old()**

  Retrieves an old input value from the session.
  ```php
  old('email');
  ```
  **Parameters:**
  - `$key`: The key to retrieve the old input value from.

- **env()**

  Retrieves an environment variable from the server environment.
  ```php
  env('APP_NAME');
  ```
  **Parameters:**
  - `$key`: The key to retrieve the environment variable from.

- **numberToWords()**

  Converts a number to words using the NumberFormatter class.
  ```php
  numberToWords(42);
  ```
  **Parameters:**
  - `$number`: The number to convert to words.

- **asset()**

  Returns the full path to an asset by appending the asset path to the base path.
  ```php
  asset('css/app.css');
  ```
  **Parameters:**
  - `$path`: The path to the asset.

- **sanitize()**

  Sanitizes a string by converting special characters to HTML entities.
  ```php
  sanitize($userInput);
  ```
  **Parameters:**
  - `$string`: The string to sanitize.

- **method()**

  Generates a method field for HTML forms.
  ```php
  method('PUT');
  ```
  **Parameters:**
  - `$method`: The method to generate the method field for.

- **csrf_token()**

  Generates a CSRF field for HTML forms.
  ```php
  csrf_token();
  ```

- **config_path()**

  Returns the full path to a configuration file.
  ```php
  config_path('app');
  ```
  **Parameters:**
  - `$path`: The path to the configuration file.

- **config()**

  Retrieves a configuration value from the configuration file.
  ```php
  config('app.name');
  ```
  **Parameters:**
  - `$key`: The key to retrieve the configuration value from.

- **routes_path()**

  Returns the full path to a routes file.
  ```php
  routes_path('web');
  ```
  **Parameters:**
  - `$path`: The path to the routes file.

- **load_env()**

  Loads environment variables from a file into $_ENV array.
  ```php
  load_env('.env');
  ```
  **Parameters:**
  - `$path`: The path to the environment file.

- **error_report()**

  Configures error reporting settings.
  ```php
  error_report();
  ```

---

### Contributing

Contributions to Pocketframe are welcome.

