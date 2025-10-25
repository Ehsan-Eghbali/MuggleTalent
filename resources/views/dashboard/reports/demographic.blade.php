@extends('layouts.dashboard')

@section('page_styles')
    <link rel="stylesheet" href="{{ asset('css/pages/dashboard/reports.css') }}">
@endsection

@section('dashboard_content')
<div class="page-header">
    <h1><i class="fas fa-chart-bar page-icon"></i> گزارشات جمعیت شناختی</h1>
</div>

{{-- بخش کارت‌های آماری جمعیت شناختی --}}
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon" style="background-color: #e0f2fe;"><i class="fas fa-users" style="color: #0ea5e9;"></i></div>
        <div class="stat-info">
            <p>تعداد کل پرسنل</p>
            <h2>278 نفر</h2>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background-color: #dcfce7;"><i class="fas fa-building" style="color: #22c55e;"></i></div>
        <div class="stat-info">
            <p>تعداد کل افراد حضوری</p>
            <h2>222 نفر</h2>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background-color: #fef3c7;"><i class="fas fa-home" style="color: #f59e0b;"></i></div>
        <div class="stat-info">
            <p>تعداد کل افراد دورکار</p>
            <h2>56 نفر</h2>
        </div>
    </div>
</div>

{{-- بخش نمودارهای جمعیت شناختی --}}
<div class="charts-grid">
    <div class="chart-card">
        <h3>توزیع جنسیت سازمان</h3>
        <canvas id="genderChart"></canvas>
        <div class="chart-details">
            <div class="detail-item">
                <span class="detail-label">زنان:</span>
                <span class="detail-value">46%</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">مردان:</span>
                <span class="detail-value">54%</span>
            </div>
        </div>
    </div>
    
    <div class="chart-card">
        <h3>پرسنل در هر تیم</h3>
        <canvas id="teamChart"></canvas>
        <div class="chart-details">
            <div class="detail-item">
                <span class="detail-label">تپسل:</span>
                <span class="detail-value">170 نفر</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">فانتوری:</span>
                <span class="detail-value">56 نفر</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">متریکس:</span>
                <span class="detail-value">10 نفر</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">مدیاهاوس:</span>
                <span class="detail-value">23 نفر</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">گروه هوش مصنوعی:</span>
                <span class="detail-value">39 نفر</span>
            </div>
        </div>
    </div>
    
    <div class="chart-card">
        <h3>پرسنل فنی و غیر فنی</h3>
        <canvas id="techChart"></canvas>
        <div class="chart-details">
            <div class="detail-item">
                <span class="detail-label">پرسنل فنی:</span>
                <span class="detail-value">67%</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">پرسنل غیر فنی:</span>
                <span class="detail-value">33%</span>
            </div>
        </div>
    </div>
</div>

{{-- جدول جزئیات تیم‌ها --}}
<div class="details-table-section">
    <h3>جزئیات تیم‌ها</h3>
    <div class="table-container">
        <table class="details-table">
            <thead>
                <tr>
                    <th>نام تیم</th>
                    <th>تعداد پرسنل</th>
                    <th>درصد از کل</th>
                    <th>نوع فعالیت</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>تپسل</td>
                    <td>170 نفر</td>
                    <td>61.2%</td>
                    <td>فنی</td>
                </tr>
                <tr>
                    <td>فانتوری</td>
                    <td>56 نفر</td>
                    <td>20.1%</td>
                    <td>فنی</td>
                </tr>
                <tr>
                    <td>گروه هوش مصنوعی</td>
                    <td>39 نفر</td>
                    <td>14.0%</td>
                    <td>فنی</td>
                </tr>
                <tr>
                    <td>مدیاهاوس</td>
                    <td>23 نفر</td>
                    <td>8.3%</td>
                    <td>غیر فنی</td>
                </tr>
                <tr>
                    <td>متریکس</td>
                    <td>10 نفر</td>
                    <td>3.6%</td>
                    <td>غیر فنی</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
{{-- کتابخانه Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // نمودار جنسیت
    new Chart(document.getElementById('genderChart'), {
        type: 'pie',
        data: {
            labels: ['مردان', 'زنان'],
            datasets: [{
                data: [54, 46],
                backgroundColor: ['#60a5fa', '#f472b6'],
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true
                    }
                }
            }
        }
    });

    // نمودار تیم‌ها
    new Chart(document.getElementById('teamChart'), {
        type: 'bar',
        data: {
            labels: ['تپسل', 'فانتوری', 'متریکس', 'مدیاهاوس', 'گروه هوش مصنوعی'],
            datasets: [{
                label: 'تعداد پرسنل',
                data: [170, 56, 10, 23, 39],
                backgroundColor: [
                    '#3b82f6',
                    '#10b981',
                    '#f59e0b',
                    '#ef4444',
                    '#8b5cf6'
                ],
                borderColor: [
                    '#1d4ed8',
                    '#059669',
                    '#d97706',
                    '#dc2626',
                    '#7c3aed'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value + ' نفر';
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // نمودار فنی/غیر فنی
    new Chart(document.getElementById('techChart'), {
        type: 'doughnut',
        data: {
            labels: ['پرسنل فنی', 'پرسنل غیر فنی'],
            datasets: [{
                data: [67, 33],
                backgroundColor: ['#4ade80', '#facc15'],
                borderWidth: 3,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true
                    }
                }
            }
        }
    });
});
</script>

<style>
.chart-details {
    margin-top: 1rem;
    padding-top: 1rem;
    border-top: 1px solid #e5e7eb;
}

.detail-item {
    display: flex;
    justify-content: space-between;
    margin-bottom: 0.5rem;
    padding: 0.25rem 0;
}

.detail-label {
    font-weight: 500;
    color: #374151;
}

.detail-value {
    font-weight: 600;
    color: #1f2937;
}

.details-table-section {
    margin-top: 2rem;
    background-color: #fff;
    padding: 1.5rem;
    border-radius: 12px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
}

.details-table-section h3 {
    margin-top: 0;
    margin-bottom: 1.5rem;
    color: #334155;
}

.table-container {
    overflow-x: auto;
}

.details-table {
    width: 100%;
    border-collapse: collapse;
}

.details-table th,
.details-table td {
    padding: 0.75rem;
    text-align: right;
    border-bottom: 1px solid #e5e7eb;
}

.details-table th {
    background-color: #f8fafc;
    font-weight: 600;
    color: #374151;
}

.details-table tbody tr:hover {
    background-color: #f8fafc;
}
</style>
@endsection

