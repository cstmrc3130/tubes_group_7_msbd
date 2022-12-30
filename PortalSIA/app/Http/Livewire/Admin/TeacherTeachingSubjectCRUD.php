<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Teacher\TeachingSubject;
use Illuminate\Support\Str;

class TeacherTeachingSubjectCRUD extends Component
{
    // ========== CARD ATTRIBUTES ========== //
    public $NIP;
    public $class;
    public $subject;

    // ========== EVENT LISTENERS ========== //
    protected $listeners = [];

    // ========== RULES ========== //
    protected $rules = ([
        'NIP' => ['required'],
        'class' => ['required'],
        'subject' => ['required']
    ]);

    // ========== LIVE VALIDATION ========== //
    public function updated($property_name)
    {
        $this->validateOnly($property_name);
    }

    // ========== RENDER ========== //
    public function render()
    {
        $title = "Mata Pelajaran Guru";

        return view('livewire.admin.teacher-teaching-subject')->layout('admin.master', compact('title'));
    }

    public function UpdateOrCreateRecords()
    {
        $this->validate();

        TeachingSubject::query()->updateOrCreate(
            [
                'NIP' => $this->NIP,
                'subject_id' => $this->subject,
                'class_id' => $this->class,
                'school_year_id' => session('currentSchoolYear'),
            ],
            [
                'id' => Str::uuid(),
                'NIP' => $this->NIP,
                'subject_id' => $this->subject,
                'class_id' => $this->class,
                'school_year_id' => session('currentSchoolYear'),
            ]
        );
    }

    public function DeleteRecord($id)
    {
        TeachingSubject::query()->find($id)->delete();
    }
}
