<div class="relative w-full overflow-x-hidden" wire:ignore x-data="{
    swiper: null,
    init() {
        this.swiper = new Swiper(this.$refs.swiperContainer, {
            loop: true,
            slidesPerView: 1,
            spaceBetween: 20,
            centeredSlides: false,
            pagination: { el: this.$refs.pagination, clickable: true },
            navigation: {
                nextEl: this.$refs.nextButton,
                prevEl: this.$refs.prevButton,
            },
            breakpoints: {
                480: { slidesPerView: 2 },
                768: { slidesPerView: 3 },
                1024: { slidesPerView: 4 }
            }
        });
    }
}">
    <!-- Header with View All button -->
    <div class="flex flex-col items-start justify-between gap-3 px-4 mb-6 sm:flex-row sm:items-center">
        <h2 class="text-xl font-bold sm:text-2xl text-[#008000] dark:text-[#008000]">Find Our Church Near You</h2>
        <a href="{{ route('churches') }}"
            class="inline-flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-white transition-colors rounded-lg bg-[#008000] hover:bg-[#008000] sm:text-base sm:w-auto dark:bg-emerald-500 dark:hover:bg-[#008000]">
            View All
        </a>
    </div>

    <!-- Navigation Buttons -->
    <button x-ref="prevButton"
        class="absolute z-10 p-2.5 -translate-y-1/2 rounded-full shadow-md left-3 top-1/2 bg-white/90 hover:bg-white dark:bg-gray-700/90 dark:hover:bg-gray-600 text-[#008000] dark:text-[#008000]">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
        </svg>
    </button>

    <button x-ref="nextButton"
        class="absolute z-10 p-2.5 -translate-y-1/2 rounded-full shadow-md right-3 top-1/2 bg-white/90 hover:bg-white dark:bg-gray-700/90 dark:hover:bg-gray-600 text-[#008000] dark:text-[#008000]">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
        </svg>
    </button>

    <!-- Swiper Container -->
    <div class="swiper-container max-w-[100vw] px-4" x-ref="swiperContainer">
        <div class="swiper-wrapper">
            @foreach($churches as $church)
            <div class="swiper-slide">
                <div
                    class="h-full overflow-hidden transition-shadow duration-300 bg-white border border-gray-100 shadow-lg rounded-xl dark:bg-gray-800 dark:shadow-gray-900 dark:border-gray-700 hover:shadow-xl">
                    <img src="{{ asset('storage/' . $church['thumbnail']) }}" alt="{{ $church['name'] }}"
                        class="object-cover w-full h-40" loading="lazy"
                        onerror="this.onerror=null;this.src='{{ asset('images/citwam/unsplash.jpg') }}';">

                    <div class="p-4">
                        <h3 class="mb-2 text-lg font-semibold text-[#008000] dark:text-[#008000]">{{ $church['name']
                            }}</h3>
                        <div class="flex items-center mb-2 text-gray-700 dark:text-gray-300">
                            <svg class="w-4 h-4 mr-2 text-[#008000] dark:text-[#008000]" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="text-sm font-medium">{{ $church['address'] }}</span>
                        </div>
                        <div class="flex items-center text-[#008000] dark:text-[#008000]">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span class="text-sm font-medium">{{ $church['phone'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-6 swiper-pagination" x-ref="pagination"></div>
    </div>
</div>
