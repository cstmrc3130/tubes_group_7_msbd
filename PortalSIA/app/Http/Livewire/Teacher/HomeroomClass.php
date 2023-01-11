<?php

namespace App\Http\Livewire\Teacher;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use App\Models\AbsentRecapitulation;
use App\Models\SchoolYear;
use App\Models\Student\HomeroomClass as StudentHomeroomClass;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeroomClass extends Component
{
    use WithPagination;

    // ========== CARD ATTRIBUTES ========== //
    public $selectedSchoolYear, $absentSchoolYear, $promoteSchoolYear, $selectedClass, $newClass, $description, $date, $NISN;

    // ========== RULES ========== //
    protected $rules = ([
        'selectedSchoolYear' => ['required'],
        'description' => ['required', 'in:"S", "I", "A"'],
        'newClass' => ['required'],
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
        $this->absentSchoolYear = session('tempSchoolYear');
    }

    // ========== RENDER ========== //
    public function render()
    {
        $title = "Info Kelas";

        return view('livewire.teacher.homeroom-class')->layout('teacher.master', compact('title'));
    }

    // ========== CONFIGURE ABSENT MODAL ========== //
    public function ConfigureModal($NISN, $school_year_id)
    {
        $this->NISN = $NISN;
        $this->absentSchoolYear = $school_year_id;

        $this->dispatchBrowserEvent('configure-absent-modal', ['name' => \App\Models\Student\Student::query()->where('NISN', $NISN)->value('name')]);
    }

    // ========== CONFIGURE ABSENT MODAL ========== //
    public function ConfigurePromoteModal($NISN)
    {
        $this->NISN = $NISN;
        $this->promoteSchoolYear = \App\Models\SchoolYear::where('semester', 'Ganjil')->orderBy('year', 'desc')->value('year');

        $this->dispatchBrowserEvent('configure-promote-modal', ['name' => \App\Models\Student\Student::query()->where('NISN', $NISN)->value('name')]);
    }

    // ========== CREATE OR UPDATE ABSENT ========== //
    public function PromoteStudent()
    {
        $this->validateOnly('newClass');

        DB::beginTransaction();

        try
        {
            StudentHomeroomClass::query()->updateOrCreate(
                [
                    'NISN' => $this->NISN,
                    'homeroom_class_id' => $this->newClass,
                    'school_year_id' => \App\Models\SchoolYear::where('semester', 'Ganjil')->orderBy('year', 'desc')->value('id'),
                ],
                [
                    'id' => Str::uuid(),
                    'NISN' => $this->NISN,
                    'homeroom_class_id' => $this->newClass,
                    'school_year_id' => \App\Models\SchoolYear::where('semester', 'Ganjil')->orderBy('year', 'desc')->value('id'),
                ]
                );
                
            DB::commit();

            $this->dispatchBrowserEvent('success-promote-student');
        }
        catch(\Exception $msg)
        {
            DB::rollBack();
        }
    }

    // ========== CREATE OR UPDATE ABSENT ========== //
    public function CreateOrUpdateAbsent()
    {
        $this->validate();

        AbsentRecapitulation::query()->updateOrCreate(
            [
                'NISN' => $this->NISN,
                'school_year_id' => session('tempSchoolYear'),
                'date' => date('Y-m-d')
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
