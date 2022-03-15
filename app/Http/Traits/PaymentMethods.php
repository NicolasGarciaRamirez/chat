<?php

namespace App\Http\Traits;

use App\Models\Payments\PaymentMethodsInformation;
use App\Models\Payments\PaymentsBilingInformation;
use Illuminate\Http\Request;

trait PaymentMethods {

    /**
     * Does very basic image validity checking and stores it. Redirects back if somethings wrong.
     * @Notice: This is not an alternative to the model validation for this field.
     *
     * @param Request $request
     * @return $this|false|string
     */
    public function savePaymentMethod($user, $payment_method, Request $request)
    {
        $method_bd                                = new PaymentMethodsInformation();
        $method_bd->card_token                    = $payment_method['token'];
        $method_bd->card_id                       = $payment_method['id'];
        $user->payment_methods()->save($method_bd);

        $biling                         = new PaymentsBilingInformation();
        $biling->country                = $request->biling_information['country'];
        $biling->city                   = $request->biling_information['city'];
        $biling->state                  = $request->biling_information['state'];
        $biling->address                = $request->biling_information['address'];
        $biling->zip_code               = $request->biling_information['zip_code'];
        $method_bd->biling_information()->save($biling);

        return $method_bd;
    }

}
