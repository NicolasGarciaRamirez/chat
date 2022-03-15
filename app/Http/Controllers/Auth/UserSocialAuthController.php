<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\FacebookIsNowLinked;
use App\Notifications\GoogleIsNowLinked;
use App\Notifications\NewUserFree;
use App\Notifications\TwitterIsNowLinked;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Contracts\Provider;
use App\Models\User\{User, UserPersonalInformation, UserSocialAuth};

/**
 * Class UserSocialAuthController
 * @package App\Http\Controllers\Auth
 */
class UserSocialAuthController extends Controller
{
    /**
     * @var
     */
    protected $providerUser;

    /**
     * @var
     */
    protected $providerName;

    /**
     * @var
     */
    protected $user;

    /**
     * @var bool
     */
    protected $message_provider;

    /**
     * @var bool
     */
    protected $ifEmailFalse;

    /**
     * UserSocialAuthController constructor.
     */
    public function __construct()
    {
        $this->message_provider = false;
        $this->ifEmailFalse = false;
    }
    /**
     * @param $provider
     */
    public function handleProviderCallback($provider)
    {

        $driver = Socialite::driver($provider);
        $this->providerName = class_basename($driver);
        $this->providerUser = $driver->user();

        if(\Auth::check()) {
            $this->validEmailProviderRedirect($driver);
            if($this->ifEmailFalse) return view('user.profile.account-settings', ['user' => $this->user]);
        }

        $provider = UserSocialAuth::where('provider_id', $this->providerUser->id)->where('provider', $this->providerName)->first();
        if($provider){
            $this->user = User::whereEmail($this->providerUser->email)->first();
        }else{
            if ($user = User::whereEmail($this->providerUser->email)->first()){
                $this->user = $user;
                session()->flash('message_same_email', ['user' => $this->providerUser, 'provider_name' => $this->providerName]);
                return redirect('/login');
            }else{
                $this->user = $this->createOrGetUser($driver);
            }
        }

        if (!$this->user) {
            $this->message_provider
                ? session()->flash('message_danger_provider', 'This '.class_basename($provider).' account already has a separate Noisesharks profile, would you like to')
                : session()->flash('message_danger', "You cannot log in with Twitter, please try with your email and password");
            return redirect()->route('RegisterIndex', ['type' => 'Free']);
        }

        if(UserSocialAuth::where('provider_id', $this->providerUser->id)->where('provider', $this->providerName)->first()){
            $verifyUrl = URL::temporarySignedRoute(
               'validate.login',
                now()->addSeconds(5),
                [
                    'id' => $this->user->id,
                    'hash' => encrypt($this->user->id),
                ]
            );
            return redirect()->to($verifyUrl);
        }
    }

    /**
     * @param Provider $provider
     * @return bool|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function validEmailProviderRedirect(Provider $provider)
    {
        $this->providerUser = $provider->user();
        $this->providerName = class_basename($provider);

        $this->user = \Auth::user();
        if($this->user->email !== $this->providerUser->email){
            $this->user->provider = ['providerUser' => $this->providerUser, 'providerName' => $this->providerName];
            if(!User::whereEmail($this->providerUser->email)->first()){
                $this->user->message = 'question';
                $this->ifEmailFalse = true;
            }else{
                $this->user->message = 'alert';
                $this->ifEmailFalse = true;
            }
        } else {
            if (!UserSocialAuth::where('provider_id', $this->providerUser->id)->where('provider', $this->providerName)->first()) {
                $this->createProviderLocal(\Auth::user());
                return false;
            }
        }
        return true;
    }
    /**
     * @param $provider
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToProvider($provider)
    {
        $providerKey = Config::get('services.' . $provider);
        if (empty($providerKey)) {
            return 'error';
        }
        return Socialite::driver($provider)->redirect();
    }

    /**
     * @param Provider $provider
     * @return mixed
     */
    public function createOrGetUser(Provider $provider)
    {
        $this->providerUser = $provider->user();
        $this->providerName = class_basename($provider);
        $cover = '/images/profile/default-cover.svg';
        $avatar = $this->providerUser->avatar;

        $provider = UserSocialAuth::where('provider_id', $this->providerUser->id)->where('provider', $this->providerName)->first();

        if ($this->providerUser->email == '') return false;

        if($provider && !User::whereEmail($this->providerUser->email)->first()) {
            return User::with('social_auth')->whereId($provider->user_id)->first();
        }

        if (!$user = User::whereEmail($this->providerUser->email)->first()) {
            $last_name = ' ';
            if ($this->providerName == 'GoogleProvider') {
                $first_name = $this->providerUser->user['given_name'];
                if (isset($this->providerUser->user['family_name'])) {
                    $last_name = $this->providerUser->user['family_name'];
                }
            }
            if ($this->providerName == 'FacebookProvider') {
                $full_name = explode(" ", $this->providerUser->name);
                $first_name = $full_name[0];
                if (isset($full_name[1])) {
                    $last_name = $full_name[1];
                }
            }
            if ($this->providerName == 'TwitterProvider') {
                $full_name = explode(" ", $this->providerUser->name);
                $first_name = $full_name[0];
                if (isset($full_name[1])) {
                    $last_name = $full_name[1];
                }
                $avatar = $this->providerUser->user['profile_image_url_https'];
                $cover = $this->providerUser->user['profile_banner_url'];
            }

            $user = User::create([
                'email' => $this->providerUser->email,
                'username' => $this->providerUser->nickname ?? \Str::random(25),
                'password' => bcrypt(\Str::random(10)),
                'token' => \Str::random(80),
                'subscription_type' => 'FREE',
                'email_verified_at' => \Carbon\Carbon::now(),
                'badge_verification' => \Carbon\Carbon::now(),
                'avatar' => strlen($avatar) < 255 ? $avatar : '/images/profile/default.svg',
                'cover' => $cover
            ]);

            UserPersonalInformation::create([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'full_name' => $this->providerUser->name,
                'user_id' => $user->id
            ]);

            $user->notify(new NewUserFree($user->personal_information->full_name));
            $this->createProviderLocal($user);
        }

        if (!$provider) $this->createProviderLocal($user);

        if ($user =  User::whereEmail($this->providerUser->email)->first()) return $user;

        return $user;
    }

    /**
     * @param User $user
     * @param Provider $provider
     * @return \Illuminate\Http\JsonResponse
     */
    public function createProvider(User $user, Request $request)
    {
        $this->providerName = $request['provider']['providerName'];
        $user_id = $request['provider']['providerUser']['id'];

        UserSocialAuth::Create([
            'user_id' => $user->id,
            'provider' => $this->providerName,
            'provider_id' => $this->providerUser ? $this->providerUser->id : $user_id
        ]);

        $this->sendNotify($user);

        return response()->json([
            'user' => User::with('social_auth')->whereId($user->id)->first()
        ]);
    }

    public function createProviderLocal(User $user)
    {
        UserSocialAuth::Create([
            'user_id' => $user->id,
            'provider' => $this->providerName,
            'provider_id' => $this->providerUser['id']
        ]);
        $this->sendNotify($user);


        return response()->json([
            'user' => User::with('social_auth')->whereId($user->id)->first()
        ]);
    }

    public function sendNotify(User $user)
    {
        if($this->providerName == 'FacebookProvider') $user->notify(new FacebookIsNowLinked($user->personal_information->full_name));
        if($this->providerName == 'GoogleProvider') $user->notify(new GoogleIsNowLinked($user->personal_information->full_name));
        if($this->providerName == 'TwitterProvider') $user->notify(new TwitterIsNowLinked($user->personal_information->full_name));
    }


    /**
     * @param $user
     * @param $hash
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function validateLogin($user, $hash)
    {
        if (decrypt($hash) == $user) {
            $user = User::find($user);
            auth()->login($user, true);
            return view('user.auth.validate-login', compact('user'));
        }

        abort(404);
    }

    /**
     * @return void
     */
    public function error()
    {
        return abort(404);
    }

    /**
     * @param UserSocialAuth $provider
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function disconnectAccount(UserSocialAuth $provider)
    {
        $user = \Auth::user();
        $provider->forceDelete();
        $verifyUrl = \URL::temporarySignedRoute(
            'password.reset',
            \Carbon\Carbon::now()->addMinutes(60),
            [
                'token' => $user->token,
                'hash' => encrypt($user->id),
            ]
        );
        \Auth::logout();
        return response()->json([
            'verifyUrl' => $verifyUrl
        ]);
    }
}
