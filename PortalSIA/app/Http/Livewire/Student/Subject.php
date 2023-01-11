<?php

namespace App\Http\Livewire\Student;

use Livewire\Component;
use Livewire\WithPagination;

class Subject extends Component
{
    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public function render()
    {
        $title = "Daftar Mata Pelajaran";
        
        return view('livewire.student.subject')->layout('student.master', compact('title'));
    }
}
