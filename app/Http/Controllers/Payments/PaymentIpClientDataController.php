<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use App\Models\Payments\PaymentIpClientData;
use App\Models\User\User;
use Illuminate\Http\Request;

class PaymentIpClientDataController extends Controller
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
            $this->user->load('personal_information', 'channel_information.tiers','channel_information.monthly_goal_last','social_auth', 'playlists.playlist_post.post.comments', 'followers.user.followers.user.personal_information', 'followers.user.followers.user.profile_information', 'followers.user.profile_information', 'followers.user.personal_information','posts.user','posts.views' ,'posts.comments.comments.likes.user', 'posts.likes.user', 'posts.votes.user', 'posts.shares' ,'profile_information.members', 'profile_information.releases', 'profile_information.worked_with', 'payment_ip_data');
            return $next($request);
        });
    }

    public function save($username, Request $request)
    {
        \DB::beginTransaction();

        try {
            if($this->user->payment_ip_data === null){
                $client_ip_data = new PaymentIpClientData($request->except('currency'));
                $client_ip_data->currency = json_encode($request->currency);
                $this->user->payment_ip_data()->save($client_ip_data);
            }
            \DB::commit();
            return response()->json([
                'saved' => true,
                'errors'=> null,
                'user' => $this->user->load('payment_ip_data')
            ]);

        }catch (\Exception $e){

            \DB::rollBack();
            return response()->json([
                'saved' => false,
                'errors'=> $e->getMessage()
            ]);
        }
    }
}

