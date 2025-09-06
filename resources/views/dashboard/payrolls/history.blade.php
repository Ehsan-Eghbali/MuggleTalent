@extends('layouts.dashboard')

{{-- ما از همان استایل‌های صفحه آرشیو استفاده می‌کنیم --}}
@section('page_styles')
    <link rel="stylesheet" href="{{ asset('css/pages/dashboard/archive.css') }}">
@endsection

@section('dashboard_content')
<div class="page-header">
    <h1><i class="fas fa-history page-icon"></i> تاریخچه تغییرات حقوق و دستمزد</h1>
</div>

<div class="table-container-wrapper">
    {{-- بخش جستجو و فیلتر --}}
    <div class="archive-filters">
        <div class="search-group">
            <label for="search-personnel-code">جستجو بر اساس نام یا کد پرسنلی</label>
            <input type="text" id="search-personnel-code" placeholder="نام یا کد پرسنلی را وارد کنید...">
        </div>
        <button class="btn-primary"><i class="fas fa-search"></i> جستجو</button>
    </div>

    {{-- جدول داده‌ها --}}
    <table class="data-table">
        <thead>
            <tr>
                <th>تاریخ ثبت</th>
                <th>نام پرسنل</th>
                <th>نوع تغییر</th>
                <th>شرح تغییرات</th>
                <th>ثبت شده توسط</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
            <tr>
                <td>{{ $log['date'] }}</td>
                <td>{{ $log['personnel_name'] }}</td>
                <td><span class="badge">{{ $log['change_type'] }}</span></td>
                <td>{{ $log['details'] }}</td>
                <td>{{ $log['user'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection