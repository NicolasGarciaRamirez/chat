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
    public function activity(User $user)
    {
        $user->load('personal_information');
        return view('user.view.channel.activity', compact('user'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function playlist(User $user)
    {
        $user->load('personal_information');
        return view('user.view.channel.playlist', compact('user'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function releases(User $user)
    {
        $user->load('personal_information');
        return view('user.view.profile.releases', compact('user'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function members(User $user)
    {
        $user->load('personal_information');
        return view('user.view.profile.members', compact('user'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function workHistory(User $user)
    {
        $user->load('personal_information');
        return view('user.view.profile.work-history', compact('user'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function genres(User $user)
    {
        $user->load('personal_information');
        return view('user.view.profile.genres', compact('user'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function services(User $user)
    {
        $user->load('personal_information');
        return view('user.view.profile.services', compact('user'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function rates(User $user)
    {
        $user->load('personal_information');
        return view('user.view.profile.rates', compact('user'), compact('user'));
    }

}
