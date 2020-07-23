<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ThoughtYourCommentIsLit extends Mailable
{
    use Queueable, SerializesModels;

    protected $post;
    protected $user_login;
    protected $user_post;
    protected $username;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($post, $user_login, $user_post, $username)
    {
        $this->post = $post;
        $this->user_login = \auth()->user()->artistic_name;
        $this->user_post = $user_post;
        $this->username = $username;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@noisesharks.com')
            ->subject("Noisesharks - {$this->user_login} thought your comment is lit")
            ->view('emails.thought-your-comment-is-lit', ['post' => $this->post, 'user_login' => $this->user_login, 'user_post' => $this->user_post, 'username' => $this->username]);
    }
}
