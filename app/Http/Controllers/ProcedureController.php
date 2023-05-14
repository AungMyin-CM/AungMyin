<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Procedure;
use App\Models\Investigation;


use Auth;
use Illuminate\Validation\Rule;


class ProcedureController extends Controller
{
    public function index()
    {
        if(!$this->isAdmin()){
            abort(403);
        }

        $procedures = Procedure::where("clinic_id",session()->get('cc_id'))->get();
        $investigations = Investigation::where("clinic_id",session()->get('cc_id'))->get();

        return view('procedure-lab/index')->with('data',$procedures)->with('investigations',$investigations);
    }

    public function create()
    {
        if(!$this->isAdmin()){
            abort(403);
        }

        return view('procedure-lab/new');
    }

    public function store(Request $request)
    { 
        if(!$this->checkPermission('d_create')){
            abort(403);
        }

        $request->validate([
            'name' => ['required',Rule::unique('procedure')->where(fn ($query) => $query->where('name', request()->name)->where('clinic_id',session()->get('cc_id'))), //assuming the request has platform information
        ],
            'price' => 'required'
        ]);

            if($request->type == 'procedure')
            {
                $procedure = new Procedure();
                $count_product = count($request->name);
                $procedure_names = '';
                $procedure_prices = '';
                for($x = 0; $x < $count_product; $x++) {

                    $procedure_names .= $request->name[$x].'^';
                    $procedure_prices .= $request->price[$x].'^';
                }

                $procedure->create(
                    [
                        'code' => $request->code,
                        'name' => $procedure_names,
                        'price' => $procedure_prices,
                        'clinic_id' => session()->get('cc_id'),
                    ]
                );
            }else if($request->type == 'investigation'){

                $investigation = new Investigation();
                $count_product = count($request->name);
                $investigation_names = '';
                $investigation_prices = '';
                for($x = 0; $x < $count_product; $x++) {

                    $investigation_names .= $request->name[$x].'^';
                    $investigation_prices .= $request->price[$x].'^';
                }

                $investigation->create(
                    [
                        'code' => $request->code,
                        'name' => $investigation_names,
                        'price' => $investigation_prices,
                        'clinic_id' => session()->get('cc_id'),
                    ]
                );

            }
        
            return view('pharmacy-lab/index')->with('success', "Done!");
        }

}
