<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PharmacyRequest;

use App\Models\Clinic;
use App\Models\Pharmacy;
use App\Models\UserClinic;

use Illuminate\Support\Facades\Crypt;

use Carbon\Carbon;

use Auth;

use Session;

class PharmacyController extends Controller
{
    public function index(Request $request)
    {

        if(!$this->checkPermission('ph_view')){
            abort(403);
        }
        
        $clinic_id = session()->get('cc_id');

        $pharmacyData = Pharmacy::where("clinic_id",$clinic_id)->where('status',1)->get();
        
        return view('pharmacy/index')->with('data',$pharmacyData);
    }

    public function create(Request $request)
    {
        if(!$this->checkPermission('ph_create')){
            abort(403);
        }

        return view('pharmacy/new');    
    }

    public function store(PharmacyRequest $request)
    {   
        if($request->validated()){
            $pharmacy = new Pharmacy();

            $clinic_id = session()->get('cc_id');
            $user_id = Auth::guard('user')->user()['id'];
            
            $reference = str_replace(' ','_',$request->name)."_".$request->code."_".str_replace(' ','_',$request->quantity);
            $pharmacy->create([
                          'code' => $request->code,
                          'user_id' => $user_id,
                          'clinic_id' => $clinic_id,
                          'name' => $request->name,
                          'expire_date' => $request->expire_date,
                          'quantity' => $request->quantity,
                          'act_price' => $request->act_price,
                          'margin' => $request->margin,
                          'sell_price' => $request->sell_price,
                          'unit' => $request->unit,
                          'description' => $request->description,
                          'vendor' => $request->vendor,
                          'vendor_phoneNumber'=> $request->vendor_phoneNumber,
                          'storage_place' => $request->storage_place,
                          'Ref' => $reference
            ]);

            return redirect('clinic-system/pharmacy')->with('success', "Done!");
        }
    }

    public function edit($id)
    {
        try {
            $id = Crypt::decrypt($id);
            $pharmacy = Pharmacy::findOrfail($id);
            return view('pharmacy/edit',compact('pharmacy'));

        }catch(DecryptException $e){
            abort(404);
        }
    }

    public function update(PharmacyRequest $request, $id)
    {
        $reference = str_replace(' ','_',$request->name)."_".$request->code."_".str_replace(' ','_',$request->quantity);

        $clinic_id = session()->get('cc_id');
        $user_id = Auth::guard('user')->user()['id'];
        
        if($request->validated())
        {

        Pharmacy::whereId($id)->update(
                            ['code' => $request->code,
                            'user_id' => $user_id,
                            'clinic_id' => $clinic_id,
                            'name' => $request->name,
                            'expire_date' => $request->expire_date,
                            'quantity' => $request->quantity,
                            'act_price' => $request->act_price,
                            'margin' => $request->margin,
                            'sell_price' => $request->sell_price,
                            'unit' => $request->unit,
                            'description' => $request->description,
                            'vendor' => $request->vendor,
                            'vendor_phoneNumber'=> $request->vendor_phoneNumber,
                            'storage_place' => $request->storage_place,
                            'Ref' => $reference 
                        ]);

        return redirect('clinic-system/pharmacy')->with('success', 'Done !');


        };

    }

    public function destroy($id)
    {        
        Pharmacy::whereId($id)->update(['status' => '0', 'deleted_at' => Carbon::now()]);

        return redirect('pharmacy')->with('success', 'Done !');
    }

    public function checkMedCode(Request $request)
    {
        if($request->get('code'))
        {
            $code = $request->get('code');
            $data = Pharmacy::where('clinic_id', $request->get('clinic_id'))->where('code',$code)
            ->count();
            if($data > 0)
            {
                echo 'not_unique';
            }
            else
            {
                echo 'unique';
            }
        }
    }

}
