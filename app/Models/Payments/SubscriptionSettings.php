<?php

namespace App\Models\Payments;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SubscriptionSettings
 * @package App\Models\Payments
 */
class SubscriptionSettings extends Model
{
    use SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = ['amount','date_subscription_start', 'date_subscription_end', 'payment_cycle', 'user_id'];

    /**
     * @var string[]
     */
    protected $hidden = ['created_at','updated_at','deleted_at'];

    /**
     * @var string[]
     */
    protected $appends = ['subscription_status'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User\User::class);
    }

    /**
     * @return string
     */
    public function getSubscriptionStatusAttribute()
    {
        $date_start = \Carbon\Carbon::parse($this->date_subscription_start);
        $user = \App\Models\User\User::whereId($this->user_id)->first();
        if($user->contributor_type === 'SUBSCRIPTION'){
            if($date_start->diffInMonths(\Carbon\Carbon::now()->format('Y-m-d')) >= 1){
                return 'Terminated';
            }else {
                return 'Active';
            }
        }else if($user->contributor_type === 'PERCENTAGE'){
            return 'Active';
        }
    }

}
