<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class SubjectCRUD extends Component
{
    public function render()
    {
        $title = "Data Mata Pelajaran";

        return view('livewire.admin.subject-list')->layout('admin.master', compact('title'));
    }
}
