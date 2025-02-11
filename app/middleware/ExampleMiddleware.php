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
