<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User\User;

class UserController extends Controller
{
    /**
     * @var
     */
    private $user;

    /**
     * UserController constructor.
     */
    // public function __construct()
    // {
    //    $this->middleware(function ($request, $next) {
    //        if (!\Auth::check()) return redirect('/View/Channel/Playlist');
    //        $this->user = \Auth::user();
    //        return $next($request);
    //    });
    // }
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function channelActivity()
    {
        $user = \Auth::user();
        $user->load('personal_information');
        
        return view('user.profile.channel', compact('user'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function channelPlaylist()
    {
        $user = \Auth::user();
        $user->load('personal_information');
        
        return view('user.profile.channel-playlist', compact('user'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profileEdit()
    {
        $user = \Auth::user();
        $user->load('personal_information');
        return view('user.profile.edit', compact('user'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function channelEdit()
    {
        $user = \Auth::user();
        $user->load('personal_information');
        return view('user.profile.channel-edit', compact('user'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function accountSettings()
    {
        $user = \Auth::user();
        $user->load('personal_information');
        return view('user.profile.account-settings', compact('user'));
    }
}
