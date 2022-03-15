<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserConnected;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmailVerifiedUnique;
use App\Http\Requests\loginUser;
use App\Http\Requests\StoreUser;
use App\Http\Traits\CreateChannelInformation;
use App\Http\Traits\RealIpTrait;
use App\Http\Traits\PaymentMethods;
use App\Mail\InvitationCodeRequest;
use App\Models\Channel\MonthlyGoal;
use App\Models\Payments\PaymentIpClientData;
use App\Models\Payments\SubscriptionSettings;
use App\Models\User\UserChannelInformation;
use App\Models\User\UserTiersInformation;
use App\Notifications\NewUserFree;
use App\Notifications\PasswordChangedSuccessfully;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User\User;
use Illuminate\Support\Str;

/**
 * Class AuthController
 * @package App\Http\Controllers\Auth
 */
class AuthController extends Controller
{
    use RealIpTrait,PaymentMethods, CreateChannelInformation;
    /**
     * Undocumented function
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(loginUser $request)
    {
        $user = User::whereEmail($request->email)->first();
        $credentials = $request->only('email', 'password');
        if($user){
            if(!$user->suspend && !$user->banned){
                if (\Auth::attempt($credentials, true)) {
                    return response()->json([
                        'user' => \Auth::user()->load('followers.user.profile_information', 'followers.user.personal_information'),
                        'auth' => true,
                    ], 200);
                } else {
                    return response()->json([
                        'errors' => ['errors' => "Email and password did not match"],
                    ], 422);
                }
            }else{
                return response()->json([
                    'errors' => ['errors' => "YOUR ACCOUNT IS !".${$user->banned ? 'BANNED' : 'SUSPEND'}."!"]
                ], 422);
            }
        }else{
            return response()->json([
                'errors' => ['errors' => "This email does not belong to any account on Noisesharks"]
            ], 422);
        }
    }

    /**
     * Undocumented function
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::logout();

        return response()->json([
            'logout' => true
        ]);
    }

    /**
     * @param StoreUser $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function register(StoreUser $request, $type = null, $contributor = null)
    {
        \DB::beginTransaction();

        try {
            $user = $this->createUser($request);

            $personal_information            = new \App\Models\User\UserPersonalInformation($request->all());
            $personal_information->full_name = $request->first_name . ' ' . $request->last_name;
            $user->personal_information()->save($personal_information);

            $user->createAsStripeCustomer();
            if ($user->subscription_type == 'FREE') $user->notify(new NewUserFree($personal_information->full_name));

            if ($user->subscription_type === 'CONTRIBUTOR'){

                //setear la informacion del canal monthly goal and added three tiers
                $this->saveChannelInformation($user, $request);

                $client_ip_data = new PaymentIpClientData($request->payment_ip_data);
                $client_ip_data->currency = json_encode($request->payment_ip_data['currency']);
                $user->payment_ip_data()->save($client_ip_data);

                $response = $client_ip_data;
                $response->currency = json_decode($response->currency, true);

                $vta        = $response->continent_code === 'EU' ? 20 : 0;
                $currency   = $response->currency['symbol'] === 'CO$' ? '$' : $response->currency['symbol'];

                $this->updatePaymentMethod($user, $request->payment_method, $request);

                $subscription = $this->createSubscriptionSettings($user);

                $payment         = new \App\Models\Payments\Payments();
                $payment->amount = $subscription->amount;
                $payment->type   = 'Payment '.$user->contributor_type;
                $payment->to_who = $user->id;
                $payment->payment_token = $request->payment_method['token'];
                $user->payments()->save($payment);

                $invoice                  = new \App\Models\Payments\Invoices();
                $invoice->invoice_number  = random_int(0000 , 999999);
                $invoice->expedition_date = \Carbon\Carbon::now()->format('Y-m-d H-m-s');
                $invoice->location        = $response->continent_name.'-'.$response->country_name.'-'.$response->region_name.'-'.$response->city;
                $invoice->amount_net      = $subscription->amount;
                $invoice->amount_total    = $subscription->amount + (($vta * $subscription->amount) / 100);
                $invoice->description     = 'One-off joining fee';
                $invoice->vta             = ($vta * $subscription->amount) / 100;
                $invoice->payment_gateway = ((2.9 * $subscription->amount) / 100) + 0.30 ;
                $invoice->currency        = $currency;
                $invoice->payment_method  = $user->card_brand.' **** '.$user->card_last_four ;
                $payment->invoice()->save($invoice);

            }
            \DB::commit();
            if($user->subscription_type !== 'CONTRIBUTOR'){
                Auth::login($user, true);
            }
            return response()->json([
                'saved' => true,
                'user' => User::find($user->id),
                'payment' => $user->subscription_type === 'CONTRIBUTOR' ? $payment->load('invoice') : null,
                'errors' => null
            ], 200);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json([
                'saved' => false,
                'user' => null,
                'errors' => $e->getMessage(),
            ], 422);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function registerUserInvited(Request $request): \Illuminate\Http\JsonResponse
    {
        
        \DB::beginTransaction();
        try{
            $user = $this->createUser($request);

            $personal_information            = new \App\Models\User\UserPersonalInformation($request->all());
            $personal_information->full_name = $request->first_name . ' ' . $request->last_name;
            $user->personal_information()->save($personal_information);

            $this->createSubscriptionSettings($user);

            $this->saveChannelInformation($user, $request);

            $state = $this->addCredits($user, $request->code_invited);

            $user->notify(new NewUserFree($personal_information->full_name));
            \Auth::login($user, true);

            \DB::commit();
            return response()->json([
                'saved' => true,
                'errors' => null,
                'user' => User::whereId($user->id)->first(),
                'getCredits' => $state
            ]);
        }catch (\Exception $e){
            \DB::rollBack();
            return response()->json([
                'saved' => false,
                'errors' => $e->getMessage(),
                'user' => null,
                'getCredits' => false
            ]);
        }

    }

    /**
     * @param $user
     * @return SubscriptionSettings
     */
    static function createSubscriptionSettings($user): SubscriptionSettings
    {
        $subscription                           = new SubscriptionSettings();
        $subscription->amount                   = $user->contributor_type === 'PERCENTAGE' ? '15%' : 3.00;
        $subscription->date_subscription_start  = \Carbon\Carbon::now()->format('Y-m-d H-m-s');
        $subscription->date_subscription_end    = $user->contributor_type === 'PERCENTAGE' ? null : \Carbon\Carbon::now()->addMonth()->addDays(3)->format('Y-m-d H-m-s');
        $subscription->payment_cycle            = $user->contributor_type === 'PERCENTAGE' ? null : \Carbon\Carbon::now()->format('d');
        $user->subscription_settings()->save($subscription);

        return $subscription;
    }

    /**
     * @param $request
     * @return User
     */
    static function createUser($request): User
    {
        $user                    = new User($request->all());
        $user->username          = \Str::random(25);
        $user->token             = \Str::random(80);
        $user->email_verified_at = \Carbon\Carbon::now();
        $user->badge_verification = \Carbon\Carbon::now();
        $user->save();

        return $user;
    }

    /**
     * @param $user
     * @param $payment_method
     * @param $request
     */
    public function updatePaymentMethod($user, $payment_method, $request)
    {
        $user->updateDefaultPaymentMethod($payment_method['id']);
        $this->savePaymentMethod($user,$payment_method,$request);
    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sedEmailForgotPassword(Request $request)
    {
        if ($request->email) {
            $user = User::with('personal_information')->whereEmail($request->email)->first();
        } else if ($request->artistic_name) {
            $user = User::with('personal_information', 'profile_information')->where('profile_information.artistic_name', $request->artistic_name)->first();
        }

        if (!$user) {
            return response()->json([
                'message' => 'Email or Artistic Name not found. Please try again!'
            ]);
        }

        \Mail::to($user->email)->send(new \App\Mail\ForgotPassword($user, $user->personal_information->full_name));

        return response()->json([
            'send' => true,
            'message' => 'We have sent you an email with all of the instructions you need! 😁'
        ]);
    }

    /**
     * @param $token
     * @param $hash
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function resetPasswordView($token, $hash)
    {
        if ($user = User::whereToken($token)->first()) {
            if (decrypt($hash) == $user->id) {
                return view('user.auth.password_reset', compact('user'));
            }
            abort(404);
        }
        abort(404);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetPassword(Request $request)
    {
        \DB::beginTransaction();
        try {
            $user = User::whereUsername($request->user['username'])->first();
            $user->password = $request->password;
            $user->update();

            $user->notify(new PasswordChangedSuccessfully($user->personal_information->full_name));
            \DB::commit();
            return response()->json([
                'saved' => true,
                'error' => false
            ], 200);
        } catch (\Exception $e){
            \DB::rollBack();
            return response()->json([
                'saved' => false,
                'error' => $e->getMessage()
            ], 500);
        }

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function setSession(Request $request)
    {
        if(\Auth::guest()){
            $user = User::where('username', $request->username)->first();
            \Auth::login($user);
            return response()->json([
                'login' => false,
                'token' => $user->token,
                'username' => $user->username,
                'avatar' => $user->avatar
            ]);
        }
        return response()->json([
            'login' => true
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkSession(Request $request)
    {
        return response()->json([
            'session' => true
        ]);
    }

    /**
     * @param EmailVerifiedUnique $request
     */
    public function verifiedEmail(EmailVerifiedUnique $request){}

    /**
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function generateUrlPasswordApi(User $user){
        $verifyUrl = \URL::temporarySignedRoute(
            'password.reset',
            \Carbon\Carbon::now()->addMinutes(60),
            [
                'token' => $user->token,
                'hash' => encrypt($user->id),
            ]
        );
        return response()->json([
            'verifyUrl' => $verifyUrl
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendEmailInvited(Request $request)
    {
        try {
            \Mail::to('t.ghanameh@noisesharks.com')->send(new InvitationCodeRequest($request));
            return response()->json([
                'send' => true,
                'error' => null
            ]);
        }catch (\Exception $e){
            return response()->json([
                'send' => false,
                'errors' => $e->getMessage()
            ]);
        }
    }

    /**
     * @param $user_created
     * @param $code
     * @return $response
     */
    public function addCredits($user_created, $code)
    {
        $response = true;
        $user_created->credit += 10;
        $user_created->update() ? $response = true : $response = false;

        $user_contributor = User::where('promo_code', $code)->first();
        $user_contributor->credit += 10;
        $user_contributor->update() ? $response = true : $response = false;

        return $response;
    }
}
