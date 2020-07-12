<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\NewUserFree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Contracts\Provider;
use App\Models\User\{User, UserPersonalInformation, UserSocialAuth};

class UserSocialAuthController extends Controller
{
    /**
     * @param $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback($provider)
    {
        $user = $this->createOrGetUser(Socialite::driver($provider));

        if(!$user){
            session()->flash('message_danger', "You cannot log in with Twitter, please try with your email and password");
            return redirect()->route('RegisterIndex', ['type' => 'Free']);
        }

        $verifyUrl = URL::temporarySignedRoute(
            'validate.login',
            now()->addSeconds(5),
            [
                'id' => $user->id,
                'hash' => encrypt($user->id),
            ]
        );
        return redirect()->to($verifyUrl);
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
        $providerUser = $provider->user();
        $providerName = class_basename($provider);
        $cover = '/images/profile/default-cover.svg';
        $avatar = $providerUser->avatar;

        if($providerUser->email == '') return false;

        if (!$user = User::whereEmail($providerUser->email)->first()) {
            $last_name = ' ';
            if ($providerName == 'GoogleProvider') {
               $first_name = $providerUser->user['given_name'];
               $last_name = $providerUser->user['family_name'];
            }
            if ($providerName == 'FacebookProvider') {
                $full_name = explode(" ", $providerUser->name);
                $first_name = $full_name[0];
                if(isset($full_name[1])){
                    $last_name = $full_name[1];
                }
            }
            if ($providerName == 'TwitterProvider') {
                $full_name = explode(" ", $providerUser->name);
                $first_name = $full_name[0];
                if(isset($full_name[1])){
                    $last_name = $full_name[1];
                }
                $avatar = $providerUser->user['profile_image_url_https'];
                $cover = $providerUser->user['profile_banner_url'];
            }

            $user = User::create([
                'email' => $providerUser->email,
                'username' => $providerUser->nickname ?? \Str::random(25),
                'password' => bcrypt(\Str::random(10)),
                'token' => \Str::random(80),
                'subscription_type' => 'FREE',
                'email_verified_at' => \Carbon\Carbon::now(),
                'avatar' => $avatar,
                'cover' => $cover
            ]);

            UserPersonalInformation::create([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'full_name' => $providerUser->name,
                'user_id' => $user->id
            ]);

            $user->notify(new NewUserFree($user->personal_information->full_name));
        }

        if (!UserSocialAuth::where('provider_id', $providerUser->id)->where('provider', $providerName)->first()) {
            UserSocialAuth::Create([
                'user_id' => $user->id,
                'provider' => $providerName,
                'provider_id' => $providerUser->id
            ]);
        }

        return $user;
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
}
