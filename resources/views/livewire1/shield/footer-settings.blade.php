// resources/views/shield/footer-settings.blade.php
<div class="p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6">Footer Settings</h2>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-6">
        <!-- Logo Upload -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Institution Logo</label>
            @if ($footerSetting->institution_logo)
                <div class="mt-2">
                    <img src="{{ Storage::url($footerSetting->institution_logo) }}" 
                         class="h-20 w-auto object-contain" />
                </div>
            @endif
            <input type="file" wire:model="newLogo" 
                   class="mt-2 block w-full text-sm text-gray-500
                   file:mr-4 file:py-2 file:px-4
                   file:rounded-md file:border-0
                   file:text-sm file:font-semibold
                   file:bg-blue-50 file:text-blue-700
                   hover:file:bg-blue-100" />
            @error('newLogo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Location Title -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Location Title</label>
            <input type="text" wire:model="footerSetting.location_title" 
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
            @error('footerSetting.location_title') 
                <span class="text-red-500 text-sm">{{ $message }}</span> 
            @enderror
        </div>

        <!-- Address -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Address</label>
            <textarea wire:model="footerSetting.address" 
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                      rows="3"></textarea>
            @error('footerSetting.address') 
                <span class="text-red-500 text-sm">{{ $message }}</span> 
            @enderror
        </div>

        <!-- Contact Details -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700">Phone</label>
                <input type="text" wire:model="footerSetting.phone" 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                @error('footerSetting.phone') 
                    <span class="text-red-500 text-sm">{{ $message }}</span> 
                @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" wire:model="footerSetting.email" 
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                @error('footerSetting.email') 
                    <span class="text-red-500 text-sm">{{ $message }}</span> 
                @enderror
            </div>
        </div>

        <!-- Social Links -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Social Media Links</label>
            @foreach($social_platforms as $platform)
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 capitalize">
                        {{ $platform }}
                    </label>
                    <input type="url" wire:model="social_links.{{ $platform }}"
                           placeholder="https://"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                    @error('social_links.' . $platform) 
                        <span class="text-red-500 text-sm">{{ $message }}</span> 
                    @enderror
                </div>
            @endforeach
        </div>

        <!-- Active Status -->
        <div class="flex items-center">
            <input type="checkbox" wire:model="footerSetting.is_active"
                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" />
            <label class="ml-2 text-sm font-medium text-gray-700">
                Show footer on website
            </label>
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit" 
                    class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Save Settings
            </button>
        </div>
    </form>
</div>