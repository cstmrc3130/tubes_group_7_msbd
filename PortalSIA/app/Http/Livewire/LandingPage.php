<?php

namespace App\Http\Livewire;

use App\Models\News;
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
        $allNews = News::all()->take(3);

        return view('livewire.landing-page', compact('allNews'))->layout('landing-page', ['title' => 'Landing Page']);
    }
}
