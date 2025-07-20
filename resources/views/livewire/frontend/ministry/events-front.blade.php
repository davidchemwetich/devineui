<div>
    <div x-data="{
        swiper: null,
        initSwiper() {
            // Initialize Swiper when Alpine.js initializes the element
            this.$nextTick(() => {
                this.swiper = new Swiper(this.$refs.swiperContainer, {
                    slidesPerView: 'auto',
                    spaceBetween: 24,
                    grabCursor: true,
                    keyboard: {
                        enabled: true,
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    }
                });
            });
        }
    }" x-init="initSwiper()" class="relative py-8 bg-emerald-50 dark:bg-gray-900">
        <div class="text-center px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-[#008000] dark:text-emerald-100 uppercase">Calendar</h2>
            <p class="max-w-2xl mx-auto mt-4 text-lg text-black dark:text-emerald-100">
                Join us for our upcoming events and be part of our community.
            </p>
        </div>

        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8 mt-10">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-6">
                <h2 class="text-2xl font-bold text-black dark:text-emerald-100">Upcoming Events</h2>
                <a href="{{ route('frontend.ministry.events') }}"
                    class="w-full sm:w-auto px-4 py-2 bg-[#000FFF] hover:bg-[#2563eb] text-white rounded-lg transition text-center">
                    View All Events
                </a>
            </div>

            <!-- Swiper Container -->
            <div class="relative">
                <!-- Swiper -->
                <div class="swiper" x-ref="swiperContainer">
                    <div class="swiper-wrapper">
                        @foreach($events as $event)
                        <div class="swiper-slide" style="width: 320px;">
                            <div class="h-full p-6 bg-white shadow-lg dark:bg-gray-800 rounded-xl">
                                <div class="flex items-start justify-between mb-4">
                                    <h3 class="text-lg font-bold text-[#008000] dark:text-emerald-200">
                                        {{ $event->title }}
                                    </h3>

                                    <span
                                        class="inline-flex items-center justify-center rounded-full bg-emerald-100 px-2.5 py-0.5 text-[#008000] dark:bg-[#008000] dark:text-emerald-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="-ms-1 me-1.5 size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>

                                        <p class="text-sm whitespace-nowrap"> {{ $event->ministry->name }}</p>
                                    </span>

                                </div>
                                <p class="mb-4 text-gray-600 dark:text-emerald-100 line-clamp-3">
                                    {{ Str::limit($event->description, 100) }}
                                </p>
                                <div class="pt-4 space-y-2 border-t border-emerald-50 dark:border-gray-700">
                                    <div class="flex items-center text-[#008000] dark:text-emerald-300">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span class="font-medium">{{ $event->event_date->format('F j, Y, g:i a')
                                            }}</span>
                                    </div>
                                    <div class="flex items-center text-[#008000] dark:text-emerald-300">
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
                                            <svg class="w-5 h-5 transition-colors text-emerald-600 dark:text-emerald-400 hover:text-[#008000] dark:hover:text-emerald-300"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                            </svg>
                                            <!-- Tooltip -->
                                            <div x-show="showTooltip"
                                                x-transition:enter="transition ease-out duration-200"
                                                x-transition:enter-start="opacity-0 translate-y-1"
                                                x-transition:enter-end="opacity-100 translate-y-0"
                                                x-transition:leave="transition ease-in duration-150"
                                                x-transition:leave-start="opacity-100 translate-y-0"
                                                x-transition:leave-end="opacity-0 translate-y-1"
                                                class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 px-2 py-1 text-sm text-white bg-[#008000] rounded-lg shadow-lg">
                                                View Map
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Navigation buttons with Tailwind styling -->

                    <!-- Pagination dots -->
                    <div class="swiper-pagination !bottom-0 !-mb-10"></div>
                </div>
            </div>
        </div>
    </div>

    @pushOnce('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // This section is for when Alpine.js is not handling the initialization
            // It provides a fallback initialization method
            if (typeof Swiper !== 'undefined' && !window.Alpine) {
                new Swiper('.swiper', {
                    slidesPerView: 'auto',
                    spaceBetween: 24,
                    grabCursor: true,
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    }
                });
            }
        });
    </script>
    @endPushOnce

</div>
