<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User\User;
use App\Models\User\UserPersonalInformation;

class UserPersonalInformationController extends Controller
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
     * @throws \Exception
     */
    public function update(Request $request)
    {
        \DB::beginTransaction();

        try {
            $this->user->personal_information()->update($request->all());
            \DB::commit();

            return response()->json([
                'updated' => true,
                'user' => User::find($this->user->id),
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
