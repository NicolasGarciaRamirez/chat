<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\ImageRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User\User;
use Intervention\Image\Facades\Image;
use App\Notifications\PasswordChangedSuccessfully;

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
            $this->user->load('personal_information', 'social_auth', 'playlists.playlist_post.post.comments', 'followers.user.profile_information', 'followers.user.personal_information', 'posts.comments.comments.likes.user', 'posts.likes.user', 'posts.votes.user', 'profile_information.members', 'profile_information.releases', 'profile_information.worked_with');
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
     * @param ImageRequest $request
     * @param $username
     * @param $type
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function updateImage(ImageRequest $request, $username, $type)
    {
        \DB::beginTransaction();

        try {
            $imageName = $this->setImage($request, $type);
            if ($type == 'profile') {
                $this->user->avatar = $imageName;
            } else if ($type == 'cover') {
                $this->user->cover = $imageName;
            }
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
     * @param $request
     * @param $width
     * @param $heigth
     * @param $left
     * @param $top
     * @return string
     */
    public function setImage($request, $type): string
    {
        $key = md5(\Auth::user()->id);
        $hash = \Str::random(10);
        $imageName = "/images/post/profile/{$key}/{$hash}{$request->image->getClientOriginalName()}";
        $request->image->move(public_path("/images/post/profile/{$key}/"), $imageName);

        if ($type == 'cover') {

            $img = Image::make(public_path($imageName))->crop($request->width, $request->height, $request->left, $request->top);
            $img->save(public_path($imageName));
        } else if ($type == 'profile') {
            $img = Image::make(public_path($imageName))->crop($request->width, $request->height, $request->left, $request->top);
            $img->save(public_path($imageName));
        }
        return $imageName;
    }

    public function updateUser(Request $request)
    {
        \DB::beginTransaction();

        try {
            $this->user->update($request->all());
            \DB::commit();
            $this->user->notify(new PasswordChangedSuccessfully($this->user->personal_information->full_name));

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
