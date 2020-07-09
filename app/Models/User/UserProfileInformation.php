<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class UserProfileInformation extends Model
{
    protected $fillable = [
        'profile_type', 'title', 'artistic_name', 'about_you', 'genres', 'services', 'social_media', 'user_id'
    ];

    protected $hidden = [
        'created_at', 'updated_at','deleted_at'
    ];

    public function setGenresAttribute($value)
    {
        $this->attributes['genres'] = implode(",", $value);
    }

    public function setServicesAttribute($value)
    {
        $this->attributes['services'] = implode(",", $value);
    }
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function members()
    {
        return $this->hasMany('\App\Models\User\Members', 'profile_information_id', 'id');
    }

    /**
     * Undocumented function
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function worked_with()
    {
        return $this->hasMany('\App\Models\User\WorkedWith', 'profile_information_id', 'id');
    }

    /**
     * Undocumented function
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function releases()
    {
        return $this->hasMany('\App\Models\User\Releases', 'profile_information_id','id');
    }
}
