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
                        <input type="text" name="position_chart" value="{{ old('position_chart', $employee->position_chart ?? '') }}" required>
                    </div>
                    <div class="form-group">
                        <label>شماره همراه</label>
                        <input type="text" name="phone_number" value="{{ old('phone_number', $employee->phone_number ?? '') }}" required>
                    </div>
                    <div class="form-group">
                        <label>ایمیل شخصی</label>
                        <input type="email" name="email" value="{{ old('email', $employee->email ?? '') }}" required>
                    </div>
                    <div class="form-group">
                        <label>ایمیل سازمانی</label>
                        <input type="email" name="organization_email" value="{{ old('organization_email', $employee->organization_email ?? '') }}" required>
                    </div>
                    <div class="form-group">
                        <label>مدیر مستقیم</label>
                        <input type="text" name="direct_manager" value="{{ old('direct_manager', $employee->direct_manager ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label>واحد</label>
                        <input type="text" name="department" value="{{ old('department', $employee->department ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label>تیم</label>
                        <input type="text" name="team" value="{{ old('team', $employee->team ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label for="job_level">رده کاری</label>
                        <select name="job_level" id="job_level" required>
                            <option value="">-- انتخاب کنید --</option>
                            <option value="J1" @if(old('job_level', $employee->job_level ?? '') == 'J1') selected @endif>J1</option>
                            <option value="J2" @if(old('job_level', $employee->job_level ?? '') == 'J2') selected @endif>J2</option>
                            <option value="J3" @if(old('job_level', $employee->job_level ?? '') == 'J3') selected @endif>J3</option>
                            <option value="M1" @if(old('job_level', $employee->job_level ?? '') == 'M1') selected @endif>M1</option>
                            <option value="M2" @if(old('job_level', $employee->job_level ?? '') == 'M2') selected @endif>M2</option>
                            <option value="M3" @if(old('job_level', $employee->job_level ?? '') == 'M3') selected @endif>M3</option>
                            <option value="S1" @if(old('job_level', $employee->job_level ?? '') == 'S1') selected @endif>S1</option>
                            <option value="S2" @if(old('job_level', $employee->job_level ?? '') == 'S2') selected @endif>S2</option>
                            <option value="S3" @if(old('job_level', $employee->job_level ?? '') == 'S3') selected @endif>S3</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="work_status">شکل همکاری</label>
                        <select name="work_status" id="work_status" required>
                            <option value="">-- انتخاب کنید --</option>
                            <option value="حضوری" @if(old('work_status', $employee->work_status ?? '') == 'حضوری') selected @endif>حضوری</option>
                            <option value="دورکار" @if(old('work_status', $employee->work_status ?? '') == 'دورکار') selected @endif>دورکار</option>
                            <option value="هیبریدی" @if(old('work_status', $employee->work_status ?? '') == 'هیبریدی') selected @endif>هیبریدی</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="formality">نوع همکاری</label>
                        <select name="formality" id="formality" required>
                            <option value="">-- انتخاب کنید --</option>
                            <option value="رسمی" @if(old('formality', $employee->formality ?? '') == 'رسمی') selected @endif>رسمی</option>
                            <option value="غیررسمی" @if(old('formality', $employee->formality ?? '') == 'غیررسمی') selected @endif>غیررسمی</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="contract_type">نوع قرارداد</label>
                        <select name="contract_type" id="contract_type" required>
                            <option value="">-- انتخاب کنید --</option>
                            <option value="دورکاری" @if(old('contract_type', $employee->contract_type ?? '') == 'دورکاری') selected @endif>دورکاری</option>
                            <option value="کارآموزی" @if(old('contract_type', $employee->contract_type ?? '') == 'کارآموزی') selected @endif>کارآموزی</option>
                            <option value="آزمایشی" @if(old('contract_type', $employee->contract_type ?? '') == 'آزمایشی') selected @endif>آزمایشی</option>
                            <option value="تمام وقت" @if(old('contract_type', $employee->contract_type ?? '') == 'تمام وقت') selected @endif>تمام وقت</option>
                            <option value="پاره وقت" @if(old('contract_type', $employee->contract_type ?? '') == 'پاره وقت') selected @endif>پاره وقت</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">
                {{ isset($employee) ? 'ذخیره تغییرات' : 'ثبت و ایجاد کارمند' }}
            </button>
        </div>
    </form>
</div>
@endsection