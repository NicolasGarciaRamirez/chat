<?php

namespace App\Http\Controllers\Extras;

use App\Models\Extras\Suggestions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SuggestionsController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function save(Request $request)
    {
        $suggestion = new Suggestions($request->all());
        $suggestion->save();

        return redirect('/Suggestions');
    }
}
