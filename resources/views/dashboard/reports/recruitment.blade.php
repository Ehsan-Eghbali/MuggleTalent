@extends('layouts.dashboard')

@section('page_styles')
    <link rel="stylesheet" href="{{ asset('css/pages/dashboard/reports.css') }}">
@endsection

@section('dashboard_content')
<div class="page-header">
    <h1><i class="fas fa-user-plus page-icon"></i> گزارشات جذب و استخدام</h1>
</div>

{{-- بخش کارت‌های آماری جذب و استخدام --}}
<div class="stats-grid stats-grid-expanded">
    {{-- کارت ۱: جذب در ماه اخیر --}}
    <div class="stat-card">
        <div class="stat-icon" style="background-color: #dcfce7;"><i class="fas fa-user-plus" style="color: #22c55e;"></i></div>
        <div class="stat-info">
            <p>جذب در ماه اخیر (آبان)</p>
            <h2>{{ $kpis['recent_hires'] }} نفر</h2>
        </div>
    </div>
    {{-- کارت ۲: خروج در ماه اخیر --}}
    <div class="stat-card">
        <div class="stat-icon" style="background-color: #fee2e2;"><i class="fas fa-user-minus" style="color: #ef4444;"></i></div>
        <div class="stat-info">
            <p>خروج در ماه اخیر (آبان)</p>
            <h2>{{ $kpis['recent_leavers'] }} نفر</h2>
        </div>
    </div>
    {{-- کارت ۳: نرخ رشد پرسنل --}}
    <div class="stat-card">
        <div class="stat-icon" style="background-color: #e0f2fe;"><i class="fas fa-chart-line" style="color: #0ea5e9;"></i></div>
        <div class="stat-info">
            <p>نرخ رشد پرسنل</p>
            <h2>{{ $kpis['net_growth_rate'] }}</h2>
        </div>
    </div>
    {{-- کارت ۴: متوسط زمان استخدام (Time to Fill) --}}
    <div class="stat-card">
        <div class="stat-icon" style="background-color: #fef3c7;"><i class="fas fa-calendar-check" style="color: #f59e0b;"></i></div>
        <div class="stat-info">
            <p>متوسط زمان استخدام (Time to Fill)</p>
            <h2>{{ $kpis['time_to_fill'] }}</h2>
        </div>
    </div>
    {{-- کارت ۵: متوسط زمان جذب (Time to Hire) --}}
    <div class="stat-card">
        <div class="stat-icon" style="background-color: #ede9fe;"><i class="fas fa-stopwatch" style="color: #8b5cf6;"></i></div>
        <div class="stat-info">
            <p>متوسط زمان جذب (Time to Hire)</p>
            <h2>{{ $kpis['time_to_hire'] }}</h2>
        </div>
    </div>
    {{-- کارت ۶: متوسط زمان رد کارجو --}}
    <div class="stat-card">
        <div class="stat-icon" style="background-color: #fee2e2;"><i class="fas fa-user-times" style="color: #f43f5e;"></i></div>
        <div class="stat-info">
            <p>متوسط زمان رد کارجو</p>
            <h2>{{ $kpis['avg_rejection_time'] }}</h2>
        </div>
    </div>
    {{-- کارت ۷: بیشترین خروج از (جدید) --}}
    <div class="stat-card stat-card-highlight">
        <div class="stat-icon" style="background-color: #fce7f3;"><i class="fas fa-times-circle" style="color: #db2777;"></i></div>
        <div class="stat-info">
            <p>بیشترین خروج از</p>
            <h2>{{ $kpis['top_leaver_source'] }}</h2>
        </div>
    </div>
    {{-- کارت ۷: بیشترین ورود از (جدید) --}}
    <div class="stat-card stat-card-highlight">
        <div class="stat-icon" style="background-color: #afdbc5;"><i class="fas fa-user-plus" style="color: hsl(162, 77%, 52%);"></i></div>
        <div class="stat-info">
            <p>بیشترین ورود از</p>
            <h2>{{ $kpis['top_leaver_source'] }}</h2>
        </div>
    </div>
</div>

{{-- بخش نمودارها --}}
<div class="charts-grid chart-grid-three-columns"> {{-- تغییر به سه ستون برای نمودارها --}}
    
    {{-- نمودار ۱: روند جذب و خروج (میله‌ای) --}}
    <div class="chart-card">
        <h3><i class="fas fa-chart-bar icon-mr"></i> روند جذب و خروج ماهانه</h3>
        <div class="chart-container">
            <canvas id="monthlyTrendChart"></canvas>
        </div>
    </div>
    
    {{-- نمودار ۲: کانال‌های جذب (دایره‌ای - Donut Chart) --}}
    <div class="chart-card donut-chart-card">
        <h3><i class="fas fa-chart-pie icon-mr"></i> کانال‌های جذب</h3>
        <div class="chart-container">
             <canvas id="channelsDonutChart"></canvas>
        </div>
        <div class="chart-legend-custom">
            @php $total_cvs = array_sum(array_column($channels, 'cv_count')); @endphp
            @foreach($channels as $index => $channel)
                <div class="legend-item">
                    <span class="legend-color-box channel-{{ $index }}"></span>
                    <span class="legend-label">{{ $channel['name'] }}:</span>
                    <span class="legend-percentage">{{ $total_cvs > 0 ? number_format(($channel['cv_count'] / $total_cvs) * 100, 1) : 0 }}%</span>
                </div>
            @endforeach
        </div>
    </div>

    {{-- نمودار ۳: ورود و خروج بر اساس کسب‌وکار (جدید) --}}
    <div class="chart-card">
        <h3><i class="fas fa-building icon-mr"></i> ورود و خروج بر اساس کسب‌وکار</h3>
        <div class="chart-container">
            <canvas id="businessUnitChart"></canvas>
        </div>
    </div>

</div>

@endsection

@section('scripts')

{{-- ۱. اضافه کردن کتابخانه Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script> {{-- پلاگین برای نمایش عدد روی چارت --}}

{{-- ۲. اسکریپت راه‌اندازی نمودارها --}}
<script>
    // منتظر می‌مانیم تا کل DOM لود شود
    document.addEventListener('DOMContentLoaded', function () {
        
        // دریافت امن دیتای PHP و تبدیل به JSON
        const monthlyData = @json($monthly_stats);
        const channelData = @json($channels);
        const businessUnitData = @json($business_unit_stats); // دیتای جدید

        Chart.register(ChartDataLabels); // ثبت پلاگین دیتالیبلز

        // --- نمودار ۱: روند جذب و خروج (میله‌ای) ---
        const ctxMonthly = document.getElementById('monthlyTrendChart').getContext('2d');
        if (ctxMonthly) {
            new Chart(ctxMonthly, {
                type: 'bar',
                data: {
                    labels: monthlyData.map(d => d.month),
                    datasets: [
                        {
                            label: 'جذب',
                            data: monthlyData.map(d => d.hired),
                            backgroundColor: '#22c55e', // سبز
                            borderColor: '#16a34a',
                            borderWidth: 1,
                            borderRadius: 4
                        },
                        {
                            label: 'خروج',
                            data: monthlyData.map(d => d.left),
                            backgroundColor: '#ef4444', // قرمز
                            borderColor: '#dc2626',
                            borderWidth: 1,
                            borderRadius: 4
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: { font: { family: 'Vazirmatn, sans-serif', size: 13 }, boxWidth: 20 }
                        },
                        tooltip: {
                            rtl: true,
                            titleFont: { family: 'Vazirmatn, sans-serif', size: 14, weight: 'bold' },
                            bodyFont: { family: 'Vazirmatn, sans-serif', size: 13 },
                            callbacks: {
                                label: function(context) {
                                    return context.dataset.label + ': ' + context.parsed.y + ' نفر';
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { font: { family: 'Vazirmatn, sans-serif' } },
                            title: { display: true, text: 'تعداد نفرات', font: { family: 'Vazirmatn, sans-serif', size: 14 } }
                        },
                        x: {
                            ticks: { font: { family: 'Vazirmatn, sans-serif' } }
                        }
                    }
                }
            });
        }

        // --- نمودار ۲: کانال‌های جذب (Donut Chart - شبیه عکس شما) ---
        const ctxChannels = document.getElementById('channelsDonutChart').getContext('2d');
        if (ctxChannels) {
            // رنگ‌های سفارشی برای نمودار دایره‌ای، می‌توانید بیشتر اضافه کنید
            const donutColors = ['#facc15', '#22c55e', '#ef4444', '#3b82f6', '#8b5cf6'];
            
            new Chart(ctxChannels, {
                type: 'doughnut', // تغییر به doughnut
                data: {
                    labels: channelData.map(c => c.name),
                    datasets: [{
                        label: 'تعداد رزومه دریافتی',
                        data: channelData.map(c => c.cv_count),
                        backgroundColor: donutColors.slice(0, channelData.length), // استفاده از رنگ‌های سفارشی
                        hoverOffset: 4,
                        borderWidth: 0 // حذف خط مرزی بین بخش‌ها برای ظاهر نرم‌تر
                    }]
                },
                plugins: [ChartDataLabels], // فعال‌سازی پلاگین نمایش درصد
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '60%', // اندازه سوراخ وسط برای ظاهر Donut Chart
                    plugins: {
                        datalabels: {
                            formatter: (value, ctx) => {
                                const sum = ctx.chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                                const percentage = (value * 100 / sum).toFixed(1) + '%';
                                return percentage;
                            },
                            color: '#fff',
                            font: { weight: 'bold', family: 'Vazirmatn, sans-serif', size: 14 },
                            // تنظیم موقعیت دیتالیبل برای جلوگیری از تداخل
                            anchor: 'center',
                            align: 'center',
                            offset: 0
                        },
                        legend: {
                            display: false, // پنهان کردن legend پیش‌فرض Chart.js
                            labels: { font: { family: 'Vazirmatn, sans-serif', size: 13 }, boxWidth: 20 }
                        },
                        tooltip: {
                            rtl: true,
                            titleFont: { family: 'Vazirmatn, sans-serif', size: 14, weight: 'bold' },
                            bodyFont: { family: 'Vazirmatn, sans-serif', size: 13 },
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    let value = context.parsed;
                                    const sum = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = (value * 100 / sum).toFixed(1);
                                    return label + ': ' + value.toLocaleString('fa-IR') + ' رزومه (' + percentage + '%)';
                                }
                            }
                        }
                    }
                }
            });

            // تنظیم رنگ‌های سفارشی در legend پایین نمودار (HTML)
            document.querySelectorAll('.legend-color-box').forEach((box, index) => {
                box.style.backgroundColor = donutColors[index % donutColors.length];
            });
        }

        // --- نمودار ۳: ورود و خروج بر اساس کسب‌وکار (میله‌ای) ---
        const ctxBusiness = document.getElementById('businessUnitChart').getContext('2d');
        if (ctxBusiness) {
            new Chart(ctxBusiness, {
                type: 'bar',
                data: {
                    labels: businessUnitData.map(d => d.name),
                    datasets: [
                        {
                            label: 'ورود',
                            data: businessUnitData.map(d => d.hired),
                            backgroundColor: '#3b82f6', // آبی
                            borderColor: '#2563eb',
                            borderWidth: 1,
                            borderRadius: 4
                        },
                        {
                            label: 'خروج',
                            data: businessUnitData.map(d => d.left),
                            backgroundColor: '#f43f5e', // صورتی-قرمز
                            borderColor: '#e11d48',
                            borderWidth: 1,
                            borderRadius: 4
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: { font: { family: 'Vazirmatn, sans-serif', size: 13 }, boxWidth: 20 }
                        },
                        tooltip: {
                            rtl: true,
                            titleFont: { family: 'Vazirmatn, sans-serif', size: 14, weight: 'bold' },
                            bodyFont: { family: 'Vazirmatn, sans-serif', size: 13 },
                            callbacks: {
                                label: function(context) {
                                    return context.dataset.label + ': ' + context.parsed.y + ' نفر';
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { font: { family: 'Vazirmatn, sans-serif' } },
                            title: { display: true, text: 'تعداد نفرات', font: { family: 'Vazirmatn, sans-serif', size: 14 } }
                        },
                        x: {
                            ticks: { font: { family: 'Vazirmatn, sans-serif' } }
                        }
                    }
                }
            });
        }

    });
</script>


{{-- ۳. استایل‌های CSS --}}
<style>
/* --- استایل فونت عمومی (برای Chart.js) --- */
body {
    font-family: 'Vazirmatn', sans-serif; /* اطمینان از اعمال فونت فارسی */
}

/* --- استایل کارت‌های آماری (از مرحله قبل + کارت جدید) --- */
.stat-card {
    padding: 1.25rem;
    gap: 1rem; 
}
.stat-icon {
    width: 52px;
    height: 52px;
}
.stat-icon i {
    font-size: 1.3rem;
}
.stat-info h2 {
    font-size: 1.3rem;
    margin-top: 0.25rem;
}
.stat-info p {
    font-size: 0.875rem;
}
.stats-grid-expanded {
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); /* کمی فشرده‌تر برای ۷ کارت */
}
.stat-card-highlight {
    background-color: #b9dee4; /* رنگ پس‌زمینه برای برجسته کردن */
    border: 1px solid #65e1b6;
}

/* --- استایل جدید برای گرید نمودارها (۳ ستونه) --- */
.charts-grid.chart-grid-three-columns {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); /* ۳ ستون در صفحات بزرگتر */
    gap: 1.5rem;
    margin-top: 1.5rem;
}

/* --- استایل جدید برای کارت‌های نمودار --- */
.chart-card {
    background-color: #ffffff;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    margin-bottom: 0; /* حذف margin-bottom برای grid جدید */
    display: flex;
    flex-direction: column;
}
.chart-card h3 {
    margin-top: 0;
    margin-bottom: 1rem; /* کاهش margin-bottom */
    font-size: 1.25rem;
    color: #1f2937;
    display: flex;
    align-items: center;
    justify-content: center; /* تراز وسط برای عنوان */
}
.icon-mr {
    margin-left: 0.75rem;
    color: #4b5563;
}
.chart-container {
    flex-grow: 1; /* اجازه رشد به کانتینر نمودار */
    position: relative;
    height: 300px; /* ارتفاع ثابت برای نمودارها */
}
.chart-card canvas {
    max-height: 100%;
    width: 100% !important;
}

/* --- استایل‌های خاص برای Donut Chart شبیه عکس شما --- */
.donut-chart-card {
    display: flex;
    flex-direction: column;
    align-items: center; /* تراز مرکزی */
    justify-content: center;
}
.donut-chart-card h3 {
    text-align: center;
    margin-bottom: 1.5rem;
}
.donut-chart-card .chart-container {
    height: 250px; /* ارتفاع کمتر برای نمودار دایره‌ای */
    margin-bottom: 1rem;
}
.chart-legend-custom {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 1rem;
    font-size: 0.95rem;
    color: #333;
    direction: rtl; /* برای فارسی */
}
.legend-item {
    display: flex;
    align-items: center;
    margin-bottom: 0.5rem;
}
.legend-color-box {
    width: 16px;
    height: 16px;
    border-radius: 4px;
    margin-left: 0.5rem;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}
.legend-label {
    font-weight: 500;
}
.legend-percentage {
    font-weight: 700;
    margin-right: 0.3rem; /* فاصله درصد از لیبل */
}

/* رنگ‌های سفارشی برای Legend Donut Chart - باید با Javascript هم ست شود */
.channel-0 { background-color: #facc15; } /* زرد */
.channel-1 { background-color: #22c55e; } /* سبز */
.channel-2 { background-color: #ef4444; } /* قرمز */
.channel-3 { background-color: #3b82f6; } /* آبی */
/* .channel-4 { background-color: #8b5cf6; }  بنفش - اگر کانال پنجم اضافه شد */


/* --- استایل Placeholder (بدون تغییر) --- */
.placeholder {
    background-color: #f8fafc;
    border: 2px dashed #cbd5e1;
    height: 450px; /* بازگشت به ارتفاع اولیه برای Placeholder */
}
.placeholder-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100%; /* استفاده از 100% کانتینر placeholder */
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

/* --- Media Queries برای ریسپانسیو بودن --- */
@media (max-width: 1024px) {
    .charts-grid.chart-grid-three-columns {
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); /* دو ستون در تبلت */
    }
}
@media (max-width: 768px) {
    .charts-grid.chart-grid-three-columns {
        grid-template-columns: 1fr; /* یک ستون در موبایل */
    }
    .stat-card {
        padding: 1rem;
    }
    .stat-info h2 {
        font-size: 1rem;
    }
}
</style>
@endsection