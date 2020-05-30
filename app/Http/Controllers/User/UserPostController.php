<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User\User;
use Intervention\Image\Facades\Image;

class UserPostController extends Controller
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
    public function get()
    {
        return response()->json([
            'user' => $this->user
        ]);
    }

    /**
     * @param User $user
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        \DB::beginTransaction();

        try {
            $request->validate([
                'imagePost' => 'required|image|mimes:jpeg,png,jpg,gif,svg,mp3,mp4'
            ]);

            $imagePost = $this->setImage($request);

            $post = new \App\Models\User\UserPost();
            $post->description = $request->postDescription;
            $post->genre = $request->postGenre;
            $post->category = $request->postCategory;
            $post->image = $imagePost;
            $post->user_id = $this->user->id;
            $this->user->posts()->save($post);

            \DB::commit();
            return response()->json([
                'saved' => true,
                'post' => $post->load('user.personal_information'),
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
