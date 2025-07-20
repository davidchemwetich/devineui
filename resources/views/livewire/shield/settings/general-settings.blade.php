<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div x-data="{
            showNotification: false,
            notificationMessage: '',
            notificationType: 'success',
            notify(detail) {
                this.notificationMessage = detail.message;
                this.notificationType = detail.type;
                this.showNotification = true;
                setTimeout(() => { this.showNotification = false }, 5000);
            }
        }"
         @notify.window="notify($event.detail)"
         class="max-w-5xl mx-auto">

        <!-- Notification Panel -->
        <div x-show="showNotification"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform translate-y-2"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform translate-y-2"
             class="fixed top-5 right-5 z-50">
            <div class="flex items-center p-4 rounded-lg shadow-lg"
                 :class="{ 'bg-green-500 text-white': notificationType === 'success', 'bg-red-500 text-white': notificationType === 'error' }">
                <div class="flex-shrink-0">
                    <svg x-show="notificationType === 'success'" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <svg x-show="notificationType === 'error'" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-3 font-medium" x-text="notificationMessage"></div>
                <button @click="showNotification = false" class="ml-4 -mr-1 flex p-1 rounded-md focus:outline-none focus:ring-2 focus:ring-white">
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>

        <form wire:submit.prevent="save" class="space-y-10">
            <!-- Section: Brand Assets -->
            <div class="bg-white dark:bg-gray-800/50 backdrop-blur-sm border border-gray-200 dark:border-gray-700/50 rounded-2xl shadow-sm overflow-hidden">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Brand Assets</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Upload your App's visual identity.</p>
                </div>
                <div class="border-t border-gray-200 dark:border-gray-700/50 p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Logo Upload -->
                    <div class="md:col-span-1">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">App Logo</label>
                        <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, GIF up to 2MB.</p>
                    </div>
                    <div class="md:col-span-2">
                         <div x-data="{ isUploading: false, progress: 0 }" 
                             x-on:livewire-upload-start="isUploading = true"
                             x-on:livewire-upload-finish="isUploading = false"
                             x-on:livewire-upload-error="isUploading = false"
                             x-on:livewire-upload-progress="progress = $event.detail.progress"
                             class="space-y-4">
                            
                            <div class="flex items-center space-x-6">
                                @if ($newLogo)
                                    <img src="{{ $newLogo->temporaryUrl() }}" class="h-20 w-20 object-cover rounded-full bg-gray-100 dark:bg-gray-700">
                                @elseif ($settings->institution_logo)
                                     <img src="{{ Storage::url($settings->institution_logo) }}" alt="Current Logo" class="h-20 w-20 object-cover rounded-full bg-gray-100 dark:bg-gray-700">
                                @else
                                    <span class="flex items-center justify-center h-20 w-20 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-400 dark:text-gray-500">
                                        <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </span>
                                @endif
                                <div class="flex items-center gap-x-3">
                                    <label for="logo-upload" class="cursor-pointer rounded-md bg-white dark:bg-gray-700 px-3 py-2 text-sm font-semibold text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <span>Change</span>
                                        <input id="logo-upload" wire:model="newLogo" type="file" class="sr-only">
                                    </label>
                                    @if($settings->institution_logo)
                                    <button type="button" wire:click="removeExistingLogo" class="text-sm font-semibold text-red-600 dark:text-red-400 hover:text-red-500">Remove</button>
                                    @endif
                                </div>
                            </div>
                            @error('newLogo') <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                            
                            <!-- Progress Bar -->
                            <div x-show="isUploading" class="w-full bg-gray-200 dark:bg-gray-600 rounded-full h-2.5">
                                <div class="bg-blue-600 h-2.5 rounded-full" :style="`width: ${progress}%`"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Favicon Upload -->
                    <div class="md:col-span-1">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Favicon</label>
                        <p class="text-xs text-gray-500 dark:text-gray-400">32x32px ICO, PNG.</p>
                    </div>
                    <div class="md:col-span-2">
                        <div class="flex items-center space-x-4">
                             @if ($newFavicon)
                                <img src="{{ $newFavicon->temporaryUrl() }}" class="h-8 w-8 rounded-md bg-gray-100 dark:bg-gray-700">
                            @elseif ($settings->favicon)
                                <img src="{{ Storage::url($settings->favicon) }}" alt="Current Favicon" class="h-8 w-8 rounded-md bg-gray-100 dark:bg-gray-700">
                            @else
                                <span class="flex items-center justify-center h-8 w-8 rounded-md bg-gray-100 dark:bg-gray-700 text-gray-400 dark:text-gray-500">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                </span>
                            @endif
                            <label for="favicon-upload" class="cursor-pointer rounded-md bg-white dark:bg-gray-700 px-3 py-2 text-sm font-semibold text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-600 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <span>Upload Favicon</span>
                                <input id="favicon-upload" wire:model="newFavicon" type="file" class="sr-only">
                            </label>
                             @if($settings->favicon)
                                <button type="button" wire:click="removeExistingFavicon" class="text-sm font-semibold text-red-600 dark:text-red-400 hover:text-red-500">Remove</button>
                            @endif
                        </div>
                        @error('newFavicon') <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>
            
            <!-- Section: About & Contact -->
            <div class="bg-white dark:bg-gray-800/50 backdrop-blur-sm border border-gray-200 dark:border-gray-700/50 rounded-2xl shadow-sm overflow-hidden">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">About & Contact</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Institution details and contact information.</p>
                </div>
                <div class="border-t border-gray-200 dark:border-gray-700/50 p-6 grid grid-cols-1 md:grid-cols-3 gap-x-6 gap-y-8">
                    <!-- About -->
                    <div class="md:col-span-1">
                        <label for="about" class="block text-sm font-medium text-gray-700 dark:text-gray-300">About App</label>
                    </div>
                    <div class="md:col-span-2">
                        <textarea id="about" wire:model.defer="about" rows="4" class="block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                        @error('about') <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                    </div>

                    <!-- Address -->
                    <div class="md:col-span-1">
                        <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
                    </div>
                    <div class="md:col-span-2">
                        <input type="text" id="address" wire:model.defer="address" class="block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('address') <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                    </div>

                    <!-- Phone -->
                    <div class="md:col-span-1">
                        <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone</label>
                    </div>
                    <div class="md:col-span-2">
                        <input type="tel" id="phone" wire:model.defer="phone" class="block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('phone') <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                    </div>

                    <!-- Email -->
                    <div class="md:col-span-1">
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                    </div>
                    <div class="md:col-span-2">
                        <input type="email" id="email" wire:model.defer="email" class="block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('email') <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <!-- Section: Social Media -->
            <div class="bg-white dark:bg-gray-800/50 backdrop-blur-sm border border-gray-200 dark:border-gray-700/50 rounded-2xl shadow-sm overflow-hidden">
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Social Media</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Connect your social media profiles.</p>
                </div>
                <div class="border-t border-gray-200 dark:border-gray-700/50 p-6 space-y-6">
                    @foreach(['facebook', 'twitter', 'instagram', 'linkedin'] as $platform)
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-x-6">
                        <label for="{{ $platform }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 capitalize">{{ $platform }}</label>
                        <div class="md:col-span-2">
                             <div class="flex rounded-md shadow-sm">
                                <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-500 dark:text-gray-400 text-sm">
                                    https://{{$platform}}.com/
                                </span>
                                <input type="text" id="{{ $platform }}" wire:model.defer="socialLinks.{{ $platform }}" placeholder="username" class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                            </div>
                            @error('socialLinks.'.$platform) <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end items-center gap-x-4 pt-5">
                 <button type="button" class="text-sm font-semibold leading-6 text-gray-900 dark:text-white">Cancel</button>
                 <button type="submit" 
                        wire:loading.attr="disabled"
                        class="inline-flex justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:opacity-50">
                    <svg wire:loading wire:target="save" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span wire:loading.remove wire:target="save">Save Changes</span>
                    <span wire:loading wire:target="save">Saving...</span>
                </button>
            </div>
        </form>
    </div>
</div>
