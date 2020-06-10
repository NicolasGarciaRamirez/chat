<?php

namespace App\Http\Controllers;

use App\Models\Post\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::with('likes.user','user.personal_information', 'comments.user.personal_information', 'comments.comments.user.personal_information', 'comments.likes.user', 'comments.comments.likes.user' ,'user.profile_information.members', 'user.profile_information.releases')->latest()->get();
        return view('home', compact('posts'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login()
    {
        return view('login', ['is_login_view' => \Auth::check()]);
    }

    /**
     * @param string $type
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function register($type = 'Index')
    {
        return view('register', compact('type'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function help()
    {
        return view('extras.help');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function about()
    {
        return view('extras.about');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function carrers()
    {
        return view('extras.carrers');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function terms()
    {
        return view('extras.terms');
    }
}
