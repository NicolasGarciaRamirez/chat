<?php

namespace App\Broadcasting;

use App\Models\User\User;

class ChatChannel
{
    public $user;
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Authenticate the user's access to the channel.
     *
     * @param  \App\Models\User\User  $user
     * @return array|bool
     */
    public function join($remitente, $receptor)
    {
        $this->user =  json_decode($remitente);

        if ($this->user->id === \Auth::user()->id){
            return \Auth::user();
        }else if($receptor === \Auth::user()->username){
            return \Auth::user();
        }else{
            return true;
        }

    }
}
