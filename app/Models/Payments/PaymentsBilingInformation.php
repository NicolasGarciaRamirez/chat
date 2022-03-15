<?php

namespace App\Models\Payments;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class UserBilingInformation
 * @package App\Models\User
 */
class PaymentsBilingInformation extends Model
{
    use SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = ['address', 'country', 'city','state','zip_code','methods_information_id'];

    /**
     * @var string[]
     */
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @var string[]
     */
    protected $appends = ['first_name', 'last_name', 'location'];

    /**
     * @return string
     */
    public function getFirstNameAttribute()
    {
        if(\Auth::check()) {
            $user =  \Auth::user();
            $user->load('personal_information')->get();
            return $user->personal_information->first_name;
        }
        return '';
    }

    /**
     * @return string
     */
    public function getLastNameAttribute()
    {
        if(\Auth::check()){
            $user =  \Auth::user();
            $user->load('personal_information')->get();
            return $user->personal_information->last_name;
        }
        return '';
    }

    public function getLocationAttribute()
    {
        return $this->address.'-'.$this->country.'-'.$this->city.'-'.$this->state.'-'.$this->zip_code;
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User\User::class);
    }

    public function payment_method()
    {
        return $this->belongsTo('\App\Models\Payments\PaymentMethodsInformation', 'id','methods_information_id');
    }
}
