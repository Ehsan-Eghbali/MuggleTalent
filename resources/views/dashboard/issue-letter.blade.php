@extends('layouts.dashboard')

@section('page_styles')
    <link rel="stylesheet" href="{{ asset('css/pages/dashboard/issue-letter.css') }}">
@endsection

@section('dashboard_content')
<div class="page-header">
    <h1><i class="fas fa-file-signature page-icon"></i> صدور آنلاین نامه</h1>
</div>

<div class="issue-letter-container">
    {{-- بخش تنظیمات و فرم --}}
    <div class="form-section">
        <div class="card">
            <div class="card-header">اطلاعات پایه</div>
            <div class="card-body">
                <div class="form-group">
                    <label for="personnel-select">انتخاب پرسنل</label>
                    <select id="personnel-select">
                        <option value="" data-name="">یک شخص را انتخاب کنید...</option>
                        {{-- در اینجا کد پرسنلی به عنوان value استفاده شده است --}}
                        @foreach($personnel_list as $person)
                            <option value="{{ $person['id'] }}" data-name="{{ $person['name'] }}">
                                {{ $person['name'] }} (کد: {{ $person['id'] }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="template-select">انتخاب قالب نامه</label>
                    <select id="template-select">
                        <option value="">یک قالب را انتخاب کنید...</option>
                        @foreach($templates_list as $template)
                            <option value="{{ $template['id'] }}">{{ $template['name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">فیلدهای نامه</div>
            <div class="card-body" id="dynamic-fields">
                <p class="placeholder-text">لطفا یک قالب نامه انتخاب کنید تا فیلدهای آن نمایش داده شود.</p>
            </div>
        </div>
        
        <button class="btn-primary full-width"><i class="fas fa-check-circle"></i> تولید و ذخیره در آرشیو</button>
    </div>

    {{-- بخش پیش‌نمایش نامه --}}
    <div class="preview-section">
        <div class="card">
            <div class="card-header">پیش‌نمایش نامه</div>
            <div class="card-body letter-preview" id="letter-preview">
                <p class="placeholder-text">پیش‌نمایش نامه در اینجا نمایش داده خواهد شد.</p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
{{-- اسکریپت‌ها بدون تغییر باقی می‌مانند --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // انتخاب عناصر صفحه
        const templateSelect = document.getElementById('template-select');
        const personnelSelect = document.getElementById('personnel-select');
        const dynamicFieldsContainer = document.getElementById('dynamic-fields');
        const previewContainer = document.getElementById('letter-preview');

        // تابع برای به‌روزرسانی پیش‌نمایش
        function updatePreview() {
            const selectedPersonnel = personnelSelect.options[personnelSelect.selectedIndex].getAttribute('data-name');
            const selectedTemplate = templateSelect.value;
            
            if (!selectedPersonnel || !selectedTemplate) {
                previewContainer.innerHTML = '<p class="placeholder-text">لطفا پرسنل و قالب نامه را انتخاب کنید.</p>';
                return;
            }

            let previewHTML = `
                <div style="text-align: right;">
                    <p><strong>شماره نامه:</strong> ۱۴۰۴/پ/۰۱۰۱ (نمونه)</p>
                    <p><strong>تاریخ:</strong> ${new Date().toLocaleDateString('fa-IR')}</p>
                    <br>
                    <h4 style="text-align: center;">گواهی اشتغال به کار</h4>
                    <br>
                    <p>بدینوسیله گواهی می‌شود، جناب آقای/خانم <strong>${selectedPersonnel}</strong>، در این شرکت مشغول به کار می‌باشند.</p>
            `;

            if (selectedTemplate === 'employment_certificate') {
                const recipient = document.getElementById('recipient_name')?.value || '[نام سازمان دریافت‌کننده]';
                previewHTML += `<p>این گواهی جهت ارائه به <strong>${recipient}</strong> صادر گردیده است.</p>`;
            } else if (selectedTemplate === 'salary_certificate') {
                const recipient = document.getElementById('recipient_name')?.value || '[نام سازمان دریافت‌کننده]';
                const amount = document.getElementById('guarantee_amount')?.value || '[مبلغ ضمانت]';
                previewHTML += `<p>ایشان متعهد به پرداخت مبلغ <strong>${amount}</strong> ریال به آن سازمان می‌باشند.</p>`;
                previewHTML += `<p>این گواهی جهت ارائه به <strong>${recipient}</strong> صادر گردیده است.</p>`;
            }
            
            previewHTML += '</div>';
            previewContainer.innerHTML = previewHTML;
        }

        // تابع برای ساخت فیلدهای داینامیک
        function renderDynamicFields() {
            const selectedTemplate = templateSelect.value;
            dynamicFieldsContainer.innerHTML = ''; // پاک کردن فیلدهای قبلی

            if (selectedTemplate === 'employment_certificate') {
                dynamicFieldsContainer.innerHTML = `
                    <div class="form-group">
                        <label for="recipient_name">نام سازمان دریافت‌کننده</label>
                        <input type="text" id="recipient_name" placeholder="مثلا: بانک ملت">
                    </div>
                `;
            } else if (selectedTemplate === 'salary_certificate') {
                dynamicFieldsContainer.innerHTML = `
                    <div class="form-group">
                        <label for="guarantee_amount">مبلغ ضمانت (به ریال)</label>
                        <input type="number" id="guarantee_amount" placeholder="مثلا: 500,000,000">
                    </div>
                    <div class="form-group">
                        <label for="recipient_name">نام سازمان دریافت‌کننده</label>
                        <input type="text" id="recipient_name" placeholder="مثلا: بانک سامان">
                    </div>
                `;
            } else {
                 dynamicFieldsContainer.innerHTML = '<p class="placeholder-text">لطفا یک قالب نامه انتخاب کنید.</p>';
            }
            
            // افزودن event listener به فیلدهای جدید برای به‌روزرسانی زنده پیش‌نمایش
            dynamicFieldsContainer.querySelectorAll('input').forEach(input => {
                input.addEventListener('input', updatePreview);
            });
            updatePreview();
        }
        
        // افزودن event listener به دراپ‌داون‌ها
        templateSelect.addEventListener('change', renderDynamicFields);
        personnelSelect.addEventListener('change', updatePreview);
    });
</script>
@endsection