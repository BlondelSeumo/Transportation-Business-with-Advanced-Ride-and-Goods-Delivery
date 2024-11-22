<?php

namespace App\Http\Middleware;

use Closure;
use App\Base\Constants\Auth\Role;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'web')
    {

        if (Auth::guard($guard)->check()) {

            // dd(Auth::guard($guard)->user());
            if (Auth::guard($guard)->user()->hasRole(Role::DISPATCHER)) {
                return redirect('/dispatch/home');
            } else  if (Auth::guard($guard)->user()->hasRole(Role::DELIVERY_DISPATCHER)) {
                return redirect('/delivery-dispatch/dashboard');
            }
            return redirect('/dashboard');
        } 

        return $next($request);
    }
}
