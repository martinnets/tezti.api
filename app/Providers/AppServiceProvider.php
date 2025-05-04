<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(\L5Swagger\L5SwaggerServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (config('app.env') !== 'local') {
            \URL::forceScheme('http');
        }
         // Añadir solución para X-Frame-Options
         Response::macro('withoutFrameGuard', function ($response) {
            $response->headers->set('X-Frame-Options', 'ALLOWALL');
            return $response;
        });
        
       
    }
}
