<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class StudentReportCRUD extends Component
{
    // ========== STUDENT AND CLASS PROPERTIES ========== //
    public $selectedClass, $NISN;

    // ========== RULES ========== //
    protected $rules = ([
        'NISN' => ['required'],
    ]);

    // ========== LIVE VALIDATION ========== //
    public function updated($property_name)
    {
        $this->validateOnly($property_name);

        $this->emit('SetNISN', $this->NISN);
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
        $title = "Rapor Siswa";
        
        return view('livewire.admin.student-report')->layout('admin.master', compact('title'));
    }
}
