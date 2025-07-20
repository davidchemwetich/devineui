<div>
    <div class="flex justify-between mb-4">
        <input type="text" wire:model="search" placeholder="Search categories..." class="border rounded p-2">
        <a href="{{ route(config('app.admin_prefix') . '.categories.create') }}" class="bg-blue-500 text-white rounded p-2">Create New Category</a>
    </div>

    <table class="min-w-full border">
        <thead>
            <tr>
                <th>Name</th>
                <th>Slug</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->slug }}</td>
                    <td>
                        <a href="{{ route(config('app.admin_prefix') . '.categories.edit',  $category->id) }}" class="text-yellow-500">Edit</a>
                        <button wire:click="confirmCategoryDeletion({{ $category->id }})" class="text-red-500">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div>
        {{ $categories->links() }}
    </div>

    <!-- Delete Confirmation Modal -->
    <div x-data="{ open: @entangle('showDeleteModal') }" x-show="open" class="fixed inset-0 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded shadow-lg">
            <h2 class="text-lg font-bold">Confirm Deletion</h2>
            <p>Are you sure you want to delete this category?</p>
            <div class="flex justify-end mt-4">
                <button @click="open = false" class="bg-gray-300 text-gray-700 rounded px-4 py-2">Cancel</button>
                <button wire:click="deleteCategory" class="bg-red-500 text-white rounded px-4 py-2 ml-2">Delete</button>
            </div>
        </div>
    </div>
</div>