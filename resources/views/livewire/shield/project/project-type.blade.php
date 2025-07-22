<div class="p-4 sm:p-6 md:p-8 dark:bg-gray-900">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Project Types</h1>
        <button
            @click="$dispatch('open-modal')"
            wire:click="openModal"
            class="mt-2 sm:mt-0 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md text-sm font-medium">
            + Add Type
        </button>
    </div>

    <!-- Flash -->
    @if(session()->has('message'))
        <div class="mb-4 px-4 py-2 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-200 rounded">
            {{ session('message') }}
        </div>
    @endif

    <!-- Table -->
    <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-md shadow">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Name</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Projects</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($types as $type)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="px-4 py-3 text-sm text-gray-800 dark:text-gray-200">{{ $type->name }}</td>
                        <td class="px-4 py-3 text-sm text-gray-600 dark:text-gray-300">{{ $type->projects_count ?? 0 }}</td>
                        <td class="px-4 py-3 text-sm flex space-x-2">
                            <button wire:click="edit({{ $type->id }})"
                                    class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400">
                                Edit
                            </button>
                            <button wire:click="delete({{ $type->id }})"
                                    onclick="return confirm('Are you sure?')"
                                    class="text-red-600 hover:text-red-900 dark:text-red-400">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $types->links() }}
    </div>

    <!-- Modal -->
    <div x-data="{ open: @entangle('isOpen') }" x-show="open" style="display: none;" class="fixed inset-0 z-30 flex items-center justify-center bg-black/40">
        <div x-on:click.away="open = false" class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-sm mx-4">
            <div class="p-5">
                <h2 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-4">
                    {{ $projectTypeId ? 'Edit' : 'Add' }} Project Type
                </h2>
                <form wire:submit.prevent="save">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Name</label>
                    <input type="text"
                           wire:model="name"
                           class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    @error('name') <span class="text-xs text-red-600 dark:text-red-400">{{ $message }}</span> @enderror

                    <div class="flex justify-end mt-4 space-x-2">
                        <button type="button"
                                @click="$dispatch('close-modal');"
                                wire:click="closeModal"
                                class="px-4 py-2 text-sm bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-200 rounded-md">
                            Cancel
                        </button>
                        <button type="submit"
                                class="px-4 py-2 text-sm bg-indigo-600 hover:bg-indigo-700 text-white rounded-md">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>