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
            // جدول employees (اصلی)
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'full_name' => 'nullable|string|max:255',
            'nickname' => 'nullable|string|max:255',
            'position_chart' => 'nullable|string|max:255',
            'team' => 'nullable|string|max:255',
            'department' => 'nullable|string|max:255',
            'direct_manager' => 'nullable|string|max:255',
            'job_level' => 'nullable|string|max:255',
            'contract_type' => 'nullable|string|max:255',
            'work_status' => 'nullable|string|max:255',
            'formality' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'organization_email' => 'nullable|email|max:255',
            'gender' => 'nullable|string|max:255',
            'employee_number' => 'nullable|string|max:255',
            
            // جدول personal
            'father_name' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'national_code' => 'nullable|string|max:255',
            'birth_cert_number' => 'nullable|string|max:255',
            'id_serial' => 'nullable|string|max:255',
            'birth_date' => 'nullable|string|max:255',
            'birth_place' => 'nullable|string|max:255',
            'id_issue_place' => 'nullable|string|max:255',
            
            // جدول military
            'military_status' => 'nullable|string|max:255',
            
            // جدول education
            'degree' => 'nullable|string|max:255',
            'field_of_study' => 'nullable|string|max:255',
            
            // جدول address
            'phone' => 'nullable|string|max:255',
            'emergency_contact' => 'nullable|string|max:255',
            'emergency_contact_info' => 'nullable|string|max:255',
            'home_phone' => 'nullable|string|max:255',
            'personal_email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'postal_code' => 'nullable|string|max:255',
            
            // جدول social
            'telegram_id' => 'nullable|string|max:255',
            
            // جدول contract
            'contract_number' => 'nullable|string|max:255',
            'employment_status_select' => 'nullable|string|max:255',
            'hire_date' => 'nullable|string|max:255',
            'trial_start_date' => 'nullable|string|max:255',
            'termination_date' => 'nullable|string|max:255',
            'termination_reason' => 'nullable|string',
            
            // جدول insurance
            'insurance_title' => 'nullable|string|max:255',
            'insurance_job_code' => 'nullable|string|max:255',
            
            // فیلدهای اضافی برای تب شغلی
            'emp_department' => 'nullable|string|max:255',
            'emp_team' => 'nullable|string|max:255',
            'personnel_code' => 'nullable|string|max:255',
            'job_title' => 'nullable|string|max:255',
            'skill_level' => 'nullable|string|max:255',
            'cooperation_type' => 'nullable|string|max:255',
            'work_model' => 'nullable|string|max:255',
            'nda_type' => 'nullable|string|max:255',
        ];
    }
}
