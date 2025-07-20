<div
    x-data="{
        activeTab: 'content',
        previewMode: @entangle('previewMode'),
        showNotification: false,
        notificationMessage: '',
        notificationType: '',
        init() {
            Livewire.on('notify', (event) => {
                this.notificationMessage = event.message;
                this.notificationType = event.type;
                this.showNotification = true;
                setTimeout(() => { this.showNotification = false }, 5000);
            });
        }
    }"
    class="min-h-screen bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200"
>

    <!-- Notification Toast -->
    <div
        x-show="showNotification"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform translate-y-2"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform translate-y-2"
        class="fixed top-5 right-5 z-50 p-4 rounded-lg shadow-lg"
        :class="{
            'bg-green-500 text-white': notificationType === 'success',
            'bg-red-500 text-white': notificationType === 'error'
        }"
        style="display: none;"
    >
        <p x-text="notificationMessage"></p>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold tracking-tight">Manage About Us Page</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Update the content, mission, media, and SEO for your church's about page.</p>
            </div>
            <div class="flex items-center space-x-2 mt-4 sm:mt-0">
                <button
                    type="button"
                    @click="previewMode = !previewMode"
                    class="flex items-center px-4 py-2 text-sm font-medium bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    <svg x-show="!previewMode" class="w-5 h-5 mr-2 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                    <svg x-show="previewMode" class="w-5 h-5 mr-2 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 1.274-4.057 5.064-7 9.542-7 .836 0 1.644.114 2.416.325m2.882 11.28C17.46 15.12 18 13.614 18 12c0-1.614-.54-3.12-1.468-4.35m-1.435 8.685A7.948 7.948 0 0112 15a7.948 7.948 0 01-3.1- .65m3.1 3.1a12.01 12.01 0 005.1-1.043M2.957 5.957A12.01 12.01 0 007.05 19.05m14-14a12.01 12.01 0 00-14 14" /></svg>
                    <span x-text="previewMode ? 'Exit Preview' : 'Preview'"></span>
                </button>
                <button
                    type="button"
                    wire:click="save"
                    wire:loading.attr="disabled"
                    wire:loading.class="opacity-75 cursor-not-allowed"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-lg shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    <svg wire:loading wire:target="save" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <svg x-show="!previewMode" wire:loading.remove class="w-5 h-5 mr-2 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" /></svg>
                    Save Changes
                </button>
            </div>
        </div>

        <!-- Main Content -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
            <!-- Form View -->
            <div x-show="!previewMode">
                <!-- Tab Navigation -->
                <div class="border-b border-gray-200 dark:border-gray-700">
                    <nav class="-mb-px flex space-x-6 px-6" aria-label="Tabs">
                        <button @click="activeTab = 'content'" :class="{ 'border-indigo-500 text-indigo-600 dark:text-indigo-400': activeTab === 'content', 'border-transparent hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-500': activeTab !== 'content' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm focus:outline-none">
                            Content
                        </button>
                        <button @click="activeTab = 'mission'" :class="{ 'border-indigo-500 text-indigo-600 dark:text-indigo-400': activeTab === 'mission', 'border-transparent hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-500': activeTab !== 'mission' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm focus:outline-none">
                            Mission & Vision
                        </button>
                        <button @click="activeTab = 'media'" :class="{ 'border-indigo-500 text-indigo-600 dark:text-indigo-400': activeTab === 'media', 'border-transparent hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-500': activeTab !== 'media' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm focus:outline-none">
                            Media
                        </button>
                        <button @click="activeTab = 'seo'" :class="{ 'border-indigo-500 text-indigo-600 dark:text-indigo-400': activeTab === 'seo', 'border-transparent hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-500': activeTab !== 'seo' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm focus:outline-none">
                            SEO
                        </button>
                    </nav>
                </div>

                <!-- Form Content -->
                <form wire:submit.prevent="save" class="p-6 space-y-8">
                    <div x-show="activeTab === 'content'" x-transition class="space-y-6">
                        <!-- Heading -->
                        <div>
                            <label for="heading" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Heading</label>
                            <input type="text" id="heading" wire:model.lazy="state.heading" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200">
                            @error('state.heading') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <!-- Subheading -->
                        <div>
                            <label for="subheading" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Subheading</label>
                            <input type="text" id="subheading" wire:model.lazy="state.subheading" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200">
                            @error('state.subheading') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <!-- Content -->
                        <div>
                            <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Main Content</label>
                            <textarea id="content" wire:model.lazy="state.content" rows="10" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200"></textarea>
                            @error('state.content') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div x-show="activeTab === 'mission'" x-transition class="space-y-6">
                        <!-- Mission -->
                        <div>
                            <label for="mission_statement" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Mission Statement</label>
                            <textarea id="mission_statement" wire:model.lazy="state.mission_statement" rows="6" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200" placeholder="Enter each point on a new line."></textarea>
                            @error('state.mission_statement') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <!-- Vision -->
                        <div>
                            <label for="vision_statement" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Vision Statement</label>
                            <textarea id="vision_statement" wire:model.lazy="state.vision_statement" rows="6" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200" placeholder="Enter each point on a new line."></textarea>
                            @error('state.vision_statement') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div x-show="activeTab === 'media'" x-transition class="space-y-6">
                        <!-- Image Upload -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Featured Image</label>
                            <div class="mt-2 flex items-center space-x-6">
                                <div class="shrink-0">
                                    @if ($newImage)
                                        <img class="h-24 w-24 object-cover rounded-lg" src="{{ $newImage->temporaryUrl() }}" alt="New image preview">
                                    @elseif ($state['image_path'])
                                        <img class="h-24 w-24 object-cover rounded-lg" src="{{ Storage::url($state['image_path']) }}" alt="Current featured image">
                                    @else
                                        <div class="h-24 w-24 bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center">
                                            <svg class="h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true"><path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /></svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-grow">
                                    <input type="file" wire:model="newImage" id="image-upload" class="hidden">
                                    <label for="image-upload" class="cursor-pointer rounded-md bg-white dark:bg-gray-700 font-medium text-indigo-600 dark:text-indigo-400 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:text-indigo-500">
                                        <span>Upload a file</span>
                                    </label>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">PNG, JPG, GIF up to 2MB.</p>
                                    @if($state['image_path'])
                                    <button type="button" wire:click="removeImage" class="text-xs text-red-500 hover:text-red-700 mt-2">Remove image</button>
                                    @endif
                                    <div wire:loading wire:target="newImage" class="text-sm text-gray-500 mt-2">Uploading...</div>
                                </div>
                            </div>
                            @error('newImage') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <!-- YouTube URL -->
                        <div>
                            <label for="youtube_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">YouTube Video URL</label>
                            <input type="url" id="youtube_url" wire:model.lazy="state.youtube_url" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200" placeholder="https://www.youtube.com/watch?v=...">
                            @error('state.youtube_url') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div x-show="activeTab === 'seo'" x-transition class="space-y-6">
                        <!-- Meta Description -->
                        <div>
                            <label for="meta_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Meta Description</label>
                            <textarea id="meta_description" wire:model.lazy="state.meta_description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200" placeholder="A brief summary for search engines (max 160 characters)."></textarea>
                            @error('state.meta_description') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <!-- Meta Keywords -->
                        <div>
                            <label for="meta_keywords" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Meta Keywords</label>
                            <input type="text" id="meta_keywords" wire:model.lazy="state.meta_keywords" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200" placeholder="Comma-separated keywords: church, faith, community">
                            @error('state.meta_keywords') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </form>
            </div>

            <!-- Preview Mode -->
            <div x-show="previewMode" class="p-6 md:p-10" style="display: none;">
                <article class="prose prose-lg dark:prose-invert max-w-none">
                    <h1>{{ $state['heading'] ?: 'Your Heading Goes Here' }}</h1>
                    <p class="lead">{{ $state['subheading'] ?: 'A compelling subheading to draw the reader in.' }}</p>

                    @if($state['image_path'] || $newImage)
                        <figure>
                            <img src="{{ $newImage ? $newImage->temporaryUrl() : Storage::url($state['image_path']) }}" alt="Featured Image Preview" class="rounded-lg shadow-lg">
                        </figure>
                    @endif

                    <p>{{ $state['content'] ?: 'This is where your main content will be displayed. Write something engaging and informative about your church.' }}</p>

                    <div class="grid md:grid-cols-2 gap-8 my-8">
                        <div>
                            <h2>Our Mission</h2>
                            <ul>
                                @foreach(preg_split('/\\r\\n|\\r|\\n/', $state['mission_statement']) as $point)
                                    @if(trim($point))
                                        <li>{{ trim($point) }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <div>
                            <h2>Our Vision</h2>
                            <ul>
                                @foreach(preg_split('/\\r\\n|\\r|\\n/', $state['vision_statement']) as $point)
                                     @if(trim($point))
                                        <li>{{ trim($point) }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    
                    @if($state['youtube_url'])
                        @php
                            preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $state['youtube_url'], $matches);
                            $youtubeId = $matches[1] ?? null;
                        @endphp
                        @if($youtubeId)
                        <div class="aspect-w-16 aspect-h-9 my-8">
                            <iframe src="https://www.youtube.com/embed/{{ $youtubeId }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="rounded-lg shadow-lg"></iframe>
                        </div>
                        @endif
                    @endif

                </article>
            </div>
        </div>
    </div>
</div>
