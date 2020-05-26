<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class UserProfileInformation extends Model
{
    protected $fillable = [
        'profile_type', 'title', 'artistic_name', 'about_you', 'genre', 'services', 'social_media', 'user_id'
    ];

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
    public function members()
    {
        return $this->hasMany(\App\Models\User\Members::class);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function worked_with()
    {
        return $this->hasMany(\App\Models\User\WorkedWith::class);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function releases()
    {
        return $this->hasMany(\App\Models\User\Releases::class);
    }
}
