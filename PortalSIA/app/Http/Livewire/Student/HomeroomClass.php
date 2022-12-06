<?php

namespace App\Http\Livewire\Student;

use Livewire\Component;

class HomeroomClass extends Component
{
    public function render()
    {
        $title = "Homeroom Class";
        
        return view('livewire.student.homeroom-class')->layout('student.master', compact('title'));
    }
}
