<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Investigation;


use Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Route;

class InvestigationController extends Controller
{
    public function edit($id)
    {
        try {
            $id = Crypt::decrypt($id);
            $investigation = Investigation::findOrfail($id);
            $type = 'Investigation';
            return view('procedure-lab/edit-inves', compact('investigation','type'));
        } catch (DecryptException $e) {
            abort(404);
        }
    }
    

    public function update(Request $request,$id)
    {

        $type = Route::currentRouteName();

        if($type == 'investigation.update')
        {

            try {
                $id = Crypt::decrypt($id);
               
           
                $inves = new Investigation();
                    $count_product = count($request->name);
                    $inves_names = '';
                    $inves_prices = '';
                    for($x = 0; $x < $count_product; $x++) {

                        $inves_names .= $request->name[$x].'^';
                        $inves_prices .= $request->price[$x].'^';
                    }

                    $inves->where('id',$id)->update(
                        [
                            'code' => $request->code,
                            'name' => $inves_names,
                            'price' => $inves_prices,
                            'clinic_id' => session()->get('cc_id'),
                        ]
                    );

                    return redirect('clinic-system/procedure')->with('success', "Update Successfully");
            } catch (DecryptException $e) {
                abort(404);
            }


        }


    }

    public function destroy($id)
    {
        Investigation::destroy(Crypt::decrypt($id));

        return redirect('clinic-system/procedure')->with('success', "Update Successfully");
    }
}
