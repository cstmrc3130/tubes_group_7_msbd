<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use App\Rules\MatchOldPassword;
use App\Models\Student\Student;
use App\Models\Teacher\Teacher;
use App\Models\Classroom\Classroom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class Dashboard extends Component
{
    // ========== ENTITIES AMOUNT PROPERTIES ========== //
    public $studentCount;
    public $teacherCount;
    public $classroomCount;
    public $adminCount;

    // ========== ADMIN LOGIN INFO PROPERTIES ========== //
    public $email;
    public $oldPassword;
    public $newPassword;

    // ========== EVENT LISTENERS ========== //
    protected $listeners = ['EndUserSession', 'UpdateLoginInfo'];

    // ========== CONSTRUCTOR TO INITIALIZE PROPERTIES ========== //
    public function mount()
    {
        $this->studentCount = Student::all()->count();
        $this->teacherCount = Teacher::all()->count();
        $this->classroomCount = Classroom::all()->count();
        $this->adminCount = User::query()->where('role', '0')->count();
    }

    // ========== RENDER ========== //
    public function render()
    {
        $title = "Dashboard";

        return view('livewire.admin.dashboard')->layout('admin.master', compact('title'));
    }

    // ========== END USER SESSION ========== //
    public function EndUserSession($user_id)
    {
        $expireDuration = now()->addMinutes(1);
        Cache::put('end-session-for' . $user_id, true, $expireDuration);
    }

    // ========== UPDATE LOGIN INFO ========== //
    public function UpdateLoginInfo($loginInfoData)
    {
        if(User::query()->find(Auth::id())->update(['email' => $loginInfoData[0]['value'], 'password' => bcrypt($loginInfoData[2]['value'])]))
        {
            $this->dispatchBrowserEvent('update-success');
        }
    }
}
