<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommentedOnYourPost extends Mailable
{
    use Queueable, SerializesModels;

    protected $post;
    protected $user_login;
    protected $user_post;
    protected $username;
    protected $comment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($post, $user_login, $user_post, $username, $comment)
    {
        $this->post = $post;
        $this->user_login = $user_login;
        $this->user_post = $user_post;
        $this->username = $username;
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@noisesharks.com')
            ->subject("Noisesharks - {$this->user_post} commented on your post!")
            ->view('emails.commented-on-your-post', ['post' => $this->post, 'user_login' => $this->user_login, 'user_post' => $this->user_post, 'username' => $this->username, 'comment' => $this->comment]);
    }
}
