<div x-data="{
    currentStep: @entangle('currentStep'),
    totalSteps: @entangle('totalSteps'),
    primaryImagePreview: null,
    galleryPreviews: [],
    handlePrimaryImageChange(event) {
        const file = event.target.files[0];
        if (file) {
            this.primaryImagePreview = URL.createObjectURL(file);
        }
    },
    handleGalleryImagesChange(event) {
        this.galleryPreviews = [];
        const files = Array.from(event.target.files);
        files.forEach(file => {
            this.galleryPreviews.push(URL.createObjectURL(file));
        });
    }
}" class="max-w-4xl p-4 mx-auto sm:p-6 lg:p-8">

    {{-- Stepper Navigation --}}
    <div class="mb-8">
        <div class="flex items-center">
            @php $steps = ['Details', 'Leadership', 'Activities', 'Media']; @endphp
            @foreach($steps as $index => $stepName)
            <div class="flex items-center" wire:key="step-{{ $index + 1 }}">
                <button @click="currentStep > {{ $index + 1 }} ? $wire.goToStep({{ $index + 1 }}) : {}" :class="{
                        'bg-blue-600 text-white': currentStep === {{ $index + 1 }},
                        'bg-green-500 text-white': currentStep > {{ $index + 1 }},
                        'bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300': currentStep < {{ $index + 1 }},
                        'cursor-pointer': currentStep > {{ $index + 1 }}
                    }"
                    class="flex items-center justify-center w-10 h-10 text-lg font-semibold transition-all duration-300 rounded-full">
                    <span x-show="currentStep <= {{ $index + 1 }}">{{ $index + 1 }}</span>
                    <svg x-show="currentStep > {{ $index + 1 }}" class="w-6 h-6" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </button>
                <div class="hidden ml-4 sm:block">
                    <div class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ $stepName }}</div>
                </div>
            </div>
            @if (!$loop->last)
            <div class="flex-auto mx-4 transition-all duration-500 border-t-2"
                :class="{ 'border-blue-600': currentStep > {{ $index + 1 }} }"></div>
            @endif
            @endforeach
        </div>
    </div>


    <div class="p-6 transition-all duration-300 bg-white shadow-lg dark:bg-gray-800 rounded-xl sm:p-8">
        <form wire:submit.prevent="save" class="space-y-6">

            {{-- Step 1: Ministry Details --}}
            <div x-show="currentStep === 1" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100">
                <h3 class="mb-6 text-xl font-semibold text-gray-900 dark:text-white">Ministry Details</h3>
                <!-- Name -->
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Ministry
                        Name</label>
                    <input type="text" wire:model.lazy="name" id="name"
                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-shadow duration-200"
                        required>
                    @error('name') <p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>
                <!-- Description -->
                <div class="mt-6">
                    <label for="description"
                        class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                    <textarea wire:model.lazy="description" id="description" rows="5"
                        class="w-full px-4 py-2 text-gray-900 transition-shadow duration-200 bg-white border border-gray-300 rounded-lg dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                    @error('description') <p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Step 2: Leadership --}}
            <div x-show="currentStep === 2" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100">
                <h3 class="mb-6 text-xl font-semibold text-gray-900 dark:text-white">Leadership Information</h3>
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <!-- Leader Selection -->
                    <div>
                        <label for="leader_id"
                            class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Leader</label>
                        <select wire:model="leader_id" id="leader_id"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none transition-shadow duration-200">
                            <option value="">Select Leader</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('leader_id') <p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <!-- Leader Contact -->
                    <div>
                        <label for="leader_contact"
                            class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Leader
                            Contact</label>
                        <input type="text" wire:model.lazy="leader_contact" id="leader_contact"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-shadow duration-200">
                        @error('leader_contact') <p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            {{-- Step 3: Activities --}}
            <div x-show="currentStep === 3" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100">
                <h3 class="mb-6 text-xl font-semibold text-gray-900 dark:text-white">Activities & Programs</h3>
                <div>
                    <label for="activities"
                        class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Describe Ministry
                        Activities</label>
                    <textarea wire:model.lazy="activities" id="activities" rows="5"
                        class="w-full px-4 py-2 text-gray-900 transition-shadow duration-200 bg-white border border-gray-300 rounded-lg dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                    @error('activities') <p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Step 4: Media Upload --}}
            <div x-show="currentStep === 4" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100">
                <h3 class="mb-6 text-xl font-semibold text-gray-900 dark:text-white">Media Uploads</h3>
                <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                    <!-- Primary Image -->
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Primary
                            Image</label>
                        <input type="file" wire:model="primaryImage" id="primary_image" class="hidden"
                            @change="handlePrimaryImageChange">
                        <label for="primary_image"
                            class="block w-full p-6 text-center transition-colors duration-200 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer dark:border-gray-600 hover:border-blue-500 dark:hover:border-blue-400 bg-gray-50 dark:bg-gray-700/50">
                            <div class="space-y-2">
                                <svg class="w-12 h-12 mx-auto text-gray-400" stroke="currentColor" fill="none"
                                    viewBox="0 0 48 48">
                                    <path
                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <p class="text-sm text-gray-600 dark:text-gray-400"><span
                                        class="font-semibold text-blue-600 dark:text-blue-400">Click to upload</span> or
                                    drag and drop</p>
                            </div>
                        </label>
                        <div wire:loading wire:target="primaryImage" class="mt-2 text-sm text-gray-500">Uploading...
                        </div>
                        @error('primaryImage') <p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror

                        <!-- Preview -->
                        <div class="mt-4">
                            <template x-if="primaryImagePreview">
                                <img :src="primaryImagePreview" class="object-cover w-full h-40 rounded-lg shadow-md">
                            </template>
                            <template x-if="!primaryImagePreview && '{{ $existingPrimaryImage }}'">
                                <img src="{{ asset('storage/' . $existingPrimaryImage) }}"
                                    class="object-cover w-full h-40 rounded-lg shadow-md">
                            </template>
                        </div>
                    </div>

                    <!-- Gallery Images -->
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Gallery
                            Images</label>
                        <input type="file" wire:model="galleryImages" multiple id="gallery_images" class="hidden"
                            @change="handleGalleryImagesChange">
                        <label for="gallery_images"
                            class="block w-full p-6 text-center transition-colors duration-200 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer dark:border-gray-600 hover:border-blue-500 dark:hover:border-blue-400 bg-gray-50 dark:bg-gray-700/50">
                            <div class="space-y-2">
                                <svg class="w-12 h-12 mx-auto text-gray-400" stroke="currentColor" fill="none"
                                    viewBox="0 0 48 48">
                                    <path
                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <p class="text-sm text-gray-600 dark:text-gray-400"><span
                                        class="font-semibold text-blue-600 dark:text-blue-400">Upload multiple
                                        files</span></p>
                            </div>
                        </label>
                        <div wire:loading wire:target="galleryImages" class="mt-2 text-sm text-gray-500">Uploading...
                        </div>
                        @error('galleryImages.*') <p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror

                        <!-- Previews -->
                        <div class="grid grid-cols-3 gap-2 mt-4">
                            <!-- New Uploads -->
                            <template x-for="(preview, index) in galleryPreviews" :key="index">
                                <div class="relative">
                                    <img :src="preview" class="object-cover w-full h-24 rounded-lg shadow-md">
                                </div>
                            </template>
                            <!-- Existing Images -->
                            @if($isEditMode && !empty($existingGalleryImages))
                            @foreach($existingGalleryImages as $index => $image)
                            <div class="relative group" wire:key="existing-img-{{ $index }}">
                                <img src="{{ asset('storage/' . $image) }}"
                                    class="object-cover w-full h-24 rounded-lg shadow-md">
                                <button type="button" wire:click="removeExistingGalleryImage({{ $index }})"
                                    wire:loading.attr="disabled"
                                    class="absolute p-1 text-white transition-opacity bg-red-600 rounded-full opacity-0 -top-2 -right-2 group-hover:opacity-100">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Navigation Buttons --}}
            <div class="flex items-center justify-between pt-6 border-t border-gray-200 dark:border-gray-700">
                <div>
                    <button type="button" x-show="currentStep > 1" @click="$wire.previousStep()"
                        class="px-5 py-2.5 bg-gray-200 dark:bg-gray-600 text-gray-800 dark:text-gray-200 font-medium rounded-lg shadow-sm hover:bg-gray-300 dark:hover:bg-gray-500 transition-all duration-200">
                        Back
                    </button>
                </div>
                <div>
                    <button type="button" x-show="currentStep < totalSteps" @click="$wire.nextStep()"
                        class="px-5 py-2.5 bg-blue-600 text-white font-medium rounded-lg shadow-sm hover:bg-blue-700 transition-all duration-200 transform hover:scale-105">
                        Next
                    </button>
                    <button type="submit" x-show="currentStep === totalSteps"
                        class="px-5 py-2.5 bg-green-600 text-white font-medium rounded-lg shadow-sm hover:bg-green-700 transition-all duration-200 transform hover:scale-105">
                        <span wire:loading.remove wire:target="save">{{ $isEditMode ? 'Update Ministry' : 'Create
                            Ministry' }}</span>
                        <span wire:loading wire:target="save">Saving...</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
