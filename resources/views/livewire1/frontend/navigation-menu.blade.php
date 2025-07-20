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
                        @if ($institutionLogo)
                        <img class="w-12 h-12 transition-transform duration-300 transform group-hover:scale-105"
                            src="{{ asset('storage/' . $institutionLogo) }}" alt="CITWAM Logo">
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

                <!-- Desktop Menu (moved inside the flex container with logo) -->
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

                    <!-- About Us Dropdown -->

                    <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false"
                        class="relative inline-block text-left">
                        <button type="button"
                            class="relative flex items-center px-3 py-2.5 text-sm font-medium text-gray-800 transition-all hover:text-blue-600 dark:text-white dark:hover:text-blue-100 group">
                            About Us
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                            <span
                                class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-200 transition-all duration-300 group-hover:w-full"></span>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute left-0 z-50 mt-1 origin-top-left bg-white rounded-md shadow-lg w-80 ring-1 ring-black ring-opacity-5 focus:outline-none"
                            style="display: none;">
                            <div class="p-4">
                                <div class="grid grid-cols-2 gap-2">
                                    <a href="{{ route('about') }}"
                                        class="relative flex flex-col items-center p-3 transition-all rounded-lg hover:bg-blue-50 group">
                                        <span class="text-sm font-medium text-center text-gray-700">Who we are</span>
                                    </a>

                                    <a href="{{ route('ministry.churches') }}"
                                        class="relative flex flex-col items-center p-3 transition-all rounded-lg hover:bg-blue-50 group">
                                        <span class="text-sm font-medium text-center text-gray-700">Regional
                                            Presence</span>
                                    </a>

                                    <a href="{{ route('church.leadership') }}"
                                        class="relative flex flex-col items-center p-3 transition-all rounded-lg hover:bg-blue-50 group">
                                        <span class="text-sm font-medium text-center text-gray-700">Leadership</span>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>




                    <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false"
                        class="relative inline-block text-left">
                        <button type="button"
                            class="relative flex items-center px-3 py-2.5 text-sm font-medium text-gray-800 transition-all hover:text-blue-600 dark:text-white dark:hover:text-blue-100 group">
                            Ministries
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                            <span
                                class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-200 transition-all duration-300 group-hover:w-full"></span>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute left-0 z-50 mt-1 origin-top-left bg-white rounded-md shadow-lg w-96 ring-1 ring-black ring-opacity-5 focus:outline-none"
                            style="display: none;">
                            <div class="p-4">
                                <div class="grid grid-cols-3 gap-2">
                                    <a href="{{ route('ministries.index') }}"
                                        class="relative flex flex-col items-center p-3 transition-all rounded-lg hover:bg-blue-50 group">
                                        <span class="text-sm font-medium text-center text-gray-700">Explore
                                            Ministries</span>
                                    </a>
                                    <a href="{{ route('ministries.index') }}"
                                        class="relative flex flex-col items-center p-3 transition-all rounded-lg hover:bg-blue-50 group">
                                        <span class="text-sm font-medium text-center text-gray-700">Youth
                                            Ministry</span>
                                    </a>
                                    <a href="{{ route('ministries.index') }}"
                                        class="relative flex flex-col items-center p-3 transition-all rounded-lg hover:bg-blue-50 group">
                                        <span class="text-sm font-medium text-center text-gray-700">Women's
                                            Ministry</span>
                                    </a>
                                    <a href="{{ route('ministries.index') }}"
                                        class="relative flex flex-col items-center p-3 transition-all rounded-lg hover:bg-blue-50 group">
                                        <span class="text-sm font-medium text-center text-gray-700">Prayer
                                            Ministry</span>
                                    </a>
                                    <a href="{{ route('ministries.index') }}"
                                        class="relative flex flex-col items-center p-3 transition-all rounded-lg hover:bg-blue-50 group">
                                        <span class="text-sm font-medium text-center text-gray-700">Men's
                                            Ministry</span>
                                    </a>
                                    <a href="{{ route('ministries.index') }}"
                                        class="relative flex flex-col items-center p-3 transition-all rounded-lg hover:bg-blue-50 group">
                                        <span class="text-sm font-medium text-center text-gray-700">Community
                                            Outreach</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    @foreach ([
                    'Sermons' => 'sermons',
                    'Church-Bulletin' => 'blog.index',
                    'Gallery' => 'ministry.galleries',
                    'MinistryEvents' => 'frontend.ministry.events',
                    'Development' => 'frontend.develop',
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

                <!-- Mobile About Us Dropdown -->
                <div x-data="{ ministriesOpen: false }">
                    <button @click="ministriesOpen = !ministriesOpen"
                        class="flex items-center justify-between w-full px-4 py-3.5 text-gray-700 hover:bg-blue-50 dark:text-gray-200 dark:hover:bg-gray-700 rounded-lg transition-colors">
                        <span>About Us</span>
                        <svg class="w-4 h-4 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor" :class="{'rotate-180': ministriesOpen}"
                            style="transition: transform 0.2s">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div x-show="ministriesOpen" class="px-4 py-2 mt-1 space-y-2 bg-white rounded-md">
                        <div class="p-2">
                            <h3 class="mb-3 text-sm font-semibold text-gray-900">About Our Ministry</h3>
                            <div class="grid grid-cols-2 gap-2">
                                <a href="{{ route('about') }}"
                                    class="relative flex flex-col items-center p-3 transition-all rounded-lg hover:bg-blue-50 group">
                                    <span class="text-sm font-medium text-center text-gray-700">Who we are</span>
                                </a>

                                <a href="{{ route('ministry.churches') }}"
                                    class="relative flex flex-col items-center p-3 transition-all rounded-lg hover:bg-blue-50 group">
                                    <span class="text-sm font-medium text-center text-gray-700">Regional Presence</span>
                                </a>

                                <a href="{{ route('church.leadership') }}"
                                    class="relative flex flex-col items-center p-3 transition-all rounded-lg hover:bg-blue-50 group">
                                    <span class="text-sm font-medium text-center text-gray-700">Leadership</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- Mobile Ministries Dropdown -->
                <div x-data="{ ministriesOpen: false }" class="relative">
                    <!-- Dropdown Toggle Button -->
                    <button @click="ministriesOpen = !ministriesOpen"
                        class="flex items-center justify-between w-full px-4 py-3.5 text-gray-700 hover:bg-blue-50 dark:text-gray-200 dark:hover:bg-gray-700 rounded-lg transition-colors">
                        <span>Ministries</span>
                        <svg class="w-4 h-4 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor" :class="{'rotate-180': ministriesOpen}"
                            style="transition: transform 0.2s">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>

                    <!-- Dropdown Content -->
                    <div x-show="ministriesOpen" x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="px-4 py-2 mt-1 bg-white rounded-md">
                        <div class="p-4">
                            <h3 class="mb-3 text-sm font-semibold text-gray-900">Our Ministries</h3>
                            <div class="grid grid-cols-3 gap-2">
                                <a href="{{ route('ministries.index') }}"
                                    class="relative flex flex-col items-center p-3 transition-all rounded-lg hover:bg-blue-50 group">
                                    <span class="text-sm font-medium text-center text-gray-700">Explore
                                        Ministries</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </a>
                                <a href=""
                                    class="relative flex flex-col items-center p-3 transition-all rounded-lg hover:bg-blue-50 group">
                                    <span class="text-sm font-medium text-center text-gray-700">Youth Ministry</span>
                                </a>
                                <a href=""
                                    class="relative flex flex-col items-center p-3 transition-all rounded-lg hover:bg-blue-50 group">
                                    <span class="text-sm font-medium text-center text-gray-700">Women's Ministry</span>
                                </a>
                                <a href=""
                                    class="relative flex flex-col items-center p-3 transition-all rounded-lg hover:bg-blue-50 group">
                                    <span class="text-sm font-medium text-center text-gray-700">Prayer Ministry</span>
                                </a>
                                <a href=""
                                    class="relative flex flex-col items-center p-3 transition-all rounded-lg hover:bg-blue-50 group">
                                    <span class="text-sm font-medium text-center text-gray-700">Men's Ministry</span>
                                </a>
                                <a href=""
                                    class="relative flex flex-col items-center p-3 transition-all rounded-lg hover:bg-blue-50 group">
                                    <span class="text-sm font-medium text-center text-gray-700">Community
                                        Outreach</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>


                @foreach ([
                'Sermons' => 'sermons',
                'Church-Bulletin' => 'blog.index',
                'Gallery' => 'ministry.galleries',
                'MinistryEvents' => 'frontend.ministry.events',
                'Development' => 'frontend.develop',
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
