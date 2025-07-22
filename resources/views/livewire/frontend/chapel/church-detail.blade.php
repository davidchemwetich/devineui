<div class="bg-gray-50">
    <div class="container mx-auto px-4 py-8">
        <!-- Breadcrumb -->
        <nav class="mb-6 text-sm" aria-label="Breadcrumb">
            <ol class="flex space-x-2">
                <li>
                    <a href="{{ route('home') }}" class="text-gray-500 hover:text-gray-700">Home</a>
                </li>
                <li class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    <a href="" class="text-gray-500 hover:text-gray-700">Churches</a>
                </li>
                <li class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    <span class="text-gray-900 font-medium">{{ $church->name }}</span>
                </li>
            </ol>
        </nav>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Church Header -->
            <div class="relative">
                <div class="aspect-w-16 aspect-h-6 bg-gray-200">
                    @if($church->thumbnail)
                        <img 
                            src="{{ asset('storage/' . $church->thumbnail) }}" 
                            alt="{{ $church->name }}" 
                            class="object-cover w-full"
                        onerror="this.onerror=null;this.src='{{ asset('images/citwam/unsplash.jpg') }}';"
                        >
                    @else
                        <div class="flex items-center justify-center h-full bg-gray-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                    @endif
                </div>
                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-6">
                    <h1 class="text-3xl font-bold text-white">{{ $church->name }}</h1>
                </div>
            </div>

            <!-- Church Info -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 p-6">
                <!-- Left Column - Church Details -->
                <div class="col-span-1 md:col-span-2 space-y-6">
                    <!-- Location -->
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800 mb-3">Church Information</h2>
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 space-y-3">
                            @if($church->region)
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-gray-600">Region</p>
                                        <p class="text-gray-900">{{ $church->region->name }}</p>
                                    </div>
                                </div>
                            @endif

                            @if($church->cluster)
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-gray-600">Cluster</p>
                                        <p class="text-gray-900">{{ $church->cluster->cluster_name }}</p>
                                    </div>
                                </div>
                            @endif

                            @if($church->address)
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-gray-600">Address</p>
                                        <p class="text-gray-900">{{ $church->address }}</p>
                                    </div>
                                </div>
                            @endif

                            @if($church->phone)
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-gray-600">Phone</p>
                                        <p class="text-gray-900">{{ $church->phone }}</p>
                                    </div>
                                </div>
                            @endif

                            @if($church->email)
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-gray-600">Email</p>
                                        <a href="mailto:{{ $church->email }}" class="text-indigo-600 hover:text-indigo-800">{{ $church->email }}</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Visit Us -->
                    <div class="space-y-4" x-data="{ tab: 'info' }">
                        <h2 class="text-xl font-semibold text-gray-800">Visit Us</h2>

                        <div class="bg-gray-50 rounded-lg border border-gray-200 overflow-hidden">
                            <!-- Tabs -->
                            <div class="flex border-b border-gray-200">
                                <button
                                    @click="tab = 'info'"
                                    :class="{ 'bg-white text-indigo-600 border-indigo-500': tab === 'info', 'text-gray-500 hover:text-gray-700 border-transparent': tab !== 'info' }"
                                    class="px-4 py-2 border-b-2 font-medium text-sm focus:outline-none"
                                >
                                    Service Information
                                </button>
                                <button
                                    @click="tab = 'map'"
                                    :class="{ 'bg-white text-indigo-600 border-indigo-500': tab === 'map', 'text-gray-500 hover:text-gray-700 border-transparent': tab !== 'map' }"
                                    class="px-4 py-2 border-b-2 font-medium text-sm focus:outline-none"
                                >
                                    Location Map
                                </button>
                            </div>

                            <!-- Tab Content -->
                            <div class="p-4">
                                <!-- Service Information Tab -->
                                <div x-show="tab === 'info'" class="space-y-3">
                                    <p class="text-gray-600">
                                        Join us for our weekly services and events. Please contact us for the latest schedule information.
                                    </p>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div class="bg-white p-3 rounded border border-gray-200">
                                            <h3 class="font-medium text-gray-900">Sunday Service</h3>
                                            <p class="text-gray-600 text-sm mt-1">10:00 AM - 12:00 PM</p>
                                        </div>
                                        <div class="bg-white p-3 rounded border border-gray-200">
                                            <h3 class="font-medium text-gray-900">Bible Study</h3>
                                            <p class="text-gray-600 text-sm mt-1">Wednesday, 6:30 PM - 8:00 PM</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Map Tab -->
                                <div x-show="tab === 'map'" class="h-80">
                                    @if($church->google_map_iframe)
                                        <div class="h-full">
                                            {!! $church->google_map_iframe !!}
                                        </div>
                                    @else
                                        <div class="flex items-center justify-center h-full bg-gray-100 text-gray-500">
                                            <div class="text-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                                </svg>
                                                <p class="mt-2">Map information not available</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Contact & Connect -->
                <div class="col-span-1 space-y-6">
                    <!-- Contact Card -->
                    <div class="bg-gray-50 rounded-lg border border-gray-200 p-5">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Contact Us</h2>

                        @if($church->phone || $church->email)
                            <div class="space-y-3 mb-4">
                                @if($church->phone)
                                    <a href="tel:{{ $church->phone }}" class="flex items-center text-gray-600 hover:text-indigo-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                        {{ $church->phone }}
                                    </a>
                                @endif

                                @if($church->email)
                                    <a href="mailto:{{ $church->email }}" class="flex items-center text-gray-600 hover:text-indigo-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        {{ $church->email }}
                                    </a>
                                @endif
                            </div>
                        @endif
                        
                        <!-- Contact Form -->
                        <div x-data="{ formSubmitted: false }">
                            <form
                                x-show="!formSubmitted"
                                wire:submit="sendContactMessage"
                                class="space-y-3"
                            >
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                                    <input 
                                        type="text" 
                                        id="name" 
                                        wire:model.live="contactForm.name" 
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                                    >
                                    @error('contactForm.name') 
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <input 
                                        type="email" 
                                        id="email" 
                                        wire:model.live="contactForm.email" 
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                                    >
                                    @error('contactForm.email') 
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                                    <textarea 
                                        id="message" 
                                        wire:model.live="contactForm.message" 
                                        rows="3" 
                                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                                    ></textarea>
                                    @error('contactForm.message') 
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <button 
                                        type="submit"
                                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                        wire:loading.attr="disabled"
                                    >
                                        <span wire:loading.remove>Send Message</span>
                                        <span wire:loading>
                                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                            Sending...
                                        </span>
                                    </button>
                                </div>
                            </form>
                            
                            <div
                                x-show="formSubmitted"
                                class="bg-green-50 border border-green-200 rounded-md p-4 text-center"
                            >
                                <svg class="h-6 w-6 text-green-500 mx-auto mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <h3 class="text-sm font-medium text-green-800">Message Sent!</h3>
                                <p class="mt-2 text-sm text-green-700">We'll get back to you as soon as possible.</p>
                                <button
                                    @click="formSubmitted = false" 
                                    class="mt-3 text-sm text-green-600 hover:text-green-500 underline"
                                >
                                    Send another message
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Church Leaders -->
                    @if($church->churchLeaders->count() > 0)
                        <div class="bg-gray-50 rounded-lg border border-gray-200 p-5">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Church Leaders</h2>
                            <div class="space-y-4">
                                @foreach($church->churchLeaders as $leader)
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            @if($leader->profile_photo_path)
                                                <img 
                                                    src="{{ asset('storage/' . $leader->profile_photo_path) }}" 
                                                    alt="{{ $leader->name }}" 
                                                    class="h-10 w-10 rounded-full object-cover"
                                                    onerror="this.onerror=null;this.src='{{ asset('images/fallback.jpg') }}';"
                                                >
                                            @else
                                                <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                                    <span class="text-gray-500 font-medium">
                                                        {{ substr($leader->name, 0, 1) }}
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">{{ $leader->name }}</p>
                                            <p class="text-xs text-gray-500">Church Leader</p>
                                        </div>
                                    </div>   
                                @endforeach
                            </div>
                        </div>
                    @endif
                    
                    <!-- Back to Churches -->
                    <a 
                        href="{{ route('churches') }}" 
                        class="block text-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        <span class="flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back to Churches
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>