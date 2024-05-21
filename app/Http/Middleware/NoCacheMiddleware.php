<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class NoCacheMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Add headers to prevent caching
        $response->header("Cache-Control", "no-store, no-cache, must-revalidate, max-age=0");
        $response->header("Cache-Control", "post-check=0, pre-check=0", false);
        $response->header("Pragma", "no-cache");

        return $response;
    }
}