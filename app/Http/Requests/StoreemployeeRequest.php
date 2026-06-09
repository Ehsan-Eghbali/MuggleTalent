<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

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
            'first_name'       => 'required|string|max:255',
            'last_name'        => 'required|string|max:255',
            'email'            => 'required|email|max:255',
            'phone_number'     => 'required|string|max:20',
            'national_code'    => 'required|string|max:20',
            'department'       => 'required|string|max:255',
            'position_chart'   => 'required|string|max:255',
            'employee_number'  => 'required|string|max:255|unique:employees,employee_number',
            'entry_date'       => 'required|date',
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'first_name.required'      => 'نام الزامی است.',
            'last_name.required'       => 'نام خانوادگی الزامی است.',
            'email.required'           => 'ایمیل الزامی است.',
            'email.email'              => 'فرمت ایمیل معتبر نیست.',
            'phone_number.required'    => 'شماره همراه الزامی است.',
            'national_code.required'   => 'کد ملی الزامی است.',
            'department.required'      => 'واحد الزامی است.',
            'position_chart.required'  => 'سمت شغلی الزامی است.',
            'employee_number.required' => 'شماره پرسنلی الزامی است.',
            'employee_number.unique'   => 'این شماره پرسنلی قبلاً ثبت شده است.',
            'entry_date.required'      => 'تاریخ شروع همکاری الزامی است.',
            'entry_date.date'          => 'تاریخ شروع همکاری معتبر نیست.',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(
            redirect()
                ->route('employees.index')
                ->withInput()
                ->withErrors($validator)
        );
    }
}
