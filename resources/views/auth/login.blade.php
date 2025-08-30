@extends('layouts.app')

{{-- این دستور، کلاس "login-body" را به تگ <body> در لایوت اصلی منتقل می‌کند --}}
@section('body_class', 'login-body')

@section('content')
    <div class="login-container">
        <div class="login-header">
            <img src="{{ asset('images/logo.png') }}" alt="لوگو سامانه" style="width:120px; height:auto; margin-bottom:10px;">
            <h1>سامانه جامع منابع انسانی</h1>
            <p>پگاه داده کاوان شریف</p>
        </div>
        @if (session('error'))
            <div class="alert-danger">{{ session('error') }}</div>
        @endif
        <form action="#" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">ایمیل</label>
                <input type="email" id="email" name="email" value="e.m.mghbl@gmail.com" required>
            </div>
            <div class="form-group">
                <label for="password">رمز عبور</label>
                <input type="password" id="password" name="password" value="******" required>
            </div>
            <div class="form-options">
                <div class="remember-me">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">مرا به خاطر بسپار</label>
                </div>
            </div>
            <button type="submit" class="btn">ورود</button>
            <div class="form-options" style="margin-top: 1rem; justify-content: center;">
                <a href="#">رمز عبور خود را فراموش کرده‌اید؟</a>
            </div>
        </form>
        <div class="login-footer">
            <p>حسابی ندارید؟ از واحد منابع انسانی لینک بگیرید.</p>
            <p>© 1404 منابع انسانی پایگاه داده کاوان شریف</p>
        </div>
    </div>
@endsection