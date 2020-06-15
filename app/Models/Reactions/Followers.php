<?php

namespace App\Models\Reactions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Followers extends Model
{
    use SoftDeletes;

    /**
     * Undocumented variable
     *
     * @var array
     */
    protected $fillable =['user_id'];

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
    public function user()
    {
        return $this->belongsTo(\App\Models\User\User::class);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function followable()
    {
        return $this->morphTo();
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function followers()
    {
        return $this->morphMany('\App\Models\Reactions\Followers', 'followable');
    }
}
