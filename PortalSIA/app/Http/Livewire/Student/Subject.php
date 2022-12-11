<?php

namespace App\Http\Livewire\Student;

use Livewire\Component;

class Subject extends Component
{
    public function render()
    {
        $title = "Homeroom Class";
        
        return view('livewire.student.subject')->layout('student.master', compact('title'));
    }
}
