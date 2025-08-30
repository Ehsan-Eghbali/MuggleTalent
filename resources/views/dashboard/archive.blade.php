@extends('layouts.dashboard')

@section('page_styles')
    <link rel="stylesheet" href="{{ asset('css/pages/dashboard/archive.css') }}">
@endsection

@section('dashboard_content')
<div class="page-header">
    <h1><i class="fas fa-archive page-icon"></i> آرشیو درخواست ها</h1>
</div>

<div class="table-container-wrapper">
    {{-- بخش جستجو و فیلتر --}}
    <div class="archive-filters">
        <div class="search-group">
            <label for="search-personnel-code">جستجو بر اساس کد پرسنلی</label>
            <input type="text" id="search-personnel-code" placeholder="کد پرسنلی را وارد کنید...">
        </div>
        <button class="btn-primary"><i class="fas fa-search"></i> جستجو</button>
    </div>

    {{-- جدول داده‌ها --}}
    <table class="data-table">
        <thead>
            <tr>
                <th>شماره نامه</th>
                <th>نام پرسنل</th>
                <th>کد پرسنلی</th>
                <th>نوع نامه</th>
                <th>تاریخ صدور</th>
                <th>اقدامات</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($letters as $letter)
            <tr>
                <td>{{ $letter['letter_number'] }}</td>
                <td>{{ $letter['personnel_name'] }}</td>
                <td>{{ $letter['personnel_code'] }}</td>
                <td><span class="badge">{{ $letter['letter_type'] }}</span></td>
                <td>{{ $letter['issue_date'] }}</td>
                <td>
                    <a href="{{ $letter['file_path'] }}" title="دانلود نامه" class="action-icon view-icon"><i class="fas fa-download"></i></a>
                    <a href="#" title="مشاهده جزئیات" class="action-icon edit-icon"><i class="fas fa-info-circle"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- بخش صفحه‌بندی --}}
    <div class="pagination">
        <a href="#">&laquo;</a>
        <a href="#" class="active">1</a>
        <a href="#">2</a>
        <a href="#">&raquo;</a>
    </div>
</div>
@endsection