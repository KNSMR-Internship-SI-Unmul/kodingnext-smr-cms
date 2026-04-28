<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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
            'name'              => 'required|string|max:255',
            'email'             => 'required|email|unique:users,email,' . $this->route('employee'),
            'phone_number'      => 'nullable|string|min:11|max:13',
            'hired_date'        => 'nullable|date|before_or_equal:today',
            'role_id'           => 'required|exists:roles,id',
            'profile_picture'   => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
}
