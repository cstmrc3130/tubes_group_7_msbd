<?php

namespace App\Http\Livewire\Student;

use App\Models\SchoolYear;
use Livewire\Component;

class Report extends Component
{
    public $selectedSchoolYear, $selectedSemester;

    protected $rules = [
        'selectedSchoolYear' => ['required'],
        'selectedSemester' => ['required']
    ];
    
    public function mount()
    {
        $this->selectedSchoolYear = SchoolYear::query()->find(session('currentSchoolYear'));
    }

    public function updatedSelectedSemester()
    {
        session()->put('selectedSemester', SchoolYear::query()->find($this->selectedSemester)->semester);
    }

    public function render()
    {
        $title = "Rapor Semester";
        
        return view('livewire.student.report')->layout('student.master', compact('title'));
    }
}
