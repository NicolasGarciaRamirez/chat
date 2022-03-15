<?php

namespace App\Models\Payments;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Payments
 * @package App\Models\Payments
 */
class Payments extends Model
{
    use SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = ['amount','type', 'to_who', 'payment_token','user_id'];

    /**
     * @var string[]
     */
    protected $hidden = ['created_at','updated_at','deleted_at'];

    /**
     * @var string[]
     */
    protected $appends = ['date', 'subscription_active'];

    /**
     * @return string
     */
    public function getDateAttribute()
    {
        return \Carbon\Carbon::parse($this->created_at)->format('Y/m/d');
    }

    public function getSubscriptionActiveAttribute()
    {
        $supports = $this->user->supporting;

        foreach ($supports as $support){
            return $support->tier_id === $this->invoice->tier_id;
        }

    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User\User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function invoice()
    {
        return $this->hasOne(\App\Models\Payments\Invoices::class);
    }


    public function to_who()
    {
        return $this->hasOne('\App\Models\User\User', 'id','to_who');
    }
}
