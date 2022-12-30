<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class StudentTakingExtracurricularCRUD extends Component
{
    // ========== RENDER ========== //
    public function render()
    {
        $title = "Ekstrakurikuler Siswa";

        return view('livewire.admin.student-taking-extracurricular')->layout('admin.master', compact('title'));
    }
}
