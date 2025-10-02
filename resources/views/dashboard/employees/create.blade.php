@extends('layouts.dashboard')

@section('page_styles')
    <link rel="stylesheet" href="{{ asset('css/pages/dashboard/employee-form.css') }}">
@endsection

@section('dashboard_content')
<div class="page-header">
    <h1>
        <i class="fas {{ isset($employee) ? 'fa-user-edit' : 'fa-user-plus' }} page-icon"></i>
        {{ isset($employee) ? 'ویرایش اطلاعات: ' . $employee->full_name : 'افزودن همکار جدید' }}
    </h1>
    <a href="{{ route('employees.index') }}" class="btn-secondary"><i class="fas fa-arrow-left"></i> بازگشت به لیست</a>
</div>

<div class="form-container-wrapper">
    <form action="{{ isset($employee) ? route('employees.update', $employee->id) : route('employees.store') }}" method="POST">
        @csrf
        @if(isset($employee))
            @method('PUT')
        @endif

        {{-- Employee Main Information --}}
        <div class="card">
            <div class="card-header">اطلاعات اصلی</div>
            <div class="card-body">
                <div class="form-grid">
                    <div class="form-group">
                        <label>شماره پرسنلی</label>
                        <input type="text" name="employee_number" value="{{ old('employee_number', $employee->employee_number ?? '') }}" required>
                    </div>
                    <div class="form-group">
                        <label>نام</label>
                        <input type="text" name="first_name" value="{{ old('first_name', $employee->first_name ?? '') }}" required>
                    </div>
                    <div class="form-group">
                        <label>نام خانوادگی</label>
                        <input type="text" name="last_name" value="{{ old('last_name', $employee->last_name ?? '') }}" required>
                    </div>
                    <div class="form-group">
                        <label>نام و نام خانوادگی</label>
                        <input type="text" name="full_name" value="{{ old('full_name', $employee->full_name ?? '') }}" required>
                    </div>
                    <div class="form-group">
                        <label>نام مستعار</label>
                        <input type="text" name="nickname" value="{{ old('nickname', $employee->nickname ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label>سمت شغلی</label>
                        <input type="text" name="position_chart" value="{{ old('position_chart', $employee->position_chart ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label>تیم</label>
                        <input type="text" name="team" value="{{ old('team', $employee->team ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label>واحد</label>
                        <input type="text" name="department" value="{{ old('department', $employee->department ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label>مدیر مستقیم</label>
                        <input type="text" name="direct_manager" value="{{ old('direct_manager', $employee->direct_manager ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label for="job_level">رده کاری</label>
                        <input type="text" name="job_level" value="{{ old('job_level', $employee->job_level ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label for="contract_type">نوع قرارداد</label>
                        <select name="contract_type" id="contract_type">
                            <option value="">-- انتخاب کنید --</option>
                            <option value="دورکاری" @if(old('contract_type', $employee->contract_type ?? '') == 'دورکاری') selected @endif>دورکاری</option>
                            <option value="کارآموزی" @if(old('contract_type', $employee->contract_type ?? '') == 'کارآموزی') selected @endif>کارآموزی</option>
                            <option value="آزمایشی" @if(old('contract_type', $employee->contract_type ?? '') == 'آزمایشی') selected @endif>آزمایشی</option>
                            <option value="تمام وقت" @if(old('contract_type', $employee->contract_type ?? '') == 'تمام وقت') selected @endif>تمام وقت</option>
                            <option value="پاره وقت" @if(old('contract_type', $employee->contract_type ?? '') == 'پاره وقت') selected @endif>پاره وقت</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="work_status">شکل همکاری</label>
                        <select name="work_status" id="work_status">
                            <option value="">-- انتخاب کنید --</option>
                            <option value="حضوری" @if(old('work_status', $employee->work_status ?? '') == 'حضوری') selected @endif>حضوری</option>
                            <option value="دورکار" @if(old('work_status', $employee->work_status ?? '') == 'دورکار') selected @endif>دورکار</option>
                            <option value="هیبریدی" @if(old('work_status', $employee->work_status ?? '') == 'هیبریدی') selected @endif>هیبریدی</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="formality">نوع همکاری</label>
                        <select name="formality" id="formality">
                            <option value="">-- انتخاب کنید --</option>
                            <option value="رسمی" @if(old('formality', $employee->formality ?? '') == 'رسمی') selected @endif>رسمی</option>
                            <option value="غیررسمی" @if(old('formality', $employee->formality ?? '') == 'غیررسمی') selected @endif>غیررسمی</option>
                        </select>
                    </div>
                     <div class="form-group">
                        <label>شماره همراه</label>
                        <input type="text" name="phone_number" value="{{ old('phone_number', $employee->phone_number ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label>ایمیل شخصی</label>
                        <input type="email" name="email" value="{{ old('email', $employee->email ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label>ایمیل سازمانی</label>
                        <input type="email" name="organization_email" value="{{ old('organization_email', $employee->organization_email ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label for="gender">جنسیت</label>
                        <select name="gender" id="gender">
                            <option value="">-- انتخاب کنید --</option>
                            <option value="مرد" @if(old('gender', $employee->gender ?? '') == 'مرد') selected @endif>مرد</option>
                            <option value="زن" @if(old('gender', $employee->gender ?? '') == 'زن') selected @endif>زن</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        {{-- Personal Information --}}
        <div class="card">
            <div class="card-header">اطلاعات شخصی</div>
            <div class="card-body">
                <div class="form-grid">
                    <div class="form-group">
                        <label>نام پدر</label>
                        <input type="text" name="father_name" value="{{ old('father_name', $employee->personal->father_name ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label>نام مادر</label>
                        <input type="text" name="mother_name" value="{{ old('mother_name', $employee->personal->mother_name ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label>کد ملی</label>
                        <input type="text" name="national_code" value="{{ old('national_code', $employee->personal->national_code ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label>شماره شناسنامه</label>
                        <input type="text" name="id_number" value="{{ old('id_number', $employee->personal->id_number ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label>سریال شناسنامه</label>
                        <input type="text" name="id_serial" value="{{ old('id_serial', $employee->personal->id_serial ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label>محل تولد</label>
                        <input type="text" name="birthplace" value="{{ old('birthplace', $employee->personal->birthplace ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label>محل صدور شناسنامه</label>
                        <input type="text" name="id_issue_place" value="{{ old('id_issue_place', $employee->personal->id_issue_place ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label>تاریخ تولد شمسی</label>
                        <input type="text" name="birth_date_shamsi" value="{{ old('birth_date_shamsi', $employee->personal->birth_date_shamsi ?? '') }}" placeholder="YYYY/MM/DD">
                    </div>

                </div>
            </div>
        </div>

        {{-- Address Information --}}
        <div class="card">
            <div class="card-header">آدرس و اطلاعات تماس</div>
            <div class="card-body">
                <div class="form-grid">
                    <div class="form-group">
                        <label>تلفن منزل</label>
                        <input type="text" name="home_phone" value="{{ old('home_phone', $employee->address->home_phone ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label>کد پستی</label>
                        <input type="text" name="postal_code" value="{{ old('postal_code', $employee->address->postal_code ?? '') }}">
                    </div>
                     <div class="form-group">
                        <label>شماره تماس اضطراری</label>
                        <input type="text" name="emergency_phone" value="{{ old('emergency_phone', $employee->address->emergency_phone ?? '') }}">
                    </div>
                     <div class="form-group">
                        <label>اطلاعات تماس اضطراری</label>
                        <input type="text" name="emergency_contact_info" value="{{ old('emergency_contact_info', $employee->address->emergency_contact_info ?? '') }}">
                    </div>
                    <div class="form-group form-group-full">
                        <label>آدرس منزل</label>
                        <textarea name="home_address">{{ old('home_address', $employee->address->home_address ?? '') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- Contract Information --}}
        <div class="card">
            <div class="card-header">اطلاعات قرارداد</div>
            <div class="card-body">
                <div class="form-grid">
                    <div class="form-group">
                        <label>شماره قرارداد</label>
                        <input type="text" name="contract_number" value="{{ old('contract_number', $employee->contract->contract_number ?? '') }}">
                    </div>
                     <div class="form-group">
                        <label>تاریخ شروع همکاری</label>
                        <input type="date" name="entry_date" value="{{ old('entry_date', $employee->contract->entry_date ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label>تاریخ شروع دوره آزمایشی</label>
                        <input type="date" name="trial_start_date" value="{{ old('trial_start_date', $employee->contract->trial_start_date ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label for="cooperation_status">وضعیت همکاری</label>
                        <select name="cooperation_status" id="cooperation_status">
                             <option value="">-- انتخاب کنید --</option>
                             <option value="فعال" @if(old('cooperation_status', $employee->contract->cooperation_status ?? '') == 'فعال') selected @endif>فعال</option>
                             <option value="پاره وقت" @if(old('cooperation_status', $employee->contract->cooperation_status ?? '') == 'پاره وقت') selected @endif>پاره وقت</option>
                             <option value="تمام وقت" @if(old('cooperation_status', $employee->contract->cooperation_status ?? '') == 'تمام وقت') selected @endif>تمام وقت</option>
                             <option value="خارج شده" @if(old('cooperation_status', $employee->contract->cooperation_status ?? '') == 'خارج شده') selected @endif>خارج شده</option>
                        </select>
                    </div>
                     <div class="form-group">
                        <label for="wants_insurance">درخواست بیمه</label>
                        <select name="wants_insurance" id="wants_insurance">
                            <option value="">-- انتخاب کنید --</option>
                            <option value="دارد" @if(old('wants_insurance', $employee->contract->wants_insurance ?? '') == 'دارد') selected @endif>دارد</option>
                            <option value="ندارد" @if(old('wants_insurance', $employee->contract->wants_insurance ?? '') == 'ندارد') selected @endif>ندارد</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="supplementary_insurance">بیمه تکمیلی</label>
                        <select name="supplementary_insurance" id="supplementary_insurance">
                            <option value="">-- انتخاب کنید --</option>
                            <option value="طرح ۱" @if(old('supplementary_insurance', $employee->contract->supplementary_insurance ?? '') == 'طرح ۱') selected @endif>طرح ۱</option>
                            <option value="طرح ۲" @if(old('supplementary_insurance', $employee->contract->supplementary_insurance ?? '') == 'طرح ۲') selected @endif>طرح ۲</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>تاریخ خروج</label>
                        <input type="date" name="exit_date" value="{{ old('exit_date', $employee->contract->exit_date ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label for="exit_type">نوع خروج</label>
                        <select name="exit_type" id="exit_type">
                            <option value="">-- انتخاب کنید --</option>
                            <option value="استعفا" @if(old('exit_type', $employee->contract->exit_type ?? '') == 'استعفا') selected @endif>استعفا</option>
                            <option value="اخراج" @if(old('exit_type', $employee->contract->exit_type ?? '') == 'اخراج') selected @endif>اخراج</option>
                            <option value="سایر" @if(old('exit_type', $employee->contract->exit_type ?? '') == 'سایر') selected @endif>سایر</option>
                        </select>
                    </div>
                    <div class="form-group form-group-full">
                        <label>دلیل خروج</label>
                        <textarea name="exit_reason">{{ old('exit_reason', $employee->contract->exit_reason ?? '') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- NDA Contract Information --}}
        <div class="card">
            <div class="card-header">قرارداد محرمانگی (NDA)</div>
            <div class="card-body">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="nda_type">نوع NDA</label>
                        <select name="nda_type" id="nda_type">
                            <option value="">-- انتخاب کنید --</option>
                            <option value="استاندارد" @if(old('nda_type', $employee->ndaContract->nda_type ?? '') == 'استاندارد') selected @endif>استاندارد</option>
                            <option value="سفارشی" @if(old('nda_type', $employee->ndaContract->nda_type ?? '') == 'سفارشی') selected @endif>سفارشی</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>تاریخ شروع NDA</label>
                        <input type="date" name="nda_start_date" value="{{ old('nda_start_date', $employee->ndaContract->nda_start_date ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label>تاریخ پایان NDA</label>
                        <input type="date" name="nda_end_date" value="{{ old('nda_end_date', $employee->ndaContract->nda_end_date ?? '') }}">
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Insurance Information --}}
        <div class="card">
            <div class="card-header">اطلاعات بیمه</div>
            <div class="card-body">
                <div class="form-grid">
                    <div class="form-group">
                        <label>عنوان شغلی بیمه</label>
                        <input type="text" name="insurance_position" value="{{ old('insurance_position', $employee->insurance->insurance_position ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label>کد کارگاه بیمه</label>
                        <input type="text" name="insurance_code" value="{{ old('insurance_code', $employee->insurance->insurance_code ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label>شماره بیمه</label>
                        <input type="text" name="insurance_number" value="{{ old('insurance_number', $employee->insurance->insurance_number ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label for="has_dependents">افراد تحت تکفل</label>
                        <select name="has_dependents" id="has_dependents">
                            <option value="">-- انتخاب کنید --</option>
                            <option value="دارد" @if(old('has_dependents', $employee->insurance->has_dependents ?? '') == 'دارد') selected @endif>دارد</option>
                            <option value="ندارد" @if(old('has_dependents', $employee->insurance->has_dependents ?? '') == 'ندارد') selected @endif>ندارد</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        {{-- Education Information --}}
        <div class="card">
            <div class="card-header">اطلاعات تحصیلی</div>
            <div class="card-body">
                <div class="form-grid">
                    <div class="form-group">
                        <label>مقطع تحصیلی</label>
                        <input type="text" name="degree" value="{{ old('degree', $employee->education->degree ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label>رشته تحصیلی</label>
                        <input type="text" name="major" value="{{ old('major', $employee->education->major ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label>دانشگاه</label>
                        <input type="text" name="university" value="{{ old('university', $employee->education->university ?? '') }}">
                    </div>
                </div>
            </div>
        </div>

        {{-- Military Service Information --}}
        <div class="card">
            <div class="card-header">وضعیت نظام وظیفه</div>
            <div class="card-body">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="military_status">وضعیت</label>
                        <select name="military_status" id="military_status">
                            <option value="">-- انتخاب کنید --</option>
                            <option value="انجام شده" @if(old('military_status', $employee->military->military_status ?? '') == 'انجام شده') selected @endif>انجام شده</option>
                            <option value="انجام نشده" @if(old('military_status', $employee->military->military_status ?? '') == 'انجام نشده') selected @endif>انجام نشده</option>
                            <option value="معاف" @if(old('military_status', $employee->military->military_status ?? '') == 'معاف') selected @endif>معاف</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>تاریخ شروع خدمت</label>
                        <input type="date" name="start_date" value="{{ old('start_date', $employee->military->start_date ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label>تاریخ پایان خدمت</label>
                        <input type="date" name="end_date" value="{{ old('end_date', $employee->military->end_date ?? '') }}">
                    </div>
                </div>
            </div>
        </div>

        {{-- Bank Account Information --}}
        <div class="card">
            <div class="card-header">اطلاعات حساب بانکی</div>
            <div class="card-body">
                <div class="form-grid">
                     <div class="form-group">
                        <label>شماره حساب پاسارگاد</label>
                        <input type="text" name="pasargad_account_number" value="{{ old('pasargad_account_number', $employee->bankAccount->pasargad_account_number ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label>شماره شبا پاسارگاد</label>
                        <input type="text" name="pasargad_sheba" value="{{ old('pasargad_sheba', $employee->bankAccount->pasargad_sheba ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label>شماره کارت پاسارگاد</label>
                        <input type="text" name="pasargad_card" value="{{ old('pasargad_card', $employee->bankAccount->pasargad_card ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label>شعبه پاسارگاد</label>
                        <input type="text" name="pasargad_branch" value="{{ old('pasargad_branch', $employee->bankAccount->pasargad_branch ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label for="bank_type">نوع بانک دیگر</label>
                        <select name="bank_type" id="bank_type">
                            <option value="">-- انتخاب کنید --</option>
                            <option value="ملی" @if(old('bank_type', $employee->bankAccount->bank_type ?? '') == 'ملی') selected @endif>ملی</option>
                            <option value="پاسارگاد" @if(old('bank_type', $employee->bankAccount->bank_type ?? '') == 'پاسارگاد') selected @endif>پاسارگاد</option>
                            <option value="سایر" @if(old('bank_type', $employee->bankAccount->bank_type ?? '') == 'سایر') selected @endif>سایر</option>
                        </select>
                    </div>
                     <div class="form-group">
                        <label>نام شعبه بانک دیگر</label>
                        <input type="text" name="bank_branch_name" value="{{ old('bank_branch_name', $employee->bankAccount->bank_branch_name ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label>شماره حساب بانک دیگر</label>
                        <input type="text" name="account_number" value="{{ old('account_number', $employee->bankAccount->account_number ?? '') }}">
                    </div>
                     <div class="form-group">
                        <label>شماره شبا بانک دیگر</label>
                        <input type="text" name="sheba_number" value="{{ old('sheba_number', $employee->bankAccount->sheba_number ?? '') }}">
                    </div>
                     <div class="form-group">
                        <label>شماره کارت بانک دیگر</label>
                        <input type="text" name="card_number" value="{{ old('card_number', $employee->bankAccount->card_number ?? '') }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">
                <i class="fas fa-save"></i>
                {{ isset($employee) ? 'ذخیره تغییرات' : 'ثبت و ایجاد کارمند' }}
            </button>
        </div>
    </form>
</div>
@endsection