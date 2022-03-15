<?php

namespace App\Http\Controllers\Extras;

use App\Models\Extras\Help;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HelpController extends Controller
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

            $help = new Help($request->all());
            if ($request->hasFile('file')){
                $hash = \Str::random(20);
                $name =  "/images/help/{$hash}{$request->file('file')->getClientOriginalName()}";
                $request->file('file')->move(public_path("/images/help/"), $name);
                $help->file = $name;
            }
            $help->save();

            \DB::commit();

            $request->session()->flash('success', 'this information has been saved successfully');
            return redirect('/Help');
        } catch (\Exception $e){
            \DB::rollBack();
            $request->session()->flash('error', 'Please fill out the fields marked with (*)');
            return view('extras.help');
        }
    }
}
