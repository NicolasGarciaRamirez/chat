<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class UserChannelInformation
 * @package App\Models\User
 */
class UserChannelInformation extends Model
{
    use SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = ['why_support','monthly_goal','user_id'];

    /**
     * @var string[]
     */
    protected $hidden = ['created_at','deleted_at','updated_at'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User\User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tiers()
    {
        return $this->hasMany('\App\Models\User\UserTiersInformation', 'channel_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function monthly_goal()
    {
        return $this->hasMany(\App\Models\Channel\MonthlyGoal::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function monthly_goal_last()
    {
        return $this->hasOne(\App\Models\Channel\MonthlyGoal::class)->latest();
    }

    public function reverse_monthly_goal()
    {
        return $this->belongsTo('\App\Models\User\UserChannelInformation', 'user_channel_information_id', 'id');
    }
}
