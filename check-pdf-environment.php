<?php
/**
 * اسکریپت تشخیص مشکلات PDF
 * 
 * این فایل را در روت پروژه قرار دهید و با دستور زیر اجرا کنید:
 * php check-pdf-environment.php
 */

echo "========================================\n";
echo "بررسی محیط برای تولید PDF\n";
echo "========================================\n\n";

// 1. بررسی نسخه PHP
echo "✓ نسخه PHP: " . PHP_VERSION . "\n";
if (version_compare(PHP_VERSION, '8.2.0', '<')) {
    echo "   ⚠ هشدار: نسخه PHP باید 8.2 یا بالاتر باشد\n";
}
echo "\n";

// 2. بررسی Extensions مورد نیاز
echo "بررسی Extensions PHP:\n";
$required_extensions = [
    'mbstring' => 'برای کار با رشته‌های UTF-8',
    'gd' => 'برای پردازش تصاویر',
    'zip' => 'برای فایل‌های فشرده',
    'dom' => 'برای پردازش HTML',
    'xml' => 'برای پردازش XML',
];

$missing_extensions = [];
foreach ($required_extensions as $ext => $desc) {
    if (extension_loaded($ext)) {
        echo "   ✓ {$ext}: نصب شده - {$desc}\n";
    } else {
        echo "   ✗ {$ext}: نصب نشده! - {$desc}\n";
        $missing_extensions[] = $ext;
    }
}
echo "\n";

// 3. بررسی تنظیمات PHP
echo "تنظیمات PHP:\n";
$memory_limit = ini_get('memory_limit');
echo "   Memory Limit: {$memory_limit}\n";
$memory_bytes = return_bytes($memory_limit);
if ($memory_bytes < 256 * 1024 * 1024) {
    echo "   ⚠ توصیه می‌شود memory_limit حداقل 256M باشد\n";
}

$max_execution = ini_get('max_execution_time');
echo "   Max Execution Time: {$max_execution} ثانیه\n";
if ($max_execution < 60 && $max_execution != 0) {
    echo "   ⚠ توصیه می‌شود max_execution_time حداقل 60 ثانیه باشد\n";
}
echo "\n";

// 4. بررسی پوشه‌ها و دسترسی‌ها
echo "بررسی پوشه‌ها:\n";

$directories = [
    'storage/app/letters' => 'محل ذخیره PDFها',
    'storage/app/pdf-temp' => 'محل فایل‌های موقت PDF',
    'storage/logs' => 'محل لاگ‌ها',
    'public/assets/fonts' => 'محل فونت‌های فارسی',
];

foreach ($directories as $dir => $desc) {
    echo "   {$dir} - {$desc}\n";
    
    if (!file_exists($dir)) {
        echo "      ✗ پوشه وجود ندارد\n";
        // تلاش برای ایجاد پوشه
        if (@mkdir($dir, 0775, true)) {
            echo "      ✓ پوشه با موفقیت ایجاد شد\n";
        } else {
            echo "      ✗ خطا در ایجاد پوشه\n";
        }
    } else {
        echo "      ✓ پوشه موجود است\n";
        
        // بررسی دسترسی نوشتن
        if (is_writable($dir)) {
            echo "      ✓ قابل نوشتن است\n";
        } else {
            echo "      ✗ قابل نوشتن نیست! (Permission denied)\n";
            echo "      → اجرا کنید: chmod -R 775 {$dir}\n";
        }
    }
}
echo "\n";

// 5. بررسی فونت‌های فارسی
echo "بررسی فونت‌های فارسی:\n";
$fonts = [
    'public/assets/fonts/Vazirmatn-Regular.ttf',
    'public/assets/fonts/Vazirmatn-Bold.ttf',
];

$missing_fonts = [];
foreach ($fonts as $font) {
    if (file_exists($font)) {
        $size = filesize($font);
        echo "   ✓ {$font} (حجم: " . number_format($size / 1024, 2) . " KB)\n";
    } else {
        echo "   ✗ {$font} موجود نیست!\n";
        $missing_fonts[] = $font;
    }
}
echo "\n";

// 6. بررسی فایل config/pdf.php
echo "بررسی تنظیمات PDF:\n";
if (file_exists('config/pdf.php')) {
    echo "   ✓ فایل config/pdf.php موجود است\n";
} else {
    echo "   ✗ فایل config/pdf.php موجود نیست!\n";
}
echo "\n";

// 7. تست ساده تولید PDF
echo "تست تولید PDF:\n";
try {
    $test_content = '<html><body style="font-family: Arial;">Test PDF Generation</body></html>';
    $test_file = 'storage/app/pdf-temp/test-' . time() . '.html';
    
    if (!file_exists('storage/app/pdf-temp')) {
        @mkdir('storage/app/pdf-temp', 0775, true);
    }
    
    if (file_put_contents($test_file, $test_content)) {
        echo "   ✓ قادر به نوشتن فایل در پوشه temp هستیم\n";
        @unlink($test_file);
    } else {
        echo "   ✗ خطا در نوشتن فایل در پوشه temp\n";
    }
} catch (Exception $e) {
    echo "   ✗ خطا: " . $e->getMessage() . "\n";
}
echo "\n";

// خلاصه و نتیجه‌گیری
echo "========================================\n";
echo "خلاصه:\n";
echo "========================================\n";

$has_errors = !empty($missing_extensions) || !empty($missing_fonts);

if (!$has_errors) {
    echo "✓ همه‌چیز به نظر مرتب است!\n";
} else {
    echo "⚠ مشکلاتی یافت شد:\n\n";
    
    if (!empty($missing_extensions)) {
        echo "Extensions نصب نشده:\n";
        foreach ($missing_extensions as $ext) {
            echo "   - {$ext}\n";
        }
        echo "\nبرای نصب extensions:\n";
        echo "   Ubuntu/Debian: sudo apt-get install php-{extension-name}\n";
        echo "   CentOS/RHEL: sudo yum install php-{extension-name}\n\n";
    }
    
    if (!empty($missing_fonts)) {
        echo "فونت‌های مفقود:\n";
        foreach ($missing_fonts as $font) {
            echo "   - {$font}\n";
        }
        echo "\nفونت Vazirmatn را از این آدرس دانلود کنید:\n";
        echo "   https://github.com/rastikerdar/vazirmatn/releases\n\n";
    }
}

echo "\n========================================\n";
echo "دستورات توصیه شده برای سرور:\n";
echo "========================================\n";
echo "1. تنظیم دسترسی پوشه‌ها:\n";
echo "   chmod -R 775 storage\n";
echo "   chmod -R 775 bootstrap/cache\n";
echo "   chown -R www-data:www-data storage\n";
echo "   chown -R www-data:www-data bootstrap/cache\n\n";

echo "2. پاک‌سازی cache:\n";
echo "   php artisan cache:clear\n";
echo "   php artisan config:clear\n";
echo "   php artisan view:clear\n\n";

echo "3. نصب dependencies:\n";
echo "   composer install --optimize-autoloader --no-dev\n\n";

echo "4. بررسی لاگ‌ها:\n";
echo "   tail -f storage/logs/laravel.log\n\n";

// تابع کمکی
function return_bytes($val) {
    $val = trim($val);
    $last = strtolower($val[strlen($val)-1]);
    $val = (int)$val;
    switch($last) {
        case 'g':
            $val *= 1024;
        case 'm':
            $val *= 1024;
        case 'k':
            $val *= 1024;
    }
    return $val;
}

