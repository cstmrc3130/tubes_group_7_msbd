<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use App\Models\AbsentRecapitulation;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Notification;
use App\Models\Student\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StudentAbsentInline extends Component
{
    // ========== NOTIFICATION ATTRIBUTES ========== //
    public $name, $createdAt, $notificationID, $currentPage;

    // ========== EVENT LISTENERS ========== //
    protected $listeners = ['AbortUpdateAbsent', 'ApproveUpdateAbsent'];

    // ========== EVENT LISTENERS ========== //
    protected $rules = [
        'date' => ['required', 'date', 'before:tomorrow']
    ];

    // ========== CONSTRUCTOR TO INITIATE PROPERTIES ========== //
    public function mount()
    {
        $this->currentPage = url()->current();
    }

    // ========== LIVE VALIDATION ========== //
    public function updated($property_name)
    {
        $this->validateOnly($property_name);
    }

    // ========== RENDER ========== //
    public function render()
    {
        if (Str::contains($this->currentPage, 'notification'))
        {
            return <<<'blade'
                <div class="card card-hover bg-transparent border border-info btn waves-effect rounded mb-1 mt-1 pb-0" id="{{ $notificationID }}" data-toggle="modal" data-target="#studentAbsentModal" wire:click="ConfigureAbsentModal()" >
                    <div class="card-body p-0">
                        <div class="d-flex flex-row">
                            <div class="align-self-center"><i class="fa fa-list-alt"></i></div>
                            <div class="mr-auto p-2 align-self-center text-left">
                                <h5 class="m-b-0 font-bold">{{ $name }}</h5>
                                <h6 class="m-b-0 font-light">Pemeriksaan data absensi</h6>
                                <span class="time text-danger">{{ $createdAt }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            blade;
        }
        else
        {
            return <<<'blade'
                <a href="javascript:void(0)" id="{{ $notificationID }}" class="message-item" data-toggle="modal" data-target="#studentAbsentModal" wire:click="ConfigureAbsentModal()">
                    <span class="btn btn-info btn-circle">
                        <i class="fa fa-list-alt"></i>
                    </span>
                    <div class="mail-contnet">
                        <h5 class="message-title">{{ $name }}</h5>
                        <span class="mail-desc">Pemeriksaan data absensi</span>
                        <span class="time">{{ $createdAt }}</span>
                    </div>
                </a>
            blade;
        }
    }

    // ========== CONFIGURE MODAL BY DISPATCHING AN EVENT TO JS ========== //
    public function ConfigureAbsentModal()
    {
        $old = AbsentRecapitulation::find(json_decode(Notification::find($this->notificationID)->data)->absent_id);

        $this->dispatchBrowserEvent('configure-absent-modal', [
            'notificationID' => $this->notificationID,

            'studentName' => User::find(json_decode(Notification::find($this->notificationID)->data)->user_id)->student->name,
            'oldDate' => $old->date,
            'description' => $old->type,
            'absentID' => $old
        ]);
    }

    // ========== ABORT STUDENT REQUEST TO UPDATE THEIR PERSONAL INFO ========== //
    public function AbortUpdateAbsent($notification_id, $absent_id)
    {
        AbsentRecapitulation::query()->find($absent_id)->first()->delete();
        Auth::user()->unreadNotifications->where("id", $notification_id)->markAsRead();
    }

    // ========== APPROVE STUDENT REQUEST TO UPDATE THEIR PERSONAL INFO ========== //
    public function ApproveUpdateAbsent($notification_id, $absent_id, $date, $description)
    {
        AbsentRecapitulation::query()->find($absent_id)->first()->update([
            'date' => $date,
            'type' => $description,
        ]);

        Auth::user()->unreadNotifications->where("id", $notification_id)->markAsRead();
    }
}

// P.S
// INLINE COMPONENT DOESN'T NEED TO DECLARE PARAMETER WHILE USING wire: DIRECTIVES, BECAUSE EACH COMPONENT UNIQUELY OWN ITS ATTRIBUTE
    // FOR EXAMPLE, IF WE RENDER MULTIPLE INLINE ELEMENT USING LOOP, EACH COMPONENT WILL HAVE ITS ATTRIBUT SEPARATED FROM OTHER COMPONENT 
    // THE ConfigureModal() METHOD ABOVE ALREADY DECIDE WHICH notificationID TO USE
