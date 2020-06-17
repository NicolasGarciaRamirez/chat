<?php

namespace App\Http\Controllers\Channel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Channel\ChannelPlaylist;
use App\Models\Post\Post;
use App\Models\User\User;

class ChannelPlaylistController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!$user = User::whereUsername($request->username)->first()) return abort(404);
            $this->user = $user;
            $this->user->load('personal_information', 'playlists.postsPlaylist.posts','followers.user.profile_information','followers.user.personal_information', 'posts.comments.comments.likes.user','posts.likes.user','posts.votes.user', 'profile_information.members', 'profile_information.releases');
            return $next($request);
        });
    }

    public function store(Request $request)
    {
        $key = md5(\Auth::user()->id);
        $hash = \Str::random(10);
        $imageName = "/images/playlist/{$key}/{$hash}/{$request->image->getClientOriginalName()}";
        $request->image->move(public_path("/images/playlist/{$key}/{$hash}/"), $imageName);

        $playlist = new ChannelPlaylist($request->all());
        $playlist->image = $imageName;
        $this->user->playlists()->save($playlist);
        return response()->json([
            'saved' => true,
            'playlist' => $playlist,
            'errors' => null
        ]);
    }

    public function addPlaylistPost($username ,Post $post)
    {
        return $post;
    }

    public function update(Request $request)
    {

    }

    public function delete()
    {
        
    }
}
