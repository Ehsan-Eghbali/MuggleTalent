<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>بررسی سلامت سیستم PDF</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            padding: 20px;
            direction: rtl;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 30px;
        }

        h1 {
            color: #333;
            margin-bottom: 10px;
            border-bottom: 3px solid #4CAF50;
            padding-bottom: 10px;
        }

        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .status-healthy {
            background: #4CAF50;
            color: white;
        }

        .status-warning {
            background: #FF9800;
            color: white;
        }

        .status-unhealthy {
            background: #f44336;
            color: white;
        }

        .check-section {
            margin: 20px 0;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .check-section h2 {
            color: #555;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .status-icon {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: inline-block;
        }

        .status-ok {
            background: #4CAF50;
        }

        .status-warning {
            background: #FF9800;
        }

        .status-error {
            background: #f44336;
        }

        .check-details {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            margin-top: 10px;
        }

        .check-details ul {
            list-style: none;
            padding-right: 0;
        }

        .check-details li {
            padding: 5px 0;
            border-bottom: 1px solid #eee;
        }

        .check-details li:last-child {
            border-bottom: none;
        }

        .message {
            padding: 10px;
            border-radius: 5px;
            margin: 10px 0;
        }

        .message-ok {
            background: #e8f5e9;
            color: #2e7d32;
            border-right: 4px solid #4CAF50;
        }

        .message-warning {
            background: #fff3e0;
            color: #e65100;
            border-right: 4px solid #FF9800;
        }

        .message-error {
            background: #ffebee;
            color: #c62828;
            border-right: 4px solid #f44336;
        }

        .timestamp {
            color: #999;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .action-buttons {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #2196F3;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-left: 10px;
            transition: background 0.3s;
        }

        .btn:hover {
            background: #1976D2;
        }

        pre {
            background: #263238;
            color: #aed581;
            padding: 15px;
            border-radius: 5px;
            overflow-x: auto;
            direction: ltr;
            text-align: left;
        }

        code {
            font-family: 'Courier New', monospace;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 بررسی سلامت سیستم PDF</h1>
        
        <div class="timestamp">
            آخرین بررسی: {{ \Carbon\Carbon::parse($result->timestamp)->timezone('Asia/Tehran')->format('Y/m/d H:i:s') }}
        </div>

        <span class="status-badge status-{{ $result->status }}">
            وضعیت کلی: 
            @if($result->status === 'healthy')
                ✓ سالم
            @elseif($result->status === 'warning')
                ⚠ هشدار
            @else
                ✗ ناسالم
            @endif
        </span>

        <!-- Extensions Check -->
        <div class="check-section">
            <h2>
                <span class="status-icon status-{{ $result->checks->extensions->status }}"></span>
                Extensions PHP
            </h2>
            <div class="message message-{{ $result->checks->extensions->status }}">
                {{ $result->checks->extensions->message }}
            </div>
            @if(!empty($result->checks->extensions->missing))
                <div class="check-details">
                    <p><strong>Extensions مفقود:</strong></p>
                    <ul>
                        @foreach($result->checks->extensions->missing as $ext)
                            <li>❌ {{ $ext }}</li>
                        @endforeach
                    </ul>
                    <p style="margin-top: 15px;"><strong>دستور نصب:</strong></p>
                    <pre><code>sudo apt-get install -y @foreach($result->checks->extensions->missing as $ext)php-{{ $ext }} @endforeach</code></pre>
                </div>
            @endif
        </div>

        <!-- Directories Check -->
        <div class="check-section">
            <h2>
                <span class="status-icon status-{{ $result->checks->directories->status }}"></span>
                پوشه‌ها و دسترسی‌ها
            </h2>
            <div class="message message-{{ $result->checks->directories->status }}">
                {{ $result->checks->directories->message }}
            </div>
            @if(!empty($result->checks->directories->issues))
                <div class="check-details">
                    <p><strong>مشکلات:</strong></p>
                    <ul>
                        @foreach($result->checks->directories->issues as $issue)
                            <li>❌ {{ $issue }}</li>
                        @endforeach
                    </ul>
                    <p style="margin-top: 15px;"><strong>دستور رفع مشکل:</strong></p>
                    <pre><code>chmod -R 775 storage
chown -R www-data:www-data storage</code></pre>
                </div>
            @endif
        </div>

        <!-- Fonts Check -->
        <div class="check-section">
            <h2>
                <span class="status-icon status-{{ $result->checks->fonts->status }}"></span>
                فونت‌های فارسی
            </h2>
            <div class="message message-{{ $result->checks->fonts->status }}">
                {{ $result->checks->fonts->message }}
            </div>
            @if(!empty($result->checks->fonts->missing))
                <div class="check-details">
                    <p><strong>فونت‌های مفقود:</strong></p>
                    <ul>
                        @foreach($result->checks->fonts->missing as $font)
                            <li>❌ {{ $font }}</li>
                        @endforeach
                    </ul>
                    <p style="margin-top: 15px;"><strong>دانلود فونت:</strong></p>
                    <pre><code>cd /tmp
wget https://github.com/rastikerdar/vazirmatn/releases/download/v33.003/vazirmatn-v33.003.zip
unzip vazirmatn-v33.003.zip
mkdir -p public/assets/fonts
cp Vazirmatn-*.ttf public/assets/fonts/</code></pre>
                </div>
            @endif
        </div>

        <!-- PHP Settings -->
        <div class="check-section">
            <h2>
                <span class="status-icon status-{{ $result->checks->php_settings->status }}"></span>
                تنظیمات PHP
            </h2>
            <div class="check-details">
                <ul>
                    <li>
                        <strong>Memory Limit:</strong> {{ $result->checks->php_settings->memory_limit }}
                        @if(!$result->checks->php_settings->memory_ok)
                            <span style="color: #f44336;">⚠ کم است</span>
                        @else
                            <span style="color: #4CAF50;">✓ مناسب است</span>
                        @endif
                    </li>
                    <li>
                        <strong>Max Execution Time:</strong> {{ $result->checks->php_settings->max_execution_time }} ثانیه
                        @if(!$result->checks->php_settings->execution_ok)
                            <span style="color: #f44336;">⚠ کم است</span>
                        @else
                            <span style="color: #4CAF50;">✓ مناسب است</span>
                        @endif
                    </li>
                </ul>
                @if(!$result->checks->php_settings->memory_ok || !$result->checks->php_settings->execution_ok)
                    <p style="margin-top: 15px;"><strong>تنظیمات پیشنهادی برای php.ini:</strong></p>
                    <pre><code>memory_limit = 256M
max_execution_time = 120</code></pre>
                @endif
            </div>
        </div>

        <!-- Write Test -->
        <div class="check-section">
            <h2>
                <span class="status-icon status-{{ $result->checks->write_test->status }}"></span>
                تست نوشتن فایل
            </h2>
            <div class="message message-{{ $result->checks->write_test->status }}">
                {{ $result->checks->write_test->message }}
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="{{ url('/') }}" class="btn">بازگشت به داشبورد</a>
            <a href="{{ route('pdf.health-check.api') }}" class="btn" style="background: #607D8B;">مشاهده JSON</a>
            <a href="{{ route('pdf.health-check') }}" class="btn" style="background: #4CAF50;">بروزرسانی</a>
        </div>

        <div style="margin-top: 30px; padding: 15px; background: #e3f2fd; border-radius: 5px;">
            <h3 style="color: #1976D2; margin-bottom: 10px;">💡 نکات مهم:</h3>
            <ul style="padding-right: 20px; line-height: 1.8;">
                <li>بعد از هر تغییری، حتماً PHP-FPM و وب سرور را ریستارت کنید</li>
                <li>برای بررسی دقیق‌تر، لاگ‌های Laravel را چک کنید: <code>storage/logs/laravel.log</code></li>
                <li>برای تست از خط فرمان: <code>php artisan pdf:check-environment</code></li>
            </ul>
        </div>
    </div>
</body>
</html>

