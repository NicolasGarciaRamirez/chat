<?php

namespace App\Http\Controllers\User;

use App\Models\User\User;
use App\Models\User\UserTiersInformation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class UserTiersInformationController
 * @package App\Http\Controllers\User
 */
class UserTiersInformationController extends Controller
{
    /**
     * @var
     */
    private $user;

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!$user = User::whereUsername($request->username)->first()) return abort(404);
            $this->user = $user;
            $this->user->load('personal_information', 'social_auth', 'playlists.playlist_post.post.comments', 'followers.user.followers.user.personal_information', 'followers.user.followers.user.profile_information', 'followers.user.profile_information', 'followers.user.personal_information','posts.user','posts.views' ,'posts.comments.comments.likes.user', 'posts.likes.user', 'posts.votes.user', 'posts.shares' ,'profile_information.members', 'profile_information.releases', 'profile_information.worked_with');
            return $next($request);
        });
    }

    public function delete($username, UserTiersInformation $tier)
    {
        $tier->delete();
        return response()->json(['deleted' => true]);
    }

}
