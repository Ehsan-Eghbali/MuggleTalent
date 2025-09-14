@extends('layouts.dashboard')

@section('page_styles')
    <link rel="stylesheet" href="{{ asset('css/pages/dashboard/employee-form.css') }}">
@endsection

@section('dashboard_content')
    <div class="page-header">
        <h1><i class="fas fa-user-plus page-icon"></i> افزودن همکار جدید</h1>
        <a href="{{ route('employees.index') }}" class="btn-secondary"><i class="fas fa-arrow-left"></i> بازگشت به لیست</a>
    </div>

    <div class="form-container-wrapper">
        <form action="{{ route('employees.store') }}" method="POST">
            @csrf

            <div class="card">
                <div class="card-header">اطلاعات اصلی</div>
                <div class="card-body">
                    <div class="form-grid">
                        <div class="form-group">
                            <label>شماره پرسنلی</label>
                            <input type="text" name="employee_number" required>
                        </div>
                        <div class="form-group">
                            <label>نام</label>
                            <input type="text" name="first_name" required>
                        </div>
                        <div class="form-group">
                            <label>نام خانوادگی</label>
                            <input type="text" name="last_name" required>
                        </div>
                        <div class="form-group">
                            <label>سمت شغلی</label>
                            <input type="text" name="position" required>
                        </div>
                        <div class="form-group">
                            <label>نام و نام خانوادگی</label>
                            <input type="text" name="full_name" required>
                        </div>
                        <div class="form-group">
                            <label>نام مستعار</label>
                            <input type="text" name="nickname" required>
                        </div>
                        <div class="form-group">
                            <label>شماره همراه</label>
                            <input type="number" name="phone_number" required>
                        </div>
                        <div class="form-group">
                            <label> ایمیل</label>
                            <input type="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label>ایمیل سازمانی</label>
                            <input type="email" name="organization_email" required>
                        </div>
                        <div class="form-group">
                            <label>مدیر مستقیم</label>
                            <input type="text" name="direct_manager" required>
                        </div>
                        <div class="form-group">
                            <label>تیم</label>
                            <input value="{{old("team")}}" type="text" name="team" required>
                        </div>
                        <div class="form-group">
                            <label>واحد</label>
                            <input type="text" name="department" required>
                        </div>
                        <div class="form-group">
                            <label for="job_level">رده کاری</label>
                            <select name="job_level" id="job_level" required>
                                <option value="">-- انتخاب کنید --</option>
                                <option value="S1">S1</option>
                                <option value="S2">S2</option>
                                <option value="S3">S3</option>
                                <option value="M1">M1</option>
                                <option value="M2">M2</option>
                                <option value="M3">M3</option>
                                <option value="j1">J1</option>
                                <option value="j2">J2</option>
                                <option value="j3">J3</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="work_status">وضعیت همکاری</label>
                            <select name="work_status" id="work_status" required>
                                <option value="">-- انتخاب کنید --</option>
                                <option value="حضوری">حضوری</option>
                                <option value="دورکار">دورکار</option>
                                <option value="هیبریدی">هیبریدی</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="formality">نوع همکاری</label>
                            <select name="formality" id="formality" required>
                                <option value="">-- انتخاب کنید --</option>
                                <option value="رسمی">رسمی</option>
                                <option value="غیررسمی">غیررسمی</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="contract_type">نوع قرارداد</label>
                            <select name="contract_type" id="contract_type" required>
                                <option value="">-- انتخاب کنید --</option>
                                <option value="دورکاری">دورکاری</option>
                                <option value="کارآموزی">کارآموزی</option>
                                <option value="دورکاری">دورکاری</option>
                                <option value="تمام وقت">تمام وقت</option>
                                 <option value="پاره وقت">پاره وقت</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cooperation_status">شکل قرارداد</label>
                            <select name="cooperation_status" id="cooperation_status" required>
                                <option value="">-- انتخاب کنید --</option>
                                <option value="تمام وقت">تمام وقت</option>
                                <option value="پاره وقت">پاره وقت</option>
                            </select>
                        </div>
                        {{-- ... بقیه فیلدهای مورد نیاز را اینجا اضافه کنید --}}
                    </div>
                </div>
            </div>

            {{-- می‌توانید اطلاعات دیگر را نیز در کارت‌های جداگانه قرار دهید --}}

            <div class="form-actions">
                <button type="submit" class="btn-primary">ثبت و ایجاد کارمند</button>
            </div>
        </form>
    </div>
@endsection
