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
use App\Models\Notification;
use App\Models\PatientProcedure;



use Session;

use Illuminate\Support\Facades\Crypt;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\QueryException;


use Auth;

class PosController extends Controller
{
    public function index($id = null)
    {
        if (!$this->checkPermission('pos_create')) {
            abort(404);
        }

        $invoice_code = $this->posCodeGenerator();
        $patient_data = null;
        $visit_data = null;
        $visit = null;
        $med_data = null;
        $total_qty = null;
        if ($id != null) {
            try {
                $id = Crypt::decrypt($id);
                $patient_data = Patient::findOrfail($id);
                $visit_data = Visit::where('patient_id', $id)->orderBy('updated_at', 'desc')->get()->first();
                $visit = Visit::where(['patient_id' => $id, 'status' => 1])->with('disease')->with('diagnosis')->orderBy('updated_at', 'DESC')->paginate(1);


                if ($visit_data) {

                    $assigned_med = $visit_data['assigned_medicines'];

                    Notification::where('patient_id', $id)->update(['is_read' => 1]);

                    if ($assigned_med != "") {
                        $medList = explode("<br>", $assigned_med);

                        foreach ($medList as $row) {

                            $medInfo = explode("^", $row);
                            if (!empty($medInfo[0])) {
                                $qty = explode("-",  $medInfo[1]);
                                $days = $medInfo[2];
                                $med = Pharmacy::where('id', $medInfo[0])->get();
                                if ($med->count() > 0) {
                                    $med_data[] = $med;
                                } else {
                                    $arr = new Pharmacy();
                                    $arr['name'] = $medInfo[0];
                                    $med_data[][] =   $arr;
                                }
                                $total_qty[] = array(($qty[0] + $qty[1] +  $qty[2]) * $days);
                            }
                        }
                    }
                }
            } catch (DecryptException $e) {
                abort(404);
            }
        }    
            return view('pos/index')->with(['invoice_code' => $invoice_code, 'visit' => $visit,'patient' => $patient_data, 'visit_data' => $visit_data, "med_data" => $med_data, "total_qty" => $total_qty, 'procedures' => '']);



    }

    public function patientPos($id = null,Request $request)
    {
        if (!$this->checkPermission('pos_create')) {
            abort(404);
        }

        $invoice_code = $this->posCodeGenerator();
        $patient_data = null;
        $visit_data = null;
        $visit = null;
        $med_data = null;
        $total_qty = null;
        if ($id != null) {
            try {
                $id = Crypt::decrypt($id);
                $patient_data = Patient::findOrfail($id);
                $visit_data = Visit::where('patient_id', $id)->orderBy('updated_at', 'desc')->get()->first();
                $visit = Visit::where(['patient_id' => $id, 'status' => 1])->with('disease')->with('diagnosis')->orderBy('updated_at', 'DESC')->paginate(1);


                if ($visit_data) {


                    $assigned_med = $visit_data['assigned_medicines'];

                    Notification::where('patient_id', $id)->update(['is_read' => 1]);
                    
                    $procedure = PatientProcedure::where('visit_id',$visit_data['id'])->get()->first();
                    
                    if ($assigned_med != "") {
                        $medList = explode("<br>", $assigned_med);

                        foreach ($medList as $key =>$row) {
                            $medInfo = explode("^", $row);
                            if (!empty($medInfo[0])) {
                                $qty = explode("-",  $medInfo[1]);
                                $days = $medInfo[2];
                                $med = Pharmacy::where('id', $medInfo[0])->get();
                                if ($med->count() > 0) {
                                    $med_data[] = $med;
                                } else {
                                    $arr = new Pharmacy();
                                    $arr['name'] = $medInfo[0];
                                    $med_data[][] =   $arr;
                                }
                                $total_qty[] = array(($qty[0] + $qty[1] +  $qty[2]) * $days);
                            }
                        }
                    }

                    $procedures = '';

                    if($procedure != '')
                    {
                        $procedures = $procedure['assigned_tasks'];
                        
                    }else{
                        echo "Hello";
                    }
                }
            } catch (DecryptException $e) {
                abort(404);
            }
        }

        if ($request->ajax()) {
            return view('partials/_visit-modal')
                ->with('patient', $patient_data)
                ->with('visit', $visit);
                
        }else{
            return view('pos/index')->with(['invoice_code' => $invoice_code, 'visit' => $visit,'patient' => $patient_data, 'visit_data' => $visit_data, "med_data" => $med_data, "total_qty" => $total_qty,'procedures' => $procedures]);

        }

    }

    public function getMedData(Request $request)
    {
        if (!$this->checkPermission('pos_create')) {
            abort(404);
        }

        $med_id = $request->med_id;
        $data =  Pharmacy::where('id', $med_id)->get();
        echo json_encode($data);
    }

    public function store(PosRequest $request)
    {
        if (!$this->checkPermission('pos_create')) {
            abort(404);
        }


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
            'payment_status' => $request->payment_status,
        ])->id;

        $count_product = count($request->med_id);
        $assign_medicines = '';
        for ($x = 0; $x < $count_product; $x++) {
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
            $remain_qty = Pharmacy::where('id', $request->med_id[$x])->pluck('quantity')->first();
            $new_quantity = $remain_qty - $request->quantity[$x];
            Pharmacy::whereId($request->med_id[$x])->update(['quantity' => $new_quantity]);
            $assign_medicines .= $request->med_name[$x] . '-' . $request->quantity[$x] . '<br>';
        }

        if ($request->patient_id != null) {
            Patient::whereId($request->patient_id)->update(['p_status' => '4']);

            if ($request->visit_id != null) {
                Visit::whereId($request->visit_id)->update(['pos_id' => $pos_id]);

                $id = $request->visit_id;
            } else {
                $id = Visit::create([
                    'patient_id' => $request->patient_id,
                    'user_id' => $user_id,
                    'assigned_medicines' => $assign_medicines
                ])->id;
            }


            $pos_detail = PosItem::where("pos_id", $pos_id)->get();
            $pos = Pos::findOrfail($pos_id);
            $patient_data = Patient::findOrfail($pos->patient_id);
            $visit_data = Visit::where('pos_id', $pos_id)->get()->first();
            $payment_types = ['1' => 'Paid', '2' => 'Partial Paid', '3' => 'Foc'];

            if ($request->submit_type == 'print-type') {

                $pos = Pos::findOrfail($pos_id);
                $patient_data = null;
                $visit_data = null;
                if ($pos->patient_id != null) {
                    $patient_data = Patient::findOrfail($pos->patient_id);
                    $visit_data = Visit::where('pos_id', $pos_id)->get()->first();
                }
                $pos_detail = PosItem::where("pos_id", $pos_id)->get();
                $payment_types = ['1' => 'Paid', '2' => 'Partial Paid', '3' => 'Foc'];

                return view('pos/print-invoice', compact(['pos', 'pos_detail', 'patient_data', 'visit_data', 'payment_types']));
            } else {

                return redirect(route('pos.index'));
            }
        } else {

            if ($request->submit_type == 'print-type') {
                $pos = Pos::findOrfail($pos_id);
                $patient_data = null;
                $visit_data = null;
                if ($pos->patient_id != null) {
                    $patient_data = Patient::findOrfail($pos->patient_id);
                    $visit_data = Visit::where('pos_id', $pos_id)->get()->first();
                }
                $pos_detail = PosItem::where("pos_id", $pos_id)->get();
                $payment_types = ['1' => 'Paid', '2' => 'Partial Paid', '3' => 'Foc'];

                return view('pos/print-invoice', compact(['pos', 'pos_detail', 'patient_data', 'visit_data', 'payment_types']));
            } else {
                return redirect('/clinic-system/pos')->with('success', "Done!");
            }
        }
    }
    public function edit($id)
    {
        if (!$this->checkPermission('pos_update')) {
            abort(404);
        }

        try {
            $id = Crypt::decrypt($id);
            $pos = Pos::findOrfail($id);
            $patient_data = null;
            $visit_data = null;
            if ($pos->patient_id != null) {
                $patient_data = Patient::findOrfail($pos->patient_id);
                $visit_data = Visit::where('pos_id', $id)->get()->first();
            }
            $pos_detail = PosItem::where("pos_id", $id)->get();
            $payment_types = ['1' => 'Paid', '2' => 'Partial Paid', '3' => 'Foc'];

            return view('pos/edit', compact(['pos', 'pos_detail', 'patient_data', 'visit_data', 'payment_types']));
        } catch (DecryptException $e) {
            abort(404);
        }
    }

    public function update(Request $request, $id)
    {
        if (!$this->checkPermission('pos_update')) {
            abort(404);
        }

        Pos::whereId($id)->update(['payment_status' => $request->payment_status, 'total_price' => $request->total_med_price]);

        $count_product = count($request->med_id);
        $assign_medicines = '';
        for ($x = 0; $x < $count_product; $x++) {
            if (str_contains($request->pos_detail_id[$x], 'p_new')) {
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

                $remain_qty = Pharmacy::where('id', $request->med_id[$x])->pluck('quantity')->first();
                $new_quantity = $remain_qty - $request->quantity[$x];
                Pharmacy::whereId($request->med_id[$x])->update(['quantity' => $new_quantity]);
            }

            $assign_medicines .= $request->med_name[$x] . '-' . $request->quantity[$x] . '<br>';
        }
        Visit::where('pos_id', $id)->update(['assigned_medicines' => $assign_medicines]);

        if ($request->trash_ids != '') {

            $ids = explode(',', $request->trash_ids);

            foreach ($ids as $id) {
                $pos_detail_id = PosItem::findorfail($id);
                $med_id = $pos_detail_id->med_id;
                $quantity = $pos_detail_id->quantity;

                $remain_qty = $pos_detail_id->pharmacy->quantity;

                Pharmacy::whereId($med_id)->update(['quantity' => $quantity + $remain_qty]);

                $pos_detail_id->delete();
            }
        }

        return redirect('clinic-system/pos-history')->with('success', "Updated successfully!");
    }

    public function history()
    {
        if (!$this->checkPermission('pos_view')) {
            abort(404);
        }

        $clinic_id = session()->get('cc_id');
        $history_List = POS::where("clinic_id", $clinic_id)
            ->where('status', 1)
            ->orderBy('updated_at', 'desc')
            ->get();
        return view('pos/history')->with(['history_list' => $history_List]);
    }

    public function destroy($id)
    {
        POS::whereId($id)->update(['status' => '0', 'deleted_at' => Carbon::now()]);

        return redirect('clinic-system/pos-history')->with('success', 'Deleted successfully!');
    }

    public function printInvoice($id)
    {

        try {
            $id = Crypt::decrypt($id);
            $pos = Pos::findOrfail($id);
            $patient_data = null;
            $visit_data = null;
            if ($pos->patient_id != null) {
                $patient_data = Patient::findOrfail($pos->patient_id);
                $visit_data = Visit::where('pos_id', $id)->get()->first();
            }
            $pos_detail = PosItem::where("pos_id", $id)->get();
            $payment_types = ['1' => 'Paid', '2' => 'Partial Paid', '3' => 'Foc'];

            return view('pos/print-invoice', compact(['pos', 'pos_detail', 'patient_data', 'visit_data', 'payment_types']));
        } catch (DecryptException $e) {
            abort(404);
        }
    }

    
    private function posCodeGenerator()
    {
        if (!$this->checkPermission('pos_create')) {
            abort(404);
        }

        $timestamp = Carbon::now();
        $current_date = $timestamp->format('u');
        $clinic_id = Auth::guard('user')->user()['clinic_id'];

        $c_name = Clinic::select('name')->where('id', $clinic_id)->first();

        $patient_code = "invo:" . $clinic_id . $current_date;

        return $patient_code;
    }
}
