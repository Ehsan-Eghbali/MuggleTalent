@extends('layouts.dashboard')

@section('page_styles')
    <link rel="stylesheet" href="{{ asset('css/pages/dashboard/payrolls.css') }}">
@endsection

@section('dashboard_content')
<div class="page-header">
    <h1><i class="fas fa-file-invoice-dollar page-icon"></i> لیست حقوق و دستمزد</h1>
    <a href="#" class="btn-secondary"><i class="fas fa-print"></i> خروجی و چاپ</a>
</div>

<div class="table-container-wrapper">
    <div class="payroll-filters">
        {{-- بخش فیلترها --}}
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th>نام پرسنل</th>
                <th>رده</th>
                <th>حقوق ۳۰ روزه</th>
                <th>پایه سنوات</th>
                <th>حق مسکن</th>
                <th>حق تاهل</th>
                <th>حق اولاد</th>
                <th>حق مسئولیت</th>
                <th>خوار و بار</th>
                <th>غیررسمی</th>
                <th>اقدامات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payrolls as $payroll)
            <tr
                data-id="{{ $payroll['id'] }}"
                data-name="{{ $payroll['personnel_name'] }}"
                data-level="{{ $payroll['level'] }}"
                data-base_salary="{{ $payroll['base_salary'] }}"
                data-seniority="{{ $payroll['seniority'] }}"
                data-housing="{{ $payroll['housing'] }}"
                data-marriage="{{ $payroll['marriage'] }}"
                data-children="{{ $payroll['children'] }}"
                data-responsibility="{{ $payroll['responsibility'] }}"
                data-food="{{ $payroll['food'] }}"
                data-informal="{{ $payroll['informal'] }}"
            >
                <td>{{ $payroll['personnel_name'] }}</td>
                <td>{{ $payroll['level'] }}</td>
                <td>{{ $payroll['base_salary'] }}</td>
                <td>{{ $payroll['seniority'] }}</td>
                <td>{{ $payroll['housing'] }}</td>
                <td>{{ $payroll['marriage'] }}</td>
                <td>{{ $payroll['children'] }}</td>
                <td>{{ $payroll['responsibility'] }}</td>
                <td>{{ $payroll['food'] }}</td>
                <td>{{ $payroll['informal'] }}</td>
                <td>
                    <a href="#" title="نمایش جزئیات" class="action-icon view-icon" data-mode="view"><i class="fas fa-eye"></i></a>
                    <a href="#" title="ویرایش" class="action-icon edit-icon" data-mode="edit"><i class="fas fa-edit"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- کد HTML کامل پاپ‌آپ --}}
<div class="modal-overlay" id="payroll-modal">
    <div class="modal-content">
        <span class="modal-close" id="close-modal-btn">&times;</span>
        <h2 id="modal-title">جزئیات حقوق و دستمزد</h2>
        <form action="#" method="POST">
            <div class="modal-grid">
                {{-- فیلد جدید برای "رده" --}}
                <div class="payroll-item">
                    <label class="label">رده</label>
                    <span class="view-text" data-field="level"></span>
                    <select class="edit-input" data-field="level">
                        <option>جونیور ۱</option>
                        <option>جونیور ۲</option>
                        <option>جونیور ۳</option>
                        <option>میدلول ۱</option>
                        <option>میدلول ۲</option>
                        <option>میدلول ۳</option>
                        <option>سینیور ۱</option>
                        <option>سینیور ۲</option>
                    </select>
                </div>

                {{-- تمام فیلدهای حقوقی --}}
                <div class="payroll-item">
                    <label class="label">حقوق ۳۰ روزه</label>
                    <span class="view-text" data-field="base_salary"></span>
                    <input type="text" class="edit-input" data-field="base_salary">
                </div>
                <div class="payroll-item">
                    <label class="label">پایه سنوات</label>
                    <span class="view-text" data-field="seniority"></span>
                    <input type="text" class="edit-input" data-field="seniority">
                </div>
                <div class="payroll-item">
                    <label class="label">حق مسکن</label>
                    <span class="view-text" data-field="housing"></span>
                    <input type="text" class="edit-input" data-field="housing">
                </div>
                <div class="payroll-item">
                    <label class="label">حق تاهل</label>
                    <span class="view-text" data-field="marriage"></span>
                    <input type="text" class="edit-input" data-field="marriage">
                </div>
                <div class="payroll-item">
                    <label class="label">حق اولاد</label>
                    <span class="view-text" data-field="children"></span>
                    <input type="text" class="edit-input" data-field="children">
                </div>
                <div class="payroll-item">
                    <label class="label">حق مسئولیت</label>
                    <span class="view-text" data-field="responsibility"></span>
                    <input type="text" class="edit-input" data-field="responsibility">
                </div>
                <div class="payroll-item">
                    <label class="label">خوار و بار</label>
                    <span class="view-text" data-field="food"></span>
                    <input type="text" class="edit-input" data-field="food">
                </div>
                <div class="payroll-item">
                    <label class="label">غیررسمی</label>
                    <span class="view-text" data-field="informal"></span>
                    <input type="text" class="edit-input" data-field="informal">
                </div>
                
                {{-- فیلدهای مربوط به ثبت تغییرات (فقط در حالت ویرایش) --}}
                <div class="payroll-item modal-full-width-item edit-input">
                    <label for="change_reason" class="label">علت تغییر را انتخاب کنید</label>
                    <select id="change_reason" class="edit-input">
                        <option value="تغییر رده شغلی">تغییر رده شغلی</option>
                        <option value="تغییر حقوق">تغییر حقوق</option>
                    </select>
                </div>
                <div class="payroll-item modal-full-width-item edit-input">
                    <label for="change_details" class="label">جزئیات تغییر (اختیاری)</label>
                    <textarea id="change_details" class="edit-input" rows="3" placeholder="مثال: افزایش حقوق سالانه"></textarea>
                </div>
            </div>
            <div class="modal-buttons">
                <button type="button" class="btn-secondary" id="cancel-modal-btn">بستن</button>
                <button type="submit" class="btn-success">ذخیره تغییرات</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
{{-- اسکریپت بدون تغییر --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('payroll-modal');
    const modalTitle = document.getElementById('modal-title');
    const closeBtn = document.getElementById('close-modal-btn');
    const cancelBtn = document.getElementById('cancel-modal-btn');
    const actionIcons = document.querySelectorAll('.action-icon');

    function openModal(mode, rowData) {
        modalTitle.textContent = mode === 'view' ? `مشاهده جزئیات: ${rowData.name}` : `ویرایش حقوق: ${rowData.name}`;
        
        modal.classList.remove('modal-view-mode', 'modal-edit-mode');
        modal.classList.add(mode === 'view' ? 'modal-view-mode' : 'modal-edit-mode');

        for (const field in rowData) {
            const viewElement = modal.querySelector(`.view-text[data-field="${field}"]`);
            if (viewElement) viewElement.textContent = rowData[field];
            
            const editElement = modal.querySelector(`[data-field="${field}"].edit-input`);
            if (editElement) editElement.value = rowData[field];
        }
        
        modal.style.display = 'flex';
    }

    actionIcons.forEach(icon => {
        icon.addEventListener('click', function (e) {
            e.preventDefault();
            const mode = this.dataset.mode;
            const row = this.closest('tr');
            const rowData = row.dataset;
            openModal(mode, rowData);
        });
    });

    function closeModal() {
        modal.style.display = 'none';
    }
    closeBtn.addEventListener('click', closeModal);
    cancelBtn.addEventListener('click', closeModal);
    window.addEventListener('click', (e) => {
        if (e.target === modal) closeModal();
    });
});
</script>
@endsection