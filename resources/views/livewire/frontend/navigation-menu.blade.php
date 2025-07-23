<nav class="fixed z-50 w-full transition-all duration-300 bg-white shadow-md dark:bg-gray-900"
    x-data="{ isOpen: false, mobileMenuOpen: false, scrolled: false }"
    @scroll.window="scrolled = window.pageYOffset > 50" :class="{ 'shadow-md': scrolled }"
    @keydown.window.escape="mobileMenuOpen = false">

    <!-- Desktop Nav -->
    <div class="px-4 mx-auto max-w-8xl sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20 transition-all duration-300" :class="{ 'h-16': scrolled }">

            <!-- Container for Logo + Links (to bring them closer) -->
            <div class="flex items-center">
                <!-- Logo Section with Hover Effect -->
                <a href="{{ route('home') }}" class="mr-4">
                    <div class="flex items-center flex-shrink-0 space-x-3 group">
                        @if($siteSettings)
                        <img src="{{ $siteSettings->institution_logo_url }}" alt="ByNetOps"
                            class="h-10 w-auto object-contain pointer-events-none select-none">
                        @endif
                        <div class="flex flex-col">
                            <span class="text-md font-bold leading-tight text-[#008000]">
                                Christ Is the Way Ministries
                            </span>
                            <span class="text-xs font-medium leading-relaxed tracking-wide text-[#008000]">
                                (CITWAM)
                            </span>
                        </div>
                    </div>
                </a>


                <!-- Desktop Menu  -->
                <div class="items-center hidden space-x-1 lg:flex">
                    @foreach ([
                    'Home' => 'home',
                    ] as $label => $route)
                    <a href="{{ route($route) }}"
                        class="relative px-3 py-2.5 text-sm font-medium text-gray-800 transition-all hover:text-blue-600 dark:text-white dark:hover:text-blue-100 group">
                        {{ $label }}
                        <span
                            class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-200 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    @endforeach

                    <!-- Desktop About Us -->
                    <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
                        <button type="button"
                            class="relative flex items-center px-3 py-2.5 text-sm font-medium text-gray-800 transition-all hover:text-blue-600 dark:text-white dark:hover:text-blue-100">
                            About Us
                            <svg class="w-4 h-4 ml-1 transition-transform duration-200" :class="{ 'rotate-180': open }"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 -translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 -translate-y-2"
                            class="absolute left-0 mt-2 w-72 origin-top-left rounded-xl bg-white shadow-lg ring-1 ring-black/5 z-50"
                            style="display:none;">
                            <div class="p-5 grid grid-cols-1 gap-3">
                                <a href="{{ route('about') }}"
                                    class="flex items-center p-3 rounded-lg text-sm font-medium text-gray-700 hover:bg-blue-50 transition-colors">
                                    <span class="mr-3 text-blue-500">👥</span> Who we are
                                </a>
                                <a href="{{ route('churches') }}"
                                    class="flex items-center p-3 rounded-lg text-sm font-medium text-gray-700 hover:bg-blue-50 transition-colors">
                                    <span class="mr-3 text-green-500">🌍</span> Regional Presence
                                </a>
                                <a href="{{ route('church.leadership') }}"
                                    class="flex items-center p-3 rounded-lg text-sm font-medium text-gray-700 hover:bg-blue-50 transition-colors">
                                    <span class="mr-3 text-purple-500">👑</span> Leadership
                                </a>
                            </div>
                        </div>
                    </div>




                    <!-- Desktop Ministries -->
                    <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
                        <button type="button"
                            class="relative flex items-center px-3 py-2.5 text-sm font-medium text-gray-800 transition-all hover:text-blue-600 dark:text-white dark:hover:text-blue-100">
                            Ministries
                            <svg class="w-4 h-4 ml-1 transition-transform duration-200" :class="{ 'rotate-180': open }"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 -translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 -translate-y-2"
                            class="absolute left-0 mt-2 w-96 origin-top-left rounded-xl bg-white shadow-lg ring-1 ring-black/5 z-50"
                            style="display:none;">
                            <div class="p-5 grid grid-cols-2 gap-3">
                                @foreach ([
                                'Explore Ministries' => 'ministries.index',
                                'Youth Ministry' => 'ministries.index',
                                'Women\'s Ministry' => 'ministries.index',
                                'Prayer Ministry' => 'ministries.index',
                                'Men\'s Ministry' => 'ministries.index',
                                ] as $label => $route)
                                <a href="{{ route($route) }}"
                                    class="flex items-center p-3 rounded-lg text-sm font-medium text-gray-700 hover:bg-blue-50 transition-colors">
                                    <span class="mr-3 text-blue-500">🙏</span> {{ $label }}
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    @foreach ([
                    'Sermons' => 'sermons',
                    'Church-Bulletin' => 'frontend.info-hub',
                    'Gallery' => 'ministry.galleries',
                    'Development' => 'projects.index',
                    'ContactUs' => 'contact'
                    ] as $label => $route)
                    <a href="{{ route($route) }}"
                        class="relative px-3 py-2.5 text-sm font-medium text-gray-800 transition-all hover:text-blue-600 dark:text-white dark:hover:text-blue-100 group">
                        {{ $label }}
                        <span
                            class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-200 transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- Donate Button in its own container (pushed to the far right) -->
            <div class="hidden lg:block">
                <a href="{{ route('donate') }}" class="px-6 py-2.5 text-sm font-semibold text-white transition-all transform hover:scale-105
                          bg-[#000fff] rounded-lg shadow-md hover:shadow-lg">
                    Donate Now
                </a>
            </div>

            <!-- Animated Mobile Menu Button -->
            <div class="lg:hidden">
                <button @click="mobileMenuOpen = true"
                    class="p-2 text-gray-800 hover:text-blue-600 dark:text-white dark:hover:text-blue-200 focus:outline-none">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!mobileMenuOpen" class="transition-all" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Enhanced Mobile Menu -->
    <div class="fixed inset-0 z-50 lg:hidden" x-show="mobileMenuOpen" x-cloak>
        <!-- Blur Overlay -->
        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm" @click="mobileMenuOpen = false"></div>

        <!-- Sidebar with Slide Effect -->
        <div class="relative w-full h-full max-w-xs transition-all duration-300 transform bg-white shadow-2xl dark:bg-gray-800"
            :class="{ 'translate-x-0': mobileMenuOpen, '-translate-x-full': !mobileMenuOpen }">

            <!-- Mobile Header -->
            <div class="p-5 ">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">

                        @if ($institutionLogo)
                        <img class="w-10 h-10" src="{{ asset('storage/' . $institutionLogo) }}" alt="CITWAM Logo">
                        @endif

                        <div class="text-[#008000]">
                            <div class="text-sm font-bold">Christ Is the Way Ministries</div>
                            <div class="text-xs opacity-80">CITWAM</div>
                        </div>
                    </div>
                    <button @click="mobileMenuOpen = false" class="p-1 text-gray-700 hover:text-blue-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu Items -->
            <div class="p-4 space-y-1">
                @foreach ([
                'Home' => 'home',
                ] as $label => $route)
                <a href="{{ route($route) }}"
                    class="flex items-center px-4 py-3.5 text-gray-700 hover:bg-blue-50 dark:text-gray-200 dark:hover:bg-gray-700 rounded-lg transition-colors">
                    {{ $label }}
                </a>
                @endforeach

                <!-- Mobile About Us Accordion -->
                <div x-data="{ open: false }">
                    <button @click="open = !open"
                        class="flex items-center justify-between w-full px-4 py-3.5 text-gray-700 hover:bg-blue-50 rounded-lg transition-colors">
                        <span>About Us</span>
                        <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': open }"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="px-4 pb-3 space-y-2">
                        <a href="{{ route('about') }}" class="block py-2 text-sm text-gray-600 hover:text-blue-600">Who
                            we are</a>
                        <a href="{{ route('churches') }}"
                            class="block py-2 text-sm text-gray-600 hover:text-blue-600">Regional Presence</a>
                        <a href="{{ route('church.leadership') }}"
                            class="block py-2 text-sm text-gray-600 hover:text-blue-600">Leadership</a>
                    </div>
                </div>



                <!-- Mobile Ministries Accordion -->
                <div x-data="{ open: false }">
                    <button @click="open = !open"
                        class="flex items-center justify-between w-full px-4 py-3.5 text-gray-700 hover:bg-blue-50 rounded-lg transition-colors">
                        <span>Ministries</span>
                        <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': open }"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="open" x-collapse class="px-4 pb-3 space-y-2">
                        @foreach ([
                        'Explore Ministries',
                        'Youth Ministry',
                        'Women\'s Ministry',
                        'Prayer Ministry',
                        'Men\'s Ministry',
                        ] as $label)
                        <a href="{{ route('ministries.index') }}"
                            class="block py-2 text-sm text-gray-600 hover:text-blue-600">{{ $label }}</a>
                        @endforeach
                    </div>
                </div>


                @foreach ([
                'Sermons' => 'sermons',
                'Church-Bulletin' => 'frontend.info-hub',
                'Gallery' => 'ministry.galleries',
                'Development' => 'projects.index',
                'ContactUs' => 'contact'
                ] as $label => $route)
                <a href="{{ route($route) }}"
                    class="flex items-center px-4 py-3.5 text-gray-700 hover:bg-blue-50 dark:text-gray-200 dark:hover:bg-gray-700 rounded-lg transition-colors">
                    {{ $label }}
                </a>
                @endforeach

                <a href="{{ route('donate') }}" class="block px-4 py-3.5 mt-4 text-center text-white bg-gradient-to-r bg-blue-600 hover:bg-blue-700
                             rounded-lg shadow-md hover:shadow-lg transition-all">
                    Donate Now
                </a>
            </div>
        </div>
    </div>
</nav>