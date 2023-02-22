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
            'email' => 'email|unique:user',
            'gender' => 'required|in:1,0',
            'name' => 'required',
            'avatar' => 'nullable|image|max:5000', // only 5MB is allowed
            'code' => 'required|string|unique:user',
            'speciality' => 'nullable',
            'credentials' => 'nullable',
            'password' => 'required|min:8',
            'role_type' => 'nullable',
            'phoneNumber' => 'required|min:10|max:15',
            'city' => 'nullable',
            'country' => 'nullable',
            'address' => 'nullable',
            'short_bio' => 'nullable',
            'fees' => 'nullable',
        ];
    }
}
