<div class="max-w-4xl px-4 py-8 mx-auto" x-data="{
         isUploading: false,
         audioFileName: '{{ $existing_audio_path ? basename($existing_audio_path) : '' }}',
         pdfFileName: '{{ $existing_pdf_path ? basename($existing_pdf_path) : '' }}',
         imagePreview: '{{ $existing_cover_image ? asset(" storage/".$existing_cover_image) : null }}', dragOver:
    false, updateFileName(event, type) { const file=event.target.files[0]; if (file) { if (type==='audio' )
    this.audioFileName=file.name; if (type==='pdf' ) this.pdfFileName=file.name; if (type==='image' ) {
    this.imagePreview=URL.createObjectURL(file); } } }, handleDrop(event, wireModel) { event.preventDefault();
    this.dragOver=false; const files=event.dataTransfer.files; if (files.length> 0) {
    @this.set(wireModel, files[0]);
    }
    },

    resetFileInput(type) {
    if (type === 'audio') {
    this.audioFileName = '';
    @this.call('removeFile', 'audio');
    }
    if (type === 'pdf') {
    this.pdfFileName = '';
    @this.call('removeFile', 'pdf');
    }
    if (type === 'image') {
    this.imagePreview = null;
    @this.call('removeFile', 'cover_image');
    }
    }
    }">

    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                    {{ $sermonId ? 'Edit Sermon' : 'Create New Sermon' }}
                </h1>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ $this->stepTitle }}
                </p>
            </div>

            <!-- Progress Indicator -->
            <div class="flex items-center space-x-2">
                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                    Step {{ $currentStep }} of {{ $totalSteps }}
                </span>
                <div class="w-32 h-2 overflow-hidden bg-gray-200 rounded-full dark:bg-gray-700">
                    <div class="h-full transition-all duration-300 ease-out bg-gradient-to-r from-blue-500 to-indigo-600"
                        style="width: {{ $this->progressPercentage }}%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stepper Navigation -->
    <div class="mb-8">
        <nav aria-label="Progress">
            <ol class="flex items-center justify-between">
                @for ($i = 1; $i <= $totalSteps; $i++) <li class="relative flex-1">
                    @if ($i < $totalSteps) <!-- Connector line -->
                        <div class="absolute top-4 left-1/2 w-full h-0.5
                                       {{ $i < $currentStep ? 'bg-indigo-600 dark:bg-indigo-400' : 'bg-gray-300 dark:bg-gray-600' }}
                                       transform translate-x-1/2"></div>
                        @endif

                        <button wire:click="goToStep({{ $i }})"
                            class="relative flex items-center justify-center w-8 h-8 rounded-full border-2 transition-all duration-200
                                       {{ $i <= $currentStep
                                          ? 'bg-indigo-600 border-indigo-600 text-white dark:bg-indigo-500 dark:border-indigo-500'
                                          : 'bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-600 text-gray-500 dark:text-gray-400 hover:border-gray-400 dark:hover:border-gray-500' }}">
                            @if ($i < $currentStep) <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                                </svg>
                                @else
                                <span class="text-sm font-medium">{{ $i }}</span>
                                @endif
                        </button>

                        <div class="mt-2 text-xs text-center">
                            @switch($i)
                            @case(1) <span class="text-gray-600 dark:text-gray-400">Basic Info</span> @break
                            @case(2) <span class="text-gray-600 dark:text-gray-400">Media</span> @break
                            @case(3) <span class="text-gray-600 dark:text-gray-400">Visual</span> @break
                            @case(4) <span class="text-gray-600 dark:text-gray-400">Settings</span> @break
                            @endswitch
                        </div>
                        </li>
                        @endfor
            </ol>
        </nav>
    </div>

    <!-- Main Form Card -->
    <div
        class="overflow-hidden bg-white border border-gray-200 shadow-lg dark:bg-gray-800 rounded-xl dark:border-gray-700">
        <!-- Flash Messages -->
        @if (session()->has('message'))
        <div class="p-4 border-l-4 border-green-400 bg-green-50 dark:bg-green-900/20" x-data="{ show: true }"
            x-show="show">
            <div class="flex items-center justify-between">
                <div class="flex">
                    <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <p class="ml-3 text-sm text-green-700 dark:text-green-300">{{ session('message') }}</p>
                </div>
                <button @click="show = false" class="text-green-400 hover:text-green-600">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
        @endif

        @if (session()->has('error'))
        <div class="p-4 border-l-4 border-red-400 bg-red-50 dark:bg-red-900/20" x-data="{ show: true }" x-show="show">
            <div class="flex items-center justify-between">
                <div class="flex">
                    <svg class="w-5 h-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd" />
                    </svg>
                    <p class="ml-3 text-sm text-red-700 dark:text-red-300">{{ session('error') }}</p>
                </div>
                <button @click="show = false" class="text-red-400 hover:text-red-600">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
        @endif

        <form wire:submit.prevent="submit">
            <div class="p-6">
                <!-- Step 1: Basic Information -->
                @if ($currentStep === 1)
                <div class="space-y-6" x-data="{ charCount: $wire.title.length }"
                    x-init="$watch('$wire.title', value => charCount = value.length)">
                    <div>
                        <label for="title" class="block mb-2 text-sm font-semibold text-gray-900 dark:text-gray-100">
                            Sermon Title <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="text" id="title" wire:model.live.debounce.300ms="title" class="block w-full px-4 py-3 text-gray-900 transition-colors duration-200 bg-white border border-gray-300 rounded-lg dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Enter the sermon title"
                                maxlength="255" required>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <span class="text-xs text-gray-400" x-text="charCount + '/255'"></span>
                            </div>
                        </div>
                        @error('title')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description"
                            class="block mb-2 text-sm font-semibold text-gray-900 dark:text-gray-100">
                            Description
                        </label>
                        <textarea id="description" wire:model.defer="description" rows="4" class="block w-full px-4 py-3 text-gray-900 transition-colors duration-200 bg-white border border-gray-300 rounded-lg resize-none dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Describe the sermon content, key themes, or scripture references..."></textarea>
                        @error('description')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <label for="preached_on"
                                class="block mb-2 text-sm font-semibold text-gray-900 dark:text-gray-100">
                                Preached On
                            </label>
                            <input type="date" id="preached_on" wire:model.defer="preached_on" max="{{ date('Y-m-d') }}"
                                class="block w-full px-4 py-3 text-gray-900 transition-colors duration-200 bg-white border border-gray-300 rounded-lg dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            @error('preached_on')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="category"
                                class="block mb-2 text-sm font-semibold text-gray-900 dark:text-gray-100">
                                Category
                            </label>
                            <select id="category" wire:model.defer="category" class="block w-full px-4 py-3 text-gray-900 transition-colors duration-200 bg-white border border-gray-300 rounded-lg dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">Select a category</option>
                                <option value="Faith">Faith</option>
                                <option value="Family">Family</option>
                                <option value="End Times">End Times</option>
                                <option value="Worship">Worship</option>
                                <option value="Prayer">Prayer</option>
                                <option value="Other">Other</option>
                            </select>
                            @error('category')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                @endif

                <!-- Step 2: Media Files -->
                @if ($currentStep === 2)
                <div class="space-y-8">
                    <!-- Audio Upload -->
                    <div>
                        <label class="block mb-3 text-sm font-semibold text-gray-900 dark:text-gray-100">
                            Audio File
                        </label>
                        <div class="p-6 transition-colors duration-200 border-2 border-gray-300 border-dashed rounded-lg dark:border-gray-600 hover:border-indigo-400 dark:hover:border-indigo-500"
                            :class="{ 'border-indigo-400 dark:border-indigo-500 bg-indigo-50 dark:bg-indigo-900/20': dragOver }"
                            @dragover.prevent="dragOver = true" @dragleave.prevent="dragOver = false"
                            @drop.prevent="handleDrop($event, 'audio')">

                            <div class="text-center">
                                <svg class="w-12 h-12 mx-auto text-gray-400 dark:text-gray-500" stroke="currentColor"
                                    fill="none" viewBox="0 0 48 48">
                                    <path
                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>

                                <div class="mt-4">
                                    <label for="audio" class="cursor-pointer">
                                        <span class="block mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                            Drop audio file here or
                                            <span
                                                class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-500">browse</span>
                                        </span>
                                        <input id="audio" type="file" wire:model="audio" accept="audio/*"
                                            class="sr-only" @change="updateFileName($event, 'audio')">
                                    </label>
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">MP3, WAV, M4A, AAC up to
                                        50MB</p>

                                    <div x-show="audioFileName"
                                        class="flex items-center justify-between p-3 mt-3 rounded-lg bg-gray-50 dark:bg-gray-700">
                                        <span class="text-sm text-gray-700 dark:text-gray-300"
                                            x-text="audioFileName"></span>
                                        <button type="button" @click="resetFileInput('audio')"
                                            class="text-red-500 hover:text-red-700">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @error('audio')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Video URL -->
                    <div>
                        <label for="video_url"
                            class="block mb-2 text-sm font-semibold text-gray-900 dark:text-gray-100">
                            YouTube Video URL
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="url" id="video_url" wire:model.defer="video_url" class="block w-full py-3 pl-10 pr-4 text-gray-900 transition-colors duration-200 bg-white border border-gray-300 rounded-lg dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="https://www.youtube.com/watch?v=...">
                        </div>
                        @error('video_url')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- PDF Upload -->
                    <div>
                        <label class="block mb-3 text-sm font-semibold text-gray-900 dark:text-gray-100">
                            PDF Document
                        </label>
                        <div class="p-6 transition-colors duration-200 border-2 border-gray-300 border-dashed rounded-lg dark:border-gray-600 hover:border-indigo-400 dark:hover:border-indigo-500"
                            :class="{ 'border-indigo-400 dark:border-indigo-500 bg-indigo-50 dark:bg-indigo-900/20': dragOver }"
                            @dragover.prevent="dragOver = true" @dragleave.prevent="dragOver = false"
                            @drop.prevent="handleDrop($event, 'pdf')">

                            <div class="text-center">
                                <svg class="w-12 h-12 mx-auto text-gray-400 dark:text-gray-500" fill="none"
                                    stroke="currentColor" viewBox="0 0 48 48">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m6 0h6m-6 6h6m-12 6h12M9 6a3 3 0 00-3 3v30a3 3 0 003 3h30a3 3 0 003-3V9a3 3 0 00-3-3H9z" />
                                </svg>

                                <div class="mt-4">
                                    <label for="pdf" class="cursor-pointer">
                                        <span class="block mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                            Drop PDF file here or
                                            <span
                                                class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-500">browse</span>
                                        </span>
                                        <input id="pdf" type="file" wire:model="pdf" accept="application/pdf"
                                            class="sr-only" @change="updateFileName($event, 'pdf')">
                                    </label>
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">PDF up to 10MB</p>

                                    <div x-show="pdfFileName"
                                        class="flex items-center justify-between p-3 mt-3 rounded-lg bg-gray-50 dark:bg-gray-700">
                                        <span class="text-sm text-gray-700 dark:text-gray-300"
                                            x-text="pdfFileName"></span>
                                        <button type="button" @click="resetFileInput('pdf')"
                                            class="text-red-500 hover:text-red-700">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @error('pdf')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                @endif

                <!-- Step 3: Visual Content -->
                @if ($currentStep === 3)
                <div class="space-y-6">
                    <div>
                        <label class="block mb-3 text-sm font-semibold text-gray-900 dark:text-gray-100">
                            Cover Image
                        </label>
                        <div class="p-6 transition-colors duration-200 border-2 border-gray-300 border-dashed rounded-lg dark:border-gray-600 hover:border-indigo-400 dark:hover:border-indigo-500"
                            :class="{ 'border-indigo-400 dark:border-indigo-500 bg-indigo-50 dark:bg-indigo-900/20': dragOver }"
                            @dragover.prevent="dragOver = true" @dragleave.prevent="dragOver = false"
                            @drop.prevent="handleDrop($event, 'cover_image')">

                            <div class="text-center" x-show="!imagePreview">
                                <svg class="w-12 h-12 mx-auto text-gray-400 dark:text-gray-500" stroke="currentColor"
                                    fill="none" viewBox="0 0 48 48">
                                    <path
                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>

                                <div class="mt-4">
                                    <label for="cover_image" class="cursor-pointer">
                                        <span class="block mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                            Drop image here or
                                            <span
                                                class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-500">browse</span>
                                        </span>
                                        <input id="cover_image" type="file" wire:model="cover_image" accept="image/*"
                                            class="sr-only" @change="updateFileName($event, 'image')">
                                    </label>
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">JPEG, PNG, JPG, WEBP up to
                                        5MB</p>
                                </div>
                            </div>

                            <!-- Image Preview -->
                            <div x-show="imagePreview" class="relative">
                                <img :src="imagePreview"
                                    class="object-cover w-full h-64 border border-gray-200 rounded-lg dark:border-gray-600"
                                    alt="Cover Image Preview">
                                <div class="absolute top-2 right-2">
                                    <button type="button" @click="resetFileInput('image')"
                                        class="p-2 text-white transition-colors duration-200 bg-red-500 rounded-full shadow-lg hover:bg-red-600">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="mt-3 text-center">
                                    <label for="cover_image_replace"
                                        class="text-sm text-indigo-600 cursor-pointer dark:text-indigo-400 hover:text-indigo-500">
                                        Replace Image
                                        <input id="cover_image_replace" type="file" wire:model="cover_image"
                                            accept="image/*" class="sr-only" @change="updateFileName($event, 'image')">
                                    </label>
                                </div>
                            </div>
                        </div>
                        @error('cover_image')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                @endif

                <!-- Step 4: Settings & Publishing -->
                @if ($currentStep === 4)
                <div class="space-y-6">
                    <!-- Publishing Status -->
                    <div>
                        <label class="block mb-3 text-sm font-semibold text-gray-900 dark:text-gray-100">
                            Publishing Status
                        </label>
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <label
                                class="relative flex cursor-pointer rounded-lg border border-gray-300 dark:border-gray-600 p-4 focus:outline-none
                                             {{ $status === 'draft' ? 'border-indigo-500 bg-indigo-50 dark:bg-indigo-900/20 ring-2 ring-indigo-500' : 'hover:border-gray-400 dark:hover:border-gray-500' }}">
                                <input type="radio" wire:model.defer="status" value="draft" class="sr-only">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <div class="w-4 h-4 rounded-full border-2
                                                       {{ $status === 'draft' ? 'border-indigo-500 bg-indigo-500' : 'border-gray-300 dark:border-gray-600' }}
                                                       flex items-center justify-center">
                                            @if ($status === 'draft')
                                            <div class="w-2 h-2 bg-white rounded-full"></div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="ml-3">
                                        <span class="block text-sm font-medium text-gray-900 dark:text-gray-100">Save as
                                            Draft</span>
                                        <span class="block text-sm text-gray-500 dark:text-gray-400">Keep private for
                                            later editing</span>
                                    </div>
                                </div>
                            </label>

                            <label
                                class="relative flex cursor-pointer rounded-lg border border-gray-300 dark:border-gray-600 p-4 focus:outline-none
                                             {{ $status === 'published' ? 'border-indigo-500 bg-indigo-50 dark:bg-indigo-900/20 ring-2 ring-indigo-500' : 'hover:border-gray-400 dark:hover:border-gray-500' }}">
                                <input type="radio" wire:model.defer="status" value="published" class="sr-only">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <div class="w-4 h-4 rounded-full border-2
                                                       {{ $status === 'published' ? 'border-indigo-500 bg-indigo-500' : 'border-gray-300 dark:border-gray-600' }}
                                                       flex items-center justify-center">
                                            @if ($status === 'published')
                                            <div class="w-2 h-2 bg-white rounded-full"></div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="ml-3">
                                        <span class="block text-sm font-medium text-gray-900 dark:text-gray-100">Publish
                                            Now</span>
                                        <span class="block text-sm text-gray-500 dark:text-gray-400">Make available to
                                            congregation</span>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Featured Sermon -->
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="is_featured" type="checkbox" wire:model.defer="is_featured"
                                class="w-4 h-4 text-indigo-600 border-gray-300 rounded dark:border-gray-600 focus:ring-indigo-500 focus:ring-2">
                        </div>
                        <div class="ml-3">
                            <label for="is_featured" class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                Featured Sermon
                            </label>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Featured sermons are highlighted on the main page and appear at the top of listings.
                            </p>
                        </div>
                    </div>

                    <!-- Summary Card -->
                    <div class="p-6 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                        <h3 class="mb-4 text-lg font-semibold text-gray-900 dark:text-gray-100">Sermon Summary</h3>
                        <dl class="grid grid-cols-1 gap-4 text-sm md:grid-cols-2">
                            <div>
                                <dt class="font-medium text-gray-500 dark:text-gray-400">Title:</dt>
                                <dd class="text-gray-900 dark:text-gray-100">{{ $title ?: 'Not set' }}</dd>
                            </div>
                            <div>
                                <dt class="font-medium text-gray-500 dark:text-gray-400">Category:</dt>
                                <dd class="text-gray-900 dark:text-gray-100">{{ $category ?: 'Not set' }}</dd>
                            </div>
                            <div>
                                <dt class="font-medium text-gray-500 dark:text-gray-400">Preached On:</dt>
                                <dd class="text-gray-900 dark:text-gray-100">{{ $preached_on ? date('F j, Y',
                                    strtotime($preached_on)) : 'Not set' }}</dd>
                            </div>
                            <div>
                                <dt class="font-medium text-gray-500 dark:text-gray-400">Status:</dt>
                                <dd class="text-gray-900 dark:text-gray-100">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                   {{ $status === 'published' ? 'bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-400' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/20 dark:text-yellow-400' }}">
                                        {{ ucfirst($status) }}
                                    </span>
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
                @endif
            </div>

            <!-- Navigation Buttons -->
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                <div class="flex items-center justify-between">
                    <div>
                        @if ($currentStep > 1)
                        <button type="button" wire:click="previousStep"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 transition-colors duration-200 bg-white border border-gray-300 rounded-md dark:border-gray-600 dark:text-gray-300 dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />
                            </svg>
                            Previous
                        </button>
                        @endif
                    </div>

                    <div class="flex items-center space-x-3">
                        @if ($currentStep < $totalSteps) <button type="button" wire:click="nextStep" class="inline-flex items-center px-6 py-2 text-sm font-medium text-white transition-colors duration-200 bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Next Step
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                            </button>
                            @else
                            <button type="submit" wire:loading.attr="disabled" wire:target="submit"
                                class="inline-flex items-center px-6 py-2 text-sm font-medium text-white transition-colors duration-200 bg-green-600 border border-transparent rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 disabled:opacity-50 disabled:cursor-not-allowed">
                                <div wire:loading.remove wire:target="submit" class="flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    {{ $sermonId ? 'Update Sermon' : 'Create Sermon' }}
                                </div>
                                <div wire:loading wire:target="submit" class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 -ml-1 text-white animate-spin"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                            stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                    Processing...
                                </div>
                            </button>
                            @endif
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Loading Overlay -->
    <div wire:loading.flex wire:target="submit"
        class="fixed inset-0 z-50 items-center justify-center bg-gray-600 bg-opacity-50">
        <div class="max-w-sm p-6 mx-auto bg-white rounded-lg shadow-xl dark:bg-gray-800">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-3 -ml-1 text-indigo-600 animate-spin" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
                <span class="text-lg font-medium text-gray-900 dark:text-gray-100">Saving sermon...</span>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:initialized', () => {
        @this.on('sermon-saved', (event) => {
            // You can add custom JavaScript here for additional UI feedback
            console.log('Sermon saved:', event);
        });
    });
</script>
