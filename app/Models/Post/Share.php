<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Share extends Model
{
    use SoftDeletes;

    protected $fillable = ['post_id'];

    protected $hidden = ['updated_at', 'deleted_at'];

    public function Post(){
        return $this->belongsTo(\App\Models\Post\Post::class);
    }
}
