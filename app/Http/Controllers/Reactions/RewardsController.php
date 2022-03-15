<?php

namespace App\Http\Controllers\Reactions;

use App\Models\Reactions\Rewards;
use App\Models\Reactions\Supports;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class RewardsController
 * @package App\Http\Controllers\Reactions
 */
class RewardsController extends Controller
{
    /**
     * @var
     */
    private $user;

    private $value;
    /**
     * FollowersController constructor.
     */
    public function __construct()
    {
        // se autentica con stripe
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        // verifica que el usuario esta esta autenticado y se obtienen las relaciones
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
    public function save($username, Request $request, $user)
    {
        \DB::beginTransaction();
        try {
            $user = User::whereUsername($user)->first();
            $reward = new Rewards($request->all());
            $reward->rewarding_user = $this->user->id;

            // debo validar si el receptor esta fuera de eu,
            // se deberia obtener el aplication fee para almacenarlo
            // en nuestra bd

            if($user->customer_id){
                $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

                if($user->country !== 'Canada'){
                    $transfer = $stripe->transfers->all(['created' => ['lte' => \Carbon\Carbon::now()->timestamp],'destination' => $user->customer_id, 'limit' => 1]);
                    $this->value = strlen($transfer->data[0]->amount);
                }else{
                    $aplications_fees = $stripe->applicationFees->all(['limit' => 20]);
                    $all_aplication_fees = [];
                    foreach ($aplications_fees->autoPagingIterator() as $fee){
                        array_push($all_aplication_fees, $fee);
                    }
                    foreach ($all_aplication_fees as $fee_all){
                        if($fee_all->account === $user->customer_id){
                            $charge = $stripe->charges->all([
                                    ['created' => ['lte' => \Carbon\Carbon::now()->timestamp], 'limit' => 1]]
                                ,['stripe_account' => $user->customer_id]);
                            $charge = $charge->data[0];
                            if($charge->application_fee === $fee_all->id){
                                $stripe_fee =  ($charge->amount * 0.029) + 0.30;
                                $noisesharks_fee = $fee_all->amount;
                                $amount = $charge->amount - $stripe_fee - $noisesharks_fee;

                                $this->value = $amount > 665
                                    ? number_format($amount,'2' , '.', '')
                                    : '0.'.number_format($amount,'0' , '.', '');
                            }
                        }
                    }
                }
            }
            $reward->amount_recibed = $this->value;
//            ? $value
            // se resta el amount, se le resta el 15% noisesharks, y se le resta el 2.9% de stripe mas 0.30 tarifa de stripe
//            : $reward->amount - ($reward->amount * 0.15) - ((($reward->amount) * 2.9 / 100) + 0.30);
            $user->rewards()->save($reward);
            \DB::commit();
            return response()->json([
                'saved' => true,
                'reward' => $reward->load('user'),
                'rewardings' => Rewards::where('rewarding_user', $this->user->id)->with('rewarding')->get(),
                'errors' => null,
                'fee_all' => $fee_all
            ], 200);
        } catch (\Exception $e){
            \DB::rollBack();
            return response()->json([
                'saved' => null,
                'reward' => null,
                'rewardings' => null,
                'errors' => [$e->getMessage(), $e->getLine(), $e->getTrace()],
            ], 500);
        }
    }

    /**
     * @param $username
     * @param Rewards $reward
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */

    // este metodo esta obsoleto no lo estamos utilizando ya que un reward no se puede deshacer
    public function delete($username, Rewards $reward)
    {
//        $reward->delete();
//        return response()->json([
//            'unReward' => true,
//            'rewardings' => Rewards::where('rewarding_user', $this->user->id)->with('rewarding')->get()
//        ]);
    }
}
