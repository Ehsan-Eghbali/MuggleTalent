<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreemployeeRequest extends FormRequest
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
            'employee_number' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'full_name' => 'required|string|max:255',
            'position' => 'nullable|string',
            'team' => 'nullable|string',
            'department' => 'nullable|string',
            'manager' => 'nullable|string',
            'job_level' => 'nullable|string',
            'contract_type' => 'required|in:full_time,part_time',
            'work_status' => 'required|in:on_site,remote,hybrid',
            'formality' => 'required|in:formal,informal',
            'phone_number' => 'required|string',
            'email' => 'nullable|email',
            'organization_email' => 'nullable|email',
        ];
    }

}
