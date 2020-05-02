<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User\User;
use App\Models\User\UserPersonalInformation;

class UserPersonalInformationController extends Controller
{
    /**
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function get(User $user)
    {
        return response()->json([
            'user' => $user->load('personal_information')
        ]);
    }

    /**
     * @param User $user
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(User $user , Request $request)
    {
        $personal_information = new UserPersonalInformation($request->all());
        $personal_information->members = json_encode($request->members);
        $personal_information->releases = json_encode($request->releases);
        $personal_information->social_media = json_encode($request->social_media);
        $user->personal_information()->update($personal_information->toArray());

        return response()->json([
            'updated' => true,
            'personal_information' => $user->personal_information
        ]);
    }
}
