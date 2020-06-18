<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User\User;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    /**
     * @var
     */
    private $user;

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!$user = User::whereUsername($request->username)->first()) return abort(404);
            $this->user = $user;
            $this->user->load('personal_information', 'playlists.postsPlaylist.post.comments','followers.user.profile_information','followers.user.personal_information', 'posts.comments.comments.likes.user','posts.likes.user','posts.votes.user', 'profile_information.members', 'profile_information.releases');
            return $next($request);
        });
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function channelActivity()
    {
        return view('user.channel.channel-activity', ['user' => $this->user]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function channelPlaylist()
    {
        return view('user.channel.channel-playlist', ['user' => $this->user]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profileEdit()
    {
        return view('user.profile.profile-edit', ['user' => $this->user]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function channelEdit()
    {
        return view('user.channel.channel-edit', ['user' => $this->user]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function accountSettings()
    {
        return view('user.profile.account-settings', ['user' => $this->user]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function updateImage(Request $request) //hacer form request para validar
    {
        \DB::beginTransaction();

        try {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,mp3,mp4'
            ]);

            $imageName = $this->setImageProfile($request);
            $this->user->avatar = $imageName;
            $this->user->update();
            \DB::commit();

            return response()->json([
                'updated' => true,
                'user' => $this->user,
                'errors' => null
            ]);
        } catch (\Exception $e) {
            \DB::rollBack();
            return response()->json([
                'updated' => false,
                'user' => null,
                'errors' => $e
            ], 422);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function updateCover(Request $request) //hacer form request para validar
    {
        \DB::beginTransaction();

        try {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,mp3,mp4'
            ]);

            $imageName = $this->setImage($request);
            $this->user->cover = $imageName;
            $this->user->update();

            \DB::commit();
            return response()->json([
                'updated' => true,
                'user' => $this->user,
                'errors' => null
            ]);
        } catch (\Exception $e) {
            \DB::rollBack();
            return response()->json([
                'updated' => true,
                'user' => $this->user,
                'errors' => null
            ], 422);
        }
    }

    public function setImage($request): string
    {
        $key = md5(\Auth::user()->id);
        $hash = \Str::random(10);
        $imageName = "/images/post/{$key}/{$hash}{$request->image->getClientOriginalName()}";
        $request->image->move(public_path("/images/post/{$key}/"), $imageName);

        $background = Image::canvas(1200, 400);
        $background->fill('#141414');

        $image = Image::make(public_path($imageName))->resize(1200, 400, function ($c) {
            $c->aspectRatio();
            $c->upsize();
        });

        $background->insert($image, 'center');
        $background->save(public_path($imageName));

        return $imageName;
    }

    public function setImageProfile($request): string
    {
        $key = md5(\Auth::user()->id);
        $hash = \Str::random(10);
        $imageName = "/images/post/{$key}/{$hash}{$request->image->getClientOriginalName()}";
        $request->image->move(public_path("/images/post/{$key}/"), $imageName);

        $background = Image::canvas(400, 400);
        $background->circle(100,10,10);
        $background->fill('#141414');

        $image = Image::make(public_path($imageName))->resize(400,400, function ($c) {
            $c->aspectRatio();
            $c->upsize();
        });
        $background->insert($image, 'center');
        $background->save(public_path($imageName));

        return $imageName;
    }

    public function updateUser(Request $request)
    {
        \DB::beginTransaction();

        try {
            $this->user->update($request->all());
            \DB::commit();
            return response()->json([
                'updated' => true,
                'user' => User::find($this->user->id),
                'errors' => null
            ], 200);
        } catch (\Exception $e) {
            \DB::rollBack();
            return response()->json([
                'updated' => false,
                'user' => null,
                'errors' => $e
            ], 422);
        }
    }
}
