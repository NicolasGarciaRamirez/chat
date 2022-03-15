<?php

namespace App\Models\Channel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Playlist
 * @package App\Models\Channel
 */
class Playlist extends Model
{
    use SoftDeletes;

    /**
     * Undocumented variable
     *
     * @var array
     */
    protected $fillable = [
        'title', 'about', 'about'
    ];

    /**
     * Undocumented variable
     *
     * @var array
     */
    protected $hidden = [
        'updated_at', 'deleted_at', 'updated_at'
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
    public function playlist_post()
    {
        return $this->hasMany(\App\Models\Channel\PlaylistPost::class);
    }
}
