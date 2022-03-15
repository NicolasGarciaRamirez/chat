<?php

namespace App\Http\Controllers\Channel;

use App\Models\User\User;
use Illuminate\Http\Request;

/**
 * Class MonthlyGoalController
 * @package App\Http\Controllers\Channel
 */
class MonthlyGoalController extends Controller
{
    /**
     * @var
     */
    private $user;

    /**
     * PlaylistController constructor.
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!$user = User::whereUsername($request->username)->first()) return abort(404);
            $this->user = $user;
            $this->user->load('personal_information', 'playlists.playlist_post', 'followers.user.profile_information', 'followers.user.personal_information', 'posts.comments.comments.likes.user', 'posts.likes.user', 'posts.votes.user', 'profile_information.members', 'profile_information.releases');
            return $next($request);
        });
    }

}
