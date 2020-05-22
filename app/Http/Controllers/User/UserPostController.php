<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User\User;

class UserPostController extends Controller
{

    private $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!$user = User::whereUsername($request->username)->first()) return abort(404);
            $this->user = $user;
            $this->user->load('personal_information', 'posts');
            return $next($request);
        });
    }
    /**
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function get()
    {
        return response()->json([
            'user' => $this->user
        ]);
    }

    /**
     * @param User $user
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $user = $this->user;
        $request->validate([
            'imagePost' => 'required|image|mimes:jpeg,png,jpg,gif,svg,mp3,mp4'
        ]);

        $imagePost = \Str::random(150).'-'. request()->imagePost->getClientOriginalExtension();
        request()->imagePost->move(base_path('public/images/post'), $imagePost);

        $post = new \App\Models\User\UserPost();
        $post->description = $request->postDescription;
        $post->genre = $request->postGenre;
        $post->category = $request->postCategory;
        $post->image = $imagePost;
        $post->user_id = $user->id;
        $user->posts()->save($post);

        return response()->json([
            'saved' => true,
            'post' => $post
        ]);
    }
    
    public function update()
    {

    }
}
