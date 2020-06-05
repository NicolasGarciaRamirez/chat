<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use \App\Models\User\User;
use \App\Http\Controllers\Controller;
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

    public function save(Request $request)
    {
        \DB::beginTransaction();

        try {

            $like = new LitLike($request->all());
            $like->user_id = $this->user->id;
            $like->save();

            \DB::commit();
            return response()->json([
                'saved' => true,
                'user' => $this->user,
                'errors' => null
            ]);
        } catch (\Exception $e) {
            \DB::rollBack();
            return response()->json([
                'saved' => false,
                'user' => null,
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
