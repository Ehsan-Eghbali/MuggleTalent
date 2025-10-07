<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLetterRequest extends FormRequest
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
            'personnel_id' => ['required','integer'],
            'template_key' => ['required','string','max:100'],
            'number'       => ['nullable','string','max:100'],
            'issued_at'    => ['nullable','date'],
            'fields'       => ['nullable','array'],
            'body_html'    => ['nullable','string'],
            'status'       => ['required','in:draft,final'],
        ];
    }
}
