<?php

namespace App\Http\Controllers\Channel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Channel\Playlist;
use App\Models\Channel\PlaylistPost;
use App\Models\Post\Post;
use App\Models\User\User;

class PlaylistController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!$user = User::whereUsername($request->username)->first()) return abort(404);
            $this->user = $user;
            $this->user->load('personal_information', 'playlists.playlist_post','followers.user.profile_information','followers.user.personal_information', 'posts.comments.comments.likes.user','posts.likes.user','posts.votes.user', 'profile_information.members', 'profile_information.releases');
            return $next($request);
        });
    }

    public function get($username, $token)
    {
        $playlist = Playlist::where('token',$token)->first();
        $playlist->load('playlist_post.post.user.personal_information','playlist_post.post.comments.user.personal_information','playlist_post.post.comments.comments.user.personal_information','playlist_post.post.likes.user','playlist_post.post.comments.likes.user.personal_information','playlist_post.post.comments.comments.likes.user.personal_information','playlist_post.post.votes.user');
        return view('user.channel.playlist', ['playlist'=> $playlist, 'user'=>$this->user]);
    }

    public function store(Request $request)
    {
        $key = md5(\Auth::user()->id);
        $hash = \Str::random(10);
        $imageName = "/images/playlist/{$key}/{$hash}{$request->image->getClientOriginalName()}";
        $request->image->move(public_path("/images/playlist/{$key}/"), $imageName);

        $playlist = new Playlist($request->all());
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
        $playlist = Playlist::whereId($id_playlist)->first();

        $PlaylistPost = new PlaylistPost();
        $PlaylistPost->playlist_post_id = $post->id;
        $playlist->playlist_post()->save($PlaylistPost);

        return response()->json([
            'saved' => true,
            'errors' => null
        ]);
    }

    public function update(Request $request, $username, Playlist $playlist)
    {
        $key = md5(\Auth::user()->id);
        $hash = \Str::random(10);
        $imageName = "/images/playlist/{$key}/{$hash}{$request->image->getClientOriginalName()}";
        $request->image->move(public_path("/images/playlist/{$key}/"), $imageName);

        $playlist->update($request->all());
        $playlist->image =  $imageName;
        return response()->json([
            'updated' => true,
            'errors' => null
        ]); 
    }

    public function delete($username, Playlist $playlist)
    {
        $playlist->delete();
        return response()->json([
            'deleted' => true,
            'errors' => null
        ]); 
    }
}
