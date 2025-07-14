<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>صفحه ثبت‌نام</title>

    <!-- استفاده از Tailwind CSS از CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- فونت‌ها -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>
<body class="font-roboto bg-gradient-to-r from-blue-500 to-teal-500 min-h-screen flex items-center justify-center">

<div class="w-full max-w-md p-8 bg-white rounded-xl shadow-lg">
    <div class="text-center">
        <h2 class="text-3xl font-semibold text-gray-800 mb-4">ثبت‌نام در حساب</h2>
        <p class="text-gray-600">لطفا اطلاعات خود را وارد کنید</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="mt-6 space-y-6">
        @csrf

        <!-- نام کامل -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">نام کامل</label>
            <input type="text" id="name" name="name" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- ایمیل -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">ایمیل</label>
            <input type="email" id="email" name="email" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- رمز عبور -->
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">رمز عبور</label>
            <input type="password" id="password" name="password" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- تکرار رمز عبور -->
        <div class="mb-4">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">تکرار رمز عبور</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
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

        <!-- دکمه ثبت‌نام -->
        <div>
            <button type="submit" class="w-full bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                ثبت‌نام
            </button>
        </div>
    </form>

    <div class="mt-6 text-center">
        <p class="text-sm text-gray-600">
            قبلاً حساب کاربری دارید؟
            <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-700">وارد شوید</a>
        </p>
    </div>
</div>

</body>
</html>
