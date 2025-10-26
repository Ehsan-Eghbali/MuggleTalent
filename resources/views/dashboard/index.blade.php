@extends('layouts.dashboard')

@section('dashboard_content')
<div class="page-header">
    <h1><i class="fas fa-box"></i> جعبه ابزار</h1>
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
                <a href="https://www.whatsapp.com/" class="tool-card" target="_blank">
                    <div class="tool-icon"><img src="{{ asset('images/icons/whatsapp.png') }}" alt="واتساپ"></div>
                    <span class="tool-name">واتساپ</span>
                </a>
                <a href="https://telegram.org/" class="tool-card" target="_blank">
                    <div class="tool-icon"><img src="{{ asset('images/icons/telegram.png') }}" alt="تلگرام"></div>
                    <span class="tool-name">تلگرام</span>
                </a>
                <a href="https://www.linkedin.com/" class="tool-card" target="_blank">
                    <div class="tool-icon"><img src="{{ asset('images/icons/linkedin.png') }}" alt="لینکدین"></div>
                    <span class="tool-name">لینکدین</span>
                </a>
                <a href="https://chatgpt.com" class="tool-card" target="_blank">
                    <div class="tool-icon"><img src="{{ asset('images/icons/gpt.png') }}" alt="Chat GPT"></div>
                    <span class="tool-name">Chat GPT</span>
                </a>
                <a href="https://evernote.com/" class="tool-card" target="_blank">
                    <div class="tool-icon"><img src="{{ asset('images/icons/evernote.png') }}" alt="evernote"></div>
                    <span class="tool-name">evernote</span>
                </a>
                <a href="https://mail.zoho.com/" class="tool-card" target="_blank">
                    <div class="tool-icon"><img src="{{ asset('images/icons/zoho.png') }}" alt="ZOHO"></div>
                    <span class="tool-name">ZOHO</span>
                </a>
                <a href="https://smallpdf.com/merge-pdf" class="tool-card" target="_blank">
                    <div class="tool-icon"><img src="{{ asset('images/icons/pdf.png') }}" alt="ابزار PDF"></div>
                    <span class="tool-name">ابزار PDF</span>
                </a>
                <a href="https://www.bahesab.ir/time/conversion/" class="tool-card" target="_blank">
                    <div class="tool-icon"><img src="{{ asset('images/icons/data.png') }}" alt=" تبدیل تاریخ"></div>
                    <span class="tool-name">تبدیل تاریخ</span>
                </a>
                <a href="https://ezgif.com" class="tool-card" target="_blank">
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
                <a href="https://docs.google.com/" class="tool-card" target="_blank">
                    <div class="tool-icon"><img src="{{ asset('images/icons/google-docs.png') }}" alt="گوگل داکس"></div>
                    <span class="tool-name">Docs</span>
                </a>
                <a href="https://sheets.google.com/" class="tool-card" target="_blank">
                    <div class="tool-icon"><img src="{{ asset('images/icons/google-sheets.png') }}" alt="گوگل شیتز"></div>
                    <span class="tool-name">Sheet</span>
                </a>
                <a href="https://forms.google.com/" class="tool-card" target="_blank">
                    <div class="tool-icon"><img src="{{ asset('images/icons/google-forms.png') }}" alt="گوگل فرمز"></div>
                    <span class="tool-name">Form</span>
                </a>
                <a href="https://translate.google.com/" class="tool-card" target="_blank">
                    <div class="tool-icon"><img src="{{ asset('images/icons/google.png') }}" alt="گوگل ترنسلیت"></div>
                    <span class="tool-name">Translate</span>
                </a>
                <a href="https://drive.google.com/" class="tool-card" target="_blank">
                    <div class="tool-icon"><img src="{{ asset('images/icons/drive.png') }}" alt="گوگل درایو"></div>
                    <span class="tool-name">Drive</span>
                </a>
                <a href="https://calendar.google.com/" class="tool-card" target="_blank">
                    <div class="tool-icon"><img src="{{ asset('images/icons/google-calendar.png') }}" alt="گوگل کلندر"></div>
                    <span class="tool-name">Calender</span>
                </a>
                <a href="https://meet.google.com/" class="tool-card" target="_blank">
                    <div class="tool-icon"><img src="{{ asset('images/icons/meet.png') }}" alt="گوگل میت"></div>
                    <span class="tool-name">Meet</span> 
                </a>
                <a href="https://mail.google.com/" class="tool-card" target="_blank">
                    <div class="tool-icon"><img src="{{ asset('images/icons/gmail.png') }}" alt="گوگل جیمیل"></div>
                    <span class="tool-name">Gmail</span>
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
                <a href="https://hrcando.ir/" class="tool-card" target="_blank">
                    <div class="tool-icon"><img src="{{ asset('images/icons/hrcando.svg') }}" alt="کندو استخدام"></div>
                    <span class="tool-name">کندو</span>
                </a>
                <a href="https://jobinja.ir/" class="tool-card" target="_blank">
                    <div class="tool-icon"><img src="{{ asset('images/icons/jobinja.jpg') }}" alt="جابینجا"></div>
                    <span class="tool-name">جابینجا</span>
                </a>
                <a href="https://maktabkhooneh.org/" class="tool-card" target="_blank">
                    <div class="tool-icon"><img src="{{ asset('images/icons/maktabkhooneh.jpg') }}" alt="مکتب خونه"></div>
                    <span class="tool-name">مکتب خونه</span>
                </a>
                <a href="https://organization.quby.ir/" class="tool-card" target="_blank">
                    <div class="tool-icon"><img src="{{ asset('images/icons/quby.svg') }}" alt="کیوبی"></div>
                    <span class="tool-name">کیوبی</span>
                </a>
                <a href="https://porsline.ir/" class="tool-card" target="_blank">
                    <div class="tool-icon"><img src="{{ asset('images/icons/posline.png') }}" alt="پرسلاین"></div>
                    <span class="tool-name">پرسلاین</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
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
});
</script>
@endsection