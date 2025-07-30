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
        @if($featuredCategory)
        <div class="mb-16">
            <h2 class="mb-8 text-3xl font-semibold text-center text-gray-700">{{ $featuredCategory->name }}</h2>

            <div class="flex flex-wrap justify-center gap-8">
                @foreach($featuredCategory->teamMembers as $member)
                @if($member->status)
                <div
                    class="relative w-full max-w-md overflow-hidden transition-transform duration-300 bg-white shadow-lg rounded-xl hover:shadow-2xl hover:scale-105">
                    <div class="relative overflow-hidden bg-gray-100 rounded-lg" style="aspect-ratio: 4 / 3;">
                        <img src="{{ $member->getProfileImageUrlAttribute() }}" alt="{{ $member->name }}"
                            onerror="this.onerror=null;this.src='{{ asset('images/citwam/avatar.jpeg') }}';"
                            class="object-cover w-full h-full">

                        @if($member->email || $member->phone || $member->whatsapp || $member->facebook_url)
                        <div
                            class="absolute top-0 right-0 flex flex-col gap-2 p-2 bg-white/60 backdrop-blur-sm rounded-bl-xl">
                            @include('components.member-social-icons', ['member' => $member])
                        </div>
                        @endif
                    </div>

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

                        @if(in_array($member->name, ['Bishop Dr. Moses Kisorio', 'Dr. Moses Kisorio', 'Moses Kisorio']))
                        <div class="pt-4 mt-4 border-t border-gray-200">
                            <div class="prose-sm prose max-w-none">
                                <p class="mb-2">Bishop Dr. Moses Kisorio is the founder of Christ Is the Way Ministries.
                                    Together with his wife Anne, they have led the church since its founding in 2000,
                                    guiding its growth and expansion throughout Kenya.</p>
                                <p class="mb-2">Under his leadership, CITWAM has grown from a small church to a ministry
                                    with regional presence in multiple counties including Turkana, West-Pokot, Nandi,
                                    Migori, Machakos, Makueni, and Isiolo.</p>
                                <p class="mb-2">Bishop Kisorio emphasizes the importance of a holistic gospel approach
                                    that addresses both spiritual and social needs of believers, guiding the ministry's
                                    focus on community outreach and empowerment programs alongside spiritual
                                    development.</p>
                                <p>He holds a Doctorate in Theology and is committed to training and equipping ministers
                                    to effectively serve in various regions. Together with his wife Anne, they continue
                                    to lead the church with a vision to establish thriving urban and rural churches in
                                    Kenya and beyond.</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
        @endif

        <!-- Other Categories Section -->
        <div x-data="{ activeTab: {{ $activeCategory }} }">
            <div class="flex flex-wrap justify-center gap-3 mb-8">
                @foreach($categories->where('is_featured', false) as $category)
                <button @click="activeTab = {{ $category->id }}" wire:click="setActiveCategory({{ $category->id }})"
                    :class="{
                        'bg-blue-600 text-white': activeTab === {{ $category->id }},
                        'bg-gray-200 text-gray-800 hover:bg-gray-300': activeTab !== {{ $category->id }}
                    }"
                    class="px-6 py-3 font-medium transition-colors duration-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    {{ $category->name }}
                </button>
                @endforeach
            </div>

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
                        <div class="relative overflow-hidden" style="aspect-ratio: 4 / 3;">
                            <img src="{{ $member->getProfileImageUrlAttribute() }}" alt="{{ $member->name }}"
                                onerror="this.onerror=null;this.src='{{ asset('images/citwam/avatar.jpeg') }}';"
                                class="object-cover w-full h-full">

                            @if($member->email || $member->phone || $member->whatsapp || $member->facebook_url)
                            <div
                                class="absolute top-0 right-0 flex flex-col gap-2 p-2 bg-white/60 backdrop-blur-sm rounded-bl-xl">
                                @include('components.member-social-icons', ['member' => $member])
                            </div>
                            @endif
                        </div>

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
