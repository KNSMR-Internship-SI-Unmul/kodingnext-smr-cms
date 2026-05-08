<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AddProjectReviewRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'student_project_id'=> 'required|exists:student_projects,id',
            'review_content'    => 'required|string',
            'rating'            => 'required|integer|min:1|max:5',
            'is_approved'       => 'nullable|boolean', 
        ];
    }
}
