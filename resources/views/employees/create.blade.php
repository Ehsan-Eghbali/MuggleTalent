@extends('master.index')

@section('content')
    <div class="container mt-4">
        <h2>افزودن پرسنل جدید</h2>

        <form action="{{ route('employees.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="employee_number" class="form-label">شماره پرسنلی</label>
                <input type="text" class="form-control" id="employee_number" name="employee_number" required>
            </div>

            <div class="mb-3">
                <label for="first_name" class="form-label">نام</label>
                <input type="text" class="form-control" id="first_name" name="first_name" required>
            </div>

            <div class="mb-3">
                <label for="last_name" class="form-label">نام خانوادگی</label>
                <input type="text" class="form-control" id="last_name" name="last_name" required>
            </div>

            <div class="mb-3">
                <label for="full_name" class="form-label">نام کامل</label>
                <input type="text" class="form-control" id="full_name" name="full_name" required>
            </div>

            <div class="mb-3">
                <label for="position" class="form-label">سمت</label>
                <input type="text" class="form-control" id="position" name="position">
            </div>

            <div class="mb-3">
                <label for="team" class="form-label">تیم</label>
                <input type="text" class="form-control" id="team" name="team">
            </div>

            <div class="mb-3">
                <label for="department" class="form-label">واحد</label>
                <input type="text" class="form-control" id="department" name="department">
            </div>

            <div class="mb-3">
                <label for="manager" class="form-label">مدیر</label>
                <input type="text" class="form-control" id="manager" name="manager">
            </div>

            <div class="mb-3">
                <label for="job_level" class="form-label">رده شغلی</label>
                <input type="text" class="form-control" id="job_level" name="job_level">
            </div>

            <div class="mb-3">
                <label for="contract_type" class="form-label">نوع قرارداد</label>
                <select class="form-control" id="contract_type" name="contract_type">
                    <option value="full_time">تمام‌وقت</option>
                    <option value="part_time">پاره‌وقت</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="work_status" class="form-label">وضعیت حضور</label>
                <select class="form-control" id="work_status" name="work_status">
                    <option value="on_site">حضوری</option>
                    <option value="remote">دورکاری</option>
                    <option value="hybrid">ترکیبی</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="formality" class="form-label">نوع استخدام</label>
                <select class="form-control" id="formality" name="formality">
                    <option value="formal">رسمی</option>
                    <option value="informal">غیررسمی</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="phone_number" class="form-label">شماره تماس</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">ایمیل شخصی</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>

            <div class="mb-3">
                <label for="organization_email" class="form-label">ایمیل سازمانی</label>
                <input type="email" class="form-control" id="organization_email" name="organization_email">
            </div>

            <button type="submit" class="btn btn-primary">ثبت</button>
            <a href="{{ route('employees.index') }}" class="btn btn-secondary">بازگشت</a>
        </form>
    </div>
@endsection
