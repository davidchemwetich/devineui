<div>
    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold">Manage Clusters</h1>
            <div class="flex items-center justify-between mb-4">
                <input type="text" wire:model="searchTerm" placeholder="Search Clusters..." class="p-2 border rounded">
                <select wire:model="filterRegion" class="p-2 border rounded">
                    <option value="">All Regions</option>
                    @foreach($regions as $region)
                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                    @endforeach
                </select>
                <button wire:click="openCreateModal" class="px-4 py-2 text-white bg-blue-500 rounded">Add
                    Cluster</button>
            </div>
            <table class="min-w-full border border-collapse border-gray-200">
                <thead>
                    <tr>
                        <th class="p-2 border border-gray-300">ID</th>
                        <th class="p-2 border border-gray-300">Region</th>
                        <th class="p-2 border border-gray-300">Cluster Name</th>
                        <th class="p-2 border border-gray-300">Churches</th>
                        <th class="p-2 border border-gray-300">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clusters as $cluster)
                    <tr>
                        <td class="p-2 border border-gray-300">{{ $cluster->id }}</td>
                        <td class="p-2 border border-gray-300">{{ $cluster->region->name }}</td>
                        <td class="p-2 border border-gray-300">{{ $cluster->cluster_name }}</td>
                        <td class="p-2 border border-gray-300">{{ $cluster->churches_count }}</td>
                        <td class="p-2 border border-gray-300">
                            <button wire:click="openEditModal({{ $cluster->id }})" class="text-yellow-500">Edit</button>
                            <button wire:click="deleteConfirm({{ $cluster->id }})" class="text-red-500">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $clusters->links() }}
            </div>
        </div>
    </div>

    <!-- Modal for Create/Edit Cluster -->
    <div x-data="{ open: @entangle('showModal') }" x-show="open"
        class="fixed inset-0 z-50 flex items-center justify-center" x-cloak>
        <div class="fixed inset-0 bg-black opacity-50"></div>
        <div class="z-10 w-1/3 p-6 bg-white rounded shadow-lg">
            <h2 class="text-lg font-bold">{{ $modalTitle }}</h2>
            <form wire:submit.prevent="save">
                <div class="mt-4">
                    <label for="region_id" class="block">Select Region</label>
                    <select wire:model.defer="region_id" id="region_id" class="w-full p-2 border rounded" required>
                        <option value="">Choose a Region</option>
                        @foreach($regions as $region)
                        <option value="{{ $region->id }}">{{ $region->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-4">
                    <label for="cluster_name" class="block">Cluster Name</label>
                    <input type="text" wire:model.defer="cluster_name" id="cluster_name"
                        class="w-full p-2 border rounded" required>
                </div>
                <div class="flex justify-end mt-4">
                    <button type="button" wire:click="$set('showModal', false)"
                        class="px-4 py-2 text-black bg-gray-300 rounded">Cancel</button>
                    <button type="submit" class="px-4 py-2 ml-2 text-white bg-blue-500 rounded">Save</button>
                </div>
            </form>
        </div>
    </div>
