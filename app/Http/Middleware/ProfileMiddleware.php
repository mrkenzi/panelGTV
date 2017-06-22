<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class ProfileMiddleware
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
        /*if (Auth::user()->hasPermissionTo('userInfo')) {
            return redirect()->route('home');
        }*/

        if ($request->is('profile/*/edit')) {
            if (!Auth::user()->hasPermissionTo('userInfo')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        return $next($request);
    }
}
