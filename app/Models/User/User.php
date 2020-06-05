<?php

namespace App\Models\User;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Cog\Contracts\Love\Reacterable\Models\Reacterable as ReacterableContract;
use Cog\Laravel\Love\Reacterable\Models\Traits\Reacterable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements ReacterableContract
{
    use Notifiable, Reacterable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'username', 'password', 'token', 'subscription_type', 'email_verified_at', 'avatar', 'cover','love_reacter_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Undocumented function
     *
     * @param [type] $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * @param $value
     */
    public function setSubscriptionTypeAttribute($value)
    {
        $this->attributes['subscription_type'] = strtoupper($value);
    }

    /**
     * personalInformation function
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function personal_information()
    {
        return $this->hasOne(\App\Models\User\UserPersonalInformation::class);
    }

    /**
     * post function
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(\App\Models\User\UserPost::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comment()
    {
        return $this->hasMany('\App\Models\User\Comments', 'user_id');
    }

      /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function litlike()
    {
        return $this->hasMany('\App\Models\User\LitLike', 'user_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile_information()
    {
        return $this->hasOne(\App\Models\User\UserProfileInformation::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function social_auth()
    {
        return $this->hasMany(\App\Models\User\UserSocialAuth::class);
    }
}
