<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
                'NIP/NISN' => ['required', "max:18"],
                'password' => ['required'],
            ],
            [
                'NIP/NISN.max' => "NIP/NISN must not be greater than 18 characters!",
            ]
        );

        // TRY TO AUTHENTICATE USER WITH CREDENTIALS INPUTED
        if (Auth::attempt($credentials))
        {
            $request->session()->regenerate();

            if (auth()->user()->role == "admin")
            {
                return redirect()->intended(route("landing-page"));
            }
            else
            {
                return redirect()->intended(route('dashboard-user'));
            }
        }

        return back()->withErrors([
            'NIP/NISN' => "Invalid NIP/NISN or Password!",
            'password' => "Invalid NIP/NISN or Password!. Try again or click `Forgot password` to reset it."
        ])->onlyInput('NIP/NISN');
    }
}
