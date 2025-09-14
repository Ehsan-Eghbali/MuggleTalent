<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
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

// این روت برای صفحه اصلی داشبورد است
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

// روت برای نمایش صفحه صدور نامه
Route::get('/letters_issue', function () {
    // داده‌های فیک برای انتخاب پرسنل و قالب‌ها
    $personnel = [
        ['id' => 1, 'name' => 'پوریا نیک وند'],
        ['id' => 2, 'name' => 'سبحان فروغی'],
        ['id' => 3, 'name' => 'سید امین احمدی'],
    ];

    $templates = [
        ['id' => 'employment_certificate', 'name' => 'گواهی اشتغال به کار'],
        ['id' => 'salary_certificate', 'name' => 'گواهی کسر از حقوق'],
    ];

    return view('dashboard.issue-letter', [
        'personnel_list' => $personnel,
        'templates_list' => $templates
    ]);
});

// این روت را بعدا خواهیم ساخت
Route::get('/letters_archive', function () {
    return view('dashboard.archive');
});

// routes/web.php

// روت برای نمایش صفحه آرشیو نامه ها
Route::get('/letters_archive', function () {
    // داده‌های فیک برای آرشیو
    $archived_letters = [
        [
            'id' => 1,
            'letter_number' => '۱۴۰۴-۲۵۶',
            'personnel_name' => 'پوریا نیک وند',
            'personnel_code' => '۹۴۰۴۰',
            'letter_type' => 'گواهی اشتغال به کار',
            'issue_date' => '۱۴۰۴/۰۵/۱۵',
            'file_path' => '#' // لینک دانلود نامه
        ],
        [
            'id' => 2,
            'letter_number' => '۱۴۰۴-۲۵۷',
            'personnel_name' => 'سبحان فروغی',
            'personnel_code' => '۰۰۰۱',
            'letter_type' => 'گواهی کسر از حقوق',
            'issue_date' => '۱۴۰۴/۰۵/۱۸',
            'file_path' => '#'
        ],
        [
            'id' => 3,
            'letter_number' => '۱۴۰۴-۲۵۸',
            'personnel_name' => 'پوریا نیک وند',
            'personnel_code' => '۹۴۰۴۰',
            'letter_type' => 'گواهی اشتغال به کار',
            'issue_date' => '۱۴۰۴/۰۶/۰۲',
            'file_path' => '#'
        ],
    ];

    return view('dashboard.archive', ['letters' => $archived_letters]);
});

// routes/web.php

// روت برای نمایش صفحه مدیریت نقش‌ها
Route::get('/roles', function () {
    // داده‌های فیک برای نقش‌ها
    $roles = [
        ['id' => 1, 'name' => 'کارمند'],
        ['id' => 2, 'name' => 'کارشناس منابع انسانی'],
        ['id' => 3, 'name' => 'مدیر'],
        ['id' => 4, 'name' => 'ادمین کل'],
    ];

    // لیست تمام دسترسی‌های ممکن در سیستم
    $permissions = [
        'لیست پرسنلی' => ['view', 'create', 'edit', 'delete'],
        'صدور آنلاین نامه' => ['view', 'create'],
        'آرشیو نامه‌ها' => ['view', 'delete'],
        'مدیریت پنل' => ['view'],
    ];

    // لیست کاربران برای نمایش
    $users = [
        ['id' => 1, 'name' => 'پوریا نیک وند', 'role' => 'ادمین کل'],
        ['id' => 2, 'name' => 'سبحان فروغی', 'role' => 'کارشناس منابع انسانی'],
        ['id' => 3, 'name' => 'سید امین احمدی', 'role' => 'کارمند'],
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
        ['id' => 1, 'name' => 'فنی و مهندسی'],
        ['id' => 2, 'name' => 'منابع انسانی'],
        ['id' => 3, 'name' => 'مالی و اداری'],
        ['id' => 4, 'name' => 'فروش و بازاریابی'],
    ];

    return view('dashboard.departments.index', ['departments' => $departments]);
});

// routes/web.php

// روت برای نمایش صفحه مدیریت تیم‌ها
Route::get('/teams', function () {
    // داده‌های فیک برای تیم‌ها
    $teams = [
        ['id' => 1, 'name' => 'تیم فرانت‌اند'],
        ['id' => 2, 'name' => 'تیم بک‌اند'],
        ['id' => 3, 'name' => 'تیم دواپس (DevOps)'],
        ['id' => 4, 'name' => 'تیم محصول'],
    ];

    return view('dashboard.teams.index', ['teams' => $teams]);
});

// routes/web.php

// روت برای نمایش لیست حقوق و دستمزد
Route::get('/payrolls', function () {
    // داده‌های فیک برای لیست حقوق
    $payrolls = [
        [
            'id' => 1,
            'personnel_name' => 'پوریا نیک وند',
            'base_salary' => '۱۵۰,۰۰۰,۰۰۰',
            'seniority' => '۵,۰۰۰,۰۰۰',
            'housing' => '۱۰,۰۰۰,۰۰۰',
            'marriage' => '۰',
            'children' => '۰',
            'responsibility' => '۲۰,۰۰۰,۰۰۰',
            'food' => '۳,۰۰۰,۰۰۰',
            'informal' => '۱۰,۰۰۰,۰۰۰',
            'level' => 'سینیور ۱', // فیلد جدید
        ],
        [
            'id' => 2,
            'personnel_name' => 'سبحان فروغی',
            'base_salary' => '۱۲۰,۰۰۰,۰۰۰',
            'seniority' => '۳,۰۰۰,۰۰۰',
            'housing' => '۱۰,۰۰۰,۰۰۰',
            'marriage' => '۵,۰۰۰,۰۰۰',
            'children' => '۲,۵۰۰,۰۰۰',
            'responsibility' => '۰',
            'food' => '۳,۰۰۰,۰۰۰',
            'informal' => '۵,۰۰۰,۰۰۰',
            'level' => 'جونیور ۳', // فیلد جدید
        ],
        [
            'id' => 3,
            'personnel_name' => 'سید امین احمدی',
            'base_salary' => '۱۴۰,۰۰۰,۰۰۰',
            'seniority' => '۴,۵۰۰,۰۰۰',
            'housing' => '۱۰,۰۰۰,۰۰۰',
            'marriage' => '۰',
            'children' => '۰',
            'responsibility' => '۱۵,۰۰۰,۰۰۰',
            'food' => '۳,۰۰۰,۰۰۰',
            'informal' => '۸,۰۰۰,۰۰۰',
            'level' => 'میدلول ۲', // فیلد جدید
        ],
    ];

    return view('dashboard.payrolls.index', ['payrolls' => $payrolls]);
});

// routes/web.php

// روت برای نمایش تاریخچه تغییرات حقوق
Route::get('/payroll-history', function () {
    // داده‌های فیک برای تاریخچه
    $history_logs = [
        [
            'id' => 1,
            'date' => '۱۴۰۴/۰۵/۱۰',
            'personnel_name' => 'پوریا نیک وند',
            'change_type' => 'تغییر رده شغلی',
            'details' => 'ارتقا به سطح کارشناس ارشد.',
            'user' => 'مدیر سیستم'
        ],
        [
            'id' => 2,
            'date' => '۱۴۰۴/۰۴/۲۰',
            'personnel_name' => 'سبحان فروغی',
            'change_type' => 'تغییر حقوق',
            'details' => 'حقوق پایه از ۱۲۰,۰۰۰,۰۰۰ به ۱۴۰,۰۰۰,۰۰۰ تغییر یافت.',
            'user' => 'مدیر منابع انسانی'
        ],
    ];

    return view('dashboard.payrolls.history', ['logs' => $history_logs]);
});

require __DIR__ . '/auth.php';
