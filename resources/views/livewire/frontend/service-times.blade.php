<div x-data="{
        isDown: false,
        startX: 0,
        scrollLeft: 0,
        init() {
            const slider = this.$refs.slider

            // Mouse drag scroll
            slider.addEventListener('mousedown', (e) => {
                this.isDown = true
                slider.classList.add('cursor-grabbing')
                this.startX = e.pageX - slider.offsetLeft
                this.scrollLeft = slider.scrollLeft
            })
            slider.addEventListener('mouseleave', () => {
                this.isDown = false
                slider.classList.remove('cursor-grabbing')
            })
            slider.addEventListener('mouseup', () => {
                this.isDown = false
                slider.classList.remove('cursor-grabbing')
            })
            slider.addEventListener('mousemove', (e) => {
                if (!this.isDown) return
                e.preventDefault()
                const x = e.pageX - slider.offsetLeft
                const walk = (x - this.startX) * 2
                slider.scrollLeft = this.scrollLeft - walk
            })

            // Auto scroll
            setInterval(() => {
                if (!this.isDown) {
                    slider.scrollBy({ left: 200, behavior: 'smooth' });

                    // Loop back to start if reached end
                    if (slider.scrollLeft + slider.clientWidth >= slider.scrollWidth - 5) {
                        slider.scrollTo({ left: 0, behavior: 'smooth' });
                    }
                }
            }, 3000); // Adjust speed (ms)
        }
    }" x-init="init" class="px-4 py-10 bg-white select-none">
    <!-- Header -->
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-[#008000] sm:text-3xl">🕊️ Weekly Services</h2>
        <p class="text-sm text-gray-500 sm:text-base">Auto scrolling... drag to pause</p>
    </div>

    <!-- Swiper container -->
    <div x-ref="slider" class="flex pb-4 space-x-4 overflow-x-auto cursor-grab scroll-smooth"
        style="-ms-overflow-style: none; scrollbar-width: none;">
        <style>
            [x-ref="slider"]::-webkit-scrollbar {
                display: none;
            }
        </style>

        @foreach ($services as $service)
        <div class="min-w-[16rem] max-w-xs bg-gray-50 rounded-xl shadow flex-shrink-0" x-data="{ open: false }">
            <!-- Card Header -->
            <div class="flex items-center justify-between bg-[#008000] text-white px-4 py-3 rounded-t-xl">
                <div class="flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 8c1.657 0 3 1.343 3 3v1h3a2 2 0 012 2v3H6v-3a2 2 0 012-2h3v-1c0-1.657 1.343-3 3-3z" />
                    </svg>
                    <span class="font-semibold">{{ $service->day }}</span>
                </div>
                <button @click="open = !open" class="focus:outline-none">
                    <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 12h16" />
                    </svg>
                </button>
            </div>

            <!-- Card Body -->
            <div x-show="open" x-transition class="p-4 space-y-2 text-sm text-gray-700">
                @foreach ($service->times as $time)
                <div class="border-l-4 border-[#008000] pl-2">
                    <p><strong>{{ $time->time }}</strong> – {{ $time->name }} ({{ $time->language }})</p>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach

    </div>
    <!-- Announcements Section -->
    <div class="p-6 rounded-lg bg-gray-">
        <livewire:announcements-list />
    </div>
</div>
