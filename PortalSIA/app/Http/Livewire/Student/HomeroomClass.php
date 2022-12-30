<?php

namespace App\Http\Livewire\Student;

use Livewire\Component;
use App\Models\SchoolYear;
use App\Models\Student\HomeroomClass as StudentHomeroomClass;
use App\Models\Student\Student;
use Illuminate\Support\Facades\Auth;

class HomeroomClass extends Component
{
    public $homeroomClassName;
    public $homeroomClassSemester;
    public $homeroomClassStudent;

    public function mount()
    {
        if (auth()->user()->student->homeroomclass != NULL)
        {
            $this->homeroomClassName = Auth::user()->student->homeroomclass->classroom->name;
            $this->homeroomClassSemester = SchoolYear::query()->find(session('currentSchoolYear'))->semester;
            $this->homeroomClassStudent = StudentHomeroomClass::query()->where('homeroom_class_id', auth()->user()->student->homeroomclass->classroom->id)->count();
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
