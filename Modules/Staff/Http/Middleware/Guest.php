<?php

namespace Modules\Staff\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Guest {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = 'staff') {
        if (!Auth::guard($guard)->guest()) {
            return redirect()->route('staff-dashboard');
        }
        return $next($request);
    }

}
