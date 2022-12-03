<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public function render()
    {
        $title = "Dashboard";

        return view('livewire.admin.dashboard')->layout('admin.dashboard', compact('title'));
    }
}
