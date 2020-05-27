<?php

namespace App\Http\Controllers\Comments;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User\UserPost;
use App\Models\User\User;
use App\Models\User\Comments;

class CommentsController extends Controller
{
    public function get($username)
    {
        // $user = User::whereUsername($username)->first();
        // $post = $user->load('posts.comments.user');
        // return response()->json([
        //     'post' => $post
        // ]);
    }

    public function save($username, Request $request)
    {

        $user = User::whereUsername($username)->first();

        $comment = new \App\Models\User\Comments();
        $comment->comment = $request['description'];
        $comment->post_id = $request['post_id'];
        $comment->user_id = $user->id;
        $user->comment()->save($comment);

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
