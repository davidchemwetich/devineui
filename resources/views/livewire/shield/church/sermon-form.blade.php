<div class="max-w-6xl px-4 py-8 mx-auto sermon-form-container sm:px-6 lg:px-8">
    <div class="overflow-hidden bg-white rounded-lg shadow-xl">
        <!-- Form Header -->
        <div class="px-6 py-4 bg-gradient-to-r from-blue-700 to-indigo-800">
            <h1 class="text-2xl font-bold text-white">
                {{ $sermonId ? 'Edit Sermon' : 'Create New Sermon' }}
            </h1>
            <p class="mt-1 text-blue-100">{{ $sermonId ? 'Update sermon details' : 'Share the Word with your
                congregation' }}</p>
        </div>

        <!-- Form Body -->
        <div class="p-6" x-data="{
            activeTab: 'basic',
            isUploading: false,
            audioFileName: '{{ $existing_audio_path ? basename($existing_audio_path) : 'No file chosen' }}',
            pdfFileName: '{{ $existing_pdf_path ? basename($existing_pdf_path) : 'No file chosen' }}',
            imagePreview: '{{ $existing_cover_image ? asset(" storage/".$existing_cover_image) : null }}' }">
            <!-- Flash Messages -->
            @if (session()->has('message'))
            <div class="p-4 mb-6 text-green-700 bg-green-100 border-l-4 border-green-500" role="alert">
                <p>{{ session('message') }}</p>
            </div>
            @endif

            @if (session()->has('error'))
            <div class="p-4 mb-6 text-red-700 bg-red-100 border-l-4 border-red-500" role="alert">
                <p>{{ session('error') }}</p>
            </div>
            @endif

            <!-- Form Tabs -->
            <div class="mb-6 border-b border-gray-200">
                <nav class="flex -mb-px">
                    <button @click="activeTab = 'basic'" class="px-5 py-3 text-sm font-medium leading-5 border-b-2"
                        :class="{'border-indigo-500 text-indigo-600': activeTab === 'basic', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'basic'}">
                        Basic Info
                    </button>
                    <button @click="activeTab = 'media'" class="px-5 py-3 ml-8 text-sm font-medium leading-5 border-b-2"
                        :class="{'border-indigo-500 text-indigo-600': activeTab === 'media', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'media'}">
                        Media Files
                    </button>
                    <button @click="activeTab = 'settings'"
                        class="px-5 py-3 ml-8 text-sm font-medium leading-5 border-b-2"
                        :class="{'border-indigo-500 text-indigo-600': activeTab === 'settings', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'settings'}">
                        Settings
                    </button>
                </nav>
            </div>

            <form wire:submit.prevent="submit" class="space-y-6">
                <!-- Basic Info Tab -->
                <div x-show="activeTab === 'basic'">
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <!-- Title -->
                        <div class="col-span-2">
                            <label for="title" class="block text-sm font-bold text-gray-700">Title</label>
                            <input type="text" id="title" wire:model.defer="title"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                required>
                            @error('title') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <!-- Description -->
                        <div class="col-span-2">
                            <label for="description" class="block text-sm font-bold text-gray-700">Description</label>
                            <textarea id="description" wire:model.defer="description" rows="3"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                            @error('description') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <!-- Preached On -->
                        <div>
                            <label for="preached_on" class="block text-sm font-bold text-gray-700">Preached On</label>
                            <input type="date" id="preached_on" wire:model.defer="preached_on"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('preached_on') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <!-- Category -->
                        <div>
                            <label for="category" class="block text-sm font-bold text-gray-700">Category</label>
                            <select id="category" wire:model.defer="category"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Select a category</option>
                                <option value="Faith">Faith</option>
                                <option value="Family">Family</option>
                                <option value="End Times">End Times</option>
                                <option value="Other">Other</option>
                            </select>
                            @error('category') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <!-- Featured -->
                        <div class="col-span-2">
                            <label class="inline-flex items-center">
                                <input type="checkbox" wire:model.defer="is_featured"
                                    class="w-5 h-5 text-indigo-600 form-checkbox">
                                <span class="ml-2 text-gray-700">Featured Sermon</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Media Files Tab -->
                <div x-show="activeTab === 'media'">
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <!-- Audio File -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700">Audio File</label>
                            <input type="file" wire:model="audio" accept="audio/*"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                @change="audioFileName = $event.target.files[0] ? $event.target.files[0].name : 'No file chosen'">
                            <p class="mt-1 text-sm text-gray-500" x-text="audioFileName"></p>
                            @error('audio') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <!-- Video URL -->
                        <div>
                            <label for="video_url" class="block text-sm font-bold text-gray-700">YouTube Video
                                URL</label>
                            <input type="url" id="video_url" wire:model.defer="video_url"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Enter YouTube link">
                            @error('video_url') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <!-- PDF File -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700">PDF File</label>
                            <input type="file" wire:model="pdf" accept="application/pdf"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                @change="pdfFileName = $event.target.files[0] ? $event.target.files[0].name : 'No file chosen'">
                            <p class="mt-1 text-sm text-gray-500" x-text="pdfFileName"></p>
                            @error('pdf') <span class="text-sm text -red-500">{{ $message }}</span> @enderror
                        </div>

                        <!-- Cover Image -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700">Cover Image</label>
                            <input type="file" wire:model="cover_image" accept="image/*"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                @change="imagePreview = $event.target.files[0] ? URL.createObjectURL($event.target.files[0]) : null">
                            <p class="mt-1 text-sm text-gray-500" x-show="imagePreview">Preview:</p>
                            <img x-show="imagePreview" :src="imagePreview"
                                class="object-cover w-full h-32 mt-2 rounded-md" alt="Cover Image Preview">
                            @error('cover_image') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <!-- Settings Tab -->
                <div x-show="activeTab === 'settings'">
                    <div class="grid grid-cols-1 gap-6">
                        <div class="col-span-2">
                            <h2 class="text-lg font-bold text-gray-700">Settings</h2>
                            <p class="text-sm text-gray-500">Adjust the settings for your sermon.</p>
                        </div>
                        <!-- Additional settings can be added here -->
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 mt-4 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ $sermonId ? 'Update Sermon' : 'Create Sermon' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
