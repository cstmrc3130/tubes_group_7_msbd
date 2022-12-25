<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SchoolProfile extends Component
{
    // ========== RENDER ========== //
    public function render()
    {
        return view('livewire.school-profile')->layout('landing-page', ['title' => 'Profil Sekolah']);
    }

    // ========== LOGGING OUT WITHOUT RELOAD ========== //
    public function Logout()
    {
        Auth::logout();

        request()->session()->invalidate();
    
        request()->session()->regenerateToken();

        return NULL;
    }
}
