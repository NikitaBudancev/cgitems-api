<?php

namespace App\Http\Requests\Api\Projects\Stages;

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
            'projectId' => ['required', 'integer'],
            'stageId' => ['required', 'int', 'exists:stages,id'],
            'preview' => ['required', 'file', 'mimes:jpg,jpeg,png', 'max:20000'],
            'media' => ['required', 'array'],
            'media.*' => ['required', 'file', 'mimes:jpg,jpeg,png', 'max:20000'],
        ];
    }
}
