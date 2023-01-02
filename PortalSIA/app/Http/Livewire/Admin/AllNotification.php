<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AllNotification extends Component
{
    // ========== NOTIFICATION RANGE AND AMOUNT PROPERTIES ========== //
    public $range = "newest";
    public $amount = 1;

    // ========== RENDER ========== //
    public function render()
    { 
        $title = "Notifikasi";

        if ($this->range == "newest")
        {
            $totalNotification = Auth::user()->query()->where('role', '0')->first()->unreadNotifications->where("created_at", '>=', now()->subDays(1)->toDateTimeString())->count();
            $notifications = Auth::user()->query()->where('role', '0')->first()->unreadNotifications->where("created_at", '>=', now()->subDays(1)->toDateTimeString())->take($this->amount);
        }
        elseif ($this->range == "last-week")
        {
            $totalNotification = Auth::user()->query()->where('role', '0')->first()->unreadNotifications->where("created_at", '<=', now()->subDays(7)->toDateTimeString())->count();
            $notifications = Auth::user()->query()->where('role', '0')->first()->unreadNotifications->where("created_at", '<=', now()->subDays(7)->toDateTimeString())->take($this->amount);
        }
        elseif ($this->range == "last-month")
        {
            $totalNotification = Auth::user()->query()->where('role', '0')->first()->unreadNotifications->where("created_at", '<=', now()->subDays(30)->toDateTimeString())->count();
            $notifications = Auth::user()->query()->where('role', '0')->first()->unreadNotifications->where("created_at", '<=', now()->subDays(30)->toDateTimeString())->take($this->amount);
        }
        else
        {
            $totalNotification = Auth::user()->query()->where('role', '0')->first()->unreadNotifications->count();
            $notifications = Auth::user()->query()->where('role', '0')->first()->unreadNotifications;
        }

        return view('livewire.admin.all-notification', compact('notifications', 'totalNotification'))->layout('admin.master', compact('title'));
    }

    // ========== FILTER NOTIFICATION RANGE ========== //
    public function FilterData($range)
    {
        $this->amount = 1;
        $this->range = $range;
        $this->dispatchBrowserEvent("change-filter-value", ['data' => $range]);
    }

    // ========== LOAD MORE NOTIFICATION ========== //
    public function LoadMore()
    {
        $this->amount += rand(2, 5);
    }
}

// P.S
// BE AWARE THAT wire:click WILL CHANGE CURRENT PAGE URL 
    // e.g IF URL ON FIRST LOAD IS : http://localhost:8000/admin/all-notifications, AFTER wire:click IS FIRED THE URL MAY CHANGED TO THE COMPONENT NAME (i.e http://localhost:8000/admin/message/admin.all-notification)
