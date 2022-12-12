<?php

namespace App\Http\Livewire\Student;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class Dashboard extends Component
{
    protected $listeners = ['EndUserSession'];

    public function render()
    {
        $title = "Dashboard";

        return view('livewire.student.dashboard')->layout('student.master', compact('title'));
    }
}
