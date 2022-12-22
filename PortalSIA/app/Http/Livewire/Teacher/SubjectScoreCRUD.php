<?php

namespace App\Http\Livewire\Teacher;

use App\Models\Subject\Subject;
use App\Models\Teacher\TeachingSubject;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SubjectScoreCRUD extends Component
{
    public $dynamicSubject;

    protected $rules = [
        'dynamicSubject' => ['required']
    ];
    
    public function updated($property_name)
    {
        $this->validateOnly($property_name);
    }

    public function render()
    {
        $title = "Nilai Mata Pelajaran";
        $dynamicClass = \App\Models\Teacher\TeachingSubject::query()->where('NIP', auth()->user()->NIP)->where('subject_id', $this->dynamicSubject)->get();

        return view('livewire.teacher.subject-score', compact('dynamicClass'))->layout('teacher.master', compact('title'));
    }
}
