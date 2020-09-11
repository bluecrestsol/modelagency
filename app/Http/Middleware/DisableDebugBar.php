<?php

namespace App\Http\Middleware;

use Auth;
use Debugbar;
use Closure;

class DisableDebugBar
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
        if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->role == 1) {
            Debugbar::enable();
        } else {
            Debugbar::disable();
        }

        return $next($request);
    }
}
