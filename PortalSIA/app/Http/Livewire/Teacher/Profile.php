<?php

namespace App\Http\Livewire\Teacher;

use Livewire\Component;

class Profile extends Component
{
    public function render()
    {
        $title = "Dashboard";

        return view('livewire.teacher.profile')->layout('teacher.master', compact('title'));
    }
}
