<?php

namespace App\Http\Requests\Api\Media;

use Illuminate\Contracts\Validation\ValidationRule;
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'file' => ['required', 'file', 'image', 'mimes:jpeg,png', 'max:20000'],
            'modelId' => ['required', 'integer', 'exists:project_stages,id'],
            'type' => ['required', 'string', 'in:preview,image'],
        ];
    }
}
