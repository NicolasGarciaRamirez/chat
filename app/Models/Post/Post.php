<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * fillable variable
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'replace_caption' , 'allow_download' , 'description', 'resource', 'resource_type', 'genre', 'category', 'token'
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
     * @var string[]
     */
    protected $appends = ['time_ago'];

    /**
     *
     */
    public function getTimeAgoAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    /**
     * user relations
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User\User::class);
    }

    /**
     * comments relations
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function comments()
    {
        return $this->morphMany('App\Models\Comment\Comment', 'commentable');
    }

     /**
     * comments relations
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function likes()
    {
        return $this->morphMany('App\Models\User\LitLike', 'likeable');
    }

    /**
     * Undocumented function
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function votes()
    {
        return $this->morphMany('App\Models\Post\VotePosts', 'voteable');
    }

     /**
     * Undocumented function
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function followers()
    {
        return $this->morphMany('App\Models\Reactions\Followers', 'followable');
    }
}
