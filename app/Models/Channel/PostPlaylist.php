<?php

namespace App\Models\Channel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostPlaylist extends Model
{
    use SoftDeletes;

    /**
     * Undocumented variable
     *
     * @var array
     */
    protected $fillable = [
        'playlist_id', 'post_id'
    ];

    /**
     * Undocumented variable
     *
     * @var array
     */
    protected $hidden = [
        'created_at','updated_at','deleted_at'
    ];

    /**
     * Undocumented function
     *
     * @return void
     */
    public function playlist()
    {
        return $this->belongsTo(\App\Models\Channel\ChannelPlaylist::class);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function posts()
    {
        return $this->hasMany(\App\Models\Post\Post::class);
    }
}
