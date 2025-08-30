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
            'employee_number'     => 'required|string|max:255',
            'first_name'          => 'required|string|max:255',
            'last_name'           => 'required|string|max:255',
            'full_name'           => 'required|string|max:255',
            'nickname'            => 'nullable|string|max:255',
            'position'            => 'nullable|string|max:255',
            'team'                => 'nullable|string|max:255',
            'department'          => 'nullable|string|max:255',
            'manager'             => 'nullable|string|max:255',
            'job_level'           => 'nullable|string|max:255',

            'contract_type'       => 'required|in:دورکاری,کارآموزی,آزمایشی,تمام وقت,پاره وقت',
            'cooperation_status'  => 'required|in:تمام وقت,پاره وقت',
            'work_status'         => 'required|in:حضوری,دورکار,هیبریدی',
            'formality'           => 'required|in:رسمی,غیررسمی',

            'phone_number'        => 'required|string|max:20',
            'email'               => 'nullable|email|max:255',
            'organization_email'  => 'nullable|email|max:255',
        ];
    }

}
