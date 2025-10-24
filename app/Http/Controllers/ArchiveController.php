<?php

namespace App\Http\Controllers;

use App\Models\Letter;
use App\Models\employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArchiveController extends Controller
{
    /**
     * Display a listing of archived letters.
     */
    public function index(Request $request)
    {
        $query = Letter::with(['attachments'])
            ->where('status', 'final')
            ->orderBy('created_at', 'desc');

        // جستجو بر اساس کد پرسنلی
        if ($request->filled('personnel_code')) {
            $query->whereHas('personnel', function ($q) use ($request) {
                $q->where('employee_number', 'like', '%' . $request->personnel_code . '%');
            });
        }

        // جستجو بر اساس نام پرسنل
        if ($request->filled('personnel_name')) {
            $query->whereHas('personnel', function ($q) use ($request) {
                $q->where('full_name', 'like', '%' . $request->personnel_name . '%');
            });
        }

        // فیلتر بر اساس نوع نامه
        if ($request->filled('template_key')) {
            $query->where('template_key', $request->template_key);
        }

        $letters = $query->paginate(20);

        // تبدیل داده‌ها به فرمت مناسب برای نمایش
        $letters->getCollection()->transform(function ($letter) {
            return [
                'id' => $letter->id,
                'letter_number' => $letter->number,
                'personnel_name' => $letter->personnel->full_name ?? 'نامشخص',
                'personnel_code' => $letter->personnel->employee_number ?? 'نامشخص',
                'letter_type' => $this->getLetterTypeName($letter->template_key),
                'issue_date' => $letter->issued_at ? $letter->issued_at->format('Y/m/d') : $letter->created_at->format('Y/m/d'),
                'file_path' => $this->getDownloadUrl($letter),
                'has_file' => $letter->attachments()->where('mime', 'application/pdf')->exists(),
            ];
        });

        return view('dashboard.archive', compact('letters'));
    }

    /**
     * Download a letter PDF file.
     */
    public function download(Letter $letter)
    {
        // بررسی وجود نامه و وضعیت نهایی
        if ($letter->status !== 'final') {
            abort(404, 'نامه یافت نشد یا هنوز نهایی نشده است.');
        }

        // پیدا کردن فایل PDF
        $pdfAttachment = $letter->attachments()
            ->where('mime', 'application/pdf')
            ->latest()
            ->first();

        if (!$pdfAttachment) {
            abort(404, 'فایل PDF یافت نشد.');
        }

        // بررسی وجود فایل روی دیسک
        if (!$pdfAttachment->existsOnDisk()) {
            abort(404, 'فایل PDF روی دیسک وجود ندارد.');
        }

        // دانلود فایل
        return Storage::disk($pdfAttachment->disk)
            ->download($pdfAttachment->path, $pdfAttachment->original_name);
    }

    /**
     * Show letter details.
     */
    public function show(Letter $letter)
    {
        if ($letter->status !== 'final') {
            abort(404, 'نامه یافت نشد یا هنوز نهایی نشده است.');
        }

        $letter->load(['personnel', 'attachments']);

        return view('dashboard.letter-details', compact('letter'));
    }

    /**
     * Get letter type name in Persian.
     */
    private function getLetterTypeName($templateKey)
    {
        $types = [
            'employment_certificate' => 'گواهی اشتغال به کار',
            'salary_certificate' => 'گواهی کسر از حقوق',
        ];

        return $types[$templateKey] ?? $templateKey;
    }

    /**
     * Get download URL for a letter.
     */
    private function getDownloadUrl(Letter $letter)
    {
        return route('archive.download', $letter->id);
    }

    /**
     * Get field label in Persian.
     */
    public function getFieldLabel($key)
    {
        $labels = [
            'person_name' => 'نام شخص',
            'selected_person_name' => 'نام شخص انتخاب شده',
            'recipient_name' => 'نام گیرنده',
            'guarantee_amount' => 'مبلغ ضمانت',
            'reason' => 'دلیل',
            'description' => 'توضیحات',
        ];

        return $labels[$key] ?? $key;
    }

    /**
     * Format file size.
     */
    public function formatFileSize($bytes)
    {
        if ($bytes >= 1048576) {
            return round($bytes / 1048576, 2) . ' مگابایت';
        } elseif ($bytes >= 1024) {
            return round($bytes / 1024, 2) . ' کیلوبایت';
        } else {
            return $bytes . ' بایت';
        }
    }
}
