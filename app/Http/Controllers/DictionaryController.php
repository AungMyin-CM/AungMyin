<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DictionaryRequest;
use App\Models\Dictionary;


use Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;


class DictionaryController extends Controller
{
    public function index()
    {
        if (!$this->checkPermission('d_view')) {
            abort(403);
        }

        $dictData = Dictionary::where("user_id", Auth::guard('user')
            ->user()['id'])
            ->get();
        return view('dictionary/index')->with('data', $dictData);
    }

    public function create()
    {
        if (!$this->checkPermission('d_create')) {
            abort(403);
        }

        return view('dictionary/new');
    }

    public function store(Request $request)
    {
        if (!$this->checkPermission('d_create')) {
            abort(403);
        }

        $request->validate([
            'code' => [
                'required', Rule::unique('dictionary')->where(fn ($query) => $query->where('code', request()->code)->where('user_id', Auth::guard('user')->user()->id)), //assuming the request has platform information
            ],
        ]);

        $dict = new Dictionary();
        if ($request->is_med == 1) {
            $count_product = count($request->med_name);
            $assign_medicines = '';
            for ($x = 0; $x < $count_product; $x++) {
                $assign_medicines .= (isset($request->med_id[$x]) ? $request->med_id[$x] : 'xx') . '^' .  $request->med_name[$x] . '^' .  $request->quantity[$x] . '^' . $request->days[$x] . '<br>';
            }
            $dict->create([
                'code' => $request->code,
                'meaning' => $assign_medicines,
                'user_id' => Auth::guard('user')->user()['id'],
                'isMed'  => 1
            ]);
        } else {
            $dict->create([
                'code' => $request->code,
                'meaning' => $request->meaning,
                'user_id' => Auth::guard('user')->user()['id'],
                'isMed'  => 0
            ]);
        }
        return redirect('clinic-system/dictionary')->with('success', "New dictionary added!");
    }

    public function edit($id)
    {
        if (!$this->checkPermission('d_update')) {
            abort(403);
        }

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
    public function update(Request $request, $id)
    {

        if (!$this->checkPermission('d_update')) {
            abort(403);
        }

        if ($request->isMed == 1) {
            $count_product = count(array_filter($request->med_name, fn ($value) => !is_null($value)));
            $med_id = array_filter($request->med_id, fn ($value) => !is_null($value));
            // $med_name = array_filter($request->med_name, fn ($value) => !is_null($value));

            $assign_medicines = '';
            for ($x = 0; $x < $count_product; $x++) {
                $assign_medicines .= (isset($med_id[$x]) ? $med_id[$x] : 'xx') . '^' .  $request->med_name[$x] . '^' . $request->med_qty[$x] . '^' . $request->days[$x] . '<br>';
            }
            Dictionary::whereId($id)->update([
                'code' => $request->code,
                'meaning' => $assign_medicines,
                'user_id' => Auth::guard('user')->user()['id'],
                'isMed'  => 1
            ]);
        } else {
            $med_data = null;
            Dictionary::whereId($id)->update(['code' => $request->code, 'meaning' => $request->meaning, 'isMed' => $med_data]);
        }


        return redirect('clinic-system/dictionary')->with('success', 'Dictionary updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if (!$this->checkPermission('d_delete')) {
            abort(403);
        }

        $dict = Dictionary::findOrFail($id);
        $dict->delete();

        return redirect('clinic-system/dictionary')->with('success', 'Dictionary deleted successfully!');
    }
}
