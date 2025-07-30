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
}" class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50">

    <!-- Notification Toast -->
    <div x-show="showNotification" x-transition:enter="transform ease-out duration-300 transition"
        x-transition:enter-start="translate-y-2 opacity-0" x-transition:enter-end="translate-y-0 opacity-100"
        x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" :class="{
             'border-green-200 bg-green-50 text-green-800': notificationType === 'success',
             'border-red-200 bg-red-50 text-red-800': notificationType === 'error'
         }" class="fixed z-50 max-w-sm p-4 border-l-4 rounded-lg shadow-lg top-4 right-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg x-show="notificationType === 'success'" class="w-5 h-5 text-green-400" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
                <svg x-show="notificationType === 'error'" class="w-5 h-5 text-red-400" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium" x-text="notificationMessage"></p>
            </div>
            <div class="pl-3 ml-auto">
                <button @click="showNotification = false"
                    class="inline-flex rounded-md p-1.5 hover:bg-gray-100 focus:outline-none">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container px-4 py-8 mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="mb-2 text-4xl font-bold text-gray-900">
                        <span class="text-transparent bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text">
                            Hero Slides
                        </span>
                    </h1>
                    <p class="text-gray-600">Manage your church's hero slides and showcase content</p>
                </div>
                <button wire:click="createSlide"
                    class="inline-flex items-center px-6 py-3 font-semibold text-white transition-all duration-200 transform shadow-lg bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl hover:shadow-xl hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add New Slide
                </button>
            </div>
        </div>

        @if(!$showForm)
        <!-- Filters and Search -->
        <div class="p-6 mb-8 bg-white border border-gray-100 shadow-sm rounded-2xl">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Search</label>
                    <div class="relative">
                        <input wire:model.live="search" type="text" placeholder="Search slides..."
                            class="w-full py-2 pl-10 pr-4 transition-colors border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Media Type</label>
                    <select wire:model.live="filterType"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">All Types</option>
                        <option value="image">Images</option>
                        <option value="video">Videos</option>
                    </select>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700">Status</label>
                    <select wire:model.live="filterStatus"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">All Status</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>

                <div class="flex items-end">
                    <button wire:click="resetFilters"
                        class="w-full px-4 py-2 text-gray-700 transition-colors bg-gray-100 rounded-lg hover:bg-gray-200">
                        Reset Filters
                    </button>
                </div>
            </div>
        </div>

        <!-- Slides Grid -->
        <div class="grid grid-cols-1 gap-8 mb-8 md:grid-cols-2 lg:grid-cols-3">
            @forelse($slides as $slide)
            <div
                class="overflow-hidden transition-all duration-300 bg-white shadow-lg rounded-2xl hover:shadow-xl group">
                <!-- Media Preview -->
                <div class="relative h-48 overflow-hidden">
                    @if($slide->media_type === 'image')
                    <img src="{{ $slide->media_url }}" alt="{{ $slide->title }}"
                        class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-105">
                    @else
                    <video class="object-cover w-full h-full" controls>
                        <source src="{{ $slide->media_url }}" type="{{ $slide->getMediaMimeType() }}">
                    </video>
                    @endif

                    <!-- Status Badge -->
                    <div class="absolute top-3 left-3">
                        @if($slide->is_active)
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <span class="w-2 h-2 mr-1 bg-green-400 rounded-full"></span>
                            Active
                        </span>
                        @else
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            <span class="w-2 h-2 mr-1 bg-red-400 rounded-full"></span>
                            Inactive
                        </span>
                        @endif
                    </div>

                    <!-- Media Type Badge -->
                    <div class="absolute top-3 right-3">
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            @if($slide->media_type === 'image')
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                    clip-rule="evenodd" />
                            </svg>
                            Image
                            @else
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z" />
                            </svg>
                            Video
                            @endif
                        </span>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-6">
                    <h3 class="mb-2 text-lg font-semibold text-gray-900 line-clamp-2">
                        {{ $slide->title ?: 'Untitled Slide' }}
                    </h3>

                    <div class="flex items-center mb-4 text-sm text-gray-500">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ $slide->created_at->format('M d, Y') }}
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-between">
                        <div class="flex space-x-2">
                            <button wire:click="editSlide({{ $slide->id }})"
                                class="inline-flex items-center px-3 py-1.5 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </button>

                            <button wire:click="toggleStatus({{ $slide->id }})"
                                class="inline-flex items-center px-3 py-1.5 {{ $slide->is_active ? 'bg-yellow-100 text-yellow-700 hover:bg-yellow-200' : 'bg-green-100 text-green-700 hover:bg-green-200' }} rounded-lg transition-colors">
                                @if($slide->is_active)
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L5.636 5.636" />
                                </svg>
                                Hide
                                @else
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                Show
                                @endif
                            </button>
                        </div>

                        <button wire:click="confirmDelete({{ $slide->id }})"
                            class="inline-flex items-center px-3 py-1.5 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Delete
                        </button>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full">
                <div class="py-16 text-center">
                    <svg class="w-24 h-24 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">No slides found</h3>
                    <p class="mt-2 text-gray-500">Get started by creating your first hero slide</p>
                    <button wire:click="createSlide"
                        class="inline-flex items-center px-4 py-2 mt-6 text-white transition-colors bg-blue-600 rounded-lg hover:bg-blue-700">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Create Hero Slide
                    </button>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($slides->links())
        <div class="flex justify-center">
            {{ $slides->links() }}
        </div>
        @endif
        @endif

        <!-- Stepper Form Modal -->
        @if($showForm)
        <div class="fixed inset-0 z-50 overflow-y-auto" x-data="{ show: @entangle('showForm') }">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" @click="$wire.closeForm()">
                </div>

                <!-- Modal panel -->
                <div
                    class="inline-block w-full max-w-4xl my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-2xl rounded-2xl">
                    <!-- Header -->
                    <div class="px-6 py-4 bg-gradient-to-r from-blue-600 to-purple-600">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-white">
                                {{ $isEditing ? 'Edit Hero Slide' : 'Create New Hero Slide' }}
                            </h3>
                            <button wire:click="closeForm" class="text-white transition-colors hover:text-gray-200">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Stepper Navigation -->
                    <div class="px-6 py-4 border-b bg-gray-50">
                        <nav aria-label="Progress">
                            <ol class="flex items-center">
                                <li class="relative pr-8 sm:pr-20">
                                    <button wire:click="goToStep(1)" class="absolute inset-0 flex items-center">
                                        <div
                                            class="h-8 w-8 rounded-full {{ $currentStep >= 1 ? 'bg-blue-600' : 'bg-gray-300' }} flex items-center justify-center">
                                            <span class="text-sm font-medium text-white">1</span>
                                        </div>
                                    </button>
                                    <div class="absolute top-0 right-0 w-5 h-full">
                                        <svg class="w-full h-full text-gray-300" viewBox="0 0 22 80" fill="none"
                                            preserveAspectRatio="none">
                                            <path d="M0 -2L20 40L0 82" vector-effect="non-scaling-stroke"
                                                stroke="currentcolor" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                    <span
                                        class="absolute top-2.5 left-10 text-xs font-medium {{ $currentStep >= 1 ? 'text-blue-600' : 'text-gray-500' }}">Media
                                        Type</span>
                                </li>

                                <li class="relative pr-8 sm:pr-20">
                                    <button wire:click="goToStep(2)" class="absolute inset-0 flex items-center">
                                        <div
                                            class="h-8 w-8 rounded-full {{ $currentStep >= 2 ? 'bg-blue-600' : 'bg-gray-300' }} flex items-center justify-center">
                                            <span class="text-sm font-medium text-white">2</span>
                                        </div>
                                    </button>
                                    <div class="absolute top-0 right-0 w-5 h-full">
                                        <svg class="w-full h-full text-gray-300" viewBox="0 0 22 80" fill="none"
                                            preserveAspectRatio="none">
                                            <path d="M0 -2L20 40L0 82" vector-effect="non-scaling-stroke"
                                                stroke="currentcolor" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                    <span
                                        class="absolute top-2.5 left-10 text-xs font-medium {{ $currentStep >= 2 ? 'text-blue-600' : 'text-gray-500' }}">Upload
                                        Media</span>
                                </li>

                                <li class="relative">
                                    <button wire:click="goToStep(3)" class="absolute inset-0 flex items-center">
                                        <div
                                            class="h-8 w-8 rounded-full {{ $currentStep >= 3 ? 'bg-blue-600' : 'bg-gray-300' }} flex items-center justify-center">
                                            <span class="text-sm font-medium text-white">3</span>
                                        </div>
                                    </button>
                                    <span
                                        class="absolute top-2.5 left-10 text-xs font-medium {{ $currentStep >= 3 ? 'text-blue-600' : 'text-gray-500' }}">Details
                                        & Save</span>
                                </li>
                            </ol>
                        </nav>
                    </div>

                    <!-- Form Content -->
                    <div class="px-6 py-6">
                        <form wire:submit.prevent="save">
                            <!-- Step 1: Media Type -->
                            @if($currentStep === 1)
                            <div class="space-y-6">
                                <div>
                                    <h4 class="mb-4 text-lg font-medium text-gray-900">Choose Media Type</h4>
                                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                                        <label class="relative cursor-pointer">
                                            <input type="radio" wire:model="media_type" value="image" class="sr-only">
                                            <div
                                                class="p-6 border-2 rounded-xl transition-all {{ $media_type === 'image' ? 'border-blue-500 bg-blue-50' : 'border-gray-200 hover:border-gray-300' }}">
                                                <div class="flex flex-col items-center text-center">
                                                    <div
                                                        class="flex items-center justify-center w-16 h-16 mb-4 bg-blue-100 rounded-full">
                                                        <svg class="w-8 h-8 text-blue-600" fill="currentColor"
                                                            viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </div>
                                                    <h5 class="mb-2 font-semibold text-gray-900">Image</h5>
                                                    <p class="text-sm text-gray-600">Upload JPEG, PNG, GIF, or WebP
                                                        images</p>
                                                </div>
                                            </div>
                                        </label>

                                        <label class="relative cursor-pointer">
                                            <input type="radio" wire:model="media_type" value="video" class="sr-only">
                                            <div
                                                class="p-6 border-2 rounded-xl transition-all {{ $media_type === 'video' ? 'border-blue-500 bg-blue-50' : 'border-gray-200 hover:border-gray-300' }}">
                                                <div class="flex flex-col items-center text-center">
                                                    <div
                                                        class="flex items-center justify-center w-16 h-16 mb-4 bg-purple-100 rounded-full">
                                                        <svg class="w-8 h-8 text-purple-600" fill="currentColor"
                                                            viewBox="0 0 20 20">
                                                            <path
                                                                d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z" />
                                                        </svg>
                                                    </div>
                                                    <h5 class="mb-2 font-semibold text-gray-900">Video</h5>
                                                    <p class="text-sm text-gray-600">Upload MP4, WebM, or OGG videos</p>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                    @error('media_type') <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            @endif

                            <!-- Step 2: Upload Media -->
                            @if($currentStep === 2)
                            <div class="space-y-6">
                                <div>
                                    <h4 class="mb-4 text-lg font-medium text-gray-900">
                                        Upload {{ ucfirst($media_type) }}
                                    </h4>

                                    @if($isEditing && $current_media_path && !$media_file)
                                    <div class="p-4 mb-6 border border-blue-200 rounded-lg bg-blue-50">
                                        <p class="mb-2 text-sm text-blue-800">Current {{ $media_type }}:</p>
                                        @if($media_type === 'image')
                                        <img src="{{ Storage::disk('public')->url($current_media_path) }}"
                                            alt="Current slide" class="object-cover h-32 max-w-xs rounded-lg">
                                        @else
                                        <video controls class="h-32 max-w-xs rounded-lg">
                                            <source src="{{ Storage::disk('public')->url($current_media_path) }}">
                                        </video>
                                        @endif
                                        <p class="mt-2 text-xs text-blue-600">Upload a new file to replace the current
                                            one</p>
                                    </div>
                                    @endif

                                    <div class="p-8 border-2 border-gray-300 border-dashed rounded-xl"
                                        x-data="{ dragOver: false }" @dragover.prevent="dragOver = true"
                                        @dragleave.prevent="dragOver = false"
                                        @drop.prevent="dragOver = false; $wire.set('media_file', $event.dataTransfer.files[0])"
                                        :class="{ 'border-blue-500 bg-blue-50': dragOver }">

                                        <div class="text-center">
                                            @if($media_file)
                                            <div class="mb-4">
                                                @if($media_type === 'image')
                                                <img src="{{ $media_file->temporaryUrl() }}" alt="Preview"
                                                    class="object-cover h-32 max-w-xs mx-auto rounded-lg">
                                                @else
                                                <div
                                                    class="flex items-center justify-center w-32 h-32 mx-auto bg-gray-100 rounded-lg">
                                                    <svg class="w-12 h-12 text-gray-400" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path
                                                            d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z" />
                                                    </svg>
                                                </div>
                                                @endif
                                                <p class="text-sm font-medium text-green-600">{{
                                                    $media_file->getClientOriginalName() }}</p>
                                            </div>
                                            @else
                                            <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" stroke="currentColor"
                                                fill="none" viewBox="0 0 48 48">
                                                <path
                                                    d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            @endif

                                            <div class="space-y-2">
                                                <div>
                                                    <label for="media_upload" class="cursor-pointer">
                                                        <span
                                                            class="inline-flex items-center px-4 py-2 text-white transition-colors bg-blue-600 rounded-lg hover:bg-blue-700">
                                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                            </svg>
                                                            {{ $media_file ? 'Change File' : 'Upload File' }}
                                                        </span>
                                                        <input id="media_upload" type="file" wire:model="media_file"
                                                            class="sr-only"
                                                            accept="{{ $media_type === 'image' ? 'image/*' : 'video/*' }}">
                                                    </label>
                                                </div>
                                                <p class="text-xs text-gray-500">
                                                    @if($media_type === 'image')
                                                    JPEG, PNG, GIF, WebP up to 10MB
                                                    @else
                                                    MP4, WebM, OGG up to 50MB
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    @error('media_file') <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            @endif

                            <!-- Step 3: Details -->
                            @if($currentStep === 3)
                            <div class="space-y-6">
                                <div>
                                    <h4 class="mb-4 text-lg font-medium text-gray-900">Slide Details</h4>

                                    <div class="space-y-4">
                                        <div>
                                            <label for="title"
                                                class="block text-sm font-medium text-gray-700">Title</label>
                                            <input type="text" id="title" wire:model="title"
                                                class="block w-full mt-1 border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                                placeholder="Enter slide title...">
                                            @error('title') <span class="mt-1 text-sm text-red-500">{{ $message
                                                }}</span> @enderror
                                        </div>

                                        <div class="flex items-center">
                                            <input type="checkbox" id="is_active" wire:model="is_active"
                                                class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                            <label for="is_active" class="block ml-2 text-sm text-gray-900">
                                                Active (visible on website)
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <!-- Form Actions -->
                            <div class="flex items-center justify-between pt-6 mt-8 border-t border-gray-200">
                                <div>
                                    @if($currentStep > 1)
                                    <button type="button" wire:click="previousStep"
                                        class="inline-flex items-center px-4 py-2 text-gray-700 transition-colors bg-gray-100 rounded-lg hover:bg-gray-200">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 19l-7-7 7-7" />
                                        </svg>
                                        Previous
                                    </button>
                                    @endif
                                </div>

                                <div class="flex space-x-3">
                                    <button type="button" wire:click="closeForm"
                                        class="px-4 py-2 text-gray-700 transition-colors bg-gray-100 rounded-lg hover:bg-gray-200">
                                        Cancel
                                    </button>

                                    @if($currentStep < 3) <button type="button" wire:click="nextStep"
                                        class="inline-flex items-center px-4 py-2 text-white transition-colors bg-blue-600 rounded-lg hover:bg-blue-700">
                                        Next
                                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                        </button>
                                        @else
                                        <button type="submit"
                                            class="inline-flex items-center px-6 py-2 text-white transition-all duration-200 transform rounded-lg bg-gradient-to-r from-blue-600 to-purple-600 hover:shadow-lg hover:scale-105">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                            {{ $isEditing ? 'Update Slide' : 'Create Slide' }}
                                        </button>
                                        @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif

            <!-- Delete Modal -->
            @if($showDeleteModal)
            <div class="fixed inset-0 z-50 overflow-y-auto">
                <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75"></div>

                    <div
                        class="inline-block w-full max-w-md my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl">
                        <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div
                                    class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-red-100 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                    </svg>
                                </div>
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">Delete Hero Slide</h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500">
                                            Are you sure you want to delete this hero slide? This action cannot be
                                            undone and will permanently remove the slide and its media file.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button wire:click="deleteSlide"
                                class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Delete
                            </button>
                            <button wire:click="closeDeleteModal"
                                class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <script>
                document.addEventListener('livewire:init', () => {
        Livewire.on('notify', (event) => {
            const data = event[0];
            Alpine.store('notifications').show(data.type, data.message);
        });
    });

    // Alpine.js store for notifications
    document.addEventListener('alpine:init', () => {
        Alpine.store('notifications', {
            show(type, message) {
                const notification = document.querySelector('[x-data*="showNotification"]');
                const scope = Alpine.$data(notification);
                scope.showNotification(type, message);
            }
        });
    });
            </script>
        </div>
