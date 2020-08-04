<?php

namespace App\Models\User;

use App\Models\Reactions\Followers;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','email', 'username', 'password', 'token', 'subscription_type', 'email_verified_at', 'avatar', 'cover'
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

    protected $appends = ['artistic_name'];

    /**
     *
     */
    public function getArtisticNameAttribute()
    {
        return ($this->profile_information && $this->profile_information->artistic_name != null) ? $this->profile_information->artistic_name : $this->personal_information->full_name;
    }

    /**
     *
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new \App\Notifications\EmailVerification());
    }

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
        return $this->hasMany(\App\Models\Post\Post::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comment()
    {
        return $this->hasMany(\App\Models\Comment\Comment::class);
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function followers()
    {
        return $this->hasMany(\App\Models\Reactions\Followers::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function playlists()
    {
        return $this->hasMany(\App\Models\Channel\Playlist::class);
    }

    public function suggestions()
    {
        return $this->hasMany(\App\Models\Extras\Suggestions::class);
    }
}
