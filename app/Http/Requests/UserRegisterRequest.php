<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
            'code' => 'required|unique:user',
            'email' => 'email|unique:user',
            'name' => 'required',
            'speciality' => 'nullable',
            'credentials' => 'nullable',
            'password' => 'required|min:8|confirmed',
            'role_id' => 'nullable',
            'phoneNumber' => 'required|min:10|max:15',
            'city' => 'nullable',
            'country' => 'nullable',
            'address' => 'nullable',
            'short_bio' => 'nullable',
            'fees' => 'nullable',
            'gender' => 'required',
        ];
    }
}
