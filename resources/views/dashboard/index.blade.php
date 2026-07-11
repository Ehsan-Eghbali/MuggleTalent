@extends('layouts.dashboard')

@section('dashboard_content')

<div class="toolbox-page">

    {{-- HERO --}}
    <div class="toolbox-hero">

        <div class="hero-top-tabs">
            <button class="hero-tab active" data-category="daily">
                همه ابزارها
            </button>
            <button class="hero-tab" data-category="google">
                ابزارهای گوگل
            </button>
            <button class="hero-tab" data-category="hr">
                ابزارهای HR
            </button>
        </div>

        <div class="hero-content">

            {{-- New Text Container for Better Alignment --}}
            <div class="hero-info-text">
                <span class="hero-badge">
                    همه ابزارها در یک جا
                </span>

                <h1>
                    جعبه ابزار هوشمند شما
                </h1>

                <p>
                    ابزارهای کاربردی روزمره را سریع، ساده و هوشمندانه استفاده کنید.
                </p>

                <div class="hero-search">
                    <input
                        type="text"
                        id="toolSearch"
                        placeholder="جستجوی ابزار مورد نظر ..."
                    >
                    <i class="fas fa-search"></i>
                </div>

                <div class="hero-features">
                    <div class="feature-item">
                        <i class="fas fa-bolt"></i>
                        سریع و آسان
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-mouse-pointer"></i>
                        دسترسی یک کلیک
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-shield-alt"></i>
                        بروز و مطمئن
                    </div>
                </div>
            </div>

            {{-- Image Container (Now Fixed) --}}
            {{-- <div class="hero-image">
                <img src="{{ asset('images/toolbox.png') }}" alt="Toolbox illustration">
            </div> --}}

        </div>

    </div>

    {{-- TOOLS --}}

    <div class="tools-wrapper">

        <div class="section-title">
            <h3>
                <i class="fas fa-th-large"></i>
                ابزارهای پرکاربرد
            </h3>
        </div>

        {{-- DAILY - Fixed Card Content for Better Rendering --}}
        <div class="tools-grid-section" id="tools-daily">
            <div class="tools-grid">
                <a href="https://www.whatsapp.com/" class="tool-card searchable-tool" target="_blank">
                    <img src="{{ asset('images/icons/whatsapp.png') }}" alt="WhatsApp">
                    <h4>واتساپ</h4>
                    <span>ارسال پیام</span>
                </a>

                <a href="https://telegram.org/" class="tool-card searchable-tool" target="_blank">
                    <img src="{{ asset('images/icons/telegram.png') }}" alt="Telegram">
                    <h4>تلگرام</h4>
                    <span>پیامرسان سریع</span>
                </a>

                <a href="https://www.linkedin.com/" class="tool-card searchable-tool" target="_blank">
                    <img src="{{ asset('images/icons/linkedin.png') }}" alt="Linkedin">
                    <h4>لینکدین</h4>
                    <span>شبکه سازی حرفه ای</span>
                </a>

                <a href="https://chatgpt.com" class="tool-card searchable-tool" target="_blank">
                    <img src="{{ asset('images/icons/gpt.png') }}" alt="ChatGPT">
                    <h4>ChatGPT</h4>
                    <span>دستیار هوشمند</span>
                </a>

                <a href="https://evernote.com/" class="tool-card searchable-tool" target="_blank">
                    <img src="{{ asset('images/icons/evernote.png') }}" alt="Evernote">
                    <h4>Evernote</h4>
                    <span>یادداشت برداری</span>
                </a>

                <a href="https://mail.zoho.com/" class="tool-card searchable-tool" target="_blank">
                    <img src="{{ asset('images/icons/zoho.png') }}" alt="Zoho">
                    <h4>ZOHO</h4>
                    <span>ابزار کسب و کار</span>
                </a>

                {{-- Hidden Tools --}}
                <a href="https://smallpdf.com/merge-pdf" class="tool-card searchable-tool" target="_blank" style="display:none">
                    <img src="{{ asset('images/icons/pdf.png') }}">
                    <h4>ابزار PDF</h4>
                    <span>مدیریت فایل PDF</span>
                </a>
                <a href="https://www.bahesab.ir/time/conversion/" class="tool-card searchable-tool" target="_blank" style="display:none">
                    <img src="{{ asset('images/icons/data.png') }}">
                    <h4>تبدیل تاریخ</h4>
                    <span>شمسی و میلادی</span>
                </a>
                <a href="https://ezgif.com" class="tool-card searchable-tool" target="_blank" style="display:none">
                    <img src="{{ asset('images/icons/cpng.png') }}">
                    <h4>تبدیل تصویر</h4>
                    <span>PNG JPG WEBP</span>
                </a>
            </div>
        </div>

        {{-- GOOGLE --}}
        <div class="tools-grid-section" id="tools-google" style="display:none">
            <div class="tools-grid">
                <a href="https://docs.google.com/" class="tool-card" target="_blank">
                    <img src="{{ asset('images/icons/google-docs.png') }}">
                    <h4>Docs</h4>
                    <span>اسناد آنلاین</span>
                </a>
                <a href="https://sheets.google.com/" class="tool-card" target="_blank">
                    <img src="{{ asset('images/icons/google-sheets.png') }}">
                    <h4>Sheets</h4>
                    <span>صفحات گسترده</span>
                </a>
                <a href="https://forms.google.com/" class="tool-card" target="_blank">
                    <img src="{{ asset('images/icons/google-forms.png') }}">
                    <h4>Forms</h4>
                    <span>فرم ساز</span>
                </a>
                <a href="https://drive.google.com/" class="tool-card" target="_blank">
                    <img src="{{ asset('images/icons/drive.png') }}">
                    <h4>Drive</h4>
                    <span>فضای ابری</span>
                </a>
                <a href="https://calendar.google.com/" class="tool-card" target="_blank">
                    <img src="{{ asset('images/icons/google-calendar.png') }}">
                    <h4>Calendar</h4>
                    <span>تقویم</span>
                </a>
                <a href="https://mail.google.com/" class="tool-card" target="_blank">
                    <img src="{{ asset('images/icons/gmail.png') }}">
                    <h4>Gmail</h4>
                    <span>ایمیل</span>
                </a>
            </div>
        </div>

        {{-- HR --}}
        <div class="tools-grid-section" id="tools-hr" style="display:none">
            <div class="tools-grid">
                <a href="https://jobinja.ir/" class="tool-card" target="_blank">
                    <img src="{{ asset('images/icons/jobinja.jpg') }}">
                    <h4>جابینجا</h4>
                    <span>استخدام</span>
                </a>
                <a href="https://hrcando.ir/" class="tool-card" target="_blank">
                    <img src="{{ asset('images/icons/hrcando.svg') }}">
                    <h4>کندو</h4>
                    <span>جذب نیرو</span>
                </a>
                <a href="https://maktabkhooneh.org/" class="tool-card" target="_blank">
                    <img src="{{ asset('images/icons/maktabkhooneh.jpg') }}">
                    <h4>مکتب خونه</h4>
                    <span>آموزش</span>
                </a>
                <a href="https://porsline.ir/" class="tool-card" target="_blank">
                    <img src="{{ asset('images/icons/posline.png') }}">
                    <h4>پرسلاین</h4>
                    <span>نظرسنجی</span>
                </a>
            </div>
        </div>

    </div>

</div>

@endsection

@section('scripts')

<script>

document.addEventListener('DOMContentLoaded', function(){

    const tabs = document.querySelectorAll('.hero-tab');

    tabs.forEach(tab=>{
        tab.addEventListener('click',function(){
            const category = this.dataset.category;
            tabs.forEach(t=>t.classList.remove('active'));
            this.classList.add('active');

            document.querySelectorAll('.tools-grid-section')
            .forEach(section=>{
                section.style.display='none';
            });

            document.getElementById(
                'tools-'+category
            ).style.display='block';

        });
    });

    const search = document.getElementById('toolSearch');
    const allToolsGrid = document.querySelector('#tools-daily .tools-grid');
    const searchableTools = document.querySelectorAll('.searchable-tool');

    search.addEventListener('keyup',function(){
        const value = this.value.trim().toLowerCase();
        
        // Hide all daily tools by default for search results
        searchableTools.forEach(card => card.style.display = 'none');

        // Search within all daily tools (including hidden ones)
        searchableTools.forEach(card => {
            const toolName = card.querySelector('h4').innerText.toLowerCase();
            const toolDesc = card.querySelector('span').innerText.toLowerCase();

            if (value === '' || toolName.includes(value) || toolDesc.includes(value)) {
                // If search matches or input is empty, reset display
                card.style.display = 'flex';
            }
        });
        
        // Hide only the first row if search input is empty (back to default state)
        if (value === '') {
             searchableTools.forEach((card, index) => {
                 if (index > 5) {
                    card.style.display = 'none';
                 }
             });
        }
    });
});

</script>

@endsection