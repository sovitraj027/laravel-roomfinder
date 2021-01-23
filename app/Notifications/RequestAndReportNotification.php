<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RequestAndReportNotification extends Notification
{
    use Queueable;

    protected $request_report;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($request_report)
    {
        $this->request_report = $request_report;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = url('/request_report/' . $this->request_report->id);
        return (new MailMessage)
            ->greeting('Namaskar!')
            ->line('New Request or Report has been added')
            ->action('View Request/Report', $url);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'request_report' => $this->request_report
        ];
    }
}
