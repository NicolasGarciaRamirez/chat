<?php

namespace App\Http\Controllers\Reactions;

use Illuminate\Http\Request;
use \App\Models\User\User;
use \App\Http\Controllers\Controller;
use App\Models\Comment\Comment;
use App\Models\Post\Post;
use App\Models\User\LitLike;

class LitLikeController extends Controller
{

    /**
     * LitLikeController constructor.
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!$user = User::whereUsername($request->username)->first()) return abort(404);
            $this->user = $user;
            $this->user->load('personal_information', 'posts', 'profile_information.members', 'profile_information.releases');
            return $next($request);
        });
    }

    /**
     * @param Request $request
     * @param $username
     * @param $model
     * @param $id_model
     * @param Post $post
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function like(Request $request, $username, $model, $id_model,Post $post)
    {
        \DB::beginTransaction();
        try {
            if ($model == 'Post') {
                $model = Post::find($id_model);
            } else if ($model == 'Comment') {
                $model = Comment::find($id_model);
            }

            if ($request->like === 'like') {
                $like = new LitLike($request->all());
                $like->user()->associate($this->user);
                $model->likes()->save($like);
            }else{
                $like = null;
            }

            if ($model->getTable() == 'posts') \Mail::to($model->user->email)->send(new \App\Mail\ThoughtYourPostIsLit($model, $this->user->personal_information->full_name, $model->user->personal_information->full_name, $model->user->username));
            if ($model->getTable() == 'comments') \Mail::to($model->user->email)->send(new \App\Mail\ThoughtYourCommentIsLit($post, $this->user->personal_information->full_name, $model->user->personal_information->full_name, $model->user->username));

            \DB::commit();
            return response()->json([
                'like' => $like->load('user'),
                'errors' => null
            ]);
        } catch (\Exception $e) {
            \DB::rollBack();
            return response()->json([
                'like' => null,
                'errors' => $e
            ]);
        }
    }

    /**
     * @param $username
     * @param LitLike $like
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function unlike($username, LitLike $like)
    {
        $like->delete();

        return response()->json([
            'unlike' => $like->load('user'),
            'errors' => null,
        ]);
    }
}
