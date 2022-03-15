<?php

namespace App\Models\Payments;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Invoices
 * @package App\Models\Payments
 */
class Invoices extends Model
{
    use SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = ['invoice_number', 'expedition_date', 'location', 'amount_net', 'amount_total', 'noisesharks_fee','description', 'vta', 'payment_method', 'tier_id','payment_id'];

    /**
     * @var string[]
     */
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function payment()
    {
        return $this->belongsTo(\App\Models\Payments\Payments::class);
    }

    public function tier()
    {
        return $this->hasOne('\App\Models\User\UserTiersInformation', 'id', 'tier_id');
    }
}
