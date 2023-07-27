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

        if (!$this->checkPermission('ph_view')) {
            abort(403);
        }

        $clinic_id = session()->get('cc_id');

        $pharmacyData = Pharmacy::where("clinic_id", $clinic_id)
            ->where('status', 1)
            ->get();

        return view('pharmacy/index')->with('data', $pharmacyData);
    }

    public function create(Request $request)
    {
        if (!$this->checkPermission('ph_create')) {
            abort(403);
        }

        return view('pharmacy/new');
    }

    public function store(PharmacyRequest $request)
    {
        if ($request->validated()) {
            $pharmacy = new Pharmacy();

            $clinic_id = session()->get('cc_id');
            $user_id = Auth::guard('user')->user()['id'];

            $reference = str_replace(' ', '_', $request->name) . "_" . $request->code . "_" . str_replace(' ', '_', $request->quantity);
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
                'vendor_phoneNumber' => $request->vendor_phoneNumber,
                'storage_place' => $request->storage_place,
                'Ref' => $reference
            ]);

            return redirect('clinic-system/pharmacy')->with('success', "New medicine added!");
        }
    }

    public function edit($id)
    {
        try {
            $id = Crypt::decrypt($id);
            $pharmacy = Pharmacy::findOrfail($id);
            return view('pharmacy/edit', compact('pharmacy'));
        } catch (DecryptException $e) {
            abort(404);
        }
    }

    public function update(PharmacyRequest $request, $id)
    {
        $reference = str_replace(' ', '_', $request->name) . "_" . $request->code . "_" . str_replace(' ', '_', $request->quantity);

        $clinic_id = session()->get('cc_id');
        $user_id = Auth::guard('user')->user()['id'];

        if ($request->validated()) {

            Pharmacy::whereId($id)->update(
                [
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
                    'vendor_phoneNumber' => $request->vendor_phoneNumber,
                    'storage_place' => $request->storage_place,
                    'Ref' => $reference
                ]
            );

            return redirect('clinic-system/pharmacy')->with('success', 'Medicine updated successfully!');
        };
    }

    public function destroy($id)
    {
        Pharmacy::whereId($id)->update(['status' => '0', 'deleted_at' => Carbon::now()]);

        return redirect('clinic-system/pharmacy')->with('success', 'Medicine deleted successfully!');
    }

    public function checkMedCode(Request $request)
    {
        if ($request->get('code')) {
            $code = $request->get('code');
            $data = Pharmacy::where('clinic_id', $request->get('clinic_id'))->where('code', $code)
                ->count();
            if ($data > 0) {
                echo 'not_unique';
            } else {
                echo 'unique';
            }
        }
    }

    public  function pharmacyImport(Request $request)
    {
        $importData = [];
        if ($request->hasfile('importFile')) {

            $file = $request->file('importFile');
            if (($open = fopen($file, "r")) !== FALSE) {

                while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
                    $importData[] = $data;
                }

                fclose($open);
            }

            $clinic_id = session()->get('cc_id');
            $user_id = Auth::guard('user')->user()['id'];
            if (count($importData) <= 1) {
                return redirect('clinic-system/pharmacy')->with('error', 'Empty CSV');
            }
            for ($i = 1; $i < count($importData); $i++) {
                if (array_count_values($importData[$i]) < 12) {
                    return redirect('clinic-system/pharmacy')->with('error', 'Invalid CSV');
                }
                $reference = str_replace(' ', '_', $importData[$i][1]) . "_" . $importData[$i][0] . "_" . str_replace(' ', '_', $importData[$i][3]);
                $time = strtotime($importData[$i][2]);
                $expDate = date('Y-m-d', $time);
                $pharmacy = new Pharmacy();
                $pharmacy->create([
                    'code' => $importData[$i][0],
                    'user_id' => $user_id,
                    'clinic_id' => $clinic_id,
                    'name' => $importData[$i][1],
                    'expire_date' => $expDate,
                    'quantity' => $importData[$i][3],
                    'act_price' => $importData[$i][4],
                    'margin' => $importData[$i][5],
                    'sell_price' => $importData[$i][6],
                    'unit' => $importData[$i][7],
                    'description' => $importData[$i][8],
                    'vendor' => $importData[$i][9],
                    'vendor_phoneNumber' => $importData[$i][10],
                    'storage_place' => $importData[$i][11],
                    'Ref' => $reference
                ]);
            }
            return redirect('clinic-system/pharmacy')->with('success', 'File imported successfully!');
        }
    }
}
