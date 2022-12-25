<?php

namespace App\Http\Livewire\Teacher;

use App\Models\Student\Student;
use App\Models\Subject\Subject;
use App\Models\Teacher\TeachingSubject;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class SubjectScoreCRUD extends Component
{
    use WithPagination;

    public $dynamicSubject;
    public $selectedClass;

    protected $rules = [
        'dynamicSubject' => ['required'],
    ];
    
    public function updated($property_name)
    {
        $this->validateOnly($property_name);
    }

    protected $paginationTheme = "bootstrap";

    public function render()
    {
        $title = "Nilai Mata Pelajaran";
        $dynamicClass = TeachingSubject::query()->where('NIP', auth()->user()->NIP)->where('subject_id', $this->dynamicSubject)->get();
        $dynamicStudent = Student::query()->where('homeroom_class_id', $this->selectedClass)->groupBy('name')->paginate(5);

        return view('livewire.teacher.subject-score', compact('dynamicClass', 'dynamicStudent'))->layout('teacher.master', compact('title'));
    }
}
