<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PosRequest;

use Carbon\Carbon;

use App\Models\Clinic;
use App\Models\Pharmacy;
use App\Models\Pos;
use App\Models\PosItem;
use App\Models\Patient;
use App\Models\Visit;

use Session;

use Illuminate\Support\Facades\Crypt;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\QueryException;


use Auth;

class PosController extends Controller
{
    public function index($id=null)
    {
        $invoice_code = $this->posCodeGenerator();     
        $patient_data = null;
        $visit_data = null;
        $med_data = null;
        if($id != null)
        {
            try {
            $id = Crypt::decrypt($id);
            $patient_data = Patient::findOrfail($id);
            $visit_data = Visit::where('patient_id',$id)->orderBy('updated_at','desc')->get()->first();  
            $assigned_med = $visit_data['assigned_medicines'];
            if($assigned_med != ""){
             $medList = explode("<br>", $assigned_med);
             foreach($medList as $row){
                $medInfo = explode("^", $row);
                if(!empty($medInfo[0])){
                    $qty = explode("-",  $medInfo[1]);
                    $days = $medInfo[2];

                $med_data[] = Pharmacy::where('id',$medInfo[0])->get();

                $total_qty[] = ($qty[0] + $qty[1]+  $qty[2]) * $days ;

              
                }
             }       
            }
             }catch(DecryptException $e){
                abort(404);
            }
        }

       return view('pos/index')->with(['invoice_code' => $invoice_code, 'patient_data' => $patient_data, 'visit_data' => $visit_data , "med_data" => $med_data ,"total_qty" => '0']);
    }

    public function getMedData(Request $request)
    {
        $med_id = $request->med_id;
        $data =  Pharmacy::where('id',$med_id)->get();
        echo json_encode($data);
    }

    public function store(PosRequest $request)
    {
        $pos = new Pos();
        $user_id = Auth::guard('user')->user()['id'];
        $clinic_id = session()->get('cc_id');
        $pos_id = $pos->create([
            'invoice_code' => $request->invoice_code,
            'user_id' => $user_id,
            'clinic_id' => $clinic_id,
            'patient_id' => $request->patient_id,
            'customer_name' => $request->customer_name,
            'total_price' => $request->total_med_price,
            'total_discount' => $request->total_discount,
            'description' => $request->description,
            'payment_status'=> $request->payment_status,
        ])->id;

        $count_product = count($request->med_id);
        $assign_medicines = '';
        for($x = 0; $x < $count_product; $x++) {
            PosItem::create([
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
            $assign_medicines .= $request->med_name[$x].'-'.$request->quantity[$x].'<br>';
        }
        if($request->patient_id != null)
        {
            Patient::whereId($request->patient_id)->update(['p_status' => '4']);

            if($request->visit_id != null)
            {
                Visit::whereId($request->visit_id)->update(['pos_id' => $pos_id ]);
            }else{
                Visit::create([
                    'patient_id' => $request->patient_id,
                    'user_id' => $user_id,
                    'assigned_medicines' => $assign_medicines
                ]);
            }
        }
        return redirect('/clinic-system/pos')->with('success', "Done!");
    }
    public function edit($id)
    {
        try {
            $id = Crypt::decrypt($id);
            $pos = Pos::findOrfail($id);
            $patient_data = null;
            $visit_data = null;
            if($pos->patient_id != null)
            {
            $patient_data = Patient::findOrfail($pos->patient_id);
            $visit_data = Visit::where('pos_id',$id)->get()->first();
            }
            $pos_detail = PosItem::where("pos_id" , $id)->get();
            $payment_types = ['1' => 'Paid', '2' => 'Partial Paid', '3' => 'Foc'];

            return view('pos/edit',compact(['pos', 'pos_detail','patient_data','visit_data','payment_types']));
        }catch(DecryptException $e){
            abort(404);
        }
    }

    public function update(Request $request,$id)
    {
        Pos::whereId($id)->update(['payment_status' => $request->payment_status,'total_price' => $request->total_med_price]);

        $count_product = count($request->med_id);
        $assign_medicines = '';
        for($x = 0; $x < $count_product; $x++) {
            if(str_contains($request->pos_detail_id[$x], 'p_new') ){
                PosItem::create([
                    'pos_id' => $id,
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
            
            $assign_medicines .= $request->med_name[$x].'-'.$request->quantity[$x].'<br>';
            
        }
        Visit::where('pos_id',$id)->update(['assigned_medicines' => $assign_medicines]);

        if($request->trash_ids !=''){

            $ids = explode(',',$request->trash_ids);

            foreach($ids as $id)
            {
                $pos_detail_id = PosItem::findorfail($id);
                $med_id = $pos_detail_id->med_id;
                $quantity = $pos_detail_id->quantity;

                $remain_qty = $pos_detail_id->pharmacy->quantity;

                Pharmacy::whereId($med_id)->update(['quantity' =>$quantity+$remain_qty]);

                $pos_detail_id->delete();

            }


        }
        
        return redirect('clinic-system/pos-history')->with('success', "Done!");

    }

    public function history()
    {
        $clinic_id = session()->get('cc_id');   
        $history_List = POS::where("clinic_id",$clinic_id)->where('status',1)->get();
        return view('pos/history')->with(['history_list' => $history_List]);
    }

    public function destroy($id)
    {
        POS::whereId($id)->update(['status' => '0', 'deleted_at' => Carbon::now()]);

        return redirect('clinic-system/pos-history')->with('success', 'Done !');
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
