<?php

namespace App\Models\Channel;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class MonthlyGoal
 * @package App\Models\Channel
 */
class MonthlyGoal extends Model
{
    use SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = ['monthly_goal','currency','user_channel_information_id', 'user_id'];

    /**
     * @var string[]
     */
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @var string[]
     */
    protected $appends = ['current_earnings','date_end','percentage_completed'];

    /**
     * @return string
     * @throws \Exception
     */
    public function getDateEndAttribute()
    {
        $date = new Carbon($this->created_at);
        $date->format('m-Y');
        return $date->addMonth()->format('m-Y');
    }

    /**
     * @return false|float
     */
    public function getPercentageCompletedAttribute()
    {
        if(intval($this->monthly_goal) !== 0){
            $total = (intval($this->current_earnings) * 100)/(intval($this->monthly_goal));
            return round($total);
        }else{
            return intval($this->current_earnings) > 0 ? 100 : 0;
        }

    }

    /**
     * @return mixed
     */
    public function getCurrentEarningsAttribute()
    {
      return $this->user_channel_information->user->total_earnings_monthly;
    }

    /**
     * @return string
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function getCurrencyAttribute()
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $balance = \Stripe\Balance::retrieve(
            ['stripe_account' => $this->user_channel_information->user->customer_id]
        );
        if($balance->available[0]->currency === 'eur'){
            $currency = '€';
        }else if($balance->available[0]->currency === 'gbp'){
            $currency = '£';
        }else{
            $currency = '$';
        }
        return $currency;
    }

    public function setMonthlyGoalAttribute($value)
    {
        $this->attributes['monthly_goal'] = number_format($value, '2' , '.' ,'');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function channel_information()
    {
        return $this->belongsTo(\App\Models\User\UserChannelInformation::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user_channel_information()
    {
        return $this->hasOne('\App\Models\User\UserChannelInformation', 'id', 'user_channel_information_id');
    }
}
