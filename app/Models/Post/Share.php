<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Share
 * @package App\Models\Post
 */
class Share extends Model
{
    use SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = ['post_id'];

    /**
     * @var string[]
     */
    protected $hidden = ['updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Post(){
        return $this->belongsTo(\App\Models\Post\Post::class);
    }
}
