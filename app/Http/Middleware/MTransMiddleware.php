<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class MTransMiddleware
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
        if (!Auth::user()->hasPermissionTo('transManager')) {
            return redirect()->route('home');
        }
        if ($request->is('trans-manager/q')) {
            if (!Auth::user()->hasPermissionTo('transManager')) {
                abort('401');
            } else {
                return $next($request);
            }
        }
        return $next($request);
    }
}
