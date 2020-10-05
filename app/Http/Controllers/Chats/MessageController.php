<?php

namespace App\Http\Controllers\Chats;

use App\Events\SendMessage;
use App\Models\Chats\Message;
use App\Models\User\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!$user = User::whereUsername($request->username)->first()) return abort(404);
            $this->user = $user;
            $this->user->load('personal_information', 'playlists.playlist_post', 'followers.user.profile_information', 'followers.user.personal_information', 'posts.comments.comments.likes.user', 'posts.likes.user', 'posts.votes.user', 'profile_information.members', 'profile_information.releases');
            return $next($request);
        });
    }

    public function get($username)
    {
        return view('chats.allUsers', ['users' => User::all()]);
    }

    public function fecthMessage($username,User $user)
    {
        $message = Message::with('user')->whereUserId($user->id)->get();
        return response()->json([
            'messages' => $message
        ]);
    }

    public function sendMessage($username,Request $request)
    {
        $message = $this->user->messages()->create([
            'message' => $request->message
        ]);

        broadcast(new SendMessage($message->load('user')))->toOthers();
        return response()->json([
            'send' => true,
            'message' => $message,
            'user' => $this->user
        ]);
    }

}
