<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserCompanyController extends Controller
{
 
    public function profile()
    {
        return view('user.company.profile');
    }
}
