<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateemployeeRequest extends FormRequest
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
            'position_chart' => 'nullable|string|max:255',
            'team' => 'nullable|string',
            'department' => 'nullable|string',
            'manager' => 'nullable|string',
            'job_level' => 'nullable|string',
            'contract_type' => 'required|in:دورکاری,کارآموزی,آزمایشی,تمام وقت,پاره وقت',
            'work_status' => 'required|in:حضوری,دورکار,هیبریدی',
            'formality' => 'required|in:رسمی,غیررسمی',
            'cooperation_status' => 'required|in:تمام وقت,پاره وقت',
            'phone_number' => 'required|string',
            'email' => 'nullable|email',
            'organization_email' => 'nullable|email',
        ];
    }
}
