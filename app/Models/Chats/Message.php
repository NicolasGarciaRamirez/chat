<?php

namespace App\Models\Chats;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['message', 'user_id'];

    protected $hidden = ['created_at','updated_at','deleted_at'];

    protected $appends = ['data_send'];

    public function getDataSendAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public  function user()
    {
        return $this->belongsTo(\App\Models\User\User::class);
    }

}
