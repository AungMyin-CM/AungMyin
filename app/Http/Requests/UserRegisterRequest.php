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
            'email' => 'email',
            'gender' => 'nullable|in:1,0',
            'name' => 'nullable',
            'avatar' => 'nullable|image|max:5000', // only 5MB is allowed
            'code' => 'nullable|string|unique:user',
            'speciality' => 'nullable',
            'credentials' => 'nullable',
            'password' => 'min:6|required',
            'role_type' => 'nullable',
            'phoneNumber' => 'nullable|min:10|max:11',
            'city' => 'nullable',
            'country' => 'nullable',
            'address' => 'nullable',
            'short_bio' => 'nullable',
            'fees' => 'nullable',
        ];
    }
}
