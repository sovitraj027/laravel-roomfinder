<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ApplicationIsAddedNotification extends Notification
{
    use Queueable;

    protected $room_owner;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($room_owner)
    {
        $this->room_owner = $room_owner;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'room_owner' => $this->room_owner
        ];
    }
}
