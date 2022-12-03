<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

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

        // IF USER'S ROLE DOESN'T MATCH WITH THE MIDDLEWARE, SEND THEM TO /login TO REDIRECT AGAIN USING RedirectIfAuthenticated
        return redirect('/login');
    }
}
