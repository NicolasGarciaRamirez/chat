<?php

namespace App\Models\Channel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlaylistPost extends Model
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
        'created_at', 'updated_at', 'deleted_at'
    ];

    /**
     * Undocumented function
     *
     * @return void
     */
    public function playlist()
    {
        return $this->belongsTo(\App\Models\Channel\Playlist::class);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function post()
    {
        return $this->hasOne('\App\Models\Post\Post', 'id');
    }
}
