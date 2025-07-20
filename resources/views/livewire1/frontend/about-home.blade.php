<div class="relative py-16 overflow-hidden bg-white dark:bg-gray-900" x-data="{ showVideo: false }"
    @keydown.escape="showVideo = false" id="about-section">
    <!-- Section Curves -->
    <div class="absolute left-0 w-full -translate-y-1/2 top-full text-[#008000] dark:text-[#008000]">
        <svg viewBox="0 0 1440 62" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 22L1440 0V62H0V22Z" />
        </svg>
    </div>

    <div class="container px-4 mx-auto">
        <div class="grid items-center gap-12 md:grid-cols-2">
            <!-- Left Column -->
            <div class="relative space-y-6">
                <!-- Decorative Elements -->
                <div class="absolute -top-8 -left-8 opacity-10">
                    <svg class="w-24 h-24 text-[#008000] dark:text-[#008000]" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                    </svg>
                </div>

                <h2 class="text-4xl font-bold text-[#008000] drop-shadow-sm dark:text-white">
                    {{ $about->heading ?? 'Growing Together in Faith' }}
                </h2>
                <h3 class="text-2xl font-semibold text-black dark:text-white">
                    {{ $about->subheading ?? 'Our Journey in Christ' }}
                </h3>
                <div class="prose-lg text-gray-800 dark:text-gray-200">
                    {!! $about->content ?? '' !!}
                </div>

                <!-- Interactive Stats -->
                <div class="grid grid-cols-3 gap-4 pt-6">
                    <div
                        class="p-4 text-center bg-white border rounded-lg shadow-sm dark:bg-gray-800 border-emerald-100 dark:border-emerald-800">
                        <div class="text-2xl font-bold text-[#008000] dark:text-[#008000]">25+</div>
                        <div class="text-sm text-[#008000] dark:[#008000]">Years Serving</div>
                    </div>
                    <div
                        class="p-4 text-center bg-white border rounded-lg shadow-sm dark:bg-gray-800 border-emerald-100 dark:border-emerald-800">
                        <div class="text-2xl font-bold text-[#008000] dark:text-[#008000]">2K+</div>
                        <div class="text-sm text-[#008000] dark:[#008000]">Members</div>
                    </div>
                    <div
                        class="p-4 text-center bg-white border rounded-lg shadow-sm dark:bg-gray-800 border-emerald-100 dark:border-emerald-800">
                        <div class="text-2xl font-bold text-[#008000] dark:text-[#008000]">50+</div>
                        <div class="text-sm text-[#008000] dark:[#008000]">Programs</div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="relative group" @mouseenter="$el.classList.add('hovering')"
                @mouseleave="$el.classList.remove('hovering')">
                <div
                    class="relative overflow-hidden rounded-2xl shadow-xl ring-4 ring-[#008000]/20 dark:ring-[#008000]/20 transition-all duration-300 group-[.hovering]:ring-[#008000]/30 dark:group-[.hovering]:ring-[#008000]/30">
                    @if (optional($about)->image_path)
                    <img src="{{ optional($about)->image_url }}" alt="Church community"
                        class="w-full h-auto transition-transform duration-500 group-[.hovering]:scale-105">
                    @endif

                    @if (optional($about)->youtube_url)
                    <div
                        class="absolute inset-0 flex items-center justify-center bg-gradient-to-t from-emerald-900/60 dark:from-gray-900/80 to-transparent">
                        <button @click="showVideo = true"
                            class="flex items-center justify-center w-20 h-20 transition-all transform rounded-full shadow-lg bg-[#008000]/90 dark:bg-[#008000]/80 backdrop-blur-sm hover:scale-110 hover:bg-[#008000] dark:hover:bg-emerald-300">
                            <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z" />
                            </svg>
                            <span class="sr-only">Play Video</span>
                        </button>
                    </div>
                    @endif
                </div>

                <a href="{{ route('about') }}" wire:navigate.click>
                    <div
                        class="absolute bottom-0 right-0 px-4 py-2 m-4 text-sm font-medium bg-white rounded-full shadow dark:bg-gray-800 text-[#008000] dark:[#008000]">
                        Read Our Story ▶
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Video Modal -->
    <div x-show="showVideo" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/90 backdrop-blur-sm" x-cloak
        @click.outside="showVideo = false; $refs.video.src = $refs.video.src.replace('&autoplay=1', '')">
        <div class="relative w-full max-w-4xl mx-4">
            <!-- Close Button -->
            <button @click="showVideo = false; $refs.video.src = $refs.video.src.replace('&autoplay=1', '')"
                class="absolute right-0 z-10 text-white transition-colors -top-8 hover:text-[#008000] dark:hover:[#008000]">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Video Container -->
            <div
                class="relative w-full overflow-hidden border-4 shadow-2xl bg-gradient-to-br from-emerald-100 dark:from-gray-800 to-white dark:to-gray-900 rounded-xl border-[#008000]/20 dark:border-[#008000]/20">
                <div class="relative w-full" style="padding-bottom: 56.25%;">
                    <iframe x-ref="video" src="https://www.youtube.com/embed/{{ optional($about)->youtube_id }}"
                        class="absolute inset-0 w-full h-full"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</div>
