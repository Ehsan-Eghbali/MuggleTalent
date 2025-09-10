@extends('layouts.dashboard')

@section('dashboard_content')
<div class="page-header">
    <h1><i class="fas fa-users-cog page-icon"></i> مشاهده لیست همکاران</h1>
    <a href="#" class="btn-primary" id="add-employee-btn"><i class="fas fa-plus-circle"></i> افزودن همکار جدید</a>
</div>

<div class="table-container-wrapper">
    {{-- بخش فیلترها --}}
    <div class="filter-section">
        <select name="filter_name" id="filter_name">
            <option value="">نام و نام خانوادگی</option>
            <option value="سبحان">سبحان فروغی</option>
            <option value="سید امین">سید امین احمدی</option>
        </select>
        <select name="filter_unit" id="filter_unit">
            <option value="">واحد</option>
            <option value="فنی">فنی</option>
            <option value="اداری">اداری</option>
        </select>
        <select name="filter_team" id="filter_team">
            <option value="">تیم</option>
            <option value="فنی">پشتیبانی</option>
            <option value="اداری">مالی</option>
        </select>
    </div>

    {{-- جدول داده‌ها --}}
    <table class="data-table">
        <thead>
            <tr>
                <th><i class="fas fa-user-circle"></i> کد پرسنلی</th>
                <th><i class="fas fa-user"></i> نام</th>
                <th><i class="fas fa-users"></i> نام خانوادگی</th>
                <th><i class="fas fa-envelope"></i> ایمیل</th>
                <th><i class="fas fa-calendar-alt"></i> تاریخ تولد</th>
                <th><i class="fas fa-briefcase"></i> کسب و کار</th>
                <th><i class="fas fa-heart"></i> وضعیت همکاری</th>
                <th><i class="fas fa-phone-alt"></i> شماره تماس</th>
                <th><i class="fas fa-cogs"></i> اقدامات</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employees as $person)
                @dd($employees)
            <tr>
                <td>{{ $person['employee_number'] }}</td>
                <td>{{ $person['name'] }}</td>
                <td>{{ $person['family'] }}</td>
                <td>{{ $person['email'] }}</td>
                <td>{{ $person['birth_date'] }}</td>
                <td>{{ $person['job'] }}</td>
                <td>{{ $person['status'] }}</td>
                <td>{{ $person['phone'] }}</td>
                <td>
                    <a href="/personnel/{{ $person['id'] }}" title="مشاهده پروفایل" class="action-icon view-icon"><i class="fas fa-eye"></i></a>
                    <a href="#" title="ویرایش" class="action-icon edit-icon"><i class="fas fa-edit"></i></a>
                    <a href="#" title="حذف" class="action-icon delete-icon"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination">
        <a href="#">&laquo;</a>
        <a href="#" class="active">1</a>
        <a href="#">2</a>
        <a href="#">3</a>
        <a href="#">&raquo;</a>
    </div>
</div>

{{-- کد HTML پاپ‌آپ --}}
<div class="modal-overlay" id="add-employee-modal">
    <div class="modal-content">
        <span class="modal-close" id="close-modal-btn">&times;</span>
        <h2>افزودن همکار جدید</h2>
        <form action="{{route("employees.store")}}" method="POST">
            @method("POST")
            @csrf
            <div class="modal-form-group">
                <label for="employee_name">شماره پرسنلی</label>
                <input type="number" id="employee_number" name="employee_number" required>
            </div>
            <div class="modal-form-group">
                <label for="employee_name">نام</label>
                <input type="text" id="employee_name" name="employee_name" required>
            </div>
            <div class="modal-form-group">
                <label for="employee_family">نام خانوادگی</label>
                <input type="text" id="employee_family" name="employee_family" required>
            </div>
            <div class="modal-form-group">
                <label for="employee_email">ایمیل</label>
                <input type="email" id="employee_email" name="employee_email" required>
            </div>
            <div class="modal-form-group">
                <label for="employee_job">کسب و کار</label>
                <input type="text" id="employee_job" name="employee_job" required>
            </div>
            <div class="modal-form-group">
                <label for="employee_status">وضعیت همکاری</label>
                <input type="text" id="employee_status" name="employee_status" required>
            </div>
            <div class="modal-form-group">
                <label for="employee_phone">شماره تماس</label>
                <input type="text" id="employee_phone" name="employee_phone" required>
            </div>
            <div class="modal-buttons">
                <button type="button" class="btn-secondary" id="cancel-modal-btn">لغو</button>
                <button type="submit" class="btn-success">ثبت</button>
            </div>
        </form>
    </div>
</div>

{{-- اسکریپت برای مدیریت پاپ‌آپ --}}
<script>
    const addBtn = document.getElementById('add-employee-btn');
    const modal = document.getElementById('add-employee-modal');
    const closeBtn = document.getElementById('close-modal-btn');
    const cancelBtn = document.getElementById('cancel-modal-btn');

    addBtn.addEventListener('click', function(event) {
        event.preventDefault();
        modal.style.display = 'flex';
    });

    closeBtn.addEventListener('click', function() {
        modal.style.display = 'none';
    });

    cancelBtn.addEventListener('click', function() {
        modal.style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
</script>
@endsection
