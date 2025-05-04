<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserIsActive
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user() || !$request->user()->is_active) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Tu usuario no se encuentra activo.',
                ], Response::HTTP_FORBIDDEN);
            }
        }

        return $next($request);
    }
}
