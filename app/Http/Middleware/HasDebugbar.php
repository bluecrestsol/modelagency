<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Debugbar;

class HasDebugbar
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
        // config(['app.debug' => false]);
        Debugbar::disable();

        if (auth('admin')->check() && auth('admin')->user()->role == 1) {
            // config(['app.debug' => true]);
            Debugbar::enable();
        }

        return $next($request);
    }
}
