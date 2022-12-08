<?php

namespace App\Http\Livewire\Teacher;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public function Profile()
    {
        return redirect()->to("/teacher/profile");
    }

    public function Class($user_id)
    {
        return redirect()->to("/teacher/homeroom-class");
    }

    public function render()
    {
        $title = "Dashboard";

        return view('livewire.teacher.dashboard')->layout('teacher.master', compact('title'));
    }
}
