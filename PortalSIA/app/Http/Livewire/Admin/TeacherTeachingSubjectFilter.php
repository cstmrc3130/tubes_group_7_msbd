<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class TeacherTeachingSubjectFilter extends Component
{
    // ========== CARD ATTRIBUTES ========== //
    public $selectedSubject, $selectedClass;

    // ========== EVENT LISTENERS ========== //
    protected $listeners = [];

    // ========== RULES ========== //
    protected $rules = ([
        'selectedSubject' => ['required'],
        'selectedClass' => ['required'],
    ]);

    // ========== LIVE VALIDATION ========== //
    public function updated($property_name)
    {
        $this->validateOnly($property_name);
    }

    // ========== CUSTOM :ATTRIBUTES ========== //
    protected $validationAttributes = ([
        'NIP' => 'NIP'
    ]);

    // ========== RENDER ========== //
    public function render()
    {
        $title = "Filter Mata Pelajaran Guru";

        return view('livewire.admin.teacher-teaching-subject-filter')->layout('admin.master', compact('title'));
    }
}
