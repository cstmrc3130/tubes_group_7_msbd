<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\RateLimiter;

class Login extends Component
{
    public $username, $password, $remember = false;

    protected $rules = ([
        'username' => ['required', "max:18"],
        'password' => ['required'],
    ]);

    // ========== AUTHENTICATION PROCESS ========== //
    public function Login()
    {
        $throttleKey = strtolower($this->username) . '|' . request()->ip();

        $this->validate();

        // THROW AN ERROR IF USER MADE TOO MANY ATTEMPTS OF WRONG CREDENTIALS
        if (RateLimiter::tooManyAttempts($throttleKey, 5))
        {
            $this->addError('username', __('auth.throttle', [
                'seconds' => RateLimiter::availableIn($throttleKey)
            ]));

            return NULL;
        }

        // TRY TO AUTHENTICATE USER WITH CREDENTIALS INPUTED
        if (Auth::attempt(['username' => $this->username, 'password' => $this->password]))
        {
            if (auth()->user()->role == 0)
            {
                return redirect()->intended(route("landing-page"));
            }
            else
            {
                return redirect()->intended(route('dashboard-user'));
            }
        } 

        // INCREASE THROTTLE KEY VALUE
        RateLimiter::hit($throttleKey);

        // IF username OR password IS WRONG, THROW AN ERROR TO THE FORM
        $this->addError('username', __('auth.failed'));
        $this->addError('password', __('auth.password'));
    }

    // ========== RENDER LOGIN FORM ========== //
    public function render()
    {
        return view('livewire.auth.login')->layout('auth.login');
    }
}
