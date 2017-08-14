<?php
namespace Crumby\CanonicalHreflang\Middleware;

use Closure;
use Illuminate\Routing\Redirector;

class CanonicalHreflangMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        \CanonicalHreflang::addCanonicalHreflang();
        return $next($request);;
    }
}
