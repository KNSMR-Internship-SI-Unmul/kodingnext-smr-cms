<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentProjectRequest extends FormRequest
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
            'title'       => 'required|string|max:255',
            'student_id'  => 'required|exists:students,id',
            'module_id'   => 'required|exists:modules,id',
            'date'        => 'nullable|date',
            'description' => 'required|string',
            'project_url' => 'nullable|url|max:255',
            'media'       => 'nullable|file|mimes:mimes:jpeg,png,jpg,gif,pdf,mp4,webm|max:5120', 
            'is_published'=> 'nullable|boolean', 
        ];
    }
}
