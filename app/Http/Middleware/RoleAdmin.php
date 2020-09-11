<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class RoleAdmin
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
        if (!Auth::guard('admin')->check() || Auth::guard('admin')->user()->role != 1 ) {
            return redirect()->route('admin');
        }

        return $next($request);
    }
}
