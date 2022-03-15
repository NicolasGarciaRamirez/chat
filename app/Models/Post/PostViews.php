<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PostViews
 * @package App\Models\Post
 */
class PostViews extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = ['post_id', 'user_id'];

    /**
     * @var string[]
     */
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User\User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo('\App\Models\Post\PostViews', 'post_id');
    }
}
