<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadLetterAttachmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'files.*' => ['required','file','max:10240'], // ۱۰ مگابایت
        ];
    }

    public function messages(): array
    {
        return [
            'files.*.max' => 'حجم هر فایل نباید بیش از ۱۰ مگابایت باشد.',
        ];
    }
}
