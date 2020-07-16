<?php

namespace App\Http\Controllers\Reactions;

use App\Mail\UpvotedYourPost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User\User;
use App\Models\Post\Post;
use App\Models\Post\VotePosts;


class VotePostsController extends Controller
{
    /**
     * @var
     */
    private $user;

    /**
     * VotePostsController constructor.
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
     * Undocumented function
     *
     * @param Request $request
     * @param [type] $username
     * @param Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function voteUp(Request $request, $username, Post $post, VotePosts $vote = null)
    {
        if ($vote) {
            $vote->type_vote = 'vote_up';
            $vote->update();
        } elseif ($request->type_vote == 'vote_up') {
            $vote = new VotePosts($request->all());
            $vote->type_vote = $request->type_vote;
            $vote->user()->associate($this->user);
            $post->votes()->save($vote);

            \Mail::to($post->user->email)->send(new UpvotedYourPost($post, $this->user->personal_information->full_name, $post->user->personal_information->full_name, $post->user->username));
        }

        return response()->json([
            'voteUp' => $vote->load('user'),
            'errors' => null
        ]);
    }

    /**
     * Undocumented function
     *
     * @param VotePosts $vote
     * @return \Illuminate\Http\JsonResponse
     */
    public function unvoteUp($username, VotePosts $vote)
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function voteDown(Request $request, $username, Post $post, VotePosts $vote = null)
    {
        if ($vote) {
            $vote->type_vote = 'vote_down';
            $vote->update();
        } else {
            $vote = new VotePosts($request->all());
            $vote->type_vote = $request->type_vote;
            $vote->user()->associate($this->user);
            $post->votes()->save($vote);
        }

        return response()->json([
            'voteDown' => $vote->load('user'),
            'errors' => null
        ]);
    }

    /**
     * Undocumented function
     *
     * @param [type] $vote
     * @return \Illuminate\Http\JsonResponse
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
