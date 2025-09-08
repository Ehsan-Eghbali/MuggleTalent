<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سامانه جامع منابع انسانی</title>

    {{-- لینک فونت و آیکون‌ها --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    {{-- لینک به فایل CSS اصلی --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @yield('styles')
</head>

<body @if (request()->is('login')) class="login-body" @endif>
    <main>
        @yield('content')
    </main>

    {{-- لینک به فایل جاوااسکریپت اصلی با type="module" --}}
    <script src="{{ asset('js/app.js') }}" type="module"></script>
    @yield('scripts')
</body>

</html>
