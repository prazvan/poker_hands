<?php

namespace App\Http\Middleware;

use Closure;
use Fideloper\Proxy\TrustProxies as Middleware;
use Illuminate\Support\Facades\App;

class HttpsProtocolMiddleware extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->secure() && app()->environment('production')) {
            return redirect()->secure($request->getRequestUri());
        }

        return $next($request);
    }
}