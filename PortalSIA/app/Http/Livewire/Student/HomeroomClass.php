<?php

namespace App\Http\Livewire\Student;

use App\Models\Student\Student;
use Livewire\Component;

class HomeroomClass extends Component
{
    public $homeroomClassName;
    public $homeroomClassSemester;
    public $homeroomClassStudent;

    public function mount()
    {
        if (auth()->user()->student->homeroom_class_id != NULL)
        {
            $this->homeroomClassName = Auth::user()->student->homeroomclass->name;
            $this->homeroomClassSemester = Auth::user()->student->homeroomclass->semester;
            $this->homeroomClassStudent = Student::query()->where('homeroom_class_id', auth()->user()->student->homeroomclass->id)->count();
        } 
        else
        {
            $this->fill(['homeroomClassName' => 'Data is not set yet.', 'homeroomClassSemester' => 'Data is not set yet.', 'homeroomClassStudent' => 'Data is not set yet.']);
        }
    }

    public function render()
    {
        $title = "Informasi Kelas";
        
        return view('livewire.student.homeroom-class')->layout('student.master', compact('title'));
    }
}
