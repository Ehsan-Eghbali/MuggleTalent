<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <style>
        /* 1) معرفی فونت از مسیر public/assets/fonts (فایل‌های TTF/OTF واقعی!) */
        @font-face {
            font-family: 'IRANYekanPDF';
            font-style: normal;
            font-weight: normal;
            src: url('{{ public_path('assets/fonts/IRANYekan-Regular.ttf') }}') format('truetype');
        }
        @font-face {
            font-family: 'IRANYekanPDF';
            font-style: normal;
            font-weight: bold;
            src: url('{{ public_path('assets/fonts/IRANYekan-Bold.ttf') }}') format('truetype');
        }

        /* 2) اجبار فونت روی کل صفحه؛ هر فونت دیگه‌ای بی‌اثر شه */
        * { font-family: 'IRANYekanPDF', 'DejaVu Sans', sans-serif !important; }

        html, body { direction: rtl; text-align: right; font-size: 14pt; line-height: 1.8; }
        h3 { text-align:center; font-weight: bold; }
    </style>
</head>
<body>
<h3>تست فارسی PDF</h3>
<p>سلام! این یک تست است: آ ا ب پ ت ث ج چ ح خ د ذ ر ز ژ س ش ص ض ط ظ ع غ ف ق ک گ ل م ن و هـ ی</p>
<p>اعداد فارسی: ۰ ۱ ۲ ۳ ۴ ۵ ۶ ۷ ۸ ۹</p>
<p>اعداد عربی: ٠ ١ ٢ ٣ ٤ ٥ ٦ ٧ ٨ ٩</p>
<p><strong>متن بولد</strong> و متن معمولی.</p>
</body>
</html>
