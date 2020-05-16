<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User\User;

class ViewUserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function activity($user_name)
    {
        $user = User::where('user_name' , $user_name)->first();
        $user->load('personal_information','posts');
        return view('user.view.channel.activity', compact('user'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function playlist($user_name)
    {
        $user = User::where('user_name' , $user_name)->first();
        $user->with('personal_information');
        return view('user.view.channel.playlist', compact('user'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function releases($user_name)
    {
        $user = User::where('user_name' , $user_name)->first();
        $user->with('personal_information');
        return view('user.view.profile.releases', compact('user'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function members($user_name)
    {
        $user = User::where('user_name' , $user_name)->first();
        $user->with('personal_information');
        return view('user.view.profile.members', compact('user'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function workHistory($user_name)
    {
        $user = User::where('user_name' , $user_name)->first();
        $user->with('personal_information');
        return view('user.view.profile.work-history', compact('user'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function genres($user_name)
    {
        $user = User::where('user_name' , $user_name)->first();
        $user->with('personal_information');
        return view('user.view.profile.genres', compact('user'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function services($user_name)
    {
        $user = User::where('user_name' , $user_name)->first();
        $user->with('personal_information');
        return view('user.view.profile.services', compact('user'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function rates($user_name)
    {
        $user = User::where('user_name' , $user_name)->first();
        $user->with('personal_information');
        return view('user.view.profile.rates', compact('user'), compact('user'));
    }

}
