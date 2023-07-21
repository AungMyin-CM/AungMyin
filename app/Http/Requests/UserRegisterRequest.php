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
            'name' => 'required',
            'code' => 'required|string|unique:user',
            'email' => 'required|email',
            'role_type' => 'required',
            'gender' => 'required|in:1,0',
            'avatar' => 'nullable|image|max:5000', // only 5MB is allowed
            'speciality' => 'nullable',
            'credentials' => 'nullable',
            'password' => 'required|confirmed|min:6',
            'phoneNumber' => 'required|min:10|max:11',
            'city' => 'nullable',
            'country' => 'nullable',
            'address' => 'required',
            'short_bio' => 'nullable',
            'fees' => 'nullable',
        ];
    }
}
