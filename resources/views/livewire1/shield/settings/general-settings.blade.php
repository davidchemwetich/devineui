<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <form wire:submit.prevent="save" class="space-y-8 divide-y divide-gray-200/50">
        <!-- Success Message -->
        @if (session()->has('message'))
            <div x-data="{ show: true }" 
                 x-show="show"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform scale-90"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-end="opacity-0 transform scale-90"
                 class="rounded-lg bg-green-50 p-4 mb-6 shadow-sm">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">{{ session('message') }}</p>
                    </div>
                    <div class="ml-auto pl-3">
                        <button @click="show = false" class="-mx-1.5 -my-1.5 inline-flex rounded-lg p-1.5 text-green-800 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2">
                            <span class="sr-only">Dismiss</span>
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        @endif

        <!-- Logo Section -->
        <div class="space-y-8 pt-8">
            <div class="bg-white/50 backdrop-blur-sm p-6 rounded-xl shadow-sm border border-gray-200/30">
                <div class="sm:grid sm:grid-cols-3 sm:gap-6">
                    <div>
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Brand Assets</h3>
                        <p class="mt-1 text-sm text-gray-500">Upload your institution's visual identity</p>
                    </div>
                    
                    <div class="mt-5 sm:mt-0 sm:col-span-2 space-y-6">
                        <!-- Institution Logo -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Institution Logo</label>
                            <div x-data="{ isUploading: false, progress: 0 }" 
                                 x-on:livewire-upload-start="isUploading = true"
                                 x-on:livewire-upload-finish="isUploading = false"
                                 x-on:livewire-upload-error="isUploading = false"
                                 x-on:livewire-upload-progress="progress = $event.detail.progress"
                                 class="space-y-4">
                                @if ($settings->institution_logo && !$newLogo)
                                    <div class="relative group">
                                        <img src="{{ Storage::disk('public')->url($settings->institution_logo) }}" 
                                             alt="Current Logo"
                                             class="h-32 w-auto object-contain bg-gray-50 rounded-lg p-4 border border-gray-200">
                                        <button type="button"
                                                wire:click="removeExistingLogo"
                                                class="absolute -top-2 -right-2 bg-white rounded-full p-1 shadow-sm border border-gray-200 hover:bg-red-50 transition-colors">
                                            <svg class="h-5 w-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                @endif

                                @if ($newLogo)
                                    <div class="relative">
                                        <img src="{{ $newLogo->temporaryUrl() }}" 
                                             alt="New Logo Preview" 
                                             class="h-32 w-auto object-contain bg-gray-50 rounded-lg p-4 border border-gray-200">
                                        <button type="button"
                                                wire:click="$set('newLogo', null)"
                                                class="absolute -top-2 -right-2 bg-white rounded-full p-1 shadow-sm border border-gray-200 hover:bg-gray-50 transition-colors">
                                            <svg class="h-5 w-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                @endif

                                <div class="flex items-center justify-center w-full">
                                    <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed rounded-lg cursor-pointer border-gray-300 hover:border-blue-500 hover:bg-blue-50/50 transition-colors @error('newLogo') border-red-300 hover:border-red-500 @enderror">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg class="w-10 h-10 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                            </svg>
                                            <p class="text-sm text-gray-500">
                                                <span class="font-semibold text-blue-600">Click to upload</span> or drag and drop
                                            </p>
                                        </div>
                                        <input type="file" wire:model="newLogo" class="hidden" accept="image/*">
                                    </label>
                                </div>

                                @error('newLogo')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror

                                <div x-show="isUploading" class="pt-2">
                                    <div class="h-1 bg-gray-200 rounded-full">
                                        <div class="h-1 bg-blue-600 rounded-full transition-all duration-300" 
                                             :style="`width: $progress%`"></div>
                                    </div>
                                    <p class="mt-1 text-sm text-gray-500">Uploading... <span x-text="progress"></span>%</p>
                                </div>
                            </div>
                        </div>

                        <!-- Favicon -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Favicon (32x32)</label>
                            <div class="flex items-center space-x-4">
                                @if ($settings->favicon)
                                    <div class="relative">
                                        <img src="{{ Storage::url($settings->favicon) }}" 
                                             alt="Current Favicon"
                                             class="h-8 w-8 bg-gray-50 rounded p-1 border border-gray-200">
                                    </div>
                                @endif
                                <label class="flex-1">
                                    <input type="file" wire:model="newFavicon" class="sr-only">
                                    <div class="flex-1 cursor-pointer rounded-md border border-dashed border-gray-300 px-3 py-2 hover:border-blue-500 hover:bg-blue-50/50 transition-colors @error('newFavicon') border-red-300 hover:border-red-500 @enderror">
                                        <span class="text-sm text-gray-600">Choose favicon file...</span>
                                    </div>
                                </label>
                            </div>
                            @error('newFavicon')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- About Section -->
            <div class="bg-white/50 backdrop-blur-sm p-6 rounded-xl shadow-sm border border-gray-200/30">
                <div class="sm:grid sm:grid-cols-3 sm:gap-6">
                    <div>
                        <h3 class="text-lg font-medium leading-6 text-gray-900">About Institution</h3>
                        <p class="mt-1 text-sm text-gray-500">Describe your institution's mission and values</p>
                    </div>
                    <div class="mt-5 sm:mt-0 sm:col-span-2">
                        <textarea wire:model="about" rows="4" 
                                  class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('about') border-red-300 @enderror"></textarea>
                        @error('about')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="bg-white/50 backdrop-blur-sm p-6 rounded-xl shadow-sm border border-gray-200/30">
                <div class="sm:grid sm:grid-cols-3 sm:gap-6">
                    <div>
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Contact Details</h3>
                        <p class="mt-1 text-sm text-gray-500">Primary contact information for your institution</p>
                    </div>
                    <div class="mt-5 sm:mt-0 sm:col-span-2 space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Address</label>
                            <input type="text" wire:model="address" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('address') border-red-300 @enderror">
                            @error('address')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Phone</label>
                                <input type="text" wire:model="phone" 
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('phone') border-red-300 @enderror">
                                @error('phone')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" wire:model="email" 
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('email') border-red-300 @enderror">
                                @error('email')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Social Media -->
            <div class="bg-white/50 backdrop-blur-sm p-6 rounded-xl shadow-sm border border-gray-200/30">
                <div class="sm:grid sm:grid-cols-3 sm:gap-6">
                    <div>
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Social Media</h3>
                        <p class="mt-1 text-sm text-gray-500">Connect your social media profiles</p>
                    </div>
                    <div class="mt-5 sm:mt-0 sm:col-span-2 space-y-4">
                        @foreach(['facebook', 'twitter', 'instagram', 'linkedin'] as $platform)
                            <div>
                                <div class="flex rounded-md shadow-sm">
                                    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500">
                                        @switch($platform)
                                            @case('facebook')<svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.797v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>@break
                                            @case('twitter')<svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>@break
                                            @case('instagram')<svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.                                            case 'instagram'--><path d="M8.923 12.265c0 1.632 1.325 2.957 2.957 2.957 1.632 0 2.956-1.325 2.956-2.957a2.958 2.958 0 0 0-2.956-2.957 2.958 2.958 0 0 0-2.957 2.957zm10.947-5.029a6.464 6.464 0 0 1-6.464 6.464H6.464A6.464 6.464 0 0 1 0 7.236V6.464A6.464 6.464 0 0 1 6.464 0h6.942a6.464 6.464 0 0 1 6.464 6.464v.772zm-4.007 0a2.957 2.957 0 1 0-5.914 0 2.957 2.957 0 0 0 5.914 0zM12 5.715c3.497 0 6.332 2.835 6.332 6.332S15.497 18.379 12 18.379 5.668 15.544 5.668 12.047 8.503 5.715 12 5.715z"/></svg>@break
                                            @case('linkedin')<svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>@break
                                        @endswitch
                                    </span>
                                    <input type="url" wire:model="socialLinks.{{ $platform }}" 
                                           class="flex-1 rounded-none rounded-r-md border-gray-300 focus:border-blue-500 focus:ring-blue-500 block w-full min-w-0 sm:text-sm"
                                           placeholder="{{ ucfirst($platform) }} URL">
                                </div>
                                @error('socialLinks.'.$platform)
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="pt-8">
            <div class="flex justify-end gap-3">
                <button type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Cancel
                </button>
                <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
                    <svg wire:loading wire:target="save" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Save Changes
                </button>
            </div>
        </div>
    </form>
</div>