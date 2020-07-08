<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StartedFollowYou extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $user_full_name;
    protected $follow_full_name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $user_full_name, $follow_full_name)
    {
        $this->user = $user;
        $this->user_full_name = $user_full_name;
        $this->follow_full_name = $follow_full_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@noisesharks.com')
            ->subject("Noisesharks - {$this->follow_full_name} started following you!")
            ->view('emails.started-follow-you', ['user' => $this->user, 'user_full_name' => $this->user_full_name, 'follow_full_name' => $this->follow_full_name]);
    }
}
