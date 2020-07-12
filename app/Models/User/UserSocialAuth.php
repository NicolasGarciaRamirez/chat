<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserSocialAuth extends Model
{
    use SoftDeletes;
    
    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id', 'provider', 'provider_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User\User::class);
    }
}
