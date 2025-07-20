<div>
    <div class="mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">
            {{ $isEdit ? 'Edit Team Member' : 'Add Team Member' }}
        </h2>
        <p class="mt-1 text-gray-600">
            {{ $isEdit ? 'Update the details of an existing team member.' : 'Create a new team member.' }}
        </p>
    </div>

    <div class="p-6 bg-white rounded-lg shadow-md">
        <form wire:submit.prevent="save">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <!-- Team Category -->
                <div>
                    <label for="team_category_id" class="block mb-1 text-sm font-medium text-gray-700">
                        Category <span class="text-red-500">*</span>
                    </label>
                    <select id="team_category_id" wire:model="team_category_id"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('team_category_id') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- Name -->
                <div>
                    <label for="name" class="block mb-1 text-sm font-medium text-gray-700">
                        Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="name" wire:model="name"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                    @error('name') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- Role -->
                <div>
                    <label for="role" class="block mb-1 text-sm font-medium text-gray-700">
                        Role <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="role" wire:model="role"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                    @error('role') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- Location -->
                <div>
                    <label for="location" class="block mb-1 text-sm font-medium text-gray-700">
                        Location
                    </label>
                    <input type="text" id="location" wire:model="location"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                    @error('location') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block mb-1 text-sm font-medium text-gray-700">
                        Email
                    </label>
                    <input type="email" id="email" wire:model="email"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                    @error('email') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label for="phone" class="block mb-1 text-sm font-medium text-gray-700">
                        Phone
                    </label>
                    <input type="text" id="phone" wire:model="phone"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                    @error('phone') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- WhatsApp -->
                <div>
                    <label for="whatsapp" class="block mb-1 text-sm font-medium text-gray-700">
                        WhatsApp
                    </label>
                    <input type="text" id="whatsapp" wire:model="whatsapp"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                    @error('whatsapp') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- Facebook URL -->
                <div>
                    <label for="facebook_url" class="block mb-1 text-sm font-medium text-gray-700">
                        Facebook URL
                    </label>
                    <input type="url" id="facebook_url" wire:model="facebook_url"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                    @error('facebook_url') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- Order -->
                <div>
                    <label for="order" class="block mb-1 text-sm font-medium text-gray-700">
                        Display Order
                    </label>
                    <input type="number" id="order" wire:model="order" min="0"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                    @error('order') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block mb-1 text-sm font-medium text-gray-700">
                        Status
                    </label>
                    <select id="status" wire:model="status"
                        class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    @error('status') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Profile Image -->
            <div class="mt-6">
                <label class="block mb-1 text-sm font-medium text-gray-700">Profile Image</label>

                <div class="flex items-start space-x-4">
                    @if ($isEdit && $teamMember->profile_image)
                    <div>
                        <div class="w-32 h-32 overflow-hidden bg-gray-100 rounded-lg">
                            <img src="{{ $teamMember->profile_image_url }}" alt="{{ $teamMember->name }}"
                                class="object-cover w-full h-full">
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Current image</p>
                    </div>
                    @endif

                    <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                        x-on:livewire-upload-finish="isUploading = false"
                        x-on:livewire-upload-error="isUploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress">

                        <label
                            class="flex flex-col items-center px-4 py-6 bg-white border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:bg-gray-50">
                            <svg class="text-gray-400 w-8h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                </path>
                            </svg>
                            <span class="mt-2 text-sm text-gray-600">Click to upload or drag and drop</span>
                            <span class="mt-1 text-xs text-gray-500">PNG, JPG, GIF up to 1MB</span>
                            <input type="file" class="hidden" wire:model="newProfileImage">
                        </label>

                        <!-- Upload Progress -->
                        <div x-show="isUploading" class="mt-2">
                            <div class="bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                <div class="bg-blue-600 h-2.5 rounded-full" x-bind:style="`width: ${progress}%`"></div>
                            </div>
                            <span class="text-xs text-gray-500" x-text="`${progress}% uploaded`"></span>
                        </div>

                        <!-- Preview -->
                        @if($newProfileImage)
                        <div class="mt-2">
                            <div class="w-32 h-32 overflow-hidden bg-gray-100 rounded-lg">
                                <img src="{{ $newProfileImage->temporaryUrl() }}" class="object-cover w-full h-full">
                            </div>
                            <p class="mt-1 text-xs text-gray-500">New image preview</p>
                        </div>
                        @endif
                    </div>
                </div>
                @error('newProfileImage') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end mt-8 space-x-3">
                <a href=""
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Cancel
                </a>
                <button type="submit"
                    class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    {{ $isEdit ? 'Update Team Member' : 'Create Team Member' }}
                </button>
            </div>
        </form>
    </div>
</div>
