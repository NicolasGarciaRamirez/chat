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
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(loginUser $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, true)) {
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
    public function register(StoreUser $request)
    {
        \DB::beginTransaction();

        try {
            $user = new User($request->all());
            $user->username = \Str::random(25);
            $user->token = \Str::random(80);
            $user->save();

            $personal_information = new \App\Models\User\UserPersonalInformation($request->all());
            $personal_information->full_name = $request->first_name . ' ' . $request->last_name;

            $user->personal_information()->save($personal_information);

            //  if ($user->subscription_type == 'FREE') $user->notify(new NewUserFree($personal_information->full_name));

            \DB::commit();
            Auth::login($user, true);

            return response()->json([
                'saved' => true,
                'user' => User::find($user->id),
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
        if ($request->email) {
            $user = User::with('personal_information')->whereEmail($request->email)->first();
        }else if($request->artistic_name){
            $user = User::with('personal_information', 'profile_information')->where('profile_information.artistic_name', $request->artistic_name)->first();
        }

        if (!$user) {
            return response()->json([
                'message' => 'We send you an email to follow the instructions'
            ]);
        }

        \Mail::to($user->email)->send(new \App\Mail\ForgotPassword($user, $user->personal_information->full_name));
        return response()->json([
            'send' => true,
            'message' => 'We send you an email to follow the instructions'
        ]);
    }

    public function passwordReset($token)
    {
        $user = User::whereToken($token)->first();
        return view('user.auth.password_reset', compact('user'));
    }
}
