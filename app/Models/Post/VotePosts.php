<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VotePosts extends Model
{
    use SoftDeletes;
    /**
     * Undocumented variable
     *
     * @var array
     */
    protected $fillable = [
        'type_post'
    ];

    /**
     * Undocumented variable
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at','deleted_at'
    ];

    /**
     * Undocumented function
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User\User::class);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function posts()
    {
        return $this->belongsTo(\App\Models\Post\Post::class);
    }
    /**
     * Undocumented function
     *
     * @return void
     */
    public function voteable()
    {
        return $this->morphTo();
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function votes()
    {
        return $this->morphMany('\App\Models\Post\VotePost', 'voteable');
    }
}
