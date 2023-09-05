<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'first_name' => 'required',
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
            'fees' => [
                Rule::requiredIf(function () {
                    return $this->input('role_type') == 1;
                }),
            ],
        ];
    }
}
