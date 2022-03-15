<?php

namespace App\Http\Controllers\Payments;

use App\Http\Requests\StoreBilingInformation;
use App\Models\User\User;
use App\Models\Payments\PaymentsBilingInformation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class UserBilingInformationController
 * @package App\Http\Controllers\User
 */
class PaymentBilingInformationController extends Controller
{
    /**
     * @var
     */
    private $user;

    /**
     * UserBilingInformationController constructor.
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!$user = User::whereUsername($request->username)->first()) return abort(404);
            $this->user = $user;
            $this->user->load('personal_information', 'channel_information.tiers','channel_information.monthly_goal_last','social_auth', 'playlists.playlist_post.post.comments', 'followers.user.followers.user.personal_information', 'followers.user.followers.user.profile_information', 'followers.user.profile_information', 'followers.user.personal_information','posts.user','posts.views' ,'posts.comments.comments.likes.user', 'posts.likes.user', 'posts.votes.user', 'posts.shares' ,'profile_information.members', 'profile_information.releases', 'profile_information.worked_with');
            return $next($request);
        });
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Request $request)
    {
        $biling = PaymentsBilingInformation::updateOrCreate(
            ['id' => $request['id']],
            [
                'country' => $request['country'],
                'city' => $request['city'],
                'state' => $request['state'],
                'address' => $request['address'],
                'zip_code' => $request['zip_code'],
                'methods_payment_method' => $request['payment_method_id']
            ]
        );

        return response()->json([
            'saved' => true,
            'biling' => $biling
        ]);
    }
}
