<?php

namespace App\Http\Controllers\User;

use App\Http\Traits\RealIpTrait;
use App\Models\Channel\MonthlyGoal;
use App\Models\User\UserTiersInformation;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User\User;
use App\Models\User\UserChannelInformation;
use Laravel\Cashier\Cashier;


/**
 * Class UserChannelInformationController
 * @package App\Http\Controllers\User
 */
class UserChannelInformationController extends Controller
{
    use RealIpTrait;
    /**
     * @var
     */
    private $user;

    /**
     * @var \Stripe\StripeClient
     */
    private $stripe;

    /**
     * @var
     */
    private $customer;

    /**
     * @var
     */
    private $price;

    /**
     * @var
     */
    private $product;

    /**
     * @var
     */
    private $subscription;

    /**
     * @var
     */
    private $tier;

    /**
     * @var string[]
     */
    private $currencies;

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $this->stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $this->currencies = array('USD','GBP','EUR');
        $this->middleware(function ($request, $next) {
            if (!$user = User::whereUsername($request->username)->first()) return abort(404);
            $this->user = $user;
            $this->user->load('personal_information', 'social_auth', 'playlists.playlist_post.post.comments', 'followers.user.followers.user.personal_information', 'followers.user.followers.user.profile_information', 'followers.user.profile_information', 'followers.user.personal_information','posts.user','posts.views' ,'posts.comments.comments.likes.user', 'posts.likes.user', 'posts.votes.user', 'posts.shares' ,'profile_information.members', 'profile_information.releases', 'profile_information.worked_with', 'payment_ip_data');
            return $next($request);
        });


    }

    /**
     * @param $username
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function save($username, Request $request)
    {
        \DB::beginTransaction();
        try {
            $monthly = new MonthlyGoal(\Arr::except($request->monthly_goal_last, ['date_end','percentage_completed']));
            $channel = new UserChannelInformation($request->except('monthly_goal_last'));
            $this->user->channel_information()->save($channel);
            $channel->monthly_goal()->save($monthly);

            collect($request->tiers)->each(function ($query) use ($channel){
                $this->product = $this->stripe->products->create([
                    'name' => $query['name'],
                ]);

                $tier = new UserTiersInformation();
                $tier->name = $query['name'];
                $tier->description = $query['description'];
                $tier->amount = $query['amount'];
                $tier->channel_id = $channel->id;
                $tier->save();

                if($this->user->country === 'Canada'){
                    $this->createPricesInStripeConnectAccount($tier, $query);
                }else{
                    $this->price = $this->stripe->prices->create([
                        'unit_amount' => number_format($query['amount'], '2', '', ''),
                        'currency' => $this->currencies[0],
                        'recurring' => ['interval' => 'month'],
                        'product' => $this->product->id,
                        'metadata' => [
                            'tier_id' => $tier['id'],
                            'username' => $this->user->username,
                            'status' => 'active',
                            'currency' => $this->currencies[0]
                        ]
                    ]);
                    $this->price = $this->stripe->prices->create([
                        'unit_amount' => number_format($query['amount'], '2', '', ''),
                        'currency' => $this->currencies[1],
                        'recurring' => ['interval' => 'month'],
                        'product' => $this->product->id,
                        'metadata' => [
                            'tier_id' => $tier['id'],
                            'username' => $this->user->username,
                            'status' => 'active',
                            'currency' => $this->currencies[1]
                        ]
                    ]);
                    $this->price = $this->stripe->prices->create([
                        'unit_amount' => number_format($query['amount'], '2', '', ''),
                        'currency' => $this->currencies[2],
                        'recurring' => ['interval' => 'month'],
                        'product' => $this->product->id,
                        'metadata' => [
                            'tier_id' => $tier['id'],
                            'username' => $this->user->username,
                            'status' => 'active',
                            'currency' => $this->currencies[2]
                        ]
                    ]);
                }
            });
            \DB::commit();

            return response()->json([
                'error' => null,
                'saved' => true,
                'channel' => $channel->load('monthly_goal_last'),
                'price' => $this->price
            ]);
        } catch (\Exception $e){
            \DB::rollBack();
            return response()->json([
                'error' => $e->getMessage(),
                'saved' => false,
                'channel' => null
            ]);
        }
    }

    public function createPricesInStripeConnectAccount($tier, $query)
    {
        $this->price = $this->stripe->prices->create([
            'unit_amount' => number_format($query['amount'], '2', '', ''),
            'currency' => $this->currencies[0],
            'recurring' => ['interval' => 'month'],
            'product' => $this->product->id,
            'metadata' => [
                'tier_id' => $tier['id'],
                'username' => $this->user->username,
                'status' => 'active',
                'currency' => $this->currencies[0]
            ]
        ],[
            'stripe_account' => $this->user->customer_id
        ]);
        $this->price = $this->stripe->prices->create([
            'unit_amount' => number_format($query['amount'], '2', '', ''),
            'currency' => $this->currencies[1],
            'recurring' => ['interval' => 'month'],
            'product' => $this->product->id,
            'metadata' => [
                'tier_id' => $tier['id'],
                'username' => $this->user->username,
                'status' => 'active',
                'currency' => $this->currencies[1]
            ]
        ],[
            'stripe_account' => $this->user->customer_id
        ]);
        $this->price = $this->stripe->prices->create([
            'unit_amount' => number_format($query['amount'], '2', '', ''),
            'currency' => $this->currencies[2],
            'recurring' => ['interval' => 'month'],
            'product' => $this->product->id,
            'metadata' => [
                'tier_id' => $tier['id'],
                'username' => $this->user->username,
                'status' => 'active',
                'currency' => $this->currencies[2]
            ]
        ],[
            'stripe_account' => $this->user->customer_id
        ]);
    }
    //arreglar el metodo

    /**
     * @param $username
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Stripe\Collection
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function update($username, Request $request)
    {
        \DB::beginTransaction();
        try {
            $this->user->channel_information()->update($request->except('tiers', 'monthly_goal_last','monthly_goal'));
            if(\Carbon\Carbon::now()->format('m-Y') >= $this->user->channel_information->monthly_goal_last['date_end'] ){
                $monthly = new MonthlyGoal(\Arr::except($request->monthly_goal_last , ['date_end','percentage_completed', 'current_earnings', 'user_channel_information']));
                $this->user->channel_information->monthly_goal()->save($monthly);
            }else{
                $this->user->channel_information->monthly_goal_last()->update(\Arr::except($request->monthly_goal_last, ['date_end','percentage_completed', 'current_earnings', 'user_channel_information']));
            }

            collect($request->tiers)->each(function ($query){
                if($query['id'] !== null){
                    $prices = $this->stripe->prices->all(['active' => true]);
                    $array = [];
                    foreach ($prices->autoPagingIterator() as $key => $price) {
                        array_push($array, $price);
                    }
                    foreach($array as $price){
                        if(intval($price->metadata['tier_id']) === $query['id']){
                            //obtengo el tier de la base de datos.
                            $tier_query = \App\Models\User\UserTiersInformation::whereId($query['id'])->first();
                            // creo el producto
                            $this->product = $this->stripe->products->update($price->product, [
                                'name' => $query['name']
                            ]);
                            // verifico si el amount que esta en la bd es diferente al que se envia en el request
                            if($tier_query->amount !== $query['amount']){
                                if($this->user->country === 'Canada'){
                                    // si el precio es diferente, inactivo el precio anterior
                                    $this->stripe->prices->update($price->id,[
                                        'active'   => false,
                                        'metadata' => [
                                            'status' => 'inactive'
                                        ]
                                    ], [
                                        'stripe_account' => $this->user->customer_id
                                    ]);
                                    // y creo uno nuevo
                                    $this->price = $this->stripe->prices->create([
                                        'unit_amount' => number_format($query['amount'], '2', '','' ),
                                        'currency'    => $price->currency,
                                        'recurring'   => ['interval' => 'month'],
                                        'product'     => $this->product->id,
                                        'metadata'    => [
                                            'tier_id'   => $query['id'],
                                            'username'  => $this->user->username,
                                            'status'    => 'active'
                                        ]
                                    ], [
                                        'stripe_account' => $this->user->customer_id
                                    ]);
                                }else{
                                    // si el precio es diferente, inactivo el precio anterior
                                    $this->stripe->prices->update($price->id,[
                                        'active'   => false,
                                        'metadata' => [
                                            'status' => 'inactive'
                                        ]
                                    ]);
                                    // y creo uno nuevo
                                    $this->price = $this->stripe->prices->create([
                                        'unit_amount' => number_format($query['amount'], '2', '','' ),
                                        'currency'    => $price->currency,
                                        'recurring'   => ['interval' => 'month'],
                                        'product'     => $this->product->id,
                                        'metadata'    => [
                                            'tier_id'   => $query['id'],
                                            'username'  => $this->user->username,
                                            'status'    => 'active'
                                        ]
                                    ]);
                                }

                            }
                            return false;
                        }
                    };
                } else {
                    $this->product = $this->stripe->products->create([
                        'name' => $query['name']
                    ]);
                    if($this->user->country === 'Canada'){
                        $this->createPricesInStripeConnectAccount($this->tier, $query);
                    }
                    $this->price = $this->stripe->prices->create([
                        'nickname'    => 'base_amount',
                        'unit_amount' => number_format($query['amount'], '2', '',''),
                        'currency'    => $this->currencies[0],
                        'recurring'   => ['interval' => 'month'],
                        'product'     => $this->product->id,
                        'metadata'    => [
                            'tier_id'   => $this->tier['id'],
                            'username'  => $this->user->username,
                            'status'    => 'active',
                            'currency'  => $this->currencies[0]
                        ]
                    ]);
                    $this->price = $this->stripe->prices->create([
                        'unit_amount' => number_format($query['amount'], '2', '', ''),
                        'currency'    => $this->currencies[1],
                        'recurring'   => ['interval' => 'month'],
                        'product'     => $this->product->id,
                        'metadata'    => [
                            'tier_id'   => $this->tier['id'],
                            'username'  => $this->user->username,
                            'status'    => 'active',
                            'currency'  => $this->currencies[1]
                        ]
                    ]);
                    $this->price = $this->stripe->prices->create([
                        'unit_amount' => number_format($query['amount'], '2', '', ''),
                        'currency' => $this->currencies[2],
                        'recurring' => ['interval' => 'month'],
                        'product' => $this->product->id,
                        'metadata' => [
                            'tier_id' => $this->tier['id'],
                            'username' => $this->user->username,
                            'status' => 'active',
                            'currency' => $this->currencies[2]
                        ]
                    ]);
                }
                $this->tier = UserTiersInformation::updateOrCreate(
                    [
                        'id' => $query['id']
                    ],[
                        'name'        => $query['name'],
                        'description' => $query['description'],
                        'amount'      => $query['amount'],
                        'channel_id'  => $this->user->channel_information->id
                    ]
                );
            });
            \DB::commit();
            return response()->json([
                'updated' => true,
                'errors' => null,
                'product' => $this->product,
                'price' => $this->price,
                'subscription' => $this->subscription,
                'customer' => $this->customer
            ]);
        } catch (\Exception $e){
            \DB::rollBack();
            return response()->json([
                'updated'=> false,
                'errors' => $e->getMessage(),
            ]);
        }

    }
}
