<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Laravel\Sanctum\Sanctum;

class EnsureFrontendRequestsAreStateful
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  callable  $next
     * @return \Illuminate\Http\Response
     */
    public function handle(Request $request, $next)
    {
        $this->configureSecureCookies($request);

        return $next($request);
    }

    /**
     * Configure secure cookie sessions.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function configureSecureCookies(Request $request)
    {
        if ($this->requestFromStatefulDomain($request)) {
            config([
                'session.http_only' => true,
                'session.same_site' => 'lax',
            ]);
        }
    }

    /**
     * Determine if the request is from a stateful domain.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function requestFromStatefulDomain(Request $request)
    {
        $domain = $request->headers->get('referer') 
                  ? parse_url($request->headers->get('referer'), PHP_URL_HOST) 
                  : $request->headers->get('origin');

        $statefulDomains = config('sanctum.stateful', []);

        return in_array($domain, $statefulDomains) || 
               in_array($request->getHost(), $statefulDomains);
    }
}