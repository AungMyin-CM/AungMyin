<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DictionaryRequest;
use App\Models\Dictionary;

use Auth;

class DictionaryController extends Controller
{
    public function index()
    {
        $dictData = Dictionary::all();
        return view('dictionary/index')->with('data',$dictData);
    }

    public function create()
    {
        return view('dictionary/new');
    }

    public function store(DictionaryRequest $request)
    {   
        if($request->validated()){
            $dict = new Dictionary();

            $dict->create(['code' => $request->code,
                          'meaning' => $request->meaning,
                          'user_id' => Auth::guard('user')->user()['id']
            ]);
            return redirect('dictionary')->with('success', "Done!");

        }
    }

    public function edit($id)
    {
        $dictionary = Dictionary::findOrFail($id);

        return view('dictionary/edit', compact('dictionary'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DictionaryRequest $request, $id)
    {
        Dictionary::whereId($id)->update($request->validated());

        return redirect('dictionary')->with('success', 'Done !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dict = Dictionary::findOrFail($id);
        $dict->delete();

        return redirect('dictionary')->with('success', 'Done !');
    }

}
