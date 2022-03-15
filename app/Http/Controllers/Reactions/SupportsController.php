<?php

namespace App\Http\Controllers\Reactions;

use App\Models\Payments\Payments;
use App\Models\Reactions\Supports;
use App\Models\User\User;
use App\Models\User\UserBilingInformation;
use App\Models\User\UserTiersInformation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class SupportsController
 * @package App\Http\Controllers\Reactions
 */
class SupportsController extends Controller
{
    /**
     * @var
     */
    private $user;

    /**
     * @var \Stripe\StripeClient
     */
    private $stripe;

    private $value;

    /**
     * FollowersController constructor.
     */
    public function __construct()
    {
        // se autentica con estripe
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        // se crea la instancia de stripe
        $this->stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

        $this->middleware(function ($request, $next) {
            if (!$user = User::whereUsername($request->username)->first()) return abort(404);
            $this->user = $user;
            $this->user->load('personal_information', 'posts', 'profile_information.members', 'profile_information.releases');
            return $next($request);
        });
    }


    /**
     * @param $username
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    //$user es el usuario al que me estoy subscribiendo
    public function save($username, Request $request, $user)
    {
        \DB::beginTransaction();
        try {
            $tier = UserTiersInformation::whereId($request->tier_id)->first();
            $user = User::whereUsername($user)->first();
            $support                         = new Supports($request->all());
            $support->supporting_user        = $this->user->id;
            $support->tier_id                = $request->tier_id;
            // debo validar si el usuario receptor esta fuera de europa
            // y obtener el aplication fee para el monthly_amount_recibed
            if($user->customer_id){
                if($user->country !== 'Canada'){
                    $transfer = $this->stripe->transfers->all(['created' => ['lte' => \Carbon\Carbon::now()->timestamp],'destination' => $user->customer_id, 'limit' => 1]);
                    $this->value = $transfer->data[0]->amount;
                }else{
                    $this->value = intval($tier->amount) - (((intval($tier->amount) * 2.9)/100) + 0.30) - (intval($tier->amount) * 0.15);
                }
            }
            $support->monthly_amount_recibed = $this->value;
//            dd($support, $this->value, intval($support->amount) - (((intval($support->amount) * 2.9)/100) + 0.30) - (intval($support->amount) * 0.15) );
//            ? $transfer->data[0]->amount
//            : $support->amount - (($support->amount * 15)/100) - ((($support->amount) * 2.9 / 100) + 0.30);
            $user->supports()->save($support);
            \DB::commit();
            return response()->json([
                'saved' => true,
                'support' => $support->load('user'),
                'supportings' => Supports::where('supporting_user', $this->user->id)->with('supporting')->get(),
                'errors' => null
            ], 200);
        } catch (\Exception $e){
            \DB::rollback();
            return response()->json([
                'saved' => false,
                'support' => null,
                'supportings' => null,
                'errors' => [$e->getMessage(), $e->getFile(), $e->getTrace()]
            ], 500);
        }

    }

    /**
     * @param $username
     * @param $support
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($username, Supports $support)
    {
        \DB::beginTransaction();
        try {

            // se debe verificar si el receptor esta fuera de eu, y asi traer las subscripciones de la cuenta conectada
            // ya que en nuestra propia cuenta no podremos visualizar estas subscripciones
            $support->load('supporting.channel_information.tiers');
            $subscriptions = $support->supporting->country === 'Canada'
                ? $this->stripe->subscriptions->all([],['stripe_account' => $support->supporting->customer_id])
                : $this->stripe->subscriptions->all(['customer' => $this->user->stripe_id]);

            // se crea el primer each para recorrer los tiers del usuario
            collect($support->supporting->channel_information->tiers)->each(function($tier) use ($subscriptions, $support ) {
                // se crea este each para obtener los datos de la subscripcion
                collect($subscriptions->data)->each(function ($subscription) use ($subscriptions, $tier, $support){
                    // verifico si la subscripcion pertenece a el tier
                    if(intval($subscription->plan->metadata['tier_id']) === $tier['id']){
                        // se cancela la subscripcion
                        $this->stripe->subscriptions->cancel($subscription->id, [],['stripe_account' => $support->supporting->customer_id]);
                        // se elimina el registro
                        $support->delete();
                        // se rompe el cliclo
                        return false;
                    }
                });
            });
            \DB::commit();
            return response()->json([
                'unSupport' => true,
                'supportings' => Supports::where('supporting_user', $this->user->id)->with('supporting')->get(),
                'errors' => null
            ], 200);
        }catch (\Exception $e){
            \DB::rollBack();
            return response()->json([
                'unSupport' => false,
                'supportings' => null,
                'errors' => [$e->getMessage(), $e->getLine(), $e->getTrace()]
            ],500);
        }

    }
}
