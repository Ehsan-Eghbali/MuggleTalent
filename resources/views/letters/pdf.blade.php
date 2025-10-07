<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <style>
        /* در mPDF فونت پیش‌فرض را در config/pdf.php روی iranyekanpdf تنظیم کنید */
        * { font-family: 'iranyekanpdf', 'vazirmatn', sans-serif !important; }

        html, body {
            direction: rtl;
            text-align: right;
            font-size: 12pt;
            line-height: 1.9;
            margin: 0;
            padding: 0;
        }

        .page {
            padding: 22px 28px;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 10px;
        }

        .brand {
            font-weight: 700;
            font-size: 13pt;
        }

        .doc-meta {
            text-align: left;
            min-width: 220px;
        }
        .doc-meta p { margin: 0 0 6px; }
        .ltr {
            direction: ltr !important;
            unicode-bidi: embed !important;
            display: inline-block;
            text-align: left;
        }

        .divider {
            border-bottom: 2px solid #444;
            margin: 8px 0 16px;
        }

        .title {
            text-align: center;
            font-weight: 800;
            font-size: 14pt;
            margin: 10px 0 18px;
        }

        .content p { margin: 0 0 10px; }

        .footer {
            margin-top: 34px;
            display: flex;
            justify-content: space-between;
            gap: 24px;
        }

        .sign-box {
            width: 48%;
            border-top: 1px dashed #777;
            padding-top: 10px;
            text-align: center;
            font-size: 11pt;
        }

        .muted { color: #666; font-size: 10pt; }
    </style>
</head>
<body>
@php
    $body = $body_html ?? '';
    // اگر در متن بدنه تگی از نوع تیتر وجود داشته باشد، تیتر صفحه را تکرار نکن
    $hasHeading = $body && preg_match('/<h[1-6][^>]*>/u', $body);
    $docTitle = $title ?? (($template_key ?? '') === 'salary_certificate' ? 'گواهی حقوق/ضمانت' : 'گواهی اشتغال به کار');
    $num = $number ?? '-';
    $dateStr = $issued_at ?? now()->format('Y/m/d');
@endphp

<div class="page">

    <div class="header">
        <div class="brand">واحد منابع انسانی</div>
        <div class="doc-meta">
            <p><strong>شماره:</strong> <span class="ltr">{{ $num }}</span></p>
            <p><strong>تاریخ:</strong> <span class="ltr">{{ $dateStr }}</span></p>
        </div>
    </div>

    <div class="divider"></div>

    @unless($hasHeading)
        <div class="title">{{ $docTitle }}</div>
    @endunless

    <div class="content">
        @if(!empty($body))
            {{-- تحمیل فونت و راست‌به‌چپ به محتوای دریافتی --}}
            <div style="font-family:'iranyekanpdf','vazirmatn',sans-serif; direction:rtl; unicode-bidi:isolate-override;">
                {!! $body !!}
            </div>
        @else
            <p>
                بدینوسیله گواهی می‌شود جناب آقای/خانم
                <strong>{{ $person_name ?? '—' }}</strong>
                در این شرکت مشغول به کار می‌باشند.
            </p>

            @if(($template_key ?? '') === 'salary_certificate')
                <p>
                    ایشان متعهد به پرداخت مبلغ
                    <strong><span class="ltr">{{ $guarantee_amount ?? '—' }}</span></strong>
                    ریال می‌باشند.
                </p>
            @endif

            <p>
                این گواهی جهت ارائه به
                <strong>{{ $recipient_name ?? '—' }}</strong>
                صادر گردیده است.
            </p>
        @endif
    </div>

    <div class="footer">
        <div class="sign-box">
            <div class="muted">مسئول منابع انسانی</div>
            <div>امضاء و مهر</div>
        </div>
        <div class="sign-box">
            <div class="muted">مدیر عامل / مدیر واحد</div>
            <div>امضاء و مهر</div>
        </div>
    </div>

</div>
</body>
</html>
