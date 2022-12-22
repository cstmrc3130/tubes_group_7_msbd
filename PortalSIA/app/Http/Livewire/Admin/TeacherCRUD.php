<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use App\Models\Teacher\Teacher;

class TeacherCRUD extends Component
{
    // ========== MODAL ATTRIBUTES ========== //
    public $name;
    public $placeOfBirth;
    public $dateOfBirth;
    public $address;
    public $graduatedAt;
    public $graduatedFrom;
    public $startedWorkingAt;
    public $NIP;
    public $phoneNumber;
    public $gender;
    public $position;
    public $KARPEG;
    public $homeroomClass;

    // ========== EVENT LISTENERS ========== //
    protected $listeners = ['DeleteTeacher', 'refreshComponent' => '$refresh'];

    // ========== RULES ========== //
    protected $rules = ([
        "name" => ['required', "min:5"],
        "placeOfBirth" => ['required', 'string', 'max:20'],
        "dateOfBirth" => ['required', 'date_format:Y-m-d', 'before:20 years ago', 'after:65 years ago'],
        'address' => ['required', 'string', "max:255"],
        "graduatedAt" => ['required', 'integer', 'min:1950', 'max:2010', 'digits:4'],
        "graduatedFrom" => ['required', 'string', 'min:2', 'max:50'],
        "startedWorkingAt" => ['required', 'integer', 'min:1980', 'max:2022', 'digits:4'],
        "NIP" => ['required', "regex:/^[0-9]{18}$/", 'unique:teachers'],
        "phoneNumber" => 'required|numeric|min:12',
        "gender" => ['required', 'in:"M", "F"'],
        'position' => 'required|string|max:20',
        'KARPEG' => 'required|regex:/^([a-zA-Z]){1}\.[0-9]{6}$/',
        "homeroomClass" => ['required'],
    ]);

    // ========== CUSTOM :ATTRIBUTES ========== //
    protected $validationAttributes = ([
        'NIP' => 'NIP',
        'KARPEG' => 'KARPEG'
    ]);

    // ========== LIVE VALIDATION ========== //
    public function updated($property_name)
    {
        $this->validateOnly($property_name);
    }

    // ========== RENDER ========== //
    public function render()
    {
        $title = "Data Guru";
        
        return view('livewire.admin.teacher-list')->layout('admin.master', compact('title'));
    }

    // ========== CREATE TEACHER ACCOUNT ========== //
    public function CreateNewTeacherData()
    {
        $this->validate();
        
        Teacher::create([
            'name' => $this->name,
            'place_of_birth' => $this->placeOfBirth,
            'date_of_birth' => $this->dateOfBirth,
            'graduated_from' => $this->graduatedFrom,
            'graduated_at' => $this->graduatedAt,
            'started_working_at' => $this->startedWorkingAt,
            'address' => $this->address,
            "NIP" => $this->NIP,
            "phone_numbers" => $this->phoneNumber,
            "gender" => $this->gender,
            'position' => $this->position,
            'KARPEG' => $this->KARPEG,
            "homeroom_class_id" => $this->homeroomClass,
        ]);

        $this->dispatchBrowserEvent('dismiss-modal');
    }

    // ========== DELETE TEACHER ACCOUNT ========== //
    public function DeleteTeacher($NIP)
    {
        User::query()->where('NIP', $NIP)->delete();
        Teacher::query()->find($NIP)->delete();
        
        $this->emit('refreshComponent');

        $this->dispatchBrowserEvent('success-delete', ['data' => $NIP]);
    }
}
