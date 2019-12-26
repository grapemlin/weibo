<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
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
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $message = $request->is('signup') ? '您已注册并已登陆':'您已登陆，无需再次操作';
            session()->flash('info', $message);
            return redirect('/');
        }

//        if (Auth::guard($guard)->check()) {
//            return redirect(RouteServiceProvider::HOME);
//        }

        return $next($request);
    }
}
