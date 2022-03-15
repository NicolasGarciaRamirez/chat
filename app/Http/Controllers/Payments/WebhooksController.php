<?php

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use App\Models\Post\Post;
use Illuminate\Http\Request;

/**
 * Class WebhooksController
 * @package App\Http\Controllers\Payments
 */
class WebhooksController extends Controller
{
    /**
     * @param null $response
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function success($response = null)
    {
        $posts = Post::with('views', 'shares', 'votes.user', 'likes.user', 'user.followers.user.profile_information', 'user.followers.user.personal_information', 'user.personal_information', 'comments.user.personal_information', 'comments.user.profile_information', 'comments.comments.user.personal_information', 'comments.comments.user.profile_information', 'comments.likes.user', 'comments.comments.likes.user', 'user.profile_information.members', 'user.profile_information.releases', 'user.channel_information.tiers', 'user.supports.user', 'user.rewards.user', 'user.payment_methods.biling_information')->latest()->get();
        return view('Payments.account-connect-success', ['response' => $response, 'posts' => $posts]);
    }

    /**
     * @return string
     */
    public function error()
    {
        return 'account connect error';
    }
}
