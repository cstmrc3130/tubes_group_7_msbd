<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\SchoolYear;
use Illuminate\Support\Str;

class SchoolYearCRUD extends Component
{
    // ========== SCHOOL YEAR ATTRIBUTES ========== //
    public $year, $semester;

    // ========== EVENT LISTENERS ========== //
    protected $listeners = ['DeleteSchoolYear'];

    // ========== RULES ========== //
    protected $rules = ([
        "year" => ['required', "regex:/^([0-9]){4}\/[0-9]{4}$/"],
        'semester' => 'required|in:"Ganjil", "Genap"',
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
                'year' => $this->year,
                'semester' => $this->semester
            ],
            [
                'id' => Str::uuid(),
                'year' => $this->year,
                'semester' => $this->semester
            ]
        );

        $this->dispatchBrowserEvent('success-create-school-year');
    }

    // ========== DELETE SCHOOL YEAR ========== //
    public function DeleteSchoolYear($year, $semester)
    {
        try
        {
            SchoolYear::query()->where('year', $year)->where('semester', $semester)->delete();
            $this->dispatchBrowserEvent('success-delete', ['data' => $year]);
        }
        catch (\Illuminate\Database\QueryException $ex)
        {
            $this->dispatchBrowserEvent("data-already-filled");
        }
    }
}
