<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomFrameGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        
        $frameOption = config('frame.options', 'ALLOWALL');
        $response->headers->set('X-Frame-Options', $frameOption);
        
        return $response;
    }
}