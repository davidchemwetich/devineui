<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

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

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased bg-gray-50 dark:bg-[#008000] transition-colors duration-500">
    <div class="min-h-screen flex">

        <!-- Hero Section (large screens only) -->
        <div class="hidden lg:flex lg:w-1/2 xl:w-3/5 relative">
            <!-- Background Image -->
            <div class="absolute inset-0">
                <img src="https://images.unsplash.com/photo-1504052434569-70ad5836ab65?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                    alt="Church Background" class="w-full h-full object-cover" />
                <!-- Soft Green Overlay -->
                <div
                    class="absolute inset-0 bg-gradient-to-br from-[#008000]/60 via-[#006400]/50 to-transparent dark:from-[#006400]/70 dark:via-[#004d00]/60 dark:to-transparent">
                </div>
            </div>

            <!-- Hero Text with subtle blur and animation -->
            <div class="relative z-10 flex flex-col justify-center items-center text-white text-center px-8 lg:px-12 xl:px-16 w-full"
                x-data="{ show: false }" x-init="setTimeout(() => show = true, 300)" x-show="show"
                x-transition:enter="transition ease-out duration-1000"
                x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="max-w-xl bg-black/20 dark:bg-white/10 backdrop-blur-md rounded-xl p-6">
                    <!-- Logo -->
                    <div class="mb-6">
                        <div
                            class="w-20 h-20 mx-auto bg-white bg-opacity-10 rounded-full flex items-center justify-center backdrop-blur-sm">

                            <x-authentication-card-logo />

                        </div>
                    </div>

                    <!-- App Name -->
                    <h1 class="text-4xl lg:text-5xl xl:text-6xl font-bold mb-4 leading-tight text-white">
                        {{ config('app.name') }}
                    </h1>

                    <!-- Bible Verse -->
                    <p class="text-md lg:text-xl text-gray-100 dark:text-gray-200 mb-6 leading-relaxed">
                        Jesus answered, "I am the way and the truth and the life. No one comes to the Father except
                        through me."
                    </p>

                    <!-- Dots -->
                    <div class="flex justify-center space-x-4 opacity-70">
                        <div class="w-2 h-2 bg-white rounded-full"></div>
                        <div class="w-2 h-2 bg-white rounded-full"></div>
                        <div class="w-2 h-2 bg-white rounded-full"></div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Auth Section -->
        <div
            class="w-full lg:w-1/2 xl:w-2/5 flex flex-col justify-center px-6 py-12 lg:px-8 dark:bg-[#008000] transition-colors duration-500">
            <div class="sm:mx-auto sm:w-full sm:max-w-md">

                <!-- Mobile Logo / App Name -->
                <div class="lg:hidden text-center mb-8">
                    <div class="w-16 h-16 mx-auto bg-[#000fff] rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2L8 6V10H6V12H8V22H16V12H18V10H16V6L12 2ZM10 8V6.83L12 4.83L14 6.83V8H10ZM14 20H10V12H14V20Z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ config('app.name') }}</h2>
                    <p class="text-gray-600 dark:text-gray-200 mt-2">Welcome back to our community</p>
                </div>

                <!-- Login/Register Card with Animation -->
                <div class="bg-white dark:bg-gray-900 py-8 px-6 shadow-xl rounded-2xl sm:px-10 border border-gray-100 dark:border-gray-700"
                    x-data="{ showCard: false }" x-init="setTimeout(() => showCard = true, 200)" x-show="showCard"
                    x-transition:enter="transition ease-out duration-700" x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100">
                    {{ $slot }}
                </div>
            </div>

            <!-- Footer -->
            <div class="mt-8 text-center text-sm text-gray-500 dark:text-gray-200">
                &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </div>
        </div>
    </div>
</body>

</html>
