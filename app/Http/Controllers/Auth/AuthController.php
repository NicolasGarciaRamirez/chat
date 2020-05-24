<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\loginUser;
use App\Http\Requests\StoreUser;
use App\Notifications\NewUserFree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User\User;

class AuthController extends Controller
{
    /**
     * Undocumented function
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function authCheck()
    {
        return response()->json([
            'auth' => \Auth::check(),
            'user' => \Auth::user()
        ]);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(loginUser $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return response()->json([
                'user' => Auth::user(),
                'auth' => true
            ], 200);
        } else {
            return response()->json([
                'errors' => ['errors' => "Credentials not match"],
            ], 422);
        }
    }

    /**
     * Undocumented function
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    /**
     * @param StoreUser $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function register(StoreUser $request)
    {
        \DB::beginTransaction();

        try {
            $user = new \App\Models\User\User($request->all());
            $user->username = \Str::random(25);
            $user->token = \Str::random(80);
            $user->save();

            $personal_information = new \App\Models\User\UserPersonalInformation($request->all());
            $personal_information->full_name = $request->first_name . ' ' . $request->last_name;
            $personal_information->members = json_encode($request->personal_information['members']);
            $personal_information->releases = json_encode($request->personal_information['releases']);
            $personal_information->social_media = json_encode($request->personal_information['social_media']);

            $user->personal_information()->save($personal_information);

//            if($user->subscription_type == 'FREE') $user->notify(new NewUserFree());
            \DB::commit();
            Auth::login($user);

            return response()->json([
                'saved' => true,
                'user' => $user,
                'errors' => null
            ]);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json([
                'saved' => false,
                'user' => null,
                'errors' => $e
            ], 422);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sedEmailForgotPassword(Request $request)
    {
        \Mail::to($request->email)->send(new \App\Mail\ForgotPassword());
        return response()->json([
            'message' => 'We send you an email to follow the instructions'
        ]);
    }

    // public function redirectToProvider()
    // {
    //     return Socialite::driver('facebook')->redirect();
    // }
    // public function handleProviderCallback()
    // {
    //     $user = Socialite::driver('facebook')->user();

    //     dd($user);

    // }
}
