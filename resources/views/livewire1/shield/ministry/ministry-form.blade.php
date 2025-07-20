<div x-data="{ primaryImagePreview: null, galleryFiles: [] }"
    class="transition-all duration-300 bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg">
    @if($errorMessage)
    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
        {{ $errorMessage }}
    </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-6">
        <!-- Ministry Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Ministry
                Name</label>
            <input type="text" wire:model="name" id="name"
                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-600 transition-shadow duration-200"
                required>
            @error('name')
            <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                        clip-rule="evenodd" />
                </svg>
                {{ $message }}
            </p>
            @enderror
        </div>

        <!-- Description -->
        <div>
            <label for="description"
                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description</label>
            <textarea wire:model="description" id="description" rows="4"
                class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-600 transition-shadow duration-200"></textarea>
            @error('description')
            <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">{{ $message }}</p>
            @enderror
        </div>

        <!-- Leader Selection -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="leader_id"
                    class="block text-sm font-medium text-gray-700  dark:text-gray-300 mb-2">Leader</label>
                <select wire:model="leader_id" id="leader_id"
                    class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-600 appearance-none transition-shadow duration-200">
                    <option value="">Select Leader</option>
                    @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                @error('leader_id')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">{{ $message }}</p>
                @enderror
            </div>

            <!-- Leader Contact -->
            <div>
                <label for="leader_contact"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Leader Contact</label>
                <input type="text" wire:model="leader_contact" id="leader_contact"
                    class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-600 transition-shadow duration-200">
                @error('leader_contact')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Image Uploads -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Primary Image -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Primary Image</label>
                <div class="relative group">
                    <input type="file" wire:model="primaryImage" id="primary_image"
                        class="absolute opacity-0 w-full h-full cursor-pointer" x-ref="primaryImage"
                        @change="primaryImagePreview = URL.createObjectURL($event.target.files[0])">
                    <label for="primary_image"
                        class="block w-full p-8 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg hover:border-blue-500 dark:hover:border-blue-600 transition-colors duration-200 cursor-pointer bg-white dark:bg-gray-700">
                        <div class="text-center space-y-2">
                            <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" stroke="currentColor"
                                fill="none" viewBox="0 0 48 48">
                                <path
                                    d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                <span class="text-blue-600 dark:text-blue-400 font-medium">Upload a file</span>
                                or drag and drop
                            </p>
                        </div>
                    </label>
                </div>
                <template x-if="primaryImagePreview">
                    <img :src="primaryImagePreview" class="mt-4 w-full h-32 object-cover rounded-lg shadow-sm">
                </template>
                @error('primaryImage')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">{{ $message }}</p>
                @enderror
            </div>

            <!-- Gallery Images -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Gallery Images</label>
                <div class="relative group">
                    <input type="file" wire:model="galleryImages" multiple id="gallery_images"
                        class="absolute opacity-0 w-full h-full cursor-pointer" x-ref="galleryImages"
                        @change="galleryFiles = Array.from($event.target.files)">
                    <label for="gallery_images"
                        class="block w-full p-8 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg hover:border-blue-500 dark:hover:border-blue-600 transition-colors duration-200 cursor-pointer bg-white dark:bg-gray-700">
                        <div class="text-center space-y-2">
                            <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" stroke="currentColor"
                                fill="none" viewBox="0 0 48 48">
                                <path
                                    d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                <span class="text-blue-600 dark:text-blue-400 font-medium">Upload files</span>
                                (multiple allowed)
                            </p>
                        </div>
                    </label>
                </div>
                <template x-if="galleryFiles.length > 0">
                    <div class="mt-4 text-sm text-gray-600 dark:text-gray-400">
                        <span class="font-medium">Selected files:</span>
                        <ul class="list-disc pl-5 mt-1">
                            <template x-for="file in galleryFiles" :key="file.name">
                                <li x-text="file.name"></li>
                            </template>
                        </ul>
                    </div>
                </template>
                @error('galleryImages.*')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Submit Button -->
        <div class="pt-6">
            <button type="submit"
                class="w-full md:w-auto px-6 py-3 bg-blue-600 hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800 text-white font-medium rounded-lg shadow-sm transition-all duration-200 transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                {{ $isEditMode ? 'Update Ministry' : 'Create Ministry' }}
            </button>
        </div>
    </form>

    @if($isEditMode)
    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Gallery Images</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($ministry->gallery_images as $index => $image)
            <div class="relative group">
                <img src="{{ asset('storage/' . $image) }}"
                    class="w-full h-32 object-cover rounded-lg shadow-sm transform group-hover:scale-105 transition-transform duration-200">
                <button wire:click="removeGalleryImage({{ $index }})"
                    class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1.5 hover:bg-red-600 transition-colors duration-200 shadow-lg">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

