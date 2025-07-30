<!-- Hero Section with Nature Theme -->
<div class="pt-20 dark:bg-gradient-to-b dark:from-gray-800 dark:to-gray-900">
    @if($heroSlides->count() > 0)
    <div x-data="{
        activeSlide: 0,
        slides: @js($heroSlides->map(function($slide) {
            return [
                'media_type' => $slide->media_type,
                'media_url' => $slide->media_url,
                'title' => $slide->title ?: 'Christ the Way Ministries',
                'subtitle' => 'Christ is the Way',
                'verse' => 'Jesus answered, \'I am the way and the truth and the life. No one comes to the Father except through me\'',
                'buttonClass' => 'bg-emerald-600 hover:bg-emerald-700',
                'verseReference' => '— John 14:6'
            ];
        })->values()),
        loop() {
            if (this.slides.length > 1) {
                setInterval(() => {
                    this.activeSlide = (this.activeSlide + 1) % this.slides.length
                }, 8000);
            }
        }
    }" x-init="loop()" class="relative overflow-hidden">

        <!-- Carousel Container -->
        <div class="relative h-[70vh] md:h-[85vh] w-full overflow-hidden shadow-xl">
            <template x-for="(slide, index) in slides" :key="index">
                <div x-show="activeSlide === index" x-transition:enter="transition ease-out duration-1000"
                    x-transition:enter-start="opacity-0 scale-105" x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-700"
                    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                    class="absolute inset-0">

                    <!-- Nature Image/Video with Overlay -->
                    <div class="absolute inset-0 z-10 bg-gradient-to-br from-emerald-900/40 to-lime-900/30"></div>

                    <!-- Image Media -->
                    <template x-if="slide.media_type === 'image'">
                        <img :src="slide.media_url" :alt="slide.title"
                            class="object-cover w-full h-full transform motion-safe:scale-100">
                    </template>

                    <!-- Video Media -->
                    <template x-if="slide.media_type === 'video'">
                        <video :src="slide.media_url" class="object-cover w-full h-full transform motion-safe:scale-100"
                            autoplay muted loop playsinline>
                        </video>
                    </template>

                    <!-- Content Overlay -->
                    <div class="absolute inset-0 z-20 flex flex-col items-center justify-center px-4 text-center">
                        <div class="max-w-4xl space-y-6 animate-fade-in-up">
                            <h1
                                class="text-3xl font-black text-white uppercase sm:text-4xl md:text-5xl font-display drop-shadow-2xl">
                                <span class="text-[#008000]"></span><br class="md:hidden">
                                <span class="text-[#008000]" x-text="slide.title"></span>
                            </h1>

                            <!-- Fancy Verse Card -->
                            <div
                                class="relative inline-block w-full max-w-xs p-4 mx-auto text-left transition-all transform shadow-2xl sm:p-6 md:p-8 bg-white/90 backdrop-blur-sm rounded-xl md:rounded-2xl sm:max-w-sm md:max-w-md hover:scale-105 hover:rotate-1">
                                <div
                                    class="absolute p-2 md:p-3 rounded-full shadow-lg -top-3 -left-3 md:-top-4 md:-left-4 bg-[#008000]">
                                    <svg class="w-6 h-6 text-white md:w-8 md:h-8" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <p x-text="slide.subtitle"
                                    class="mb-1 text-md font-bold sm:text-xl md:text-xl text-[#008000]"></p>
                                <div class="relative pl-6 md:pl-10">
                                    <div class="absolute top-0 left-0 text-2xl md:text-4xl text-[#008000]">"</div>
                                    <p x-text="slide.verse"
                                        class="font-serif text-sm italic text-gray-700 sm:text-base md:text-lg"></p>
                                    <div class="absolute bottom-0 right-0 text-2xl md:text-4xl text-[#008000]">"</div>
                                </div>
                                <p x-text="slide.verseReference"
                                    class="mt-2 md:mt-4 text-sm md:text-base font-semibold text-right text-[#008000]">
                                </p>
                            </div>

                            <!-- Action Buttons -->
                            <div
                                class="flex flex-col items-center justify-center w-full mt-12 space-y-4 sm:flex-row sm:space-y-0 sm:space-x-4 animate-slide-up">

                                <!-- Donate Button -->
                                <a href="{{ route('donate') }}" :class="slide.buttonClass"
                                    class="inline-flex items-center justify-center w-full px-4 py-3 text-base font-semibold text-white transition-all transform bg-[#008000] rounded-lg shadow-lg sm:w-auto sm:px-6 md:px-8 md:py-4 md:text-lg hover:bg-[#008000] hover:scale-105 focus:outline-none focus:ring-4 focus:ring-[#008000] dark:bg-[#008000] dark:hover:[#008000] dark:focus:ring-green-800">
                                    <svg class="w-5 h-5 mr-2 md:w-6 md:h-6" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3zM12 4v1M12 19v1M4.22 5.64l.7.7M19.07 5.64l-.7.7M4.92 17.66l.7-.7M19.08 17.66l-.7-.7M22 12h-1M3 12h1" />
                                    </svg>
                                    Donate
                                </a>

                                <!-- Watch Sermons Button -->
                                <a href="{{ route('sermons') }}"
                                    class="inline-flex items-center justify-center w-full px-4 py-3 text-base font-semibold text-white transition-all transform border-2 border-white rounded-lg sm:w-auto sm:px-6 md:px-8 md:py-4 md:text-lg hover:scale-105 hover:text-emerald-900 dark:text-gray-200 dark:border-gray-200 dark:hover:text-[#008000]">
                                    Watch Sermons
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </template>

            <!-- Progress Indicators (will only show if more than 1 slide) -->
            <div class="absolute left-0 right-0 bottom-8" x-show="slides.length > 1">
                <div class="flex justify-center space-x-3">
                    <template x-for="(slide, index) in slides" :key="index">
                        <button @click="activeSlide = index"
                            class="relative w-24 h-2 overflow-hidden rounded-full bg-white/20">
                            <div :class="{ 'animate-progress': activeSlide === index }"
                                class="absolute inset-0 origin-left bg-white" x-show="activeSlide === index"
                                x-transition:enter="transition-opacity duration-300"
                                x-transition:leave="transition-opacity duration-300">
                            </div>
                        </button>
                    </template>
                </div>
            </div>

        </div>
    </div>
    @else
    <!-- Fallback content when no slides are available -->
    <div
        class="relative h-[70vh] md:h-[85vh] w-full overflow-hidden shadow-xl bg-gradient-to-br from-emerald-900 to-lime-900">
        <div class="absolute inset-0 flex flex-col items-center justify-center px-4 text-center">
            <div class="max-w-4xl space-y-6">
                <h1
                    class="text-3xl font-black text-white uppercase sm:text-4xl md:text-5xl font-display drop-shadow-2xl">
                    <span class="text-[#008000]"></span><br class="md:hidden">
                    <span class="text-[#008000]">Christ the Way Ministries</span>
                </h1>

                <!-- Fancy Verse Card -->
                <div
                    class="relative inline-block w-full max-w-xs p-4 mx-auto text-left transition-all transform shadow-2xl sm:p-6 md:p-8 bg-white/90 backdrop-blur-sm rounded-xl md:rounded-2xl sm:max-w-sm md:max-w-md">
                    <div
                        class="absolute p-2 md:p-3 rounded-full shadow-lg -top-3 -left-3 md:-top-4 md:-left-4 bg-[#008000]">
                        <svg class="w-6 h-6 text-white md:w-8 md:h-8" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <p class="mb-1 text-md font-bold sm:text-xl md:text-xl text-[#008000]">Christ is the Way</p>
                    <div class="relative pl-6 md:pl-10">
                        <div class="absolute top-0 left-0 text-2xl md:text-4xl text-[#008000]">"</div>
                        <p class="font-serif text-sm italic text-gray-700 sm:text-base md:text-lg">Jesus answered, 'I am
                            the way and the truth and the life. No one comes to the Father except through me'</p>
                        <div class="absolute bottom-0 right-0 text-2xl md:text-4xl text-[#008000]">"</div>
                    </div>
                    <p class="mt-2 md:mt-4 text-sm md:text-base font-semibold text-right text-[#008000]">— John 14:6</p>
                </div>

                <!-- Action Buttons -->
                <div
                    class="flex flex-col items-center justify-center w-full mt-12 space-y-4 sm:flex-row sm:space-y-0 sm:space-x-4">
                    <a href="{{ route('donate') }}"
                        class="inline-flex items-center justify-center w-full px-4 py-3 text-base font-semibold text-white transition-all transform bg-[#008000] rounded-lg shadow-lg sm:w-auto sm:px-6 md:px-8 md:py-4 md:text-lg hover:bg-[#008000] hover:scale-105 focus:outline-none focus:ring-4 focus:ring-[#008000]">
                        <svg class="w-5 h-5 mr-2 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3zM12 4v1M12 19v1M4.22 5.64l.7.7M19.07 5.64l-.7.7M4.92 17.66l.7-.7M19.08 17.66l-.7-.7M22 12h-1M3 12h1" />
                        </svg>
                        Donate
                    </a>
                    <a href="{{ route('sermons') }}"
                        class="inline-flex items-center justify-center w-full px-4 py-3 text-base font-semibold text-white transition-all transform border-2 border-white rounded-lg sm:w-auto sm:px-6 md:px-8 md:py-4 md:text-lg hover:scale-105 hover:text-emerald-900">
                        Watch Sermons
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
