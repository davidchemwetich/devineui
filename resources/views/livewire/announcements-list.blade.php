<div class="p-6 bg-white rounded-lg shadow-sm">
    <h2 class="text-xl font-bold text-[#008000] mb-4">Church Announcements📢</h2>

    @forelse($announcements as $announcement)
    <div class="py-4 {{ !$loop->last ? 'border-b border-gray-200' : '' }}">
        <h3 class="text-lg font-semibold text-gray-900">{{ $announcement->title }}</h3>
        <p class="mb-2 text-sm text-gray-500">
            📅{{ $announcement->announcement_date?->format('F j, Y') }}
        </p>
        <div class="prose max-w-none">
            {!! $announcement->formatted_message !!}
        </div>
    </div>
    @empty
    <div class="py-4 text-center text-gray-500">
        No announcements at this time.
    </div>
    @endforelse

    @if($hasMore)
    <div class="mt-4 text-center">
        <button wire:click="loadMore"
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-blue-600 hover:text-blue-800 focus:outline-none">
            Show all announcements
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
    </div>
    @endif
</div>
