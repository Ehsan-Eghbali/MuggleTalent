@extends('layouts.dashboard')

@section('dashboard_content')
<div class="page-header">
    <h1></i> جعبه ابزار 📦️</h1>
</div>

<div class="dashboard-main-content">
    {{-- بخش اصلی ابزارها --}}
    <div class="dashboard-tools-section">
        {{-- نوار دسته‌بندی ابزارها --}}
        <div class="tool-categories">
            <a href="#" class="category-tab active" data-category="daily">ابزار روزمره</a>
            <a href="#" class="category-tab" data-category="google">ابزارهای گوگل</a>
            <a href="#" class="category-tab" data-category="hr">ابزارهای HR</a>
        </div>

        {{-- بخش نمایش ابزارهای روزمره --}}
        <div class="tools-grid-section" id="tools-daily">
            <div class="tools-grid-header">
                <i class="fas fa-wrench"></i>
                <span>ابزار روزمره</span>
            </div>
            <div class="tools-grid">
                <a href="https://www.whatsapp.com/" class="tool-card">
                    <div class="tool-icon"><img src="{{ asset('images/icons/whatsapp.png') }}" alt="واتساپ"></div>
                    <span class="tool-name">واتساپ</span>
                </a>
                <a href="https://telegram.org/" class="tool-card">
                    <div class="tool-icon"><img src="{{ asset('images/icons/telegram.png') }}" alt="تلگرام"></div>
                    <span class="tool-name">تلگرام</span>
                </a>
                <a href="https://www.linkedin.com/" class="tool-card">
                    <div class="tool-icon"><img src="{{ asset('images/icons/linkedin.png') }}" alt="لینکدین"></div>
                    <span class="tool-name">لینکدین</span>
                </a>
                <a href="https://chatgpt.com" class="tool-card">
                    <div class="tool-icon"><img src="{{ asset('images/icons/gpt.png') }}" alt="Chat GPT"></div>
                    <span class="tool-name">Chat GPT</span>
                </a>
                <a href="https://evernote.com/" class="tool-card">
                    <div class="tool-icon"><img src="{{ asset('images/icons/evernote.png') }}" alt="evernote"></div>
                    <span class="tool-name">evernote</span>
                </a>
                <a href="zoho.com/mail/login.html" class="tool-card">
                    <div class="tool-icon"><img src="{{ asset('images/icons/zoho.png') }}" alt="ZOHO"></div>
                    <span class="tool-name">ZOHO</span>
                </a>
                <a href="https://smallpdf.com/merge-pdf" class="tool-card">
                    <div class="tool-icon"><img src="{{ asset('images/icons/pdf.png') }}" alt="ابزار PDF"></div>
                    <span class="tool-name">ابزار PDF</span>
                </a>
                <a href="https://www.bahesab.ir/time/conversion/" class="tool-card">
                    <div class="tool-icon"><img src="{{ asset('images/icons/data.png') }}" alt=" تبدیل تاریخ"></div>
                    <span class="tool-name">تبدیل تاریخ</span>
                </a>
                <a href="https://ezgif.com" class="tool-card">
                    <div class="tool-icon"><img src="{{ asset('images/icons/cpng.png') }}" alt="تبدیل تصویر"></div>
                    <span class="tool-name">تبدیل تصویر</span>
                </a>
            </div>
        </div>

        {{-- بخش نمایش ابزارهای گوگل (مخفی اولیه) --}}
        <div class="tools-grid-section" id="tools-google" style="display: none;">
            <div class="tools-grid-header">
                <i class="fab fa-google"></i>
                <span>ابزارهای گوگل</span>
            </div>
            <div class="tools-grid">
                 <a href="#" class="tool-card">
                    <div class="tool-icon"><img src="{{ asset('images/icons/google-docs.png') }}" alt="گوگل تو دو"></div>
                    <span class="tool-name">docs </span>
                </a>
                <a href="#" class="tool-card">
                    <div class="tool-icon"><img src="{{ asset('images/icons/google-sheets.png') }}" alt="گوگل کیپ"></div>
                    <span class="tool-name">sheet</span>
                </a>
                <a href="#" class="tool-card">
                    <div class="tool-icon"><img src="{{ asset('images/icons/google-forms.png') }}" alt="گوگل اسلایدز"></div>
                    <span class="tool-name">form</span>
                </a>
                 <a href="#" class="tool-card">
                    <div class="tool-icon"><img src="{{ asset('images/icons/google.png') }}" alt="گوگل فرمز"></div>
                    <span class="tool-name">translate</span>
                </a>
                <a href="#" class="tool-card">
                    <div class="tool-icon"><img src="{{ asset('images/icons/drive.png') }}" alt="گوگل داکز"></div>
                    <span class="tool-name">drive</span>
                </a>
                <a href="#" class="tool-card">
                    <div class="tool-icon"><img src="{{ asset('images/icons/google-calendar.png') }}" alt="گوگل شیتز"></div>
                    <span class="tool-name">calender</span>
                </a>
                 <a href="#" class="tool-card">
                    <div class="tool-icon"><img src="{{ asset('images/icons/meet.png') }}" alt="گوگل کانتکتس"></div>
                    <span class="tool-name">  meet</span> 
                </a>
                <a href="#" class="tool-card">
                    <div class="tool-icon"><img src="{{ asset('images/icons/gmail.png') }}" alt="گوگل مپز"></div>
                    <span class="tool-name">gmail</span>
                </a>
            </div>
        </div>

        {{-- بخش نمایش ابزارهای HR (مخفی اولیه) --}}
        <div class="tools-grid-section" id="tools-hr" style="display: none;">
            <div class="tools-grid-header">
                <i class="fas fa-users-cog"></i>
                <span>ابزارهای منابع انسانی</span>
            </div>
            <div class="tools-grid">
                {{-- ابزار تبدیل تاریخ (از قبل ساخته شده) --}}
                <a href="https://hrcando.ir/" class="tool-card">
                    <div class="tool-icon"><img src="{{ asset('images/icons/hrcando.SVG') }}" alt="کندو استخدام "></div>
                    <span class="tool-name"> کندو</span>
                </a>
                <a href="https://jobinja.ir/" class="tool-card">
                    <div class="tool-icon"><img src="{{ asset('images/icons/jobinja.jpg') }}" alt=" جابینجا"></div>
                    <span class="tool-name"> جابینجا</span>
                </a>
                <a href="https://maktabkhooneh.org/" class="tool-card">
                    <div class="tool-icon"><img src="{{ asset('images/icons/maktabkhooneh.jpg') }}" alt=" مکتب خونه"></div>
                    <span class="tool-name"> مکتب خونه</span>
                </a>
                <a href="https://organization.quby.ir/#//" class="tool-card">
                    <div class="tool-icon"><img src="{{ asset('images/icons/quby.svg') }}" alt=" کیوبی "></div>
                    <span class="tool-name">  کیوبی</span>
                </a>
                <a href="https://porsline.ir/" class="tool-card">
                    <div class="tool-icon"><img src="{{ asset('images/icons/posline.png') }}" alt=" پرسلاین "></div>
                    <span class="tool-name">  پرسلاین</span>
                </a>
            </div>
        </div>
    </div>

    {{-- ویجت‌های کناری (مثل تبدیل تاریخ) --}}
    <div class="dashboard-side-widgets">
        {{-- ویجت تبدیل تاریخ (از قبل ساخته شده) --}}
        <div class="toolbox-widget" id="date-converter-widget">
            <div class="widget-header">
                <i class="fas fa-calendar-alt"></i>
                <span>تبدیل تاریخ شمسی و میلادی</span>
            </div>
            <div class="widget-body">
                <div class="form-group">
                    <label for="shamsi-date">تاریخ شمسی</label>
                    <input type="text" id="shamsi-date" placeholder="مثال: 1404/06/05">
                </div>
                <div class="form-group">
                    <label for="gregorian-date">تاریخ میلادی</label>
                    <input type="text" id="gregorian-date" placeholder="مثال: 2025/08/27">
                </div>
            </div>
        </div>
        
        {{-- ویجت‌های دیگر در اینجا اضافه خواهند شد --}}
    </div>
</div>
@endsection

@section('scripts')
{{-- کتابخانه moment-jalaali برای تبدیل تاریخ --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-jalaali/0.10.0/moment-jalaali.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // --- منطق تب‌ها برای نمایش ابزارها ---
    const categoryTabs = document.querySelectorAll('.category-tab');
    const toolSections = document.querySelectorAll('.tools-grid-section');

    categoryTabs.forEach(tab => {
        tab.addEventListener('click', function(e) {
            e.preventDefault();
            const targetCategory = this.dataset.category;

            // حذف کلاس active از همه تب‌ها و اضافه کردن به تب فعلی
            categoryTabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');

            // مخفی کردن همه بخش‌های ابزار و نمایش بخش هدف
            toolSections.forEach(section => {
                if (section.id === `tools-${targetCategory}`) {
                    section.style.display = 'block';
                } else {
                    section.style.display = 'none';
                }
            });
        });
    });

    // --- منطق تبدیل تاریخ ---
    const shamsiInput = document.getElementById('shamsi-date');
    const gregorianInput = document.getElementById('gregorian-date');

    // تابع برای چک کردن فرمت تاریخ شمسی (YYYY/MM/DD)
    function isValidJalaaliDate(dateString) {
        const regex = /^(\d{4})\/(0?[1-9]|1[0-2])\/(0?[1-9]|[1-2]\d|3[0-1])$/;
        return regex.test(dateString);
    }

    // تبدیل از شمسی به میلادی
    shamsiInput.addEventListener('input', function() {
        const shamsiValue = this.value;
        if (isValidJalaaliDate(shamsiValue) && m.isJalaaliDate(shamsiValue)) {
            const gregorianDate = m(shamsiValue, 'jYYYY/jM/jD').format('YYYY/MM/DD');
            gregorianInput.value = gregorianDate;
        } else {
            gregorianInput.value = '';
        }
    });

    // تبدیل از میلادی به شمسی
    gregorianInput.addEventListener('input', function() {
        const gregorianValue = this.value;
        if (moment(gregorianValue, 'YYYY/MM/DD', true).isValid()) {
            const shamsiDate = m(gregorianValue, 'YYYY/MM/DD').format('jYYYY/jMM/jDD');
            shamsiInput.value = shamsiDate;
        } else {
            shamsiInput.value = '';
        }
    });

    // --- باز کردن ویجت تبدیل تاریخ با کلیک روی کارت ---
    const openDateConverterCard = document.getElementById('open-date-converter');
    if (openDateConverterCard) {
        openDateConverterCard.addEventListener('click', function(e) {
            e.preventDefault();
            // شما می توانید در اینجا منطقی برای باز کردن یک modal یا نمایش ویجت پیاده‌سازی کنید.
            // به عنوان مثال، اگر ویجت تبدیل تاریخ در حالت عادی مخفی باشد، آن را نمایش دهید.
            // در حال حاضر، چون ویجت همیشه نمایش داده می شود، این لینک فقط یک مثال است.
            alert('ابزار تبدیل تاریخ باز شد!');
            // می‌توانید به تب HR هم تغییر دهید
            document.querySelector('.category-tab[data-category="hr"]').click();
        });
    }

});
</script>
@endsection