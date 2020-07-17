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
        \DB::beginTransaction();

        try{
            $request->validate([
                'name' => 'required',
                'subject' => 'required',
                'message' => 'required',
            ]);

            $suggestion = new Suggestions($request->all());
            if ($request->hasFile('file')){
                $hash = \Str::random(20);
                $name =  "/images/suggestions/{$hash}{$request->file('file')->getClientOriginalName()}";
                $request->file('file')->move(public_path("/images/suggestions/"), $name);
                $suggestion->file = $name;
            }
            $suggestion->save();
            \DB::commit();
            $request->session()->flash('success', 'this information has been saved successfully');
            return redirect('/Suggestions');
        } catch (\Exception $e){
            \DB::rollBack();
            $request->session()->flash('error', 'Please fill out the fields marked with (*)');
            return view('extras.suggestions');
        }
    }
}
