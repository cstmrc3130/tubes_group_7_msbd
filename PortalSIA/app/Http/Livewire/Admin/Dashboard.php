<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use App\Models\Student\Student;
use App\Models\Teacher\Teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class Dashboard extends Component
{
    public $studentCount;
    public $teacherCount;

    // ========== EVENT LISTENERS ========== //
    protected $listeners = ['EndUserSession'];

    // ========== CONSTRUCTOR TO INITIALIZE PROPERTIES ========== //
    public function mount()
    {
        $this->studentCount = Student::all()->count();
        $this->teacherCount = Teacher::all()->count();
    }

    // ========== RENDER ========== //
    public function render()
    {
        $title = "Dashboard";

        return view('livewire.admin.dashboard')->layout('admin.master', compact('title'));
    }

    public function EndUserSession($user_id)
    {
        $expireDuration = now()->addMinutes(1);
        Cache::put('end-session-for' . $user_id, true, $expireDuration);
    }
}
