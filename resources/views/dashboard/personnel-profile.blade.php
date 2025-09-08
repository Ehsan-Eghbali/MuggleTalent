@extends('layouts.dashboard')

@section('page_styles')
    <link rel="stylesheet" href="{{ asset('css/pages/dashboard/personnel-profile.css') }}">
@endsection

@section('dashboard_content')
<div class="profile-header">
    <div class="profile-main-info">
        <div class="profile-picture-wrapper">
            <img src="https://i.pravatar.cc/150?u={{ $employee['id'] }}" alt="عکس پروفایل" class="profile-picture">
        </div>
        <div class="profile-text-info">
            <h2>{{ $employee['full_name'] }}</h2>
            <p>{{ $employee['title'] }}</p>
            <div class="profile-contact">
                <span>{{ $employee['email'] }}</span>
                <i class="fas fa-envelope"></i>
            </div>
        </div>
    </div>
    <div class="profile-stats">
        <div class="stat-box">
            <h3>{{ $employee['employment_status'] }}</h3>
            <p>وضعیت همکاری</p>
        </div>
        <div class="stat-box">
            <h3>{{ $employee['employment_duration'] }}</h3>
            <p>مدت زمان همکاری</p>
        </div>
    </div>
</div>

<nav class="profile-tabs">
    <a href="#" class="tab-item active" data-tab="personal-info">اطلاعات شخصی</a>
    <a href="#" class="tab-item" data-tab="employment-info">اطلاعات شغلی</a>
    <a href="#" class="tab-item" data-tab="financial-info">مدیریت مالی</a>
    <a href="#" class="tab-item" data-tab="training">آموزش</a>
    <a href="#" class="tab-item" data-tab="performance">مدیریت عملکرد</a>
    <a href="#" class="tab-item" data-tab="history">سوابق پرسنلی</a>
</nav>

<div class="profile-tab-content">
    {{-- تب اطلاعات شخصی --}}
    <div id="personal-info-pane" class="tab-pane active">
        <div class="profile-form-container">
            <h3 class="form-title">اطلاعات شخصی</h3>
            <form action="#" method="POST">
                <div class="form-grid">
                    <div class="form-group"><label for="full_name">نام و نام خانوادگی</label><input type="text" id="full_name" value="{{ $employee['full_name'] }}"></div>
                    <div class="form-group"><label for="father_name">نام پدر</label><input type="text" id="father_name" value="{{ $employee['father_name'] }}"></div>
                    <div class="form-group"><label for="mother_name">نام مادر</label><input type="text" id="mother_name" value="{{ $employee['mother_name'] }}"></div>
                    <div class="form-group"><label for="gender">جنسیت</label><select id="gender"><option value="مرد" {{ ($employee['gender'] ?? '') == 'مرد' ? 'selected' : '' }}>مرد</option><option value="زن" {{ ($employee['gender'] ?? '') == 'زن' ? 'selected' : '' }}>زن</option></select></div>
                    <div class="form-group"><label for="national_code">کد ملی</label><input type="text" id="national_code" value="{{ $employee['national_code'] }}"></div>
                    <div class="form-group"><label for="birth_cert_number">شماره شناسنامه</label><input type="text" id="birth_cert_number" value="{{ $employee['birth_cert_number'] }}"></div>
                    <div class="form-group"><label for="birth_date">تاریخ تولد</label><input type="text" id="birth_date" class="persian-datepicker" value="{{ $employee['birth_date'] }}"></div>
                    <div class="form-group"><label for="birth_place">محل تولد</label><input type="text" id="birth_place" value="{{ $employee['birth_place'] }}"></div>
                    <div class="form-group"><label for="marital_status">وضعیت تاهل</label><select id="marital_status"><option value="مجرد" {{ $employee['marital_status'] == 'مجرد' ? 'selected' : '' }}>مجرد</option><option value="متاهل" {{ $employee['marital_status'] == 'متاهل' ? 'selected' : '' }}>متاهل</option></select></div>
                    <div class="form-group {{ $employee['marital_status'] == 'مجرد' ? 'hidden-field' : '' }}" id="marriage_date_group"><label for="marriage_date">تاریخ ازدواج</label><input type="text" id="marriage_date" class="persian-datepicker" value="{{ $employee['marriage_date'] ?? '' }}"></div>
                    <div class="form-group"><label for="military_status">وضعیت خدمت سربازی</label><select id="military_status"><option>مشمول</option><option selected>پایان خدمت</option><option>معافیت دائم</option><option>معافیت تحصیلی</option></select></div>
                    <div class="form-group"><label for="degree">آخرین مدرک تحصیلی</label><select id="degree"><option>دیپلم</option><option>فوق دیپلم</option><option>لیسانس</option><option selected>فوق لیسانس</option><option>دکتری</option></select></div>
                    <div class="form-group"><label for="field_of_study">آخرین رشته تحصیلی</label><input type="text" id="field_of_study" value="{{ $employee['field_of_study'] ?? '' }}"></div>
                    <div class="form-group"><label for="phone">شماره تماس</label><input type="text" id="phone" value="{{ $employee['phone'] }}"></div>
                    <div class="form-group"><label for="emergency_contact">شماره تماس اضطراری</label><input type="text" id="emergency_contact" value="{{ $employee['emergency_contact'] }}"></div>
                    <div class="form-group"><label for="home_phone">شماره تماس منزل</label><input type="text" id="home_phone" value="{{ $employee['home_phone'] }}"></div>
                    <div class="form-group"><label for="personal_email">ایمیل شخصی</label><input type="email" id="personal_email" value="{{ $employee['personal_email'] }}"></div>
                    <div class="form-group"><label for="telegram_id">آیدی تلگرام</label><input type="text" id="telegram_id" value="{{ $employee['telegram_id'] }}"></div>
                    <div class="form-group grid-full-width"><label for="address">آدرس منزل</label><textarea id="address" rows="3">{{ $employee['address'] }}</textarea></div>
                    <div class="form-group"><label for="postal_code">کد پستی</label><input type="text" id="postal_code" value="{{ $employee['postal_code'] }}"></div>
                </div>
                <div class="form-actions"><button type="submit" class="btn-primary">ذخیره تغییرات</button></div>
            </form>
        </div>
    </div>

    {{-- تب اطلاعات شغلی --}}
    <div id="employment-info-pane" class="tab-pane">
        <div class="profile-form-container">
            <h3 class="form-title">اطلاعات شغلی</h3>
            <form action="#" method="POST">
                <div class="form-grid">
                    <div class="form-group"><label for="emp_department">واحد</label><input type="text" id="emp_department" value="{{ $employee['employment_info']['department'] }}"></div>
                    <div class="form-group"><label for="emp_team">تیم</label><input type="text" id="emp_team" value="{{ $employee['employment_info']['team'] }}"></div>
                    <div class="form-group"><label for="personnel_code">شماره پرسنلی</label><input type="text" id="personnel_code" value="{{ $employee['employment_info']['personnel_code'] }}"></div>
                    <div class="form-group"><label for="job_title">سمت شغلی</label><input type="text" id="job_title" value="{{ $employee['employment_info']['job_title'] }}"></div>
                    <div class="form-group"><label for="insurance_title">سمت در بیمه</label><input type="text" id="insurance_title" value="{{ $employee['employment_info']['insurance_title'] }}"></div>
                    <div class="form-group"><label for="insurance_job_code">کد شغلی در بیمه</label><input type="text" id="insurance_job_code" value="{{ $employee['employment_info']['insurance_job_code'] }}"></div>
                    <div class="form-group"><label for="skill_level">رده مهارتی</label><select id="skill_level"><option>جونیور ۱</option><option>جونیور ۲</option><option>جونیور ۳</option><option>میدلول ۱</option><option>میدلول ۲</option><option>میدلول ۳</option><option selected>سینیور ۱</option><option>سینیور ۲</option></select></div>
                    <div class="form-group"><label for="direct_manager">مدیر مستقیم</label><input type="text" id="direct_manager" value="{{ $employee['employment_info']['direct_manager'] }}"></div>
                    <div class="form-group"><label for="cooperation_type">نوع همکاری</label><select id="cooperation_type"><option>تمام وقت</option><option>پاره وقت</option><option>پروژه ای</option></select></div>
                    <div class="form-group"><label for="work_model">شکل همکاری</label><select id="work_model"><option>حضوری</option><option selected>هیبرید</option><option>دورکار</option></select></div>
                    <div class="form-group"><label for="contract_type">نوع قرارداد</label><select id="contract_type"><option selected>رسمی</option><option>غیررسمی</option></select></div>
                    <div class="form-group"><label for="nda_type">نوع قرارداد محرمانگی</label><select id="nda_type"><option selected>فنی</option><option>غیر فنی</option></select></div>
                    <div class="form-group"><label for="employment_status_select">وضعیت همکاری</label><select id="employment_status_select"><option>فعال</option><option>پایان یافته</option></select></div>
                    <div class="form-group"><label for="hire_date">تاریخ ورود به شرکت</label><input type="text" id="hire_date" class="persian-datepicker" value="{{ $employee['employment_info']['hire_date'] }}"></div>
                    <div class="form-group"><label for="termination_date">تاریخ خروج از شرکت</label><input type="text" id="termination_date" class="persian-datepicker" value="{{ $employee['employment_info']['termination_date'] }}"></div>
                    <div class="form-group grid-full-width"><label for="termination_reason">دلیل خروج از شرکت</label><textarea id="termination_reason" rows="3">{{ $employee['employment_info']['termination_reason'] }}</textarea></div>
                </div>
                <div class="form-actions"><button type="submit" class="btn-primary">ذخیره تغییرات</button></div>
            </form>
        </div>
    </div>
    
    {{-- تب مدیریت مالی --}}
    <div id="financial-info-pane" class="tab-pane">
        <div class="profile-form-container">
            <h3 class="form-title">اطلاعات حساب‌های بانکی</h3>
            <form action="#" method="POST">
                <div class="form-grid">
                    <div class="form-group"><label for="official_bank_name">نام بانک حساب رسمی</label><input type="text" id="official_bank_name" value="{{ $employee['financial_info']['official_bank_name'] }}"></div>
                    <div class="form-group"><label for="official_card_number">شماره کارت حساب رسمی</label><input type="text" id="official_card_number" value="{{ $employee['financial_info']['official_card_number'] }}"></div>
                    <div class="form-group"><label for="official_account_number">شماره حساب رسمی</label><input type="text" id="official_account_number" value="{{ $employee['financial_info']['official_account_number'] }}"></div>
                    <div class="form-group"><label for="official_iban">شماره شبا رسمی</label><input type="text" id="official_iban" value="{{ $employee['financial_info']['official_iban'] }}"></div>
                    <div class="form-group"><label for="unofficial_bank_name">نام بانک غیررسمی</label><input type="text" id="unofficial_bank_name" value="{{ $employee['financial_info']['unofficial_bank_name'] }}"></div>
                    <div class="form-group"><label for="unofficial_card_number">شماره کارت غیررسمی</label><input type="text" id="unofficial_card_number" value="{{ $employee['financial_info']['unofficial_card_number'] }}"></div>
                    <div class="form-group"><label for="unofficial_account_number">شماره حساب غیررسمی</label><input type="text" id="unofficial_account_number" value="{{ $employee['financial_info']['unofficial_account_number'] }}"></div>
                    <div class="form-group"><label for="unofficial_iban">شماره شبا غیررسمی</label><input type="text" id="unofficial_iban" value="{{ $employee['financial_info']['unofficial_iban'] }}"></div>
                </div>
                <div class="form-actions"><button type="submit" class="btn-primary">ذخیره تغییرات</button></div>
            </form>
        </div>
    </div>
    
    {{-- تب آموزش --}}
    <div id="training-pane" class="tab-pane">
        <div class="profile-form-container">
            <h3 class="form-title">سوابق دوره‌های آموزشی</h3>
            <form action="#" method="POST" enctype="multipart/form-data">
                <div class="form-group"><label for="training_notes">یادداشت جدید دوره آموزشی</label><textarea id="training_notes" rows="6" placeholder="جزئیات دوره آموزشی، نمرات، بازخورد و...">{{ $employee['training_records']['notes'] }}</textarea></div>
                <div class="file-upload-wrapper"><label for="training_attachment_file" class="btn-secondary"><i class="fas fa-paperclip"></i> پیوست مدرک یا فایل</label><input type="file" id="training_attachment_file" name="training_attachment_file" style="display: none;"><span id="training-file-name-display">هیچ فایلی انتخاب نشده است.</span></div>
                <div class="form-actions"><button type="submit" class="btn-primary">ذخیره سابقه آموزش</button></div>
            </form>
            <hr class="separator">
            <h3 class="form-title">فایل‌های پیوست شده</h3>
            <div class="attachments-list">
                @forelse($employee['training_records']['attachments'] as $file)
                <div class="attachment-item"><div class="file-info"><i class="fas fa-certificate file-icon"></i><div class="file-details"><span class="file-name">{{ $file['name'] }}</span><span class="file-meta">{{ $file['date'] }} - {{ $file['size'] }}</span></div></div><div class="file-actions"><a href="#" class="action-icon view-icon" title="دانلود"><i class="fas fa-download"></i></a><a href="#" class="action-icon delete-icon" title="حذف"><i class="fas fa-trash"></i></a></div></div>
                @empty
                <p class="placeholder-text" style="padding: 1rem 0;">هیچ مدرک یا فایلی برای دوره‌های آموزشی ثبت نشده است.</p>
                @endforelse
            </div>
        </div>
    </div>
    
    {{-- تب مدیریت عملکرد --}}
    <div id="performance-pane" class="tab-pane"><p class="placeholder-text">بخش مدیریت عملکرد در حال ساخت است.</p></div>

    {{-- تب سوابق پرسنلی --}}
    <div id="history-pane" class="tab-pane">
        <div class="profile-form-container">
            <h3 class="form-title">یادداشت‌ها و سوابق پرسنلی</h3>
            <form action="#" method="POST" enctype="multipart/form-data">
                <div class="form-group"><label for="history_notes">یادداشت جدید</label><textarea id="history_notes" rows="6" placeholder="یادداشت‌های مربوط به عملکرد، اتفاقات مهم و... را اینجا وارد کنید.">{{ $employee['work_history']['notes'] }}</textarea></div>
                <div class="file-upload-wrapper"><label for="attachment_file" class="btn-secondary"><i class="fas fa-paperclip"></i> پیوست فایل</label><input type="file" id="attachment_file" name="attachment_file" style="display: none;"><span id="file-name-display">هیچ فایلی انتخاب نشده است.</span></div>
                <div class="form-actions"><button type="submit" class="btn-primary">ذخیره یادداشت و فایل</button></div>
            </form>
            <hr class="separator">
            <h3 class="form-title">فایل‌های پیوست شده</h3>
            <div class="attachments-list">
                @forelse($employee['work_history']['attachments'] as $file)
                <div class="attachment-item"><div class="file-info"><i class="fas fa-file-alt file-icon"></i><div class="file-details"><span class="file-name">{{ $file['name'] }}</span><span class="file-meta">{{ $file['date'] }} - {{ $file['size'] }}</span></div></div><div class="file-actions"><a href="#" class="action-icon view-icon" title="دانلود"><i class="fas fa-download"></i></a><a href="#" class="action-icon delete-icon" title="حذف"><i class="fas fa-trash"></i></a></div></div>
                @empty
                <p class="placeholder-text" style="padding: 1rem 0;">هیچ فایلی پیوست نشده است.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    {{-- کتابخانه تقویم شمسی --}}
    <script src="{{ asset('js/libs/moment.min.js') }}"></script>
    <script src="{{ asset('js/libs/moment-jalaali.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/persian-datepicker/dist/js/persian-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/persian-datepicker/dist/css/persian-datepicker.min.css"/>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // منطق مدیریت تب‌ها
        const tabs = document.querySelectorAll('.tab-item');
        const panes = document.querySelectorAll('.tab-pane');
        tabs.forEach(tab => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();
                tabs.forEach(item => item.classList.remove('active'));
                panes.forEach(pane => pane.classList.remove('active'));
                this.classList.add('active');
                const targetPaneId = this.dataset.tab + '-pane';
                document.getElementById(targetPaneId).classList.add('active');
            });
        });

        // راه‌اندازی تقویم شمسی
        $(".persian-datepicker").pDatepicker({
            format: 'YYYY/MM/DD',
            autoClose: true,
            initialValue: false
        });

        // منطق نمایش تاریخ ازدواج
        const maritalStatusSelect = document.getElementById('marital_status');
        const marriageDateGroup = document.getElementById('marriage_date_group');
        if (maritalStatusSelect && marriageDateGroup) {
            maritalStatusSelect.addEventListener('change', function() {
                if (this.value === 'متاهل') {
                    marriageDateGroup.classList.remove('hidden-field');
                } else {
                    marriageDateGroup.classList.add('hidden-field');
                }
            });
        }

        // منطق نمایش نام فایل‌ها
        function setupFileInput(inputId, displayId) {
            const fileInput = document.getElementById(inputId);
            const fileNameDisplay = document.getElementById(displayId);
            if (fileInput && fileNameDisplay) {
                fileInput.addEventListener('change', function() {
                    if (this.files.length > 0) {
                        fileNameDisplay.textContent = this.files[0].name;
                    } else {
                        fileNameDisplay.textContent = 'هیچ فایلی انتخاب نشده است.';
                    }
                });
            }
        }
        setupFileInput('attachment_file', 'file-name-display');
        setupFileInput('training_attachment_file', 'training-file-name-display');
    });
    </script>
@endsection