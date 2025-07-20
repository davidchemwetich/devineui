<div>
    @if (session()->has('error'))
        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="p-6 bg-white rounded-lg shadow dark:bg-gray-800">
        <form wire:submit.prevent="save" class="space-y-6">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Event Title</label>
                    <input type="text" id="title" wire:model.defer="title" 
                           class="block w-full mt-1 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    @error('title')<span class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</span>@enderror
                </div>

                <!-- Ministry Selection -->
                <div>
                    <label for="ministry_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Ministry</label>
                    <select id="ministry_id" wire:model.defer="ministry_id" 
                            class="block w-full mt-1 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Select Ministry</option>
                        @foreach($ministries as $ministry)
                            <option value="{{ $ministry->id }}">{{ $ministry->name }}</option>
                        @endforeach
                    </select>
                    @error('ministry_id')<span class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</span>@enderror
                </div>

                <!-- Event Date -->
                <div>
                    <label for="event_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Event Date & Time</label>
                    <input type="datetime-local" id="event_date" wire:model.defer="event_date" 
                           class="block w-full mt-1 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    @error('event_date')<span class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</span>@enderror
                </div>

                <!-- Location -->
                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Location</label>
                    <input type="text" id="location" wire:model.defer="location" 
                           class="block w-full mt-1 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    @error('location')<span class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</span>@enderror
                </div>

                <!-- Coordinates (Alpine Toggle) -->
                <div x-data="{ showCoords: {{ ($lat || $lng) ? 'true' : 'false' }} }" class="col-span-2 space-y-2">
                    <div class="flex items-center gap-2">
                        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Coordinates</label>
                        <button type="button" @click="showCoords = !showCoords" 
                                class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">
                            <span x-text="showCoords ? 'Remove coordinates' : 'Add coordinates'"></span>
                        </button>
                    </div>
                    
                    <div x-show="showCoords" class="grid grid-cols-2 gap-4">
                        <div>
                            <input type="number" step="any" wire:model.defer="lat" placeholder="Latitude"
                                   class="block w-full rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            @error('lat')<span class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</span>@enderror
                        </div>
                        <div>
                            <input type="number" step="any" wire:model.defer="lng" placeholder="Longitude"
                                   class="block w-full rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            @error('lng')<span class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <!-- Location URL -->
                <div>
                    <label for="location_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Location URL</label>
                    <input type="url" id="location_url" wire:model.defer="location_url" 
                           class="block w-full mt-1 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    @error('location_url')<span class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</span>@enderror
                </div>
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                <textarea id="description" wire:model.defer="description" rows="4"
                          class="block w-full mt-1 rounded-md shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                @error('description')<span class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</span>@enderror
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end gap-4 mt-8">
                <button type="submit" 
                        class="px-4 py-2 text-white bg-indigo-600 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                    {{ $ministryEvent->id ? 'Update' : 'Create' }} Event
                </button>
                <a href="{{ route(config('app.admin_prefix') . '.ministry.events.index') }}" 
                   class="px-4 py-2 text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 dark:text-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                    Cancel
                </a>
            </div>
        </form>
    </div>
    @livewireScripts
    <script src="//unpkg.com/alpinejs" defer></script>
</div>