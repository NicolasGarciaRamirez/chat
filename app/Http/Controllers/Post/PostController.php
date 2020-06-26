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
        $post = Post::with('votes.user', 'likes.user', 'user.personal_information', 'comments.user.personal_information', 'comments.comments.user.personal_information', 'comments.likes.user', 'comments.comments.likes.user', 'user.profile_information.members', 'user.profile_information.releases')->whereToken($token)->first();
        return view('post.view', ['post' => $post, 'user' => $this->user]);
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
            if ($request->resource != null) {
                // $request->validate([
                //     'imagePost' => 'required|mimes:jpeg,png,jpg,gif,svg,mp3,mp4,pdf,doc,docx,xls'
                // ]);
                $key = md5(\Auth::user()->id);
                $hash = \Str::random(10);
               

                if ($request->resource_type == 'image') {
                    $resource = $this->setImage($request);
                }
                if ($request->resource_type == 'video') {
                    $resource = "/images/post/videos/{$hash}/{$key}{$request->resource->getClientOriginalName()}"; //el video no solo puede ser mp4, puede ser avi, MKV, flv, etc
                    $request->resource->move(public_path("/images/post/videos/{$hash}/"), $resource);
                }
                if ($request->resource_type == 'audio') {
                    $resource = "/images/post/audio/{$hash}/{$key}{$request->resource->getClientOriginalName()}"; //aqui hay que ver xq tambien hay varios formatos de audio m4a, wav, etc
                    $request->resource->move(public_path("/images/post/audio/{$hash}/"), $resource);
                }
                if ($request->resource_type == 'docs') {
                    $resource = "/images/post/docs/{$key}/{$hash}{$request->resource->getClientOriginalName()}";
                    $request->resource->move(public_path("/images/post/docs/{$key}/"), $resource);
                }

            } else {
                $resource = null;
            }

            $post = new Post($request->all());
            $post->resource = $resource;
            if ($request->allow_download){
                $post->allow_download = $request->allow_download;
            }
            if ($request->replace_caption) {
                $post->replace_caption = $request->replace_caption;
            }
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

    public function update(Request $request , $token)
    {
        \DB::beginTransaction();
        try {
            Post::whereToken($token)->update( $request->except(['comments','user','time_ago', 'score','vote_down_count','vote_up_count','votes','likes']));
            \DB::commit();
            return response()->json([
                'updated' => true,
                'errors' => null
            ], 200);
        } catch (\Exception $e) {
            \DB::rollBack();
            return response()->json([
                'updated' => false,
                'errors' => $e
            ], 422);
        }
    }

    public function delete($username,$token)
    {
        $post = Post::whereToken($token)->delete();
        return response()->json([
            'deleted' => true,
            'errors' => null,
            'post' => $post
        ]);
    }
    /**
     * @param $request
     * @return string
     */
    public function setImage($request): string
    {
        $key = md5(\Auth::user()->id);
        $hash = \Str::random(10);
        $imageName = "/images/post/images/{$key}/{$hash}{$request->resource->getClientOriginalName()}";
        $request->resource->move(public_path("/images/post/images/{$key}/"), $imageName);

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
