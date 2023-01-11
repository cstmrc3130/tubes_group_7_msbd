<?php

namespace App\Http\Livewire\Student;

use Livewire\Component;
use App\Models\SchoolYear;
use App\Models\Student\HomeroomClass as StudentHomeroomClass;
use App\Models\Student\Student;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class HomeroomClass extends Component
{
    use WithPagination;

    public $selectedSchoolYear, $homeroomTeacherName, $studentHomeroomClass;

    protected $paginationTheme = "bootstrap";

    public function mount()
    {
        $this->selectedSchoolYear = session('currentSchoolYear');

        $this->studentHomeroomClass = StudentHomeroomClass::query()->where('NISN', Auth::user()->NISN)->where('school_year_id', $this->selectedSchoolYear)->join("classes", "student_homeroom_classes.homeroom_class_id", '=', 'classes.id')->value('classes.id');

        $this->homeroomTeacherName = \App\Models\Teacher\HomeroomClass::query()->where('school_year_id', $this->selectedSchoolYear)->where('homeroom_class_id', $this->studentHomeroomClass)->join('teachers', 'teachers.NIP', '=', 'teacher_homeroom_classes.NIP')->value('teachers.name');
    }

    public function updated()
    {
        $this->studentHomeroomClass = StudentHomeroomClass::query()->where('NISN', Auth::user()->NISN)->where('school_year_id', $this->selectedSchoolYear)->join("classes", "student_homeroom_classes.homeroom_class_id", '=', 'classes.id')->value('classes.id');

        $this->homeroomTeacherName = \App\Models\Teacher\HomeroomClass::query()->where('school_year_id', $this->selectedSchoolYear)->where('homeroom_class_id', $this->studentHomeroomClass)->join('teachers', 'teachers.NIP', '=', 'teacher_homeroom_classes.NIP')->value('teachers.name');
    }

    public function render()
    {
        $title = "Informasi Kelas";
        
        return view('livewire.student.homeroom-class')->layout('student.master', compact('title'));
    }
}
