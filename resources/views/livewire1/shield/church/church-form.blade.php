<div class="p-6 bg-white rounded-xl shadow-lg transition-all duration-300 
         dark:bg-gray-800 dark:shadow-gray-900/20 hover:shadow-xl"
     x-data="{ isUploading: false }"
     wire:loading.class="opacity-80">
    <div class="flex items-center gap-3 mb-6 pb-4 border-b dark:border-gray-700">
        <svg class="w-8 h-8 text-blue-500 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
        </svg>
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">
            {{ $churchId ? 'Edit Church' : 'Add Church' }}
        </h2>
    </div>

    <form wire:submit.prevent="saveChurch" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Name Field -->
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Church Name
                </label>
                <input type="text" wire:model="name" id="name"
                       class="w-full px-4 py-2.5 rounded-lg border-0 ring-1 ring-gray-300 
                              focus:ring-2 focus:ring-blue-500 transition-all
                              dark:bg-gray-700 dark:ring-gray-600 dark:text-gray-200
                              dark:focus:ring-blue-500 placeholder-gray-400"
                       placeholder="Enter church name" required>
                @error('name')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>@enderror
            </div>

            <!-- Region Select -->
            <div>
                <label for="region_id" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Region
                </label>
                <div class="relative">
                    <select wire:model="region_id" id="region_id"
                            class="w-full px-4 py-2.5 pr-10 rounded-lg appearance-none border-0 ring-1 ring-gray-300 
                                   focus:ring-2 focus:ring-blue-500 transition-all bg-white
                                   dark:bg-gray-700 dark:ring-gray-600 dark:text-gray-200
                                   dark:focus:ring-blue-500">
                        <option value="">Select Region</option>
                        @foreach($regions as $region)
                            <option value="{{ $region->id }}">{{ $region->name }}</option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </div>
                @error('region_id')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>@enderror
            </div>

            <!-- Cluster Select -->
            <div>
                <label for="cluster_id" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Cluster
                </label>
                <div class="relative">
                    <select wire:model="cluster_id" id="cluster_id"
                            class="w-full px-4 py-2.5 pr-10 rounded-lg appearance-none border-0 ring-1 ring-gray-300 
                                   focus:ring-2 focus:ring-blue-500 transition-all bg-white
                                   dark:bg-gray-700 dark:ring-gray-600 dark:text-gray-200
                                   dark:focus:ring-blue-500">
                        <option value="">Select Cluster</option>
                        @foreach($clusters as $cluster)
                            <option value="{{ $cluster->id }}">{{ $cluster->name }}</option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </div>
                @error('cluster_id')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>@enderror
            </div>

            <!-- Thumbnail Upload -->
            <div class="md:col-span-2">
                <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Thumbnail
                </label>
                <label class="flex flex-col items-center justify-center w-full p-6 border-2 border-dashed 
                            rounded-xl cursor-pointer transition-all hover:border-blue-500 
                            dark:border-gray-600 dark:hover:border-blue-500"
                       @dragover.prevent="isUploading = true" 
                       @dragleave.prevent="isUploading = false"
                       @drop.prevent="isUploading = false">
                    <input type="file" wire:model="thumbnail" id="thumbnail" class="hidden">
                    <svg class="w-12 h-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span class="text-sm text-gray-500 dark:text-gray-400">
                        Drag & drop or click to upload
                    </span>
                    @if($existing_thumbnail)
                        <img src="{{ Storage::url($existing_thumbnail) }}" 
                             class="mt-4 w-32 h-32 object-cover rounded-lg shadow hover:shadow-lg transition-all">
                    @endif
                </label>
                @error('thumbnail')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>@enderror
            </div>

            <!-- Google Map Iframe -->
            <div class="md:col-span-2">
                <label for="google_map_iframe" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Google Map Iframe
                </label>
                <textarea wire:model="google_map_iframe" id="google_map_iframe" 
                          class="w-full px-4 py-2.5 rounded-lg border-0 ring-1 ring-gray-300 
                                 focus:ring-2 focus:ring-blue-500 transition-all
                                 dark:bg-gray-700 dark:ring-gray-600 dark:text-gray-200
                                 dark:focus:ring-blue-500 placeholder-gray-400"
                          rows="4"
                          placeholder="Paste Google Map iframe code"></textarea>
                @error('google_map_iframe')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>@enderror
            </div>

            <!-- Address -->
            <div>
                <label for="address" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Address
                </label>
                <input type="text" wire:model="address" id="address"
                       class="w-full px-4 py-2.5 rounded-lg border-0 ring-1 ring-gray-300 
                              focus:ring-2 focus:ring-blue-500 transition-all
                              dark:bg-gray-700 dark:ring-gray-600 dark:text-gray-200
                              dark:focus:ring-blue-500 placeholder-gray-400"
                       placeholder="Enter full address" required>
                @error('address')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>@enderror
            </div>

            <!-- Contact Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="phone" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Phone
                    </label>
                    <input type="tel" wire:model="phone" id="phone"
                           class="w-full px-4 py-2.5 rounded-lg border-0 ring-1 ring-gray-300 
                                  focus:ring-2 focus:ring-blue-500 transition-all
                                  dark:bg-gray-700 dark:ring-gray-600 dark:text-gray-200
                                  dark:focus:ring-blue-500 placeholder-gray-400"
                           placeholder="+1 (555) 123-4567" required>
                    @error('phone')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Email
                    </label>
                    <input type="email" wire:model="email" id="email"
                           class="w-full px-4 py-2.5 rounded-lg border-0 ring-1 ring-gray-300 
                                  focus:ring-2 focus:ring-blue-500 transition-all
                                  dark:bg-gray-700 dark:ring-gray-600 dark:text-gray-200
                                  dark:focus:ring-blue-500 placeholder-gray-400"
                           placeholder="contact@church.com" required>
                    @error('email')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>@enderror
                </div>
            </div>

            <!-- Church Leader Select -->
            <div class="md:col-span-2">
                <label for="church_leader_user_id" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                    Church Leader
                </label>
                <div class="relative">
                    <select wire:model="church_leader_user_id" id="church_leader_user_id"
                            class="w-full px-4 py-2.5 pr-10 rounded-lg appearance-none border-0 ring-1 ring-gray-300 
                                   focus:ring-2 focus:ring-blue-500 transition-all bg-white
                                   dark:bg-gray-700 dark:ring-gray-600 dark:text-gray-200
                                   dark:focus:ring-blue-500">
                        <option value="">Select Church Leader</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </div>
                @error('church_leader_user_id')<p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>@enderror
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit" 
                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 
                           text-white font-semibold rounded-lg hover:from-blue-600 hover:to-blue-700 
                           transition-all transform hover:scale-[1.02] shadow-md
                           dark:from-blue-700 dark:to-blue-800 dark:hover:from-blue-800 dark:hover:to-blue-900"
                    wire:loading.attr="disabled">
                <span wire:loading.remove>
                    {{ $churchId ? 'Update Church' : 'Create Church' }}
                </span>
                <span wire:loading>
                    Processing...
                </span>
                <svg wire:loading class="animate-spin ml-3 h-5 w-5 text-white" 
                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                    <path class="opacity-75" fill="currentColor" 
                          d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"/>
                </svg>
            </button>
        </div>
    </form>
</div>