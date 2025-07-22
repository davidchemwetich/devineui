<div class="p-4 bg-white rounded-lg shadow-lg sm:p-6 dark:bg-gray-800" x-data="{
    step: @entangle('step'),
    totalSteps: 4,
    autoSlug: true,
    showImagePreview: false,
    imagePreview: '',
    excerptEditorInitialized: false,
    bodyEditorInitialized: false,

    init() {
        const initEditorsOnStep2 = () => {
            if (this.step === 2) {
                // Use a short timeout to ensure Alpine has made the elements visible
                // before EasyMDE tries to initialize on them.
                setTimeout(() => {
                    this.initExcerptEditor();
                    this.initBodyEditor();
                }, 50);
            }
        };

        this.$watch('step', () => initEditorsOnStep2());

        // Initial call in case the component loads on step 2
        initEditorsOnStep2();
    },
    slugify(text) {
        return text.toString().toLowerCase()
            .replace(/\s+/g, '-')
            .replace(/[^\w\-]+/g, '')
            .replace(/\-\-+/g, '-')
            .replace(/^-+/, '')
            .replace(/-+$/, '');
    },
    previewImage(event) {
        const file = event.target.files[0];
        if (file) {
            this.showImagePreview = true;
            this.imagePreview = URL.createObjectURL(file);
        }
    },
    initExcerptEditor() {
        if (this.excerptEditorInitialized) return;

        const excerptEditorEl = document.getElementById('excerpt-editor');
        if (excerptEditorEl) {
            const easyMDE = new EasyMDE({
                element: excerptEditorEl,
                spellChecker: false,
                minHeight: '150px',
                maxHeight: '200px',
                toolbar: ['bold', 'italic', 'heading', '|', 'quote', 'unordered-list', 'ordered-list', '|', 'link', '|', 'preview'],
                status: false,
                placeholder: 'Write a short excerpt...',
                initialValue: excerptEditorEl.value
            });
            easyMDE.codemirror.on('change', () => {
                $wire.set('excerpt', easyMDE.value());
            });
            this.excerptEditorInitialized = true;
        }
    },
    initBodyEditor() {
        if (this.bodyEditorInitialized) return;

        const bodyEditorEl = document.getElementById('body-editor');
        if (bodyEditorEl) {
            const easyMDE = new EasyMDE({
                element: bodyEditorEl,
                spellChecker: false,
                minHeight: '300px',
                toolbar: ['bold', 'italic', 'heading', '|', 'quote', 'unordered-list', 'ordered-list', '|', 'link', 'image', '|', 'preview', 'side-by-side', 'fullscreen', '|', 'guide'],
                status: ['autosave', 'lines', 'words', 'cursor'],
                placeholder: 'Start writing your article content...',
                initialValue: bodyEditorEl.value
            });
            easyMDE.codemirror.on('change', () => {
                $wire.set('body', easyMDE.value());
            });
            this.bodyEditorInitialized = true;
        }
    }
}">
    <!-- Stepper Navigation -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <template x-for="i in totalSteps" :key="i">
                <div class="flex items-center w-full">
                    <div class="flex items-center"
                        :class="{'text-blue-600 dark:text-blue-400': step >= i, 'text-gray-500 dark:text-gray-400': step < i}">
                        <div class="flex items-center justify-center w-8 h-8 rounded-full"
                            :class="{'bg-blue-600 text-white': step === i, 'bg-gray-200 dark:bg-gray-700': step !== i}">
                            <span x-text="i"></span>
                        </div>
                        <span class="ml-2 text-sm font-medium" x-show="step === i">
                            <span x-text="['Content', 'Details', 'Media', 'Publish'][i-1]"></span>
                        </span>
                    </div>
                    <div x-show="i < totalSteps" class="flex-auto transition duration-500 ease-in-out border-t-2"
                        :class="{'border-blue-600 dark:border-blue-400': step > i, 'border-gray-200 dark:border-gray-600': step <= i}">
                    </div>
                </div>
            </template>
        </div>
    </div>


    <form @submit.prevent="step === totalSteps ? $wire.save() : $wire.nextStep()" class="space-y-6">
        <!-- Success Message -->
        @if (session()->has('message'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
            class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
            role="alert">
            <span class="font-medium">Success!</span> {{ session('message') }}
        </div>
        @endif

        <!-- Step 1: Content -->
        <div x-show="step === 1" class="space-y-6">
            <div>
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                <input type="text" wire:model.lazy="title" id="title"
                    x-on:input="if(autoSlug) $wire.set('slug', slugify($event.target.value))"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                    required>
                @error('title') <span class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="slug" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Slug</label>
                <div class="flex">
                    <input type="text" wire:model.lazy="slug" id="slug" x-on:input="autoSlug = false"
                        class="rounded-none rounded-l-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                        required>
                    <button type="button" @click="$wire.set('slug', slugify($wire.title)); autoSlug = true"
                        class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-l-0 border-gray-300 rounded-r-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                        Auto
                    </button>
                </div>
                @error('slug') <span class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Step 2: Details -->
        <div x-show="step === 2" class="space-y-6" wire:ignore>
            <div>
                <label for="excerpt-editor"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Excerpt</label>
                <textarea id="excerpt-editor">{!! $excerpt !!}</textarea>
                @error('excerpt') <span class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="body-editor"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Body</label>
                <textarea id="body-editor">{!! $body !!}</textarea>
                @error('body') <span class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Step 3: Media -->
        <div x-show="step === 3" class="space-y-6">
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    for="featured_image_upload">Featured Image</label>
                <div class="flex items-center justify-center w-full">
                    <label for="featured_image_upload"
                        class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                            </svg>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click
                                    to upload</span> or drag and drop</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, GIF (MAX. 2MB)</p>
                        </div>
                        <input wire:model="featured_image" @change="previewImage($event)" id="featured_image_upload"
                            type="file" class="hidden" accept="image/*" />
                    </label>
                </div>
                @error('featured_image') <span class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <!-- Image Previews -->
            <div class="flex space-x-4">
                <div x-show="showImagePreview" class="w-1/2">
                    <p class="mb-2 text-sm font-medium text-gray-900 dark:text-white">New Image Preview:</p>
                    <div class="relative h-48 bg-gray-100 border rounded-lg dark:bg-gray-700">
                        <img x-bind:src="imagePreview" class="object-cover w-full h-full rounded-lg"
                            alt="Image preview">
                        <button type="button" @click="showImagePreview = false; $wire.clearFeaturedImage()"
                            class="absolute top-2 right-2 p-1.5 bg-red-600 rounded-full text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                <div x-show="!showImagePreview && '{{ $featuredImageUrl }}'" class="w-1/2">
                    <p class="mb-2 text-sm font-medium text-gray-900 dark:text-white">Current Image:</p>
                    <div class="relative h-48 bg-gray-100 border rounded-lg dark:bg-gray-700">
                        <img src="{{ $featuredImageUrl }}" class="object-cover w-full h-full rounded-lg"
                            alt="Current featured image">
                        <button type="button" wire:click="removeFeaturedImage"
                            class="absolute top-2 right-2 p-1.5 bg-red-600 rounded-full text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div>
                <label for="scripture_reference"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Scripture Reference</label>
                <input type="text" wire:model.lazy="scripture_reference" id="scripture_reference"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                @error('scripture_reference') <span class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message
                    }}</span> @enderror
            </div>
        </div>

        <!-- Step 4: Publish -->
        <div x-show="step === 4" class="space-y-6">
            <div>
                <label for="category_id"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                <select wire:model="category_id" id="category_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id') <span class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label for="published_at"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Publication Date</label>
                <input type="datetime-local" wire:model="published_at" id="published_at"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
                @error('published_at') <span class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex items-start space-x-4">
                <div class="flex items-center h-5">
                    <input id="is_featured" wire:model="is_featured" type="checkbox"
                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800">
                </div>
                <label for="is_featured" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Featured
                    Article</label>
            </div>
            <div class="flex items-start space-x-4">
                <div class="flex items-center h-5">
                    <input id="is_published" wire:model="is_published" type="checkbox"
                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800">
                </div>
                <label for="is_published"
                    class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Published</label>
            </div>
        </div>

        <!-- Navigation Buttons -->
        <div class="flex justify-between pt-5 mt-8 border-t border-gray-200 dark:border-gray-700">
            <button type="button" x-show="step > 1" @click.prevent="$wire.previousStep()"
                class="text-white bg-gray-500 hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                Previous
            </button>
            <div x-show="step === 1" class="w-full"></div> <!-- Spacer -->
            <button type="button" x-show="step < totalSteps" @click.prevent="$wire.nextStep()"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Next
            </button>
            <button type="submit" x-show="step === totalSteps"
                class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                <svg wire:loading wire:target="save" class="inline w-4 h-4 mr-2 text-white animate-spin"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
                <span>{{ $articleId ? 'Update Article' : 'Create Article' }}</span>
            </button>
        </div>
    </form>
</div>
