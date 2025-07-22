<div class="relative w-full" wire:ignore x-data="{
    swiper: null,
    init() {
        this.swiper = new Swiper(this.$refs.swiperContainer, {
            loop: true,
            slidesPerView: 1,
            spaceBetween: 10,
            centeredSlides: true,
            pagination: { el: this.$refs.pagination, clickable: true },
            navigation: {
                nextEl: this.$refs.nextButton,
                prevEl: this.$refs.prevButton,
            },
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            breakpoints: {
                320: { slidesPerView: 1, spaceBetween: 10 },
                480: { slidesPerView: 2, spaceBetween: 15 },
                768: { slidesPerView: 3, spaceBetween: 20 },
                1024: { slidesPerView: 4, spaceBetween: 20 }
            }
        });
    }
}">
<!-- Header Section -->
<div class="flex flex-col items-start justify-between gap-4 px-4 mb-8 sm:px-6 sm:flex-row sm:items-center">
    <h2 class="text-2xl font-extrabold tracking-tight sm:text-3xl text-[#008000] dark:text-emerald-300 animate__animated animate__fadeIn">
        Meet our Church leadership
    </h2>

    <div class="flex flex-wrap items-center gap-3 w-full sm:w-auto">
        <a href="{{ route('church.leadership') }}"
            class="w-full sm:w-auto px-6 py-3 text-lg font-semibold text-white transition-all duration-300 bg-[#008000] rounded-full shadow-lg hover:from-emerald-600 hover:to-teal-600 dark:from-emerald-600 dark:to-teal-600 dark:hover:from-emerald-700 dark:hover:to-teal-700 animate__animated animate__fadeInUp text-center">
            View All Team Members
        </a>

        <div class="flex gap-2 w-full sm:w-auto justify-center sm:justify-start">
            <button x-ref="prevButton"
                class="p-3 transition-all duration-300 rounded-full shadow-lg bg-[#008000] dark:from-emerald-600 dark:to-teal-600 dark:hover:from-emerald-700 dark:hover:to-teal-700 text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button x-ref="nextButton"
                class="p-3 transition-all duration-300 rounded-full shadow-lg bg-[#008000] dark:from-emerald-600 dark:to-teal-600 dark:hover:from-emerald-700 dark:hover:to-teal-700 text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>
</div>


    <!-- Swiper Container with Auto Height and Overflow Fix -->
    <div class="box-border w-full px-4 mx-auto overflow-x-hidden swiper-container max-w-7xl" x-ref="swiperContainer">
        <div class="swiper-wrapper">
            @foreach($team as $member)
            <div class="w-auto h-auto swiper-slide">
                <div
                    class="relative flex flex-col items-center max-w-full p-4 overflow-hidden transition-all duration-500 transform border shadow-xl bg-gradient-to-br from-white to-emerald-50 border-emerald-100 rounded-2xl dark:from-gray-800 dark:to-gray-900 dark:border-emerald-900 dark:shadow-emerald-900/20 group hover:shadow-2xl hover:-translate-y-2 sm:p-6">
                    <!-- Profile Image with Aspect Ratio -->
                    <div class="relative w-full pb-[100%] overflow-hidden rounded-t-2xl max-w-full">
                        <img src="{{ $member['profile_image'] ? asset('storage/' . $member['profile_image']) : asset('images/default-profile.jpg') }}" 
                            alt="{{ $member['name'] }}"  onerror="this.onerror=null;this.src='{{ asset('images/citwam/avatar.jpeg') }}';"
                            class="absolute inset-0 object-cover w-full h-full transition-transform duration-500 group-hover:scale-110">
                        <div
                            class="absolute inset-0 transition-opacity duration-500 opacity-0 bg-emerald-500/30 group-hover:opacity-100">
                        </div>
                    </div>
                    <!-- Name, Role and Location -->
                    <div class="w-full p-4 text-center">
                        <h3 class="text-xl font-semibold text-[#008000]">
                            {{ $member['name'] }}
                        </h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $member['role'] }}</p>
                        @if($member['location'])
                        <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">
                            <span class="inline-flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{ $member['location'] }}
                            </span>
                        </p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!-- Custom Pagination -->
        <div class="mt-8 swiper-pagination" x-ref="pagination"></div>
    </div>
</div>