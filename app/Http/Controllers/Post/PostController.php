<?php

namespace App\Http\Controllers\Post;

use App\Models\Post\Post;
use App\Models\User\User;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{

    /**
     * @var
     */
    private $user;

    /**
     * PostController constructor.
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
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function store(Request $request) //cambiar a form request
    {
        \DB::beginTransaction();
        try {
            if ($this->user->profile_information) {
                if ($request->resource != null) {
                    $key = md5(\Auth::user()->id);
                    $hash = \Str::random(10);
                    $credit_first_video = false;

                    if ($request->resource_type == 'image') {
                        $resource = $this->setImage($request);
                    }
                    if ($request->resource_type == 'video') {
                        $resource = "/images/post/videos/{$hash}/{$key}{$request->resource->getClientOriginalName()}";
                        $request->resource->move(public_path("/images/post/videos/{$hash}/"), $resource);
                        if($request->thumbnail != null){
                            $thumbnail = "/images/post/videos/thumbnails/{$hash}/{$key}{$request->thumbnail->getClientOriginalName()}";
                            $request->thumbnail->move(public_path("/images/post/videos/thumbnails/{$hash}/"), $thumbnail);
                        }
                    }
                    if ($request->resource_type == 'audio') {
                        $resource = "/images/post/audio/{$hash}/{$key}{$request->resource->getClientOriginalName()}";
                        $request->resource->move(public_path("/images/post/audio/{$hash}/"), $resource);
                    }
                    if ($request->resource_type == 'docs') {
                        $resource = "/images/post/docs/{$key}/{$hash}{$request->resource->getClientOriginalName()}";
                        $request->resource->move(public_path("/images/post/docs/{$key}/"), $resource);
                    }
                    if ($request->resource_type === 'link') {
                        $resource = $request->resource;
                        $thumbnail = $request->thumbnail;
                    }

                } else {
                    $resource = null;
                }

                $post = new Post($request->except('allow_download'));
                $post->resource = $resource;
                if ($request->allow_download === 'true') {
                    $post->allow_download = 1;
                }
                if ($request->replace_caption) {
                    $post->replace_caption = $request->replace_caption;
                }
                if($request->thumbnail){
                    $post->thumbnail = $thumbnail;
                }
                if($request->resource_type === 'link') {
                    $post->link = $request->link;
                    $post->domain = $request->domain;
                    $post->link_info = $request->link_info;
                }
                $post->privacy = $request->privacy;
                $post->resource_type = $request->resource_type;
                $post->token = \Str::random(15);
                if ($this->user->profile_information) {

                     //Validacion del primer post es audio, video, link
                    if($this->user->your_first_post){
                        if($post->resource_type == 'video' || $post->resource_type == 'link' || $post->resource_type == 'audio'){
                            
                            $this->user->credit += 5;
                            $this->user->update();
                
                            $credit_first_video = true;                     
                            
                        } 
                    }
                    //------------------------------------------------------

                    //Validacion si el usuario ha hecho publicaciones esta semana
                    $accept_credit = false;
                    if($this->user->one_credit_week){
                        $this->user->credit += 1;
                        $this->user->update();
            
                        $accept_credit = true;
                    }

                    $this->user->posts()->save($post);
                    
  

                    \DB::commit();
                }

                return response()->json([
                    'saved' => true,
                    'post' => $post->load('user.personal_information', 'user.profile_information', 'comments.user.personal_information', 'comments.comments.user.personal_information', 'views' ,'shares', 'likes', 'votes.user'),
                    'valid' => $this->user->profile_information ? true : false,
                    'errors' => null,
                    'credit_first_video' => $credit_first_video,
                    'credit_post_week' => $accept_credit,
                    'user' => $this->user
                ], 200);
            }
        } catch (\Exception $e) {
            \DB::rollBack();
            return response()->json([
                'saved' => false,
                'post' => null,
                'credit_first_video' => false,
                'credit_post_week' => false,
                'errors' => $e->getMessage()
           ], 422);
        }
    }

    /**
     * @param Request $request
     * @param $token
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function update(Request $request, $username, $token)
    {
        \DB::beginTransaction();
        try {
            Post::whereToken($token)->update($request->only(['description','privacy']));
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

    /**
     * @param $username
     * @param Post $post
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete($username, Post $post)
    {
        \File::delete(public_path("{$post->resource}"));
        $post->delete();
        return response()->json([
            'deleted' => true,
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

        return $imageName;
    }

}
