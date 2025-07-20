<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="themeManager()" x-bind:class="{ 'dark': isDark }"
    x-init="init()">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'ByNetOps') }} - ByNetOpsPannel</title>
    @if($siteSettings)
    <link rel="icon" href="{{ $siteSettings->favicon_url }}">
    @endif
    <!-- FOUC Prevention Script -->
    <script>
        (function() {
            const theme = sessionStorage.getItem('theme') || 'system';
            let isDark = false;

            if (theme === 'dark') {
                isDark = true;
            } else if (theme === 'light') {
                isDark = false;
            } else { // system
                isDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
            }

            if (isDark) {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>
        .gradient-brand {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .sidebar-link {
            @apply flex items-center space-x-3 px-3 py-2.5 rounded-lg text-slate-700 hover: bg-slate-100 hover:text-slate-900 transition-all duration-200;
        }

        .dark .sidebar-link {
            @apply text-slate-300 hover: bg-slate-700 hover:text-white;
        }

        .sidebar-link.active {
            @apply bg-blue-50 text-blue-700 border-r-2 border-blue-500;
        }

        .dark .sidebar-link.active {
            @apply bg-blue-900/20 text-blue-400 border-blue-400;
        }

        .shadow-large {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .dark .shadow-large {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3), 0 10px 10px -5px rgba(0, 0, 0, 0.2);
        }

        /* Mobile sidebar animation */
        .sidebar-enter {
            transform: translateX(-100%);
        }

        .sidebar-enter-active {
            transform: translateX(0);
            transition: transform 300ms ease-in-out;
        }

        .sidebar-exit {
            transform: translateX(0);
        }

        .sidebar-exit-active {
            transform: translateX(-100%);
            transition: transform 300ms ease-in-out;
        }

        /* Theme transition */
        * {
            transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease;
        }
    </style>
</head>

<body class="font-sans antialiased bg-slate-50 dark:bg-slate-900" x-data="{
    sidebarOpen: false,
    activeMenu: '{{ request()->route()->getName() ?? 'dashboard' }}',
    searchModalOpen: false
}">
    <div class="min-h-screen">
        <!-- Mobile Header -->
        <div class="bg-white border-b shadow-sm dark:bg-slate-800 lg:hidden border-slate-200 dark:border-slate-700">
            <div class="flex items-center justify-between px-4 py-3">
                <div class="flex items-center space-x-3">
                    <button @click="sidebarOpen = true"
                        class="p-2 transition-colors rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700">
                        <svg class="w-6 h-6 text-slate-600 dark:text-slate-300" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>

                <!-- Mobile User Menu -->
                <div class="flex items-center space-x-3">
                    <x-theme-toggle mobile />
                    <a href="/" target="_blank" rel="noopener noreferrer"
                        class="inline-block p-1 transition-colors rounded-full group hover:bg-gray-100"
                        title="Go to Frontend">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-6 h-6 text-purple-600 transition-colors hover:text-purple-700 group-hover:scale-105 transform-gpu"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" role="img"
                            aria-label="Frontend Link">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                        </svg>
                    </a>
                    <button
                        class="relative p-2 transition-colors rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700">
                        <svg class="w-5 h-5 text-slate-600 dark:text-slate-300" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                            </path>
                        </svg>
                        <span class="absolute w-2 h-2 bg-red-500 rounded-full -top-0.5 -right-0.5"></span>
                    </button>
                    <div class="flex items-center justify-center w-8 h-8 rounded-full gradient-brand">
                        <span class="text-xs font-medium text-white">{{ substr(Auth::user()->name, 0, 1) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex">
            <!-- Sidebar  -->
            <div x-show="sidebarOpen" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" @click="sidebarOpen = false"
                class="fixed inset-0 z-50 bg-black bg-opacity-50 lg:hidden"></div>

            <!-- Sidebar content -->
            <div x-bind:class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
                class="fixed inset-y-0 left-0 z-50 w-64 transition-transform duration-300 ease-in-out transform bg-white shadow-xl dark:bg-slate-800 lg:translate-x-0 lg:static lg:inset-0 lg:shadow-none lg:border-r lg:border-slate-200 dark:lg:border-slate-700">
                <!-- Sidebar Header -->
                <div
                    class="flex items-center justify-between p-4 border-b border-slate-200 dark:border-slate-700 lg:p-6">
                    <div class="flex items-center max-w-full space-x-3">
                        <a href="{{ route(config('app.admin_prefix') . '.dashboard') }}"
                            class="flex items-center min-w-0 space-x-2">
                            <a href="{{ route(config('app.admin_prefix') . '.dashboard') }}"
                                class="inline-block w-12 h-12 mx-auto overflow-hidden bg-white rounded-xl">
                                @if($siteSettings)
                                <img src="{{ $siteSettings->institution_logo_url }}" alt="ByNetOps"
                                    class="object-contain w-full h-full pointer-events-none select-none">
                                @endif
                            </a>
                            <div class="flex flex-col min-w-0">
                                <span
                                    class="text-sm font-bold leading-tight text-gray-900 truncate transition-colors duration-300 md:text-md dark:text-white lg:text-md">
                                    {{ config('app.name', 'ByNetOps') }}
                                </span>
                                <span
                                    class="text-[10px] md:text-xs font-medium leading-relaxed tracking-wider text-gray-600 dark:text-white/80 truncate transition-colors duration-300">
                                    (CITWAM)
                                </span>

                            </div>
                        </a>
                    </div>
                    <button @click="sidebarOpen = false"
                        class="p-2 transition-colors rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 lg:hidden">
                        <svg class="w-5 h-5 text-slate-600 dark:text-slate-300" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <!-- Navigation component -->
                <x-dash-ui.nav-ui />
                <!-- User Profile Card -->
                <div class="hidden p-4 border-t lg:block border-slate-200 dark:border-slate-700">
                    <div
                        class="flex items-center p-3 space-x-3 transition-colors rounded-lg bg-slate-50 dark:bg-slate-700/50 hover:bg-slate-100 dark:hover:bg-slate-700">
                        <div
                            class="flex items-center justify-center w-10 h-10 overflow-hidden rounded-full gradient-brand">
                            @if(Auth::user()->profile_photo_path)
                            <img src="{{ Storage::url(Auth::user()->profile_photo_path) }}"
                                alt="{{ Auth::user()->name }}" class="object-cover w-full h-full">
                            @else
                            <span class="font-medium text-white">{{ substr(Auth::user()->name, 0, 1) }}</span>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium truncate text-slate-900 dark:text-white">{{ Auth::user()->name
                                }}</p>
                            <p class="text-xs truncate text-slate-500 dark:text-slate-400">{{ Auth::user()->email }}</p>
                        </div>
                        <div x-data="{ userMenuOpen: false }" class="relative">
                            <button @click="userMenuOpen = !userMenuOpen"
                                class="p-1 transition-colors rounded hover:bg-slate-200 dark:hover:bg-slate-600">
                                <svg class="w-4 h-4 text-slate-600 dark:text-slate-300" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z">
                                    </path>
                                </svg>
                            </button>

                            <div x-show="userMenuOpen" @click.away="userMenuOpen = false" x-transition
                                class="absolute right-0 w-48 py-1 mb-2 bg-white border rounded-lg dark:bg-slate-800 bottom-full shadow-large border-slate-200 dark:border-slate-700">
                                <a href=""
                                    class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700">
                                    Profile Settings
                                </a>
                                <a href=""
                                    class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700">
                                    Account Settings
                                </a>
                                <hr class="my-1 border-slate-200 dark:border-slate-600">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full px-4 py-2 text-sm text-left text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="flex-1 min-h-screen lg:ml-0">
                <!-- Desktop Header -->
                <header
                    class="sticky top-0 z-30 hidden bg-white border-b shadow-sm dark:bg-slate-800 lg:block border-slate-200 dark:border-slate-700">
                    <div class="flex items-center justify-between px-6 py-4 space-x-4">
                        <!-- Search Bar -->
                        <div class="flex-1 max-w-md">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <input type="text" placeholder="Search..."
                                    class="w-full py-2 pl-10 pr-4 transition-all border-0 rounded-lg bg-slate-100 dark:bg-slate-700 dark:text-white dark:placeholder-slate-400 focus:bg-white dark:focus:bg-slate-600 focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>

                        <!-- Header Actions -->
                        <div class="flex items-center space-x-4">
                            <x-theme-toggle />
                            <a href="/" target="_blank" rel="noopener noreferrer"
                                class="inline-block p-1 transition-colors rounded-full group hover:bg-gray-100"
                                title="Go to Frontend">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-6 h-6 text-purple-600 transition-colors hover:text-purple-700 group-hover:scale-105 transform-gpu"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" role="img"
                                    aria-label="Frontend Link">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                </svg>
                            </a>

                            <!-- Notifications -->
                            <div class="relative" x-data="{ notificationOpen: false }">
                                <button @click="notificationOpen = !notificationOpen"
                                    class="relative p-2 transition-colors rounded-lg text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                                        </path>
                                    </svg>
                                    <span
                                        class="absolute top-0 right-0 flex items-center justify-center w-4 h-4 text-xs text-white bg-red-500 rounded-full">3</span>
                                </button>

                                <div x-show="notificationOpen" @click.away="notificationOpen = false" x-transition
                                    class="absolute right-0 z-50 py-1 mt-2 bg-white border rounded-lg dark:bg-slate-800 w-80 shadow-large border-slate-200 dark:border-slate-700">
                                    <div class="px-4 py-3 border-b border-slate-200 dark:border-slate-700">
                                        <h3 class="text-sm font-medium text-slate-900 dark:text-white">Notifications
                                        </h3>
                                    </div>
                                    <div class="overflow-y-auto max-h-64">
                                        <a href="#"
                                            class="block px-4 py-3 border-b border-slate-100 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-700">
                                            <div class="flex items-start space-x-3">
                                                <div class="flex-shrink-0">
                                                    <div
                                                        class="flex items-center justify-center w-8 h-8 bg-blue-100 rounded-full dark:bg-blue-900/20">
                                                        <svg class="w-4 h-4 text-blue-600 dark:text-blue-400"
                                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                            </path>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-sm font-medium text-slate-900 dark:text-white">New
                                                        user registered
                                                    </p>
                                                    <p class="text-xs text-slate-500 dark:text-slate-400">2 hours ago
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-center text-blue-600 dark:text-blue-400 hover:bg-slate-50 dark:hover:bg-slate-700">
                                        View all notifications
                                    </a>
                                </div>
                            </div>

                            <!-- Profile Dropdown -->
                            <div class="relative" x-data="{ profileOpen: false }">
                                <button @click="profileOpen = !profileOpen"
                                    class="flex items-center space-x-2 text-left">
                                    <div
                                        class="flex items-center justify-center w-8 h-8 overflow-hidden text-white rounded-full gradient-brand">
                                        @if(Auth::user()->profile_photo_path)
                                        <img src="{{ Storage::url(Auth::user()->profile_photo_path) }}"
                                            alt="{{ Auth::user()->name }}" class="object-cover w-full h-full">
                                        @else
                                        <span class="text-sm font-medium">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                        @endif
                                    </div>
                                    <div class="hidden md:block">
                                        <div class="text-sm font-medium text-slate-800 dark:text-white">{{
                                            Auth::user()->name }}</div>
                                        <div class="text-xs text-slate-500 dark:text-slate-400">{{ Auth::user()->email
                                            }}</div>
                                    </div>
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>

                                <div x-show="profileOpen" @click.away="profileOpen = false" x-transition
                                    class="absolute right-0 z-50 w-48 py-1 mt-2 bg-white border rounded-lg dark:bg-slate-800 shadow-large border-slate-200 dark:border-slate-700">
                                    <a href=""
                                        class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700">
                                        Your Profile
                                    </a>
                                    <a href=""
                                        class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700">
                                        Settings
                                    </a>
                                    @if(Laravel\Jetstream\Jetstream::hasApiFeatures())
                                    <a href="{{ route('api-tokens.index') }}"
                                        class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700">
                                        API Tokens
                                    </a>
                                    @endif
                                    <div class="my-1 border-t border-slate-200 dark:border-slate-600"></div>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="block w-full px-4 py-2 text-sm text-left text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20">
                                            Log Out
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="p-4 lg:p-6">
                    <div class="mx-auto max-w-7xl">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>
    </div>

    @livewireScripts
    <script>
        function themeManager() {
            return {
                theme: 'system', // 'system', 'light', 'dark'
                isDark: false,

                init() {
                    // Get theme from sessionStorage or default to system
                    this.theme = sessionStorage.getItem('theme') || 'system';
                    this.updateTheme();

                    // Listen for system theme changes
                    if (window.matchMedia) {
                        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
                            if (this.theme === 'system') {
                                this.updateTheme();
                            }
                        });
                    }
                },

                setTheme(newTheme) {
                    this.theme = newTheme;
                    sessionStorage.setItem('theme', newTheme);
                    this.updateTheme();
                },

                toggleTheme() {
                    // Cycle through: system -> light -> dark -> system
                    if (this.theme === 'system') {
                        this.setTheme('light');
                    } else if (this.theme === 'light') {
                        this.setTheme('dark');
                    } else {
                        this.setTheme('system');
                    }
                },

                updateTheme() {
                    if (this.theme === 'dark') {
                        this.isDark = true;
                        document.documentElement.classList.add('dark');
                    } else if (this.theme === 'light') {
                        this.isDark = false;
                        document.documentElement.classList.remove('dark');
                    } else { // system
                        // Check system preference
                        const systemDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
                        this.isDark = systemDark;
                        if (systemDark) {
                            document.documentElement.classList.add('dark');
                        } else {
                            document.documentElement.classList.remove('dark');
                        }
                    }
                },

                // Getter for current theme display name
                get currentThemeName() {
                    return this.theme.charAt(0).toUpperCase() + this.theme.slice(1);
                }
            }
        }
    </script>
    @stack('modals')

</body>

</html>
