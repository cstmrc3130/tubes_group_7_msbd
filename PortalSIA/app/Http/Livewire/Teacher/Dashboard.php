<?php

namespace App\Http\Livewire\Teacher;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public function render()
    {
        $title = "Dashboard";

        return view('livewire.teacher.dashboard')->layout('teacher.master', compact('title'));
    }
}
