<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class UserPost extends Model
{
    /**
     * fillable variable
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'description', 'image', 'genre', 'category'
    ];

    /**
     * hidden variable
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'deleted_at', 'updated_at'
    ];

    /**
     * user relations
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User\User::class);
    }

    /**
     * comments relations
     *
     * @return void
     */
    public function comments()
    {
        return $this->hasMany('\App\Models\Comments\Comments', 'post_id');
    }
}
