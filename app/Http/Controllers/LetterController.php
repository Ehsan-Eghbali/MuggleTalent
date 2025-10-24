<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLetterRequest;
use App\Http\Requests\UploadLetterAttachmentRequest;
use App\Models\employees;
use App\Models\Letter;
use App\Models\LetterAttachment;
use App\Service\LetterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class LetterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $personnel_list = employees::select('id', 'full_name')->orderBy('full_name')->get()->toArray();



        $templates_list = [
            ['key' => 'employment_certificate', 'name' => 'گواهی اشتغال به کار'],
            ['key' => 'salary_certificate',     'name' => 'گواهی کسر از حقوق'],
        ];

        return view('dashboard.issue-letter', compact('personnel_list','templates_list'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLetterRequest $request, LetterService $service)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id ?? 0;

        return DB::transaction(function () use ($data, $service) {
            // اگر شماره خالی است، بساز
            if (empty($data['number'])) {
                $data['number'] = $service->generateNumber();
            }

            $letter = Letter::create($data);

            // اگر وضعیت نهایی است، پی‌دی‌اف بساز و پیوست کن
            if ($letter->status === 'final') {
                $service->generatePdfAndAttach($letter);
            }

            return response()->json([
                'id'      => $letter->id,
                'number'  => $letter->number,
                'status'  => $letter->status,
            ], 201);
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(Letter $letter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Letter $letter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Letter $letter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Letter $letter)
    {
        //
    }
    public function generateAndDownload(StoreLetterRequest $request, LetterService $service)
    {
        try {
            $data = $request->validated();
            $data['created_by'] = $request->user()->id ?? 0;
            $data['status'] = 'final'; // مستقیم نهایی

            $letter = DB::transaction(function () use ($data, $service) {
                if (empty($data['number'])) {
                    $data['number'] = $service->generateNumber();
                }
                $letter = Letter::create($data);
                $service->generatePdfAndAttach($letter); // پیوست پی‌دی‌اف
                return $letter;
            });

            // آخرین پیوست (پی‌دی‌اف) را دانلود بده
            /** @var LetterAttachment|null $pdf */
            $pdf = $letter->attachments()->latest('id')->first();

            if (!$pdf) {
                \Log::error('PDF attachment not found for letter: ' . $letter->id);
                return response()->json(['error' => 'فایل PDF یافت نشد'], 404);
            }

            if (!$pdf->existsOnDisk()) {
                \Log::error('PDF file does not exist on disk: ' . $pdf->path);
                return response()->json(['error' => 'فایل PDF روی دیسک وجود ندارد'], 404);
            }

            return Storage::disk($pdf->disk)->download($pdf->path, $pdf->original_name);

        } catch (\Exception $e) {
            \Log::error('PDF Generation and Download Error: ' . $e->getMessage(), [
                'request_data' => $request->validated(),
                'error' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'error' => 'خطا در تولید PDF: ' . $e->getMessage()
            ], 500);
        }
    }

    public function uploadAttachment(UploadLetterAttachmentRequest $request, Letter $letter)
    {
        $disk = 'letters';
        $saved = [];

        foreach ((array) $request->file('files') as $file) {
            $path = $file->store(date('Y/m/d').'/'.$letter->id, $disk);

            $att = $letter->attachments()->create([
                'original_name' => $file->getClientOriginalName(),
                'disk'          => $disk,
                'path'          => $path,
                'mime'          => $file->getClientMimeType(),
                'size'          => $file->getSize(),
                'uploaded_by'   => $request->user()->id ?? 0,
            ]);

            $saved[] = [
                'id' => $att->id,
                'name' => $att->original_name,
                'size' => $att->size,
                'mime' => $att->mime,
                'download_url' => route('letters.attachments.download', [$letter->id, $att->id]),
            ];
        }

        return response()->json(['attachments' => $saved], 201);
    }

    public function downloadAttachment(Letter $letter, LetterAttachment $attachment): StreamedResponse
    {
        abort_unless($attachment->letter_id === $letter->id, 404);
        abort_unless($attachment->existsOnDisk(), 404);

        return Storage::disk($attachment->disk)->download(
            $attachment->path,
            $attachment->original_name
        );
    }

    public function destroyAttachment(Request $request, Letter $letter, LetterAttachment $attachment)
    {
        abort_unless($attachment->letter_id === $letter->id, 404);

        Storage::disk($attachment->disk)->delete($attachment->path);
        $attachment->delete();

        return response()->noContent();
    }
}
