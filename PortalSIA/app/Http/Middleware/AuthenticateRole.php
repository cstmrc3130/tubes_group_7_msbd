<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class AuthenticateRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$role)
    {
        // SPECIFY WHAT PAGE A USER CAN SEE BASED ON THEIR ROLE
        if(in_array($request->user()->role, $role))
        {
            return $next($request);
        }

        // CREATE A CACHE THAT LAST FOR 1 MINUTE TO INDICATE THAT A USER IS ONLINE
        if(Auth::check())
        {
            if(Auth::user()->role == 1 || Auth::user()->role == 2)
            {
                $expireDuration = now()->addMinutes(1);
                Cache::put('user-is-online' . Auth::id(), true, $expireDuration);
            }
        }

        // IF USER'S ROLE DOESN'T MATCH WITH THE MIDDLEWARE, SEND THEM TO /login TO REDIRECT AGAIN USING RedirectIfAuthenticated
        return redirect('/login');
    }
}
