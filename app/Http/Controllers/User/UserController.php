<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User\User;

class UserController extends Controller
{
    public function profile(User $user)
    {
        return view('User.Contributor.profile', compact('user'));
    }

    public function channel()
    {
        return view('User.Contributor.channel');
    }

    public function editProfile()
    {
        return view('User.Contributor.edit-profile');
    }
}
