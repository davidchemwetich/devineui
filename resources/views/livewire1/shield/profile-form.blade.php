<!-- resources/views/shield/instructor-profile-form.blade.php -->
<div>
    <form wire:submit.prevent="save" class="space-y-6">
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
            <input type="text" wire:model="title" id="title"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="bio" class="block text-sm font-medium text-gray-700">Bio</label>
            <textarea wire:model="bio" id="bio" rows="4"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
            @error('bio') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="expertise" class="block text-sm font-medium text-gray-700">Expertise</label>
            <textarea wire:model="expertise" id="expertise" rows="3"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
            @error('expertise') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="education" class="block text-sm font-medium text-gray-700">Education</label>
            <textarea wire:model="education" id="education" rows="3"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
            @error('education') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="contact_email" class="block text-sm font-medium text-gray-700">Contact Email</label>
            <input type="email" wire:model="contact_email" id="contact_email"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            @error('contact_email') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div>
            <button type="submit"
                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                Save Profile
            </button>
        </div>
    </form>
</div>
