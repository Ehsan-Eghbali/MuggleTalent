@extends('layouts.dashboard')

@section('dashboard_content')
<div class="profile-header">
    <div class="profile-main-info">
        <div class="profile-picture-wrapper">
            <img src="https://i.pravatar.cc/150?u=a042581f4e29026704d" alt="عکس پروفایل" class="profile-picture">
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
    <a href="#" class="tab-item active">اطلاعات شخصی</a>
    <a href="#" class="tab-item">اطلاعات شغلی</a>
    <a href="#" class="tab-item">آموزش ها</a>
    <a href="#" class="tab-item">مدیریت عملکرد</a>
    <a href="#" class="tab-item">سوابق پرسنلی</a>
</nav>

<div class="profile-form-container">
    <h3 class="form-title">اطلاعات همکار</h3>
    <form action="#" method="POST">
        <div class="form-grid">
            <div class="form-group">
                <label for="name">نام</label>
                <input type="text" id="name" value="{{ $employee['full_name'] }}" required>
            </div>
            <div class="form-group">
                <label for="family">نام خانوادگی</label>
                <input type="text" id="family" value="{{ $employee['family_name'] }}" required>
            </div>
            <div class="form-group">
                <label for="national_code">کد ملی</label>
                <input type="text" id="national_code" value="{{ $employee['national_code'] }}" required>
            </div>
            <div class="form-group">
                <label for="phone">شماره تماس</label>
                <input type="text" id="phone" value="{{ $employee['phone'] }}" required>
            </div>
            <div class="form-group">
                <label for="birth_date">تاریخ تولد</label>
                <input type="text" id="birth_date" value="{{ $employee['birth_date'] }}" required>
            </div>
            </div>
    </form>
</div>
@endsection