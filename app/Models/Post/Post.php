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
    protected $appends = ['time_ago', 'score', 'vote_up_count', 'vote_down_count'];

    /**
     *
     */
    public function getTimeAgoAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    
    public function getVoteUpCountAttribute()
    {
        return $this->votes()->where('type_vote', 'vote_up')->count();
    }

    public function getVoteDownCountAttribute()
    {
        return $this->votes()->where('type_vote', 'vote_down')->count();
    }

    public function getScoreAttribute()
    {
        return (( 10 + $this->vote_up_count ) / ( 10 + ( $this->vote_up_count + $this->vote_down_count ))) * (1 - (0.02 * $this->created_at->diffInHours(\Carbon\Carbon::now()))) * 100;
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

    /**
     * Undocumented function
     *
     * @return void
     */
    public function playlist_post()
    {
        return $this->belongsTo(\App\Models\Channel\PlaylistPost::class);
    }
}
