# مستندات سیستم مدیریت حقوق و دستمزد

## نگاه کلی

این سیستم امکان مدیریت حقوق و دستمزد کارمندان را به همراه ثبت کامل تاریخچه تغییرات فراهم می‌کند.

## ویژگی‌های اصلی

### 1. مدیریت حقوق و دستمزد
- نمایش لیست حقوق و دستمزد تمام کارمندان
- مشاهده جزئیات حقوق هر کارمند
- ویرایش اطلاعات حقوق

### 2. ثبت تاریخچه تغییرات
- **ثبت خودکار تغییرات**: هر بار که حقوق یک کارمند ویرایش می‌شود، یک رکورد در تاریخچه ثبت می‌گردد
- **نگهداری مقادیر قبل و بعد**: هم مقادیر قدیمی و هم مقادیر جدید ذخیره می‌شوند
- **ثبت علت تغییر**: کاربر باید علت تغییر را انتخاب کند (الزامی)
- **جزئیات تغییر**: امکان نوشتن توضیحات اضافی (اختیاری)
- **ثبت کاربر**: کاربری که تغییر را انجام داده ثبت می‌شود

### 3. مشاهده تاریخچه
- نمایش لیست کامل تاریخچه تغییرات
- جستجو بر اساس نام یا کد پرسنلی
- نمایش تاریخ، نام پرسنل، نوع تغییر، شرح تغییرات و نام کاربری که تغییر را ثبت کرده

## ساختار دیتابیس

### جدول `payrolls`
ذخیره اطلاعات حقوق فعلی هر کارمند:

| فیلد | نوع | توضیحات |
|------|-----|---------|
| id | bigint | شناسه یکتا |
| employee_id | bigint | شناسه کارمند (Foreign Key) |
| level | string | رده شغلی |
| base_salary | decimal | حقوق ۳۰ روزه |
| seniority | decimal | پایه سنوات |
| housing | decimal | حق مسکن |
| marriage | decimal | حق تاهل |
| children | decimal | حق اولاد |
| responsibility | decimal | حق مسئولیت |
| food | decimal | خوار و بار |
| informal | decimal | غیررسمی |
| created_at | timestamp | تاریخ ایجاد |
| updated_at | timestamp | تاریخ آخرین به‌روزرسانی |

### جدول `payroll_history`
ذخیره تاریخچه تمام تغییرات:

| فیلد | نوع | توضیحات |
|------|-----|---------|
| id | bigint | شناسه یکتا |
| payroll_id | bigint | شناسه حقوق (Foreign Key) |
| employee_id | bigint | شناسه کارمند (Foreign Key) |
| user_id | bigint | شناسه کاربر که تغییر را ثبت کرده (Foreign Key) |
| old_level | string | رده شغلی قبلی |
| old_base_salary | decimal | حقوق ۳۰ روزه قبلی |
| old_seniority | decimal | پایه سنوات قبلی |
| ... | ... | سایر فیلدهای old_* |
| new_level | string | رده شغلی جدید |
| new_base_salary | decimal | حقوق ۳۰ روزه جدید |
| new_seniority | decimal | پایه سنوات جدید |
| ... | ... | سایر فیلدهای new_* |
| change_reason | string | علت تغییر (الزامی) |
| change_details | text | جزئیات تغییر (اختیاری) |
| created_at | timestamp | تاریخ ثبت تغییر |
| updated_at | timestamp | تاریخ آخرین به‌روزرسانی |

## مدل‌ها

### Payroll Model
- **رابطه با Employee**: belongsTo
- **رابطه با PayrollHistory**: hasMany
- **فیلدهای قابل پر شدن (fillable)**: تمام فیلدهای حقوقی

### PayrollHistory Model
- **رابطه با Payroll**: belongsTo
- **رابطه با Employee**: belongsTo
- **رابطه با User**: belongsTo
- **فیلدهای قابل پر شدن**: تمام فیلدهای تاریخچه

## کنترلر (PayrollController)

### متدها:

#### `index()`
نمایش لیست حقوق و دستمزد تمام کارمندان
- **Route**: GET `/payrolls`
- **View**: `dashboard.payrolls.index`

#### `store(Request $request)`
ایجاد رکورد حقوق جدید
- **Route**: POST `/payrolls`
- **Validation**: تمام فیلدها اختیاری به جز employee_id

#### `update(Request $request, $id)`
به‌روزرسانی حقوق و ثبت لاگ در تاریخچه
- **Route**: PUT `/payrolls/{id}`
- **Validation**: 
  - `change_reason` الزامی است
  - `change_details` اختیاری است
- **عملکرد**:
  1. ذخیره مقادیر فعلی (قبل از تغییر)
  2. به‌روزرسانی حقوق
  3. ایجاد رکورد جدید در payroll_history
  4. ثبت user_id کاربر لاگین شده
- **Response**: JSON با پیام موفقیت یا خطا

#### `history(Request $request)`
نمایش تاریخچه تغییرات
- **Route**: GET `/payroll-history`
- **View**: `dashboard.payrolls.history`
- **قابلیت جستجو**: بر اساس نام یا کد پرسنلی

#### `destroy($id)`
حذف رکورد حقوق
- **Route**: DELETE `/payrolls/{id}`

## Routes

```php
Route::middleware('auth')->group(function () {
    Route::get('/payrolls', [PayrollController::class, 'index'])->name('payrolls.index');
    Route::post('/payrolls', [PayrollController::class, 'store'])->name('payrolls.store');
    Route::put('/payrolls/{id}', [PayrollController::class, 'update'])->name('payrolls.update');
    Route::delete('/payrolls/{id}', [PayrollController::class, 'destroy'])->name('payrolls.destroy');
    Route::get('/payroll-history', [PayrollController::class, 'history'])->name('payrolls.history');
});
```

## نحوه استفاده

### 1. ویرایش حقوق

1. به صفحه **لیست حقوق و دستمزد** بروید (`/payrolls`)
2. روی آیکون **ویرایش** (مداد) کلیک کنید
3. مقادیر مورد نظر را تغییر دهید
4. **علت تغییر** را از لیست انتخاب کنید (الزامی):
   - تغییر رده شغلی
   - تغییر حقوق
   - افزایش سالانه
   - تغییر وضعیت
5. در صورت نیاز **جزئیات تغییر** را بنویسید (اختیاری)
6. روی دکمه **ذخیره تغییرات** کلیک کنید

### 2. مشاهده تاریخچه

1. به صفحه **تاریخچه تغییرات حقوق و دستمزد** بروید (`/payroll-history`)
2. می‌توانید بر اساس نام یا کد پرسنلی جستجو کنید
3. لیست تمام تغییرات به همراه:
   - تاریخ ثبت
   - نام پرسنل
   - نوع تغییر
   - شرح تغییرات
   - نام کاربری که تغییر را ثبت کرده

## نصب و راه‌اندازی

### 1. اجرای Migrations

```bash
php artisan migrate
```

این دستور دو جدول زیر را ایجاد می‌کند:
- `payrolls`
- `payroll_history`

### 2. اجرای Seeder (اختیاری)

برای ایجاد داده‌های نمونه:

```bash
php artisan db:seed --class=PayrollSeeder
```

این Seeder یک کارمند نمونه و حقوق او را ایجاد می‌کند.

## ویژگی‌های امنیتی

- **Authentication**: تمام روت‌ها در گروه middleware `auth` قرار دارند
- **CSRF Protection**: فرم‌ها از CSRF token استفاده می‌کنند
- **Transaction**: تغییرات در یک Transaction اجرا می‌شوند تا از یکپارچگی داده‌ها اطمینان حاصل شود
- **Foreign Key Constraints**: روابط با Cascade Delete محافظت شده‌اند

## نکات مهم

1. **علت تغییر الزامی است**: هنگام ویرایش حقوق، انتخاب علت تغییر الزامی است
2. **ثبت خودکار لاگ**: نیازی به ثبت دستی لاگ نیست، سیستم به صورت خودکار تغییرات را ثبت می‌کند
3. **حفظ تاریخچه کامل**: حتی اگر حقوق حذف شود، تاریخچه آن حفظ می‌شود (به دلیل `nullable` بودن foreign key ها)
4. **نمایش فرمت شده**: مقادیر حقوق با کاما نمایش داده می‌شوند برای خوانایی بهتر

## مثال استفاده از API

### ویرایش حقوق با JavaScript

```javascript
const formData = new FormData();
formData.append('_method', 'PUT');
formData.append('level', 'سینیور ۲');
formData.append('base_salary', '180000000');
formData.append('change_reason', 'افزایش سالانه');
formData.append('change_details', 'افزایش حقوق سالانه بر اساس ارزیابی عملکرد');

fetch('/payrolls/1', {
    method: 'POST',
    headers: {
        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
        'Accept': 'application/json',
    },
    body: formData
})
.then(response => response.json())
.then(data => {
    if (data.success) {
        console.log(data.message);
        // تغییرات با موفقیت ذخیره شد و در تاریخچه ثبت گردید.
    }
});
```

## پشتیبانی

در صورت بروز مشکل یا نیاز به راهنمایی بیشتر، لطفاً به تیم توسعه مراجعه کنید.

---

**تاریخ ایجاد**: 1404/08/03
**نسخه**: 1.0.0

