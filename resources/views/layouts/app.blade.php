<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سامانه جامع منابع انسانی</title>

    {{-- لینک فونت و آیکون‌ها --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{asset("css/app.css")}}">
</head>

<body @if(request()->is('login')) class="login-body" @endif>
    <main>
        @yield('content')
    </main>

    @yield('scripts')
</body>
</html>
