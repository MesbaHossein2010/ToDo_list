<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'required|string|unique:users,username',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ];
    }
    public function messages()
    {
        return [
            'username.required' => 'Username is required!',
            'username.unique' => 'Username is used!',
            'email.required' => 'Email is required!',
            'email.unique' => 'Email is used!',
            'password.required' => 'Password cannot be empty.',
            'password.min'      => 'Password must be at least 6 characters.',
            'password.confirmed'      => 'Password and confirmation does not match.',
        ];
    }
}
