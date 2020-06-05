<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    /**
     * Undocumented variable
     *
     * @var array
     */
    protected $fillable = [
        'post_id', 'user_id' , 'comment_parent_id', 'description'
    ];

    /**
     * Undocumented variable
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    /**
     * Undocumented function
     *
     * @return void
     */
    public function post()
    {
        return $this->belongsTo(App\Models\User\UserPost::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User\User::class);
    }

    public function litlike()
    {
        return $this->hasMany(\App\Models\User\LitLike::class);
    }
}
