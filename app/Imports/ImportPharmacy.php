<?php

namespace App\Imports;

use App\Models\Pharmacy;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ImportPharmacy implements ToModel,WithHeadingRow,WithValidation
{
    public function model(array $row)
    {
        // dd($row);

        $user_id = Auth::user()->id;
        $clinic_id = $clinic_id = session()->get('cc_id');

       //Assuming $row['expire_date'] contains the Excel date serial number
        $excelDateSerialNumber = $row['expire_date'];

        // Convert Excel date serial number to a Unix timestamp
        $unixTimestamp = ($excelDateSerialNumber - 25569) * 86400;

        // Convert Unix timestamp to a human-readable date using Carbon
        $humanReadableDate = Carbon::createFromTimestamp($unixTimestamp)->toDateString();

        // $time = strtotime($row['expire_date']);
        $time = strtotime($humanReadableDate);

        // $time = strtotime($row['expire_date']);

        $expDate = date('Y-m-d', $time);
        $reference = str_replace(' ', '_', $row['name']) . "_" . $row['code'] . "_" . str_replace(' ', '_', $row['quantity']);

        return new Pharmacy([
            'code' => $row['code'],
            'user_id' => $user_id,
            'clinic_id' => $clinic_id,
            'name' => $row['name'],
            'expire_date' => $expDate,
            'quantity' => $row['quantity'],
            'act_price' => $row['actual_price'],
            'margin' => $row['margin'],
            'sell_price' => $row['selling_price'],
            'unit' => $row['unit'],
            'description' => $row['description'],
            'vendor' => $row['vendor'],
            'vendor_phoneNumber' => $row['vendor_phone_number'],
            'storage_place' => $row['storage_place'],
            'Ref' => $reference
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'expire_date' => 'required',
            'quantity' => 'required',
            'actual_price' => 'required',
            'margin' => 'required',
            'selling_price' => 'required',
            'unit' => 'required'
        ];
    }

}
