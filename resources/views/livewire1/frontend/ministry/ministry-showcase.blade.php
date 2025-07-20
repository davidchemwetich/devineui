<div>
    <!-- Hero Section -->
    <div class="relative py-20 bg-[#008000]">
        <div class="absolute inset-0 opacity-20 bg-pattern-overlay"></div>
        <div class="container relative z-10 px-4 mx-auto">
            <div class="max-w-3xl mx-auto text-center" x-data="{ loaded: false }"
                x-init="setTimeout(() => loaded = true, 100)" x-transition:enter.duration.500ms>
                <h1 class="text-4xl font-bold leading-tight text-white transition-all duration-500 transform md:text-5xl"
                    :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                    Join Our Ministry Community
                </h1>
                <p class="mt-4 text-xl font-light text-[#ffffff] opacity-90">
                    Discover where your gifts can make an impact
                </p>
                <div class="mt-8">
                    <a href="#ministries"
                        class="px-8 py-3 text-[#008000] bg-white rounded-full font-medium transition-all shadow-lg hover:shadow-xl hover:transform hover:-translate-y-1">
                        Explore Ministries
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filter Bar -->
    <div class="sticky top-0 z-20 border-b border-[#008000]/20 bg-white shadow-md">
        <div class="container px-4 py-4 mx-auto">
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div class="relative flex-grow max-w-2xl" x-data>
                    <input wire:model.live.debounce.300ms="searchTerm" type="text" placeholder="Search ministries..."
                        class="w-full px-6 py-3 pl-12 transition-all duration-300 border-2 border-[#008000]/30 rounded-full focus:ring-2 focus:ring-[#008000] focus:border-[#008000] bg-white placeholder-[#008000]/50 text-gray-800 focus:outline-none">
                    <div class="absolute left-4 top-3 text-[#008000]/70">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>

                <div class="flex items-center space-x-3">
                    <button
                        class="flex items-center justify-center px-4 py-2 text-sm font-medium text-[#008000] bg-[#008000]/10 rounded-full hover:bg-[#008000]/20 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4  0 0 1-1-1v-2.586a1 1 0 01.293-.707L21 6.586V4H4v2.586l6.414 6.414a1 1 0 00.707.293H17a1 1 0 011 1v2.586a1 1 0 01-1 1h-2.586a1 1 0 00-.707.293L4 20.586V22h16v-2.586l-6.414-6.414a1 1 0 00-.707-.293H7a1 1 0 01-1-1V8.414L3 4z" />
                        </svg>
                        Filter
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Ministries Grid -->
    <div class="container px-4 py-12 mx-auto">
        <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
            @foreach($ministries as $ministry)
            <div x-data="{ hover: false }"
                class="relative overflow-hidden transition-shadow duration-300 bg-white shadow-lg group rounded-2xl hover:shadow-xl"
                x-bind:class="{ 'shadow-[#008000]/40': hover }">
                <div class="relative overflow-hidden">
                    <img src="{{ $ministry->primary_image_url }}" alt="{{ $ministry->name }}"
                        class="object-cover w-full transition-transform duration-500 transform h-52"
                        :class="hover ? 'scale-105' : ''">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#008000]/50 to-[#000fff]/20"></div>
                    <h3 class="absolute text-2xl font-semibold text-white bottom-4 left-4 drop-shadow-lg">
                        {{ $ministry->name }}
                    </h3>
                </div>
                <div class="p-6 bg-white/95">
                    <p class="mb-4 font-light leading-relaxed text-black">
                        {{ Str::limit($ministry->description, 120) }}
                    </p>
                    <button wire:click="viewMinistry({{ $ministry->id }})"
                        class="flex items-center font-medium transition-colors text-[#008000] hover:text-[#000fff]"
                        x-bind:class="{ 'text-[#000fff]': hover }">
                        Discover More
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </button>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="px-4 mt-12">
            {{ $ministries->links() }}
        </div>
    </div>
</div>
