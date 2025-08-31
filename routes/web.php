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
    Route::resource('employees', EmployeeController::class);
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

// این روت برای نمایش لیست همکاران است و داده‌ها را به ویو می‌فرستد.
Route::get('/personnel-list', function () {
    $personnel = [
        ['id' => '۰۰۰۱', 'code' => '۹۴۰۴۰', 'name' => 'سبحان', 'family' => 'فروغی دهنوی', 'email' => 'soleimanforoughi@gmail.com', 'birth_date' => 'نامشخص', 'job' => 'نامشخص', 'status' => 'نامشخص', 'phone' => '۰۹۱۳۶۵۶۵۸۴۶'],
        ['id' => '۰۰۰۲', 'code' => '۰۰۴۵', 'name' => 'سید امین', 'family' => 'احمدی علوی آبادی', 'email' => 'aminorangereev@gmail.com', 'birth_date' => 'نامشخص', 'job' => 'نامشخص', 'status' => 'در حال همکاری', 'phone' => '۰۹۴۵۴۷۵۲۴۵'],
        ['id' => '۰۰۰۳', 'code' => '۰۰۶۵', 'name' => 'سید عباس', 'family' => 'حسینی', 'email' => 'a.hosseini.s.s@gmail.com', 'birth_date' => 'نامشخص', 'job' => 'نامشخص', 'status' => 'پایان همکاری', 'phone' => '۰۹۵۵۶۴۸۹۳۹۰'],
        ['id' => '۰۰۰۴', 'code' => '۰۰۵۲', 'name' => 'حسین', 'family' => 'امیرخانی', 'email' => 'amirkhani@qpm.ac.ir', 'birth_date' => '۳۹۴-۰۸-۲۷', 'job' => 'فنی', 'status' => 'پایان همکاری', 'phone' => '۰۹۳۲۱۴۲۱۴۲'],
    ];
    return view('dashboard.personnel-list', ['personnel_list' => $personnel]);
});

// این روت جدید برای نمایش پروفایل کارمندان است
Route::get('/personnel/{id}', function ($id) {
    // در اینجا می‌توانید بر اساس ID، داده‌های واقعی کارمند را از دیتابیس بگیرید
    $employee = [
        'id' => $id,
        'full_name' => 'پوریا نیک وند',
        'title' => 'برنامه نویس تحلیل داده',
        'email' => 'p.nikvand@tapsell.ir',
        'phone' => '+۹۸۹۱۲۳۴۵۶۷۸۹',
        'national_code' => '۱۴۳۵۴۶۷۵۶۸',
        'birth_date' => '۱۳۷۰/۰۲/۰۱',
        'family_name' => 'نیک وند',
        'birth_place' => 'تهران',
        'birth_cert_number' => '۳۴۵۶۷',
        'college_name' => 'دانشگاه صنعتی شریف',
        'last_degree' => 'کارشناسی ارشد',
        'employment_status' => 'فعال',
        'employment_duration' => '۱۰ ماه',
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

require __DIR__.'/auth.php';
