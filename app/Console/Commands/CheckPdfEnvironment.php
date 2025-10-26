<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CheckPdfEnvironment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pdf:check-environment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'بررسی محیط برای تولید PDF و شناسایی مشکلات';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('========================================');
        $this->info('بررسی محیط برای تولید PDF');
        $this->info('========================================');
        $this->newLine();

        $hasErrors = false;

        // 1. بررسی Extensions
        $this->checkExtensions($hasErrors);
        $this->newLine();

        // 2. بررسی تنظیمات PHP
        $this->checkPhpSettings();
        $this->newLine();

        // 3. بررسی پوشه‌ها
        $this->checkDirectories($hasErrors);
        $this->newLine();

        // 4. بررسی فونت‌ها
        $this->checkFonts($hasErrors);
        $this->newLine();

        // 5. تست تولید PDF
        $this->testPdfGeneration($hasErrors);
        $this->newLine();

        // نتیجه نهایی
        if ($hasErrors) {
            $this->error('⚠ مشکلاتی یافت شد. لطفا موارد بالا را بررسی کنید.');
            return Command::FAILURE;
        } else {
            $this->info('✓ همه‌چیز آماده است! محیط برای تولید PDF مناسب است.');
            return Command::SUCCESS;
        }
    }

    private function checkExtensions(&$hasErrors)
    {
        $this->info('بررسی Extensions PHP:');

        $required = [
            'mbstring' => 'برای کار با رشته‌های UTF-8',
            'gd' => 'برای پردازش تصاویر',
            'zip' => 'برای فایل‌های فشرده',
            'dom' => 'برای پردازش HTML',
            'xml' => 'برای پردازش XML',
        ];

        foreach ($required as $ext => $desc) {
            if (extension_loaded($ext)) {
                $this->info("   ✓ {$ext}: نصب شده - {$desc}");
            } else {
                $this->error("   ✗ {$ext}: نصب نشده! - {$desc}");
                $hasErrors = true;
            }
        }
    }

    private function checkPhpSettings()
    {
        $this->info('تنظیمات PHP:');

        $memoryLimit = ini_get('memory_limit');
        $this->info("   Memory Limit: {$memoryLimit}");

        $memoryBytes = $this->convertToBytes($memoryLimit);
        if ($memoryBytes < 256 * 1024 * 1024 && $memoryBytes != -1) {
            $this->warn("   ⚠ توصیه می‌شود memory_limit حداقل 256M باشد");
        }

        $maxExecution = ini_get('max_execution_time');
        $this->info("   Max Execution Time: {$maxExecution} ثانیه");

        if ($maxExecution < 60 && $maxExecution != 0) {
            $this->warn("   ⚠ توصیه می‌شود max_execution_time حداقل 60 ثانیه باشد");
        }
    }

    private function checkDirectories(&$hasErrors)
    {
        $this->info('بررسی پوشه‌ها:');

        $directories = [
            storage_path('app/letters') => 'محل ذخیره PDFها',
            storage_path('app/pdf-temp') => 'محل فایل‌های موقت PDF',
            public_path('assets/fonts') => 'محل فونت‌های فارسی',
        ];

        foreach ($directories as $dir => $desc) {
            $this->line("   {$desc}:");
            $this->line("   → {$dir}");

            if (!file_exists($dir)) {
                $this->error("      ✗ پوشه وجود ندارد");
                
                if (@mkdir($dir, 0775, true)) {
                    $this->info("      ✓ پوشه با موفقیت ایجاد شد");
                } else {
                    $this->error("      ✗ خطا در ایجاد پوشه");
                    $hasErrors = true;
                }
            } else {
                $this->info("      ✓ پوشه موجود است");

                if (is_writable($dir)) {
                    $this->info("      ✓ قابل نوشتن است");
                } else {
                    $this->error("      ✗ قابل نوشتن نیست!");
                    $this->warn("      → chmod -R 775 {$dir}");
                    $hasErrors = true;
                }
            }
        }
    }

    private function checkFonts(&$hasErrors)
    {
        $this->info('بررسی فونت‌های فارسی:');

        $fonts = [
            public_path('assets/fonts/Vazirmatn-Regular.ttf'),
            public_path('assets/fonts/Vazirmatn-Bold.ttf'),
        ];

        foreach ($fonts as $font) {
            if (file_exists($font)) {
                $size = filesize($font);
                $sizeKb = number_format($size / 1024, 2);
                $this->info("   ✓ " . basename($font) . " (حجم: {$sizeKb} KB)");
            } else {
                $this->error("   ✗ " . basename($font) . " موجود نیست!");
                $this->warn("      → دانلود از: https://github.com/rastikerdar/vazirmatn/releases");
                $hasErrors = true;
            }
        }
    }

    private function testPdfGeneration(&$hasErrors)
    {
        $this->info('تست تولید PDF:');

        try {
            // تست نوشتن در پوشه letters
            $disk = 'letters';
            $testPath = 'test-' . time() . '.txt';

            Storage::disk($disk)->put($testPath, 'test content');

            if (Storage::disk($disk)->exists($testPath)) {
                $this->info("   ✓ قادر به نوشتن در دیسک 'letters' هستیم");
                Storage::disk($disk)->delete($testPath);
            } else {
                $this->error("   ✗ نتوانستیم در دیسک 'letters' بنویسیم");
                $hasErrors = true;
            }

            // تست کلاس mPDF
            if (class_exists('\Mpdf\Mpdf')) {
                $this->info("   ✓ کلاس mPDF بارگذاری می‌شود");
            } else {
                $this->error("   ✗ کلاس mPDF یافت نشد");
                $this->warn("      → composer require niklasravnsborg/laravel-pdf");
                $hasErrors = true;
            }

            // تست facade
            if (class_exists('\niklasravnsborg\LaravelPdf\Facades\Pdf')) {
                $this->info("   ✓ Facade PDF در دسترس است");
            } else {
                $this->error("   ✗ Facade PDF یافت نشد");
                $hasErrors = true;
            }

        } catch (\Exception $e) {
            $this->error("   ✗ خطا در تست: " . $e->getMessage());
            $hasErrors = true;
        }
    }

    private function convertToBytes($val)
    {
        if ($val == -1) {
            return -1;
        }

        $val = trim($val);
        $last = strtolower($val[strlen($val) - 1] ?? '');
        $val = (int) $val;

        switch ($last) {
            case 'g':
                $val *= 1024;
            case 'm':
                $val *= 1024;
            case 'k':
                $val *= 1024;
        }

        return $val;
    }
}

