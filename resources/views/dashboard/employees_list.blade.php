@extends('layouts.dashboard')

@section('page_styles')
    <link rel="stylesheet" href="{{ asset('css/pages/dashboard/personnel-list.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/dashboard/employee-wizard.css') }}">
@endsection

@section('dashboard_content')
<div class="page-header">
    <h1><i class="fas fa-users-cog page-icon"></i> مشاهده لیست همکاران</h1>
    <button type="button" id="open-employee-wizard-btn" class="btn-primary">
        <i class="fas fa-plus-circle"></i> افزودن همکار جدید
    </button>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="table-container-wrapper">
    <table class="data-table">
        <thead>
            <tr>
                <th>کد پرسنلی</th>
                <th>نام</th>
                <th>نام خانوادگی</th>
                <th>ایمیل سازمانی</th>
                <th>سمت شغلی</th>
                <th>وضعیت همکاری</th>
                <th>شماره تماس</th>
                <th>اقدامات</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($employees as $employee)
            <tr>
                <td>{{ $employee->employee_number }}</td>
                <td>{{ $employee->first_name }}</td>
                <td>{{ $employee->last_name }}</td>
                <td>{{ $employee->organization_email }}</td>
                <td>{{ $employee->position_chart }}</td>
                <td>{{ $employee->work_status }}</td>
                <td>{{ $employee->phone_number }}</td>
                <td>
                    <a href="{{ route('employees.show', $employee->id) }}" title="مشاهده پروفایل" class="action-icon view-icon"><i class="fas fa-eye"></i></a>
                    <a href="{{ route('employees.edit', $employee->id) }}" title="ویرایش" class="action-icon edit-icon"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('آیا از حذف این کارمند مطمئن هستید؟');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" title="حذف" class="action-icon delete-icon" style="background:none; border:none; cursor:pointer; padding:0;">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align:center;">هیچ کارمندی برای نمایش وجود ندارد.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="pagination">
        {{-- {{ $employees->links() }} --}}
    </div>
</div>

{{-- ویزارد افزودن همکار جدید --}}
<div class="modal-overlay employee-wizard-modal" id="employee-wizard-modal">
    <div class="modal-content">
        <div class="wizard-header">
            <h2><i class="fas fa-user-plus"></i> افزودن همکار جدید</h2>
            <span class="modal-close" id="close-wizard-btn" role="button" aria-label="بستن">&times;</span>
        </div>

        <div class="wizard-steps" id="wizard-steps">
            <div class="wizard-step active" data-step="1">
                <div class="wizard-step-indicator"><span class="step-number">1</span><i class="fas fa-check step-check" style="display:none;"></i></div>
                <span class="wizard-step-label">اطلاعات شخصی</span>
            </div>
            <div class="wizard-step-connector" data-connector="1"></div>
            <div class="wizard-step" data-step="2">
                <div class="wizard-step-indicator"><span class="step-number">2</span><i class="fas fa-check step-check" style="display:none;"></i></div>
                <span class="wizard-step-label">اطلاعات استخدامی</span>
            </div>
        </div>

        <form action="{{ route('employees.store') }}" method="POST" id="employee-wizard-form" novalidate>
            @csrf

            <div class="wizard-body">
                {{-- مرحله ۱: اطلاعات شخصی --}}
                <div class="wizard-panel active" data-panel="1">
                    <p class="wizard-panel-title">لطفاً اطلاعات شخصی همکار را وارد کنید</p>
                    <div class="wizard-form-grid">
                        <div class="wizard-form-group">
                            <label for="first_name"><span class="required">*</span> نام</label>
                            <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                            <span class="field-error" data-error="first_name">@error('first_name'){{ $message }}@enderror</span>
                        </div>
                        <div class="wizard-form-group">
                            <label for="last_name"><span class="required">*</span> نام خانوادگی</label>
                            <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                            <span class="field-error" data-error="last_name">@error('last_name'){{ $message }}@enderror</span>
                        </div>
                        <div class="wizard-form-group">
                            <label for="email"><span class="required">*</span> آدرس ایمیل</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                            <span class="field-error" data-error="email">@error('email'){{ $message }}@enderror</span>
                        </div>
                        <div class="wizard-form-group">
                            <label for="phone_number"><span class="required">*</span> شماره همراه</label>
                            <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required>
                            <span class="field-error" data-error="phone_number">@error('phone_number'){{ $message }}@enderror</span>
                        </div>
                        <div class="wizard-form-group">
                            <label for="national_code"><span class="required">*</span> کد ملی</label>
                            <input type="text" id="national_code" name="national_code" value="{{ old('national_code') }}" required>
                            <span class="field-error" data-error="national_code">@error('national_code'){{ $message }}@enderror</span>
                        </div>
                    </div>
                </div>

                {{-- مرحله ۲: اطلاعات استخدامی --}}
                <div class="wizard-panel" data-panel="2">
                    <p class="wizard-panel-title">لطفاً اطلاعات استخدامی همکار را وارد کنید</p>
                    <div class="wizard-form-grid">
                        <div class="wizard-form-group">
                            <label for="department"><span class="required">*</span> واحد</label>
                            <input type="text" id="department" name="department" value="{{ old('department') }}" required>
                            <span class="field-error" data-error="department">@error('department'){{ $message }}@enderror</span>
                        </div>
                        <div class="wizard-form-group">
                            <label for="position_chart"><span class="required">*</span> سمت شغلی</label>
                            <input type="text" id="position_chart" name="position_chart" value="{{ old('position_chart') }}" required>
                            <span class="field-error" data-error="position_chart">@error('position_chart'){{ $message }}@enderror</span>
                        </div>
                        <div class="wizard-form-group">
                            <label for="employee_number"><span class="required">*</span> شماره پرسنلی</label>
                            <input type="text" id="employee_number" name="employee_number" value="{{ old('employee_number') }}" required>
                            <span class="field-error" data-error="employee_number">@error('employee_number'){{ $message }}@enderror</span>
                        </div>
                        <div class="wizard-form-group">
                            <label for="entry_date"><span class="required">*</span> تاریخ شروع همکاری</label>
                            <input type="date" id="entry_date" name="entry_date" value="{{ old('entry_date') }}" required>
                            <span class="field-error" data-error="entry_date">@error('entry_date'){{ $message }}@enderror</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="wizard-footer">
                <span class="wizard-hint" id="wizard-hint">مرحله ۱ از ۲</span>
                <div class="wizard-footer-actions">
                    <button type="button" class="btn-secondary" id="wizard-back-btn" style="display:none;">قبلی</button>
                    <button type="button" class="btn-secondary" id="cancel-wizard-btn">انصراف</button>
                    <button type="button" class="btn-primary" id="wizard-next-btn">بعدی</button>
                    <button type="submit" class="btn-success" id="wizard-submit-btn" style="display:none;">
                        <i class="fas fa-user-check"></i> ایجاد کارمند
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
(function () {
    const modal = document.getElementById('employee-wizard-modal');
    const openBtn = document.getElementById('open-employee-wizard-btn');
    const closeBtn = document.getElementById('close-wizard-btn');
    const cancelBtn = document.getElementById('cancel-wizard-btn');
    const backBtn = document.getElementById('wizard-back-btn');
    const nextBtn = document.getElementById('wizard-next-btn');
    const submitBtn = document.getElementById('wizard-submit-btn');
    const form = document.getElementById('employee-wizard-form');
    const hint = document.getElementById('wizard-hint');

    const step1Fields = ['first_name', 'last_name', 'email', 'phone_number', 'national_code'];
    const step2Fields = ['department', 'position_chart', 'employee_number', 'entry_date'];

    let currentStep = 1;
    const totalSteps = 2;

    function openModal() {
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        modal.style.display = 'none';
        document.body.style.overflow = '';
    }

    function resetWizard() {
        currentStep = 1;
        updateStepUI();
        clearClientErrors();
    }

    function updateStepUI() {
        document.querySelectorAll('.wizard-step').forEach(step => {
            const stepNum = parseInt(step.dataset.step, 10);
            step.classList.remove('active', 'completed');

            const indicator = step.querySelector('.wizard-step-indicator');
            const stepNumber = step.querySelector('.step-number');
            const stepCheck = step.querySelector('.step-check');

            if (stepNum < currentStep) {
                step.classList.add('completed');
                stepNumber.style.display = 'none';
                stepCheck.style.display = 'inline';
            } else if (stepNum === currentStep) {
                step.classList.add('active');
                stepNumber.style.display = 'inline';
                stepCheck.style.display = 'none';
            } else {
                stepNumber.style.display = 'inline';
                stepCheck.style.display = 'none';
            }
        });

        document.querySelectorAll('.wizard-step-connector').forEach(connector => {
            const connectorNum = parseInt(connector.dataset.connector, 10);
            connector.classList.toggle('completed', connectorNum < currentStep);
        });

        document.querySelectorAll('.wizard-panel').forEach(panel => {
            panel.classList.toggle('active', parseInt(panel.dataset.panel, 10) === currentStep);
        });

        backBtn.style.display = currentStep > 1 ? 'inline-block' : 'none';
        nextBtn.style.display = currentStep < totalSteps ? 'inline-block' : 'none';
        submitBtn.style.display = currentStep === totalSteps ? 'inline-block' : 'none';
        hint.textContent = 'مرحله ' + currentStep + ' از ' + totalSteps;
    }

    function clearClientErrors() {
        form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
        form.querySelectorAll('.field-error').forEach(el => {
            if (!el.hasAttribute('data-server-error')) {
                el.textContent = '';
            }
        });
    }

    function showFieldError(fieldName, message) {
        const input = form.querySelector('[name="' + fieldName + '"]');
        const errorEl = form.querySelector('[data-error="' + fieldName + '"]');
        if (input) input.classList.add('is-invalid');
        if (errorEl) errorEl.textContent = message;
    }

    function validateStep(step) {
        clearClientErrors();
        const fields = step === 1 ? step1Fields : step2Fields;
        let valid = true;

        fields.forEach(name => {
            const input = form.querySelector('[name="' + name + '"]');
            if (!input) return;

            const value = input.value.trim();
            let message = '';

            if (!value) {
                message = 'این فیلد الزامی است.';
                valid = false;
            } else if (name === 'email' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
                message = 'فرمت ایمیل معتبر نیست.';
                valid = false;
            }

            if (message) {
                showFieldError(name, message);
            }
        });

        return valid;
    }

    function goToStep(step) {
        currentStep = step;
        updateStepUI();
    }

    function detectErrorStep() {
        const serverErrorFields = [];
        form.querySelectorAll('.field-error').forEach(el => {
            if (el.textContent.trim()) {
                serverErrorFields.push(el.dataset.error);
                const input = form.querySelector('[name="' + el.dataset.error + '"]');
                if (input) input.classList.add('is-invalid');
            }
        });

        if (serverErrorFields.length === 0) return 1;

        const hasStep2Error = serverErrorFields.some(f => step2Fields.includes(f));
        return hasStep2Error ? 2 : 1;
    }

    openBtn.addEventListener('click', function () {
        resetWizard();
        openModal();
    });

    closeBtn.addEventListener('click', closeModal);
    cancelBtn.addEventListener('click', closeModal);

    window.addEventListener('click', function (e) {
        if (e.target === modal) closeModal();
    });

    nextBtn.addEventListener('click', function () {
        if (validateStep(currentStep)) {
            goToStep(currentStep + 1);
        }
    });

    backBtn.addEventListener('click', function () {
        clearClientErrors();
        goToStep(currentStep - 1);
    });

    form.addEventListener('submit', function (e) {
        if (!validateStep(2)) {
            e.preventDefault();
            goToStep(2);
        }
    });

    const urlParams = new URLSearchParams(window.location.search);
    const hasServerErrors = {{ $errors->any() ? 'true' : 'false' }};

    if (urlParams.get('add') === '1' || hasServerErrors) {
        currentStep = hasServerErrors ? detectErrorStep() : 1;
        updateStepUI();
        openModal();

        if (urlParams.get('add') === '1') {
            const cleanUrl = window.location.pathname;
            window.history.replaceState({}, '', cleanUrl);
        }
    }
})();
</script>
@endsection
