<?php

namespace App\Http\Controllers\Post;

use App\Models\Post\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User\User;
use Intervention\Image\Facades\Image;

class PostController extends Controller
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
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($username, $token)
    {
        $post = Post::with('votes.user', 'likes.user','user.personal_information', 'comments.user.personal_information', 'comments.comments.user.personal_information', 'comments.likes.user', 'comments.comments.likes.user' ,'user.profile_information.members', 'user.profile_information.releases')->whereToken($token)->first();
        return view('post.view', compact('post'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function store(Request $request) //cambiar a form request
    {
        \DB::beginTransaction();

        try {
            if ($request->imagePost != null) {
                // $request->validate([
                //     'imagePost' => 'required|mimes:jpeg,png,jpg,gif,svg,mp3,mp4'
                // ]);
                if ($request->resource_type == 'image') {
                    $imagePost = $this->setImage($request);
                }
                if ($request->resource_type == 'video') {
                    $key = md5(\Auth::user()->id);
                    $hash = \Str::random(10);
                    $imagePost = "/images/post/videos/{$hash}/{$key}/{$request->imagePost->getClientOriginalName()}.mp4";
                    $request->imagePost->move(public_path("/images/post/videos/{$hash}/{$key}"), $imagePost);
                }
                if ($request->resource_type == 'audio') {
                    $key = md5(\Auth::user()->id);
                    $hash = \Str::random(10);
                    $imagePost = "/images/post/audio/{$hash}/{$key}/{$request->imagePost->getClientOriginalName()}.mp3";
                    $request->imagePost->move(public_path("/images/post/audio/{$hash}/{$key}"), $imagePost);
                }


            }else{
                $imagePost = null;
            }

            $post = new Post($request->all());
            $post->resource = $imagePost;
            $post->resource_type = $request->resource_type;
            $post->token = \Str::random(80);
            $this->user->posts()->save($post);

            \DB::commit();
            return response()->json([
                'saved' => true,
                'post' => $post->load('user.personal_information', 'comments.user.personal_information', 'comments.comments.user.personal_information'),
                'errors' => null
            ], 200);
        } catch (\Exception $e) {
            \DB::rollBack();
            return response()->json([
                'saved' => false,
                'post' => null,
                'errors' => $e
            ], 422);
        }
    }

    public function update()
    {

    }

    /**
     * @param $request
     * @return string
     */
    public function setImage($request): string
    {
        $key = md5(\Auth::user()->id);
        $hash = \Str::random(10);
        $imageName = "/images/post/{$key}/{$hash}{$request->imagePost->getClientOriginalName()}";
        $request->imagePost->move(public_path("/images/post/{$key}/"), $imageName);

        $background = Image::canvas(1200, 600);
        $background->fill('#141414');

        $image = Image::make(public_path($imageName))->resize(1200, 600, function ($c) {
            $c->aspectRatio();
            $c->upsize();
        });

        $background->insert($image, 'center');
        $background->save(public_path($imageName));

        return $imageName;
    }
}
