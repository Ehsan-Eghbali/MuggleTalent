@extends('layouts.dashboard')

@section('page_styles')
    <link rel="stylesheet" href="{{ asset('css/pages/dashboard/departments.css') }}">
@endsection

@section('dashboard_content')
<div class="page-header">
    <h1><i class="fas fa-building page-icon"></i> مدیریت واحدها</h1>
</div>

<div class="departments-container">
    {{-- ستون سمت راست: فرم افزودن واحد --}}
    <div class="add-department-form">
        <div class="card">
            <div class="card-header">افزودن واحد جدید</div>
            <div class="card-body">
                <form action="#" method="POST">
                    <div class="form-group">
                        <label for="department_name">نام واحد</label>
                        <input type="text" id="department_name" name="department_name" placeholder="مثال: تیم فنی" required>
                    </div>
                    <button type="submit" class="btn-primary full-width">
                        <i class="fas fa-plus-circle"></i> افزودن
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- ستون سمت چپ: لیست واحدها --}}
    <div class="departments-list">
        <div class="card">
            <div class="card-header">واحدهای تعریف شده</div>
            <div class="card-body">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>نام واحد</th>
                            <th>اقدامات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($departments as $department)
                        <tr>
                            <td>{{ $department['name'] }}</td>
                            <td>
                                <a href="#" title="ویرایش" class="action-icon edit-icon"><i class="fas fa-edit"></i></a>
                                <a href="#" title="حذف" class="action-icon delete-icon"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection