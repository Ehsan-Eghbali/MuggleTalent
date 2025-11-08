@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/layouts/dashboard.css') }}">
    @yield('page_styles')
@endsection

@section('content')
    <div class="dashboard-layout">
        <aside class="sidebar">
            <div class="sidebar-header">
                <img src="{{ asset('images/logo.png') }}" alt="لوگو سامانه"
                    style="width:120px; height:auto; margin-bottom:10px;">
            </div>
            <ul class="sidebar-menu">
                <li class="has-submenu {{ request()->is('reports*') ? 'open active' : '' }}">
                    <a href="#"><i class="fas fa-chart-pie menu-icon"></i><span>گزارشات منابع انسانی</span><i
                            class="fas fa-chevron-down toggle-icon"></i></a>
                    <ul class="sidebar-submenu">
                        <li class="{{ request()->is('reports') ? 'active' : '' }}"><a href="/reports">گزارشات کلی</a></li>
                        <li class="{{ request()->is('reports/demographic') ? 'active' : '' }}"><a
                                href="/reports/demographic">گزارشات جمعیت شناختی</a></li>
                        <li class="{{ request()->is('reports/recruitment') ? 'active' : '' }}"><a
                                href="/reports/recruitment">گزارشات جذب و استخدام</a></li>
                                <li class="{{ request()->is('reports/recruitment') ? 'active' : '' }}"><a
                                href="/reports/onboarding">رصد آنبورد</a></li>
                    </ul>
                </li>

                <li
                    class="has-submenu {{ request()->is('personnel-list*') || request()->is('personnel/*') ? 'open active' : '' }}">
                    <a href="#"><i class="fas fa-list-alt menu-icon"></i><span>لیست پرسنلی</span><i
                            class="fas fa-chevron-down toggle-icon"></i></a>
                    <ul class="sidebar-submenu">
                        <li class="{{ request()->is('personnel-list') ? 'active' : '' }}"><a
                                href="{{ route('employees.index') }}">مشاهده لیست همکاران</a></li>
                    </ul>
                </li>

                <li class="has-submenu {{ request()->is('letters*') ? 'open active' : '' }}">
                    <a href="#"><i class="fas fa-folder-open menu-icon"></i><span>درخواست های اداری</span><i
                            class="fas fa-chevron-down toggle-icon"></i></a>
                    <ul class="sidebar-submenu">
                        <li class="{{ request()->is('letters_archive') ? 'active' : '' }}"><a href="/letters_archive">آرشیو
                                درخواست ها</a></li>
                        <li class="{{ request()->is('letters_issue') ? 'active' : '' }}"><a href="/letters_issue">صدور
                                آنلاین نامه</a></li>
                    </ul>
                </li>

                <li
                    class="has-submenu {{ request()->is('payrolls*') || request()->is('payroll-history*') ? 'open active' : '' }}">
                    <a href="#"><i class="fas fa-wallet menu-icon"></i><span>حقوق و دستمزد</span><i
                            class="fas fa-chevron-down toggle-icon"></i></a>
                    <ul class="sidebar-submenu">
                        <li class="{{ request()->is('payrolls') ? 'active' : '' }}"><a href="/payrolls"> لیست حقوق و
                                دستمزد</a></li>
                        <li class="{{ request()->is('payroll-history') ? 'active' : '' }}"><a href="/payroll-history">
                                تاریخچه حقوق و دستمزد</a></li>
                    </ul>
                </li>

                <li
                    class="has-submenu {{ request()->is('register') || request()->is('roles*') || request()->is('departments*') || request()->is('teams*') ? 'open active' : '' }}">
                    <a href="#"><i class="fas fa-screwdriver-wrench menu-icon"></i><span>مدیریت پنل </span><i
                            class="fas fa-chevron-down toggle-icon"></i></a>
                    <ul class="sidebar-submenu">
                        <li class="{{ request()->is('register') ? 'active' : '' }}"><a href="/register"> ثبت نام کاربر
                                سامانه</a></li>
                        <li class="{{ request()->is('roles') ? 'active' : '' }}"><a href="/roles"> نقش ها</a></li>
                        <li class="{{ request()->is('departments') ? 'active' : '' }}"><a href="/departments"> افزودن واحد
                            </a></li>
                        <li class="{{ request()->is('teams') ? 'active' : '' }}"><a href="/teams"> افزودن تیم </a></li>
                        <li class="{{ request()->is('dashboard') ? 'active' : '' }}"><a href="/dashboard"> جعبه ابزار </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </aside>

        <div class="main-wrapper">
            <header class="top-header">
                <div class="header-right"><span id="sidebar-toggle">☰</span></div>
                <div class="header-left">
                    <div class="profile-dropdown" id="profile-dropdown-toggle">
                        <div class="dropdown-toggle">
                            <i class="fas fa-user-circle"></i>
                            <span>
                                @auth
                                    {{ Auth::user()->name }}
                                @else
                                    ادمین
                                @endauth
                            </span>
                            <i class="fas fa-chevron-down" style="font-size: 0.8em;"></i>
                        </div>
                        <ul class="dropdown-menu">
                            <li><a href="#"><i class="fas fa-user"></i><span>پروفایل من</span></a></li>
                            <li><a href="#"><i class="fas fa-cog"></i><span>تنظیمات</span></a></li>
                            <li class="dropdown-divider"></li>
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>خروج از سامانه</span>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </li>

                        </ul>
                    </div>
                </div>
            </header>
            <main class="content-wrapper">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="m-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @yield('dashboard_content')
            </main>
        </div>
    </div>
@endsection
