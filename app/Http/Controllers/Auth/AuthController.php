<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Socialite;

class AuthController extends Controller
{
    /**
     * Undocumented function
     *
     * @return void
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
     * @return void
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
     * @return void
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
     * @return void
     */
    public function register(Request $request)
    {
        $user = new \App\Models\User\User($request->all());
        $user->full_name = $request->first_name .' '. $request->last_name;
        $user->suscription_type = 'CONTRIBUTOR';
        $user->save();

        $personal_information = new \App\Models\User\UserPersonalInformation();
        $personal_information->user_id = $user->id;
        $personal_information->members = json_encode($request->personal_information['members']);
        $personal_information->releases = json_encode($request->personal_information['releases']);
        $personal_information->social_media = json_encode($request->personal_information['social_media']);
        $personal_information->save($request->personal_information);

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
