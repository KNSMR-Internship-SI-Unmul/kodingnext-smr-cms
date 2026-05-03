<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateModuleRequest extends FormRequest
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
            'name'                  => 'required|string|max:255',
            'description'           => 'required|string',
            'image'                 => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            'age_range'             => 'required|string|max:255',
            'duration_per_session'  => 'required|string|max:255',
            'category'              => 'nullable|string|max:255',
            'course_type_id'        => 'required|exists:course_types,id',
        ];
    }
}
