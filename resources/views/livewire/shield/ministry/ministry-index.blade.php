<div>
    <div class="flex justify-between items-center mb-4">
        <input type="text" wire:model="search" placeholder="Search ministries..." class="border rounded p-2">
        <select wire:model="leaderFilter" class="border rounded p-2">
            <option value="">All Leaders</option>
            @foreach($leaders as $leader)
                <option value="{{ $leader->id }}">{{ $leader->name }}</option>
            @endforeach
        </select>
        <button wire:click="resetFilters" class="bg-blue-500 text-white rounded p-2">Reset Filters</button>
    </div>

    <table class="min-w-full border-collapse border border-gray-200">
        <thead>
            <tr>
                <th wire:click="sortBy('name')" class="cursor-pointer">Ministry Name</th>
                <th wire:click="sortBy('leader_id')" class="cursor-pointer">Leader</th>
                <th wire:click="sortBy('created_at')" class="cursor-pointer">Created At</th>
                <th class="text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ministries as $ministry)
                <tr>
                    <td>{{ $ministry->name }}</td>
                    <td>{{ $ministry->leader ? $ministry->leader->name : 'N/A' }}</td>
                    <td>{{ $ministry->created_at->format('Y-m-d') }}</td>
                    <td class="text-right">
                        <button wire:click="confirmDelete({{ $ministry->id }})" class="text-red-500">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $ministries->links() }}
    </div>

    @if($confirmingDeletion)
        <div class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
            <div class="bg-white p-6 rounded shadow-lg">
                <h2 class="text-lg font-bold">Confirm Deletion</h2>
                <p>Are you sure you want to delete this ministry?</p>
                <div class="flex justify-end mt-4">
                    <button wire:click="cancelDelete" class="mr-2 bg-gray-300 rounded p-2">Cancel</button>
                    <button wire:click="deleteMinistry" class="bg-red-500 text-white rounded p-2">Delete</button>
                </div>
            </div>
        </div>
    @endif

    @if(session()->has('message'))
        <div class="mt-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('message') }}
        </div>
    @endif

    @if(session()->has('error'))
        <div class="mt-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
            {{ session('error') }}
        </div>
    @endif
</div>


{{-- <div>
    <div class="mb-4 flex justify-between">
        <input type="text" wire:model="search" placeholder="Search ministries..." class="border rounded-md p-2">
        <a href="{{ route(config('app.admin_prefix') . '.ministry.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md">Add Ministry</a>
    </div>

    <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Leader</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($ministries as $ministry)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $ministry->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $ministry->leader ? $ministry->leader->name : 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{route(config('app.admin_prefix') . '.ministry.edit', $ministry->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            <button wire:click="deleteMinistry({{ $ministry->id }})" class="text-red-600 hover:text-red-900 ml-4">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $ministries->links() }}
    </div>
</div> --}}