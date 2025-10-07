<?php

return [
    'mode'                  => 'utf-8',
    'format'                => 'A4',
    'author'                => '',
    'subject'               => '',
    'keywords'              => '',
    'creator'               => 'Laravel',
    'display_mode'          => 'fullpage',
    // مهم برای RTL و انتخاب خودکار فونت/اسکریپت:
    'direction'             => 'rtl',
    'autoScriptToLang'      => true,
    'autoLangToFont'        => true,
    'useOTL'                => 0xFF, // OpenType layout
    'useKashida'            => 0,
    'temp_dir'              => storage_path('app/pdf-temp'),
    'pdf_a'                 => false,
    'fonts'                 => [
        // نام خانوادهٔ فونت دلخواهت
        'iranyekanpdf' => [
            'R'  => public_path('assets/fonts/IRANYekan-Regular.ttf'),
            'B'  => public_path('assets/fonts/IRANYekan-Bold.ttf'),
            // اگر Medium یا Light داری اضافه کن:
            //'M'  => public_path('assets/fonts/IRANYekan-Medium.ttf'),
            //'L'  => public_path('assets/fonts/IRANYekan-Light.ttf'),
            'useOTL' => 0xFF,
            'useKashida' => 0,
        ],
        // یک بکاپ مطمئن
        'vazirmatn' => [
            'R' => public_path('assets/fonts/Vazirmatn-Regular.ttf'),
            'B' => public_path('assets/fonts/Vazirmatn-Bold.ttf'),
            'useOTL' => 0xFF,
            'useKashida' => 0,
        ],
    ],
    'default_font'          => 'iranyekanpdf', // خانوادهٔ پیشفرض
];
