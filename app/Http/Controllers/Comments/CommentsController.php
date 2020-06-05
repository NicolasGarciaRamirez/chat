<?php

namespace App\Http\Controllers\Comments;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User\UserPost;
use App\Models\User\User;
use App\Models\User\Comments;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!$user = User::whereUsername($request->username)->first()) return abort(404);
            $this->user = $user;
            $this->user->load('personal_information', 'posts', 'profile_information.members', 'profile_information.releases');
            return $next($request);
        });
    }

    public function get($username)
    {
        // $user = User::whereUsername($username)->first();
        // $post = $user->load('posts.comments.user');
        // return response()->json([
        //     'post' => $post
        // ]);
    }

    public function save(Request $request)
    {
        $comment = new \App\Models\User\Comments($request->all());
        $comment->description = $request['description'];
        $comment->post_id = $request['post_id'];
        $comment->user_id = $this->user->id;
        $this->user->comment()->save($comment);

        return response()->json([
            'saved' => true,
        ]);
    }

    public function update()
    {

    }

    public function delete()
    {

    }
}
