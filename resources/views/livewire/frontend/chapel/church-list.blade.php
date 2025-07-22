<div>
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
    <div class="px-4 py-8 bg-gray-50">
        <div class="container mx-auto">
            <!-- Search and Filters Section -->
            <div class="bg-white rounded-lg shadow mb-6 p-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- Search -->
                    <div class="col-span-1 md:col-span-2">
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                        <input wire:model.live.debounce.300ms="search" type="text"
                            placeholder="Search churches by name or address"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                    </div>

                    <!-- Region Filter -->
                    <div>
                        <label for="region" class="block text-sm font-medium text-gray-700 mb-1">Filter by
                            Region</label>
                        <select wire:model.live="selectedRegion"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                            <option value="">All Regions</option>
                            @foreach($regions as $region)
                            <option value="{{ $region->id }}">{{ $region->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Cluster Filter -->
                    <div>
                        <label for="cluster" class="block text-sm font-medium text-gray-700 mb-1">Filter by
                            Cluster</label>
                        <select wire:model.live="selectedCluster"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                            @if(!$selectedRegion) disabled @endif>
                            <option value="">All Clusters</option>
                            @foreach($clusters as $cluster)
                            <option value="{{ $cluster->id }}">{{ $cluster->cluster_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Churches Grid -->
            <div x-data="{ 
                        showLoading: false,
                        init() {
                            Livewire.hook('message.sent', () => { this.showLoading = true });
                            Livewire.hook('message.processed', () => { this.showLoading = false });
                        }
                    }">
                <!-- Loading Overlay -->
                <div x-show="showLoading"
                    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-20 z-50"
                    style="display: none;">
                    <div class="bg-white p-4 rounded-lg shadow-lg">
                        <div class="flex items-center space-x-3">
                            <svg class="animate-spin h-6 w-6 text-indigo-600" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4">
                                </circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            <span class="text-gray-700">Loading...</span>
                        </div>
                    </div>
                </div>

                <!-- Churches Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @forelse($churches as $church)
                    <a href="{{ route('church.detail', $church->id) }}"
                        class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <div class="aspect-w-16 aspect-h-9 bg-gray-200">
                            @if($church->thumbnail)
                            <img src="{{ asset('storage/' . $church->thumbnail) }}" alt="{{ $church->name }}"
                                class="object-cover w-full h-full" loading="lazy"
                        onerror="this.onerror=null;this.src='{{ asset('images/citwam/unsplash.jpg') }}';">
                            @else
                            <div class="flex items-center justify-center h-full bg-gray-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            @endif
                        </div>

                        <div class="p-4">
                            <h3 class="mb-2 text-lg font-semibold text-[#008000] dark:text-[#008000]">{{ $church['name']
                                }}</h3>
                            <div class="flex items-center mb-2 text-gray-700 dark:text-gray-300">
                                <svg class="w-4 h-4 mr-2 text-[#008000] dark:text-[#008000]" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="text-sm font-medium">{{ $church['address'] }}</span>
                            </div>
                            <div class="flex items-center text-[#008000] dark:text-[#008000]">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <span class="text-sm font-medium">{{ $church['phone'] }}</span>
    
                            </div>
                            <a href="mailto:{{ $church->email }}" class="text-[#008000] hover:text-[#008000]">{{ $church->email }}</a>
                        </div>
                        {{-- <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2 line-clamp-1">{{ $church->name }}</h3>
                            @if($church->address)
                            <p class="text-sm text-gray-600 line-clamp-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{ $church->address }}
                            </p>
                            @endif
                        </div> --}}
                    </a>
                    @empty
                    <div class="col-span-full text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="mt-2 text-lg font-medium text-gray-900">No churches found</h3>
                        <p class="mt-1 text-sm text-gray-500">Try adjusting your search or filter to find what you're
                            looking for.</p>
                    </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $churches->links() }}
                </div>
            </div>
        </div>
    </div>
</div>