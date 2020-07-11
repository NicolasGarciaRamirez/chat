<?php

namespace App\Http\Controllers\Post;

use App\Models\Post\Post;
use App\Models\Post\PostViews;
use App\Models\User\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostViewsController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!$user = User::whereUsername($request->username)->first()) return abort(404);
            $this->user = $user;
            $this->user->load('personal_information', 'posts', 'profile_information.members', 'profile_information.releases');
            return $next($request);
        });
    }

    public function save($username, Post $post)
    {
        $view = new PostViews();
        $view->user_id = $this->user->id;
        $post->views()->save($view);
        return response()->json([
            'saved' => true,
            'errors' => null,
        ]);
    }

}
