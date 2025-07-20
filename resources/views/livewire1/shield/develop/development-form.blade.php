<div class="py-6">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-xl dark:bg-gray-800 sm:rounded-lg">
            <!-- Header Section -->
            <div class="p-6 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-blue-500 to-indigo-600">
                <h2 class="text-xl font-semibold leading-tight text-white">
                    {{ $isEditMode ? 'Edit Development Project' : 'Create Development Project' }}
                </h2>
            </div>

            <form wire:submit.prevent="save" class="p-6">
                <!-- General Information -->
                <div class="mb-8">
                    <h3 class="mb-4 text-lg font-medium text-gray-900 dark:text-gray-100">General Information</h3>
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <!-- Title -->
                        <div class="col-span-2">
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title
                                <span class="text-red-500">*</span></label>
                            <input type="text" wire:model="development.title" id="title"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            @error('development.title') <span class="mt-1 text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="col-span-2">
                            <label for="description"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description <span
                                    class="text-red-500">*</span></label>
                            <textarea wire:model="development.description" id="description" rows="5"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                            @error('development.description') <span class="mt-1 text-xs text-red-500">{{ $message
                                }}</span> @enderror
                        </div>

                        <!-- Type & Status -->
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Type
                                <span class="text-red-500">*</span></label>
                            <select wire:model="development.type" id="type"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Select Type</option>
                                @foreach($types as $type)
                                <option value="{{ $type }}">{{ $type }}</option>
                                @endforeach
                            </select>
                            @error('development.type') <span class="mt-1 text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="status"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status <span
                                    class="text-red-500">*</span></label>
                            <select wire:model="development.status" id="status"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                @foreach($statuses as $status)
                                <option value="{{ $status }}">{{ $status }}</option>
                                @endforeach
                            </select>
                            @error('development.status') <span class="mt-1 text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Dates -->
                        <div>
                            <label for="start_date"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Start Date</label>
                            <input type="date" wire:model="development.start_date" id="start_date"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            @error('development.start_date') <span class="mt-1 text-xs text-red-500">{{ $message
                                }}</span> @enderror
                        </div>

                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">End
                                Date</label>
                            <input type="date" wire:model="development.end_date" id="end_date"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            @error('development.end_date') <span class="mt-1 text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Location -->
                        <div class="col-span-2">
                            <label for="location"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Location</label>
                            <input type="text" wire:model="development.location" id="location"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            @error('development.location') <span class="mt-1 text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Featured Image -->
                        <div class="col-span-2" x-data="{ isUploading: false, progress: 0 }"
                            x-on:livewire-upload-start="isUploading = true"
                            x-on:livewire-upload-finish="isUploading = false"
                            x-on:livewire-upload-error="isUploading = false"
                            x-on:livewire-upload-progress="progress = $event.detail.progress">
                            <label for="featured_image"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Featured Image {{
                                $isEditMode ? '' : '<span class="text-red-500">*</span>' }}</label>
                            <div
                                class="flex justify-center px-6 pt-5 pb-6 mt-2 border-2 border-gray-300 border-dashed rounded-md dark:border-gray-700">
                                <div class="space-y-1 text-center">
                                    @if ($featured_image)
                                    <div class="mb-4">
                                        <img src="{{ $featured_image->temporaryUrl() }}" alt="Preview"
                                            class="object-cover h-32 mx-auto rounded">
                                    </div>
                                    @elseif ($isEditMode && $development->featured_image)
                                    <div class="mb-4">
                                        <img src="{{ Storage::url($development->featured_image) }}"
                                            alt="{{ $development->title }}" class="object-cover h-32 mx-auto rounded">
                                    </div>
                                    @else
                                    <svg class="w-12 h-12 mx-auto text-gray-400" stroke="currentColor" fill="none"
                                        viewBox="0 0 48 48">
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    @endif

                                    <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                        <label for="featured_image"
                                            class="relative font-medium text-indigo-600 bg-white rounded-md cursor-pointer dark:bg-gray-800 dark:text-indigo-400 hover:text-indigo-500 dark:hover:text-indigo-300 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                            <span>Upload a image</span>
                                            <input id="featured_image" wire:model="featured_image" type="file"
                                                class="sr-only" accept="image/*">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        PNG, JPG, GIF up to 1MB
                                    </p>
                                </div>
                            </div>

                            <!-- Progress Bar -->
                            <div x-show="isUploading" class="mt-2">
                                <div class="overflow-hidden bg-gray-200 rounded-full dark:bg-gray-700">
                                    <div class="h-2 bg-indigo-600 rounded-full" :style="`width: ${progress}%`"></div>
                                </div>
                                <p class="mt-1 text-xs text-center text-gray-500 dark:text-gray-400"
                                    x-text="`Uploading: ${progress}%`"></p>
                            </div>

                            @error('featured_image') <span class="mt-1 text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Financial Information -->
                <div class="mb-8">
                    <h3 class="mb-4 text-lg font-medium text-gray-900 dark:text-gray-100">Financial Information</h3>
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <label for="target_amount"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Target Amount
                                (KSh)</label>
                            <div class="relative mt-1 rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <span class="text-gray-500 dark:text-gray-400 sm:text-sm">KSh</span>
                                </div>
                                <input type="number" wire:model="development.target_amount" id="target_amount"
                                    step="0.01" min="0"
                                    class="block w-full pl-10 mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                            @error('development.target_amount') <span class="mt-1 text-xs text-red-500">{{ $message
                                }}</span> @enderror
                        </div>

                        <div>
                            <label for="donation_link"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">External Donation
                                Link</label>
                            <input type="url" wire:model="development.donation_link" id="donation_link"
                                placeholder="https://..."
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            @error('development.donation_link') <span class="mt-1 text-xs text-red-500">{{ $message
                                }}</span> @enderror
                        </div>
                    </div>
                </div>

                <!-- Team Information -->
                <div class="mb-8">
                    <h3 class="mb-4 text-lg font-medium text-gray-900 dark:text-gray-100">Team Information</h3>
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <label for="project_lead"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Project Lead</label>
                            <select wire:model="development.project_lead" id="project_lead"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Select Project Lead</option>
                                @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('development.project_lead') <span class="mt-1 text-xs text-red-500">{{ $message
                                }}</span> @enderror
                        </div>

                        <div x-data="{ volunteersNeeded: @entangle('development.volunteer_needed') }">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Volunteers
                                Needed?</label>
                            <div class="mt-2">
                                <label class="inline-flex items-center">
                                    <input type="radio" x-model="volunteersNeeded"
                                        wire:model="development.volunteer_needed"
                                        class="w-4 h-4 text-indigo-600 border-gray-300 form-radio dark:text-indigo-500 dark:border-gray-700 focus:ring-indigo-500"
                                        name="volunteer_needed" value="1">
                                    <span class="ml-2 text-gray-700 dark:text-gray-300">Yes</span>
                                </label>
                                <label class="inline-flex items-center ml-6">
                                    <input type="radio" x-model="volunteersNeeded"
                                        wire:model="development.volunteer_needed"
                                        class="w-4 h-4 text-indigo-600 border-gray-300 form-radio dark:text-indigo-500 dark:border-gray-700 focus:ring-indigo-500"
                                        name="volunteer_needed" value="0">
                                    <span class="ml-2 text-gray-700 dark:text-gray-300">No</span>
                                </label>
                            </div>

                            <div x-show="volunteersNeeded" class="mt-3">
                                <label for="volunteer_description"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Volunteer
                                    Description</label>
                                <textarea wire:model="development.volunteer_description" id="volunteer_description"
                                    rows="3"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                    placeholder="Describe what help is needed..."></textarea>
                                @error('development.volunteer_description') <span class="mt-1 text-xs text-red-500">{{
                                    $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Metadata -->
                <div class="mb-8">
                    <h3 class="mb-4 text-lg font-medium text-gray-900 dark:text-gray-100">Metadata</h3>
                    <div>
                        <label for="tags"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tags</label>
                        <input type="text" wire:model="tags" id="tags"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                            placeholder="fundraising, community, etc. (comma separated)">
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Separate tags with commas.</p>
                        @error('tags') <span class="mt-1 text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex justify-end space-x-3">
                    <a href="{{ route(config('app.admin_prefix') . '.development.index') }}"
                        class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-gray-700 uppercase transition bg-gray-200 border border-transparent rounded-md dark:bg-gray-700 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600 active:bg-gray-400 dark:active:bg-gray-500 focus:outline-none focus:border-gray-400 dark:focus:border-gray-500 focus:ring focus:ring-gray-200 dark:focus:ring-gray-600 disabled:opacity-25">
                        Cancel
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-300 disabled:opacity-25">
                        {{ $isEditMode ? 'Update Project' : 'Create Project' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
