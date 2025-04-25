<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CatUpdateRequest extends FormRequest
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
            'name' => 'required|string|max:100|unique:categories,name',
            'tasks' => 'required|array|min:1|exists:tasks,id',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Name cannot be empty.',
            'name.max' => 'Name cannot be longer than 100 characters.',
            'name.unique' => 'Name already exists.',
            'tasks.required' => 'Tasks cannot be empty.',
            'tasks.exists' => 'Tasks does not exist.',
        ];
    }
}
