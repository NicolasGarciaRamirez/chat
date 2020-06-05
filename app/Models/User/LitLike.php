<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class LitLike extends Model
{
    /**
     * Undocumented variable
     *
     * @var array
     */
    protected $fillable = [
        'like','dislike','post_id', 'user_id'
    ];

    /**
     * Undocumented variable
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    /**
     * Undocumented function
     *
     * @return void
     */
    public function user()
    {
        $this->belongsTo(\App\Models\User\User::class);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function post()
    {
        $this->belongsTo(\App\Models\User\User::class);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function comments()
    {
        $this->belongsTo(\App\Models\User\Comments::class);
    }
}
