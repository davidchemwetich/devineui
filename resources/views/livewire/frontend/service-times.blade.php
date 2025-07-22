<div class="px-4 py-12 bg-white sm:px-6 lg:px-8">
    <div class="mx-auto max-w-7xl">
        <!-- Section Header -->
        <div class="mb-12 text-center">
            <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                <span class="block mt-2 text-[#008000]">Service Times & Schedule</span>
            </h2>
            <p class="max-w-2xl mx-auto mt-4 text-xl text-gray-500">
                Join us for worship and fellowship throughout the week
            </p>
        </div>

        <!-- Service Times Grid -->
        <div class="grid grid-cols-1 gap-8 mb-16 md:grid-cols-2 lg:grid-cols-4">
            @foreach ($services as $service)
            <div class="overflow-hidden rounded-lg shadow-md bg-gray-50" x-data="{ expanded: false }">
                <div class="flex items-center justify-between px-6 py-4 bg-[#008000] hover:bg-[#15803d]">
                    <h3 class="text-lg font-semibold text-white">{{ $service->day }}</h3>
                    <button @click="expanded = !expanded" class="text-white focus:outline-none">
                        <svg x-show="!expanded" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        <svg x-show="expanded" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 12h16" />
                        </svg>
                    </button>
                </div>
                <div x-show="expanded" class="px-6 py-4">
                    <ul class="space-y-2">
                        @foreach ($service->times as $time)
                        <li class="text-gray-700">
                            <strong>{{ $time->time }}</strong> - {{ $time->name }} ({{ $time->language }})
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endforeach
        </div>
        <!-- Announcements Section -->
        <div class="p-6 rounded-lg bg-gray-">
            <livewire:announcements-list />
        </div>
    </div>
</div>