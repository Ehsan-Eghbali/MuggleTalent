<?php

namespace App\Service;

use App\Models\Letter;
use App\Models\LetterAttachment;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Morilog\Jalali\Jalalian;

class LetterService
{
    public function generateNumber(): string
    {
        $seq = now()->format('His');
        return "۱۴۰۴/پ/{$seq}";
    }

    public function renderHtml(Letter $letter): string
    {
        if (!empty($letter->body_html)) {
            return $letter->body_html;
        }

        // نمونهٔ ساده بر اساس template_key
        $fields = $letter->fields ?? [];
        $personName = $fields['person_name'] ?? '[نام پرسنل]';
        $recipient  = $fields['recipient_name'] ?? '[نام سازمان دریافت‌کننده]';
        $amount     = $fields['guarantee_amount'] ?? '';

        $title = 'گواهی اشتغال به کار';
        if ($letter->template_key === 'salary_certificate') {
            $title = 'گواهی حقوق/ضمانت';
        }

        $todayFa = Jalalian::fromCarbon($letter->issued_at ?? now())->format('Y/n/j');

        $html = '
            <div style="direction: rtl; font-family: vazirmatn; font-size: 14px; text-align: right;">
                <p><strong>شماره نامه:</strong> '.e($letter->number ?: '—').'</p>
                <p><strong>تاریخ:</strong> '.e($todayFa).'</p>
                <h3 style="text-align:center;">'.e($title).'</h3>
                <p>بدینوسیله گواهی می‌شود، جناب آقای/خانم <strong>'.e($personName).'</strong> در این شرکت مشغول به کار می‌باشند.</p>
        ';

        if ($letter->template_key === 'salary_certificate') {
            $html .= '<p>ایشان متعهد به پرداخت مبلغ <strong>'.e($amount).'</strong> ریال می‌باشند.</p>';
        }

        $html .= '<p>این گواهی جهت ارائه به <strong>'.e($recipient).'</strong> صادر گردیده است.</p>';
        $html .= '</div>';

        return $html;
    }

    public function generatePdfAndAttach(Letter $letter, string $disk = 'letters'): LetterAttachment
    {
        try {
            $fields = $letter->fields ?? [];

            $dataForView = [
                'number'           => $letter->number,
                'issued_at'        => Jalalian::fromCarbon($letter->issued_at ?? now())->format('Y/n/j'),
                'title'            => $letter->template_key === 'salary_certificate' ? 'گواهی حقوق/ضمانت' : 'گواهی اشتغال به کار',
                'template_key'     => $letter->template_key,
                'person_name'      => $fields['person_name'] ?? ($fields['selected_person_name'] ?? null),
                'recipient_name'   => $fields['recipient_name'] ?? null,
                'guarantee_amount' => $fields['guarantee_amount'] ?? null,
                'body_html'        => $letter->body_html,
            ];

            // رندر با mPDF
            $pdf = \niklasravnsborg\LaravelPdf\Facades\Pdf::loadView('letters.pdf', $dataForView);

            // خروجی باینری
            $binary = $pdf->output();

            // اطمینان از وجود دایرکتوری
            $dir = date('Y/m/d').'/'.$letter->id;
            $filename = 'letter-'.$letter->id.'.pdf';
            $path = $dir.'/'.$filename;

            // ایجاد دایرکتوری اگر وجود ندارد
            Storage::disk($disk)->makeDirectory($dir);

            // ذخیره روی دیسک
            Storage::disk($disk)->put($path, $binary);

            // بررسی وجود فایل
            if (!Storage::disk($disk)->exists($path)) {
                throw new \Exception('فایل PDF ایجاد نشد');
            }

            // ثبت پیوست
            return $letter->attachments()->create([
                'original_name' => $filename,
                'disk'          => $disk,
                'path'          => $path,
                'mime'          => 'application/pdf',
                'size'          => Storage::disk($disk)->size($path),
                'uploaded_by'   => $letter->created_by,
            ]);

        } catch (\Exception $e) {
            \Log::error('PDF Generation Error: ' . $e->getMessage(), [
                'letter_id' => $letter->id,
                'error' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }
}
