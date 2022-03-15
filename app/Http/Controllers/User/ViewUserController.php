<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User\User;

/**
 * Class ViewUserController
 * @package App\Http\Controllers\User
 */
class ViewUserController extends Controller
{

    /**
     * @var
     */
    private $user;

    /**
     * ViewUserController constructor.
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!$user = User::whereUsername($request->username)->first()) return abort(404);
            $this->user = $user;
            $this->user->load(
                'personal_information',
                'supports.user',
                'rewards.user',
                'channel_information.tiers',
                'followers.user.personal_information',
                'followers.user.profile_information',
                'following.following.profile_information',
                'following.following.personal_information',
                'profile_information.members',
                'profile_information.releases',
                'profile_information.worked_with')->loadCount('following', 'followers', 'supports');
            return $next($request);
        });
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function activity()
    {
        return view('user.channel.channel.activity', ['user' => $this->user]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function playlist()
    {
        return view('user.channel.channel.playlist', ['user' => $this->user]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function releases()
    {
        return view('user.profile.releases', ['user' => $this->user]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function members()
    {
        return view('user.profile.members', ['user' => $this->user]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('user.profile.index', ['user' => $this->user]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function genres()
    {
        return view('user.profile.genres', ['user' => $this->user]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function services()
    {
        return view('user.profile.services', ['user' => $this->user]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function socialMedia()
    {
        return view('user.profile.social_media', ['user' => $this->user]);
    }

}
