<div x-data="{ activeTab: 'basic' }" class="min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
    <!-- Notification -->
    @if(session()->has('notification'))
    <div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform translate-y-4"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        class="fixed top-4 right-4 p-4 mb-4 rounded-lg text-sm
                {{ session('notification.type') === 'success' ? 'bg-green-100 dark:bg-green-800 text-green-700 dark:text-green-100' : 'bg-red-100 dark:bg-red-800 text-red-700 dark:text-red-100' }}"
        x-init="setTimeout(() => show = false, 3000)">
        {{ session('notification.message') }}
    </div>
    @endif

    <div class="mx-auto bg-white rounded-lg shadow-md max-w-7xl dark:bg-gray-800">
        <!-- Header -->
        <div class="px-6 py-4 border-b dark:border-gray-700">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">
                Manage About Church Content
            </h2>
        </div>

        <!-- Tabs -->
        <div class="border-b dark:border-gray-700">
            <nav class="flex px-6 space-x-4">
                <button @click="activeTab = 'basic'"
                    :class="{ 'border-b-2 border-blue-500 text-blue-600 dark:text-blue-400': activeTab === 'basic', 'text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300': activeTab !== 'basic' }"
                    class="px-4 py-3 text-sm font-medium focus:outline-none">
                    Basic Info
                </button>
                <button @click="activeTab = 'mission'"
                    :class="{ 'border-b-2 border-blue-500 text-blue-600 dark:text-blue-400': activeTab === 'mission', 'text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300': activeTab !== 'mission' }"
                    class="px-4 py-3 text-sm font-medium focus:outline-none">
                    Mission & Vision
                </button>
                <button @click="activeTab = 'media'"
                    :class="{ 'border-b-2 border-blue-500 text-blue-600 dark:text-blue-400': activeTab === 'media', 'text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300': activeTab !== 'media' }"
                    class="px-4 py-3 text-sm font-medium focus:outline-none">
                    Media
                </button>

                <button @click="activeTab = 'seo'"
                    :class="{ 'border-b-2 border-blue-500 text-blue-600 dark:text-blue-400': activeTab === 'seo', 'text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300': activeTab !== 'seo' }"
                    class="px-4 py-3 text-sm font-medium focus:outline-none">
                    SEO
                </button>
            </nav>
        </div>

        <!-- Form Content -->
        <form wire:submit.prevent="saveAboutUs" class="p-6 space-y-8">
            <!-- Basic Info Tab -->
            <div x-show="activeTab === 'basic'" class="space-y-6">
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Heading
                    </label>
                    <input type="text" wire:model="heading"
                        class="w-full border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:border-blue-500 focus:ring-blue-500">
                    @error('heading')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Subheading
                    </label>
                    <input type="text" wire:model="subheading"
                        class="w-full border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:border-blue-500 focus:ring-blue-500">
                    @error('subheading')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Content
                    </label>
                    <textarea wire:model="content" rows="8"
                        class="w-full border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:border-blue-500 focus:ring-blue-500"></textarea>
                    @error('content')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>

            <!-- Mission & Vision Tab -->
            <div x-show="activeTab === 'mission'" class="space-y-6">
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Mission Statement
                    </label>
                    <textarea wire:model="mission_statement" rows="6"
                        class="w-full border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Enter each mission point on a new line"></textarea>
                    @error('mission_statement')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Vision Statement
                    </label>
                    <textarea wire:model="vision_statement" rows="6"
                        class="w-full border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:border-blue-500 focus:ring-blue-500"
                        placeholder="Enter each vision point on a new line"></textarea>
                    @error('vision_statement')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>

            <!-- Media Tab -->
            <div x-show="activeTab === 'media'" class="space-y-6">
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Featured Image
                    </label>
                    <div class="flex items-center space-x-4">
                        <div
                            class="flex-shrink-0 w-32 h-32 overflow-hidden bg-gray-100 border-2 border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600">
                            @if($currentImagePath)
                            <img src="{{ Storage::url($currentImagePath) }}" class="object-cover w-full h-full">
                            @else
                            <div class="flex items-center justify-center w-full h-full text-gray-400">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            @endif
                        </div>
                        <div class="flex flex-col space-y-2">
                            <input type="file" wire:model="newImage" id="imageUpload" class="hidden">
                            <label for="imageUpload"
                                class="px-4 py-2 text-center text-white transition-colors bg-blue-600 rounded-lg cursor-pointer hover:bg-blue-700">
                                Upload New Image
                            </label>
                            @if($currentImagePath)
                            <button type="button" wire:click="$set('currentImagePath', null)"
                                class="px-4 py-2 text-red-600 transition-colors hover:text-red-800 dark:text-red-400 dark:hover:text-red-300">
                                Remove Image
                            </button>
                            @endif
                        </div>
                    </div>
                    @error('newImage')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                        YouTube Video URL
                    </label>
                    <input type="url" wire:model="youtube_url"
                        class="w-full border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:border-blue-500 focus:ring-blue-500"
                        placeholder="https://youtube.com/watch?v=...">
                    @error('youtube_url')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>

            <!-- SEO Tab -->
            <div x-show="activeTab === 'seo'" class="space-y-6">
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Meta Description
                    </label>
                    <textarea wire:model="meta_description" rows="3"
                        class="w-full border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:border-blue-500 focus:ring-blue-500"></textarea>
                    @error('meta_description')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Meta Keywords
                    </label>
                    <input type="text" wire:model="meta_keywords"
                        class="w-full border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 focus:border-blue-500 focus:ring-blue-500"
                        placeholder="church, community, faith, worship">
                    @error('meta_keywords')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>

            <!-- Form Footer -->
            <div class="pt-6 border-t dark:border-gray-700">
                <button type="submit"
                    class="px-6 py-3 font-medium text-white transition-colors bg-blue-600 rounded-lg hover:bg-blue-700">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
