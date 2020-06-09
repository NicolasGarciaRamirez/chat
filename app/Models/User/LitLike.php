<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LitLike extends Model
{
    
    /**
     * Undocumented variable
     *
     * @var array
     */
    protected $fillable = [
        'like'
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
    public function post()
    {
        return $this->belongsTo(\App\Models\User\User::class);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function comments()
    {
        return $this->belongsTo(\App\Models\Comment\Comments::class);
    }

    public function likeable()
    {
        return $this->morphTo();
    }

    public function likes()
    {
        return $this->morphMany('\App\Models\User\Litlike', 'likeable');
    }
}
