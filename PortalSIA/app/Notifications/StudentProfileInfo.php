<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class StudentProfileInfo extends Notification
{
    use Queueable;

    public function __construct($user_id, $name, $place_of_birth, $date_of_birth, $father_name, $mother_name, $address, $phone_numbers)
    {
        $this->user_id = $user_id;
        $this->name = $name;
        $this->place_of_birth = $place_of_birth;
        $this->date_of_birth = $date_of_birth;
        $this->father_name = $father_name;
        $this->mother_name = $mother_name;
        $this->address = $address;
        $this->phone_numbers = $phone_numbers;
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
            'name' => $this->name,
            'place_of_birth' => $this->place_of_birth,
            'date_of_birth' => $this->date_of_birth,
            'father_name' => $this->father_name,
            'mother_name' => $this->mother_name,
            'address' => $this->address,
            'phone_numbers' => $this->phone_numbers
        ];
    }
}
