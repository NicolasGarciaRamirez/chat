<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\ImageRequest;
use App\Http\Traits\CreateChannelInformation;
use App\Models\Payments\SubscriptionSettings;
use App\Models\Reactions\Followers;
use App\Models\Reactions\Rewards;
use App\Models\Reactions\Supports;
use App\Models\User\UserTiersInformation;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User\User;
use Intervention\Image\Facades\Image;
use App\Notifications\PasswordChangedSuccessfully;
use MongoDB\Driver\Exception\ExecutionTimeoutException;

/**
 * Class UserController
 * @package App\Http\Controllers\User
 */
class UserController extends Controller
{
    use CreateChannelInformation;
    /**
     * @var
     */
    private $user;

    /**
     * @var
     */
    private $valid;

    /**
     * @var
     */
    private $total_earnings;

    /**
     * @var
     */
    private $payments;

    /**
     * @var
     */
    private $months;

    /**
     * @var
     */
    private $stripe;
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
            $this->total_earnings = 0;
            $this->payments = [];
            $this->months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            $this->user->load(
                'personal_information',
                'channel_information.tiers',
                'channel_information.monthly_goal_last',
                'channel_information.monthly_goal',
                'social_auth',
                'playlists.playlist_post.post.comments',
                'followers.user.followers.user.personal_information',
                'followers.user.followers.user.profile_information',
                'followers.user.profile_information',
                'followers.user.personal_information',
                'following.following.profile_information',
                'following.following.personal_information',
                'supports.user',
                'supporting.supporting',
                'rewards.user' ,
                'rewarding.rewarding',
                'payment_methods.biling_information',
                'posts.user.followers.user',
                'posts.views',
                'posts.comments.user.personal_information',
                'posts.comments.user.profile_information',
                'posts.comments.comments.user.personal_information',
                'posts.comments.comments.user.profile_information',
                'posts.comments.likes.user',
                'posts.comments.comments.likes.user',
                'posts.likes.user',
                'posts.votes.user',
                'posts.shares',
                'posts.user.supports.user',
                'posts.user.rewards.user',
                'posts.user.supporting.supporting',
                'posts.user.rewarding.rewarding',
                'profile_information.members',
                'profile_information.releases',
                'profile_information.worked_with',
                'subscription_settings',
                'payments.invoice',
                'payments.to_who.payments.invoice',
                'payment_ip_data'
            )->loadCount('following', 'followers', 'supports', 'supporting', 'rewards', 'rewarding');
            return $next($request);
        });

    }

     /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUser($username)
    {
        return response()->json([
            'user' => $this->user,
        ]);
    }

     /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFollowings($username)
    {
        return response()->json([
            'followings' => Followers::where('following_user', $this->user->id)->with('following.followers.user')->get(),
            'supportings' => Supports::where('supporting_user', $this->user->id)->with('supporting')->get(),
            'rewardings' => Rewards::where('rewarding_user', $this->user->id)->with('rewarding.rewards.user')->get()
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function channelActivity()
    {
        return view('user.channel.channel-activity', ['user' => $this->user]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function channelPlaylist()
    {
        return view('user.channel.channel-playlist', ['user' => $this->user]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profileEdit($username)
    {
        if(\Auth::user()->username === $username){
            return view('user.profile.profile-edit', ['user' => $this->user]);
        }else{
            return view('user.channel.channel-activity', ['user' => $this->user]);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function channelEdit($username)
    {
        if(\Auth::user()->username === $username){
            return view('user.channel.channel-edit', ['user' => $this->user]);
        }else{
            return view('user.channel.channel-activity', ['user' => $this->user]);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function accountSettings($username)
    {
        if(\Auth::user()->username === $username) {
            return view('user.profile.account-settings', ['user' => $this->user]);
        }else{
            return abort(404);
        }
    }

    /**
     * @param ImageRequest $request
     * @param $username
     * @param $type
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function updateImage(ImageRequest $request, $username, $type)
    {
        \DB::beginTransaction();

        try {
            $imageName = $this->setImage($request, $type);
            if ($type == 'profile') {
                $this->user->avatar = $imageName;
            } else if ($type == 'cover') {
                $this->user->cover = $imageName;
            }
            $this->user->update();
            \DB::commit();

            return response()->json([
                'updated' => true,
                'user' => $this->user,
                'errors' => null
            ]);
        } catch (\Exception $e) {
            \DB::rollBack();
            return response()->json([
                'updated' => false,
                'user' => null,
                'errors' => $e->getMessage()
            ], 422);
        }
    }

    /**
     * @param $request
     * @param $type
     * @return string
     */
    public function setImage($request, $type): string
    {
        $key = md5(\Auth::user()->id);
        $hash = \Str::random(10);
        $imageName = "/images/post/profile/{$key}/{$hash}{$request->image->getClientOriginalName()}";
        $request->image->move(public_path("/images/post/profile/{$key}/"), $imageName);

        if ($type == 'cover') {

            $img = Image::make(public_path($imageName))->crop($request->width, $request->height, $request->left, $request->top);
            $img->save(public_path($imageName));
        } else if ($type == 'profile') {
            $img = Image::make(public_path($imageName))->crop($request->width, $request->height, $request->left, $request->top);
            $img->save(public_path($imageName));
        }
        return $imageName;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateUser(Request $request)
    {
        $this->user->update(\Arr::except($request->all(), ['artistic_name']));
        \DB::commit();
        $this->user->notify(new PasswordChangedSuccessfully($this->user->personal_information->full_name));

        return response()->json([
            'updated' => true,
            'user' => User::find($this->user->id),
            'errors' => null
        ], 200);
    }

    /**
     * @param $username
     * @return \Illuminate\Http\JsonResponse
     */
    // este metodo es para cancelar la subscripcion con noisesharks
    public function cancelSubscription($username)
    {
        \DB::beginTransaction();
        try{
            $this->user->update(['subscription_type' => 'FREE', 'contributor_type' => null ]);
            if($this->user->has('channel_information')){
                if($this->user->channel_information->has('monthly_goal')) $this->user->channel_information->monthly_goal->delete();
                $this->user->channel_information->delete();
            }
            \DB::commit();
            return response()->json([
                'updated' => true,
                'user' => $this->user,
                'error' => null
            ], 200);

        }catch (\Exception $e){
            \DB::rollback();
            return response()->json([
                'updated' => false,
                'user' => null,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @param $username
     * @param $type
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    // este metodo actualiza la subscripcion con noisesharks
    public function updateSubscription($username, $type, Request $request)
    {

        \DB::beginTransaction();
        try {
            SubscriptionSettings::updateOrInsert(
                ['id' => null],
                [
                    'amount' => $type === 'Percentage' ? '15%' : 3,
                    'date_subscription_start' => \Carbon\Carbon::now(),
                    'date_subscription_end' => $type === 'Percentage' ? \Carbon\Carbon::now()->addMonth() : null,
                    'payment_cycle' => $type === 'Percentage' ? \Carbon\Carbon::now()->format('d') : null,
                    'user_id' => $this->user->id
                ]
            );
            $this->user->createOrGetStripeCustomer();
            $this->user->update(['contributor_type' => $type, 'subscription_type' => 'CONTRIBUTOR']);

            $this->saveChannelInformation($this->user, $request);

            \DB::commit();
            return response()->json([
                'updated'=>true,
                'user' => $this->user
            ],200);
        }catch (\Exception $e){
            \DB::rollBack();
            return response()->json([
                'updated' => false,
                'errors' => $e->getMessage()
            ],500);
        }

    }

    /**
     * @param $username
     * @param $tier
     * @return \Illuminate\Http\JsonResponse
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function validSubscription($username, UserTiersInformation $tier)
    {
        // se debe validar tambien si el usuario dueno del post tiene la cuenta fuera de EU
        // y asi pedir las subscripciones de la cuenta conectada
        // $user es el usuario autenticado
        $user = User::whereUsername($username)->first();
        // se caraga el usuario dueno del post
        $tier->load('channel_information.user');
        if($tier->channel_information->user->country === 'Canada'){
            $subscriptions = \Stripe\Subscription::all('', [
                'stripe_account' => $tier->channel_information->user->customer_id,
            ]);
        }else{
            $subscriptions = \Stripe\Subscription::all(['customer' => $user->stripe_id]);
        }
        $subscriptions_all = [];

        foreach ($subscriptions->autoPagingIterator() as $subscription){
            array_push($subscriptions_all, $subscription);
        }
        foreach ($subscriptions_all as $subscription ){
            if($subscription->status === 'active' || 'trialing'){
                // se pregunta si el usuario receptor es de CA para acceder a la propiedad metadata de la cuenta conectada
                if($tier->channel_information->user->country === 'Canada'){
                    if($user->token === $subscription->metadata['user_subscribed_token']){
                        $this->valid = true;
                        break;
                    }else{
                        $this->valid = false;
                    }
                }else {
                    if ($subscription->customer === $user->stripe_id) {
                        if ($subscription->plan->metadata['tier _id'] == strval($tier->id)) {
                            $this->valid = true;
                            break;
                        } else {
                            $this->valid = false;
                        }
                    } else {
                        $this->valid = false;
                    }
                }
            }else{
                $this->valid = false;
            }
        }

        return response()->json([
            'valid' =>  $this->valid,
            'subscriptions' => $_SERVER["REMOTE_ADDR"] === '127.0.0.1' ? $subscriptions : null,
            'subscriptions_all' => $_SERVER["REMOTE_ADDR"] === '127.0.0.1' ? $subscriptions_all : null

        ]);
    }

    /**
     * @param $type
     * @param $username
     * @return \Illuminate\Http\JsonResponse
     */
    public function actionSettings($type, $username)
    {
        \DB::beginTransaction();
        try {
            $user = User::whereUsername($username)->first();

            if($type === 'Delete'){
                $user->followers()->forceDelete();
                $user->following()->forceDelete();

                //drop relations evit issues
                $followers = Followers::where('following_user', $user->id)->get();
                $followers->each(function($follow){
                    $follow->forceDelete();
                });

                if($user->subscription_type === 'CONTRIBUTOR'){
                    $user->rewards()->forceDelete();
                    $user->rewarding()->forceDelete();
                    $user->supports()->forceDelete();
                    $user->suporting()->forceDelete();

                    //drop relations evit issues
                    $rewarders = Rewards::where('rewarding_user', $user->id)->get();
                    $rewarders->each(function($rewarder){
                        $rewarder->forceDelete();
                    });

                    $supporters = Supports::where('supporting_user', $user->id)->get();
                    $supporters->each(function($supporter){
                        $supporter->forceDelete();
                    });
                }
                $user->forceDelete();
            }else if($type === 'Suspend'){
                $user->suspend = true;
                $user->update();
            }
            \DB::commit();
            return response()->json([
                'action' => true,
                'errors' => null,
            ]);
        } catch(\Exception $e){
            \DB::rollBack();
            return response()->json([
                'action' => false,
                'errors' => $e->getMessage()
            ]);
        }

    }

    /**
     * @param $username
     * @param $period
     * @param null $for
     * @param null $by
     * @return \Illuminate\Http\JsonResponse
     */
    public function filterEarnings($username, $period, $for = null , $by = null )
    {
        $this->total_earnings = 0;
        $rewards = $this->user->rewards()->get();
        $supports = $this->user->supports()->get();
        if ($for === 'all') {
            collect($rewards)->each(function ($reward) use ($by, $period){
                $this->sumTotalYearOrMonth($by, $reward, $period, 'reward');
            });
            collect($supports)->each(function ($support) use ($by, $period){
                $this->sumTotalYearOrMonth($by, $support, $period, 'support');
            });
        } elseif ($for === 'rewards') {
            collect($rewards)->each(function ($reward) use ($by, $period){
                $this->sumTotalYearOrMonth($by, $reward, $period, 'reward');
            });
        } elseif ($for === 'supports'){
            collect($supports)->each(function ($support) use ($by, $period){
                $this->sumTotalYearOrMonth($by, $support, $period, 'support');
            });
        }

        return response()->json([
            'earnings' => $this->total_earnings,
            'rewards' => $rewards,
            'supports' => $supports
        ]);
    }

    /**
     * @param $by
     * @param $object
     * @param $period
     * @param $type
     */
    public function sumTotalYearOrMonth($by, $object , $period, $type)
    {
        if( $by === 'Year' && \Carbon\Carbon::parse($object['created_at'])->format('Y') === $period){
            $this->total_earnings += $object[$type === 'reward' ? 'amount_recibed': 'monthly_amount_recibed'];
        }elseif( $by === 'Month' && $this->months[intval(\Carbon\Carbon::parse($object['created_at'])->format('m'))-1] === $period){
            $this->total_earnings += $object[$type === 'reward' ? 'amount_recibed': 'monthly_amount_recibed'];
        }
    }

    /**
     * @param $username
     * @param $period
     * @param null $for
     * @param null $by
     * @return \Illuminate\Http\JsonResponse
     */
    public function filterInvoices($username, $period, $for = null , $by = null )
    {
        $this->payments = [];
        $this->user->payments()->each(function($payment) use ($for, $by, $period){
            if($for === 'All'){
                if($payment->type === 'reward receive'){
                    $this->pushArrayPayments($by, $payment, $period);
                }elseif ($payment->type === 'support receive'){
                    $this->pushArrayPayments($by, $payment, $period);
                }
            }elseif($for === 'Supports'){
                if($payment->type === 'support receive'){
                    $this->pushArrayPayments($by, $payment, $period);
                }
            }elseif($for === 'Rewards'){
                if($payment->type === 'reward receive'){
                    $this->pushArrayPayments($by, $payment, $period);
                }
            }
        });
        return response()->json([
            'payments' => $this->payments
        ]);
    }

    /**
     * @param $by
     * @param $object
     * @param $period
     */
    public function pushArrayPayments($by, $object , $period)
    {
        $object->load('invoice','to_who','user');
        if($by === 'Year' && \Carbon\Carbon::parse($object->created_at)->format('Y') === $period){
            array_push($this->payments, $object);
        }elseif ($by === 'Month' && $this->months[intval(\Carbon\Carbon::parse($object->created_at)->format('m'))-1] === $period){
            array_push($this->payments, $object);
        }
    }

    public function saveExplanation($username, Request $request)
    {
        \DB::beginTransaction();
        try {
            $this->user->explanation_ready = $request->explanation;
            $this->user->save();
            \DB::commit();
            return response()->json([
                'saved' => true,
                'user' => $this->user
            ], 200);
        }catch (\Exception $e){
            \DB::rollBack();
            return response()->json([
                'saved' => false,
                'user' => null,
                'error' => $e->getMessage()
            ], 422);
        }
    }

    public function getExplanation($username, Request $request)
    {
        return response()->json([
            'explanation' => $this->user->explanation_ready
        ]);
    }

    public function generatePromoCode($username)
    {
        $code_generate = 'r/'.$this->user->username;
        $this->user->promo_code = $code_generate;
        $saved = $this->user->update();

        return response()->json([
            'saved' => $saved,
            'code_generate' => $code_generate
        ]);
    }
}

