<?php

namespace App\Models\Payments;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PaymentMethodsInformation
 * @package App\Models\Payments
 */
class PaymentMethodsInformation extends Model
{
    use SoftDeletes;
    /**
     * @var string[]
     */
    protected $fillable = ['card_token','card_id','user_id'];

    /**
     * @var string[]
     */
    protected $hidden = ['updated_at', 'created_at','deleted_at'];

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
    public function biling_information()
    {
        return $this->hasOne('\App\Models\Payments\PaymentsBilingInformation', 'methods_information_id', 'id');
    }
}
