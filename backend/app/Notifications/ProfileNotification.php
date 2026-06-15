<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ProfileNotification extends Notification
{
    use Queueable;

    public function __construct(
        public string $message,
        public string $type = 'info'
    ){}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        return [
            'message' => $this->message,
            'type' => $this->type,
        ];
    }
}
