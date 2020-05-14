<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $is_login_view = true;
            return view('template.template', compact('is_login_view'));
        } else {
            session()->flash('message', 'Email or password incorrect');
            return back()->withInput();
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
     * Undocumented function
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $user = new \App\Models\User\User($request->all());
        $user->user_name = $request->first_name.'.'.$request->last_name.'.'.\Str::random(5);
        $user->subscription_type = 'CONTRIBUTOR';
        $user->token = \Str::random(80);
        $user->save();

        $personal_information = new \App\Models\User\UserPersonalInformation($request->all());
        $personal_information->full_name = $request->first_name . ' ' . $request->last_name;
        $personal_information->members = json_encode($request->personal_information['members']);
        $personal_information->releases = json_encode($request->personal_information['releases']);
        $personal_information->social_media = json_encode($request->personal_information['social_media']);

        $user->personal_information()->save($personal_information);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
        } else {
            session()->flash('message', 'Email or password incorrect');
            return back()->withInput();
        }

        return response()->json([
            'saved' => true,
            'user' => $user
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
