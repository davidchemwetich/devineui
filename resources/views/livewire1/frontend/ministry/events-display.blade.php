<div class="py-12 pt-24 bg-gradient-to-b from-emerald-50 to-white dark:from-gray-800 dark:to-gray-900"
    x-data="{ show: false }" x-intersect:enter="show = true">
    <!-- Hero Section -->
    <div class="relative py-20 bg-[#008000]">
        <div class="absolute inset-0 opacity-20 bg-pattern-overlay"></div>
        <div class="container relative z-10 px-4 mx-auto">
            <div class="max-w-3xl mx-auto text-center" x-data="{ loaded: false }"
                x-init="setTimeout(() => loaded = true, 100)" x-transition:enter.duration.500ms>
                <h1 class="text-4xl font-bold leading-tight text-white transition-all duration-500 transform md:text-5xl"
                    :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                    ✞ Ministry Events
                </h1>
                <p class="mt-4 text-xl font-light text-[#ffffff] opacity-90">
                    Grow in faith with our upcoming gatherings amidst God's creation
                </p>
            </div>
        </div>
    </div>
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <!-- Glass-morphism Filters -->
        <div class="p-6 mb-8 transition-all duration-300 border shadow-lg backdrop-blur-lg bg-white/80 dark:bg-gray-800/80 rounded-2xl border-white/20 hover:shadow-xl"
            x-transition>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                <!-- Ministry Filter -->
                <div>
                    <label class="block text-sm font-medium text-[#008000] dark:text-[#008000] mb-1">Ministry</label>
                    <div class="relative">
                        <select
                            class="w-full py-2 pl-4 pr-8 transition-all duration-200 border appearance-none rounded-xl border-[#008000] dark:border-gray-600 bg-white/50 dark:bg-gray-700/50 focus:ring-2 focus:ring-[#008000] focus:border-emerald-400 dark:focus:ring-[#008000] text-emerald-800 dark:text-emerald-100">
                            <option value="">All Ministries</option>
                            <!-- Options -->
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <svg class="w-5 h-5 text-[#008000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Search Filter -->
                <div>
                    <label class="block text-sm font-medium text-[#008000] dark:text-[#008000] mb-1">Search</label>
                    <div class="relative">
                        <input type="text"
                            class="w-full py-2 pl-10 pr-4 border rounded-xl border-[#008000] dark:border-gray-600 bg-white/50 dark:bg-gray-700/50 focus:ring-2 focus:ring-[#008000] focus:border-emerald-400 dark:focus:ring-[#008000] text-[#008000] dark:text-emerald-100 placeholder-[#008000]"
                            placeholder="Find events...">
                        <div class="absolute -translate-y-1/2 left-3 top-1/2">
                            <svg class="w-5 h-5 text-[#008000]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Time Filter -->
                <div>
                    <label class="block text-sm font-medium text-[#008000] dark:text-[#008000] mb-1">Time
                        Frame</label>
                    <div class="relative">
                        <select
                            class="w-full py-2 pl-4 pr-8 border appearance-none rounded-xl border-[#008000] dark:border-gray-600 bg-white/50 dark:bg-gray-700/50 focus:ring-2 focus:ring-[#008000] focus:border-emerald-400 dark:focus:ring-[#008000] text-emerald-800 dark:text-emerald-100">
                            <!-- Options -->
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Events Grid with Alpine stagger -->
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3" x-data="{
                 init() {
                     this.$el.querySelectorAll('.event-card').forEach((el, index) => {
                         el.style.transform = 'translateY(20px)';
                         el.style.opacity = '0';
                         setTimeout(() => {
                             el.classList.add('transition-all', 'duration-500', 'ease-out');
                             el.style.transform = 'translateY(0)';
                             el.style.opacity = '1';
                         }, index * 150);
                     });
                 }
             }">
            @foreach($events as $event)
            <div
                class="p-6 transition-all duration-300 transform border shadow-lg opacity-0 cursor-pointer event-card bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl border-emerald-100 dark:border-gray-700 hover:border-[#008000] dark:hover:border-emerald-700 hover:-translate-y-2 group">
                <div class="flex items-start justify-between mb-4">
                    <h2
                        class="text-xl font-bold transition-colors text-[#008000] dark:text-[#008000] group-hover:text-[#008000]">
                        {{ $event->title }}
                    </h2>
                    <span
                        class="px-3 py-1 text-sm rounded-full bg-emerald-100/50 dark:bg-emerald-900/50 text-[#008000] dark:text-[#008000]">
                        {{ $event->ministry->name }}
                    </span>
                </div>
                <p class="mb-4 italic font-light text-gray-600 dark:text-emerald-100">
                    "{{ Str::limit($event->description, 100) }}"
                </p>
                <div class="pt-4 space-y-2 border-t border-emerald-50 dark:border-gray-700">
                    <div class="flex items-center text-[#008000] dark:text-[#008000]">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="font-medium">{{ $event->event_date->format('F j, Y, g:i a') }}</span>
                    </div>
                    <div class="flex items-center text-[#008000] dark:text-[#008000]">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="font-medium">{{ $event->location }}</span>
                        <a href="{{ $event->location_url }}"
                            class="relative p-2 ml-2 transition-colors rounded-full bg-emerald-50/50 dark:bg-emerald-900/20 hover:bg-emerald-100/70 dark:hover:bg-emerald-900/40"
                            x-data="{ showTooltip: false }" @mouseover="showTooltip = true"
                            @mouseleave="showTooltip = false">
                            <svg class="w-5 h-5 text-[#008000] dark:text-emerald-400 hover:text-[#008000] dark:hover:text-[#008000] transition-colors"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                            </svg>
                            <!-- Tooltip -->
                            <div x-show="showTooltip" x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 translate-y-1"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 translate-y-1"
                                class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 px-2 py-1 text-sm text-whitebg-[#008000] rounded-lg shadow-lg">
                                View Map
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="flex justify-center mt-8 space-x-2">
            {{ $events->links() }}
        </div>
    </div>
</div>
