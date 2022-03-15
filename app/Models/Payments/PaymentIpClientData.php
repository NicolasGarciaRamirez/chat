<?php

namespace App\Models\Payments;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentIpClientData extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'ip',
        'type',
        'continent_code',
        'continent_name',
        'region_code',
        'country_name',
        'region_code',
        'region_name',
        'city',
        'zip',
        'latitude',
        'longitude',
        'currency',
        'user_id'
    ];

    protected $hidden = [
        'updated_at', 'created_at' , 'deleted_at'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User\User::class);
    }
}
