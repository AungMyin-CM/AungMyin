<?php

namespace App\Imports;

use App\Models\Dictionary;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportDictionary implements ToModel, WithHeadingRow
{
    protected $rowCount = 1;

    public function model(array $row)
    {

        // dd($row);

        $this->rowCount++;

        $rowNumber = $this->rowCount;

        $input = strtolower($row['is_medicine']);

        if ($input === 'yes' || $input === 'true') {
            $row['is_medicine'] = 1;
        } elseif ($input === 'no' || $input === 'false' || $input == null || $input == '') {
            $row['is_medicine'] = 0;
        }

        if ($row['is_common'] == null || $row['is_common'] == '') {
            $row['is_common'] = 0;
        }

        $user_id = Auth::user()->id;

        $validator = Validator::make($row, [
            'code' => [
                'required',
                Rule::unique('dictionary')->where(function ($query) use ($row, $user_id) {
                    return $query->where('code', $row['code'])
                        ->where('user_id', $user_id);
                }),
            ],
            'meaning' => 'required',
        ],[
            'code.required' => "There was an error on row $rowNumber: The code field is required.",
            'code.unique' => "There was an error on row $rowNumber: The code has been already taken.",
            'meaning.required' => "There was an error on row $rowNumber: The meaning field is required.",
        ]);


        if ($validator->fails()) {
            throw ValidationException::withMessages($validator->errors()->messages());
        }


        return new Dictionary([
            'code' => $row['code'],
            'meaning' => $row['meaning'],
            'user_id' => $user_id,
            'price' => $row['price'],
            'isCommon' => $row['is_common'],
            'isMed' => $row['is_medicine'],
            'isProcedure' => $row['is_procedure'],
        ]);
    }
}

