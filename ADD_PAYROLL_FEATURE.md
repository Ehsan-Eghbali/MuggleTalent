# ویژگی افزودن حقوق و دستمزد

## نگاه کلی
این ویژگی امکان افزودن حقوق و دستمزد برای کارمندانی که هنوز در لیست حقوق ثبت نشده‌اند را فراهم می‌کند.

## تغییرات انجام شده

### 1. کنترلر (PayrollController)

#### متد `index()`
- ✅ اضافه شدن دریافت لیست کارمندان بدون حقوق:
```php
$employeesWithoutPayroll = employees::whereDoesntHave('payroll')->get();
```

#### متد `store()`
- ✅ تغییر از `redirect()` به `response()->json()` برای پشتیبانی از AJAX
- ✅ اضافه شدن try-catch برای مدیریت خطاها
- ✅ برگرداندن پاسخ JSON با پیام موفقیت یا خطا

### 2. View (resources/views/dashboard/payrolls/index.blade.php)

#### Header
- ✅ اضافه شدن دکمه "افزودن" در کنار دکمه "خروجی و چاپ"
- ✅ استفاده از flexbox برای قرار دادن دکمه‌ها در کنار هم

#### Modal افزودن
- ✅ ایجاد modal جدید با ID: `add-payroll-modal`
- ✅ فیلد انتخاب کارمند (الزامی) با لیست کارمندان بدون حقوق
- ✅ فیلد رده شغلی (اختیاری)
- ✅ تمام فیلدهای حقوقی (اختیاری):
  - حقوق ۳۰ روزه
  - پایه سنوات
  - حق مسکن
  - حق تاهل
  - حق اولاد
  - حق مسئولیت
  - خوار و بار
  - غیررسمی

#### JavaScript
- ✅ مدیریت باز/بسته کردن modal افزودن
- ✅ ارسال فرم با AJAX
- ✅ نمایش پیام موفقیت/خطا
- ✅ بارگذاری مجدد صفحه پس از افزودن موفق

## نحوه استفاده

### افزودن حقوق جدید:

1. به صفحه **لیست حقوق و دستمزد** بروید (`/payrolls`)
2. روی دکمه **افزودن** (در header صفحه) کلیک کنید
3. از لیست **کارمندان**، کارمند مورد نظر را انتخاب کنید (الزامی)
4. **رده شغلی** را انتخاب کنید (اختیاری)
5. مقادیر **حقوقی** را وارد کنید (اختیاری - پیش‌فرض: 0)
6. روی دکمه **ثبت حقوق** کلیک کنید

### نکات مهم:

- ✅ فقط کارمندانی که هنوز حقوق ندارند در لیست نمایش داده می‌شوند
- ✅ انتخاب کارمند الزامی است
- ✅ سایر فیلدها اختیاری هستند و مقدار پیش‌فرض آنها صفر است
- ✅ پس از افزودن موفق، کارمند از لیست افزودن حذف می‌شود
- ✅ صفحه به صورت خودکار بارگذاری مجدد می‌شود

## ساختار Modal

### Header
```html
<h2>افزودن حقوق و دستمزد</h2>
```

### فرم
- **Method**: POST
- **Action**: `/payrolls` (route: `payrolls.store`)
- **CSRF Token**: بله

### فیلدها

| فیلد | نوع | الزامی | توضیحات |
|------|-----|--------|---------|
| employee_id | select | بله | انتخاب از لیست کارمندان بدون حقوق |
| level | select | خیر | رده شغلی (جونیور ۱ تا سینیور ۲) |
| base_salary | number | خیر | حقوق ۳۰ روزه |
| seniority | number | خیر | پایه سنوات |
| housing | number | خیر | حق مسکن |
| marriage | number | خیر | حق تاهل |
| children | number | خیر | حق اولاد |
| responsibility | number | خیر | حق مسئولیت |
| food | number | خیر | خوار و بار |
| informal | number | خیر | غیررسمی |

### دکمه‌ها
- **انصراف**: بستن modal بدون ذخیره
- **ثبت حقوق**: ارسال فرم و ذخیره اطلاعات

## API Response

### موفقیت
```json
{
    "success": true,
    "message": "حقوق با موفقیت ثبت شد."
}
```

### خطا
```json
{
    "success": false,
    "message": "خطا در ثبت حقوق: [error message]"
}
```

## Validation

در سمت سرور:
- `employee_id`: الزامی و باید در جدول employees وجود داشته باشد
- سایر فیلدها: اختیاری و باید عددی باشند

در سمت کلاینت:
- فیلد employee_id با attribute `required` علامت‌گذاری شده است

## استایل

Modal از همان کلاس‌های CSS موجود استفاده می‌کند:
- `.modal-overlay`
- `.modal-content`
- `.modal-grid`
- `.payroll-item`
- `.modal-buttons`
- `.btn-primary`
- `.btn-secondary`
- `.btn-success`

## مثال کد JavaScript

```javascript
// باز کردن modal
function openAddModal() {
    addForm.reset();
    addModal.style.display = 'flex';
}

// ارسال فرم با AJAX
addForm.addEventListener('submit', function (e) {
    e.preventDefault();
    
    const formData = new FormData(addForm);
    
    fetch('/payrolls', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('#add-payroll-form input[name="_token"]').value,
            'Accept': 'application/json',
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            closeAddModal();
            window.location.reload();
        }
    });
});
```

## تست

### سناریوهای تست:

1. ✅ **افزودن موفق**: انتخاب کارمند و وارد کردن مقادیر حقوقی
2. ✅ **بدون انتخاب کارمند**: نمایش خطای validation
3. ✅ **لیست خالی**: اگر همه کارمندان حقوق دارند، لیست خالی نمایش داده می‌شود
4. ✅ **بستن modal**: با کلیک روی X، دکمه انصراف یا خارج از modal
5. ✅ **بارگذاری مجدد**: پس از افزودن موفق، صفحه reload می‌شود

## پیشنهادات بهبود (آینده)

- [ ] اضافه کردن validation در سمت کلاینت برای فیلدهای عددی
- [ ] نمایش پیام هشدار اگر لیست کارمندان خالی باشد
- [ ] اضافه کردن قابلیت جستجو در لیست کارمندان (برای لیست‌های بزرگ)
- [ ] نمایش جمع کل حقوق در modal
- [ ] اضافه کردن loading indicator هنگام ارسال فرم

---

**تاریخ ایجاد**: 1404/08/03
**نسخه**: 1.0.0

