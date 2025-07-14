@extends('master.index')

@section('content')
    <div class="container mt-4">
        <h2>ویرایش اطلاعات پرسنل</h2>

        <form action="{{ route('employees.update', $employee->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="employee_number" class="form-label">شماره پرسنلی</label>
                <input type="text" class="form-control" id="employee_number" name="employee_number" value="{{ $employee->employee_number }}" required>
            </div>

            <div class="mb-3">
                <label for="first_name" class="form-label">نام</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $employee->first_name }}" required>
            </div>

            <div class="mb-3">
                <label for="last_name" class="form-label">نام خانوادگی</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $employee->last_name }}" required>
            </div>

            <div class="mb-3">
                <label for="full_name" class="form-label">نام کامل</label>
                <input type="text" class="form-control" id="full_name" name="full_name" value="{{ $employee->full_name }}" required>
            </div>

            <div class="mb-3">
                <label for="position" class="form-label">سمت</label>
                <input type="text" class="form-control" id="position" name="position" value="{{ $employee->position }}">
            </div>

            <div class="mb-3">
                <label for="team" class="form-label">تیم</label>
                <input type="text" class="form-control" id="team" name="team" value="{{ $employee->team }}">
            </div>

            <div class="mb-3">
                <label for="department" class="form-label">واحد</label>
                <input type="text" class="form-control" id="department" name="department" value="{{ $employee->department }}">
            </div>

            <div class="mb-3">
                <label for="manager" class="form-label">مدیر</label>
                <input type="text" class="form-control" id="manager" name="manager" value="{{ $employee->manager }}">
            </div>

            <div class="mb-3">
                <label for="job_level" class="form-label">رده شغلی</label>
                <input type="text" class="form-control" id="job_level" name="job_level" value="{{ $employee->job_level }}">
            </div>

            <div class="mb-3">
                <label for="contract_type" class="form-label">نوع قرارداد</label>
                <select class="form-control" id="contract_type" name="contract_type">
                    <option value="full_time" @if($employee->contract_type == 'full_time') selected @endif>تمام‌وقت</option>
                    <option value="part_time" @if($employee->contract_type == 'part_time') selected @endif>پاره‌وقت</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="work_status" class="form-label">وضعیت حضور</label>
                <select class="form-control" id="work_status" name="work_status">
                    <option value="on_site" @if($employee->work_status == 'on_site') selected @endif>حضوری</option>
                    <option value="remote" @if($employee->work_status == 'remote') selected @endif>دورکاری</option>
                    <option value="hybrid" @if($employee->work_status == 'hybrid') selected @endif>ترکیبی</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="formality" class="form-label">نوع استخدام</label>
                <select class="form-control" id="formality" name="formality">
                    <option value="formal" @if($employee->formality == 'formal') selected @endif>رسمی</option>
                    <option value="informal" @if($employee->formality == 'informal') selected @endif>غیررسمی</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="phone_number" class="form-label">شماره تماس</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $employee->phone_number }}">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">ایمیل شخصی</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $employee->email }}">
            </div>

            <div class="mb-3">
                <label for="organization_email" class="form-label">ایمیل سازمانی</label>
                <input type="email" class="form-control" id="organization_email" name="organization_email" value="{{ $employee->organization_email }}">
            </div>

            <button type="submit" class="btn btn-success">ذخیره تغییرات</button>
            <a href="{{ route('employees.index') }}" class="btn btn-secondary">بازگشت</a>
        </form>
    </div>
@endsection
