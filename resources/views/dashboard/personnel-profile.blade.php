@extends('layouts.dashboard')

@section('page_styles')
    {{-- استایل‌های قبلی حفظ شده‌اند --}}
    <link rel="stylesheet" href="{{ asset('css/pages/dashboard/personnel-profile.css') }}">
@endsection

@section('dashboard_content')
{{-- ساختار Header (از داده‌های سطح بالا استفاده می‌شود) --}}
<div class="profile-header">
    <div class="profile-main-info">
        <div class="profile-picture-wrapper">
            {{-- فراخوانی عکس --}}
            <img src="https://i.pravatar.cc/150?u={{ $employee['id'] }}" alt="عکس پروفایل" class="profile-picture">
        </div>
        <div class="profile-text-info">
            {{-- نام کامل --}}
            <h2>{{ $employee['full_name'] ?? '' }}</h2>
            {{-- سمت شغلی --}}
            <p>{{ $employee['title'] ?? '' }}</p>
            <div class="profile-contact">
                {{-- ایمیل سازمانی --}}
                <span>{{ $employee['email'] ?? '' }}</span>
                <i class="fas fa-envelope"></i>
            </div>
        </div>
    </div>
    <div class="profile-stats">
        <div class="stat-box">
            {{-- وضعیت همکاری --}}
            <h3>{{ $employee['employment_status'] ?? '' }}</h3>
            <p>وضعیت همکاری</p>
        </div>
        <div class="stat-box">
            {{-- مدت زمان همکاری --}}
            <h3>{{ $employee['employment_duration'] ?? '' }}</h3>
            <p>مدت زمان همکاری</p>
        </div>
    </div>
</div>

{{-- ساختار تب‌ها حفظ شده است --}}
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
    <form action="{{ isset($employee) ? route('employees.update', $employee['id']) : route('employees.store') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-grid">
                    {{-- فیلدهای جدید (فراخوانی از زیرمجموعه personal) --}}
                    <div class="form-group"><label for="first_name">نام</label><input type="text" id="first_name" name="first_name" value="{{ $employee['personal']['first_name'] ?? '' }}"></div>
                    <div class="form-group"><label for="last_name">نام خانوادگی</label><input type="text" id="last_name" name="last_name" value="{{ $employee['personal']['last_name'] ?? '' }}"></div>
                    {{-- فیلد موجود (فراخوانی از زیرمجموعه personal برای سازگاری) --}}
                    <div class="form-group"><label for="full_name">نام و نام خانوادگی</label><input type="text" id="full_name" name="full_name" value="{{ $employee['personal']['full_name'] ?? $employee['full_name'] ?? '' }}"></div>
                    {{-- فیلد جدید --}}
                    <div class="form-group"><label for="nickname">نام مستعار</label><input type="text" id="nickname" name="nickname" value="{{ $employee['personal']['nickname'] ?? '' }}"></div>

                    <div class="form-group"><label for="father_name">نام پدر</label><input type="text" id="father_name" name="father_name" value="{{ $employee['personal']['father_name'] ?? '' }}"></div>
                    <div class="form-group"><label for="mother_name">نام مادر</label><input type="text" id="mother_name" name="mother_name" value="{{ $employee['personal']['mother_name'] ?? '' }}"></div>
                    <div class="form-group">
                        <label for="gender">جنسیت</label>
                        <select id="gender" name="gender">
                            <option value="مرد" {{ ($employee['personal']['gender'] ?? '') == 'مرد' ? 'selected' : '' }}>مرد</option>
                            <option value="زن" {{ ($employee['personal']['gender'] ?? '') == 'زن' ? 'selected' : '' }}>زن</option>
                        </select>
                    </div>
                    <div class="form-group"><label for="national_code">کد ملی</label><input type="text" id="national_code" name="national_code" value="{{ $employee['personal']['national_code'] ?? '' }}"></div>
                    <div class="form-group"><label for="birth_cert_number">شماره شناسنامه</label><input type="text" id="birth_cert_number" name="birth_cert_number" value="{{ $employee['personal']['birth_cert_number'] ?? '' }}"></div>
                    {{-- فیلد جدید --}}
                    <div class="form-group"><label for="id_serial">سریال شناسنامه</label><input type="text" id="id_serial" name="id_serial" value="{{ $employee['personal']['id_serial'] ?? '' }}"></div>

                    <div class="form-group"><label for="birth_date">تاریخ تولد</label><input type="text" id="birth_date" name="birth_date" class="persian-datepicker" value="{{ $employee['personal']['birth_date'] ?? '' }}"></div>
                    <div class="form-group"><label for="birth_place">محل تولد</label><input type="text" id="birth_place" name="birth_place" value="{{ $employee['personal']['birth_place'] ?? '' }}"></div>
                    {{-- فیلد جدید --}}
                    <div class="form-group"><label for="id_issue_place">محل صدور شناسنامه</label><input type="text" id="id_issue_place" name="id_issue_place" value="{{ $employee['personal']['id_issue_place'] ?? '' }}"></div>

                    <div class="form-group">
                        <label for="marital_status">وضعیت تاهل</label>
                        <select id="marital_status" name="marital_status">
                            <option value="مجرد" {{ ($employee['personal']['marital_status'] ?? '') == 'مجرد' ? 'selected' : '' }}>مجرد</option>
                            <option value="متاهل" {{ ($employee['personal']['marital_status'] ?? '') == 'متاهل' ? 'selected' : '' }}>متاهل</option>
                        </select>
                    </div>
                    <div class="form-group {{ ($employee['personal']['marital_status'] ?? 'مجرد') == 'مجرد' ? 'hidden-field' : '' }}" id="marriage_date_group">
                        <label for="marriage_date">تاریخ ازدواج</label>
                        <input type="text" id="marriage_date" name="marriage_date" class="persian-datepicker" value="{{ $employee['personal']['marriage_date'] ?? '' }}">
                    </div>

                    <div class="form-group">
                        <label for="military_status">وضعیت خدمت سربازی</label>
                        <select id="military_status" name="military_status">
                            <option value="مشمول" {{ ($employee['personal']['military_status'] ?? '') == 'مشمول' ? 'selected' : '' }}>مشمول</option>
                            <option value="پایان خدمت" {{ ($employee['personal']['military_status'] ?? '') == 'پایان خدمت' ? 'selected' : '' }}>پایان خدمت</option>
                            <option value="معافیت دائم" {{ ($employee['personal']['military_status'] ?? '') == 'معافیت دائم' ? 'selected' : '' }}>معافیت دائم</option>
                            <option value="معافیت تحصیلی" {{ ($employee['personal']['military_status'] ?? '') == 'معافیت تحصیلی' ? 'selected' : '' }}>معافیت تحصیلی</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="degree">آخرین مدرک تحصیلی</label>
                        <select id="degree" name="degree">
                            <option value="دیپلم" {{ ($employee['personal']['degree'] ?? '') == 'دیپلم' ? 'selected' : '' }}>دیپلم</option>
                            <option value="فوق دیپلم" {{ ($employee['personal']['degree'] ?? '') == 'فوق دیپلم' ? 'selected' : '' }}>فوق دیپلم</option>
                            <option value="لیسانس" {{ ($employee['personal']['degree'] ?? '') == 'لیسانس' ? 'selected' : '' }}>لیسانس</option>
                            <option value="فوق لیسانس" {{ ($employee['personal']['degree'] ?? '') == 'فوق لیسانس' ? 'selected' : '' }}>فوق لیسانس</option>
                            <option value="دکتری" {{ ($employee['personal']['degree'] ?? '') == 'دکتری' ? 'selected' : '' }}>دکتری</option>
                        </select>
                    </div>
                    <div class="form-group"><label for="field_of_study">آخرین رشته تحصیلی</label><input type="text" id="field_of_study" name="field_of_study" value="{{ $employee['personal']['field_of_study'] ?? '' }}"></div>

                    <div class="form-group"><label for="phone">شماره تماس</label><input type="text" id="phone" name="phone" value="{{ $employee['personal']['phone'] ?? '' }}"></div>
                    <div class="form-group"><label for="emergency_contact">شماره تماس اضطراری</label><input type="text" id="emergency_contact" name="emergency_contact" value="{{ $employee['personal']['emergency_contact'] ?? '' }}"></div>
                    {{-- فیلد جدید --}}
                    <div class="form-group"><label for="emergency_contact_info">اطلاعات تماس اضطراری</label><input type="text" id="emergency_contact_info" name="emergency_contact_info" value="{{ $employee['personal']['emergency_contact_info'] ?? '' }}"></div>

                    <div class="form-group"><label for="home_phone">شماره تماس منزل</label><input type="text" id="home_phone" name="home_phone" value="{{ $employee['personal']['home_phone'] ?? '' }}"></div>
                    <div class="form-group"><label for="personal_email">ایمیل شخصی</label><input type="email" id="personal_email" name="personal_email" value="{{ $employee['personal']['personal_email'] ?? '' }}"></div>
                    <div class="form-group"><label for="telegram_id">آیدی تلگرام</label><input type="text" id="telegram_id" name="telegram_id" value="{{ $employee['personal']['telegram_id'] ?? '' }}"></div>
                    <div class="form-group grid-full-width"><label for="address">آدرس منزل</label><textarea id="address" name="address" rows="3">{{ $employee['personal']['address'] ?? '' }}</textarea></div>
                    <div class="form-group"><label for="postal_code">کد پستی</label><input type="text" id="postal_code" name="postal_code" value="{{ $employee['personal']['postal_code'] ?? '' }}"></div>
                </div>
                <div class="form-actions"><button type="submit" class="btn-primary">ذخیره تغییرات</button></div>
            </form>
        </div>
    </div>

    {{-- تب اطلاعات شغلی --}}
    <div id="employment-info-pane" class="tab-pane">
        <div class="profile-form-container">
            <h3 class="form-title">اطلاعات شغلی</h3>
    <form action="{{ isset($employee) ? route('employees.update', $employee['id']) : route('employees.store') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-grid">
                    {{-- فراخوانی از زیرمجموعه employment_info --}}
                    <div class="form-group"><label for="emp_department">واحد</label><input type="text" id="emp_department" name="emp_department" value="{{ $employee['employment_info']['department'] ?? '' }}"></div>
                    <div class="form-group"><label for="emp_team">تیم</label><input type="text" id="emp_team" name="emp_team" value="{{ $employee['employment_info']['team'] ?? '' }}"></div>
                    <div class="form-group"><label for="personnel_code">شماره پرسنلی</label><input type="text" id="personnel_code" name="personnel_code" value="{{ $employee['employment_info']['personnel_code'] ?? '' }}"></div>
                    <div class="form-group"><label for="job_title">سمت شغلی</label><input type="text" id="job_title" name="job_title" value="{{ $employee['employment_info']['job_title'] ?? '' }}"></div>
                    {{-- فیلد جدید --}}
                    <div class="form-group"><label for="position_chart">سمت در چارت</label><input type="text" id="position_chart" name="position_chart" value="{{ $employee['employment_info']['position_chart'] ?? '' }}"></div>

                    <div class="form-group"><label for="insurance_title">سمت در بیمه</label><input type="text" id="insurance_title" name="insurance_title" value="{{ $employee['employment_info']['insurance_title'] ?? '' }}"></div>
                    <div class="form-group"><label for="insurance_job_code">کد شغلی در بیمه</label><input type="text" id="insurance_job_code" name="insurance_job_code" value="{{ $employee['employment_info']['insurance_job_code'] ?? '' }}"></div>

                    <div class="form-group">
                        <label for="skill_level">رده مهارتی/کاری</label>
                        <select id="skill_level" name="skill_level">
                            {{-- رده مهارتی/کاری --}}
                            @php $currentLevel = $employee['employment_info']['skill_level'] ?? ''; @endphp
                            <option value="جونیور ۱" {{ $currentLevel == 'جونیور ۱' ? 'selected' : '' }}>جونیور ۱</option>
                            <option value="جونیور ۲" {{ $currentLevel == 'جونیور ۲' ? 'selected' : '' }}>جونیور ۲</option>
                            <option value="جونیور ۳" {{ $currentLevel == 'جونیور ۳' ? 'selected' : '' }}>جونیور ۳</option>
                            <option value="میدلول ۱" {{ $currentLevel == 'میدلول ۱' ? 'selected' : '' }}>میدلول ۱</option>
                            <option value="میدلول ۲" {{ $currentLevel == 'میدلول ۲' ? 'selected' : '' }}>میدلول ۲</option>
                            <option value="میدلول ۳" {{ $currentLevel == 'میدلول ۳' ? 'selected' : '' }}>میدلول ۳</option>
                            <option value="سینیور ۱" {{ $currentLevel == 'سینیور ۱' ? 'selected' : '' }}>سینیور ۱</option>
                            <option value="سینیور ۲" {{ $currentLevel == 'سینیور ۲' ? 'selected' : '' }}>سینیور ۲</option>
                            <option value="تیم لید" {{ $currentLevel == 'تیم لید' ? 'selected' : '' }}>تیم لید</option>
                            <option value="مدیر" {{ $currentLevel == 'مدیر' ? 'selected' : '' }}>مدیر</option>
                        </select>
                    </div>

                    <div class="form-group"><label for="direct_manager">مدیر مستقیم</label><input type="text" id="direct_manager" name="direct_manager" value="{{ $employee['employment_info']['direct_manager'] ?? '' }}"></div>

                    <div class="form-group">
                        <label for="cooperation_type">نوع همکاری</label>
                        @php $coopType = $employee['employment_info']['cooperation_type'] ?? ''; @endphp
                        <select id="cooperation_type" name="cooperation_type">
                            <option value="تمام وقت" {{ $coopType == 'تمام وقت' ? 'selected' : '' }}>تمام وقت</option>
                            <option value="پاره وقت" {{ $coopType == 'پاره وقت' ? 'selected' : '' }}>پاره وقت</option>
                            <option value="پروژه ای" {{ $coopType == 'پروژه ای' ? 'selected' : '' }}>پروژه ای</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="work_model">شکل همکاری</label>
                        @php $workModel = $employee['employment_info']['work_model'] ?? ''; @endphp
                        <select id="work_model" name="work_model">
                            <option value="حضوری" {{ $workModel == 'حضوری' ? 'selected' : '' }}>حضوری</option>
                            <option value="هیبرید" {{ $workModel == 'هیبرید' ? 'selected' : '' }}>هیبرید</option>
                            <option value="دورکار" {{ $workModel == 'دورکار' ? 'selected' : '' }}>دورکار</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="contract_type">نوع قرارداد</label>
                        @php $contractType = $employee['employment_info']['contract_type'] ?? ''; @endphp
                        <select id="contract_type" name="contract_type">
                            <option value="رسمی" {{ $contractType == 'رسمی' ? 'selected' : '' }}>رسمی</option>
                            <option value="غیررسمی" {{ $contractType == 'غیررسمی' ? 'selected' : '' }}>غیررسمی</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nda_type">نوع قرارداد محرمانگی</label>
                        @php $ndaType = $employee['employment_info']['nda_type'] ?? ''; @endphp
                        <select id="nda_type" name="nda_type">
                            <option value="فنی" {{ $ndaType == 'فنی' ? 'selected' : '' }}>فنی</option>
                            <option value="غیر فنی" {{ $ndaType == 'غیر فنی' ? 'selected' : '' }}>غیر فنی</option>
                        </select>
                    </div>

                    {{-- فیلد جدید --}}
                    <div class="form-group"><label for="organization_email">ایمیل سازمانی</label><input type="email" id="organization_email" name="organization_email" value="{{ $employee['employment_info']['organization_email'] ?? $employee['email'] ?? '' }}"></div>
                    
                    {{-- فیلد جدید --}}
                    <div class="form-group"><label for="contract_number">شماره قرارداد</label><input type="text" id="contract_number" name="contract_number" value="{{ $employee['employment_info']['contract_number'] ?? '' }}"></div>

                    <div class="form-group">
                        <label for="employment_status_select">وضعیت همکاری</label>
                        @php $statusSelect = $employee['employment_info']['employment_status_select'] ?? ''; @endphp
                        <select id="employment_status_select" name="employment_status_select">
                            <option value="فعال" {{ $statusSelect == 'فعال' ? 'selected' : '' }}>فعال</option>
                            <option value="پایان یافته" {{ $statusSelect == 'پایان یافته' ? 'selected' : '' }}>پایان یافته</option>
                        </select>
                    </div>

                    <div class="form-group"><label for="hire_date">تاریخ ورود به شرکت</label><input type="text" id="hire_date" name="hire_date" class="persian-datepicker" value="{{ $employee['employment_info']['hire_date'] ?? '' }}"></div>
                    {{-- فیلد جدید --}}
                    <div class="form-group"><label for="trial_start_date">تاریخ شروع دوره آزمایشی</label><input type="text" id="trial_start_date" name="trial_start_date" class="persian-datepicker" value="{{ $employee['employment_info']['trial_start_date'] ?? '' }}"></div>

                    <div class="form-group"><label for="termination_date">تاریخ خروج از شرکت</label><input type="text" id="termination_date" name="termination_date" class="persian-datepicker" value="{{ $employee['employment_info']['termination_date'] ?? '' }}"></div>
                    <div class="form-group grid-full-width"><label for="termination_reason">دلیل خروج از شرکت</label><textarea id="termination_reason" name="termination_reason" rows="3">{{ $employee['employment_info']['termination_reason'] ?? '' }}</textarea></div>
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
                    {{-- فراخوانی از زیرمجموعه financial_info --}}
                    <div class="form-group"><label for="official_bank_name">نام بانک حساب رسمی</label><input type="text" id="official_bank_name" value="{{ $employee['financial_info']['official_bank_name'] ?? '' }}"></div>
                    <div class="form-group"><label for="official_card_number">شماره کارت حساب رسمی</label><input type="text" id="official_card_number" value="{{ $employee['financial_info']['official_card_number'] ?? '' }}"></div>
                    <div class="form-group"><label for="official_account_number">شماره حساب رسمی</label><input type="text" id="official_account_number" value="{{ $employee['financial_info']['official_account_number'] ?? '' }}"></div>
                    <div class="form-group"><label for="official_iban">شماره شبا رسمی</label><input type="text" id="official_iban" value="{{ $employee['financial_info']['official_iban'] ?? '' }}"></div>
                    <div class="form-group"><label for="unofficial_bank_name">نام بانک غیررسمی</label><input type="text" id="unofficial_bank_name" value="{{ $employee['financial_info']['unofficial_bank_name'] ?? '' }}"></div>
                    <div class="form-group"><label for="unofficial_card_number">شماره کارت غیررسمی</label><input type="text" id="unofficial_card_number" value="{{ $employee['financial_info']['unofficial_card_number'] ?? '' }}"></div>
                    <div class="form-group"><label for="unofficial_account_number">شماره حساب غیررسمی</label><input type="text" id="unofficial_account_number" value="{{ $employee['financial_info']['unofficial_account_number'] ?? '' }}"></div>
                    <div class="form-group"><label for="unofficial_iban">شماره شبا غیررسمی</label><input type="text" id="unofficial_iban" value="{{ $employee['financial_info']['unofficial_iban'] ?? '' }}"></div>
                </div>
                <div class="form-actions"><button type="submit" class="btn-primary">ذخیره تغییرات</button></div>
            </form>
        </div>
    </div>
    
    {{-- تب آموزش (داده‌های سوابق) --}}
    <div id="training-pane" class="tab-pane">
        <div class="profile-form-container">
            <h3 class="form-title">سوابق دوره‌های آموزشی</h3>
            <form action="#" method="POST" enctype="multipart/form-data">
                {{-- فراخوانی از زیرمجموعه training_records --}}
                <div class="form-group"><label for="training_notes">یادداشت جدید دوره آموزشی</label><textarea id="training_notes" rows="6" placeholder="جزئیات دوره آموزشی، نمرات، بازخورد و...">{{ $employee['training_records']['notes'] ?? '' }}</textarea></div>
                <div class="file-upload-wrapper"><label for="training_attachment_file" class="btn-secondary"><i class="fas fa-paperclip"></i> پیوست مدرک یا فایل</label><input type="file" id="training_attachment_file" name="training_attachment_file" style="display: none;"><span id="training-file-name-display">هیچ فایلی انتخاب نشده است.</span></div>
                <div class="form-actions"><button type="submit" class="btn-primary">ذخیره سابقه آموزش</button></div>
            </form>
            <hr class="separator">
            <h3 class="form-title">فایل‌های پیوست شده</h3>
            <div class="attachments-list">
                @forelse($employee['training_records']['attachments'] ?? [] as $file)
                <div class="attachment-item"><div class="file-info"><i class="fas fa-certificate file-icon"></i><div class="file-details"><span class="file-name">{{ $file['name'] }}</span><span class="file-meta">{{ $file['date'] }} - {{ $file['size'] }}</span></div></div><div class="file-actions"><a href="#" class="action-icon view-icon" title="دانلود"><i class="fas fa-download"></i></a><a href="#" class="action-icon delete-icon" title="حذف"><i class="fas fa-trash"></i></a></div></div>
                @empty
                <p class="placeholder-text" style="padding: 1rem 0;">هیچ مدرک یا فایلی برای دوره‌های آموزشی ثبت نشده است.</p>
                @endforelse
            </div>
        </div>
    </div>
    
    {{-- تب مدیریت عملکرد (بدون تغییر) --}}
    <div id="performance-pane" class="tab-pane"><p class="placeholder-text">بخش مدیریت عملکرد در حال ساخت است.</p></div>

    {{-- تب سوابق پرسنلی (داده‌های سوابق) --}}
    <div id="history-pane" class="tab-pane">
        <div class="profile-form-container">
            <h3 class="form-title">یادداشت‌ها و سوابق پرسنلی</h3>
            <form action="#" method="POST" enctype="multipart/form-data">
                {{-- فراخوانی از زیرمجموعه work_history --}}
                <div class="form-group"><label for="history_notes">یادداشت جدید</label><textarea id="history_notes" rows="6" placeholder="یادداشت‌های مربوط به عملکرد، اتفاقات مهم و... را اینجا وارد کنید.">{{ $employee['work_history']['notes'] ?? '' }}</textarea></div>
                <div class="file-upload-wrapper"><label for="attachment_file" class="btn-secondary"><i class="fas fa-paperclip"></i> پیوست فایل</label><input type="file" id="attachment_file" name="attachment_file" style="display: none;"><span id="file-name-display">هیچ فایلی انتخاب نشده است.</span></div>
                <div class="form-actions"><button type="submit" class="btn-primary">ذخیره یادداشت و فایل</button></div>
            </form>
            <hr class="separator">
            <h3 class="form-title">فایل‌های پیوست شده</h3>
            <div class="attachments-list">
                @forelse($employee['work_history']['attachments'] ?? [] as $file)
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
    {{-- کتابخانه‌ها و منطق جاوا اسکریپت کاملاً حفظ شده‌اند --}}
    <script src="{{ asset('js/libs/moment.min.js') }}"></script>
    <script src="{{ asset('js/libs/moment-jalaali.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/persian-datepicker/dist/js/persian-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/persian-datepicker/dist/css/persian-datepicker.min.css"/>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // منطق مدیریت تب‌ها (بدون تغییر)
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

        // راه‌اندازی تقویم شمسی (بدون تغییر)
        $(".persian-datepicker").pDatepicker({
            format: 'YYYY/MM/DD',
            autoClose: true,
            initialValue: false
        });

        // منطق نمایش تاریخ ازدواج (اصلاح فراخوانی داده برای حفظ وضعیت)
        const maritalStatusSelect = document.getElementById('marital_status');
        const marriageDateGroup = document.getElementById('marriage_date_group');
        const initialMaritalStatus = maritalStatusSelect ? maritalStatusSelect.value : 'مجرد';
        
        if (maritalStatusSelect && marriageDateGroup) {
            
            // تابع برای اعمال وضعیت اولیه
            const updateMarriageDateVisibility = (status) => {
                if (status === 'متاهل') {
                    marriageDateGroup.classList.remove('hidden-field');
                } else {
                    // در هنگام بارگذاری صفحه، اگر وضعیت اولیه "مجرد" بود، مخفی شود.
                    marriageDateGroup.classList.add('hidden-field');
                }
            };
            
            maritalStatusSelect.addEventListener('change', function() {
                updateMarriageDateVisibility(this.value);
            });
            
            // اجرای اولیه برای حفظ وضعیت در حالت ویرایش
            updateMarriageDateVisibility(initialMaritalStatus);
        }

        // منطق نمایش نام فایل‌ها (بدون تغییر)
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