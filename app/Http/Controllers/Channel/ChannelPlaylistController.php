<?php

namespace App\Http\Controllers\Channel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Channel\ChannelPlaylist;
use App\Models\Channel\PostPlaylist;
use App\Models\Post\Post;
use App\Models\User\User;

class ChannelPlaylistController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!$user = User::whereUsername($request->username)->first()) return abort(404);
            $this->user = $user;
            $this->user->load('personal_information', 'playlists.postsPlaylist','followers.user.profile_information','followers.user.personal_information', 'posts.comments.comments.likes.user','posts.likes.user','posts.votes.user', 'profile_information.members', 'profile_information.releases');
            return $next($request);
        });
    }

    public function get($username, $token)
    {
        $playlist = ChannelPlaylist::where('token',$token)->first();
        $playlist->load('postsPlaylist.post.comments.comments.likes.user','postsPlaylist.post.comments.likes.user','postsPlaylist.post.likes.user');
        return view('user.channel.playlist', ['playlist'=> $playlist, 'user'=>$this->user]);
    }

    public function store(Request $request)
    {
        $key = md5(\Auth::user()->id);
        $hash = \Str::random(10);
        $imageName = "/images/playlist/{$key}/{$hash}{$request->image->getClientOriginalName()}";
        $request->image->move(public_path("/images/playlist/{$key}/"), $imageName);

        $playlist = new ChannelPlaylist($request->all());
        $playlist->token = \Str::random(80);
        $playlist->image = $imageName;
        $this->user->playlists()->save($playlist);
        return response()->json([
            'saved' => true,
            'playlist' => $playlist,
            'errors' => null
        ]);
    }

    public function addPlaylistPost($username ,Post $post, $id_playlist)
    {
        $channel_playlist = ChannelPlaylist::whereId($id_playlist)->first();

        $postPlaylist = new PostPlaylist();
        // $postPlaylist->channel_playlist_id = $id_playlist;
        $postPlaylist->playlist_post_id = $post->id;
        $channel_playlist->postsPlaylist()->save($postPlaylist);

        return response()->json([
            'saved' => true,
            'errors' => null
        ]);
    }

    public function update(Request $request)
    {

    }

    public function delete($username, $token)
    {
        
    }
}
