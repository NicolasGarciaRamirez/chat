<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    protected $full_name;
    protected $user;

    /**
     * Create a new message instance.
     *
     * @param $user
     * @param $full_name
     */
    public function __construct($user, $full_name)
    {
        $this->user = $user;
        $this->full_name = $full_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@noisesharks.com')
            ->subject('Noisesharks - Forgot Password?')
            ->view('emails.forgot-password', ['user' => $this->user, 'full_name' => $this->full_name]);
    }
}
