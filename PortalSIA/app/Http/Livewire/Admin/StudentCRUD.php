<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use App\Models\Student\Student;
use App\Models\Teacher\Teacher;

class StudentCRUD extends Component
{
    // ========== MODAL ATTRIBUTES ========== //
    public $name;
    public $placeOfBirth;
    public $dateOfBirth;
    public $address;
    public $fatherName;
    public $motherName;
    public $guardianName;
    public $NISN;
    public $phoneNumber;
    public $gender;
    public $entryYear;
    public $status;
    public $specialNeeds;
    public $homeroomClass;

    // ========== EVENT LISTENERS ========== //
    protected $listeners = ['DeleteStudent'];

    // ========== RULES ========== //
    protected $rules = ([
        "name" => ['required', "min:5"],
        "placeOfBirth" => ['required', 'string', 'max:20'],
        "dateOfBirth" => ['required', 'date_format:Y-m-d', 'before:12 years ago', 'after:17 years ago'],
        'address' => ['required', 'string', "max:255"],
        "fatherName" => ['string', 'min:5', 'max:50', 'nullable'],
        "motherName" => ['string', 'min:5', 'max:50', 'nullable'],
        "guardianName" => ['string', 'min:5', 'max:50', 'nullable'],
        "NISN" => ['required', "regex:/^[0-9]{9}$/", 'unique:students'],
        "phoneNumber" => 'required|numeric|min:12',
        "gender" => ['required', 'in:"M", "F"'],
        'status' => 'required|in:"A", "I"',
        'specialNeeds' => 'required|in:"E", "NE"',
        "entryYear" => ['required', 'integer', 'min:1900', 'max:2022', 'digits:4'],
        "homeroomClass" => ['required'],
    ]);

    // ========== CUSTOM :ATTRIBUTES ========== //
    protected $validationAttributes = ([
        'NISN' => 'NISN'
    ]);

    // ========== LIVE VALIDATION ========== //
    public function updated($property_name)
    {
        $this->validateOnly($property_name);
    }

    // ========== RENDER ========== //
    public function render()
    {
        $title = "Data Siswa";
        
        return view('livewire.admin.student-list')->layout('admin.master', compact('title'));
    }

    // ========== CREATE STUDENT ACCOUNT ========== //
    public function CreateNewStudentData()
    {
        if(Teacher::query()->first())
        {
            $homeroomTeacher = Teacher::query()->where('homeroom_class_id', $this->homeroomClass)->first()->NIP;
        }
        
        $this->validate();
        
        Student::create([
            'name' => $this->name,
            'place_of_birth' => $this->placeOfBirth,
            'date_of_birth' => $this->dateOfBirth,
            'father_name' => $this->fatherName,
            'mother_name' => $this->motherName,
            'address' => $this->address,
            'guardian_name' => $this->guardianName,
            "NISN" => $this->NISN,
            "phone_numbers" => $this->phoneNumber,
            "gender" => $this->gender,
            'status' => $this->status,
            'special_needs' => $this->specialNeeds,
            "entry_year" => $this->entryYear,
            "homeroom_class_id" => $this->homeroomClass,
            "homeroom_teacher_NIP" => $homeroomTeacher,
        ]);

        $this->dispatchBrowserEvent('dismiss-modal');
    }

    // ========== DELETE STUDENT ACCOUNT ========== //
    public function DeleteStudent($NISN)
    {
        User::query()->where('NISN', $NISN)->delete();
        Student::query()->find($NISN)->delete();

        $this->dispatchBrowserEvent('success-delete', ['data' => $NISN]);
    }
}
