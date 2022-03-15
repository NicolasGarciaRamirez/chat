<?php

namespace App\Http\Controllers\Notifications;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationsController extends Controller
{
    public function get($username)
    {
        return view('notifications.index');
    }

    public function markAsRead($username,$id)
    {
        \DB::beginTransaction();
        try{
            $user = \App\Models\User\User::whereUsername($username)->first();
            $user->unreadNotifications->markAsRead($id);
            \DB::commit();
            return response()->json([
                'markAsRead' => true
            ], 200);
        }catch(\Exception $e){
            \DB::rollBack();
            return response()->json([
                'errors' => $e->getMessage(),
                'markAsRead' => false
            ],500);
        }

    }

    public function markAsReadAll($username)
    {
        \DB::beginTransaction();
        try {
            $user = \App\Models\User\User::whereUsername($username)->first();
            $user->unreadNotifications->markAsRead();
            \DB::commit();
            return response()->json([
                'markAsReadAll' => true
            ], 200);
        }catch(\Exception $e){
            \DB::rollBack();
            return response()->json([
                'errors' => $e->getMessage(),
                'markAsRead' => false
            ],500);
        }
    }
}
