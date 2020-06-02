<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User\User;
use App\Models\User\{UserProfileInformation, Members, Releases};

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
            $this->user->load('personal_information', 'posts', 'profile_information.members','profile_information.releases');
            return $next($request);
        });
    }

    public function save(Request $request)
    {
        \DB::beginTransaction();

        try {
            $profile_information = new UserProfileInformation($request->profile_information);
            $profile_information->social_media = json_encode($request->profile_information['social_media']);
            $profile_information->user_id = $this->user->id;
            // return $profile_information;
            $this->user->profile_information()->save($profile_information);

            collect($request->members_information)->each(function ($value) use($profile_information){
                $member = new Members($value);
                $member->profile_information_id = $profile_information['id'];
                $member->save();
            });

            collect($request->releases_information)->each(function ($query)  use($profile_information){
                $release = new Releases($query);
                $release->profile_information_id = $profile_information->id;
                $release->save();
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
            $this->user->profile_information()->update($profile_information->toArray());

            
            collect($request->members_information)->each(function ($value ){
                Members::updateOrCreate(
                    [ 'id' => $value['id'] ],
                    [
                        'member_name'           => $value['member_name'],
                        'member_type'           => $value['member_type'],
                        'link_profile'          => $value['link_profile'],
                        'role_instrument'       => $value['role_instrument'],
                        'profile_information_id'=> $this->user->profile_information->id
                    ]
                );
                
            });

            collect($request->releases_information)->each(function ($query){
                
                Releases::updateOrCreate(
                    ['id' => $query['id']],
                    [
                        'album_name'    	    => $query['album_name'],
                        'artistic_name'         => $query['artistic_name'],
                        'genre'                 => $query['genre'],
                        'image'                 => $query['image'],
                        'label'                 => $query['label'],
                        'release_date'          => $query['release_date'],
                        'profile_information_id'=> $this->user->profile_information->id
                    ]
                );
            });

            \DB::commit();
            return response()->json([
                'updated' => true,
                'user' => User::find($this->user->id)->load('profile_information'),
                'errros' => null
            ], 200);

        } catch (\Exception $e) {
            \DB::rollBack();
            return response()->json([
                'updated' => false,
                'user' => null,
                'errros' => $e
            ], 422);
        }
    }
}
