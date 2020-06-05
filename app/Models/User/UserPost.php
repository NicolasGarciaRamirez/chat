<?php

namespace App\Models\User;

use Cog\Contracts\Love\Reactable\Models\Reactable as ReactableContract;
use Cog\Laravel\Love\Reactable\Models\Traits\Reactable;
use Illuminate\Database\Eloquent\Model;

class UserPost extends Model implements ReactableContract
{
    use Reactable;
    /**
     * fillable variable
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'description', 'resource','resource_type', 'genre', 'category'
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
        return $this->hasMany('\App\Models\User\Comments', 'post_id');
    }

    public function litlike()
    {
        return $this->hasMany('\App\Models\User\LitLike', 'post_id');
    }
}
