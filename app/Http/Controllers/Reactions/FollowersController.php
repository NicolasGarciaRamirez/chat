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
    private $user;

    /**
     * FollowersController constructor.
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
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
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
                'followings' => Followers::where('following_user', \Auth::user()->id)->with('following.followers.user')->get(),
                'errors' => null
            ]);
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json([
                'follow' => null,
                'followings' => null,
                'errors' => $e
            ]);
        }
    }

    /**
     * @param $username
     * @param Followers $follow
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function unfollow($username, Followers $follow)
    {
        $follow->delete();
        return response()->json([
            'user' => User::with('followers.user')->whereId($follow->user_id)->first(),
            'unfollow' => true,
            'followings' => Followers::where('following_user', \Auth::user()->id)->with('following.followers.user')->get(),
        ]);
    }
}
