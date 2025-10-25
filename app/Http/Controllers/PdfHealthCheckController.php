<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PdfHealthCheckController extends Controller
{
    /**
     * بررسی سلامت سیستم تولید PDF
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function check()
    {
        $checks = [];
        $overallStatus = 'healthy';

        // 1. بررسی Extensions
        $checks['extensions'] = $this->checkExtensions();
        if ($checks['extensions']['status'] !== 'ok') {
            $overallStatus = 'unhealthy';
        }

        // 2. بررسی پوشه‌ها
        $checks['directories'] = $this->checkDirectories();
        if ($checks['directories']['status'] !== 'ok') {
            $overallStatus = 'unhealthy';
        }

        // 3. بررسی فونت‌ها
        $checks['fonts'] = $this->checkFonts();
        if ($checks['fonts']['status'] !== 'ok') {
            $overallStatus = 'warning';
        }

        // 4. بررسی تنظیمات PHP
        $checks['php_settings'] = $this->checkPhpSettings();

        // 5. تست نوشتن فایل
        $checks['write_test'] = $this->testWriteAccess();
        if ($checks['write_test']['status'] !== 'ok') {
            $overallStatus = 'unhealthy';
        }

        return response()->json([
            'status' => $overallStatus,
            'timestamp' => now()->toIso8601String(),
            'checks' => $checks,
        ], $overallStatus === 'healthy' ? 200 : 503);
    }

    /**
     * نمایش صفحه تشخیص مشکلات (برای admin)
     */
    public function page()
    {
        $checkResult = $this->check()->getData();
        
        return view('admin.pdf-health-check', [
            'result' => $checkResult,
        ]);
    }

    private function checkExtensions(): array
    {
        $required = ['mbstring', 'gd', 'zip', 'dom', 'xml'];
        $missing = [];

        foreach ($required as $ext) {
            if (!extension_loaded($ext)) {
                $missing[] = $ext;
            }
        }

        return [
            'status' => empty($missing) ? 'ok' : 'error',
            'required' => $required,
            'missing' => $missing,
            'message' => empty($missing) 
                ? 'همه Extensions نصب شده‌اند' 
                : 'Extensions زیر نصب نشده‌اند: ' . implode(', ', $missing),
        ];
    }

    private function checkDirectories(): array
    {
        $directories = [
            'letters' => storage_path('app/letters'),
            'pdf_temp' => storage_path('app/pdf-temp'),
            'fonts' => public_path('assets/fonts'),
        ];

        $issues = [];

        foreach ($directories as $key => $dir) {
            if (!file_exists($dir)) {
                $issues[] = "{$key}: پوشه وجود ندارد ({$dir})";
            } elseif (!is_writable($dir)) {
                $issues[] = "{$key}: قابل نوشتن نیست ({$dir})";
            }
        }

        return [
            'status' => empty($issues) ? 'ok' : 'error',
            'directories' => $directories,
            'issues' => $issues,
            'message' => empty($issues)
                ? 'همه پوشه‌ها موجود و قابل دسترس هستند'
                : 'مشکلات: ' . implode('; ', $issues),
        ];
    }

    private function checkFonts(): array
    {
        $fonts = [
            'regular' => public_path('assets/fonts/Vazirmatn-Regular.ttf'),
            'bold' => public_path('assets/fonts/Vazirmatn-Bold.ttf'),
        ];

        $missing = [];

        foreach ($fonts as $key => $path) {
            if (!file_exists($path)) {
                $missing[] = $key;
            }
        }

        return [
            'status' => empty($missing) ? 'ok' : 'warning',
            'fonts' => $fonts,
            'missing' => $missing,
            'message' => empty($missing)
                ? 'همه فونت‌ها موجود هستند'
                : 'فونت‌های مفقود: ' . implode(', ', $missing),
        ];
    }

    private function checkPhpSettings(): array
    {
        $memoryLimit = ini_get('memory_limit');
        $maxExecution = ini_get('max_execution_time');

        $memoryBytes = $this->convertToBytes($memoryLimit);
        $memoryOk = $memoryBytes >= 256 * 1024 * 1024 || $memoryBytes == -1;
        $executionOk = $maxExecution >= 60 || $maxExecution == 0;

        return [
            'status' => ($memoryOk && $executionOk) ? 'ok' : 'warning',
            'memory_limit' => $memoryLimit,
            'memory_ok' => $memoryOk,
            'max_execution_time' => $maxExecution,
            'execution_ok' => $executionOk,
            'recommendations' => [
                'memory' => $memoryOk ? null : 'توصیه می‌شود memory_limit حداقل 256M باشد',
                'execution' => $executionOk ? null : 'توصیه می‌شود max_execution_time حداقل 60 ثانیه باشد',
            ],
        ];
    }

    private function testWriteAccess(): array
    {
        try {
            $disk = 'letters';
            $testPath = 'health-check-' . time() . '.txt';
            
            Storage::disk($disk)->put($testPath, 'test content');
            
            if (Storage::disk($disk)->exists($testPath)) {
                Storage::disk($disk)->delete($testPath);
                
                return [
                    'status' => 'ok',
                    'message' => 'قادر به نوشتن و خواندن فایل هستیم',
                ];
            } else {
                return [
                    'status' => 'error',
                    'message' => 'فایل نوشته شد اما قابل خواندن نیست',
                ];
            }
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => 'خطا در نوشتن فایل: ' . $e->getMessage(),
            ];
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

