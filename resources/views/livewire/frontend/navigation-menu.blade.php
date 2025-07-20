<div
    x-data="navigationMenu({
        isMobileMenuOpen: @entangle('isMobileMenuOpen').live,
        darkMode: @entangle('darkMode').live
    })"
    x-init="init"
    @keydown.escape.window="closeMobileMenu"
    @resize.window.debounce.150ms="handleResize"
    class="relative z-50"
>
    <!-- Main Navigation Bar -->
    <nav
        :class="{
            'shadow-lg': isScrolled,
            'transform translate-y-0': isNavVisible,
            'transform -translate-y-full': !isNavVisible
        }"
        class="fixed inset-x-0 top-0 transition-all duration-300 ease-in-out bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800"
        role="navigation"
        aria-label="Main Navigation"
    >
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 lg:h-20">

                <!-- Logo -->
                <a href="{{ route('home') }}" wire:navigate class="flex-shrink-0 flex items-center space-x-3 group" aria-label="Homepage">
                    @if($institutionLogo)
                        <img src="{{ asset('storage/'.$institutionLogo) }}" alt="Logo" class="h-10 w-10 lg:h-12 lg:w-12 rounded-full object-cover shadow-md transition-transform duration-300 group-hover:scale-110">
                    @else
                         <div class="h-10 w-10 lg:h-12 lg:w-12 rounded-full bg-emerald-500 flex items-center justify-center shadow-md transition-transform duration-300 group-hover:scale-110">
                            <i class="fas fa-church text-white text-xl"></i>
                        </div>
                    @endif
                    <div class="hidden sm:block">
                        <p class="text-lg font-bold text-gray-800 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">Christ Is The Way</p>
                        <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Ministries</p>
                    </div>
                </a>

                <!-- Desktop Navigation -->
                <div class="hidden lg:flex items-center space-x-1">
                    @foreach($navigationItems as $key => $item)
                        @if(!empty($item['children']))
                            <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
                                <button @click="open = !open" class="flex items-center px-4 py-2 text-sm font-medium rounded-md transition-colors duration-200" :class="isActive('{{ $key }}') ? 'text-emerald-600 dark:text-emerald-400' : 'text-gray-600 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400'">
                                    <i class="{{ $item['icon'] }} mr-2 text-base opacity-80"></i>
                                    <span>{{ $item['label'] }}</span>
                                    <i class="fas fa-chevron-down ml-2 text-xs transition-transform duration-300" :class="{ 'rotate-180': open }"></i>
                                </button>
                                <div x-show="open" x-cloak
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 translate-y-2"
                                     x-transition:enter-end="opacity-100 translate-y-0"
                                     x-transition:leave="transition ease-in duration-150"
                                     x-transition:leave-start="opacity-100 translate-y-0"
                                     x-transition:leave-end="opacity-0 translate-y-2"
                                     class="absolute left-1/2 -translate-x-1/2 mt-2 w-64 bg-white dark:bg-gray-800 rounded-xl shadow-2xl ring-1 ring-black ring-opacity-5 overflow-hidden z-20">
                                    <div class="p-2">
                                        @foreach($item['children'] as $child)
                                            <a href="{{ route($child['route'], $child['params'] ?? []) }}" wire:navigate class="flex items-center px-4 py-3 text-sm rounded-lg transition-all duration-150 group" :class="isActive('{{ $child['route'] }}') ? 'bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/50 hover:text-emerald-600 dark:hover:text-emerald-400'">
                                                <i class="{{ $child['icon'] }} mr-3 w-5 text-center text-emerald-500 transition-transform duration-150 group-hover:scale-110"></i>
                                                <span>{{ $child['label'] }}</span>
                                                <i class="fas fa-arrow-right ml-auto text-xs opacity-0 group-hover:opacity-100 transform -translate-x-1 group-hover:translate-x-0 transition-all duration-200"></i>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @else
                            <a href="{{ route($item['route']) }}" wire:navigate class="flex items-center px-4 py-2 text-sm font-medium rounded-md transition-colors duration-200" :class="isActive('{{ $item['route'] }}') ? 'text-emerald-600 dark:text-emerald-400' : 'text-gray-600 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400'">
                                <i class="{{ $item['icon'] }} mr-2 text-base opacity-80"></i>
                                <span>{{ $item['label'] }}</span>
                            </a>
                        @endif
                    @endforeach
                </div>

                <!-- Actions & Mobile Toggle -->
                <div class="flex items-center space-x-2">
                     <button @click="$wire.toggleDarkMode()" title="Toggle Dark Mode" class="w-10 h-10 flex items-center justify-center rounded-full text-gray-600 dark:text-gray-300 hover:bg-gray-200/50 dark:hover:bg-gray-700/50 transition-colors">
                        <i class="fas" :class="darkMode ? 'fa-sun' : 'fa-moon'"></i>
                    </button>
                    <a href="{{ route('donate') }}" class="hidden sm:inline-flex items-center px-5 py-2.5 text-sm font-semibold text-white bg-emerald-600 rounded-full shadow-md hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-heart mr-2"></i>
                        Donate
                    </a>
                    <button @click="toggleMobileMenu" class="lg:hidden w-10 h-10 flex items-center justify-center rounded-full text-gray-600 dark:text-gray-300 hover:bg-gray-200/50 dark:hover:bg-gray-700/50 transition-colors" aria-label="Open menu">
                        <div class="w-6 h-6 flex flex-col justify-center items-center space-y-1.5">
                           <span class="block w-5 h-0.5 bg-current transition-transform duration-300 ease-in-out" :class="{ 'rotate-45 translate-y-[5px]': isMobileMenuOpen }"></span>
                           <span class="block w-5 h-0.5 bg-current transition-opacity duration-300 ease-in-out" :class="{ 'opacity-0': isMobileMenuOpen }"></span>
                           <span class="block w-5 h-0.5 bg-current transition-transform duration-300 ease-in-out" :class="{ '-rotate-45 -translate-y-[5px]': isMobileMenuOpen }"></span>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div x-show="isMobileMenuOpen" x-cloak class="lg:hidden fixed inset-0 z-40">
        <!-- Overlay -->
        <div x-show="isMobileMenuOpen"
             x-transition:enter="transition-opacity ease-in-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-in-out duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="closeMobileMenu"
             class="fixed inset-0 bg-black/40 backdrop-blur-sm"></div>

        <!-- Panel -->
        <div x-show="isMobileMenuOpen"
             x-transition:enter="transition ease-in-out duration-300 transform"
             x-transition:enter-start="translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in-out duration-300 transform"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="translate-x-full"
             @swipe-right.window="closeMobileMenu"
             class="relative flex flex-col w-full max-w-xs ml-auto h-full bg-white dark:bg-gray-900 shadow-2xl">

            <!-- Header -->
            <div class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-bold text-gray-800 dark:text-white">Menu</h2>
                <button @click="closeMobileMenu" class="p-2 -mr-2 rounded-full text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <!-- Links -->
            <nav class="flex-1 overflow-y-auto p-4 space-y-2">
                @foreach($navigationItems as $key => $item)
                    @if(!empty($item['children']))
                        <div x-data="{ open: false }">
                            <button @click="open = !open" class="w-full flex items-center justify-between px-3 py-3 text-left font-medium rounded-lg transition-colors group" :class="isActive('{{ $key }}') ? 'bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800'">
                                <span class="flex items-center">
                                    <i class="{{ $item['icon'] }} mr-3 w-5 text-center text-lg text-emerald-500"></i>
                                    {{ $item['label'] }}
                                </span>
                                <i class="fas fa-chevron-down text-sm transition-transform duration-300" :class="{ 'rotate-180': open }"></i>
                            </button>
                            <div x-show="open" x-collapse class="mt-1 pl-6 space-y-1">
                                @foreach($item['children'] as $child)
                                    <a href="{{ route($child['route'], $child['params'] ?? []) }}" @click="closeMobileMenu" wire:navigate class="flex items-center px-3 py-2 text-sm rounded-lg transition-colors" :class="isActive('{{ $child['route'] }}') ? 'text-emerald-600 dark:text-emerald-400' : 'text-gray-600 dark:text-gray-400 hover:text-emerald-600 dark:hover:text-emerald-400'">
                                        <i class="{{ $child['icon'] }} mr-3 w-5 text-center text-sm opacity-80"></i>
                                        {{ $child['label'] }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <a href="{{ route($item['route']) }}" @click="closeMobileMenu" wire:navigate class="flex items-center px-3 py-3 font-medium rounded-lg transition-colors group" :class="isActive('{{ $item['route'] }}') ? 'bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800'">
                            <i class="{{ $item['icon'] }} mr-3 w-5 text-center text-lg text-emerald-500"></i>
                            {{ $item['label'] }}
                        </a>
                    @endif
                @endforeach
            </nav>

            <!-- Footer -->
            <div class="p-4 border-t border-gray-200 dark:border-gray-700 space-y-4">
                 <a href="{{ route('donate') }}" @click="closeMobileMenu" class="w-full flex items-center justify-center px-4 py-3 text-white font-semibold bg-emerald-600 rounded-full shadow-md hover:bg-emerald-700 transform hover:scale-105 transition-all duration-300">
                    <i class="fas fa-heart mr-2"></i>
                    Donate Now
                </a>
                @if($phone || $email)
                <div class="text-center text-xs text-gray-500 dark:text-gray-400 space-y-1">
                    @if($phone)
                        <a href="tel:{{$phone}}" class="hover:text-emerald-600">{{$phone}}</a>
                    @endif
                     @if($phone && $email)<span>&middot;</span>@endif
                    @if($email)
                        <a href="mailto:{{$email}}" class="hover:text-emerald-600">{{$email}}</a>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function navigationMenu(config) {
        return {
            isMobileMenuOpen: config.isMobileMenuOpen,
            darkMode: config.darkMode,
            isScrolled: false,
            isNavVisible: true,
            lastScrollY: 0,
            currentPath: '{{ request()->url() }}',

            init() {
                // Initial scroll check
                this.handleScroll();
                window.addEventListener('scroll', () => this.handleScroll(), { passive: true });

                // Dark mode watcher
                this.$watch('darkMode', val => {
                    document.documentElement.classList.toggle('dark', val);
                });
                // Set initial dark mode state
                document.documentElement.classList.toggle('dark', this.darkMode);

                // Mobile menu watcher for body scroll lock
                this.$watch('isMobileMenuOpen', lock => {
                    document.body.classList.toggle('overflow-hidden', lock);
                });

                // Swipe gesture for mobile menu
                this.initSwipe();
            },

            handleScroll() {
                const currentScrollY = window.scrollY;
                this.isScrolled = currentScrollY > 20;

                if (currentScrollY > this.lastScrollY && currentScrollY > 100) {
                    this.isNavVisible = false; // Scrolling down
                } else {
                    this.isNavVisible = true; // Scrolling up
                }
                this.lastScrollY = currentScrollY;
            },

            toggleMobileMenu() {
                this.isMobileMenuOpen = !this.isMobileMenuOpen;
            },

            closeMobileMenu() {
                this.isMobileMenuOpen = false;
            },

            handleResize() {
                if (window.innerWidth >= 1024) {
                    this.closeMobileMenu();
                }
            },

            isActive(routeOrKey) {
                // This is a simplified check. For more complex routing, you might need a more robust solution.
                const routeUrl = '{{ url('/') }}/' + routeOrKey.replace('.', '/');
                if (this.currentPath.startsWith(routeUrl)) {
                    return true;
                }
                // Check for parent keys
                const items = @json($navigationItems);
                if (items[routeOrKey] && items[routeOrKey].children) {
                    for (const child of items[routeOrKey].children) {
                        const childUrl = '{{ url('/') }}/' + child.route.replace('.', '/');
                        if (this.currentPath.startsWith(childUrl)) return true;
                    }
                }
                return false;
            },

            initSwipe() {
                let startX = 0;
                let startY = 0;
                this.$el.addEventListener('touchstart', e => {
                    startX = e.touches[0].clientX;
                    startY = e.touches[0].clientY;
                });
                this.$el.addEventListener('touchend', e => {
                    const deltaX = e.changedTouches[0].clientX - startX;
                    const deltaY = Math.abs(e.changedTouches[0].clientY - startY);
                    if (deltaX > 80 && deltaY < 100) { // Swipe right
                        this.closeMobileMenu();
                    }
                });
            }
        };
    }
</script>
@endpush
