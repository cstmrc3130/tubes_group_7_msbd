<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class StudentAbsent extends Notification
{
    use Queueable;

    public function __construct($user_id, $absent_id)
    {
        $this->user_id = $user_id;
        $this->absent_id = $absent_id;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    // DEFINE 'data' COLUMN IN NOTIFICATION TABLE
    public function toArray($notifiable)
    {
        return [
            'user_id' => $this->user_id,
            'absent_id' => $this->absent_id,
        ];
    }
}
