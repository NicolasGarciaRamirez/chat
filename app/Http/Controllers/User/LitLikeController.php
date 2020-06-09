<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use \App\Models\User\User;
use \App\Http\Controllers\Controller;
use App\Models\Comment\Comment;
use App\Models\Post\Post;
use App\Models\User\LitLike;

class LitLikeController extends Controller
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

    public function store(Request $request, $username, $model, $id_model, $type, $id_like = null)
    {   
        return $id_like;
        \DB::beginTransaction();

        try {
            if ($model == 'Post') {
                $model = Post::find($id_model);
            } elseif ($model == 'Comment') {
                $model = Comment::find($id_model);
            }

            // return $type;
            if ($request->like == 'like') {
                $like = new LitLike($request->all());
                $like->user()->associate($this->user);
                $model->likes()->save($like);
            } elseif ($request->like == 'unlike'){
                $lit = LitLike::find($id_like);
                $lit->delete();
            }
            
            \DB::commit();
            return response()->json([
                'saved' => true,
                'like' => $like,
                'errors' => null
            ]);
        } catch (\Exception $e) {
            \DB::rollBack();
            return response()->json([
                'saved' => false,
                'like' => $like,
                'errors' => $e
            ]);
        }

    }

    public function update(Request $request)
    {

    }

    public function delete(Request $request)
    {

    }
}
