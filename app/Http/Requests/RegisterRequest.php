<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'code' => 'required',
            'email' => 'required|email',
            'name' => 'required',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
            'phoneNumber' => 'required|min:10|max:15',
            'address' => 'required',
            'package_id' => 'required'
        ];
    }
}