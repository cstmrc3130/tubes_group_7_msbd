<?php

namespace App\Http\Livewire\Student;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public function render()
    {
        $title = "Dashboard";

        return view('livewire.student.dashboard')->layout('student.master', compact('title'));
    }
}
