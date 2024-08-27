<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
    public static function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:tasks,name'],
            'description' => ['nullable', 'string'],
            'task_category_id' => ['required', 'exists:task_categories,id'],
        ];
    }
}
