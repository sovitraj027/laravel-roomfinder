<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NoticeAddedNotification extends Notification
{
    /*FLOW ->
     1)NoticeController saves the notice
     2)notice's email/notification is processed here
     3)notice is again sent to email/app.blade to be displayed*/
    protected $notice;
    use Queueable;

    public function __construct($notice)
    {
        $this->notice = $notice;
    }


    public function via($notifiable)
    {
        return ['database'];
    }


    public function toDatabase($notifiable)
    {
        return [
            'notice' => $this->notice
        ];
    }
}
