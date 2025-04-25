<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required|string|max:100|min:3|unique:tasks,name',
            'description' => 'required|string|max:255',
            'categories' => 'required|array|min:1|exists:categories,id',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Name cannot be empty.',
            'name.max' => 'Name cannot be longer than 100 characters.',
            'name.min' => 'Name cannot be shorter than 3 characters.',
            'name.unique' => 'Name already exists.',
            'description.required' => 'Name cannot be empty.',
            'description.max' => 'Name cannot be longer than 100 characters.',
            'categories.required' => 'Categories cannot be empty.',
            'categories.exists' => 'Categories does not exist.',
        ];
    }
}
