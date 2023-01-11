<?php

namespace App\Http\Livewire\Teacher;

use Livewire\Component;
use Livewire\WithPagination;

class ExtracurricularScoreCRUD extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public function render()
    {
        $title = "Nilai Ekstrakurikuler";

        return view('livewire.teacher.extracurricular-score')->layout('teacher.master', compact('title'));
    }
}
