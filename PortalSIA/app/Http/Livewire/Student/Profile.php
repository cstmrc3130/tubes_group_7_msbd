<?php

namespace App\Http\Livewire\Student;

use Livewire\Component;

class Profile extends Component
{
    public function render()
    {
        $title = "Profile";
        
        return view('livewire.student.profile')->layout('student.master', compact('title'));
    }
}
