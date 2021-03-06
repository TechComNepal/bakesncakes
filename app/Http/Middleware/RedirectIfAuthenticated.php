<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user=auth()->user();

                if ($user->hasRole('admin')) {
                    return redirect()->intended(route('admin.dashboard'));
                }

                if ($user->hasRole('user')) {
                    return redirect()->intended(route('user.dashboard'));
                }
                if ($user->hasRole('vendor')) {
                    return redirect()->intended(route('vendor.dashboard'));
                }


                //return redirect(RouteServiceProvider::HOME);
                return redirect()->intended(route('employee.dashboard'));
            }
        }

        return $next($request);
    }
}
