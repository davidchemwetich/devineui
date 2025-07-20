<div class="min-h-screen bg-gray-50 dark:bg-gray-900 p-6">
    <!-- Search and Add Section -->
    <div class="flex flex-col sm:flex-row justify-between gap-4 mb-6">
        <div class="relative flex-1">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            <input 
                type="text" 
                wire:model.debounce.300ms="searchTerm" 
                placeholder="Search churches..." 
                class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-600 transition-all"
            >
        </div>
        <button 
            wire:click="createChurch"
            class="flex items-center justify-center gap-2 px-4 py-2.5 bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-lg transition-all transform hover:scale-105 shadow-lg hover:shadow-blue-500/20"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add Church
        </button>
    </div>

    <!-- Table Section -->
    <div class="rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 shadow-sm overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Address</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($churches as $church)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">{{ $church->name }}</td>
                        <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $church->address }}</td>
                        <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $church->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end gap-3">
                                <button 
                                    wire:click="editChurch({{ $church->id }})"
                                    class="text-blue-500 hover:text-blue-700 dark:hover:text-blue-400 transition-colors flex items-center gap-1.5"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                    </svg>
                                    <span>Edit</span>
                                </button>
                                <button 
                                    wire:click="showDeleteModal({{ $church->id }})"
                                    class="text-red-500 hover:text-red-700 dark:hover:text-red-400 transition-colors flex items-center gap-1.5"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    <span>Delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $churches->links() }}
    </div>

    <!-- Edit Form -->
    @if($editId)
        <livewire:shield.church.church-form :churchId="$editId" />
    @endif

    <!-- Delete Modal -->
    @if($showDeleteModal)
        <div 
            x-data="{ open: @entangle('showDeleteModal') }"
            x-show="open"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm"
        >
            <div 
                x-show="open"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="bg-white dark:bg-gray-800 rounded-lg p-6 w-full max-w-md shadow-xl"
            >
                <div class="flex items-center gap-3 mb-4">
                    <div class="p-2 bg-red-100 dark:bg-red-200/10 rounded-full">
                        <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Delete Church</h2>
                </div>
                <p class="text-gray-600 dark:text-gray-400 mb-6">Are you sure you want to delete this church? This action cannot be undone.</p>
                <div class="flex justify-end gap-3">
                    <button 
                        wire:click="hideDeleteModal"
                        class="px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors"
                    >
                        Cancel
                    </button>
                    <button 
                        wire:click="deleteChurch"
                        class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors flex items-center gap-2"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Confirm Delete
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>


{{-- <div>
    <div class="flex justify-between mb-4">
        <input type="text" wire:model="searchTerm" placeholder="Search churches..." class="border rounded p-2">
        <button wire:click="createChurch" class="bg-blue-500 text-white rounded p-2">Add Church</button>
    </div>

    <table class="min-w-full border-collapse border border-gray-200">
        <thead>
            <tr>
                <th class="border border-gray-300 p-2">Name</th>
                <th class="border border-gray-300 p-2">Address</th>
                <th class="border border-gray-300 p-2">Email</th>
                <th class="border border-gray-300 p-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($churches as $church)
                <tr>
                    <td class="border border-gray-300 p-2">{{ $church->name }}</td>
                    <td class="border border-gray-300 p-2">{{ $church->address }}</td>
                    <td class="border border-gray-300 p-2">{{ $church->email }}</td>
                    <td class="border border-gray-300 p-2">
                        <button wire:click="editChurch({{ $church->id }})" class="text-blue-500">Edit</button>
                        <button wire:click="showDeleteModal({{ $church->id }})" class="text-red-500">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $churches->links() }}
    </div>

    @if($editId)
        <livewire:shield.church.church-form :churchId="$editId" />
    @endif

    @if($showDeleteModal)
        <div class="fixed inset-0 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded shadow-lg">
                <h2 class="text-lg font-bold">Confirm Deletion</h2>
                <p>Are you sure you want to delete this church?</p>
                <div class="flex justify-end mt-4">
                    <button wire:click="deleteChurch" class="bg-red-500 text-white rounded p-2">Yes, Delete</button>
                    <button wire:click="hideDeleteModal" class="bg-gray-300 rounded p-2 ml-2">Cancel</button>
                </div>
            </div>
        </div>
    @endif
</div> --}}