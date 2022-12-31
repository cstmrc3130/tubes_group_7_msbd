<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Student\TakingExtracurricular;

class StudentTakingExtracurricularCRUD extends Component
{
    // ========== STUDENT AND CLASS PROPERTIES ========== //
    public $selectedClass, $NISN, $extracurricular;

    // ========== RULES ========== //
    protected $rules = ([
        'NISN' => ['required'],
        'extracurricular' => ['required']
    ]);

    // ========== LIVE VALIDATION ========== //
    public function updated($property_name)
    {
        $this->validateOnly($property_name);
    }

    // ========== LIVE VALIDATION FOR SELECTED CLASS ========== //
    public function updatedSelectedClass()
    {
        $this->NISN = null;
    }

    // ========== CUSTOM :ATTRIBUTES ========== //
    protected $validationAttributes = ([
        'NISN' => 'NISN'
    ]);

    // ========== RENDER ========== //
    public function render()
    {
        $title = "Ekstrakurikuler Siswa";

        return view('livewire.admin.student-taking-extracurricular')->layout('admin.master', compact('title'));
    }

    // ========== UPDATE OR CREATE EXTRACURRICULAR ========== //
    public function UpdateOrCreateRecords()
    {
        $this->validate();

        TakingExtracurricular::query()->updateOrCreate(
            [
                'NISN' => $this->NISN,
                'extracurricular_id' => $this->extracurricular,
                'school_year_id' => session('currentSchoolYear'),
            ],
            [
                'id' => Str::uuid(),
                'NIP' => $this->NISN,
                'extracurricular_id' => $this->extracurricular,
                'school_year_id' => session('currentSchoolYear'),
            ]
        );
    }

    // ========== DELETE EXTRACURRICULAR ========== //
    public function DeleteRecord($id)
    {
        TakingExtracurricular::query()->find($id)->delete();
    }
}
