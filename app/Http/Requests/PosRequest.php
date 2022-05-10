<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PosRequest extends FormRequest
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
            'invoice_code' => 'required',
            'patient_id' => 'nullable',
            'med_id' => 'required',
            'med_name' => 'required',
            'customer_name' => 'nullable',
            'quantity' => 'required',
            'act_price' => 'required',
            'margin' => 'nullable',
            'sell_price' => 'required',
            'unit' => 'required',
            'amount' => 'required',
            'discount' => 'required',
            'total_price' => 'required',
            'total_discount' => 'nullable',
            'description' => 'nullable',
            'payment_status'=> 'required',
            'deleted_at'=> 'nullable',
        ];
    }
}
