<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PharmacyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'expire_date' => 'required',
            'quantity' => 'required',
            'act_price' => 'required',
            'margin' => 'nullable',
            'sell_price' => 'required',
            'unit' => 'required',
            'description' => 'nullable',
            'vendor' => 'nullable',
            'vendor_phoneNumber'  => 'nullable',
            'storage_place'  => 'nullable',
            'status' => 'nullable'
        ];
    }
}
