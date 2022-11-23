<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    // ========== SHOW LOGIN FORM ========== //
    public function DisplayForm()
    {
        return view('auth/login');
    }

    // ========== AUTHENTICATION PROCESS ========== //
    public function Login(Request $request)
    {
        $credentials = $request->validate(
            [
                'NIP/NISN' => ['required', 'regex:(gmail)'],
                'password' => ['required'],
            ],
        );

        // TRY TO AUTHENTICATE USER WITH CREDENTIALS INPUTED
        if (Auth::attempt($credentials))
        {
            $request->session()->regenerate();

            if (auth()->user()->is_admin == true)
            {
                return redirect()->intended(route('dashboard-admin'));
            }
            else
            {
                return redirect()->intended(route('dashboard-user'));
            }
        }

        return back()->withErrors([
            'NIP/NISN' => "Wrong email or password. Make sure your capslock is turned off.",
            'password' => "Wrong email or password. Try again or click `Forgot password` to reset it."
        ])->onlyInput('NIP/NISN');
    }
}
