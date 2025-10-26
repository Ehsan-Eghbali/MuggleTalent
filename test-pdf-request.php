<?php

/**
 * اسکریپت تست تولید PDF
 * 
 * برای تست مستقیم تولید PDF بدون نیاز به frontend
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    echo "شروع تست تولید PDF...\n\n";
    
    // ایجاد یک نامه تست
    $letter = \App\Models\Letter::create([
        'personnel_id' => 1, // فرض می‌کنیم personnel با ID 1 وجود دارد
        'template_key' => 'employment_certificate',
        'number' => '1404/پ/TEST-' . time(),
        'status' => 'final',
        'fields' => [
            'person_name' => 'محمد احمدی',
            'recipient_name' => 'سازمان تست',
            'guarantee_amount' => '10,000,000',
        ],
        'body_html' => '<p>این یک نامه تست است</p>',
        'created_by' => 1,
        'issued_at' => now(),
    ]);
    
    echo "✓ نامه با ID {$letter->id} ایجاد شد\n";
    
    // تولید PDF
    $service = new \App\Service\LetterService();
    echo "شروع تولید PDF...\n";
    
    $attachment = $service->generatePdfAndAttach($letter);
    
    echo "✓ PDF با موفقیت تولید شد!\n";
    echo "   - Path: {$attachment->path}\n";
    echo "   - Size: " . number_format($attachment->size / 1024, 2) . " KB\n";
    echo "   - Mime: {$attachment->mime}\n";
    
    // بررسی وجود فایل
    $fullPath = storage_path('app/letters/' . $attachment->path);
    if (file_exists($fullPath)) {
        echo "   - ✓ فایل روی دیسک موجود است\n";
        echo "   - Full Path: {$fullPath}\n";
    } else {
        echo "   - ✗ فایل روی دیسک موجود نیست!\n";
    }
    
    echo "\n🎉 تست با موفقیت انجام شد!\n";
    
} catch (\Exception $e) {
    echo "\n❌ خطا در تولید PDF:\n";
    echo "   Message: " . $e->getMessage() . "\n";
    echo "   File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    echo "\nStack Trace:\n";
    echo $e->getTraceAsString() . "\n";
    exit(1);
}

