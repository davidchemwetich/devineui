<div x-data="{
    showDeleteModal: false,
    showFeatureModal: false,
    currentSermonId: null,
    currentSermonTitle: '',
    showFilters: false,
    isMobileView: false,
    init() {
        this.checkScreenSize();
        window.addEventListener('resize', () => this.checkScreenSize());
    },
    checkScreenSize() {
        this.isMobileView = window.innerWidth < 768;
    },
    confirmDelete(id, title) {
        this.currentSermonId = id;
        this.currentSermonTitle = title;
        this.showDeleteModal = true;
    },
    confirmFeature(id, title) {
        this.currentSermonId = id;
        this.currentSermonTitle = title;
        this.showFeatureModal = true;
    }
}" class="py-6 px-4 sm:px-6 lg:px-8 bg-gray-50 min-h-screen">
    <!-- Page Header -->
    <div class="max-w-7xl mx-auto mb-6">
        <div class="md:flex md:items-center md:justify-between">
            <div class="flex-1 min-w-0">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                    Sermon Library
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Manage your sermons collection
                </p>
            </div>
            <div class="mt-4 flex md:mt-0 md:ml-4">
                <a href="{{ route(config('app.admin_prefix') . '.church.sermons.create') }}" class="ml-3 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="mr-2 -ml-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Add New Sermon
                </a>
            </div>
        </div>
    </div>

    <!-- Search & Filters -->
    <div class="max-w-7xl mx-auto bg-white rounded-lg shadow overflow-hidden mb-6">
        <div class="px-4 py-5 sm:p-6">
            <div class="md:flex md:items-center md:justify-between">
                <!-- Search Bar -->
                <div class="relative rounded-md shadow-sm md:w-1/3">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </div>
                    <input type="text" wire:model.debounce.300ms="search" placeholder="Search sermons..." class="pl-10 pr-3 py- 2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 w-full">
                </div>

                <!-- Filter Button -->
                <button @click="showFilters = !showFilters" class="mt-4 md:mt-0 md:ml-4 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Filters
                    <svg class="ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15.75l-3.75-3.75h7.5L12 15.75z" />
                    </svg>
                </button>
            </div>

            <!-- Filters Section -->
            <div x-show="showFilters" class="mt-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="category" class="block text-sm font-bold text-gray-700">Category</label>
                        <select id="category" wire:model="selectedCategory" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">All Categories</option>
                            <option value="Faith">Faith</option>
                            <option value="Family">Family</option>
                            <option value="End Times">End Times</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div>
                        <label for="date" class="block text-sm font-bold text-gray-700">Date</label>
                        <input type="date" id="date" wire:model="selectedDate" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sermon List -->
    <div class="max-w-7xl mx-auto bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Preached On</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($sermons as $sermon)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $sermon->title }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $sermon->preached_on->format('Y-m-d') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $sermon->category }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route(config('app.admin_prefix') . '.church.sermons.edit', $sermon->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            <button @click="confirmDelete({{ $sermon->id }}, '{{ $sermon->title }}')" class="text-red-600 hover:text-red-900 ml-4">Delete</button>
                            <button @click="confirmFeature({{ $sermon->id }}, '{{ $sermon->title }}')" class="text-green-600 hover:text-green-900 ml-4">Feature</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Delete Confirmation Modal -->
    <div x-show="showDeleteModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg p-6">
            <h3 class="text-lg font-bold">Confirm Delete Sermon</h3>
            <p class="mt-2">Are you sure you want to delete the sermon titled "<span x-text="currentSermonTitle"></span>"?</p>
            <div class="mt-4 flex justify-end">
                <button @click="showDeleteModal = false" class="mr-2 px-4 py-2 bg-gray-300 rounded-md">Cancel</button>
                <button wire:click="deleteSermon(currentSermonId)" class="px-4 py-2 bg-red-600 text-white rounded-md">Delete</button>
            </div>
        </div>
    </div>

    <!-- Feature Confirmation Modal -->
    <div x-show="showFeatureModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg p-6">
            <h3 class="text-lg font-bold">Feature Sermon</h3>
            <p class="mt-2">Are you sure you want to feature the sermon titled "<span x-text="currentSermonTitle"></span>"?</p>
            <div class="mt-4 flex justify-end">
                <button @click="showFeatureModal = false" class="mr-2 px-4 py-2 bg-gray-300 rounded-md">Cancel</button>
                <button wire:click="featureSermon(currentSermonId)" class="px-4 py-2 bg-green-600 text-white rounded-md">Feature</button>
            </div>
        </div>
    </div>
</div>