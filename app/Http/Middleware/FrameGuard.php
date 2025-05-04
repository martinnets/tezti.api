<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FrameGuard
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
        
        // Permitir que la página se cargue en cualquier iframe
        $response->headers->set('X-Frame-Options', 'ALLOWALL');
        
        // Alternativa: permitir solo desde dominios específicos
        // $response->headers->set('X-Frame-Options', 'ALLOW-FROM https://ejemplo.com');
        
        return $response;
    }
}