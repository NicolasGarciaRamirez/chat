<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User\User;
use App\Models\User\UserProfileInformation;

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
            $this->user->load('personal_information', 'posts', 'profile_information');
            return $next($request);
        });
    }


    /**
     * @param User $user
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        // return $request;
        \DB::beginTransaction();

        try{
            $user = User::whereUsername($this->user->username)->first();
    
            $profile_information = new UserProfileInformation($request->all());
            $profile_information->social_media = json_encode($request->social_media);

            $user->profile_information()->update($profile_information->toArray());
    
            return response()->json([
                'updated' => true,
                'user' => User::find($this->user->id)->load('profile_information'),
                'errros' => null
            ],200);
        } catch (\Exception $e){
            return response()->json([
                'updated' => false,
                'user' => null,
                'errros' => $e
            ],422);
        }
    }
}
