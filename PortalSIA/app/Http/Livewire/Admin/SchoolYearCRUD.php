<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\SchoolYear;
use Illuminate\Support\Str;

class SchoolYearCRUD extends Component
{
    // ========== SCHOOL YEAR ATTRIBUTES ========== //
    public $year;

    // ========== RULES ========== //
    protected $rules = ([
        "year" => ['required', "regex:/^([0-9]){4}\/[0-9]{4}$/"],
    ]);

    // ========== MASS ASSIGNABLE ATTRIBUTES ========== //
    protected function updated($property_name)
    {
        $this->validateOnly($property_name);
    }
    
    // ========== RENDER ========== //
    public function render()
    {
        $title = "Tahun Ajaran";

        return view('livewire.admin.school-year')->layout('admin.master', compact('title'));
    }

    // ========== CREATE SCHOOL YEAR ========== //
    public function CreateSchoolYearData()
    {
        $this->validate();
        
        SchoolYear::query()->updateOrCreate(
            [
                'year' => $this->year
            ],
            [
                'id' => Str::uuid(),
                'year' => $this->year
            ]
        );

        $this->dispatchBrowserEvent('success-create-school-year');
    }
}
