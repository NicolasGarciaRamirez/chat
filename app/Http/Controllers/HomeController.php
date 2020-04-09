<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('home');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login()
    {
        return view('login', ['is_login_view' => true]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function register()
    {
        return view('register');
    }

    public function saveUser(Request $request)
    {
        $user = new \App\Models\User\User();
        $user->name = $request->first_name.''.$request->last_name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->remember_token = \Str::random(80);
        $user->save();

        return view('user.contributor.profile', ['is_login_view' => true]);
        // return response()->json([
        //     'user' => $user,
        //     'saved' => true
        // ]);

    }
}
