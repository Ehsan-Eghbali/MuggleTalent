@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/layouts/dashboard.css') }}">
@endsection

@section('content')
    <div class="dashboard-layout">
        <aside class="sidebar">
            <div class="sidebar-header">
                {{-- لوگوی شما در اینجا قرار می‌گیرد --}}
                <img src="{{ asset('images/logo.png') }}" alt="لوگو سامانه" style="width:120px; height:auto; margin-bottom:10px;">
            </div>
            <ul class="sidebar-menu">
                <li><a href="#"><i class="fas fa-info-circle menu-icon"></i><span>گزارش منابع انسانی</span></a></li>

                {{-- منوی لیست پرسنلی --}}
                <li class="has-submenu {{ request()->is('personnel-list*') ? 'open active' : '' }}">
                    <a href="#"><i class="fas fa-list-alt menu-icon"></i><span>لیست پرسنلی</span><i class="fas fa-chevron-down toggle-icon"></i></a>
                    <ul class="sidebar-submenu">
                        <li class="{{ request()->is('personnel-list') ? 'active' : '' }}"><a href="/personnel-list">مشاهده لیست همکاران</a></li>
                    </ul>
                </li>

                {{-- منوی درخواست های اداری --}}
                <li class="has-submenu {{ request()->is('letters*') ? 'open active' : '' }}">
                    <a href="#"><i class="fas fa-folder-open menu-icon"></i><span>درخواست های اداری</span><i class="fas fa-chevron-down toggle-icon"></i></a>
                    <ul class="sidebar-submenu">
                        <li class="{{ request()->is('letters_archive') ? 'active' : '' }}"><a href="/letters_archive">آرشیو درخواست ها</a></li>
                        <li class="{{ request()->is('letters_issue') ? 'active' : '' }}"><a href="/letters_issue">صدور آنلاین نامه</a></li>
                    </ul>
                </li>

                {{-- منوی حقوق و دستمزد --}}
                <li class="has-submenu {{ request()->is('payrolls*') || request()->is('payroll-history*') ? 'open active' : '' }}">
                    <a href="#"><i class="fas fa-wallet menu-icon"></i><span>حقوق و دستمزد</span><i class="fas fa-chevron-down toggle-icon"></i></a>
                    <ul class="sidebar-submenu">
                        <li class="{{ request()->is('payrolls') ? 'active' : '' }}"><a href="/payrolls"> لیست حقوق و دستمزد</a></li>
                        <li class="{{ request()->is('payroll-history') ? 'active' : '' }}"><a href="/payroll-history"> تاریخچه حقوق و دستمزد</a></li>
                    </ul>
                </li>

                {{-- منوی مدیریت پنل --}}
                <li class="has-submenu {{ request()->is('register') || request()->is('roles*') || request()->is('departments*') || request()->is('teams*') ? 'open active' : '' }}">
                    <a href="#"><i class="fas fa-screwdriver-wrench menu-icon"></i><span>مدیریت پنل </span><i class="fas fa-chevron-down toggle-icon"></i></a>
                    <ul class="sidebar-submenu">
                        <li class="{{ request()->is('register') ? 'active' : '' }}"><a href="/register"> ثبت نام کاربر سامانه</a></li>
                        <li class="{{ request()->is('roles') ? 'active' : '' }}"><a href="/roles"> نقش ها</a></li>
                        <li class="{{ request()->is('departments') ? 'active' : '' }}"><a href="/departments"> افزودن واحد </a></li>
                        <li class="{{ request()->is('teams') ? 'active' : '' }}"><a href="/teams"> افزودن تیم </a></li>
                    </ul>
                </li>
            </ul>
        </aside>
        <div class="main-wrapper">
            <header class="top-header">
                <div class="header-right"><span>☰</span></div>
                <div class="header-left"><span>Admin ▾</span></div>
            </header>
            <main class="content-wrapper">
                @yield('dashboard_content')
            </main>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuItems = document.querySelectorAll('.sidebar-menu .has-submenu > a');
            menuItems.forEach(item => {
                item.addEventListener('click', function(event) {
                    event.preventDefault();
                    const parentLi = this.parentElement;
                    // اگر منوی دیگری باز است، آن را ببند
                    document.querySelectorAll('.sidebar-menu .has-submenu.open').forEach(openMenu => {
                        if(openMenu !== parentLi) {
                            openMenu.classList.remove('open');
                        }
                    });
                    // منوی فعلی را باز/بسته کن
                    parentLi.classList.toggle('open');
                });
            });
        });
    </script>
@endsection