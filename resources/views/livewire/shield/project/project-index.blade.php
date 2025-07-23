<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-gray-900 dark:to-gray-800 p-4 sm:p-6 md:p-8">
    <!-- Header Section -->
    <div class="max-w-7xl mx-auto mb-8">
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-2">Church Projects</h1>
                <p class="text-gray-600 dark:text-gray-400">Supporting God's work in our community</p>
            </div>
            <a href="{{ route(config('app.admin_prefix', 'shield') . '.project.create') }}" 
               class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg shadow-lg transition-all duration-200 hover:shadow-xl">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                New Project
            </a>
        </div>
    </div>

    <!-- Flash Messages -->
    @if(session()->has('message'))
        <div class="max-w-7xl mx-auto mb-6">
            <div class="bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200 px-4 py-3 rounded-lg" 
                 x-data="{ show: true }" 
                 x-show="show" 
                 x-transition:enter="transition ease-out duration-300" 
                 x-transition:enter-start="opacity-0 transform translate-y-2" 
                 x-transition:enter-end="opacity-100 transform translate-y-0">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ session('message') }}
                    </div>
                    <button @click="show = false" class="text-green-600 dark:text-green-400 hover:text-green-800 dark:hover:text-green-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Filters & Search -->
    <div class="max-w-7xl mx-auto mb-8">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
            <div class="flex flex-col lg:flex-row gap-4">
                <!-- Search -->
                <div class="flex-1">
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" 
                               wire:model.live.debounce.300ms="search" 
                               placeholder="Search projects by title or description..."
                               class="w-full pl-10 pr-4 py-3 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                </div>

                <!-- Type Filter -->
                <div class="lg:w-64">
                    <select wire:model.live="selectedType" 
                            class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">All Project Types</option>
                        @foreach($projectTypes as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Sort Options -->
                <div class="lg:w-48">
                    <select wire:model.live="sortBy" 
                            class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="latest">Latest First</option>
                        <option value="oldest">Oldest First</option>
                        <option value="title">Title A-Z</option>
                        <option value="goal_amount">Highest Goal</option>
                        <option value="progress">Most Progress</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Projects Grid -->
    <div class="max-w-7xl mx-auto">
        @if($projects->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                @foreach($projects as $project)
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 group">
                        <!-- Project Image -->
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ $project->featured_image_url }}" 
                                 alt="{{ $project->title }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            
                            <!-- Project Type Badge -->
                            <div class="absolute top-4 left-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-100 dark:bg-indigo-900 text-indigo-800 dark:text-indigo-200">
                                    {{ $project->type->name }}
                                </span>
                            </div>

                            <!-- Actions Dropdown -->
                            <div class="absolute top-4 right-4" x-data="{ open: false }">
                                <button @click="open = !open" 
                                        class="p-2 bg-white dark:bg-gray-800 rounded-full shadow-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                    <svg class="w-4 h-4 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                                    </svg>
                                </button>
                                
                                <div x-show="open" 
                                     @click.away="open = false"
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 scale-95"
                                     x-transition:enter-end="opacity-100 scale-100"
                                     class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 z-10">
                                    <div class="py-1">
                                        <a href="{{ route(config('app.admin_prefix', 'shield') . '.project.edit', $project->id) }}" 
                                           class="flex items-center px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                            Edit Project
                                        </a>
                                        <button wire:click="confirmDelete({{ $project->id }})" 
                                                class="flex items-center w-full px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            Delete Project
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Project Content -->
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-2 line-clamp-2">
                                {{ $project->title }}
                            </h3>
                            
                            <p class="text-gray-600 dark:text-gray-400 text-sm mb-4 line-clamp-3">
                                {{ $project->description }}
                            </p>

                            <!-- Progress Section -->
                            <div class="mb-4">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Progress</span>
                                    <span class="text-sm font-semibold text-indigo-600 dark:text-indigo-400">
                                        {{ number_format($project->progress_percentage, 1) }}%
                                    </span>
                                </div>
                                
                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                                    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 h-2.5 rounded-full transition-all duration-300" 
                                         style="width: {{ $project->progress_percentage }}%"></div>
                                </div>
                                
                                <div class="flex justify-between items-center mt-2 text-sm">
                                    <span class="text-gray-600 dark:text-gray-400">
                                        ${{ $project->formatted_raised }} raised
                                    </span>
                                    <span class="font-medium text-gray-800 dark:text-gray-200">
                                        ${{ $project->formatted_goal }} goal
                                    </span>
                                </div>
                            </div>

                            <!-- Latest Update -->
                            @if($project->latest_update)
                                <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0">
                                            <div class="w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">Latest Update</p>
                                            <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2">
                                                {{ $project->latest_update }}
                                            </p>
                                            @if($project->latest_update_date)
                                                <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">
                                                    {{ $project->latest_update_date->format('M j, Y') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="flex justify-center">
                {{ $projects->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-12">
                <div class="mx-auto w-24 h-24 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-800 dark:text-gray-100 mb-2">No projects found</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-6">
                    @if($search || $selectedType)
                        Try adjusting your search or filter criteria.
                    @else
                        Get started by creating your first church project.
                    @endif
                </p>
                
                @if(!$search && !$selectedType)
                    <a href="{{ route(config('app.admin_prefix', 'shield') . '.project.create') }}" 
                       class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Create First Project
                    </a>
                @else
                    <button wire:click="$set('search', ''); $set('selectedType', '')" 
                            class="inline-flex items-center px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors">
                        Clear Filters
                    </button>
                @endif
            </div>
        @endif
    </div>

    <!-- Delete Confirmation Modal -->
    <div x-data="{ open: @entangle('showDeleteModal') }" 
         x-show="open" 
         style="display: none;"
         class="fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="open" 
                 x-transition:enter="ease-out duration-300" 
                 x-transition:enter-start="opacity-0" 
                 x-transition:enter-end="opacity-100"
                 class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"></div>

            <div x-show="open" 
                 x-transition:enter="ease-out duration-300" 
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 class="inline-block w-full max-w-lg p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white dark:bg-gray-800 shadow-xl rounded-xl">
                
                <div class="flex items-center mb-4">
                    <div class="flex-shrink-0 w-10 h-10 mx-auto bg-red-100 dark:bg-red-900 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                        </svg>
                    </div>
                </div>

                <div class="text-center">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">
                        Delete Project
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">
                        Are you sure you want to delete 
                        @if($projectToDelete)
                            "<strong>{{ $projectToDelete->title }}</strong>"? 
                        @endif
                        This action cannot be undone and all project data will be permanently removed.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row-reverse gap-3">
                    <button wire:click="deleteProject" 
                            class="inline-flex justify-center w-full sm:w-auto px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Delete Project
                    </button>
                    <button wire:click="cancelDelete" 
                            class="inline-flex justify-center w-full sm:w-auto px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
