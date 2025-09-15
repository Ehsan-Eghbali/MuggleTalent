@extends('layouts.dashboard')

@section('page_styles')
    <link rel="stylesheet" href="{{ asset('css/pages/dashboard/personnel-list.css') }}">
@endsection

@section('dashboard_content')
<div class="page-header">
    <h1><i class="fas fa-users-cog page-icon"></i> مشاهده لیست همکاران</h1>
    {{-- این دکمه به روت employees.create لینک داده شده است --}}
    <a href="{{ route('employees.create') }}" class="btn-primary"><i class="fas fa-plus-circle"></i> افزودن همکار جدید</a>
</div>

{{-- نمایش پیام‌های موفقیت یا خطا --}}
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="table-container-wrapper">
    {{-- جدول داده‌ها --}}
    <table class="data-table">
        <thead>
            <tr>
                <th>کد پرسنلی</th>
                <th>نام</th>
                <th>نام خانوادگی</th>
                <th>ایمیل سازمانی</th>
                <th>سمت شغلی</th>
                <th>وضعیت همکاری</th>
                <th>شماره تماس</th>
                <th>اقدامات</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($employees as $employee)
            <tr>
                <td>{{ $employee->employee_number }}</td>
                <td>{{ $employee->first_name }}</td>
                <td>{{ $employee->last_name }}</td>
                <td>{{ $employee->organization_email }}</td>
                <td>{{ $employee->position_chart  }}</td>
                <td>{{ $employee->work_status }}</td>
                <td>{{ $employee->phone_number }}</td>
                <td>
                    <a href="{{ route('employees.show', $employee->id) }}" title="مشاهده پروفایل" class="action-icon view-icon"><i class="fas fa-eye"></i></a>
                    <a href="{{ route('employees.edit', $employee->id) }}" title="ویرایش" class="action-icon edit-icon"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('آیا از حذف این کارمند مطمئن هستید؟');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" title="حذف" class="action-icon delete-icon" style="background:none; border:none; cursor:pointer; padding:0;">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align:center;">هیچ کارمندی برای نمایش وجود ندارد.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="pagination">
        {{-- {{ $employees->links() }} --}}
    </div>
</div>
@endsection

{{-- این صفحه دیگر نیازی به پاپ‌آپ و اسکریپت آن ندارد --}}