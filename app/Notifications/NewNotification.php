<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewNotification extends Notification
{
    use Queueable;

    public function via($notifiable)
    {
        return ['database']; // Store notifications in the database
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'This is a new notification message.',
            // Add more data as needed
        ];
    }
}
