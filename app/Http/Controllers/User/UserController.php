<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User\User;

class UserController extends Controller
{
    public function profile(User $user)
    {
        return view('user.contributor.profile', compact('user'));
    }

    public function channel()
    {
        return view('user.contributor.channel');
    }

    public function editProfile()
    {
        return view('user.contributor.edit-profile');
    }
}
