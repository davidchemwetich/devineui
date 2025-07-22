<div x-data="{ dark: localStorage.theme === 'dark' }"
     x-init="$watch('dark', val => localStorage.theme = val ? 'dark' : 'light')"
     :class="{ 'dark': dark }"
     class="min-h-screen bg-gray-100 dark:bg-gray-900">

    <!-- Flash -->
    @if (session()->has('flash'))
        <div x-data="{ show: true }"
             x-init="setTimeout(() => show = false, 3000)"
             x-show="show"
             class="fixed top-5 right-5 z-50 px-4 py-2 rounded shadow
                    {{ session('flash.type') === 'success' ? 'bg-green-500' : 'bg-red-500' }} text-white">
            {{ session('flash.message') }}
        </div>
    @endif

    <!-- Toolbar -->
    <div class="flex justify-between items-center mb-4">
        <input wire:model.debounce.300ms="search" type="search"
               placeholder="Search categories…"
               class="border rounded-lg px-4 py-2 w-64 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
        <div class="flex items-center space-x-4">
            <button @click="dark = !dark"
                    class="p-2 rounded-full hover:bg-gray-200 dark:hover:bg-gray-700">
                <svg x-show="!dark" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"/>
                </svg>
                <svg x-show="dark" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                          d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                          clip-rule="evenodd"/>
                </svg>
            </button>
            <button wire:click="create"
                    class="bg-blue-600 text-white rounded-lg px-4 py-2 hover:bg-blue-700">
                + Create
            </button>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-900">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Slug</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse($categories as $category)
                <tr>
                    <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-gray-100">{{ $category->name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-300">{{ $category->slug }}</td>
                    <td class="px-6 py-4 text-right text-sm font-medium space-x-2">
                        <button wire:click="edit({{ $category->id }})"
                                class="text-yellow-600 hover:text-yellow-900">Edit</button>
                        <button wire:click="confirmDelete({{ $category->id }})"
                                class="text-red-600 hover:text-red-900">Delete</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="px-6 py-10 text-center text-gray-500 dark:text-gray-400">No categories found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $categories->links() }}
    </div>

    <!-- Create / Edit Modal -->
    <div x-data="{ open: @entangle('showModal') }" x-show="open" x-cloak
         class="fixed inset-0 z-40 flex items-center justify-center bg-black/50">
        <div @click.away="open = false"
             class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-lg p-6">
            <h3 class="text-lg font-bold mb-4 dark:text-white">
                {{ $editingId ? 'Edit' : 'Create' }} Category
            </h3>
            <form wire:submit.prevent="save" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Name</label>
                    <input wire:model.defer="form.name" type="text" required
                           class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    @error('form.name') <span class="text-sm text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Slug</label>
                    <input wire:model.defer="form.slug" type="text" required
                           class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    @error('form.slug') <span class="text-sm text-red-600 dark:text-red-400">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end space-x-2">
                    <button type="button" @click="open = false"
                            class="px-4 py-2 bg-gray-200 dark:bg-gray-600 rounded-md dark:text-gray-100">Cancel</button>
                    <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div x-data="{ open: @entangle('showDeleteModal') }" x-show="open" x-cloak
         class="fixed inset-0 z-40 flex items-center justify-center bg-black/50">
        <div @click.away="open = false"
             class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 w-full max-w-sm">
            <h3 class="text-lg font-bold dark:text-white">Confirm deletion</h3>
            <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">This action cannot be undone.</p>
            <div class="mt-4 flex justify-end space-x-2">
                <button @click="open = false"
                        class="px-4 py-2 bg-gray-200 dark:bg-gray-600 rounded-md dark:text-gray-100">Cancel</button>
                <button wire:click="delete"
                        class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Delete</button>
            </div>
        </div>
    </div>
</div>