<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class ClassCRUD extends Component
{
    // ========== RENDER ========== //
    public function render()
    {
        $title = "Dashboard";

        return view('livewire.admin.class-list')->layout('admin.master', compact('title'));
    }
}
