@extends('layouts.dashboard')

@section('page_styles')
    <link rel="stylesheet" href="{{ asset('css/pages/dashboard/roles.css') }}">
@endsection

@section('dashboard_content')
<div class="page-header">
    <h1><i class="fas fa-user-shield page-icon"></i> مدیریت نقش‌ها و دسترسی‌ها</h1>
    <a href="#" class="btn-primary" id="add-role-btn"><i class="fas fa-plus-circle"></i> افزودن نقش جدید</a>
</div>

<div class="roles-management-container">
    {{-- ستون سمت راست: لیست نقش‌ها --}}
    <div class="roles-list-section">
        <div class="card">
            <div class="card-header">نقش‌های تعریف شده</div>
            <ul class="roles-list">
                @foreach($roles as $role)
                    <li class="{{ $loop->first ? 'active' : '' }}">
                        <a href="#">{{ $role['name'] }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    {{-- ستون سمت چپ: جزئیات نقش و دسترسی‌ها --}}
    <div class="role-details-section">
        <div class="card">
            <div class="card-header">دسترسی‌های نقش: کارمند</div>
            <div class="card-body">
                <table class="permissions-table">
                    <thead>
                        <tr>
                            <th>ماژول / صفحه</th>
                            <th>مشاهده</th>
                            <th>ایجاد</th>
                            <th>ویرایش</th>
                            <th>حذف</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($permissions as $module => $actions)
                            <tr>
                                <td>{{ $module }}</td>
                                <td>
                                    @if(in_array('view', $actions))
                                        <input type="checkbox" checked>
                                    @endif
                                </td>
                                <td>
                                    @if(in_array('create', $actions))
                                        <input type="checkbox">
                                    @endif
                                </td>
                                <td>
                                    @if(in_array('edit', $actions))
                                        <input type="checkbox">
                                    @endif
                                </td>
                                <td>
                                    @if(in_array('delete', $actions))
                                        <input type="checkbox">
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header">کاربران با این نقش</div>
            <div class="card-body">
                <ul class="users-in-role-list">
                    @foreach($users as $user)
                        <li>{{ $user['name'] }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

{{-- کد HTML پاپ‌آپ افزودن نقش --}}
<div class="modal-overlay" id="add-role-modal">
    <div class="modal-content">
        <span class="modal-close" id="close-modal-btn">&times;</span>
        <h2>افزودن نقش جدید</h2>
        <form action="#" method="POST">
            <div class="modal-form-group">
                <label for="role_name">نام نقش</label>
                <input type="text" id="role_name" name="role_name" placeholder="مثال: بازاریاب" required>
            </div>
            <div class="modal-buttons">
                <button type="button" class="btn-secondary" id="cancel-modal-btn">لغو</button>
                <button type="submit" class="btn-success">ثبت</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // اسکریپت برای مدیریت پاپ‌آپ
    const addBtn = document.getElementById('add-role-btn');
    const modal = document.getElementById('add-role-modal');
    const closeBtn = document.getElementById('close-modal-btn');
    const cancelBtn = document.getElementById('cancel-modal-btn');

    addBtn.addEventListener('click', function(e) {
        e.preventDefault();
        modal.style.display = 'flex';
    });
    
    closeBtn.addEventListener('click', () => modal.style.display = 'none');
    cancelBtn.addEventListener('click', () => modal.style.display = 'none');
    window.addEventListener('click', (e) => {
        if (e.target === modal) modal.style.display = 'none';
    });
</script>
@endsection