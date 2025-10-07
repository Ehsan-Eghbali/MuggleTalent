@extends('layouts.dashboard')

@section('page_styles')
    {{-- اگر نیاز دارید، این فایل را هم ایجاد کنید (در ادامه نمونه ساده می‌آید) --}}
    <link rel="stylesheet" href="{{ asset('css/pages/dashboard/issue-letter.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('dashboard_content')
    <div class="page-header">
        <h1><i class="fas fa-file-signature page-icon"></i> صدور آنلاین نامه</h1>
    </div>

    <div class="issue-letter-container">
        {{-- ستون فرم و تنظیمات --}}
        <div class="form-section">
            {{-- کارت اطلاعات پایه --}}
            <div class="card">
                <div class="card-header">اطلاعات پایه</div>
                <div class="card-body">
                    {{-- انتخاب پرسنل --}}
                    <div class="form-group">
                        <label for="personnel-select">انتخاب پرسنل</label>
                        <select id="personnel-select">
                            <option value="" data-name="">یک شخص را انتخاب کنید…</option>
                            {{-- در اینجا مقدار value همان شناسهٔ پرسنل است و نام در data-name --}}
                            @foreach($personnel_list as $person)
                                <option value="{{ $person['id'] }}" data-name="{{ $person['full_name'] }}">
                                    {{ $person['full_name'] }} (کد: {{ $person['id'] }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- انتخاب قالب --}}
                    <div class="form-group">
                        <label for="template-select">انتخاب قالب نامه</label>
                        <select id="template-select">
                            <option value="">یک قالب را انتخاب کنید…</option>
                            {{-- اگر کلید قالب‌ها مشخص است، همان کلید را در value بگذارید --}}
                            @foreach($templates_list as $template)
                                <option value="{{ $template['key'] }}">{{ $template['name'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- تاریخ صدور (اختیاری) --}}
                    <div class="form-group">
                        <label for="issued-at">تاریخ صدور (میلادی)</label>
                        <input type="date" id="issued-at" value="{{ now()->format('Y-m-d') }}">
                    </div>
                </div>
            </div>

            {{-- کارت فیلدهای داینامیک بر اساس قالب --}}
            <div class="card">
                <div class="card-header">فیلدهای نامه</div>
                <div class="card-body" id="dynamic-fields">
                    <p class="placeholder-text">لطفاً یک قالب نامه انتخاب کنید تا فیلدهای آن نمایش داده شود.</p>
                </div>
            </div>

            {{-- کارت پیوست‌ها (پس از ذخیرهٔ نامه فعال می‌شود) --}}
            <div class="card">
                <div class="card-header">پیوست‌ها</div>
                <div class="card-body">
                    <input type="file" id="attachments" multiple disabled>
                    <div class="hint">پس از ذخیرهٔ نامه، امکان بارگذاری پیوست فعال می‌شود.</div>
                    <div id="attachments-list" class="attachments-list"></div>
                </div>
            </div>

            {{-- دکمه‌های اقدام --}}
            <div class="actions">
                <button id="btn-generate-download" class="btn btn-primary">
                    نهایی‌سازی و دریافت مستقیم پی‌دی‌اف
                </button>
            </div>

            {{-- نمایش پیام‌ها --}}
            <div id="messages" class="messages"></div>
        </div>

        {{-- ستون پیش‌نمایش --}}
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
    <script>
        /*
          توضیح کلی:
          - این کدِ فرانت مسئول مدیریت ورودی‌ها، ساخت پیش‌نمایش زنده، ذخیرهٔ نامه (پیش‌نویس/نهایی)،
            دریافت مستقیم پی‌دی‌اف از سرور، و بارگذاری/حذف/دانلود پیوست‌ها است.
          - همهٔ درخواست‌ها با توکن محافظت می‌شود.
        */

        document.addEventListener('DOMContentLoaded', function() {
            // انتخاب عناصر
            const tplSelect   = document.getElementById('template-select');
            const prsSelect   = document.getElementById('personnel-select');
            const issuedAt    = document.getElementById('issued-at');
            const dynFields   = document.getElementById('dynamic-fields');
            const previewBox  = document.getElementById('letter-preview');
            const attachInput = document.getElementById('attachments');
            const attachList  = document.getElementById('attachments-list');

            const btnSaveDraft    = document.getElementById('btn-save-draft');
            const btnSaveFinal    = document.getElementById('btn-save-final');
            const btnGenDownload  = document.getElementById('btn-generate-download');

            const messages  = document.getElementById('messages');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // شناسهٔ نامه پس از ذخیره (برای پیوست)
            let currentLetterId = null;

            // کمک‌کار نمایش پیام
            function notify(type, text) {
                // نوع‌ها: success | error | info
                const el = document.createElement('div');
                el.className = 'msg ' + type;
                el.textContent = text;
                messages.appendChild(el);
                setTimeout(() => el.remove(), 5000);
            }

            // ساخت فیلدهای داینامیک بر اساس کلید قالب
            function renderDynamicFields() {
                const key = tplSelect.value;
                dynFields.innerHTML = '';

                if (!key) {
                    dynFields.innerHTML = '<p class="placeholder-text">لطفاً یک قالب نامه انتخاب کنید.</p>';
                    updatePreview();
                    return;
                }

                if (key === 'employment_certificate') {
                    dynFields.innerHTML = `
                <div class="form-group">
                    <label for="person_name">نام پرسنل (در صورت نیاز به بازنویسی)</label>
                    <input type="text" id="person_name" placeholder="مثال: علی رضایی">
                </div>
                <div class="form-group">
                    <label for="recipient_name">نام سازمان دریافت‌کننده</label>
                    <input type="text" id="recipient_name" placeholder="مثال: بانک ملت">
                </div>
            `;
                } else if (key === 'salary_certificate') {
                    dynFields.innerHTML = `
                <div class="form-group">
                    <label for="person_name">نام پرسنل (در صورت نیاز به بازنویسی)</label>
                    <input type="text" id="person_name" placeholder="مثال: سارا محمدی">
                </div>
                <div class="form-group">
                    <label for="guarantee_amount">مبلغ ضمانت (ریال)</label>
                    <input type="number" id="guarantee_amount" placeholder="مثال: 500000000">
                </div>
                <div class="form-group">
                    <label for="recipient_name">نام سازمان دریافت‌کننده</label>
                    <input type="text" id="recipient_name" placeholder="مثال: بانک سامان">
                </div>
            `;
                } else {
                    dynFields.innerHTML = '<p class="placeholder-text">برای این قالب، فیلد ویژه‌ای تعریف نشده است.</p>';
                }

                dynFields.querySelectorAll('input').forEach(inp => {
                    inp.addEventListener('input', updatePreview);
                });
                updatePreview();
            }

            // ساخت اچ‌تی‌ام‌ال پیش‌نمایش (سمت مرورگر)
            function buildPreviewHtml() {
                const key = tplSelect.value;
                const prsOpt = prsSelect.options[prsSelect.selectedIndex];
                const prsName = (document.getElementById('person_name')?.value?.trim())
                    || prsOpt?.getAttribute('data-name') || '—';

                const recipient = document.getElementById('recipient_name')?.value?.trim() || '[نام سازمان دریافت‌کننده]';
                const amount    = document.getElementById('guarantee_amount')?.value?.trim() || '';

                // عدد نمونهٔ نامه برای پیش‌نمایش
                const sampleNo = '۱۴۰۴/پ/۰۱۰۱';
                // تاریخ نمایشی
                const todayFa = new Date().toLocaleDateString('fa-IR');

                let title = 'گواهی اشتغال به کار';
                if (key === 'salary_certificate') title = 'گواهی حقوق/ضمانت';

                let html = `
            <div style="direction: rtl; text-align:right; font-family:vazirmatn; font-size:14px;">
                <p><strong>شماره نامه:</strong> ${sampleNo}</p>
                <p><strong>تاریخ:</strong> ${todayFa}</p>
                <h3 style="text-align:center;">${title}</h3>
                <p>بدینوسیله گواهی می‌شود، جناب آقای/خانم <strong>${prsName}</strong> در این شرکت مشغول به کار می‌باشند.</p>
        `;
                if (key === 'salary_certificate') {
                    html += `<p>ایشان متعهد به پرداخت مبلغ <strong>${amount || '[مبلغ ضمانت]'}</strong> ریال می‌باشند.</p>`;
                }
                html += `<p>این گواهی جهت ارائه به <strong>${recipient}</strong> صادر گردیده است.</p>`;
                html += `</div>`;
                return html;
            }

            function updatePreview() {
                const prsName = prsSelect.options[prsSelect.selectedIndex]?.getAttribute('data-name');
                const key = tplSelect.value;

                if (!prsName || !key) {
                    previewBox.innerHTML = '<p class="placeholder-text">لطفاً پرسنل و قالب را انتخاب کنید.</p>';
                    return;
                }
                previewBox.innerHTML = buildPreviewHtml();
            }

            // گردآوری داده‌ها برای ارسال به سرور
            function collectPayload(status = 'draft') {
                const fields = {};
                dynFields.querySelectorAll('input').forEach(i => {
                    fields[i.id] = i.value;
                });

                return {
                    personnel_id: Number(prsSelect.value),
                    template_key: tplSelect.value,
                    number: '', // اگر خالی باشد، سرور تولید می‌کند
                    issued_at: issuedAt.value || null,
                    fields: fields,
                    body_html: previewBox.innerHTML, // همین اچ‌تی‌ام‌ال را بفرستید (دلخواه)
                    status: status, // draft | final
                };
            }

            // ذخیره نامه (پیش‌نویس/نهایی در آرشیو)
            async function saveLetter(status) {
                try {
                    const payload = collectPayload(status);
                    if (!payload.personnel_id || !payload.template_key) {
                        notify('error', 'پرسنل و قالب باید انتخاب شوند.');
                        return;
                    }
                    const res = await fetch(`{{ route('letters.store') }}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        body: JSON.stringify(payload),
                    });
                    if (!res.ok) {
                        const t = await res.text();
                        throw new Error(t || 'خطا در ذخیرهٔ نامه');
                    }
                    const data = await res.json();
                    currentLetterId = data.id;
                    attachInput.disabled = false;
                    notify('success', (status === 'final') ? 'نامه نهایی شد و در آرشیو ذخیره گردید.' : 'پیش‌نویس ذخیره شد.');
                } catch (e) {
                    notify('error', 'ذخیره انجام نشد.');
                    console.error(e);
                }
            }

            // نهایی‌سازی و دریافت مستقیم پی‌دی‌اف (پاسخ، فایل است)
            async function generateAndDownload() {
                try {
                    const payload = collectPayload('final');
                    if (!payload.personnel_id || !payload.template_key) {
                        notify('error', 'پرسنل و قالب باید انتخاب شوند.');
                        return;
                    }

                    const res = await fetch(`{{ route('letters.generate_download') }}`, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                        body: JSON.stringify(payload),
                    });

                    if (!res.ok) {
                        const t = await res.text();
                        throw new Error(t || 'خطا در تولید پی‌دی‌اف');
                    }

                    // دریافت باینری و ایجاد دانلود
                    const blob = await res.blob();
                    const url  = window.URL.createObjectURL(blob);
                    const a    = document.createElement('a');
                    a.href = url;
                    a.download = 'letter.pdf';
                    document.body.appendChild(a);
                    a.click();
                    a.remove();
                    window.URL.revokeObjectURL(url);

                    notify('success', 'پی‌دی‌اف آماده و دریافت شد.');
                } catch (e) {
                    notify('error', 'تولید پی‌دی‌اف انجام نشد.');
                    console.log(e)
                }
            }

            // بارگذاری پیوست‌ها برای نامهٔ ذخیره‌شده
            async function uploadAttachments(files) {
                if (!currentLetterId) {
                    notify('info', 'ابتدا نامه را ذخیره کنید تا پیوست فعال شود.');
                    return;
                }
                const fd = new FormData();
                [...files].forEach(f => fd.append('files[]', f));

                try {
                    const res = await fetch(`/letters/${currentLetterId}/attachments`, {
                        method: 'POST',
                        headers: { 'X-CSRF-TOKEN': csrfToken },
                        body: fd,
                    });
                    if (!res.ok) {
                        const t = await res.text();
                        throw new Error(t || 'خطا در بارگذاری پیوست');
                    }
                    const data = await res.json();
                    (data.attachments || []).forEach(addAttachmentRow);
                    attachInput.value = '';
                    notify('success', 'پیوست‌ها بارگذاری شد.');
                } catch (e) {
                    notify('error', 'بارگذاری پیوست انجام نشد.');
                    console.error(e);
                }
            }

            // افزودن ردیف پیوست به فهرست
            function addAttachmentRow(att) {
                const row = document.createElement('div');
                row.className = 'attachment-row';
                row.dataset.id = att.id;
                row.innerHTML = `
            <span class="name">${att.name}</span>
            <span class="meta">${(att.size ?? 0)} بایت</span>
            <div class="actions">
                <a class="btn-link" href="${att.download_url}">دانلود</a>
                <button class="btn-link danger" data-action="delete">حذف</button>
            </div>
        `;
                // حذف
                row.querySelector('[data-action="delete"]').addEventListener('click', () => deleteAttachment(att.id, row));
                attachList.prepend(row);
            }

            // حذف پیوست
            async function deleteAttachment(attId, rowEl) {
                if (!currentLetterId) return;
                if (!confirm('آیا از حذف این پیوست مطمئن هستید؟')) return;

                try {
                    const res = await fetch(`/letters/${currentLetterId}/attachments/${attId}`, {
                        method: 'DELETE',
                        headers: { 'X-CSRF-TOKEN': csrfToken },
                    });
                    if (!res.ok) {
                        const t = await res.text();
                        throw new Error(t || 'خطا در حذف پیوست');
                    }
                    rowEl.remove();
                    notify('success', 'پیوست حذف شد.');
                } catch (e) {
                    notify('error', 'حذف پیوست انجام نشد.');
                    console.error(e);
                }
            }

            // رویدادها
            tplSelect.addEventListener('change', renderDynamicFields);
            prsSelect.addEventListener('change', updatePreview);
            issuedAt.addEventListener('change', updatePreview);

            // btnSaveDraft.addEventListener('click', (e) => {
            //     e.preventDefault();
            //     saveLetter('draft');
            // });

            // btnSaveFinal.addEventListener('click', (e) => {
            //     e.preventDefault();
            //     saveLetter('final');
            // });

            btnGenDownload.addEventListener('click', (e) => {
                e.preventDefault();
                generateAndDownload();
            });

            attachInput.addEventListener('change', (e) => {
                if (e.target.files && e.target.files.length) {
                    uploadAttachments(e.target.files);
                }
            });

            // بار اول
            updatePreview();
        });
    </script>
@endsection
