<div class="p-6 bg-white rounded-lg shadow-lg" x-data="{
    characterCount: 0,
    maxExcerpt: 300,
    slugify(text) {
        return text.toString().toLowerCase()
            .replace(/\s+/g, '-')
            .replace(/[^\w\-]+/g, '')
            .replace(/\-\-+/g, '-')
            .replace(/^-+/, '')
            .replace(/-+$/, '');
    },
    autoSlug: true,
    showImagePreview: false,
    imagePreview: '',
    previewImage(event) {
        const file = event.target.files[0];
        if (file) {
            this.showImagePreview = true;
            this.imagePreview = URL.createObjectURL(file);
        }
    }
}">
    <h1 class="pb-3 mb-6 text-3xl font-bold text-blue-700 border-b">
        {{ $articleId ? 'Edit Article' : 'Create New Article' }}
    </h1>

    <form wire:submit="save" class="space-y-6">
        <!-- Success message -->
        @if (session()->has('message'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
            class="flex items-center justify-between p-4 mb-4 text-green-700 bg-green-100 border-l-4 border-green-500 rounded shadow-md">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd"></path>
                </svg>
                <span>{{ session('message') }}</span>
            </div>
            <button type="button" @click="show = false" class="text-green-700">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
        @endif

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <!-- Title Field -->
            <div>
                <label for="title" class="block mb-1 text-sm font-medium text-gray-700">Title</label>
                <input type="text" wire:model="title" id="title"
                    x-on:input="if(autoSlug) $wire.slug = slugify($event.target.value)"
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    required>
                @error('title') <span class="mt-1 text-xs text-red-500">{{ $message }}</span> @enderror
            </div>

            <!-- Slug Field -->
            <div>
                <label for="slug" class="block mb-1 text-sm font-medium text-gray-700">Slug</label>
                <div class="flex mt-1 rounded-md shadow-sm">
                    <input type="text" wire:model="slug" id="slug" x-on:input="autoSlug = false"
                        class="flex-grow block w-full border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-l-md"
                        required>
                    <button type="button" @click="$wire.slug = slugify($wire.title); autoSlug = true"
                        class="inline-flex items-center px-3 py-2 text-sm text-gray-500 border border-l-0 border-gray-300 bg-gray-50 rounded-r-md hover:bg-gray-100">
                        Auto
                    </button>
                </div>
                @error('slug') <span class="mt-1 text-xs text-red-500">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Featured Image Upload -->
        <div>
            <label for="featured_image" class="block mb-1 text-sm font-medium text-gray-700">Featured Image</label>
            <div class="flex flex-col space-y-4 md:flex-row md:space-y-0 md:space-x-4">
                <div class="flex-grow">
                    <div class="flex items-center justify-center w-full">
                        <label for="featured_image_upload" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                                <p class="mb-1 text-sm text-gray-500">
                                    <span class="font-semibold">Click to upload</span> or drag and drop
                                </p>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                            </div>
                            <input wire:model="featured_image" @change="previewImage($event)" id="featured_image_upload" type="file" class="hidden" accept="image/*" />
                        </label>
                    </div>
                    @error('featured_image') <span class="mt-1 text-xs text-red-500">{{ $message }}</span> @enderror
                </div>
                
                <!-- Image Preview -->
                <div x-show="showImagePreview" class="w-full md:w-1/3">
                    <div class="relative h-32 overflow-hidden bg-gray-100 border rounded-lg">
                        <img x-bind:src="imagePreview" class="object-cover w-full h-full" alt="Image preview">
                        <button type="button" @click="showImagePreview = false; $wire.clearFeaturedImage()" 
                            class="absolute p-1 text-white bg-red-500 rounded-full top-2 right-2 hover:bg-red-600">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                
                <!-- Current Image Preview (if editing) -->
                <div wire:ignore x-show="!showImagePreview" class="w-full md:w-1/3" x-data="{ hasCurrentImage: '{{ isset($featuredImageUrl) && $featuredImageUrl }}' }">
                    <div x-show="hasCurrentImage" class="relative h-32 overflow-hidden bg-gray-100 border rounded-lg">
                        <img src="{{ isset($featuredImageUrl) ? $featuredImageUrl : '' }}" class="object-cover w-full h-full" alt="Current featured image">
                        <button type="button" wire:click="removeFeaturedImage" @click="hasCurrentImage = false"
                            class="absolute p-1 text-white bg-red-500 rounded-full top-2 right-2 hover:bg-red-600">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scripture Reference Field -->
        <div>
            <label for="scripture_reference" class="block mb-1 text-sm font-medium text-gray-700">Scripture Reference</label>
            <input type="text" wire:model="scripture_reference" id="scripture_reference" placeholder="e.g. John 3:16-17"
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            @error('scripture_reference') <span class="mt-1 text-xs text-red-500">{{ $message }}</span> @enderror
        </div>

        <!-- Excerpt Field -->
        <div>
            <label for="excerpt" class="block mb-1 text-sm font-medium text-gray-700">
                Excerpt <span class="text-xs text-gray-500"
                    x-text="`${$wire.excerpt ? $wire.excerpt.length : 0}/${maxExcerpt}`"></span>
            </label>
            <textarea wire:model="excerpt" id="excerpt"
                x-init="characterCount = $wire.excerpt ? $wire.excerpt.length : 0"
                x-on:input="characterCount = $event.target.value.length" rows="3" maxlength="300"
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                required></textarea>
            <div class="flex justify-end">
                <div class="text-xs text-gray-500" x-text="`${characterCount}/${maxExcerpt} characters`"></div>
            </div>
            @error('excerpt') <span class="mt-1 text-xs text-red-500">{{ $message }}</span> @enderror
        </div>

        <!-- Body Field -->
        <div>
            <label for="body" class="block mb-1 text-sm font-medium text-gray-700">Body</label>
            <textarea wire:model="body" id="body" rows="10"
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                required></textarea>
            @error('body') <span class="mt-1 text-xs text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <!-- Category Field -->
            <div>
                <label for="category_id" class="block mb-1 text-sm font-medium text-gray-700">Category</label>
                <select wire:model="category_id" id="category_id"
                    class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id') <span class="mt-1 text-xs text-red-500">{{ $message }}</span> @enderror
            </div>

            <!-- Publication Date and Status -->
            <div class="space-y-4">
                <!-- Publication Date Field -->
                <div x-data="{ showDatepicker: false }" class="relative">
                    <label for="published_at" class="block mb-1 text-sm font-medium text-gray-700">Publication Date</label>
                    <div class="relative">
                        <input type="text" wire:model="published_at" id="published_at" placeholder="Select date"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            readonly x-on:click="showDatepicker = !showDatepicker">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                    @error('published_at') <span class="mt-1 text-xs text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- Status Options -->
                <div class="flex flex-col space-y-4 pt-2">
                    <div class="flex items-center">
                        <input type="checkbox" wire:model="is_featured" id="is_featured"
                            class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <label for="is_featured" class="block ml-2 text-sm text-gray-700">Featured Article</label>
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" wire:model="is_published" id="is_published"
                            class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <label for="is_published" class="block ml-2 text-sm text-gray-700">Published</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end pt-5 mt-4 border-t border-gray-200">
            <a href="{{ route(config('app.admin_prefix') . '.articles.index') }}"
                class="px-4 py-2 mr-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Cancel
            </a>
            <button type="submit"
                class="inline-flex justify-center px-4 py-2 ml-3 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg wire:loading wire:target="save" class="w-4 h-4 mr-2 -ml-1 text-white animate-spin"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
                {{ $articleId ? 'Update Article' : 'Create Article' }}
            </button>
        </div>
    </form>
</div>