<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User\User;

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
            $this->user->load('personal_information', 'posts', 'profile_information.members', 'profile_information.releases');
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
                'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg,mp3,mp4'
            ]);

            $avatar = '/images/profile' . '/' . \Str::random(150) . request()->avatar->getClientOriginalExtension();
            request()->avatar->move(base_path('public/images/profile'), $avatar);

            $this->user->avatar = $avatar;
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
                'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg,mp3,mp4'
            ]);

            $cover = '/images/profile' . '/' . \Str::random(150) . request()->cover->getClientOriginalExtension();
            request()->cover->move(base_path('public/images/profile'), $cover);

            $this->user->cover = $cover;
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
