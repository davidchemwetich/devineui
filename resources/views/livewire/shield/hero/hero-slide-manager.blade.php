<div x-data="{
    showNotification: false,
    notificationType: 'success',
    notificationMessage: '',
    showNotification(type, message) {
        this.notificationType = type;
        this.notificationMessage = message;
        this.showNotification = true;
        setTimeout(() => this.showNotification = false, 5000);
    }
}" class="min-h-screen text-gray-800 bg-gray-50 dark:bg-slate-900 dark:text-gray-200">

    <div x-show="showNotification" x-transition:enter="transform ease-out duration-300 transition"
        x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
        x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
        x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed z-50 w-full max-w-sm rounded-lg shadow-lg pointer-events-auto top-5 right-5" :class="{
            'bg-green-500 border-green-600': notificationType === 'success',
            'bg-red-500 border-red-600': notificationType === 'error'
        }">
        <div class="p-4 rounded-lg shadow-xs">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg x-show="notificationType === 'success'" class="w-6 h-6 text-white" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <svg x-show="notificationType === 'error'" class="w-6 h-6 text-white" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-3 w-0 flex-1 pt-0.5">
                    <p class="font-semibold text-white" x-text="notificationMessage"></p>
                </div>
                <div class="flex flex-shrink-0 ml-4">
                    <button @click="showNotification = false"
                        class="inline-flex text-white transition duration-150 ease-in-out">
                        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="container px-4 py-8 mx-auto sm:px-6 lg:px-8">
        <div class="mb-8">
            <div class="flex flex-col items-start justify-between gap-4 md:flex-row md:items-center">
                <div>
                    <h1 class="mb-1 text-4xl font-bold text-gray-900 dark:text-white">
                        <span class="text-transparent bg-gradient-to-r from-blue-500 to-purple-500 bg-clip-text">
                            Hero Slides
                        </span>
                    </h1>
                    <p class="text-lg text-gray-500 dark:text-gray-400">Manage your church's hero slides and showcase
                        content</p>
                </div>
                <button wire:click="createSlide"
                    class="inline-flex items-center justify-center px-6 py-3 font-semibold text-white transition-all duration-200 transform shadow-lg bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl hover:shadow-xl hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 dark:focus:ring-offset-slate-900">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                        </path>
                    </svg>
                    Add New Slide
                </button>
            </div>
        </div>

        @if(!$showForm)
        <div
            class="p-6 mb-8 bg-white border border-gray-200 shadow-sm dark:bg-slate-800 dark:border-slate-700 rounded-2xl">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-4">
                <div class="md:col-span-2">
                    <label for="search"
                        class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input wire:model.live.debounce.300ms="search" id="search" type="text"
                            placeholder="Search slides by title..."
                            class="w-full py-2 pl-10 pr-4 text-gray-900 bg-white border border-gray-300 rounded-lg dark:bg-slate-700 dark:border-slate-600 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <div>
                    <label for="filterType"
                        class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Media Type</label>
                    <select wire:model.live="filterType" id="filterType"
                        class="w-full px-3 py-2 text-gray-900 bg-white border border-gray-300 rounded-lg dark:bg-slate-700 dark:border-slate-600 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">All Types</option>
                        <option value="image">Images</option>
                        <option value="video">Videos</option>
                    </select>
                </div>

                <div>
                    <label for="filterStatus"
                        class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                    <select wire:model.live="filterStatus" id="filterStatus"
                        class="w-full px-3 py-2 text-gray-900 bg-white border border-gray-300 rounded-lg dark:bg-slate-700 dark:border-slate-600 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">All Statuses</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="relative">
            <div wire:loading.flex wire:target="search, filterType, filterStatus, nextPage, previousPage, gotoPage"
                class="absolute inset-0 z-10 items-center justify-center bg-white/70 dark:bg-slate-900/70 rounded-2xl">
                <svg class="w-10 h-10 text-blue-600 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
            </div>

            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                @forelse($slides as $slide)
                <div wire:key="{{ $slide->id }}"
                    class="overflow-hidden transition-all duration-300 bg-white border border-transparent shadow-lg dark:bg-slate-800 dark:border-slate-700 rounded-2xl hover:shadow-xl hover:border-blue-500 dark:hover:border-blue-500 group">
                    <div class="relative h-56 overflow-hidden">
                        @if($slide->media_type === 'image')
                        <img src="{{ $slide->media_url }}" alt="{{ $slide->title }}"
                            class="object-cover w-full h-full transition-transform duration-500 ease-in-out group-hover:scale-105">
                        @else
                        <video class="object-cover w-full h-full" muted loop controls>
                            <source src="{{ $slide->media_url }}" type="{{ $slide->getMediaMimeType() }}">
                        </video>
                        @endif

                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>

                        <div class="absolute top-4 left-4">
                            @if($slide->is_active)
                            <span
                                class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-300">
                                <span class="w-2 h-2 mr-1.5 bg-green-400 rounded-full"></span>
                                Active
                            </span>
                            @else
                            <span
                                class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-300">
                                <span class="w-2 h-2 mr-1.5 bg-red-400 rounded-full"></span>
                                Inactive
                            </span>
                            @endif
                        </div>
                        <div class="absolute top-4 right-4">
                            <span
                                class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/50 dark:text-blue-300">
                                @if($slide->media_type === 'image')
                                <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Image
                                @else
                                <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z">
                                    </path>
                                </svg>
                                Video
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="p-6">
                        <h3 class="mb-2 text-xl font-bold text-gray-900 dark:text-white line-clamp-2"
                            title="{{ $slide->title }}">
                            {{ $slide->title ?: 'Untitled Slide' }}
                        </h3>

                        <div class="flex items-center mb-6 text-sm text-gray-500 dark:text-gray-400">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            Created on {{ $slide->created_at->format('M d, Y') }}
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex space-x-2">
                                <button wire:click="editSlide({{ $slide->id }})"
                                    class="p-2 text-blue-600 transition-colors bg-blue-100 rounded-full dark:bg-slate-700 dark:text-blue-400 hover:bg-blue-200 dark:hover:bg-slate-600"
                                    title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                </button>
                                <button wire:click="toggleStatus({{ $slide->id }})" wire:loading.attr="disabled"
                                    class="p-2 transition-colors rounded-full"
                                    title="{{ $slide->is_active ? 'Deactivate' : 'Activate' }}"
                                    class="{{ $slide->is_active ? 'bg-yellow-100 text-yellow-600 dark:bg-slate-700 dark:text-yellow-400 hover:bg-yellow-200 dark:hover:bg-slate-600' : 'bg-green-100 text-green-600 dark:bg-slate-700 dark:text-green-400 hover:bg-green-200 dark:hover:bg-slate-600' }}">
                                    <span wire:loading.remove wire:target="toggleStatus({{ $slide->id }})">
                                        @if($slide->is_active)
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a9.97 9.97 0 01-1.563 3.029m-2.245-2.245A3 3 0 0015 12a3 3 0 00-3-3m-3.878-3.878L3 3z">
                                            </path>
                                        </svg>
                                        @else
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                        @endif
                                    </span>
                                    <svg wire:loading wire:target="toggleStatus({{ $slide->id }})"
                                        class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                            stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                </button>
                            </div>

                            <button wire:click="confirmDelete({{ $slide->id }})"
                                class="p-2 text-red-600 transition-colors bg-red-100 rounded-full dark:bg-slate-700 dark:text-red-400 hover:bg-red-200 dark:hover:bg-slate-600"
                                title="Delete">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full">
                    <div
                        class="py-24 text-center bg-white border-2 border-gray-300 border-dashed dark:bg-slate-800 dark:border-slate-700 rounded-2xl">
                        <svg class="w-24 h-24 mx-auto text-gray-300 dark:text-slate-600" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">No slides found</h3>
                        <p class="mt-2 text-gray-500 dark:text-gray-400">Get started by creating your first hero slide.
                        </p>
                        <button wire:click="createSlide"
                            class="inline-flex items-center px-4 py-2 mt-6 font-semibold text-white transition-colors bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-offset-slate-900">
                            <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Create Hero Slide
                        </button>
                    </div>
                </div>
                @endforelse
            </div>
        </div>

        @if($slides->hasPages())
        <div class="flex justify-center mt-12">
            {{ $slides->links() }}
        </div>
        @endif
        @endif

        @if($showForm)
        <div class="fixed inset-0 z-50 overflow-y-auto" x-data="{ show: @entangle('showForm') }" x-show="show"
            x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity bg-gray-500/75 dark:bg-black/75"
                    @click="$wire.closeForm()"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div class="inline-block w-full max-w-4xl my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-2xl dark:bg-slate-800 rounded-2xl"
                    x-show="show" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                    <div class="px-6 py-4 bg-gradient-to-r from-blue-600 to-purple-600">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-white">
                                {{ $isEditing ? 'Edit Hero Slide' : 'Create New Hero Slide' }}
                            </h3>
                            <button wire:click="closeForm" class="text-white transition-colors hover:text-gray-200">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="p-6 border-b border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-800/50">
                        <div class="flex items-center">
                            @foreach(['Media Type', 'Upload Media', 'Details & Save'] as $step => $title)
                            @php $step = $step + 1; @endphp
                            <div
                                class="flex items-center {{ $step <= $currentStep ? 'text-blue-600 dark:text-blue-400' : 'text-gray-500 dark:text-gray-400' }}">
                                <div
                                    class="flex items-center justify-center w-10 h-10 border-2 rounded-full {{ $step <= $currentStep ? 'border-blue-600 dark:border-blue-400' : 'border-gray-300 dark:border-slate-600' }}">
                                    @if($step < $currentStep) <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path></svg>
                                        @else
                                        <span class="text-lg">{{ $step }}</span>
                                        @endif
                                </div>
                                <span class="ml-4 font-semibold">{{ $title }}</span>
                            </div>
                            @if(!$loop->last)
                            <div
                                class="flex-auto mx-4 h-0.5 {{ $step < $currentStep ? 'bg-blue-600 dark:bg-blue-400' : 'bg-gray-300 dark:bg-slate-600' }}">
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="px-8 py-8">
                        <form wire:submit.prevent="save">
                            @if($currentStep === 1)
                            <div>
                                <h4 class="mb-1 text-lg font-semibold text-gray-900 dark:text-white">Choose Media Type
                                </h4>
                                <p class="mb-6 text-gray-500 dark:text-gray-400">Select whether you want to upload an
                                    image or a video.</p>
                                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                                    <label class="relative cursor-pointer">
                                        <input type="radio" wire:model.live="media_type" value="image" class="sr-only">
                                        <div
                                            class="p-6 text-center border-2 rounded-xl transition-all {{ $media_type === 'image' ? 'border-blue-500 bg-blue-50 dark:bg-slate-700' : 'border-gray-200 dark:border-slate-700 hover:border-gray-300 dark:hover:border-slate-600' }}">
                                            <div
                                                class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-blue-100 rounded-full dark:bg-slate-600">
                                                <svg class="w-8 h-8 text-blue-600 dark:text-blue-400"
                                                    fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <h5 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Image
                                            </h5>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">JPEG, PNG, GIF, or WebP
                                            </p>
                                        </div>
                                    </label>
                                    <label class="relative cursor-pointer">
                                        <input type="radio" wire:model.live="media_type" value="video" class="sr-only">
                                        <div
                                            class="p-6 text-center border-2 rounded-xl transition-all {{ $media_type === 'video' ? 'border-blue-500 bg-blue-50 dark:bg-slate-700' : 'border-gray-200 dark:border-slate-700 hover:border-gray-300 dark:hover:border-slate-600' }}">
                                            <div
                                                class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-purple-100 rounded-full dark:bg-slate-600">
                                                <svg class="w-8 h-8 text-purple-600 dark:text-purple-400"
                                                    fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z" />
                                                </svg>
                                            </div>
                                            <h5 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Video
                                            </h5>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">MP4, WebM, or OGG videos
                                            </p>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            @endif

                            @if($currentStep === 2)
                            <div>
                                <h4 class="mb-1 text-lg font-semibold text-gray-900 dark:text-white">Upload {{
                                    ucfirst($media_type) }}</h4>
                                <p class="mb-6 text-gray-500 dark:text-gray-400">Drag & drop your file or click to
                                    browse.</p>

                                @if($isEditing && $current_media_path && !$media_file)
                                <div
                                    class="p-4 mb-6 border border-blue-200 rounded-lg bg-blue-50 dark:bg-slate-700 dark:border-blue-500/50">
                                    <p class="mb-2 text-sm font-medium text-blue-800 dark:text-blue-300">Current {{
                                        $media_type }}:</p>
                                    @if($media_type === 'image')
                                    <img src="{{ Storage::disk('public')->url($current_media_path) }}"
                                        alt="Current slide" class="object-cover h-32 max-w-xs rounded-lg">
                                    @else
                                    <video controls class="h-32 max-w-xs rounded-lg">
                                        <source src="{{ Storage::disk('public')->url($current_media_path) }}">
                                    </video>
                                    @endif
                                    <p class="mt-2 text-xs text-blue-600 dark:text-blue-400">To replace this, upload a
                                        new file below.</p>
                                </div>
                                @endif

                                <div class="p-8 text-center border-2 border-gray-300 border-dashed dark:border-slate-600 rounded-xl"
                                    x-data="{ dragOver: false }" @dragover.prevent="dragOver = true"
                                    @dragleave.prevent="dragOver = false"
                                    @drop.prevent="dragOver = false; $wire.upload('media_file', $event.dataTransfer.files[0])"
                                    :class="{ 'border-blue-500 bg-blue-50 dark:bg-slate-700': dragOver }">

                                    <div wire:loading.flex wire:target="media_file"
                                        class="items-center justify-center text-center">
                                        <svg class="w-10 h-10 mr-3 -ml-1 text-blue-600 animate-spin" fill="none"
                                            viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                            </path>
                                        </svg>
                                        <span
                                            class="text-lg font-medium text-gray-600 dark:text-gray-300">Uploading...</span>
                                    </div>

                                    <div wire:loading.remove wire:target="media_file">
                                        @if($media_file)
                                        <div class="mb-4">
                                            @if($media_type === 'image' && str_starts_with($media_file->getMimeType(),
                                            'image'))
                                            <img src="{{ $media_file->temporaryUrl() }}" alt="Preview"
                                                class="object-cover h-32 max-w-xs mx-auto rounded-lg">
                                            @else
                                            <div
                                                class="flex items-center justify-center w-32 h-32 mx-auto bg-gray-100 rounded-lg dark:bg-slate-700">
                                                <svg class="w-12 h-12 text-gray-400" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path
                                                        d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z" />
                                                </svg>
                                            </div>
                                            @endif
                                            <p class="mt-2 text-sm font-medium text-green-600 dark:text-green-400">{{
                                                $media_file->getClientOriginalName() }}</p>
                                        </div>
                                        @else
                                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-400 dark:text-slate-500"
                                            stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path
                                                d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        @endif

                                        <label for="media_upload"
                                            class="relative font-semibold text-blue-600 cursor-pointer dark:text-blue-400 hover:text-blue-500">
                                            <span>{{ $media_file ? 'Change File' : 'Upload a file' }}</span>
                                            <span class="text-gray-600 dark:text-gray-400"> or drag and drop</span>
                                            <input id="media_upload" type="file" wire:model="media_file" class="sr-only"
                                                accept="{{ $media_type === 'image' ? 'image/*' : 'video/*' }}">
                                        </label>
                                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                            @if($media_type === 'image')
                                            JPEG, PNG, GIF, WebP up to 10MB
                                            @else
                                            MP4, WebM, OGG up to 50MB
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                @error('media_file') <span class="mt-2 text-sm text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            @endif

                            @if($currentStep === 3)
                            <div>
                                <h4 class="mb-1 text-lg font-semibold text-gray-900 dark:text-white">Slide Details</h4>
                                <p class="mb-6 text-gray-500 dark:text-gray-400">Provide a title and set the visibility
                                    for your slide.</p>
                                <div class="space-y-6">
                                    <div>
                                        <label for="title"
                                            class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Title
                                            (Optional)</label>
                                        <input type="text" id="title" wire:model="title"
                                            class="block w-full mt-1 text-gray-900 bg-white border-gray-300 rounded-lg shadow-sm dark:bg-slate-700 dark:border-slate-600 dark:text-white focus:border-blue-500 focus:ring-blue-500"
                                            placeholder="e.g., Sunday Service Announcement">
                                    </div>
                                    <div class="relative flex items-start">
                                        <div class="flex items-center h-5">
                                            <input type="checkbox" id="is_active" wire:model="is_active"
                                                class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <label for="is_active"
                                                class="font-medium text-gray-900 dark:text-white">Active</label>
                                            <p class="text-gray-500 dark:text-gray-400">Make this slide visible on the
                                                website immediately.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <div
                                class="flex items-center justify-between pt-6 mt-8 border-t border-gray-200 dark:border-slate-700">
                                <div>
                                    @if($currentStep > 1)
                                    <button type="button" wire:click="previousStep"
                                        class="px-4 py-2 font-medium text-gray-700 transition-colors bg-gray-100 border border-transparent rounded-lg dark:bg-slate-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-slate-600">
                                        Previous
                                    </button>
                                    @endif
                                </div>
                                <div class="flex items-center space-x-3">
                                    <button type="button" wire:click="closeForm"
                                        class="px-4 py-2 font-medium text-gray-700 transition-colors bg-white border border-gray-300 rounded-lg dark:bg-slate-800 dark:border-slate-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-slate-700">
                                        Cancel
                                    </button>
                                    @if($currentStep < 3) <button type="button" wire:click="nextStep"
                                        class="inline-flex items-center px-4 py-2 font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        Next
                                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                        </button>
                                        @else
                                        <button type="submit" wire:loading.attr="disabled"
                                            class="inline-flex items-center justify-center px-6 py-2 font-semibold text-white transition-all duration-200 transform rounded-lg bg-gradient-to-r from-blue-600 to-purple-600 hover:shadow-lg hover:scale-105 disabled:opacity-75 disabled:scale-100">
                                            <svg wire:loading wire:target="save"
                                                class="w-5 h-5 mr-3 -ml-1 text-white animate-spin" fill="none"
                                                viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                    stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor"
                                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                                </path>
                                            </svg>
                                            <span wire:loading.remove wire:target="save">
                                                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </span>
                                            <span wire:loading wire:target="save">{{ $isEditing ? 'Updating Slide...' :
                                                'Creating Slide...' }}</span>
                                            <span wire:loading.remove wire:target="save">{{ $isEditing ? 'Update Slide'
                                                : 'Create Slide' }}</span>
                                        </button>
                                        @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if($showDeleteModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" x-data="{}"
            x-init="$watch('$wire.showDeleteModal', value => { if (value) { document.body.classList.add('overflow-y-hidden') } else { document.body.classList.remove('overflow-y-hidden') } })">
            <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity bg-gray-500/75 dark:bg-black/75"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                <div
                    class="inline-block w-full max-w-lg p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl dark:bg-slate-800 rounded-2xl">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-red-100 rounded-full dark:bg-red-900/50 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg font-semibold leading-6 text-gray-900 dark:text-white">Delete Hero Slide
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    Are you sure you want to delete this hero slide? This action cannot be undone and
                                    will permanently remove the slide and its media file.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                        <button wire:click="deleteSlide" wire:loading.attr="disabled"
                            class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm disabled:opacity-50">
                            <svg wire:loading wire:target="deleteSlide"
                                class="w-5 h-5 mr-3 -ml-1 text-white animate-spin" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            <span wire:loading wire:target="deleteSlide">Deleting...</span>
                            <span wire:loading.remove wire:target="deleteSlide">Delete</span>
                        </button>
                        <button wire:click="closeDeleteModal" type="button"
                            class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm dark:bg-slate-700 dark:text-gray-300 dark:border-slate-600 hover:bg-gray-50 dark:hover:bg-slate-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <script>
            document.addEventListener('livewire:init', () => {
            // Use the component's internal x-data context to show notifications
            Livewire.on('notify', (event) => {
                const data = event[0];
                const notificationComponent = document.querySelector('[x-data*="showNotification"]');
                if (notificationComponent) {
                    const alpineScope = Alpine.$data(notificationComponent);
                    alpineScope.showNotification(data.type, data.message);
                }
            });
        });
        </script>
    </div>
