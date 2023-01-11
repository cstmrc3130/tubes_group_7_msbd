<?php

namespace App\Http\Livewire\Student;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Notifications\StudentAbsent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class AbsentRecapitulation extends Component
{
    use WithPagination;

    protected $listeners = ['SendNotification'];

    public $type;

    protected $paginationTheme = "bootstrap";

    public function render()
    {
        $title = "Rekapitulasi Absensi";

        return view('livewire.student.absent-recapitulation')->layout('student.master', compact('title'));
    }

    public function SetType($type)
    {
        $this->type = $type;
    }

    public function ConfirmToReportError($id)
    {
        $this->dispatchBrowserEvent('confirm-to-report-error', ['id' => $id]);
    }

    public function SendNotification($id)
    {
        $admin = User::where('role', '0')->first();

        Notification::send($admin, new StudentAbsent(Auth::id(), $id));

        $this->dispatchBrowserEvent('send-absent-notification');
    }
}
