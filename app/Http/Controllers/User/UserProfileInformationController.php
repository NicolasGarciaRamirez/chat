<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User\User;
use Intervention\Image\Facades\Image;
use App\Models\User\{UserProfileInformation, Members, Releases, WorkedWith};

/**
 * Class UserProfileInformationController
 * @package App\Http\Controllers\User
 */
class UserProfileInformationController extends Controller
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
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function save(Request $request)
    {
        \DB::beginTransaction();

        try {
            $profile_information = new UserProfileInformation($request->profile_information);
            $profile_information->social_media = json_encode($request->profile_information['social_media']);
            $profile_information->display_genres = json_encode($request->profile_information['display_genres']);
            $profile_information->display_services = json_encode($request->profile_information['display_services']);
            $profile_information->user_id = $this->user->id;

            $this->user->profile_information()->save($profile_information);

            collect($request->members_information)->each(function ($value) use ($profile_information) {
                $member = new Members($value);
                $member->profile_information_id = $profile_information['id'];
                $member->save();
            });

            collect($request->releases_information)->each(function ($query) use ($profile_information) {
                $release = new Releases($query);
                $release->profile_information_id = $profile_information->id;
                $release->save();
            });

            collect($request->worked_with_information)->each(function ($query) use ($profile_information) {
                $work_with = new WorkedWith($query);
                $work_with->profile_information_id = $profile_information->id;
                $work_with->save();
            });

            \DB::commit();

            return response()->json([
                'saved' => true,
                'user' => User::find($this->user->id)->load('profile_information'),
                'errros' => null
            ], 200);

        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json([
                'saved' => false,
                'user' => null,
                'errros' => $e
            ], 422);
        }
    }

    /**
     * @param User $user
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function update(Request $request)
    {
        \DB::beginTransaction();

        try {
            $profile_information = new UserProfileInformation($request->profile_information);
            $profile_information->social_media = json_encode($request->profile_information['social_media']);
            $profile_information->display_genres = json_encode($request->profile_information['display_genres']);
            $profile_information->display_services = json_encode($request->profile_information['display_services']);
            $this->user->profile_information()->update($profile_information->toArray());

            Members::whereProfileInformationId($this->user->profile_information->id)->delete();

            collect($request->members_information)->each(function ($value) {
                Members::updateOrCreate(
                    ['id' => $value['id']],
                    [
                        'member_name' => $value['member_name'],
                        'member_type' => $value['member_type'],
                        'link_profile' => $value['link_profile'],
                        'role_instrument' => $value['role_instrument'],
                        'profile_information_id' => $this->user->profile_information->id
                    ]
                );

            });

            Releases::whereProfileInformationId($this->user->profile_information->id)->delete();

            collect($request->releases_information)->each(function ($query) {
                Releases::updateOrCreate(
                    ['id' => $query['id']],
                    [
                        'album_name' => $query['album_name'],
                        'artistic_name' => $query['artistic_name'],
                        'genre' => $query['genre'],
                        'image' => $query['image'],
                        'label' => $query['label'],
                        'release_date' => $query['release_date'],
                        'profile_information_id' => $this->user->profile_information->id
                    ]
                );
            });

            collect($request->profile_information['worked_with'])->each(function ($query) {
                WorkedWith::updateOrCreate(
                    ['id' => $query['id']],
                    [
                        'name' => $query['name'],
                        'profile_information_id' => $this->user->profile_information->id,
                    ]
                );
            });

            \DB::commit();
            return response()->json([
                'updated' => true,
                'user' => User::find($this->user->id)->load('profile_information'),
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveImageRelease(Request $request)
    {
         \DB::beginTransaction();
         try {
            $key = md5(\Auth::user()->id);
            $hash = \Str::random(10);
            $imageName = "/images/releases/{$key}/{$hash}{$request->image->getClientOriginalName()}";
            $request->image->move(public_path("/images/releases/{$key}/"), $imageName);

            $img = Image::make(public_path($imageName))->crop($request->width, $request->height, $request->left, $request->top);
            $img->save(public_path($imageName));
            \DB::commit();
            return response()->json([
                'saved_image' => true,
                'image_name' => $imageName
            ]);
        }catch (\Exception $e){
            \DB::rollback();
            return response()->json([
                'saved_image' => false,
                'image_name' => null,
                'error' => $e
            ]);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function profileInformationUpdate(Request $request)
    {
        \DB::beginTransaction();
        try{
            $profile = new UserProfileInformation($request->all());
            $this->user->profile_information()->save($profile);

            \DB::commit();
            return response()->json([
                'updated' => true,
                'errors' => null
            ]);
        } catch (\Exception $e){
            \DB::rollBack();
            return response()->json([
                'updated'=> false,
                'errors' => $e->getMessage()
            ]);
        }

    }

    /**
     * @param $username
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveWorkedWith($username, Request $request)
    {
        $work_with = new WorkedWith($request->all());
        $this->user->profile_information->worked_with()->save($work_with);

        return response()->json([
            'save' =>  true,
            'workWith' => $work_with
        ]);
    }
    /**
     * @param WorkedWith $WorkedWith
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function deleteWorkedWith($username, WorkedWith $WorkedWith)
    {
        $WorkedWith->delete();
        return response()->json([
            'deleted' => true
        ]);
    }
}
