<div class="bg-white rounded-lg shadow-md p-6" x-data="{ isMapPreviewOpen: false }">
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">
            {{ $isEdit ? 'Edit Cluster' : 'Create New Cluster' }}
        </h2>
        <p class="text-gray-600">{{ $isEdit ? 'Update cluster information and leaders' : 'Add a new cluster to your organization' }}</p> </div>
    <form wire:submit.prevent="save">
        <div class="mb-4">
            <label for="region" class="block text-sm font-medium text-gray-700">Region</label>
            <select wire:model="cluster.region_id" id="region" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50">
                <option value="">Select a region</option>
                @foreach($availableRegions as $region)
                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                @endforeach
            </select>
            @error('cluster.region_id') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Cluster Name</label>
            <input type="text" wire:model="cluster.name" id="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" />
            @error('cluster.name') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="google_map_iframe" class="block text-sm font-medium text-gray-700">Google Map Iframe</label>
            <textarea wire:model="cluster.google_map_iframe" id="google_map_iframe" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50"></textarea>
            @error('cluster.google_map_iframe') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
            <input type="text" wire:model="cluster.address" id="address" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" />
            @error('cluster.address') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
            <input type="text" wire:model="cluster.phone" id="phone" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" />
            @error('cluster.phone') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" wire:model="cluster.email" id="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" />
            @error('cluster.email') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="leaders" class="block text-sm font-medium text-gray-700">Select Leaders</label>
            <input type="text" wire:model="searchTerm" placeholder="Search for users..." class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50" />
            <select wire:model="selectedLeaders" id="leaders" multiple class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50">
                @foreach($availableLeaders as $leader)
                    <option value="{{ $leader->id }}">{{ $leader->name }} ({{ $leader->email }})</option>
                @endforeach
            </select>
            @error('selectedLeaders') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-center justify-between">
            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                {{ $isEdit ? 'Update Cluster' : 'Create Cluster' }}
            </button>
        </div>
    </form>
</div>