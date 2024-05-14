<?php

namespace App\Http\Requests\Api\Projects;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name' => ['string', 'unique:projects'],
            'project_description' => ['string'],
            'title' => ['string'],
            'keywords' => ['string'],
            'description' => ['string'],
            'published' => ['boolean'],
            'review' => ['string'],
            'review_date' => ['date'],
            'course_id' => ['integer'],
            'current_stage_id' => ['integer'],
            'project_type_id' => ['integer'],
        ];
    }
}
