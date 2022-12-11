<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use App\Models\Student\Student;
use App\Models\Teacher\Teacher;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    public $studentCount;
    public $teacherCount;
    public $onlineUsers;

    public function mount()
    {
        $this->onlineUsers = User::all();
        $this->studentCount = Student::all()->count();
        $this->teacherCount = Teacher::all()->count();
    }

    public function render()
    {
        $title = "Dashboard";

        return view('livewire.admin.dashboard')->layout('admin.master', compact('title'));
    }
}
