<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'gender' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'avatar' => 'nullable|image|max:5000', // only 5MB is allowed
            'speciality' => 'nullable',
            'credentials' => 'nullable',
            'password' => 'nullable',
            'password_confirmation' => 'nullable',
            'role_type' => 'nullable',
            'phoneNumber' => 'nullable',
            'city' => 'nullable',
            'country' => 'nullable',
            'short_bio' => 'nullable',
            'fees' => [
                Rule::requiredIf(function () {
                    return $this->input('role_type') == 1;
                }),
            ],
        ];
    }
}
