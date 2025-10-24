@extends('layouts.dashboard')

@section('page_styles')
    <link rel="stylesheet" href="{{ asset('css/pages/dashboard/reports.css') }}">
@endsection

@section('dashboard_content')
<div class="page-header">
    <h1><i class="fas fa-user-plus page-icon"></i> گزارشات جذب و استخدام</h1>
</div>

{{-- بخش کارت‌های آماری جذب و استخدام --}}
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon" style="background-color: #dcfce7;"><i class="fas fa-user-plus" style="color: #22c55e;"></i></div>
        <div class="stat-info">
            <p>جذب در ماه اخیر</p>
            <h2>8 نفر</h2>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background-color: #fee2e2;"><i class="fas fa-user-minus" style="color: #ef4444;"></i></div>
        <div class="stat-info">
            <p>خروج در ماه اخیر</p>
            <h2>2 نفر</h2>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background-color: #e0f2fe;"><i class="fas fa-chart-line" style="color: #0ea5e9;"></i></div>
        <div class="stat-info">
            <p>نرخ رشد پرسنل</p>
            <h2>+2.2%</h2>
        </div>
    </div>
</div>

{{-- بخش در حال توسعه --}}
<div class="development-section">
    <div class="development-card">
        <div class="development-icon">
            <i class="fas fa-tools"></i>
        </div>
        <div class="development-content">
            <h3>در حال توسعه</h3>
            <p>بخش گزارشات جذب و استخدام در حال توسعه است. به زودی نمودارها و گزارشات تفصیلی در این بخش قرار خواهد گرفت.</p>
            <div class="development-features">
                <h4>ویژگی‌های در حال توسعه:</h4>
                <ul>
                    <li>نمودار روند جذب ماهانه</li>
                    <li>گزارش منابع جذب</li>
                    <li>آمار مصاحبه‌ها</li>
                    <li>نرخ موفقیت استخدام</li>
                    <li>تحلیل زمان جذب</li>
                    <li>گزارش هزینه‌های جذب</li>
                </ul>
            </div>
        </div>
    </div>
</div>

{{-- بخش نمونه نمودارها (برای نمایش آینده) --}}
<div class="charts-grid">
    <div class="chart-card placeholder">
        <h3>روند جذب ماهانه</h3>
        <div class="placeholder-content">
            <i class="fas fa-chart-line placeholder-icon"></i>
            <p>نمودار روند جذب ماهانه</p>
            <span class="placeholder-text">در حال توسعه</span>
        </div>
    </div>
    
    <div class="chart-card placeholder">
        <h3>منابع جذب</h3>
        <div class="placeholder-content">
            <i class="fas fa-chart-pie placeholder-icon"></i>
            <p>نمودار منابع جذب</p>
            <span class="placeholder-text">در حال توسعه</span>
        </div>
    </div>
    
    <div class="chart-card placeholder">
        <h3>نرخ موفقیت استخدام</h3>
        <div class="placeholder-content">
            <i class="fas fa-chart-bar placeholder-icon"></i>
            <p>نمودار نرخ موفقیت</p>
            <span class="placeholder-text">در حال توسعه</span>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<style>
.development-section {
    margin: 2rem 0;
}

.development-card {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 2rem;
    border-radius: 12px;
    display: flex;
    align-items: center;
    gap: 2rem;
    box-shadow: 0 8px 32px rgba(102, 126, 234, 0.3);
}

.development-icon {
    font-size: 3rem;
    opacity: 0.8;
}

.development-content h3 {
    margin-top: 0;
    margin-bottom: 1rem;
    font-size: 1.5rem;
}

.development-content p {
    margin-bottom: 1.5rem;
    opacity: 0.9;
    line-height: 1.6;
}

.development-features h4 {
    margin-bottom: 1rem;
    font-size: 1.1rem;
}

.development-features ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.development-features li {
    padding: 0.5rem 0;
    padding-right: 1rem;
    position: relative;
}

.development-features li:before {
    content: "✓";
    position: absolute;
    right: 0;
    color: #4ade80;
    font-weight: bold;
}

.placeholder {
    background-color: #f8fafc;
    border: 2px dashed #cbd5e1;
}

.placeholder-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 200px;
    text-align: center;
    color: #64748b;
}

.placeholder-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
    opacity: 0.5;
}

.placeholder-text {
    background-color: #e2e8f0;
    color: #475569;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 500;
}

@media (max-width: 768px) {
    .development-card {
        flex-direction: column;
        text-align: center;
    }
    
    .development-icon {
        font-size: 2rem;
    }
}
</style>
@endsection
