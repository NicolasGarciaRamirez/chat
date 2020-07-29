<?php

namespace App\Http\Controllers\Post;

use App\Models\Post\Share;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post\Post;

class ShareController extends Controller
{
    public function save(Post $post){
        $share = new Share();
        $post->shares()->save($share);
        return response()->json([
            'saved' => true,
            'share' => $share
        ]);
    }
}
