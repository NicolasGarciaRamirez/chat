<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class GoogleIsNowLinked extends Notification
{
    use Queueable;

    protected $full_name;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($full_name)
    {
        $this->full_name = $full_name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->from('noreply@noisesharks.com')
            ->subject('Noisesharks - Gooogle Is Now Linked!')
            ->view('emails.google-is-now-linked', ['user' => $notifiable, 'full_name' => $this->full_name]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
