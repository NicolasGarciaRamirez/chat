<?php

namespace App\Http\Controllers\Comment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment\Comment;
use App\Models\Post\Post;
use App\Models\User\User;

class CommentController extends Controller
{
    /**
     * @var
     */
    private $user;

    /**
     * CommentController constructor.
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!$user = User::whereUsername($request->username)->first()) return abort(404);
            $this->user = $user;
            return $next($request);
        });
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, $username, $model, $id_model)
    {
        if($model == 'Post'){
            $model = Post::find($id_model);
        }elseif ($model == 'Comment'){
            $model = Comment::find($id_model);
        }

        $comment = new Comment($request->all());
        $comment->user()->associate($this->user);
        $model->comments()->save($comment);

        return response()->json([
            'saved' => true,
            'comment' => $comment->load('user.personal_information', 'comments')
        ]);
    }
}
