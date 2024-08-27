<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    public bool $done = false;

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
     * @return array<string, ValidationRule|array|string>
     */
    public static function rules(): array
    {
        return [
            'name' => ['string', 'max:255', 'unique:tasks,name,' . request()->route('task')->id],
            'description' => ['nullable', 'string'],
            'done' => ['boolean'],
            'task_category_id' => ['exists:task_categories,id'],
        ];
    }
}
