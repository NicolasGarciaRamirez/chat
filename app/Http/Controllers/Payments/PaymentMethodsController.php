<?php

namespace App\Http\Controllers\Payments;

use App\Http\Traits\PaymentMethods;
use App\Models\Payments\PaymentMethodsInformation;
use App\Models\Payments\PaymentsBilingInformation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class PaymentMethodsController
 * @package App\Http\Controllers\Payments
 */
class PaymentMethodsController extends Controller
{
    use PaymentMethods;

    /**
     * @var \Stripe\StripeClient
     */
    private $stripe;

    /**
     * PaymentMethodsController constructor.
     */
    public function __construct()
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $this->stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
    }

    /**
     * @param Request $request
     * @param $username
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, $username)
    {
        \DB::beginTransaction();
        try {
            $user = \Auth::user();
            $this->stripe->paymentMethods->attach(
                $request->payment_method['id'],
                ['customer' => $user->stripe_id]
            );
            $payment = $this->savePaymentMethod($user, $request->payment_method,$request);
            \DB::commit();
            return response()->json([
                'saved' => true,
                'paymentMethod' => $payment->load('biling_information')
            ]);
        }catch (\Exception $e){
            \DB::rollBack();
            return response()->json([
                'saved' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * @param Request $request
     * @param $username
     * @return \Illuminate\Http\JsonResponse|Request
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function update(Request $request, $username)
    {
        $payment_updated = $this->stripe->paymentMethods->update(
            $request->payment_methods->card_id,
            [
                'card' => $request->payment_methods->card
            ]
        );

        return response()->json([
            'updated' => true,
            'payment_method' => $payment_updated
        ]);
    }

    /**
     * @param $username
     * @param PaymentMethodsInformation $payment_method
     * @return \Illuminate\Http\JsonResponse
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function delete($username, PaymentMethodsInformation $payment_method)
    {
        $this->stripe->paymentMethods->detach(
            $payment_method->card_id,
            []
        );
        $payment_method->delete();
        return response()->json([
            'deleted' => true
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function get(Request $request)
    {
        $payment_method = $this->stripe->paymentMethods->retrieve(
            $request->payment_method,
            []
        );
        return response()->json([
            'payment_method' => $payment_method,
            'payment_method_default' => \Auth::user()->defaultPaymentMethod()->id === $payment_method->id
        ]);
    }
}
