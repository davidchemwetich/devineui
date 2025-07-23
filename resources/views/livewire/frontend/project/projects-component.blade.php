<div class="min-h-screen bg-gray-50" x-data="{ 
    scrollToTop() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
}" @scroll-to-top.window="scrollToTop()">
    <!-- Hero Section -->
    <div class="relative overflow-hidden bg-gradient-to-br from-[#008000] to-green-700">
        <div class="absolute inset-0 bg-black opacity-10"></div>
        <div class="relative px-4 py-20 mx-auto max-w-7xl sm:px-6 lg:px-8 lg:py-28">
            <div class="text-center">
                <h1 class="text-4xl font-bold tracking-tight text-white sm:text-5xl lg:text-6xl">
                    Building God's Kingdom
                </h1>
                <p class="max-w-3xl mx-auto mt-6 text-xl text-green-100">
                    Join us in transforming lives and communities through these faith-driven development projects
                </p>
                <div class="flex flex-col items-center justify-center gap-4 mt-10 sm:flex-row">
                    <a href="#projects" 
                       class="inline-flex items-center px-8 py-3 text-lg font-medium text-green-700 bg-white rounded-full shadow-lg hover:bg-gray-50 transition-all duration-200 hover:shadow-xl transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                        </svg>
                        Explore Projects
                    </a>
                    <a href="#donate" 
                       class="inline-flex items-center px-8 py-3 text-lg font-medium text-white bg-[#000fff] rounded-full shadow-lg hover:bg-blue-700 transition-all duration-200 hover:shadow-xl transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                        Support Now
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Projects Section -->
    @if($featuredProjects->count() > 0)
    <div class="px-4 py-16 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-900 sm:text-4xl">Featured Projects</h2>
            <p class="max-w-2xl mx-auto mt-4 text-lg text-gray-600">
                Our most impactful initiatives making a difference in our community
            </p>
        </div>

        <div class="grid grid-cols-1 gap-8 mt-12 md:grid-cols-2 lg:grid-cols-3">
            @foreach($featuredProjects as $project)
            <div class="group relative overflow-hidden bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                <div class="aspect-w-16 aspect-h-10 overflow-hidden">
                    <img src="{{ $project->featured_image_url }}" 
                         alt="{{ $project->title }}"
                         class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
                
                <div class="p-6">
                    <div class="flex items-center justify-between mb-3">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-[#008000] text-white">
                            {{ $project->type->name }}
                        </span>
                        <span class="text-sm font-semibold text-[#000fff]">
                            {{ number_format($project->progress_percentage, 0) }}%
                        </span>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2">
                        {{ $project->title }}
                    </h3>
                    
                    <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                        {{ Str::limit($project->description, 120) }}
                    </p>
                    
                    <!-- Progress Bar -->
                    <div class="mb-4">
                        <div class="flex justify-between text-sm text-gray-600 mb-2">
                            <span>KSh {{ $project->formatted_raised }}</span>
                            <span>KSh {{ $project->formatted_goal }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-[#000fff] h-2.5 rounded-full transition-all duration-500 ease-out" 
                                 style="width: {{ $project->progress_percentage }}%"></div>
                        </div>
                    </div>
                    
                    <a href="{{ route('project.show', $project->slug) }}" 
                       class="inline-flex items-center justify-center w-full px-6 py-3 text-sm font-medium text-white bg-[#008000] rounded-lg hover:bg-green-700 transition-colors duration-200">
                        Learn More
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Main Projects Section -->
    <div id="projects" class="px-4 py-16 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 sm:text-4xl">All Projects</h2>
            <p class="max-w-2xl mx-auto mt-4 text-lg text-gray-600">
                Discover all our ongoing development initiatives and be part of the transformation
            </p>
        </div>

        <!-- Search and Filters -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-12" 
             x-data="{ 
                filtersOpen: false,
                searchFocused: false 
             }">
            <div class="flex flex-col space-y-4 lg:flex-row lg:space-y-0 lg:space-x-6 lg:items-center">
                <!-- Search Bar -->
                <div class="flex-1 relative" 
                     :class="{ 'ring-2 ring-[#000fff] ring-opacity-50': searchFocused }">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" 
                           wire:model.live.debounce.300ms="search"
                           @focus="searchFocused = true"
                           @blur="searchFocused = false"
                           class="block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-[#000fff] focus:border-[#000fff] transition-all duration-200"
                           placeholder="Search projects...">
                </div>

                <!-- Mobile Filter Toggle -->
                <button @click="filtersOpen = !filtersOpen"
                        class="lg:hidden inline-flex items-center px-4 py-3 border border-gray-300 rounded-xl text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors duration-200">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                    </svg>
                    Filters
                </button>

                <!-- Desktop Filters -->
                <div class="hidden lg:flex lg:items-center lg:space-x-4">
                    <select wire:model.live="selectedType"
                            class="border border-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#000fff] focus:border-[#000fff] transition-all duration-200">
                        <option value="">All Categories</option>
                        @foreach($projectTypes as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>

                    <select wire:model.live="sortBy"
                            class="border border-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#000fff] focus:border-[#000fff] transition-all duration-200">
                        <option value="latest">Latest First</option>
                        <option value="oldest">Oldest First</option>
                        <option value="progress">Most Progress</option>
                        <option value="goal_high">Highest Goal</option>
                        <option value="goal_low">Lowest Goal</option>
                    </select>
                </div>
            </div>

            <!-- Mobile Filters -->
            <div x-show="filtersOpen" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 transform -translate-y-2"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 transform translate-y-0"
                 x-transition:leave-end="opacity-0 transform -translate-y-2"
                 class="lg:hidden mt-4 pt-4 border-t border-gray-200 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                    <select wire:model.live="selectedType"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#000fff] focus:border-[#000fff] transition-all duration-200">
                        <option value="">All Categories</option>
                        @foreach($projectTypes as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sort By</label>
                    <select wire:model.live="sortBy"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#000fff] focus:border-[#000fff] transition-all duration-200">
                        <option value="latest">Latest First</option>
                        <option value="oldest">Oldest First</option>
                        <option value="progress">Most Progress</option>
                        <option value="goal_high">Highest Goal</option>
                        <option value="goal_low">Lowest Goal</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Projects Grid -->
        <div wire:loading.class="opacity-50 pointer-events-none" class="transition-opacity duration-200">
            @if($projects->count() > 0)
                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    @foreach($projects as $project)
                    <div class="group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="relative overflow-hidden">
                            <img src="{{ $project->featured_image_url }}" 
                                 alt="{{ $project->title }}"
                                 class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-105">
                            <div class="absolute top-3 left-3">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-white/90 text-[#008000]">
                                    {{ $project->type->name }}
                                </span>
                            </div>
                            <div class="absolute top-3 right-3">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-[#000fff] text-white">
                                    {{ number_format($project->progress_percentage, 0) }}%
                                </span>
                            </div>
                        </div>
                        
                        <div class="p-5">
                            <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-[#008000] transition-colors duration-200">
                                {{ $project->title }}
                            </h3>
                            
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                {{ Str::limit($project->description, 100) }}
                            </p>
                            
                            <!-- Progress Bar -->
                            <div class="mb-4">
                                <div class="flex justify-between text-xs text-gray-600 mb-1">
                                    <span>Raised: KSh {{ $project->formatted_raised }}</span>
                                    <span>Goal: KSh {{ $project->formatted_goal }}</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-[#000fff] h-2 rounded-full transition-all duration-500 ease-out" 
                                         style="width: {{ $project->progress_percentage }}%"></div>
                                </div>
                            </div>
                            
                            <a href="{{ route('project.show', $project->slug) }}" 
                               class="inline-flex items-center justify-center w-full px-4 py-2.5 text-sm font-medium text-white bg-[#008000] rounded-lg hover:bg-green-700 transition-colors duration-200 group-hover:shadow-lg">
                                View Details
                                <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    {{ $projects->links() }}
                </div>
            @else
                <div class="text-center py-16">
                    <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">No projects found</h3>
                    <p class="mt-2 text-gray-600">
                        @if(!empty($search) || !empty($selectedType))
                            Try adjusting your search or filters to find what you're looking for.
                        @else
                            There are currently no projects available.
                        @endif
                    </p>
                    @if(!empty($search) || !empty($selectedType))
                        <button wire:click="$set('search', '')" wire:click="$set('selectedType', '')"
                                class="mt-4 inline-flex items-center px-4 py-2 text-sm font-medium text-[#000fff] bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors duration-200">
                            Clear Filters
                        </button>
                    @endif
                </div>
            @endif
        </div>

        <!-- Loading Indicator -->
        <div wire:loading class="fixed inset-0 bg-white/80 flex items-center justify-center z-50">
            <div class="flex items-center space-x-2">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-[#000fff]"></div>
                <span class="text-gray-700 font-medium">Loading...</span>
            </div>
        </div>
    </div>

    <!-- Call to Action Section -->
    <div class="bg-gradient-to-r from-[#008000] to-green-700 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-white sm:text-4xl">
                Ready to Make a Difference?
            </h2>
            <p class="max-w-2xl mx-auto mt-4 text-xl text-green-100">
                Your contribution, no matter the size, helps us build a stronger community and spread God's love.
            </p>
            <div class="mt-8">
                <a href="#donate" 
                   class="inline-flex items-center px-8 py-4 text-lg font-medium text-white bg-[#000fff] rounded-full shadow-lg hover:bg-blue-700 transition-all duration-200 hover:shadow-xl transform hover:-translate-y-0.5">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                    Support Our Mission
                </a>
            </div>
        </div>
    </div>
</div>

