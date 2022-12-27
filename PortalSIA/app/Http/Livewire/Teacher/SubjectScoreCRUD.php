<?php

namespace App\Http\Livewire\Teacher;

use App\Models\ScoringSession;
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
        $activeScoringSession = ScoringSession::query()->where('start_date', "!=", "0000-00-00")->where('end_date', ">=", date("Y-m-d"))->first();

        return view('livewire.teacher.subject-score', compact('activeScoringSession'))->layout('teacher.master', compact('title'));
    }
}
