<div>
    <h1 class="text-2xl font-bold mb-4">{{ $categoryId ? 'Edit Category' : 'Create Category' }}</h1>

    <form wire:submit.prevent="save">
        <div class="mb-4">
            <label for="name" class="block">Name</label>
            <input type="text" wire:model="name" id="name" class="border rounded p-2 w-full" required>
            @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="slug" class="block">Slug</label>
            <input type="text" wire:model="slug" id="slug" class="border rounded p-2 w-full" required>
            @error('slug') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 text-white rounded px-4 py-2">{{ $categoryId ? 'Update Category' : 'Create Category' }}</button>
        </div>
    </form>

    @if (session()->has('message'))
        <div class="mt-4 text-green-500">{{ session('message') }}</div>
    @endif
</div>