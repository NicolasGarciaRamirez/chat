<?php

namespace App\Http\Controllers;

use App\Models\Post\Post;
use App\Models\User\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use TheSeer\Tokenizer\Token;

class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = collect();
        $posts = Post::with('views', 'shares', 'votes.user', 'likes.user', 'user.followers.user.profile_information', 'user.followers.user.personal_information', 'user.personal_information', 'comments.user.personal_information', 'comments.user.profile_information', 'comments.comments.user.personal_information', 'comments.comments.user.profile_information', 'comments.likes.user', 'comments.comments.likes.user', 'user.profile_information.members', 'user.profile_information.releases')->latest()->get();
        if (\Auth::check()) {
            $user = \Auth::user();
            $user->load('followers.user.profile_information', 'followers.user.personal_information', 'playlists.playlist_post.post.comments');
        }

        return view('home', compact('posts', 'user'));
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

    /**
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function suggestions()
    {
        return view('extras.suggestions');
    }

    /**
     * @param Token
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showPost($token)
    {
        $post = Post::with('views', 'votes.user', 'shares', 'likes.user', 'comments.user.personal_information', 'comments.user.profile_information', 'comments.comments.user.personal_information', 'comments.comments.user.profile_information', 'comments.likes.user', 'comments.comments.likes.user', 'user.personal_information', 'user.profile_information', 'user.profile_information.members', 'user.profile_information.releases', 'user.followers.user.profile_information', 'user.followers.user.personal_information',)->whereToken($token)->first();
        return view('post.view', ['post' => $post]);
    }

    /**
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function searchView(){
        return view('search');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $result = User::whereHas('personal_information', function ($query) use ($request) {
            $query->where('full_name', 'like', "%{$request->search_body}%");
        })->orWhereHas('profile_information', function ($query) use ($request) {
            $query->where('artistic_name', 'like', "%{$request->search_body}%");
        })->with('personal_information', 'profile_information')->get();

        return response()->json([
            'result' => $result
        ]);
    }
}
