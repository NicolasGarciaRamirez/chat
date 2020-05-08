<?php

namespace App\Http\Controllers\Comments;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User\UserPost;
use App\Models\Comments\Comments;

class CommentsController extends Controller
{
    public function get(UserPost $userPost)
    {   
        $post = $userPost->load('comments');
        return response()->json([
            'post' => $post
        ]);
    }

    public function save(UserPost $userPost, Request $request)
    {
        $user = \Auth::user();
        $comment = new \App\Models\Comments\Comments();
        $comment->comment = $request['description'];
        $comment->post_id = $userPost->id;
        $comment->user_comment_id = $user->id;
        $userPost->comments()->save($comment);

        return response()->json([
            'saved' => true,
            'comment' => $comment
        ]);
    }

    public function update()
    {

    }

    public function delete()
    {

    }
}
