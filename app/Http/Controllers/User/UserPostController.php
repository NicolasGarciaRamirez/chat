<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User\User;

class UserPostController extends Controller
{
    public function get(User $user)
    {
        return response()->json([
            'user' => $user
        ]);
    }

    public function save(User $user, Request $request)
    {
        $request->validate([
            'imagePost' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $imagePost = $user->full_name. '-' .now()->format('Y-m-dHis').'.'.request()->imagePost->getClientOriginalExtension();
        request()->imagePost->move(base_path('public/images/post'), $imagePost);
        
        $post = new \App\Models\User\UserPost();
        $post->description = $request->postDescription;
        $post->genre = $request->postGenre;
        $post->category = $request->postCategory;
        $post->image = $imagePost;
        $post->user_id = $user->id;
        $user->posts()->save($post);

        return response()->json([
            'saved' => true ,
            'post' => $post
        ]);
    }

    public function update()
    {

    }
}
