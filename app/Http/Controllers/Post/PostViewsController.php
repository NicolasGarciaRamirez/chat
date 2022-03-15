<?php

namespace App\Http\Controllers\Post;

use App\Models\Post\Post;
use App\Models\Post\PostViews;
use App\Models\User\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostViewsController extends Controller
{
    /**
     * @var
     */
    private $user;

    /**
     * PostViewsController constructor.
     */
    public function __construct()
    {
//        $this->middleware(function ($request, $next) {
//            if (!$user = User::whereUsername($request->username)->first()) return abort(404);
//            $this->user = $user;
//            $this->user->load('personal_information', 'posts', 'profile_information.members', 'profile_information.releases');
//            return $next($request);
//        });
    }

    /**
     * @param $username
     * @param Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Post $post)
    {
        $view = new PostViews();
        $post->views()->save($view);
        return response()->json([
            'view' => $view,
            'saved' => true,
            'errors' => null,
        ]);
    }

}
