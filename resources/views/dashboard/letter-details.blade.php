@extends('layouts.dashboard')

@section('page_styles')
    <link rel="stylesheet" href="{{ asset('css/pages/dashboard/archive.css') }}">
@endsection

@section('dashboard_content')
<div class="page-header">
    <h1><i class="fas fa-file-alt page-icon"></i> جزئیات نامه</h1>
    <div class="page-actions">
        <a href="{{ route('archive.index') }}" class="btn-secondary">
            <i class="fas fa-arrow-right"></i> بازگشت به آرشیو
        </a>
        @if($letter->attachments()->where('mime', 'application/pdf')->exists())
        <a href="{{ route('archive.download', $letter->id) }}" class="btn-primary">
            <i class="fas fa-download"></i> دانلود PDF
        </a>
        @endif
    </div>
</div>

<div class="letter-details-container">
    <div class="letter-info-card">
        <h3>اطلاعات کلی نامه</h3>
        <div class="info-grid">
            <div class="info-item">
                <label>شماره نامه:</label>
                <span>{{ $letter->number }}</span>
            </div>
            <div class="info-item">
                <label>نوع نامه:</label>
                <span class="badge">{{ $letter->template_key === 'employment_certificate' ? 'گواهی اشتغال به کار' : 'گواهی کسر از حقوق' }}</span>
            </div>
            <div class="info-item">
                <label>تاریخ صدور:</label>
                <span>{{ $letter->issued_at ? $letter->issued_at->format('Y/m/d') : $letter->created_at->format('Y/m/d') }}</span>
            </div>
            <div class="info-item">
                <label>وضعیت:</label>
                <span class="status-badge {{ $letter->status === 'final' ? 'final' : 'draft' }}">
                    {{ $letter->status === 'final' ? 'نهایی' : 'پیش‌نویس' }}
                </span>
            </div>
        </div>
    </div>

    <div class="personnel-info-card">
        <h3>اطلاعات پرسنل</h3>
        <div class="info-grid">
            <div class="info-item">
                <label>نام و نام خانوادگی:</label>
                <span>{{ $letter->personnel->full_name ?? 'نامشخص' }}</span>
            </div>
            <div class="info-item">
                <label>کد پرسنلی:</label>
                <span>{{ $letter->personnel->employee_number ?? 'نامشخص' }}</span>
            </div>
            <div class="info-item">
                <label>سمت:</label>
                <span>{{ $letter->personnel->position_chart ?? 'نامشخص' }}</span>
            </div>
            <div class="info-item">
                <label>واحد:</label>
                <span>{{ $letter->personnel->department ?? 'نامشخص' }}</span>
            </div>
        </div>
    </div>

    @if($letter->fields)
    <div class="letter-fields-card">
        <h3>اطلاعات اضافی نامه</h3>
        <div class="info-grid">
            @foreach($letter->fields as $key => $value)
            <div class="info-item">
                <label>{{ app('App\Http\Controllers\ArchiveController')->getFieldLabel($key) }}:</label>
                <span>{{ $value }}</span>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    @if($letter->body_html)
    <div class="letter-content-card">
        <h3>محتوای نامه</h3>
        <div class="letter-content">
            {!! $letter->body_html !!}
        </div>
    </div>
    @endif

    @if($letter->attachments->count() > 0)
    <div class="attachments-card">
        <h3>فایل‌های پیوست</h3>
        <div class="attachments-list">
            @foreach($letter->attachments as $attachment)
            <div class="attachment-item">
                <div class="file-info">
                    <i class="fas fa-file-pdf file-icon"></i>
                    <div class="file-details">
                        <span class="file-name">{{ $attachment->original_name }}</span>
                        <span class="file-meta">
                            {{ $attachment->created_at->format('Y/m/d H:i') }} - 
                            {{ app('App\Http\Controllers\ArchiveController')->formatFileSize($attachment->size) }}
                        </span>
                    </div>
                </div>
                <div class="file-actions">
                    <a href="{{ route('letters.attachments.download', [$letter->id, $attachment->id]) }}" 
                       class="action-icon view-icon" title="دانلود">
                        <i class="fas fa-download"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
    // اضافه کردن استایل‌های اضافی برای نمایش بهتر جزئیات
    document.addEventListener('DOMContentLoaded', function() {
        // اضافه کردن کلاس‌های CSS برای بهتر نمایش دادن
        const letterContent = document.querySelector('.letter-content');
        if (letterContent) {
            letterContent.style.cssText = `
                background: #f8f9fa;
                padding: 1.5rem;
                border-radius: 8px;
                border: 1px solid #e9ecef;
                line-height: 1.8;
                font-size: 14px;
            `;
        }
    });
</script>
@endsection
