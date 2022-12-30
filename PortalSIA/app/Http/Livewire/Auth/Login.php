<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class Login extends Component
{
    public $username, $password, $remember = false;

    // ========== RULES ========== //
    protected $rules = ([
        'username' => ['required', "max:30"],
        'password' => ['required'],
    ]);

    // ========== RENDER ========== //
    public function render()
    {
        return view('livewire.auth.login')->layout('auth.master');
    }

    // ========== LOGIN ========== //
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
        if (Auth::attempt(['NISN' => $this->username, 'password' => $this->password]) || Auth::attempt(['NIP' => $this->username, 'password' => $this->password]) || Auth::attempt(['email' => $this->username, 'password' => $this->password]))
        {
            // SET CURRENT SCHOOL YEAR TO THE LATEST RECORD
            session()->put('currentSchoolYear', \App\Models\SchoolYear::orderBy('year', 'desc')->value('id'));
            
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

        // INCREMENTING RATE LIMITER BY 1
        RateLimiter::hit($throttleKey);

        // IF username OR password IS WRONG, THROW AN ERROR TO THE FORM
        $this->addError('username', __('auth.failed'));
        $this->addError('password', __('auth.password'));
    }
}
