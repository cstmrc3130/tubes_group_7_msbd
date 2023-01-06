<?php

namespace App\Http\Livewire\Teacher;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use App\Models\AbsentRecapitulation;
use Illuminate\Support\Facades\Auth;

class HomeroomClass extends Component
{
    use WithPagination;

    // ========== CARD ATTRIBUTES ========== //
    public $selectedSchoolYear, $selectedClass, $description, $date, $NISN;

    // ========== RULES ========== //
    protected $rules = ([
        'selectedSchoolYear' => ['required'],
        'description' => ['required', 'in:"S", "I", "A"'],
        'date' => ['required', 'date'],
        'NISN' => ["required"]
    ]);

    // ========== EVENT LISTENERS ========== //
    protected $listeners = ['ChangeStudentHomeroomClass'];

    // ========== PAGINATION THEME ========== //
    protected $paginationTheme = "bootstrap";

    // ========== LIVE VALIDATION ========== //
    public function updated($property_name)
    {
        $this->validateOnly($property_name);

        $this->selectedClass = \App\Models\Teacher\HomeroomClass::query()->where('NIP', Auth::user()->NIP)->where('school_year_id', $this->selectedSchoolYear)->join("classes", "teacher_homeroom_classes.homeroom_class_id", '=', 'classes.id')->value('classes.id');
    }

    // ========== CONSTRUCTOR TO INITIATE ATTRIBUTES ========== //
    public function mount()
    {
        $this->date = date('Y-m-d');
    }

    // ========== RENDER ========== //
    public function render()
    {
        $title = "Info Kelas";

        return view('livewire.teacher.homeroom-class')->layout('teacher.master', compact('title'));
    }

    // ========== CONFIGURE ABSENT MODAL ========== //
    public function ConfigureModal($NISN)
    {
        $this->NISN = $NISN;

        $this->dispatchBrowserEvent('configure-absent-modal', ['name' => \App\Models\Student\Student::query()->where('NISN', $NISN)->value('name')]);
    }

    // ========== CREATE OR UPDATE ABSENT ========== //
    public function CreateOrUpdateAbsent()
    {
        $this->validate();

        AbsentRecapitulation::query()->updateOrCreate(
            [
                'NISN' => $this->NISN,
                'school_year_id' => session('tempSchoolYear')
            ],
            [
                'NISN' => $this->NISN,
                'id' => Str::uuid(),
                'school_year_id' => session('tempSchoolYear'),
                'type' => $this->description,
                'date' => date('Y-m-d')
            ]
        );

        $this->dispatchBrowserEvent('success-submit-absent');
    }

    // ========== DELETE ABSENT ========== //
    public function DeleteAbsentRecord($id)
    {
        try
        {
            AbsentRecapitulation::query()->find($id)->delete();
        }
        catch (\Illuminate\Database\QueryException $ex)
        {
            dd("Waduh Error Bro!");
        }
    }
}
