<?php

namespace App\Http\Controllers\Post;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User\User;
use App\Models\Post\Post;
use App\Models\Post\VotePosts;


class VotePostsController extends Controller
{
    private $user;

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
     * Undocumented function
     *
     * @param Request $request
     * @param [type] $username
     * @param Post $post
     * @return void
     */
    public function voteUp(Request $request , $username, Post $post, VotePosts $vote = null)
    {
        if ($vote) {
            $vote->update(['type_vote' => 'vote_down']);
        }elseif ($request->type_vote == 'vote_up'){
            $vote = new VotePosts($request->all());
            $vote->type_vote = $request->type_vote;
            $vote->posts()->associate($this->user);
            $post->votes()->save($vote);
        }

        return response()->json([
            'voteUp' => $vote,
            'errors' => null
        ]);
    }

    /**
     * Undocumented function
     *
     * @param VotePosts $vote
     * @return void
     */
    public function unvoteUp($username ,VotePosts $vote)
    {
        $vote->delete();

        return response()->json([
            'unvoteUp' => $vote,
            'errors' => null
        ]);
    }
    /**
     * Undocumented function
     *
     * @param Request $request
     * @param [type] $username
     * @param Post $post
     * @param [type] $vote
     * @return void
     */
    public function voteDown(Request $request, $username, Post $post, VotePosts $votePost = null)
    {
        if ($votePost){
            $votePost->update($request->all());
        }else{
            $vote = new VotePosts($request->all());
            $vote->type_vote = $request->type_vote;
            $vote->posts()->associate($this->user);
            $post->votes()->save($vote);
        }

        return response()->json([
            'voteDown' => $vote,
            'errors' => null
        ]);
    }

    /**
     * Undocumented function
     *
     * @param [type] $vote
     * @return void
     */
    public function unvoteDown($usernamme, VotePosts $vote)
    {
        $vote->delete();

        return response()->json([
            'unvoteDown' => $vote,
            'errors' => null
        ]);
    }
}
