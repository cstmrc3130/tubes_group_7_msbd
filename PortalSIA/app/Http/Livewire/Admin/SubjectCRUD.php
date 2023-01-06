<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Subject\Subject;
use Illuminate\Support\Str;

class SubjectCRUD extends Component
{
    // ========== MODAL ATTRIBUTES ========== //
    public $name;
    public $scholYear;
    public $completeness;

    // ========== EVENT LISTENERS ========== //
    protected $listeners = ['DeleteSubject'];

    // ========== RULES ========== //
    protected $rules = ([
        "name" => ['required', "min:5"],
        "completeness" => ['required', 'integer', 'min:0', 'max:100'],
    ]);

    // ========== LIVE VALIDATION ========== //
    public function updated($property_name)
    {
        $this->validateOnly($property_name);
    }

    // ========== CONSTRUCTOR TO INITIATE ATTRIBUTES ========== //
    public function mount()
    {
        $this->schoolYear = \App\Models\SchoolYear::find(session('currentSchoolYear'))->year;
    }

    // ========== RENDER ========== //
    public function render()
    {
        $title = "Mata Pelajaran";

        return view('livewire.admin.subject-list')->layout('admin.master', compact('title'));
    }

    // ========== CREATE SUBJECT ========== //
    public function CreateNewSubjectData()
    {
        $this->validate();
        
        Subject::query()->updateOrCreate(
            [
                'name' => $this->name,
                'school_year_id' => $this->schoolYear
            ],
            [
                'id' => Str::uuid(),
                'name' => $this->name,
                'school_year_id' => session('currentSchoolYear'),
                'completeness' => $this->completeness,
            ]);

        $this->dispatchBrowserEvent('dismiss-modal');
    }

    // ========== DELETE SUBJECT ========== //
    public function DeleteSubject($subject_id)
    {
        $this->dispatchBrowserEvent('success-delete', ['data' => Subject::query()->find($subject_id)->name]);

        Subject::query()->find($subject_id)->delete();
        
        $this->emit('refreshComponent');
    }
}
