<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Teacher\TeachingExtracurricular;

class TeacherTeachingExtracurricularCRUD extends Component
{
    // ========== CARD ATTRIBUTES ========== //
    public $NIP;
    public $extracurricular;

    // ========== EVENT LISTENERS ========== //
    protected $listeners = [];

    // ========== RULES ========== //
    protected $rules = ([
        'NIP' => ['required'],
        'extracurricular' => ['required']
    ]);

    // ========== LIVE VALIDATION ========== //
    public function updated($property_name)
    {
        $this->validateOnly($property_name);
    }

    // ========== RENDER ========== //
    public function render()
    {
        $title = "Ekstrakurikuler Guru";

        return view('livewire.admin.teacher-teaching-extracurricular')->layout('admin.master', compact('title'));
    }

    public function UpdateOrCreateRecords()
    {
        $this->validate();

        TeachingExtracurricular::query()->updateOrCreate(
            [
                'NIP' => $this->NIP,
                'extracurricular_id' => $this->extracurricular,
            ],
            [
                'id' => Str::uuid(),
                'NIP' => $this->NIP,
                'extracurricular_id' => $this->extracurricular,
            ]
        );
    }

    public function DeleteRecord($id)
    {
        TeachingExtracurricular::query()->find($id)->delete();
    }
}
