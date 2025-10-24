<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\ProfileController;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view("master.index");
})->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/employees', EmployeeController::class);
});

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
});


// این روت جدید برای نمایش پروفایل کارمندان است
Route::get('/personnel/{id}', function ($id) {
    // داده‌های فیک کامل برای پروفایل
    $employee = [
        'id' => $id,
        'full_name' => 'پوریا نیک وند',
        'title' => 'برنامه نویس تحلیل داده',
        'email' => 'p.nikvand@tapsell.ir',
        'phone' => '۰۹۱۲۳۴۵۶۷۸۹',
        'national_code' => '۰۰۱۲۳۴۵۶۷۸',
        'birth_cert_number' => '۱۲۳۴۵',
        'marital_status' => 'متاهل',
        'personal_email' => 'pouria.nikvand@example.com',
        'father_name' => 'محمد',
        'mother_name' => 'زهرا',
        'birth_date' => '۱۳۷۰/۰۲/۰۱',
        'birth_place' => 'تهران',
        'military_status' => 'پایان خدمت',
        'marriage_date' => '۱۳۹۸/۱۱/۲۲',
        'home_phone' => '۰۲۱-۸۷۶۵۴۳۲۱',
        'telegram_id' => '@pouria_nik',
        'address' => 'تهران، میدان آزادی، خیابان آزادی، پلاک ۱',
        'postal_code' => '۱۴۵۹۹۱۲۳۴۵',
        'emergency_contact' => '۰۹۳۵۱۲۳۴۵۶۷',
        'gender' => 'مرد',
        'field_of_study' => 'مهندسی نرم‌افزار',
        'degree' => 'فوق لیسانس',
        'employment_status' => 'فعال',
        'employment_duration' => '۱۰ ماه',

        'employment_info' => [
            'department' => 'فنی و مهندسی',
            'team' => 'تیم بک‌اند',
            'personnel_code' => '۹۴۰۴۰',
            'job_title' => 'برنامه نویس ارشد',
            'insurance_title' => 'کارشناس نرم‌افزار',
            'skill_level' => 'سینیور ۱',
            'insurance_job_code' => '۱۲۳۴۵۶',
            'cooperation_type' => 'تمام وقت',
            'employment_status' => 'فعال',
            'direct_manager' => 'مدیر فنی',
            'work_model' => 'هیبرید',
            'contract_type' => 'رسمی',
            'nda_type' => 'فنی',
            'hire_date' => '۱۴۰۳/۰۷/۱۵',
            'termination_date' => '',
            'termination_reason' => '',
        ],

        // این بخش اصلاح شد
        'financial_info' => [
            'official_bank_name' => 'ملت',
            'official_card_number' => '۶۱۰۴-۳۳۷۸-۱۲۳۴-۵۶۷۸',
            'official_account_number' => '۱۲۳۴۵۶۷۸۹۰',
            'official_iban' => 'IR123456789012345678901234',
            'unofficial_bank_name' => 'سامان',
            'unofficial_card_number' => '۶۲۱۹-۸۶۱۰-۱۲۳۴-۵۶۷۸',
            'unofficial_account_number' => '۰۹۸۷۶۵۴۳۲۱',
            'unofficial_iban' => 'IR098765432109876543210987',
        ],

        'work_history' => [
            'notes' => 'این کارمند در پروژه X عملکرد بسیار خوبی داشته و پیشنهاد می‌شود برای پاداش در نظر گرفته شود.',
            'attachments' => [
                ['name' => 'تقدیرنامه_پروژه_X.pdf', 'size' => '۱.۲ مگابایت', 'date' => '۱۴۰۴/۰۳/۱۲'],
                ['name' => 'گزارش_عملکرد_فصلی.docx', 'size' => '۴۵۰ کیلوبایت', 'date' => '۱۴۰۴/۰۱/۱۰'],
            ]
        ],
        'training_records' => [
            'notes' => 'کارمند در دوره‌های برنامه‌نویسی پیشرفته شرکت کرده و مدرک مربوطه را دریافت نموده است.',
            'attachments' => [
                ['name' => 'مدرک_دوره_لاراول.pdf', 'size' => '۲.۵ مگابایت', 'date' => '۱۴۰۴/۰۴/۲۱'],
                ['name' => 'گواهی_شرکت_در_سمینار.jpg', 'size' => '۸۰۰ کیلوبایت', 'date' => '۱۴۰۴/۰۲/۱۱'],
            ]
        ],
    ];
    return view('dashboard.personnel-profile', ['employee' => $employee]);
});

Route::get('/letters_issue', [LetterController::class, 'create'])
    ->name('letters.issue')
    ->middleware(['web','auth']);


Route::get('/letters_archive', function () {
    return view('dashboard.archive');
});
Route::get('/_pdf_font_test', function () {
    $pdf = Pdf::loadView('letters.pdf_test')
        ->setPaper('A4', 'portrait')
        ->setOptions([
            'isHtml5ParserEnabled'   => true,
            'isRemoteEnabled'        => true,
            'defaultFont'            => 'IRANYekanPDF',
            'enable_font_subsetting' => true,
        ]);
    return $pdf->download('pdf-font-test.pdf');
});

Route::get('/_pdf_debug_test', function () {
    try {
        $dataForView = [
            'number' => '۱۴۰۴/پ/۱۲۳۴۵۶',
            'issued_at' => '۱۴۰۴/۰۱/۰۱',
            'title' => 'گواهی اشتغال به کار',
            'template_key' => 'employment_certificate',
            'person_name' => 'احمد محمدی',
            'recipient_name' => 'بانک ملی',
            'guarantee_amount' => null,
            'body_html' => null,
        ];

        $pdf = \niklasravnsborg\LaravelPdf\Facades\Pdf::loadView('letters.pdf', $dataForView);

        return $pdf->download('pdf-debug-test.pdf');
    } catch (\Exception $e) {
        return response()->json([
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ], 500);
    }
});
// routes/web.php

Route::prefix('letters')->name('letters.')->middleware(['web'])->group(function () {
    // ساخت نامه (ثبت در پایگاه)
    Route::post('/', [LetterController::class, 'store'])->name('store');

    // ساخت نامه و تحویل مستقیم پی‌دی‌اف
    Route::post('/generate-download', [LetterController::class, 'generateAndDownload'])->name('generate_download');

    // پیوست‌ها
    Route::post('{letter}/attachments', [LetterController::class, 'uploadAttachment'])->name('attachments.upload');
    Route::get('{letter}/attachments/{attachment}/download', [LetterController::class, 'downloadAttachment'])->name('attachments.download');
    Route::delete('{letter}/attachments/{attachment}', [LetterController::class, 'destroyAttachment'])->name('attachments.destroy');
});

// روت‌های آرشیو نامه‌ها
Route::prefix('archive')->name('archive.')->group(function () {
    Route::get('/', [App\Http\Controllers\ArchiveController::class, 'index'])->name('index');
    Route::get('/{letter}/download', [App\Http\Controllers\ArchiveController::class, 'download'])->name('download');
    Route::get('/{letter}', [App\Http\Controllers\ArchiveController::class, 'show'])->name('show');
});

// روت قدیمی برای سازگاری
Route::get('/letters_archive', [App\Http\Controllers\ArchiveController::class, 'index']);

// routes/web.php

// روت برای نمایش صفحه مدیریت نقش‌ها
Route::get('/roles', function () {
    // داده‌های فیک برای نقش‌ها (بدون نقش کارمند)
    $roles = [
        ['id' => 1, 'name' => 'سوپر ادمین'],
        ['id' => 2, 'name' => 'ادمین'],
        ['id' => 3, 'name' => 'مدیر'],
        ['id' => 4, 'name' => 'کارشناس منابع انسانی'],
    ];

    // لیست تمام دسترسی‌های ممکن در سیستم
    $permissions = [
        'لیست پرسنلی' => ['view', 'create', 'edit', 'delete'],
        'صدور آنلاین نامه' => ['view', 'create'],
        'آرشیو نامه‌ها' => ['view', 'delete'],
        'مدیریت پنل' => ['view'],
    ];

    // لیست کاربران برای نمایش با نقش‌های جدید
    $users = [
        ['id' => 1, 'name' => 'محمد مهدی مهربان نیا', 'role' => 'سوپر ادمین'],
        ['id' => 2, 'name' => 'کتایون حسینی شاد', 'role' => 'سوپر ادمین'],
        ['id' => 3, 'name' => 'نغمه عبادی', 'role' => 'ادمین'],
        ['id' => 4, 'name' => 'حمیدرضا ایزدی', 'role' => 'کارشناس منابع انسانی'],
        ['id' => 5, 'name' => 'هاینه قاسم زاده', 'role' => 'کارشناس منابع انسانی'],
        ['id' => 6, 'name' => 'رضا کیانی', 'role' => 'کارشناس منابع انسانی'],
        ['id' => 7, 'name' => 'حسام همتی نیا', 'role' => 'کارشناس منابع انسانی'],
    ];

    return view('dashboard.roles.index', [
        'roles' => $roles,
        'permissions' => $permissions,
        'users' => $users
    ]);
});

// routes/web.php

// روت برای نمایش صفحه مدیریت واحدها
Route::get('/departments', function () {
    // داده‌های فیک برای واحدها
    $departments = [
  ['id' => 2, 'name' => 'منابع انسانی'],
       
       
    ];

    return view('dashboard.departments.index', ['departments' => $departments]);
});

// routes/web.php

// روت برای نمایش صفحه مدیریت تیم‌ها
Route::get('/teams', function () {
    // داده‌های فیک برای تیم‌ها
    $teams = [
        ['id' => 1, 'name' => 'تیم منابع انسانی'],

    ];

    return view('dashboard.teams.index', ['teams' => $teams]);
});

// routes/web.php

// روت‌های مدیریت حقوق و دستمزد
Route::middleware('auth')->group(function () {
    Route::get('/payrolls', [App\Http\Controllers\PayrollController::class, 'index'])->name('payrolls.index');
    Route::post('/payrolls', [App\Http\Controllers\PayrollController::class, 'store'])->name('payrolls.store');
    Route::put('/payrolls/{id}', [App\Http\Controllers\PayrollController::class, 'update'])->name('payrolls.update');
    Route::delete('/payrolls/{id}', [App\Http\Controllers\PayrollController::class, 'destroy'])->name('payrolls.destroy');
    Route::get('/payroll-history', [App\Http\Controllers\PayrollController::class, 'history'])->name('payrolls.history');
});

Route::get('/reports', function () {
    // داده‌های فیک برای کارت‌های آماری
    $stats = [
        'total_personnel' => 278,
        'new_hires' => 8,
        'departures' => 2,
    ];

    // داده‌های فیک برای نمودارها
    $teamData = [
        'labels' => ['تپسل', 'فانتوری', 'متریکس', 'مدیاهاوس', 'گروه هوش مصنوعی'],
        'data' => [170, 56, 10, 23, 39],
    ];

    $techData = [
        'labels' => ['پرسنل فنی', 'پرسنل غیر فنی'],
        'data' => [67, 33],
    ];

    $genderData = [
        'labels' => ['مردان', 'زنان'],
        'data' => [54, 46],
    ];

    return view('dashboard.reports.index', compact('stats', 'teamData', 'techData', 'genderData'));
});

Route::get('/reports/demographic', function () {
    return view('dashboard.reports.demographic');
});

Route::get('/reports/recruitment', function () {
    return view('dashboard.reports.recruitment');
});

require __DIR__ . '/auth.php';
