<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PosRequest;

use Carbon\Carbon;

use App\Models\Clinic;
use App\Models\Pharmacy;
use App\Models\Pos;
use App\Models\PosItem;

use Auth;

class PosController extends Controller
{
    public function index()
    {
        $invoice_code = $this->posCodeGenerator();        

        return view('pos/index')->with('invoice_code',$invoice_code);
    }

    public function getMedData(Request $request)
    {
        $med_id = $request->med_id;
        
        $data =  Pharmacy::where('id',$med_id)->get();

        echo json_encode($data);

    }

    public function store(PosRequest $request)
    {
        if($request->validated())
        {
            $pos = new Pos();

            $user_id = Auth::guard('user')->user()['id'];


            $pos_id = $pos->create([
                'invoice_code' => $request->invoice_code,
                'user_id' => $user_id,
                // 'patient_id' => 'nullable',
                'customer_name' => $request->customer_name,
                'total_price' => $request->total_price,
                'total_discount' => $request->total_discount,
                'description' => $request->description,
                'payment_status'=> $request->payment_status,
            ])->id;
        }

     $count_product = count($request->med_id);
        for($x = 0; $x < $count_product; $x++) {
            $pos_item = new PosItem();
          
            $order_items = $pos_item->create([
                'pos_id' => $pos_id,
                'med_id' => $request->med_id[$x],
                'med_name' => $request->med_name[$x],
                'quantity' => $request->quantity[$x],
                'expire_date' => $request->expire_date[$x],
                'act_price' => $request->act_price[$x],
                'margin' => $request->margin[$x],
                'sell_price' => $request->sell_price[$x],
                'unit' => $request->unit[$x],
                'total_price' => $request->amount[$x],
                'discount' => $request->discount[$x],
            ]);

            $remain_qty = Pharmacy::where('id' , $request->med_id[$x])->pluck('quantity')->first();
        
            $new_quantity = $remain_qty - $request->quantity[$x];

            Pharmacy::whereId($request->med_id[$x])->update(['quantity' => $new_quantity]);

        }

        Visit::create([
            'patient_id' => $patient_id,
            'prescription' => $request->prescription,
            'diag' => $request->diag,
            'images' => json_encode($images),
            'fees' => $request->fees,
            'doctor_id' => $user_id,
            'investigation' => $request->investigation,
            'procedure' => $request->procedure,
            'is_followup' => $request->is_followup,
            'followup_date' => $request->followup_date
        ]);
       
        return redirect('pos')->with('success', "Done!");

    }

    private function posCodeGenerator()
    {
        $timestamp = Carbon::now();
        $current_date = $timestamp->format('u');
        $clinic_id = Auth::guard('user')->user()['clinic_id'];

        $c_name = Clinic::select('name')->where('id',$clinic_id)->first();

        $patient_code = "invo:".$clinic_id.$current_date;

        return $patient_code;

    }

}
