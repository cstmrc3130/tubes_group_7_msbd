<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Notification;
use App\Models\Student\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StudentProfileInline extends Component
{
    // ========== NOTIFICATION ATTRIBUTES ========== //
    public $name, $createdAt, $notificationID, $currentPage;

    // ========== EVENT LISTENERS ========== //
    protected $listeners = ['AbortUpdateProfileInfo', 'ApproveUpdateProfileInfo'];

    // ========== CONSTRUCTOR TO INITIATE PROPERTIES ========== //
    public function mount()
    {
        $this->currentPage = url()->current();
    }

    // ========== RENDER ========== //
    public function render()
    {
        if (Str::contains($this->currentPage, 'notification'))
        {
            return <<<'blade'
                <div class="card card-hover bg-transparent border border-secondary btn waves-effect rounded mb-1 mt-1 pb-0" id="{{ $notificationID }}" data-toggle="modal" data-target="#studentProfileInfoModal" wire:click="ConfigureModal()" >
                    <div class="card-body p-0">
                        <div class="d-flex flex-row">
                            <div class="align-self-center"><i class="fa fa-bell"></i></div>
                            <div class="mr-auto p-2 align-self-center text-left">
                                <h5 class="m-b-0 font-bold">{{ $name }}</h5>
                                <h6 class="m-b-0 font-light">Perbaruan data pribadi</h6>
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
                <a href="javascript:void(0)" id="{{ $notificationID }}" class="message-item" data-toggle="modal" data-target="#studentProfileInfoModal" wire:click="ConfigureModal()">
                    <span class="btn btn-danger btn-circle">
                        <i class="fa fa-link"></i>
                    </span>
                    <div class="mail-contnet">
                        <h5 class="message-title">{{ $name }}</h5>
                        <span class="mail-desc">Perbaruan data pribadi</span>
                        <span class="time">{{ $createdAt }}</span>
                    </div>
                </a>
            blade;
        }
    }

    // ========== CONFIGURE MODAL BY DISPATCHING AN EVENT TO JS ========== //
    public function ConfigureModal()
    {
        $old = User::find(json_decode(Notification::find($this->notificationID)->data)->user_id);
        $new = json_decode(Notification::find($this->notificationID)->data);

        $this->dispatchBrowserEvent('configure-modal', [
            'notificationID' => $this->notificationID,

            'oldName' => $old->student->name,
            'oldPlaceOfBirth' => $old->student->place_of_birth,
            'oldDateOfBirth' => $old->student->date_of_birth,
            'oldFatherName' => $old->student->father_name,
            'oldMotherName' => $old->student->mother_name,
            'oldAddress' => $old->student->address,
            'oldPhoneNumber' => $old->student->phone_numbers,

            'newName' => $new->name,
            'newPlaceOfBirth' => $new->place_of_birth,
            'newDateOfBirth' => $new->date_of_birth,
            'newFatherName' => $new->father_name,
            'newMotherName' => $new->mother_name,
            'newAddress' => $new->address,
            'newPhoneNumber' => $new->phone_numbers,
        ]);
    }

    // ========== ABORT STUDENT REQUEST TO UPDATE THEIR PERSONAL INFO ========== //
    public function AbortUpdateProfileInfo($notification_id)
    {
        Auth::user()->unreadNotifications->where("id", $notification_id)->markAsRead();
    }

    // ========== APPROVE STUDENT REQUEST TO UPDATE THEIR PERSONAL INFO ========== //
    public function ApproveUpdateProfileInfo($notification_id)
    {
        $new = json_decode(Notification::find($this->notificationID)->data);

        Student::query()->find(User::query()->find($new->user_id)->NISN)->update([
            'name' => $new->name, 
            'place_of_birth' => $new->place_of_birth,
            'date_of_birth' => $new->date_of_birth,
            'father_name' => $new->father_name,
            'mother_name' => $new->mother_name,
            'address' => $new->address,
            'phone_numbers' => $new->phone_numbers
        ]);

        Auth::user()->unreadNotifications->where("id", $notification_id)->markAsRead();
    }
}

// P.S
// INLINE COMPONENT DOESN'T NEED TO DECLARE PARAMETER WHILE USING wire: DIRECTIVES, BECAUSE EACH COMPONENT UNIQUELY OWN ITS ATTRIBUTE
    // FOR EXAMPLE, IF WE RENDER MULTIPLE INLINE ELEMENT USING LOOP, EACH COMPONENT WILL HAVE ITS ATTRIBUT SEPARATED FROM OTHER COMPONENT 
    // THE ConfigureModal() METHOD ABOVE ALREADY DECIDE WHICH notificationID TO USE
