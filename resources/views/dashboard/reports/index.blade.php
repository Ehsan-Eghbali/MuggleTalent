@extends('layouts.dashboard')

@section('page_styles')
    <link rel="stylesheet" href="{{ asset('css/pages/dashboard/reports.css') }}">
@endsection

@section('dashboard_content')
<div class="page-header">
    <h1><i class="fas fa-chart-pie page-icon"></i> گزارشات منابع انسانی</h1>
</div>

{{-- بخش کارت‌های آماری --}}
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon" style="background-color: #e0f2fe;"><i class="fas fa-users" style="color: #0ea5e9;"></i></div>
        <div class="stat-info">
            <p>تعداد کل پرسنل</p>
            <h2>{{ $stats['total_personnel'] }}</h2>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background-color: #dcfce7;"><i class="fas fa-user-plus" style="color: #22c55e;"></i></div>
        <div class="stat-info">
            <p>تعداد ورود پرسنل جدید (ماه اخیر)</p>
            <h2>{{ $stats['new_hires'] }}</h2>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background-color: #fee2e2;"><i class="fas fa-user-minus" style="color: #ef4444;"></i></div>
        <div class="stat-info">
            <p>تعداد خروج (ماه اخیر)</p>
            <h2>{{ $stats['departures'] }}</h2>
        </div>
    </div>
</div>

{{-- بخش نمودارها --}}
<div class="charts-grid">
    <div class="chart-card">
        <h3>پرسنل در هر واحد</h3>
        <canvas id="departmentChart"></canvas>
    </div>
    <div class="chart-card">
        <h3>پرسنل فنی و غیر فنی</h3>
        <canvas id="techChart"></canvas>
    </div>
    <div class="chart-card">
        <h3>چارت جنسیت سازمان</h3>
        <canvas id="genderChart"></canvas>
    </div>
</div>
@endsection

@section('scripts')
{{-- کتابخانه Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // تبدیل داده‌های Blade به متغیرهای جاوااسکریپت
    const departmentData = @json($departmentData);
    const techData = @json($techData);
    const genderData = @json($genderData);

    // نمودار تعداد پرسنل در هر واحد
    new Chart(document.getElementById('departmentChart'), {
        type: 'bar',
        data: {
            labels: departmentData.labels,
            datasets: [{
                label: 'تعداد پرسنل',
                data: departmentData.data,
                backgroundColor: '#38bdf8',
                borderColor: '#0ea5e9',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: { y: { beginAtZero: true } },
            plugins: { legend: { display: false } }
        }
    });

    // نمودار پرسنل فنی و غیر فنی
    new Chart(document.getElementById('techChart'), {
        type: 'doughnut',
        data: {
            labels: techData.labels,
            datasets: [{
                data: techData.data,
                backgroundColor: ['#4ade80', '#facc15']
            }]
        },
        options: { responsive: true }
    });

    // نمودار چارت جنسیت
    new Chart(document.getElementById('genderChart'), {
        type: 'pie',
        data: {
            labels: genderData.labels,
            datasets: [{
                data: genderData.data,
                backgroundColor: ['#60a5fa', '#f472b6']
            }]
        },
        options: { responsive: true }
    });
});
</script>
@endsection