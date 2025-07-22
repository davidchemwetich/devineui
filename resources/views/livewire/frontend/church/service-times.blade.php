<div class="w-full py-12 bg-gradient-to-br from-indigo-100 to-blue-50 rounded-xl shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-10">
            <h2 class="text-3xl md:text-4xl font-extrabold text-[#008000] tracking-tight">
                Worship With Us
            </h2>
            <div class="h-1 w-24 bg-[#008000] mx-auto mt-4 rounded-full"></div>
            <p class="mt-4 text-lg text-gray-600 max-w-2xl mx-auto">
                Join our community for worship, fellowship, and spiritual growth throughout the week.
            </p>
        </div>

        <!-- Services Carousel -->
        <div 
            x-data="{ 
                showMobileControls: false 
            }"
            class="relative mt-10"
        >
            <!-- Featured Service -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden transition-all duration-500 transform hover:scale-[1.02]">
                <div class="flex flex-col md:flex-row">
                    <!-- Service Info -->
                    <div class="p-8 md:p-12 md:w-2/3">
                        <div class="flex items-center mb-6">
                            <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#000fff]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    @switch($services[$currentService]['icon'])
                                        @case('sun')
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                                            @break
                                        @case('book-open')
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            @break
                                        @case('users')
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                            @break
                                        @case('heart')
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                            @break
                                        @default
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    @endswitch
                                </svg>
                            </div>
                            <span class="font-bold text-[#000fff] uppercase tracking-wider text-sm">{{ $services[$currentService]['day'] }}</span>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ $services[$currentService]['name'] }}</h3>
                        <div class="mb-6">
                            @foreach($services[$currentService]['times'] as $time)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-[#000fff] mr-2 mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $time }}
                                </span>
                            @endforeach
                        </div>
                        <p class="text-gray-600 mb-6">{{ $services[$currentService]['description'] }}</p>
                        <a href="#" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-[#000fff] hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#000fff]">
                            Plan Your Visit
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                    
                    <!-- Decorative Image -->
                    <div class="md:w-1/3 bg-[#008000] flex items-center justify-center p-8 md:p-0">
                        <div class="text-center text-white">
                            <div class="text-6xl font-bold mb-2">
                                @switch($services[$currentService]['day'])
                                    @case('Sunday')
                                        SUN
                                        @break
                                    @case('Monday')
                                        MON
                                        @break
                                    @case('Tuesday')
                                        TUE
                                        @break
                                    @case('Wednesday')
                                        WED
                                        @break
                                    @case('Thursday')
                                        THU
                                        @break
                                    @case('Friday')
                                        FRI
                                        @break
                                    @case('Saturday')
                                        SAT
                                        @break
                                @endswitch
                            </div>
                            <div class="text-lg opacity-75">Come as you are</div>
                            <div class="mt-4 h-1 w-12 bg-white/50 mx-auto rounded-full"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation Buttons -->
            <div 
                @mouseenter="showMobileControls = true"
                @mouseleave="showMobileControls = false"
                class="absolute inset-0 flex items-center justify-between pointer-events-none"
            >
                <button 
                    wire:click="prevService" 
                    class="pointer-events-auto h-10 w-10 rounded-full bg-white/80 backdrop-blur-sm text-[#000fff] shadow-lg flex items-center justify-center -ml-5 transition-opacity duration-300"
                    :class="{'opacity-0 md:opacity-100': !showMobileControls, 'opacity-100': showMobileControls}"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button 
                    wire:click="nextService" 
                    class="pointer-events-auto h-10 w-10 rounded-full bg-white/80 backdrop-blur-sm text-[#000fff] shadow-lg flex items-center justify-center -mr-5 transition-opacity duration-300"
                    :class="{'opacity-0 md:opacity-100': !showMobileControls, 'opacity-100': showMobileControls}"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Service Indicators -->
        <div class="flex justify-center space-x-2 mt-6">
            @foreach($services as $index => $service)
                <button 
                    wire:click="$set('currentService', {{ $index }})" 
                    class="h-2 rounded-full transition-all duration-300 focus:outline-none"
                    :class="{'w-8 bg-[#000fff]': {{ $index }} === {{ $currentService }}, 'w-2 bg-[#000fff]': {{ $index }} !== {{ $currentService }}}"
                ></button>
            @endforeach
        </div>

        <!-- Weekly Schedule Preview -->
        <div class="mt-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach($services as $index => $service)
                <div 
                    wire:click="$set('currentService', {{ $index }})"
                    class="cursor-pointer group"
                >
                    <div class="bg-white rounded-lg shadow-md p-5 transition-all duration-300 border-2 hover:border-[#000fff] hover:shadow-lg"
                         :class="{'border-[#000fff]': {{ $index }} === {{ $currentService }}, 'border-transparent': {{ $index }} !== {{ $currentService }}}"
                    >
                        <div class="flex items-center mb-3">
                            <div class="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#000fff]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    @switch($service['icon'])
                                        @case('sun')
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                                            @break
                                        @case('book-open')
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            @break
                                        @case('users')
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                            @break
                                        @case('heart')
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                            @break
                                        @default
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    @endswitch
                                </svg>
                            </div>
                            <span class="font-semibold text-gray-900">{{ $service['day'] }}</span>
                        </div>
                        <h4 class="text-lg font-medium text-gray-900 mb-2">{{ $service['name'] }}</h4>
                        <div class="text-sm text-gray-500">
                            {{ implode(', ', $service['times']) }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>