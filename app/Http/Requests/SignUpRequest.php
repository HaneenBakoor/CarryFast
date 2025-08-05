<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    //regex:/^[\p{Arabic}a-zA-Z]+[\p{Arabic}a-zA-Z0-9\s]*$/u
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,user,delivery,provider',
            'phone_number' => 'required|unique:users,phone_number,except,id|regex:/^09\d{8}$/|min:10',
            'bike_type' => 'nullable|string',
            'fuel_consumption' => 'nullable|numeric',
            'address_details' => 'nullable|string|max:255',
            'plus_code' => 'required|numeric',
            'area' => 'required|string',
            'city' => 'required|string',
            'country' => 'string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ];
    }
}
