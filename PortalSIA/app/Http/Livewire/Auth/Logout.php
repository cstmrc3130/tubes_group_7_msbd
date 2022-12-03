<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Logout extends Component
{
    public function Logout()
    {
        Auth::logout();

        request()->session()->invalidate();
    
        request()->session()->regenerateToken();

        return redirect()->to('/');
    }
}
