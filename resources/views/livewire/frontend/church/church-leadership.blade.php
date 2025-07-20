<div>
    <!-- Hero Section -->
    <div class="relative py-20 bg-[#008000]">
        <div class="absolute inset-0 opacity-20 bg-pattern-overlay"></div>
        <div class="container relative z-10 px-4 mx-auto">
            <div class="max-w-3xl mx-auto text-center" x-data="{ loaded: false }"
                x-init="setTimeout(() => loaded = true, 100)" x-transition:enter.duration.500ms>
                <h1 class="text-4xl font-bold leading-tight text-white transition-all duration-500 transform md:text-5xl"
                    :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                    Our Leadership
                </h1>
                <p class="mt-4 text-xl font-light text-[#ffffff] opacity-90">
                    Meet the dedicated leaders who guide Christ Is the Way Ministries with vision and wisdom
                </p>
            </div>
        </div>
    </div>
    <div class="container px-4 py-12 mx-auto mt-16">
        <!-- Featured Category Section -->
        @if($featuredCategory)
        <div class="mb-16">
            <h2 class="mb-8 text-3xl font-semibold text-center text-gray-700">{{ $featuredCategory->name }}</h2>

            <div class="flex justify-center">
                @foreach($featuredCategory->teamMembers as $member)
                @if($member->status)
                <div
                    class="relative w-full max-w-md overflow-hidden transition-transform duration-300 bg-white shadow-lg rounded-xl hover:shadow-2xl hover:scale-105">
                    <!-- Image -->
                    <div class="relative overflow-hidden aspect-w-4 aspect-h-3">
                        <img src="{{ $member->getProfileImageUrlAttribute() }}" alt="{{ $member->name }}"
                            class="object-cover w-full h-full">
                        <!-- Social Icons (Top Right) -->
                        <div class="absolute top-0 right-0 flex flex-col gap-2 p-2">
                            @if($member->email)
                            <a href="mailto:{{ $member->email }}"
                                class="p-2 transition-colors bg-white rounded-full shadow-md hover:bg-blue-100"
                                title="{{ $member->email }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </a>
                            @endif
                            @if($member->phone)
                            <a href="tel:{{ $member->phone }}"
                                class="p-2 transition-colors bg-white rounded-full shadow-md hover:bg-blue-100"
                                title="{{ $member->phone }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </a>
                            @endif
                            @if($member->whatsapp)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $member->whatsapp) }}"
                                target="_blank"
                                class="p-2 transition-colors bg-white rounded-full shadow-md hover:bg-green-100"
                                title="WhatsApp">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.345.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                                </svg>
                            </a>
                            @endif
                            @if($member->facebook_url)
                            <a href="{{ $member->facebook_url }}" target="_blank"
                                class="p-2 transition-colors bg-white rounded-full shadow-md hover:bg-blue-100"
                                title="Facebook">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-800"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
                                </svg>
                            </a>
                            @endif
                        </div>
                    </div>
                    <!-- Member Details -->
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800">{{ $member->name }}</h3>
                        <p class="mt-1 font-medium text-gray-600">{{ $member->role }}</p>
                        @if($member->location)
                        <p class="flex items-center mt-2 text-sm text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            {{ $member->location }}
                        </p>
                        @endif
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
        @endif

        <!-- Other Categories Section with Alpine.js Tabs -->
        <div x-data="{ activeTab: {{ $activeCategory }} }">
            <!-- Category Tabs -->
            <div class="flex flex-wrap justify-center gap-3 mb-8">
                @foreach($categories->where('is_featured', false) as $category)
                <button @click="activeTab = {{ $category->id }}" wire:click="setActiveCategory({{ $category->id }})"
                    :class="{ 'bg-blue-600 text-white': activeTab === {{ $category->id }}, 'bg-gray-200 text-gray-800 hover:bg-gray-300': activeTab !== {{ $category->id }} }"
                    class="px-6 py-3 font-medium transition-colors duration-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    {{ $category->name }}
                </button>
                @endforeach
            </div>

            <!-- Team Members by Category -->
            @foreach($categories->where('is_featured', false) as $category)
            <div x-show="activeTab === {{ $category->id }}" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100">
                <h2 class="mb-8 text-2xl font-semibold text-center text-gray-700">{{ $category->name }}</h2>

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    @foreach($category->teamMembers as $member)
                    @if($member->status)
                    <div
                        class="relative overflow-hidden transition-all duration-300 bg-white shadow-md rounded-xl hover:shadow-lg">
                        <!-- Image -->
                        <div class="relative overflow-hidden aspect-w-4 aspect-h-3">
                            <img src="{{ $member->getProfileImageUrlAttribute() }}" alt="{{ $member->name }}"
                                class="object-cover w-full h-full">
                            <!-- Social Icons (Top Right) -->
                            <div class="absolute top-0 right-0 flex flex-col gap-2 p-2">
                                @if($member->email)
                                <a href="mailto:{{ $member->email }}"
                                    class="p-2 transition-colors bg-white rounded-full shadow-md hover:bg-blue-100"
                                    title="{{ $member->email }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </a>
                                @endif
                                @if($member->phone)
                                <a href="tel:{{ $member->phone }}"
                                    class="p-2 transition-colors bg-white rounded-full shadow-md hover:bg-blue-100"
                                    title="{{ $member->phone }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </a>
                                @endif
                                @if($member->whatsapp)
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $member->whatsapp) }}"
                                    target="_blank"
                                    class="p-2 transition-colors bg-white rounded-full shadow-md hover:bg-green-100"
                                    title="WhatsApp">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.345.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                                    </svg>
                                </a>
                                @endif
                                @if($member->facebook_url)
                                <a href="{{ $member->facebook_url }}" target="_blank"
                                    class="p-2 transition-colors bg-white rounded-full shadow-md hover:bg-blue-100"
                                    title="Facebook">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-800"
                                        fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
                                    </svg>
                                </a>
                                @endif
                            </div>
                        </div>
                        <!-- Member Details -->
                        <div class="p-4">
                            <h3 class="text-lg font-bold text-gray-800">{{ $member->name }}</h3>
                            <p class="mt-1 font-medium text-gray-600">{{ $member->role }}</p>
                            @if($member->location)
                            <p class="flex items-center mt-2 text-sm text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{ $member->location }}
                            </p>
                            @endif
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
