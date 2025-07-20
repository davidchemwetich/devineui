<div>
    <div class="py-6">
        <div class="px-6 mx-auto max-w-7xl sm: lg:px-8">
            <h1 class="text-2xl font-bold">Manage Regions</h1>
            <div class="flex items-center justify-between mb-4">
                <input type="text" wire:model="searchTerm" placeholder="Search Regions..." class="p-2 border rounded">
                <button wire:click="openCreateModal" class="px-4 py-2 text-white bg-blue-500 rounded">Add
                    Region</button>
            </div>
            <table class="min-w-full border border-collapse border-gray-200">

                <thead>
                    <tr>
                        <th class="p-2 border border-gray-300">ID</th>
                        <th class="p-2 border border-gray-300">Name</th>
                        <th class="p-2 border border-gray-300">Clusters</th>
                        <th class="p-2 border border-gray-300">Churches</th>
                        <th class="p-2 border border-gray-300">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($regions as $region)
                    <tr>
                        <td class="p-2 border border-gray-300">{{ $region->id }}</td>
                        <td class="p-2 border border-gray-300">{{ $region->name }}</td>
                        <td class="p-2 border border-gray-300">{{ $region->clusters_count }}</td>
                        <td class="p-2 border border-gray-300">{{ $region->churches_count }}</td>
                        <td class="p-2 border border-gray-300">
                            <button wire:click="openEditModal({{ $region->id }})" class="text-yellow-500">Edit</button>
                            <button wire:click="deleteConfirm({{ $region->id }})" class="text-red-500">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $regions->links() }}
            </div>
        </div>
    </div>

    <!-- Modal for Create/Edit Region -->
    <!-- Modal for Create/Edit Region -->
    <div x-data="{ open: @entangle('showModal') }" x-show="open"
        class="fixed inset-0 z-50 flex items-center justify-center" x-cloak>
        <div class="fixed inset-0 bg-black opacity-50"></div>
        <div class="z-10 w-1/3 p-6 bg-white rounded shadow-lg">
            <h2 class="text-lg font-bold">{{ $modalTitle }}</h2>
            <form wire:submit.prevent="save">
                <div class="mt-4">
                    <label for="name" class="block">Region Name</label>
                    <input type="text" wire:model.defer="name" id="name" class="w-full p-2 border rounded" required>
                    @error('name') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                </div>
                <div class="flex justify-end mt-4">
                    <button type="button" wire:click="closeModal"
                        class="px-4 py-2 text-black bg-gray-300 rounded">Cancel</button>
                    <button type="submit" class="px-4 py-2 ml-2 text-white bg-blue-500 rounded">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
