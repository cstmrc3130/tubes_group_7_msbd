<?php

namespace App\Http\Livewire;

use App\Models\News;
use Livewire\Component;

class AllNews extends Component
{
    // ========== RENDER ========== //
    public function render()
    {
        $allNews = News::all()->take(3);

        return view('livewire.news', compact('allNews'))->layout('landing-page', ['title' => 'Berita']);
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
