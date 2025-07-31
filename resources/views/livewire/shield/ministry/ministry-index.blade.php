<div class="p-4 sm:p-6 lg:p-8">
    <div class="mx-auto max-w-7xl">

        {{-- Header --}}
        <div class="mb-8 md:flex md:items-center md:justify-between">
            <div class="flex-1 min-w-0">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 dark:text-white sm:text-3xl sm:truncate">
                    Ministries
                </h2>
            </div>
            <div class="flex mt-4 md:mt-0 md:ml-4">
                <a href="{{ route(config('app.admin_prefix') . '.ministry.create') }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-gray-800">
                    <svg class="w-5 h-5 mr-2 -ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                        fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Add Ministry
                </a>
            </div>
        </div>

        {{-- Filters and Search --}}
        <div class="p-4 mb-6 bg-white rounded-lg shadow-sm dark:bg-gray-800">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-3 lg:grid-cols-4">
                <div class="lg:col-span-2">
                    <label for="search" class="sr-only">Search</label>
                    <input type="text" wire:model.debounce.300ms="search" id="search"
                        placeholder="Search by name or description..."
                        class="w-full px-4 py-2 text-gray-900 transition bg-white border-gray-300 rounded-lg dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="leaderFilter" class="sr-only">Filter by Leader</label>
                    <select wire:model="leaderFilter" id="leaderFilter"
                        class="w-full px-4 py-2 text-gray-900 transition bg-white border-gray-300 rounded-lg appearance-none dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">All Leaders</option>
                        @foreach($leaders as $leader)
                        <option value="{{ $leader->id }}">{{ $leader->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <button wire:click="resetFilters"
                        class="w-full px-4 py-2 font-medium text-gray-800 transition bg-gray-200 rounded-lg shadow-sm dark:bg-gray-600 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-500">
                        Reset
                    </button>
                </div>
            </div>
        </div>

        {{-- Flash Messages --}}
        @if (session()->has('message'))
        <div
            class="p-4 mb-4 text-green-700 bg-green-100 border border-green-400 rounded-lg dark:bg-green-900/50 dark:border-green-600 dark:text-green-300">
            {{ session('message') }}
        </div>
        @endif
        @if (session()->has('error'))
        <div
            class="p-4 mb-4 text-red-700 bg-red-100 border border-red-400 rounded-lg dark:bg-red-900/50 dark:border-red-600 dark:text-red-300">
            {{ session('error') }}
        </div>
        @endif

        {{-- Ministries Grid --}}
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            @forelse($ministries as $ministry)
            <div wire:key="{{ $ministry->id }}"
                class="flex flex-col overflow-hidden transition-all duration-300 transform bg-white shadow-lg dark:bg-gray-800 rounded-xl hover:-translate-y-1">
                <a href="{{ route(config('app.admin_prefix') . '.ministry.edit', $ministry->id) }}">
                    <img class="object-cover w-full h-48" src="{{ $ministry->primary_image_url }}"
                        alt="Image of {{ $ministry->name }}">
                </a>
                <div class="flex flex-col flex-grow p-6">
                    <h3 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white">{{ $ministry->name }}</h3>
                    <p class="flex-grow text-sm text-gray-600 dark:text-gray-400">
                        {{ Str::limit($ministry->description, 100) }}
                    </p>
                    <div class="mt-4">
                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400">LEADER</span>
                        <p class="text-sm font-semibold text-gray-800 dark:text-gray-200">{{ $ministry->leader->name ??
                            'Not Assigned' }}</p>
                    </div>
                </div>
                <div
                    class="flex items-center justify-end p-4 space-x-3 border-t border-gray-200 bg-gray-50 dark:bg-gray-800/50 dark:border-gray-700">
                    <a href="{{ route(config('app.admin_prefix') . '.ministry.edit', $ministry->id) }}"
                        class="font-medium text-blue-600 transition hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">Edit</a>
                    <button wire:click="confirmDelete({{ $ministry->id }})"
                        class="font-medium text-red-600 transition hover:text-red-800 dark:text-red-500 dark:hover:text-red-400">Delete</button>
                </div>
            </div>
            @empty
            <div class="col-span-1 py-12 text-center lg:col-span-3 md:col-span-2">
                <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    aria-hidden="true">
                    <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No ministries found</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Get started by creating a new ministry.
                </p>
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="mt-8">
            {{ $ministries->links() }}
        </div>
    </div>

    {{-- Deletion Confirmation Modal --}}
    @if($confirmingDeletion)
    <div x-data="{ open: @entangle('confirmingDeletion') }" x-show="open" @keydown.window.escape="open = false"
        class="fixed inset-0 z-10 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"
                aria-hidden="true"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div x-show="open" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-800 sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="px-4 pt-5 pb-4 bg-white dark:bg-gray-800 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-red-100 rounded-full dark:bg-red-900/50 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="w-6 h-6 text-red-600 dark:text-red-400" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white" id="modal-title">
                                Delete Ministry
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Are you sure you want to delete <strong>{{ $ministryToDelete->name ?? ''
                                        }}</strong>? All associated data and images will be permanently removed. This
                                    action cannot be undone.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 bg-gray-50 dark:bg-gray-800/50 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button wire:click="deleteMinistry" type="button"
                        class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Delete
                    </button>
                    <button @click="open = false" type="button"
                        class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
