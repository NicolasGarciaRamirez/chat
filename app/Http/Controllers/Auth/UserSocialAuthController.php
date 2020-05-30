<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\NewUserFree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
use Laravel\Socialite\Facades\Socialite;
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
        dd($provider);
        $providerUser = $provider->user();
        $providerName = class_basename($provider);

        if (!$user = User::whereEmail($providerUser->email)->first()) {
            $user = User::create([
                'email' => $providerUser->email,
                'username' => $providerUser->username,
                'password' => bcrypt(\Str::random(10)),
                'token' => \Str::random(80),
                'subscription_type' => 'FREE',
                'email_verified_at' => \Carbon\Carbon::now()
            ]);
            UserPersonalInformation::create([
                'first_name' => $providerUser->name,
                'last_name' => $providerUser->name,
                'full_name' => $providerUser->name,
                'user_id' => $user->id
            ]);

            $user->notify(new NewUserFree());
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
            auth()->login($user);
            return view('user.auth.validate-login', compact('user'));
        }

        abort(404);
    }
    
    public function error()
    {
        return redirect('/');
    }
}
