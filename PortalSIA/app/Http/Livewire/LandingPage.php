<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class LandingPage extends Component
{
    // ========== LOGGING OUT WITHOUT RELOAD ========== //
    public function Logout()
    {
        Auth::logout();

        request()->session()->invalidate();
    
        request()->session()->regenerateToken();

        return NULL;
    }

    // ========== RENDER LANDING PAGE ========== //
    public function render()
    {
        return view('livewire.landing-page')->layout('landing-page');
    }
}
