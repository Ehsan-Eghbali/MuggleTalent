@extends('layouts.dashboard')

@section('page_styles')
    {{-- اصلاح نام فایل CSS به نام صحیح --}}
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
    <a href="#" class="tab-item" data-tab="training">آموزش</a>
    <a href="#" class="tab-item" data-tab="performance">مدیریت عملکرد</a>
    <a href="#" class="tab-item" data-tab="history">سوابق پرسنلی</a>
</nav>

<div class="profile-tab-content">
    {{-- تب اطلاعات شخصی --}}
    <div id="personal-info-pane" class="tab-pane active">
        <div class="profile-form-container">
            <h3 class="form-title">اطلاعات همکار</h3>
            <form action="#" method="POST">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="name">نام</label>
                        <input type="text" id="name" value="{{ $employee['full_name'] }}" required>
                    </div>
                    {{-- ... سایر فیلدهای اطلاعات شخصی ... --}}
                </div>
            </form>
        </div>
    </div>

    {{-- تب اطلاعات شغلی --}}
    <div id="employment-info-pane" class="tab-pane">
        <div class="profile-form-container">
            <h3 class="form-title">اطلاعات شغلی</h3>
            <form action="#" method="POST">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="department">واحد</label>
                        <input type="text" id="department" value="{{ $employee['employment_info']['department'] }}">
                    </div>
                    <div class="form-group">
                        <label for="team">تیم</label>
                        <input type="text" id="team" value="{{ $employee['employment_info']['team'] }}">
                    </div>
                    <div class="form-group">
                        <label for="contract_type">نوع قرارداد</label>
                        <input type="text" id="contract_type" value="{{ $employee['employment_info']['contract_type'] }}">
                    </div>
                    <div class="form-group">
                        <label for="hire_date">تاریخ استخدام</label>
                        <input type="text" id="hire_date" value="{{ $employee['employment_info']['hire_date'] }}">
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn-primary">ذخیره تغییرات</button>
                </div>
            </form>
        </div>
    </div>
    
    {{-- تب‌های دیگر --}}
    <div id="training-pane" class="tab-pane"><p class="placeholder-text">بخش آموزش در حال ساخت است.</p></div>
    <div id="performance-pane" class="tab-pane"><p class="placeholder-text">بخش مدیریت عملکرد در حال ساخت است.</p></div>
    <div id="history-pane" class="tab-pane">
        <div class="profile-form-container">
            <h3 class="form-title">یادداشت‌ها و سوابق پرسنلی</h3>
            <form action="#" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="history_notes">یادداشت جدید</label>
                    <textarea id="history_notes" rows="6" placeholder="یادداشت‌های مربوط به عملکرد، اتفاقات مهم و... را اینجا وارد کنید.">{{ $employee['work_history']['notes'] }}</textarea>
                </div>
                <div class="file-upload-wrapper">
                    <label for="attachment_file" class="btn-secondary"><i class="fas fa-paperclip"></i> پیوست فایل</label>
                    <input type="file" id="attachment_file" name="attachment_file" style="display: none;">
                    <span id="file-name-display">هیچ فایلی انتخاب نشده است.</span>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn-primary">ذخیره یادداشت و فایل</button>
                </div>
            </form>
            <hr class="separator">
            <h3 class="form-title">فایل‌های پیوست شده</h3>
            <div class="attachments-list">
                @forelse($employee['work_history']['attachments'] as $file)
                <div class="attachment-item">
                    <div class="file-info">
                        <i class="fas fa-file-alt file-icon"></i>
                        <div class="file-details">
                            <span class="file-name">{{ $file['name'] }}</span>
                            <span class="file-meta">{{ $file['date'] }} - {{ $file['size'] }}</span>
                        </div>
                    </div>
                    <div class="file-actions">
                        <a href="#" class="action-icon view-icon" title="دانلود"><i class="fas fa-download"></i></a>
                        <a href="#" class="action-icon delete-icon" title="حذف"><i class="fas fa-trash"></i></a>
                    </div>
                </div>
                @empty
                <p class="placeholder-text" style="padding: 1rem 0;">هیچ فایلی پیوست نشده است.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
{{-- اسکریپت‌ها --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
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

    const fileInput = document.getElementById('attachment_file');
    const fileNameDisplay = document.getElementById('file-name-display');
    if (fileInput) {
        fileInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                fileNameDisplay.textContent = this.files[0].name;
            } else {
                fileNameDisplay.textContent = 'هیچ فایلی انتخاب نشده است.';
            }
        });
    }
});
</script>
@endsection