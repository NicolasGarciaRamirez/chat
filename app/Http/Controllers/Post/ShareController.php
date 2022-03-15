<?php

namespace App\Http\Controllers\Post;

use App\Models\Post\Share;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post\Post;

/**
 * Class ShareController
 * @package App\Http\Controllers\Post
 */
class ShareController extends Controller
{
    /**
     * @param Post $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function save(Post $post){
        $share = new Share();
        $post->shares()->save($share);
        return response()->json([
            'saved' => true,
            'share' => $share
        ]);
    }
}
