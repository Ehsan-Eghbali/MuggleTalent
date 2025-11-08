@extends('layouts.dashboard')

@section('page_styles')
    {{-- ما حالا فقط به این یک فایل CSS نیاز داریم --}}
    <link rel="stylesheet" href="{{ asset('css/pages/dashboard/onboarding.css') }}">
@endsection

@section('dashboard_content')
<div class="page-header">
    <h1><i class="fas fa-user-check page-icon"></i> رصد فرآیند آنبوردینگ</h1>
</div>

{{-- بخش کارت‌های آماری (KPIs) --}}
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon" style="background-color: #e0f2fe;"><i class="fas fa-users" style="color: #0ea5e9;"></i></div>
        <div class="stat-info">
            <p>تعداد کل در حال آنبوردینگ</p>
            <h2>{{ $kpis['total_onboarding'] }} نفر</h2>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background-color: #fef9c3;"><i class="fas fa-hourglass-half" style="color: #eab308;"></i></div>
        <div class="stat-info">
            <p>نیازمند ثبت (ماه اول)</p>
            <h2>{{ $kpis['pending_month_1'] }} نفر</h2>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background-color: #fef9c3;"><i class="fas fa-hourglass-half" style="color: #eab308;"></i></div>
        <div class="stat-info">
            <p>نیازمند ثبت (ماه دوم)</p>
            <h2>{{ $kpis['pending_month_2'] }} نفر</h2>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon" style="background-color: #fef9c3;"><i class="fas fa-hourglass-half" style="color: #eab308;"></i></div>
        <div class="stat-info">
            <p>نیازمند ثبت (ماه سوم)</p>
            <h2>{{ $kpis['pending_month_3'] }} نفر</h2>
        </div>
    </div>
</div>

{{-- بخش جدول رصد پرسنل --}}
<div class="report-table-card">
    <h3><i class="fas fa-list-check icon-mr"></i> لیست رصد پرسنل (۳ ماهه)</h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>نام پرسنل</th>
                    <th>تاریخ استخدام</th>
                    <th>واحد سازمانی</th>
                    <th>وضعیت ماه اول</th>
                    <th>وضعیت ماه دوم</th>
                    <th>وضعیت ماه سوم</th>
                    <th class="text-center">عملیات</th> {{-- تراز وسط --}}
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $employee)
                    <tr>
                        <td>{{ $employee['name'] }}</td>
                        <td>{{ $employee['hire_date'] }}</td>
                        <td>{{ $employee['department'] }}</td>
                        
                        {{-- ماه اول --}}
                        <td>
                            @php $status_text = ['completed' => 'تکمیل شده', 'pending' => 'در انتظار ثبت', 'not_started' => 'شروع نشده']; @endphp
                            <span class="status-badge status-{{ $employee['progress']['month_1'] }}">
                                {{ $status_text[$employee['progress']['month_1']] }}
                            </span>
                        </td>
                        
                        {{-- ماه دوم --}}
                        <td>
                            <span class="status-badge status-{{ $employee['progress']['month_2'] }}">
                                {{ $status_text[$employee['progress']['month_2']] }}
                            </span>
                        </td>
                        
                        {{-- ماه سوم --}}
                        <td>
                            <span class="status-badge status-{{ $employee['progress']['month_3'] }}">
                                {{ $status_text[$employee['progress']['month_3']] }}
                            </span>
                        </td>

                        {{-- ستون عملیات --}}
                        <td class="text-center">
                            @php
                                $can_submit = false;
                                $target_month = 0;

                                if ($employee['progress']['month_1'] == 'pending') { $can_submit = true; $target_month = 1; }
                                else if ($employee['progress']['month_2'] == 'pending') { $can_submit = true; $target_month = 2; }
                                else if ($employee['progress']['month_3'] == 'pending') { $can_submit = true; $target_month = 3; }
                            @endphp

                            @if($can_submit)
                                <button class="action-button open-modal-btn"
                                        data-id="{{ $employee['id'] }}"
                                        data-name="{{ $employee['name'] }}"
                                        data-month="{{ $target_month }}">
                                    <i class="fas fa-pen-to-square"></i> ثبت
                                </button>
                            @else
                                <span class="no-action-label">---</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


{{-- ============================================= --}}
{{-- HTML پاپ‌آپ (Modal) --}}
{{-- (بدون تغییر) --}}
{{-- ============================================= --}}
<div class="modal-overlay" id="feedbackModal">
    <div class="modal-content">
        
        <div class="modal-header">
            <h3 id="modalTitle">ثبت بازخورد عملکرد</h3>
            <button class="close-modal-btn" data-target="#feedbackModal">&times;</button>
        </div>
        
        <form action="{{-- route('onboarding.feedback.store') --}}" method="POST">
            @csrf
            <input type="hidden" name="employee_id" id="modalEmployeeId">
            <input type="hidden" name="month" id="modalMonth">

            <div class="modal-body">
                <p id="modalEmployeeInfo"></p>
                <div class="form-group">
                    <label for="feedback_text">ثبت بازخورد عملکرد:</label>
                    <textarea name="feedback_text" id="feedback_text" rows="5" placeholder="بازخورد خود را در مورد عملکرد این کارمند در این ماه وارد کنید..." required></textarea>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="submit" class="modal-button modal-button-primary">ذخیره بازخورد</button>
                <button type="button" class="modal-button modal-button-secondary close-modal-btn" data-target="#feedbackModal">انصراف</button>
            </div>
        </form>

    </div>
</div>
@endsection

@section('scripts')

{{-- اسکریپت‌های JS برای کنترل پاپ‌آپ --}}
{{-- (بدون تغییر) --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        const modal = document.getElementById('feedbackModal');
        if (!modal) return; 

        const modalTitle = document.getElementById('modalTitle');
        const modalEmployeeInfo = document.getElementById('modalEmployeeInfo');
        const modalEmployeeId = document.getElementById('modalEmployeeId');
        const modalMonth = document.getElementById('modalMonth');
        const feedbackText = document.getElementById('feedback_text');

        document.querySelectorAll('.open-modal-btn').forEach(button => {
            button.addEventListener('click', function() {
                const employeeId = this.dataset.id;
                const employeeName = this.dataset.name;
                const month = this.dataset.month;

                modalTitle.textContent = `ثبت عملکرد (ماه ${month})`;
                modalEmployeeInfo.textContent = `در حال ثبت بازخورد برای: ${employeeName}`;
                modalEmployeeId.value = employeeId;
                modalMonth.value = month;
                
                feedbackText.value = '';

                modal.classList.add('active');
            });
        });

        function closeModal() {
            modal.classList.remove('active');
        }

        document.querySelectorAll('.close-modal-btn').forEach(button => {
            button.addEventListener('click', closeModal);
        });

        modal.addEventListener('click', function(event) {
            if (event.target === modal) {
                closeModal();
            }
        });

    });
</script>
@endsection