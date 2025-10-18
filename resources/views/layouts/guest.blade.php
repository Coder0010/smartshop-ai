<!DOCTYPE html>
<html data-theme="dark" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-gray-100 dark:bg-gray-900">

<!-- ✅ Full-Width Navbar -->
<nav class="w-full bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <a href="{{ route('home') }}" class="text-gray-700 dark:text-gray-200 text-2xl font-bold text-blue-600">SmartShop</a>
        <ul class="flex gap-6 items-center">
            @auth
                <li>
                    <a href="{{ route('dashboard') }}"
                       class="text-gray-700 dark:text-gray-200 hover:text-blue-600 transition-colors font-medium">
                        Dashboard
                    </a>
                </li>
            @endauth
            @guest
                <li>
                    <a href="{{ route('login') }}"
                       class="text-gray-700 dark:text-gray-200 hover:text-blue-600 transition-colors font-medium">
                        dashboard
                    </a>
                </li>
            @endguest
        </ul>
        <ul class="flex gap-6 items-center">
            <li>
                <a href="{{ route('home') }}"
                   class="text-gray-700 dark:text-gray-200 hover:text-blue-600 transition-colors font-medium">
                    Products
                </a>
            </li>
            @if (Route::has('guest.cart.index'))
                <li>
                    <a href="{{ route('guest.cart.index') }}"
                       class="flex items-center gap-1 text-gray-700 dark:text-gray-200 hover:text-blue-600 transition-colors font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M2.25 3h1.386c.51 0 .955.343 1.09.835l.383 1.437m0 0L6.75 14.25h10.5l1.64-8.978a1.125 1.125 0 00-1.11-1.322H4.107m1.002 3.75h13.14M10.5 19.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zm9 0a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                        </svg>
                        Cart
                    </a>
                </li>
            @endif
        </ul>
    </div>
</nav>

<!-- ✅ Page Content -->
<main class="min-h-screen">
    <div class="max-w-7xl mx-auto mt-6 px-6 py-8 bg-white dark:bg-gray-800 shadow-md rounded-lg">
        {{ $slot }}
    </div>
</main>

<!-- Optional: Sticky footer or padding bottom -->
<footer class="mt-10 text-center text-sm text-gray-500 dark:text-gray-400 pb-6">
    © {{ date('Y') }} SmartShop. All rights reserved.
</footer>

</body>
</html>
