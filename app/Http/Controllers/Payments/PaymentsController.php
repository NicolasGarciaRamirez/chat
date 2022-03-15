<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Reactions\SupportsController;
use App\Http\Traits\PaymentMethods;
use App\Http\Traits\RealIpTrait;
use App\Jobs\BuyerSupportInvoice;
use App\Models\Payments\PaymentIpClientData;
use App\Models\Payments\Payments;
use App\Models\Reactions\Supports;
use App\Models\User\User;
use App\Models\User\UserTiersInformation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Stripe\StripeClient;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use App\Models\Payments\Invoices;

/**
 * Class PaymentsController
 * @package App\Http\Controllers\Payments
 */
class PaymentsController extends Controller
{
    use RealIpTrait, PaymentMethods;
    /**
     * @var
     */
    private $user;

    /**
     * @var string
     */
    private $client_id;

    /**
     * @var mixed
     */
    private $ip_request;

    /**
     * @var mixed
     */
    private $response;

    /**
     * @var int
     */
    private $vta;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var StripeClient
     */
    private $stripe;

    /**
     * @var
     */
    private $price_data;
    /**
     * @var UserTiersInformation
     */
    private $current_plan;
    /**
     * @var UserTiersInformation
     */
    private $next_plan;
    /**
     * @var string
     */
    private $subscription_active;
    /**
     * @var \Stripe\Subscription
     */
    private $subscription_updated;

    private $user_receptor;

    /**
     * UserPayments constructor.
     */
    public function __construct(Request $request = null)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        // se carga la informacion de la ubicacion para no realizar la peticion otra vez a la api
        if($request->username !== null){
            $this->user = User::whereUsername($request->username)->first();
            $this->user->load('payment_ip_data');
        }else{
            $this->user = ['payment_ip_data' => null];
        }

        $this->stripe     = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $this->client_id  = env('STRIPE_CLIENT_ID');
        $this->ip_request = $_SERVER["HTTP_HOST"] === 'www.noisesharks.com' ? $this->getRealIP() : 'check';

        //aca decido que currency poner en el reward
        if($this->user['payment_ip_data'] !== null){
            $this->response = $this->user['payment_ip_data'] ;
            $this->response->currency = json_decode($this->response->currency);
        }else{
            $this->response = json_decode(file_get_contents('https://api.ipstack.com/'.$this->ip_request.'?access_key='.env('CLIENT_IP_STACK_LOCATION') , true));
        }

        $this->vta        = $this->response->continent_code === 'EU' ? 20 : 0;
        $this->currency   = $this->response->currency->code === 'COP' ? 'USD' : $this->response->currency->code;
    }

    /**
     * @param $username
     * @param Request $request
     * @return JsonResponse
     * @throws \Stripe\Exception\OAuth\OAuthErrorException
     */
    // este medoto es para conectar la cuenta de stripe
    public function connectAccountSuccess($username, Request $request)
    {
        // se optiene el usuario
        $this->user = User::whereUsername($username)->first();
        // se crea un token de autenticacion
        $response = \Stripe\OAuth::token([
            'grant_type' => 'authorization_code',
            'code' => $request->token,
        ]);
        // actualizo el customer_id del usuario este empieza por acc por que es la cuenta conectada
        $this->user->customer_id = $response['stripe_user_id'];
        $this->user->update();

        return response()->json([
            'status' => 'success',
            'response' => $response
        ]);
    }

    /**
     * @param $user
     * @param $payment_method
     * @param $request
     */
    // este metodo actualiza el metodo de pago por defeco de stripe y almacena el metodo de pago en nuestra bd
    public function updatePaymentMethod($user, $payment_method, $request)
    {
        $user->updateDefaultPaymentMethod($payment_method['id']);
        $this->savePaymentMethod($user, $payment_method, $request);
    }

    /**
     * @param $username
     * @param Request $request
     * @param User $user
     * @param null $type
     * @param $token
     * @return JsonResponse
     * @throws \Exception
     */
    // este metodo lo utilizo para realizar el support y reward
    // $user es el usuario al que le voy a enviar dinero
    // $this->user es el usuario que esta autenticado
    public function paymentIntent($username, Request $request, $user, $type, $token)
    {
        \DB::beginTransaction();
        try {
            $user = User::whereToken($user)->first();
            $this->user = User::whereUsername($username)->first();
            $this->user->stripe_id ? '' : $this->user->createOrGetStripeCustomer();
            //se actualiza el metodo de pago actual por el que se envia
            $this->user->payment_methods()->each(function($payment_method) use ($request){
                if($request->payment_method['id'] === $payment_method->card_id ){
                    $this->updatePaymentMethod($this->user, $request->payment_method, $request);
                }
            });
            // valid have payment method
            count($this->user->payment_methods()->get()) > 0 ? '' : $this->updatePaymentMethod($this->user, $request->payment_method, $request);

            // se calculan los montos
            $amount_date = $this->calculatePayment($user, $request, $type);

            //payment supporting
            if($type === 'support'){
                $prices = $this->stripe->prices->all(['limit' => 100, 'currency' => strtolower($this->currency)]);
                $array = [];
                foreach ($prices->autoPagingIterator() as $key => $price) {
                    array_push($array, $price);
                }
                foreach ($array as $price){
                    // valido que el precio sea el del usuario al que me quiero subscribir
                    if($price->metadata['username'] === $user->username){
                        if($price->metadata['tier_id'] !== null){
                            //valido que el nivel de precio sea igual al que existe
                            if(intval($price->metadata['tier_id']) === $amount_date['tier_id']){
                                $this->price_data = $price;
                            }
                        }
                    }
                };
                 //si el usuario receptor esta en canada
                if($user->country === 'Canada'){
                    $data = $this->createSubscriptionAccountConnect($user, $amount_date, $request, $token);
                    $paymentIntent = $data['paymentIntent'];
                    // si el usuario esta en europa se agrega el tax-percentage
                }else if($this->response->continent_code === 'EU'){
                    $tax_rate = \Stripe\TaxRate::create([
                        'display_name' => 'VAT',
                        'description'  => 'VAT',
                        'jurisdiction' => 'EU',
                        'percentage'   => 20,
                        'inclusive'    => false,
                    ]);
                    $subscription = \Stripe\Subscription::create([
                        'customer' => $this->user->stripe_id,
                        'items'    => [
                            [
                                'price'     => $this->price_data['id'],
                                'tax_rates' => [$tax_rate->id]
                            ],
                        ],
                        'application_fee_percent' => 15,
                        'transfer_data' => [
                            'destination'    => $user->customer_id
                        ],
                        'trial_period_days'  => \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::now()->addMonth()->firstOfMonth()->addDay())
                    ]);
                    if(\Carbon\Carbon::now() !== \Carbon\Carbon::now()->firstOfMonth()) {
                        $paymentIntent = \Stripe\PaymentIntent::create([
                            'customer' => $this->user->stripe_id,
                            'amount' => $this->price_data['unit_amount'],
                            'currency' => $this->price_data['metadata']['currency'],
                            'metadata' => ['integration_check' => 'accept_a_payment'],
                            'receipt_email' => $this->user->email,
                            'application_fee_amount' => number_format($amount_date['amount_transfer_percentage']),
                            'confirm' => true,
                            'payment_method' => $this->user->defaultPaymentMethod()->id,
                            'transfer_data' => [
                                'destination' => $user->customer_id
                            ]
                        ]);
                    }
                }else{
                    $subscription = \Stripe\Subscription::create([
                        'customer' => $this->user->stripe_id,
                        'items'    => [
                            [
                                'price'     => $this->price_data['id'],
                            ],
                        ],
                        'application_fee_percent' => 15,
                        'default_payment_method' => $this->user->defaultPaymentMethod()->id,
                        'transfer_data' => [
                            'destination'    => $user->customer_id
                        ],
                        'trial_period_days'    => \Carbon\Carbon::now() !== \Carbon\Carbon::now()->firstOfMonth() ? \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::now()->addMonth()->firstOfMonth()->addDay()): 0
                    ]);
                    if(\Carbon\Carbon::now() !== \Carbon\Carbon::now()->firstOfMonth()){
                        $paymentIntent = \Stripe\PaymentIntent::create([
                            'customer'      => $this->user->stripe_id,
                            'amount'        => $this->price_data['unit_amount'],
                            'currency'      => $this->currency,
                            'metadata'      => ['integration_check' => 'accept_a_payment'],
                            'receipt_email' => $this->user->email,
                            'confirm'       => true,
                            'payment_method'=> $this->user->defaultPaymentMethod()->id,
                            'application_fee_amount' => number_format($amount_date['noisesharks_fee'], 2, '', ''),
                            'transfer_data' => [
                                'destination' => $user->customer_id
                            ]
                        ]);
                    }
                }
            } else {
                //payment reward
                if($user->country === 'Canada') {
                   $data = $this->createRewardAccountConnect($user, $token, $amount_date);
                   $paymentIntent = $data['payment_intent'];
                }else{
                    $paymentIntent = \Stripe\PaymentIntent::create([
                        'customer' => $this->user->stripe_id,
                        'payment_method_types' => ['card'],
                        'amount' => number_format($amount_date['total'], '2', '', ''),
                        'currency' => $this->currency,
                        'receipt_email' => $this->user->email,
                        'application_fee_amount' => number_format($amount_date['noisesharks_fee'], 2, '', ''),
                        'transfer_data' => [
                            'destination' => $user->customer_id
                        ]
                    ]);
                }
            }
            $payment_object = $this->generatePaymentAndInvoice($amount_date, $type, $user, $request->payment_method);

            \DB::commit();
            return response()->json([
                'client_secret' => $type !== 'support' ? $paymentIntent->client_secret : '',
                'payment' => $payment_object['payment']->load('invoice'),
                'user' => $this->user,
                'type' => $type,
                'errors' => null
            ]);
        } catch (\Exception $e){
            \DB::rollBack();
            return response()->json([
                'client_secret' => null,
                'payment' => null,
                'user' => null,
                'type' => null,
                'errors' => ['message' => $e->getMessage(), 'line' => $e->getLine(), 'trace' => $e->getTrace()]
            ]);
        }
    }

    // update subscription support
    public function updateSubscriptionIndex($username,$current_plan, $next_plan, Request $request)
    {
        $current_plan = UserTiersInformation::whereId($current_plan)->first();
        $next_plan = UserTiersInformation::find($next_plan);
        $this->user_receptor = \App\Models\User\User::with('channel_information.tiers', 'payments.invoice')->whereUsername($request->username_receptor)->first();
        if($this->user_receptor->country === 'Canada'){
            $subscriptionUpdate = $this->updateSubscriptionStripeAccountConnect($current_plan, $next_plan, $request);
        }else{
            $subscriptionUpdate = $this->updateSubscriptionStripe($current_plan, $next_plan);
        }

        if($subscriptionUpdate['update_subs']){
            Supports::whereId($request->support['id'])->update(['tier_id' => $next_plan->id ]);
            $support = Supports::whereId($request->support['id'])->first();
        }

        $amount_date = $this->calculatePayment($this->user_receptor, $request, 'support');

        $payment_object = $this->generatePaymentAndInvoice($amount_date, 'support', $this->user_receptor, $request->payment_method);

        return response()->json([
            'updated' => true,
            'support' => $support,
            'subscription_updated' => $subscriptionUpdate['update_subs'],
            'type' => 'support',
            'payment' => $payment_object['payment']->load('invoice'),
            'user' => $this->user
        ]);
    }

    /**
     * @throws \Stripe\Exception\ApiErrorException
     * @throws \Exception
     */
    public function updateSubscriptionStripeAccountConnect($current_plan, $next_plan, $request)
    {
        $this->current_plan = $current_plan;
        $this->next_plan = $next_plan;
        $data = $this->stripe->subscriptions->all([], ['stripe_account' => $this->user_receptor->customer_id]);
        $prices = $this->stripe->prices->all(['currency' => strtolower($this->currency)], ['stripe_account' => $this->user_receptor->customer_id]);
        // get new price stripe
        foreach ($prices->autoPagingIterator() as $price){
            if($price->metadata['tier_id'] === strval($this->next_plan->id)){
                $this->next_plan = $price;
            }
        }
        // get current subscription stripe
        $this->subscription_active = '';
        foreach ($data->autoPagingIterator() as $subscription){
            if($subscription->metadata['user_subscribed_token'] === $this->user->token){
                foreach ($subscription->items->data as $items){
                    // se verifica que el tier_id sea igual al de la subscripcion actual
                    if($items->price->metadata['tier_id'] === strval($this->current_plan->id)){
                        $this->subscription_active = $subscription ;
                    }
                }
            }
        }
        // updated subscription
        if($this->subscription_active){
            $this->subscription_updated = $this->stripe->subscriptions->update($this->subscription_active->id,[
                'proration_behavior' => 'none',
                'items' => [
                    [
                        'id' => $this->subscription_active->items->data[0]->id,
                        'price' => $this->next_plan->id
                    ]
                ]
            ] ,['stripe_account' => $this->user_receptor->customer_id] );
        }
        // create payment intent
        if(\Carbon\Carbon::now() !== \Carbon\Carbon::now()->firstOfMonth()){
            $paymentIntent = \Stripe\PaymentIntent::create([
                'customer'      => $this->subscription_active->customer,
                'amount'        => $this->next_plan['unit_amount'],
                'currency'      => $this->next_plan['metadata']['currency'],
                'metadata'      => ['integration_check' => 'accept_a_payment'],
                'receipt_email' => $this->user->email,
                'application_fee_amount' => number_format(($this->next_plan->amount * 0.15), 2, '', ''),
                'confirm'       => true,
                'payment_method_types' => ['card'],
            ],[
                'stripe_account' => $this->user_receptor->customer_id
            ]);
        }


        return [
            'update' => true,
            'errors' => null,
            'update_subs' => $this->subscription_updated
        ];
    }

    public function updateSubscriptionStripe($current_plan, $next_plan)
    {
        $this->current_plan = $current_plan;
        $this->next_plan = $next_plan;
        $data = $this->stripe->subscriptions->all([]);
        $prices = $this->stripe->prices->all(['currency' => strtolower($this->currency)]);
        // get new price stripe
        foreach ($prices->autoPagingIterator() as $price){
            if($price->metadata['tier_id'] === strval($this->next_plan->id)){
                $this->next_plan = $price;
            }
        }
        // get current subscription stripe
        $this->subscription_active = '';
        foreach ($data->autoPagingIterator() as $subscription){
            if($subscription->metadata['user_subscribed_token'] === $this->user->token){
                foreach ($subscription->items->data as $items){
                    // se verifica que el tier_id sea igual al de la subscripcion actual
                    if($items->price->metadata['tier_id'] === strval($this->current_plan->id)){
                        $this->subscription_active = $subscription ;
                    }
                }
            }
        }
        // updated subscription
        if($this->subscription_active){
            $this->subscription_updated = $this->stripe->subscriptions->update($this->subscription_active->id,[
                'proration_behavior' => 'none',
                'items' => [
                    [
                        'id' => $this->subscription_active->items->data[0]->id,
                        'price' => $this->next_plan->id
                    ]
                ]
            ]);
        }
        // create payment intent
        if(\Carbon\Carbon::now() !== \Carbon\Carbon::now()->firstOfMonth()){
            $paymentIntent = \Stripe\PaymentIntent::create([
                'customer'      => $this->subscription_active->customer,
                'amount'        => $this->next_plan['unit_amount'],
                'currency'      => $this->next_plan['metadata']['currency'],
                'metadata'      => ['integration_check' => 'accept_a_payment'],
                'receipt_email' => $this->user->email,
                'application_fee_amount' => number_format(($this->next_plan->amount * 0.15), 2, '', ''),
                'confirm'       => true,
                'payment_method_types' => ['card'],
            ]);
        }
        return [
            'update' => true,
            'errors' => null,
            'update_subs' => $this->subscription_updated
        ];
    }
    /**
     * @param $user
     * @param $token
     * @param $amount_date
     * @return array
     * @throws \Stripe\Exception\ApiErrorException
     */
    // este pago se realiza directamente en la cuenta conectada, para evitar error de transferencias internacionales
    // deberia ser para todos los usuarios receptores fuera de la EU...
    public function createRewardAccountConnect($user, $token, $amount_date): array
    {
        // se le crea el source con el metodo de pago, para que el token se cree bien
        // con esto se evita el error de 'deberia tener un metodo de pago activo'
        // el metodo de pago deberia ser reusable, para esto se debe adjuntar al cliente antes de hacer esto

        $cus = $this->stripe->customers->retrieve($this->user->stripe_id);
        if(!$cus->default_source){
            $this->stripe->customers->createSource(
                $this->user->stripe_id,
                ['source' => $token]
            );
        }

        // se crea el token
        $token = \Stripe\Token::create([
            'customer' => $this->user->stripe_id
        ], [
            'stripe_account' => $user->customer_id,
        ]);
        // se optinen los datos del cliente actual
        $customer_current = \Stripe\Customer::retrieve($this->user->stripe_id);
        // se crea el cliente en la cuenta conectada con los mismos datos del cliente existente
        $customer = \Stripe\Customer::create([
            'name' => $customer_current->name,
            'email' => $customer_current->email,
            'source' => $token->id,
        ],[
            'stripe_account' => $user->customer_id
        ]);
        // se crea el payment intent
        // se confirma el pago de una vez, para no cambiar el js en el front-end
        $paymentIntent = \Stripe\PaymentIntent::create([
            'customer' => $customer->id,
            'payment_method_types' => ['card'],
            'amount' => number_format($amount_date['total'], '2', '', ''),
            'currency' => $this->currency,
            'receipt_email' => $this->user->email,
            'application_fee_amount' => number_format($amount_date['noisesharks_fee'], 2, '', ''),
            'confirm'       => true,
        ],[
            'stripe_account' => $user->customer_id
        ]);

        return [
            'payment_intent' => $paymentIntent
        ];
    }

    /**
     * @param $user
     * @param $amount_date
     * @param $request
     * @param $token
     * @return array
     * @throws \Stripe\Exception\ApiErrorException
     */
    // esta subscripcion se crea directamente en la cuenta conectada,\
    // por lo cual no se va ver el pago en nuestra plataforma si no en la cuenta conectada
    // en nuestra plataforma vamos a poder ver el aplication fee
    public function createSubscriptionAccountConnect($user, $amount_date, $request, $token): array
    {
        // se obtienen los precios creados en la cuenta conectada
        $prices = $this->stripe->prices->all(['limit' => 100, 'currency' => strtolower($this->currency)], ['stripe_account' => $user->customer_id]);
        $array = [];
        foreach ($prices->autoPagingIterator() as $key => $price) {
            array_push($array, $price);
        }
        foreach ($array as $price){
            // valido que el precio sea el del usuario al que me quiero subscribir
            if($price->metadata['username'] === $user->username){
                if($price->metadata['tier_id'] !== null){
                    //valido que el nivel de precio sea igual al que existe
                    if(intval($price->metadata['tier_id']) === $amount_date['tier_id']){
                        $this->price_data = $price;
                    }
                }
            }
        };
        // se le crea el source al cliente
        $cus = $this->stripe->customers->retrieve($this->user->stripe_id);
        if(!$cus->default_source){
            $this->stripe->customers->createSource(
                $this->user->stripe_id,
                ['source' => $token]
            );
        }

        // se crea el token
        $token = \Stripe\Token::create([
            'customer' => $this->user->stripe_id
        ], [
            'stripe_account' => $user->customer_id,
        ]);
        // se crea el cliente en la cuenta conectada si ya existe se optiene
        $customer_current = \Stripe\Customer::retrieve($this->user->stripe_id);

        $customer = \Stripe\Customer::create([
            'name' => $customer_current->name,
            'email' => $customer_current->email,
            'source' => $token->id,
        ],[
            'stripe_account' => $user->customer_id
        ]);

        // se crea la subscripcion en la cuenta conectada, con los precios de la cuenta conectada,
        // se cobra el aplication fee percentage.

        if($this->response->continent_code === 'EU'){
            $tax_rate = \Stripe\TaxRate::create([
                'display_name' => 'VAT',
                'description'  => 'VAT',
                'jurisdiction' => 'EU',
                'percentage'   => 20,
                'inclusive'    => false,
            ],['stripe_account' => $user->customer_id]);

            $subscription = \Stripe\Subscription::create([
                'customer' => $customer->id,
                'items'    => [
                    [
                        'price'     => $this->price_data['id'],
                        'tax_rates' => [$tax_rate->id]
                    ],
                ],
                'metadata' =>[
                    'user_subscribed_token' => $this->user->token
                ],
                'application_fee_percent' => 15,
                'trial_period_days'    => \Carbon\Carbon::now() !== \Carbon\Carbon::now()->firstOfMonth()
                    ? \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::now()->addMonth()->firstOfMonth()->addDay())
                    : 0,
            ],['stripe_account' => $user->customer_id]);
        }else{
            $subscription = \Stripe\Subscription::create([
                'customer' => $customer->id,
                'items'    => [
                    [
                        'price'     => $this->price_data['id'],
                    ],
                ],
                'metadata' =>[
                    'user_subscribed_token' => $this->user->token
                ],
                'application_fee_percent' => 15,
                'trial_period_days'    => \Carbon\Carbon::now() !== \Carbon\Carbon::now()->firstOfMonth()
                    ? \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::now()->addMonth()->firstOfMonth()->addDay())
                    : 0,
            ],['stripe_account' => $user->customer_id]);
        }

        // verifico que no estemos a principio de mes, y si no se crea un payment intent
        // por el valor de de la subscripcion, se cobra el aplication fee amount..
        if(\Carbon\Carbon::now() !== \Carbon\Carbon::now()->firstOfMonth()){
            $paymentIntent = \Stripe\PaymentIntent::create([
                'customer'      => $customer->id,
                'amount'        => $this->price_data['unit_amount'],
                'currency'      => $this->price_data['metadata']['currency'],
                'metadata'      => ['integration_check' => 'accept_a_payment'],
                'receipt_email' => $this->user->email,
                'application_fee_amount' => number_format($amount_date['noisesharks_fee'], 2, '', ''),
                'confirm'       => true,
                'payment_method_types' => ['card'],
            ],[
                'stripe_account' => $user->customer_id
            ]);
        }
        // se retorna un arreglo para que el flujo del metodo principal este bien..
        return [
            'subscription' => $subscription,
            'paymentIntent' => $paymentIntent
        ];
    }

    /**
     * @param $username
     * @param Request $request
     * @return JsonResponse
     * @throws \Stripe\Exception\ApiErrorException
     */
    // se deberia crear un token para cada vez que se intente realizar un pago
    // el token se deberia crear desde js stripe
    public function createTokenPayment($username, Request $request)
    {
        $token = $this->stripe->tokens->create([
            'card' => $request->card
        ]);

        return response()->json(['token' => $token]);
    }

    /**
     * @param $amount_date
     * @param $type
     * @param $user
     * @param $payment_method
     * @return Payments[]|array
     * @throws \Exception
     */
    public function generatePaymentAndInvoice($amount_date, $type, $user, $payment_method)
    {
        \DB::beginTransaction();
        try{
            $payment         = new \App\Models\Payments\Payments();
            $payment->amount = $amount_date['total'];
            $payment->type   = $type;
            $payment->to_who = $user->id;
            $payment->payment_token = $payment_method['token'] ;
            $this->user->payments()->save($payment);

            $invoice                   = new Invoices();
            $invoice->invoice_number   = Str::random(10);
            $invoice->expedition_date  = \Carbon\Carbon::now()->format('Y-m-d H-m-s');
            $invoice->location         = $this->response->continent_name.'-'.$this->response->country_name.'-'.$this->response->region_name.'-'.$this->response->city.'-'.$this->response->zip;
            $invoice->amount_net       = $amount_date['tier_amount'];
            $invoice->amount_total     = $amount_date['total'];
            $invoice->description      = $type !== 'support' ? 'One-off Donation' : 'Monthly Support';
            $invoice->vta              = $amount_date['vta_total'];
            $invoice->payment_gateway  = $amount_date['gateway'];
            $invoice->currency         = $this->response->currency->symbol === 'CO$' ? '$' : $this->response->currency->symbol;
            $invoice->payment_method   = $this->user->card_brand.' **** '.$this->user->card_last_four;
            $invoice->tier_id          = $amount_date['tier_id'];
            $payment->invoice()->save($invoice);

            //Enviar correo Buyer segun el tipo Support o Reward
            if($type == "reward"){
                \Mail::to($this->user->email)->send(new \App\Mail\BuyerViewRewardReceipt($user, $payment));
            }else if($type == "support"){
                \Mail::to($this->user->email)->send(new \App\Mail\BuyerViewSupportReceipt($user, $payment));
            }

            $payment_user         = new \App\Models\Payments\Payments();
            $payment_user->amount = $amount_date['total'];
            $payment_user->type   = $type.' receive';
            $payment_user->to_who = $this->user->id;
            $payment_user->payment_token = 'N/A';
            $user->payments()->save($payment_user);

            $invoice_user                   = new Invoices();
            $invoice_user->invoice_number   = Str::random(10);
            $invoice_user->expedition_date  = \Carbon\Carbon::now()->format('Y-m-d H-m-s');
            $invoice_user->location         = $this->response->continent_name.'-'.$this->response->country_name.'-'.$this->response->region_name.'-'.$this->response->city.'-'.$this->response->zip;
            $invoice_user->amount_net       = $amount_date['tier_amount'];
            $invoice_user->amount_total     = $amount_date['amount_transfer_percentage'];
            $invoice_user->description      = $type !== 'support' ? 'One-off Donation' : 'Monthly Support';
            $invoice_user->vta              = $amount_date['vta_total'];
            $invoice_user->noisesharks_fee  = $amount_date['noisesharks_fee'];
            $invoice_user->payment_gateway  = $amount_date['gateway'];
            $invoice_user->currency         = $this->response->currency->symbol === 'CO$' ? '$' : $this->response->currency->symbol;
            $invoice_user->payment_method   = $user->card_brand.' **** '.$user->card_last_four;
            $invoice_user->tier_id          = $amount_date['tier_id'];
            $payment_user->invoice()->save($invoice_user);
            //Enviar correo Seller segun el tipo Support o Reward
            if($type == "reward"){
                \Mail::to($user->email)->send(new \App\Mail\SellerViewRewardReceipt($user, $payment_user));
            }else if($type == "support"){
                \Mail::to($user->email)->send(new \App\Mail\SellerViewSupportReceipt($user, $payment_user));
            }
            \DB::commit();

            return [
                'payment' => $payment
            ];
        } catch (\Exception $e){
            \DB::rollBack();
            return [
                'payment' => null,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * @param Request $request
     * @param $type
     * @return JsonResponse
     * @throws \Stripe\Exception\ApiErrorException
     */
    // este metodo es para la subscripcion a nuestra plataforma
    public function paymentIntentSubscription(Request $request, $type)
    {
        $vta_total = (10 * $this->vta) / 100;
        $amount = number_format(intval(10) + intval($vta_total) , '2', '','' ) ;
        $paymentIntent = \Stripe\PaymentIntent::create([
            'amount'             => $amount,
            'currency'           => $this->currency,
            'setup_future_usage' => 'off_session',
            'metadata'           => ['integration_check' => 'accept_a_payment', 'type' => 'payment subscription noisesharks'],
        ]);

        return response()->json([
            'client_secret' => $paymentIntent->client_secret,
        ]);
    }

    /**
     * @param Request $request
     * @param $type
     * @param $username
     * @return JsonResponse
     * @throws \Stripe\Exception\ApiErrorException
     */
    // este metodo es para la actualizar subscripcion a nuestra plataforma
    public function paymentIntentUpdateSubscription(Request $request, $type, $username)
    {
        \DB::beginTransaction();
        try {
            $this->user = User::whereUsername($username)->first();
            $vta_total = (10 * $this->vta) / 100;
            $amount = number_format(intval(10) + intval($vta_total) , '2', '','' ) ;
            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount'             => $amount,
                'currency'           => $this->currency,
                'setup_future_usage' => 'off_session',
                'metadata'           => ['integration_check' => 'accept_a_payment', 'type' => 'update subscription noisesharks'],
                'confirm'            => true,
                'payment_method'     => $request->payment_method['id']
            ]);

            $payment = new \App\Models\Payments\Payments();
            $payment->amount = 10 + $vta_total;
            $payment->type   = $type === 'Percentage' ? 'NS Fee' : $type;
            $payment->to_who = $this->user->id;
            $payment->payment_token = $request->payment_method['token'];
            $this->user->payments()->save($payment);

            $invoice = new Invoices();
            $invoice->invoice_number    = \Str::random(10);
            $invoice->expedition_date   = \Carbon\Carbon::now()->format('Y-m-d H-m-s');
            $invoice->location          = $this->response->continent_code.'-'.$this->response->continent_name.'-'.$this->response->country_code.'-'.$this->response->country_name.'-'.$this->response->region_code.'-'.$this->response->region_name.'-'.$this->response->city.'-'.$this->response->zip;
            $invoice->amount_net        = 10;
            $invoice->amount_total      = 10 + $vta_total;
            $invoice->description       = 'One-off joining fee';
            $invoice->vta               = $vta_total;
            $invoice->payment_gateway   = ((2.9 * 10) / 100) + 0.30;
            $invoice->currency          = $this->response->currency->symbol === 'CO$' ? '$' : $this->response->currency->symbol;
            $invoice->payment_method    = $this->user->card_brand.' **** '.$this->user->card_last_four;
            $payment->invoice()->save($invoice);

            \DB::commit();
            return response()->json([
                'client_secret' => $paymentIntent->client_secret,
                'payment' => $payment->load('invoice'),
                'user' => $this->user,
                'error' => null
            ]);
        }catch (\Exception $e){
            \DB::rollBack();
            return response()->json([
                'client_secret' => null,
                'payment' => null,
                'user' => null,
                'error' => [
                    'message' => $e->getMessage(),
                    'code' => $e->getCode()
                ]
            ]);
        }
    }

    /**
     * @param $user
     * @param $summary
     * @param $type
     * @return array
     */
    // este medoto calcula el pago a realizar suma el gateway y el vta dependiendo de si el typo es support o reward

    public function calculatePayment($user, $request, $type)
    {

        // si es un support se obtiene el precio del tier almacenado en nuestra bd
        if($type === 'support'){
            $tier = UserTiersInformation::whereChannelId($user->channel_information->id)->whereId($request->summary['tier']['tier_id'])->first();
        }
        // si es un reward solamente se optine el summary
        if($type === 'reward'){
            $tier = $request->summary;
        }

        $data_credit = $this->debitCredit($user, $tier);
        //tax percentage
        $vta_total = (($tier['amount'] * $this->vta) / 100);
        //fee stripe
        $gateway = (((($tier['amount']) * 2.9) / 100) + .30);
        //total amount
        $total = ($tier['amount'] + $vta_total);
        //fee noisesharks
        $noisesharks_fee = $data_credit->fee;
        //amount mode percentage per rewards
        $amount_transfer_percentage = $tier['amount'] - $gateway - $noisesharks_fee;
        //amount mode percentage per supports
        $amount_transfer_percentage_support = number_format(($amount_transfer_percentage * 100 ) / $total ,  '2', '.','');
        //amount mode subscription reward
        $amount_transfer_subscription = (($total - $gateway) - $vta_total);
        //amount mode subscription support
        $amount_transfer_subscription_support = number_format(($amount_transfer_subscription * 100 ) / $total ,  '2', '.','');

        return [
            'tier_amount' => $tier['amount'],
            'total' => $total,
            'noisesharks_fee' => $noisesharks_fee,
            'gateway' => $gateway,
            'vta_total' => $vta_total,
            'amount_transfer_percentage' => $amount_transfer_percentage,
            'amount_transfer_subscription' => $amount_transfer_subscription,
            'amount_transfer_percentage_support' => $amount_transfer_percentage_support,
            'amount_transfer_subscription_support' => $amount_transfer_subscription_support,
            'tier_id' => $type === 'support' ? $tier->id : null
        ];
    }

    public function debitCredit($user, $tier): object
    {

        //porcentage: este codigo calcula el porcentage a cobrar
        //fee: el monto que noisesharks debe cobrar
        //remaining: y lo que le queda al usuario

        $current_credit = $user->credit;
        $data = (object) array('porcentage' => '', 'fee' => '', 'remaining' => '');
        //Calcular porcentaje a cobrar
        if($current_credit > 0){

            //se obtiene el 15% a cobrar
            $fee = $tier['amount'] * 0.15;

            //verificando si el credito del usuario da para cobrarle el 15% de fee
            if($current_credit >= $fee){
                $porcentaje_cobrar = 15;

                $data->porcentaje = $porcentaje_cobrar;
                $data->fee = 0;
                $data->remaining = $current_credit - ($porcentaje_cobrar / 100);
            }else{
                //si del credito no es posible descontar en 15 de comision se calcula el porcentaje posible para
                //descontarle la comison del credito
                $calcular_porcentaje = round($current_credit / $tier['amount'], 4);
                $porcentaje_cobrar  = $calcular_porcentaje * 100;

                $fee = $tier['amount'] * $calcular_porcentaje;

                $data->porcentaje = $porcentaje_cobrar;
                $data->fee = $fee;
                $data->remaining = $current_credit - ($porcentaje_cobrar / 100);
            }
            return $data;
        }
    }

    // se obtienen los pagos echos que estan almacenados en nuestra bd con el payment_token enviado en el request
    public function getPaymentsActivity($username, Request $request)
    {
        $payments = \App\Models\Payments\Payments::with('user', 'to_who')->where('payment_token',$request->payment_method)->get();
        return response()->json([
            'payments'=> $payments
        ]);
    }
}
