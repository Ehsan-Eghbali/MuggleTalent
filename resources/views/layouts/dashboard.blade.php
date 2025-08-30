@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{asset("css/layouts/dashboard.css")}}">
    {{-- HTML و اسکریپت اصلی لایوت --}}
@endsection
@section('content')
    <div class="dashboard-layout">
        <aside class="sidebar">
            <img src="{{ asset('images/logo.png') }}" alt="لوگو سامانه" style="width:120px; height:auto; margin-bottom:10px;">
            <ul class="sidebar-menu">
                <li><a href="#"><i class="fas fa-info-circle menu-icon"></i><span>گزارش منابع انسانی</span></a></li>
                <li class="has-submenu open active">
                    <a href="#"><i class="fas fa-list-alt menu-icon"></i><span>لیست پرسنلی</span><i
                            class="fas fa-chevron-down toggle-icon"></i></a>
                    <ul class="sidebar-submenu">
                        <li class="active"><a href="/personnel-list">مشاهده لیست همکاران</a></li>
                    </ul>
                </li>
                <li class="has-submenu open active">
                    <a href="#"><i class="fas fa-folder-open menu-icon"></i><span>درخواست های اداری</span><i
                            class="fas fa-chevron-down toggle-icon"></i></a>
                    <ul class="sidebar-submenu">
                        <li class="active"><a href="/letters_archive">آرشیو درخواست ها</a></li>
                    </ul>
                    <ul class="sidebar-submenu">
                        <li class="active"><a href="/letters_issue">صدور آنلاین نامه</a></li>
                    </ul>
                </li>
                <li class="has-submenu open active">
                    <a href="#"><i class="fas fa-wallet menu-icon"></i><span>حقوق و دستمزد</span><i
                            class="fas fa-chevron-down toggle-icon"></i></a>
                    <ul class="sidebar-submenu">
                        <li class="active"><a href="#"> لیست حقوق و دستمزد</a></li>
                        <li><a href="#"> تاریخچه حقوق و دستمزد</a></li>
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
                    parentLi.classList.toggle('open');
                });
            });
        });
    </script>
@endsection
