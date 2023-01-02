<?php

namespace App\Http\Livewire\Admin;

use App\Models\Student\HomeroomClass as StudentHomeroomClass;
use App\Models\Teacher\HomeroomClass as TeacherHomeroomClass;
use Livewire\Component;
use Livewire\WithPagination;

class ClassCRUD extends Component
{
    use WithPagination;

    // ========== CARD ATTRIBUTES ========== //
    public $selectedClass, $selectedHomeroomTeacher, $newClass, $NISN;

    // ========== RULES ========== //
    protected $rules = ([
        'selectedClass' => ['required'],
    ]);

    // ========== EVENT LISTENERS ========== //
    protected $listeners = ['ChangeStudentHomeroomClass'];

    // ========== PAGINATION THEME ========== //
    protected $paginationTheme = "bootstrap";

    // ========== LIVE VALIDATION ========== //
    public function updated($property_name)
    {
        $this->validateOnly($property_name);
    }

    // ========== RENDER ========== //
    public function render()
    {
        $title = "Data Kelas";

        return view('livewire.admin.class-list')->layout('admin.master', compact('title'));
    }

    // ========== CONFIGURE MODAL BY SENDING EVENT TO JS ========== //
    public function ConfigureStudentModal($NISN, $class_id)
    {
        $this->NISN = $NISN;

        $this->dispatchBrowserEvent('configure-student-homeroom-class', ['NISN' => $NISN, 'name' => \App\Models\Student\Student::query()->where('NISN', $NISN)->value('name'), 'class' => $class_id]);
    }

    // ========== CHANGE STUDENT HOMEROOM CLASS ========== //
    public function ChangeStudentHomeroomClass()
    {
        $this->dispatchBrowserEvent("success-change-student-homeroom-class", ['name' => \App\Models\Student\Student::query()->where('NISN', $this->NISN)->value('name')]);

        StudentHomeroomClass::query()->where('NISN', $this->NISN)->update(['homeroom_class_id' => $this->newClass]);
    }

    // ========== CHANGE STUDENT HOMEROOM TEACHER ========== //
    public function ChangeStudentHomeroomTeacher()
    {
        $this->dispatchBrowserEvent("success-change-student-homeroom-teacher", ['name' => \App\Models\Teacher\Teacher::query()->where('NIP', $this->selectedHomeroomTeacher)->value('name')]);

        TeacherHomeroomClass::query()->where('homeroom_class_id', $this->selectedClass)->where('school_year_id', session('currentSchoolYear'))->update(['NIP' => $this->selectedHomeroomTeacher]);

        $this->selectedHomeroomTeacher = null;
    }
}
