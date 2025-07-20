<div 
    x-data="{ 
        scrollPosition: 0,
        scrollWidth: 0,
        containerWidth: 0,
        handleScroll() {
            this.scrollPosition += 1;
            if (this.scrollPosition >= this.scrollWidth - this.containerWidth) {
                this.scrollPosition = 0;
            }
            this.$refs.scrollContainer.scrollLeft = this.scrollPosition;
        },
        init() {
            this.scrollWidth = this.$refs.scrollContent.scrollWidth;
            this.containerWidth = this.$refs.scrollContainer.clientWidth;
            setInterval(() => this.handleScroll(), 20);
        }
    }"
    class="relative w-full overflow-hidden bg-gradient-to-r from-indigo-50 via-white to-indigo-50 py-8 shadow-inner"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-extrabold text-gray-800 text-center mb-6">Partnerships & Collaborations</h2>
        <div class="text-center">
            <p class="max-w-md mx-auto mt-2 text-gray-500">
                At Satech Institution, we build partnerships with local businesses and organizations to enhance learning and provide real-world opportunities for our students.
            </p>
        </div>
        <div 
            x-ref="scrollContainer"
            class="flex overflow-hidden relative"
            style="scroll-behavior: smooth;"
        >
            <div 
                x-ref="scrollContent"
                class="flex space-x-8 py-4 animate-scroll whitespace-nowrap"
            >
                @foreach ($partnerships as $partnership)
                    <a 
                        href="{{ $partnership->url }}" 
                        target="_blank" 
                        rel="noopener"
                        class="inline-block transition-transform duration-300 hover:scale-110 hover:shadow-lg rounded-xl p-4 bg-white"
                    >
                        <img 
                            src="{{ asset('storage/' . $partnership->logo) }}" 
                            alt="{{ $partnership->name }}" 
                            class="h-16 sm:h-20 w-auto object-contain"
                        />
                    </a>
                @endforeach
                
                {{-- Duplicate logos for seamless scrolling --}}
                @foreach ($partnerships as $partnership)
                    <a 
                        href="{{ $partnership->url }}" 
                        target="_blank" 
                        rel="noopener"
                        class="inline-block transition-transform duration-300 hover:scale-110 hover:shadow-lg rounded-xl p-4 bg-white"
                    >
                        <img 
                            src="{{ asset('storage/' . $partnership->logo) }}" 
                            alt="{{ $partnership->name }}" 
                            class="h-16 sm:h-20 w-auto object-contain"
                        />
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>