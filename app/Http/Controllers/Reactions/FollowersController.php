<?php

namespace App\Http\Controllers\Reactions;

use App\Mail\StartedFollowYou;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User\User;
use App\Models\Post\Post;
use App\Models\Reactions\Followers;

class FollowersController extends Controller
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

    public function follow(Request $request, $username, User $user)
    {
        \DB::beginTransaction();
        try {
            $follow = new Followers($request->all());
            $follow->following_user = $this->user->id;
            $user->followers()->save($follow);

            \Mail::to($user->email)->send(new StartedFollowYou($this->user, $this->user->personal_information->full_name, $user->personal_information->full_name));

            \DB::commit();

            return response()->json([
                'follow' => $follow->load('user.personal_information'),
                'errors' => null
            ]);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json([
                'follow' => null,
                'errors' => $e
            ]);
        }
    }

    public function unfollow($username, Followers $follow)
    {
        $follow->delete();
        return response()->json([
            'unfollow' => $follow,
            'errors' => null
        ]);
    }

}
