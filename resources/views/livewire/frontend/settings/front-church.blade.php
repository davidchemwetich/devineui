<div class="min-h-screen text-gray-800 transition-colors duration-300 bg-gray-50 dark:bg-gray-900 dark:text-gray-200">
    <!-- Hero Section -->
    <div class="relative py-20 bg-[#008000]">
        <div class="absolute inset-0 opacity-20 bg-pattern-overlay"></div>
        <div class="container relative z-10 px-4 mx-auto">
            <div class="max-w-3xl mx-auto text-center" x-data="{ loaded: false }"
                x-init="setTimeout(() => loaded = true, 100)" x-transition:enter.duration.500ms>
                <h1 class="text-4xl font-bold leading-tight text-white transition-all duration-500 transform md:text-5xl"
                    :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                    Find Our Church Near You
                </h1>
            </div>
        </div>
    </div>

    <div class="container relative px-4 py-12 pt-24 mx-auto md:px-6 lg:px-8">
        @if(!$showDetail)
        <div wire:key="list-view">
            <div class="p-6 mb-10 transition-colors duration-300 bg-white shadow-md rounded-xl dark:bg-gray-800">
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    {{-- Region Filter --}}
                    <div>
                        <label for="region-filter" class="flex items-center mb-2 text-sm font-medium text-[#008000]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                    clip-rule="evenodd" />
                            </svg>
                            Filter by Region
                        </label>
                        <select id="region-filter" wire:model.live="selectedRegion"
                            class="w-full px-4 py-2 transition duration-150 ease-in-out border border-gray-300 rounded-lg bg-gray-50 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                            <option value="">All Regions</option>
                            @foreach($regions as $region)
                            <option value="{{ $region->id }}">{{ $region->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Cluster Filter --}}
                    <div>
                        <label for="cluster-filter" class="flex items-center mb-2 text-sm font-medium text-[#008000]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                    d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                            </svg>
                            Filter by Cluster
                        </label>
                        <select id="cluster-filter" wire:model.live="selectedCluster"
                            class="w-full px-4 py-2 transition duration-150 ease-in-out border border-gray-300 rounded-lg bg-gray-50 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                            <option value="">All Clusters</option>
                            @foreach($clusters as $cluster)
                            <option value="{{ $cluster->id }}">{{ $cluster->cluster_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                @forelse($churches as $church)
                <div wire:key="church-{{ $church->id }}"
                    class="flex flex-col overflow-hidden transition-all duration-300 ease-in-out bg-white border border-gray-200 rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700 hover:shadow-xl group">
                    {{-- Church Image --}}
                    <div class="relative w-full h-48 overflow-hidden">
                    <img 
                         src="{{ asset('storage/' . $church->thumbnail) }}" 
                         alt="{{ $church->name }} Thumbnail"
                               loading="lazy"
                              onerror="this.onerror=null;this.src='{{ asset('images/citwam/avatar.jpeg') }}';"
                               class="object-cover w-full h-full transition-transform duration-500 ease-in-out group-hover:scale-105">

                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent">
                        </div>
                    </div>

                    {{-- Church Info --}}
                    <div class="flex flex-col flex-grow p-6">
                        <h2 class="mb-2 text-xl font-semibold text-[#008000]">
                            {{ $church->name }}</h2>
                        <div
                            class="flex items-start mb-4 text-sm text-gray-600 transition-colors duration-300 dark:text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0 text-gray-400 dark:text-gray-500"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>{{ $church->address }}</span>
                        </div>

                        {{-- View Details Button --}}
                        <div class="mt-auto">
                            <button wire:click="viewChurchDetail({{ $church->id }})"
                                class="inline-flex items-center justify-center w-full px-4 py-2 text-sm font-medium bg-blue-600 hover:bg-blue-700">
                                Church Details
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-4 h-4 ml-2 transition-transform duration-300 ease-in-out group-hover:translate-x-1"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-1 py-12 text-center text-gray-500 md:col-span-2 lg:col-span-3 dark:text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-16 h-16 mx-auto mb-4 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="1">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        {{-- Slightly different icon for "not found" --}}
                    </svg>
                    <p class="text-lg">No churches found matching your criteria.</p>
                    <p class="text-sm">Try adjusting the region or cluster filters.</p>
                </div>
                @endforelse
            </div>

            <div class="mt-10">
                {{-- Ensure your pagination views are configured for Tailwind --}}
                {{ $churches->links() }}
            </div>
        </div>
        @else
        {{-- ====================== --}}
        {{-- Church Detail View --}}
        {{-- ====================== --}}
        <div wire:key="detail-view-{{ $selectedChurch->id }}" class="max-w-6xl mx-auto">

            <!-- Back Button -->
            <div class="mb-6">
                <button wire:click="backToList"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-[#008000] bg-indigo-100 rounded-md hover:bg-indigo-200 dark:text-indigo-300 dark:bg-gray-700 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    Back to List
                </button>
            </div>

            <!-- Church Image -->
            <div class="w-full h-64 mb-8 overflow-hidden rounded-lg shadow-xl sm:h-80">
                <img src="{{ asset('storage/' . $selectedChurch->thumbnail) }}" alt="{{ $selectedChurch->name }}"
                    class="object-cover w-full h-full"
                    onerror="this.onerror=null;this.src='{{ asset('images/citwam/unsplash.jpg') }}';">
            </div>


            <!-- Church Info Section -->
            <div class="p-6 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <h1 class="mb-4 text-3xl font-bold text-[#008000] dark:text-indigo-300">{{ $selectedChurch->name }}</h1>

                <div class="flex flex-wrap gap-4 text-gray-600 dark:text-gray-300">
                    <div class="flex items-center px-4 py-2 bg-gray-100 rounded-lg dark:bg-gray-700">
                        <svg class="w-5 h-5 mr-2 text-[#008000] dark:text-indigo-300" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                clip-rule="evenodd" />
                        </svg>
                        {{ $selectedChurch->region->name }}
                    </div>
                    <div class="flex items-center px-4 py-2 bg-gray-100 rounded-lg dark:bg-gray-700">
                        <svg class="w-5 h-5 mr-2 text-[#008000] dark:text-indigo-300" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                        </svg>
                        {{ $selectedChurch->cluster->cluster_name }}
                    </div>
                </div>
            </div>

            <!-- Contact Section -->
            <div class="grid gap-8 mb-8 lg:grid-cols-2">
                <!-- Left Column - Contact Form -->
                <div class="p-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
                    <h2 class="mb-6 text-2xl font-bold text-[#008000] dark:text-indigo-300">Get in Touch</h2>
                    <livewire:contact-form />
                </div>

                <!-- Right Column - Contact Information -->
                <div class="p-6 bg-[#f8fff8] rounded-lg shadow-md dark:bg-gray-700">
                    <h2 class="mb-6 text-2xl font-bold text-[#008000] dark:text-indigo-300">Contact Information</h2>
                    <div class="space-y-5">
                        <div class="flex">
                            <svg class="flex-shrink-0 w-6 h-6 mt-1 mr-4 text-[#008000] dark:text-indigo-300"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <div>
                                <p class="font-medium text-gray-600 dark:text-gray-300">Address</p>
                                <p class="text-gray-800 dark:text-gray-200">{{ $selectedChurch->address }}</p>
                            </div>
                        </div>

                        @if($selectedChurch->phone)
                        <div class="flex">
                            <svg class="flex-shrink-0 w-6 h-6 mt-1 mr-4 text-[#008000] dark:text-indigo-300"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                            </svg>
                            <div>
                                <p class="font-medium text-gray-600 dark:text-gray-300">Phone</p>
                                <a href="tel:{{ $selectedChurch->phone }}"
                                    class="text-gray-800 hover:text-[#008000] dark:text-gray-200 dark:hover:text-indigo-300">{{
                                    $selectedChurch->phone }}</a>
                            </div>
                        </div>
                        @endif

                        @if($selectedChurch->email)
                        <div class="flex">
                            <svg class="flex-shrink-0 w-6 h-6 mt-1 mr-4 text-[#008000] dark:text-indigo-300"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                            </svg>
                            <div>
                                <p class="font-medium text-gray-600 dark:text-gray-300">Email</p>
                                <a href="mailto:{{ $selectedChurch->email }}"
                                    class="text-gray-800 hover:text-[#008000] dark:text-gray-200 dark:hover:text-indigo-300">{{
                                    $selectedChurch->email }}</a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Map Section -->
            <div class="p-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <h2 class="mb-4 text-2xl font-bold text-[#008000] dark:text-indigo-300">Location</h2>
                <div
                    class="h-64 overflow-hidden rounded-lg shadow-inner aspect-w-16 aspect-h-9 lg:h-full dark:border-gray-700">
                    @if($selectedChurch->google_map_iframe)
                    {!! preg_replace('/(width|height)="[^"]*"/', '', $selectedChurch->google_map_iframe) !!}
                    <style>
                        iframe {
                            width: 100% !important;
                            height: 100% !important;
                            border: 0;
                        }
                    </style>
                    @else
                    <div class="flex items-center justify-center h-full text-gray-500 bg-gray-100 dark:bg-gray-700">
                        Map not available
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>
    {{-- End Container --}}
</div>
