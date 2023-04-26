<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle($request, Closure $next)
    {


        // Check if the request method is OPTIONS
        $response = $next($request)->header('Access-Control-Allow-Origin', '*');


        return $response;
    }
}
