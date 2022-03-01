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
            'email' => 'email',
            'name' => 'required',
            'password' => 'required|min:8',
            'role_id' => 'nullable',
            'phoneNumber' => 'required|min:10|max:15',
            'address' => 'required',
            'gender' => 'required',
        ];
    }
}
