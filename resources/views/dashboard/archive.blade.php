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
    <form method="GET" action="{{ route('archive.index') }}" class="archive-filters">
        <div class="search-group">
            <label for="search-personnel-code">جستجو بر اساس کد پرسنلی</label>
            <input type="text" id="search-personnel-code" name="personnel_code" 
                   value="{{ request('personnel_code') }}" 
                   placeholder="کد پرسنلی را وارد کنید...">
        </div>
        <div class="search-group">
            <label for="search-personnel-name">جستجو بر اساس نام پرسنل</label>
            <input type="text" id="search-personnel-name" name="personnel_name" 
                   value="{{ request('personnel_name') }}" 
                   placeholder="نام پرسنل را وارد کنید...">
        </div>
        <div class="search-group">
            <label for="template-filter">نوع نامه</label>
            <select id="template-filter" name="template_key">
                <option value="">همه انواع</option>
                <option value="employment_certificate" {{ request('template_key') == 'employment_certificate' ? 'selected' : '' }}>گواهی اشتغال به کار</option>
                <option value="salary_certificate" {{ request('template_key') == 'salary_certificate' ? 'selected' : '' }}>گواهی کسر از حقوق</option>
            </select>
        </div>
        <button type="submit" class="btn-primary"><i class="fas fa-search"></i> جستجو</button>
        <a href="{{ route('archive.index') }}" class="btn-secondary"><i class="fas fa-times"></i> پاک کردن فیلترها</a>
    </form>

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
            @forelse ($letters as $letter)
            <tr>
                <td>{{ $letter['letter_number'] }}</td>
                <td>{{ $letter['personnel_name'] }}</td>
                <td>{{ $letter['personnel_code'] }}</td>
                <td><span class="badge">{{ $letter['letter_type'] }}</span></td>
                <td>{{ $letter['issue_date'] }}</td>
                <td>
                    @if($letter['has_file'])
                        <a href="{{ $letter['file_path'] }}" title="دانلود نامه" class="action-icon view-icon">
                            <i class="fas fa-download"></i>
                        </a>
                    @else
                        <span class="action-icon disabled" title="فایل موجود نیست">
                            <i class="fas fa-download"></i>
                        </span>
                    @endif
                    <a href="{{ route('archive.show', $letter['id']) }}" title="مشاهده جزئیات" class="action-icon edit-icon">
                        <i class="fas fa-info-circle"></i>
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">
                    <p class="placeholder-text">هیچ نامه‌ای در آرشیو یافت نشد.</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- بخش صفحه‌بندی --}}
    @if($letters->hasPages())
    <div class="pagination">
        {{ $letters->links() }}
    </div>
    @endif
</div>
@endsection