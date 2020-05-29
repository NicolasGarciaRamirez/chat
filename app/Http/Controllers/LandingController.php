<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLanding;
use App\Models\Landing;

class LandingController extends Controller
{
    /**
     * @param StoreLanding $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreLanding $request)
    {
        $request->validate([
            'email' => 'unique:landings'
        ]);
        
        Landing::create($request->all());

        session()->flash('message', "Email has been registered!");
        return back();
    }
}
