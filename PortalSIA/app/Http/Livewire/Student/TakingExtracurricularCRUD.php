<?php

namespace App\Http\Livewire\Student;

use Livewire\Component;
use Livewire\WithPagination;

class TakingExtracurricularCRUD extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public function render()
    {
        $title = "Daftar Ekstrakurikuler";

        return view('livewire.student.taking-extracurricular')->layout('student.master', compact('title'));
    }
}
