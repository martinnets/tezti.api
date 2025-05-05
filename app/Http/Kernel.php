<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [
        // otros middlewares...
        \App\Http\Middleware\Cors::class,
    ];
    // protected $routeMiddleware = [
    //     // otros middlewares...
    //     'no-frame-header' => \App\Http\Middleware\RemoveXFrameOptions::class,
    // ];
    protected $middlewareGroups = [
        'web' => [
            // Middleware web existentes...
        ],
        'api' => [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];
}
