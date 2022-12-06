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

        foreach ($guards as $guard)
        {
            if (Auth::guard($guard)->check())
            {
                // REDIRECT AUTHENTICATED GUESTS TO THEIR DASHBOARD
                if (auth()->user()->role == 0)
                {
                    return redirect()->intended(route('admin.dashboard'));
                }
                else if (auth()->user()->role == 1)
                {
                    return redirect()->intended(route('teacher.dashboard'));
                }
                else
                {
                    return redirect()->intended(route('student.dashboard'));
                }
            }
        }

        return $next($request);
    }
}
