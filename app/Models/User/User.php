<?php

namespace App\Models\User;

use App\Models\Post\Post;
use Carbon\CarbonImmutable;
use Laravel\Cashier\Billable;
use Illuminate\Support\Facades\DB;
use App\Models\Reactions\Followers;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notification;

/**
 * Class User
 * @package App\Models\User
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable,Billable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','email', 'username', 'password', 'token', 'subscription_type', 'contributor_type','email_verified_at', 'verification_date','badge_verification','avatar', 'cover','country','customer_id','credit'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'banned','suspend','trial_ends_at', 'updated_at','deleted_at'
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
     * @var string[]
     */
    protected $appends = ['artistic_name', 'total_support_earnings', 'total_reward_earnings', 'total_support_earnings_monthly','total_reward_earnings_monthly', 'total_earnings', 'total_earnings_monthly', 'your_first_post', 'one_credit_week'];

    public function receivesBroadcastNotificationsOn()
    {
        return 'users.'.$this->id;
    }
    /**
     *
     */
    public function getArtisticNameAttribute()
    {
        return ($this->profile_information && $this->profile_information->artistic_name != null) ? $this->profile_information->artistic_name : $this->personal_information->full_name;
    }

    /**
     * @return int
     */
    public function getTotalSupportEarningsAttribute(): int
    {
        $supports = $this->supportsWithTrashed()->get();
        $total_earnings = 0 ;
        foreach ($supports as $support){
            $total_earnings += $support->monthly_amount_recibed;
        }
        return $total_earnings;
    }

    /**
     * @return int
     */
    public function getTotalRewardEarningsAttribute(): int
    {
        $rewards = $this->rewardsWithDeleted()->get();
        $total_earnings = 0;
        foreach ($rewards as $reward){
            $total_earnings += $reward->amount_recibed;
        }
        return $total_earnings;
    }

    /**
     * @return string
     */
    public function getTotalEarningsAttribute(): string
    {
        return number_format($this->total_reward_earnings + $this->total_support_earnings , '2','.','');
    }

    /**
     * @return int
     */
    public function getTotalRewardEarningsMonthlyAttribute(): int
    {
        if($this->subscription_type === "CONTRIBUTOR"){
            $date_one = \Carbon\Carbon::now()->firstOfMonth()->format('Y-m-d');
            $date_two = \Carbon\Carbon::now()->endOfMonth()->format('Y-m-d');
            $rewards = $this->rewardsWithDeleted()->whereBetween('created_at', [$date_one ,$date_two])->get();
            $total_rewards = 0;

            foreach($rewards as $reward){
                $total_rewards += $reward->amount_recibed;
            }
            return $total_rewards;
        }else{
            return 0;
        }
    }

    /**
     * @return int
     */
    public function getTotalSupportEarningsMonthlyAttribute(): int
    {
        if($this->subscription_type === "CONTRIBUTOR"){
            $date_one = \Carbon\Carbon::now()->firstOfMonth()->format('Y-m-d');
            $date_two = \Carbon\Carbon::now()->endOfMonth()->format('Y-m-d');
            $supports = $this->supportsWithTrashed()->whereBetween('created_at' , [$date_one, $date_two])->get();

            $total_supports = 0;
            if(!is_null($supports)){
                foreach($supports as $support){
                    $total_supports += $support->monthly_amount_recibed;
                }
            }
            return $total_supports;
        }else{
            return 0;
        }
    }

    /**
     * @return mixed
     */
    public function getTotalEarningsMonthlyAttribute()
    {
        return $this->total_support_earnings_monthly + $this->total_reward_earnings_monthly;
    }

    /**
     * @return boolean
     */
    public function getYourFirstPostAttribute()
    {
        $posts_video = $this->posts->count();
        return $posts_video > 0 ? false : true;
    }

    /**
     * @return boolean
    */
    public function getOneCreditWeekAttribute()
    {
        $posts_week = $this::where('username', $this->username)->whereHas('posts', function($u){
            $u->whereBetween( DB::raw("(DATE_FORMAT(created_at,'%Y-%m-%d'))"),  [CarbonImmutable::now()->startOfWeek()->format('Y-m-d'), CarbonImmutable::now()->endOfWeek()->format('Y-m-d')]);
        })->get();


        return sizeof($posts_week) == 0 ? true : false;
    }

    /**
     * @param $value
     */
    public function setContributorTypeAttribute($value)
    {
        $this->attributes['contributor_type'] = strtoupper($value);
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
     * @param $value
     */
    public function setBadgeVerificationAttribute($value)
    {
        $this->attributes['badge_verification'] = \Carbon\Carbon::now();
    }

    /**
     * personalInformation function
     *
     * @return HasOne
     */
    public function personal_information(): HasOne
    {
        return $this->hasOne(\App\Models\User\UserPersonalInformation::class);
    }

    /**
     * post function
     *
     * @return HasMany
     */
    public function posts(): HasMany
    {
        return $this->hasMany(\App\Models\Post\Post::class);
    }

    /**
     * @return HasMany
     */
    public function comment(): HasMany
    {
        return $this->hasMany(\App\Models\Comment\Comment::class);
    }

    /**
     * @return HasOne
     */
    public function profile_information(): HasOne
    {
        return $this->hasOne(\App\Models\User\UserProfileInformation::class);
    }

    /**
     * @return HasMany
     */
    public function social_auth(): HasMany
    {
        return $this->hasMany(\App\Models\User\UserSocialAuth::class);
    }

    /**
     * @return HasMany
     */
    public function followers(): HasMany
    {
        return $this->hasMany(\App\Models\Reactions\Followers::class);
    }

    /**
     * @return HasMany
     */
    public function following(): HasMany
    {
        return $this->hasMany('\App\Models\Reactions\Followers', 'following_user', 'id');
    }

    /**
     * @return HasMany
     */
    public function rewards(): HasMany
    {
        return $this->hasMany(\App\Models\Reactions\Rewards::class);
    }

    /**
     * @return mixed
     */
    public function rewardsWithDeleted()
    {
        return $this->hasMany(\App\Models\Reactions\Rewards::class)->withTrashed();
    }

    /**
     * @return HasMany
     */
    public function rewarding(): HasMany
    {
        return $this->hasMany('\App\Models\Reactions\Rewards', 'rewarding_user', 'id');
    }

    /**
     * @return HasMany
     */
    public function supports(): HasMany
    {
        return $this->hasMany(\App\Models\Reactions\Supports::class);
    }

    /**
     * @return mixed
     */
    public function supportsWithTrashed()
    {
        return $this->hasMany(\App\Models\Reactions\Supports::class)->withTrashed();
    }

    /**
     * @return HasMany
     */
    public function supporting(): HasMany
    {
        return $this->hasMany('\App\Models\Reactions\Supports', 'supporting_user', 'id');
    }

    /**
     * @return HasMany
     */
    public function playlists(): HasMany
    {
        return $this->hasMany(\App\Models\Channel\Playlist::class);
    }

    /**
     * @return HasMany
     */
    public function suggestions(): HasMany
    {
        return $this->hasMany(\App\Models\Extras\Suggestions::class);
    }

    /**
     * @return HasOne
     */
    public function channel_information(): HasOne
    {
        return $this->hasOne(\App\Models\User\UserChannelInformation::class);
    }

    /**
     * @return BelongsTo
     */
    public function user_channel_information(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User\UserChannelInformation::class);
    }

    /**
     * @return HasOne
     */
    public function subscription_settings(): HasOne
    {
        return $this->hasOne(\App\Models\Payments\SubscriptionSettings::class);
    }

    /**
     * @return HasMany
     */
    public function payments(): HasMany
    {
        return $this->hasMany(\App\Models\Payments\Payments::class);
    }

    /**
     * @return HasMany
     */
    public function payment_methods(): HasMany
    {
        return $this->hasMany(\App\Models\Payments\PaymentMethodsInformation::class);
    }

    /**
     * @return HasOne
     */
    public function payment_ip_data(): HasOne
    {
        return $this->hasOne(\App\Models\Payments\PaymentIpClientData::class);
    }

    /**
     * @return BelongsTo
     */
    public function to_who()
    {
        return $this->belongsTo(\App\Models\Payments\Payments::class);
    }

    /**
     * @return BelongsTo
     */
    public function monthly_goal(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Channel\MonthlyGoal::class);
    }

//    /**
//     * @return HasMany
//     */
//    public function Notifications(): HasMany
//    {
//        return $this->hasMany(\App\Models\Notifications\Notification::class);
//    }
//
//    /**
//     * @return BelongsTo
//     */
//    public function user_notifiable(): BelongsTo
//    {
//        return $this->belongsTo(\App\Models\Notifications\Notification::class);
//    }

    public function sendGeneralNotification($information)
    {
        $this->notify(new \App\Notifications\Reactions\FollowingYou($information));
    }

//    public function receivesBroadcastNotificationsOn()
//    {
//        return 'users.'.$this->id;
//    }
}
