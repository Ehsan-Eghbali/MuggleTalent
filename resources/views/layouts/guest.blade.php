<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>صفحه ورود</title>

    <!-- استفاده از Tailwind CSS از CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- فونت‌ها -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>
<body class="font-roboto bg-gradient-to-r from-red-400 to-blue-500 min-h-screen flex items-center justify-center">

<div class="w-full max-w-md p-8 bg-white rounded-xl shadow-lg">
    <div class="text-center">
        <h2 class="text-3xl font-semibold text-gray-800 mb-4">خوش آمدید</h2>
        <p class="text-gray-600">لطفا وارد حساب کاربری خود شوید</p>
    </div>

    <form method="POST" action="{{ url('login') }}" class="mt-6 space-y-6">
        @csrf

        <!-- ایمیل -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">ایمیل</label>
            <input type="email" id="email" name="email" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" autofocus>
        </div>

        <!-- رمز عبور -->
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">رمز عبور</label>
            <input type="password" id="password" name="password" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        @if ($errors->any())
            <div class="text-red-500 text-sm mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- دکمه ورود -->
        <div>
            <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                ورود
            </button>
        </div>
    </form>

    <div class="mt-6 text-center">
        <p class="text-sm text-gray-600">
            حساب کاربری ندارید؟
            <a href="{{ route('register') }}" class="text-blue-500 hover:text-blue-700">ثبت‌نام کنید</a>
        </p>
    </div>
</div>

</body>
</html>
