<?php

namespace App\Http\Livewire\Teacher;

use Livewire\Component;

class ExtracurricularScoreCRUD extends Component
{
    public function render()
    {
        $title = "Nilai Ekstrakurikuler";

        return view('livewire.teacher.extracurricular-score')->layout('teacher.master', compact('title'));
    }
}
