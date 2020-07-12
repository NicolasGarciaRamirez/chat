<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Model;

class PostViews extends Model
{
    protected $fillable = ['post_id', 'user_id'];

    protected $hidden = ['created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(\App\Models\User\User::class);
    }

    public function post()
    {
        return $this->belongsTo('\App\Models\Post\PostViews', 'post_id');
    }
}
