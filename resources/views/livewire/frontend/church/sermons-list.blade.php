<div class="sermons-list-component">

    <!-- Hero Section -->
    <div class="relative py-20 bg-[#008000]">
        <div class="absolute inset-0 opacity-20 bg-pattern-overlay"></div>
        <div class="container relative z-10 px-4 mx-auto">
            <div class="max-w-3xl mx-auto text-center" x-data="{ loaded: false }"
                x-init="setTimeout(() => loaded = true, 100)" x-transition:enter.duration.500ms>
                <h1 class="text-4xl font-bold leading-tight text-white transition-all duration-500 transform md:text-5xl"
                    :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                    Church Sermons
                </h1>
                <p class="mt-4 text-xl font-light text-[#ffffff] opacity-90">
                    Listen, watch, and read inspiring messages from our
                    church
                </p>
            </div>
        </div>
    </div>


    <!-- Search and Filter Bar -->
    <div class="sticky top-0 z-10 bg-white border-b shadow-sm">
        <div class="container px-4 py-4 mx-auto">
            <div class="md:flex md:items-center md:justify-between">
                <div class="relative flex-1 mb-4 md:mr-4 md:mb-0">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input wire:model.debounce.300ms="search" type="text"
                        placeholder="Search sermons by title or description..."
                        class="block w-full py-2 pl-10 pr-3 leading-5 placeholder-gray-500 bg-white border border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div class="flex items-center">
                    <div class="relative w-full md:w-48">
                        <select wire:model="category"
                            class="block w-full py-2 pl-3 pr-10 text-base border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">All Categories</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat }}">{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="ml-2">
                        <button wire:click="sortBy('preached_on')"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                    d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z" />
                            </svg>
                            @if($sortField === 'preached_on')
                            @if($sortDirection === 'asc')
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                            @else
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                            @endif
                            @endif
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sermons Cards Grid -->
    <div class="py-8 bg-gray-50 md:py-12">
        <div class="container px-4 mx-auto">
            @if($sermons->isEmpty())
            <div class="py-12 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="text-lg font-medium text-gray-900">No sermons found</h3>
                <p class="mt-2 text-gray-500">Try adjusting your search or filter to find what you're looking for.</p>
                <button wire:click="$set('search', ''); $set('category', '');"
                    class="inline-flex items-center px-4 py-2 mt-4 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Clear Filters
                </button>
            </div>
            @else
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach($sermons as $sermon)
                <div class="overflow-hidden transition-shadow duration-300 bg-white rounded-lg shadow-md hover:shadow-lg"
                    x-data="{ showDetails: false }">
                    <div class="relative h-48 overflow-hidden">
                        @if($sermon->cover_image)
                        <img src="{{ $sermon->cover_image_url }}" alt="{{ $sermon->title }}"
                            class="object-cover w-full h-full">
                        @else
                        <div class="flex items-center justify-center h-full bg-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                            </svg>
                        </div>
                        @endif

                        @if($sermon->is_featured)
                        <div
                            class="absolute top-0 left-0 px-3 py-1 text-xs font-bold text-white uppercase bg-yellow-500 rounded-br-lg">
                            Featured
                        </div>
                        @endif

                        @if($sermon->category)
                        <div
                            class="absolute top-0 right-0 px-3 py-1 text-xs font-bold text-white uppercase bg-indigo-600 rounded-bl-lg">
                            {{ $sermon->category }}
                        </div>
                        @endif
                    </div>

                    <div class="p-5">
                        <div class="flex items-center mb-2 text-sm text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            {{ $sermon->preached_date }}
                        </div>

                        <h3 class="mb-2 text-lg font-bold text-gray-800 line-clamp-2">{{ $sermon->title }}</h3>

                        <p class="mb-4 text-sm text-gray-600 line-clamp-2">{{ $sermon->description }}</p>

                        <div class="flex mb-4 space-x-2">
                            @if($sermon->audio_path)
                            <button x-data="{ playing: false, audio: new Audio('{{ $sermon->audio_url }}') }"
                                @pause-all-audio.window="audio.pause(); playing = false" @click="
                                                if (playing) {
                                                    audio.pause();
                                                    playing = false;
                                                } else {
                                                    window.dispatchEvent(new CustomEvent('pause-all-audio'));
                                                    audio.play();
                                                    playing = true;
                                                }
                                            " class="text-indigo-600 hover:text-indigo-800 focus:outline-none">
                                <svg x-show="!playing" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <svg x-show="playing" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </button>
                            @endif

                            @if($sermon->video_url)
                            <a href="{{ $sermon->video_url }}" target="_blank" class="text-red-600 hover:text-red-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14v-4z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </a>
                            @endif

                            @if($sermon->pdf_path)
                            <a href="{{ $sermon->pdf_url }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </a>
                            @endif
                        </div>

                        <button @click="showDetails = !showDetails"
                            class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-indigo-800 transition-colors bg-indigo-100 rounded-md hover:bg-indigo-200">
                            <span x-text="showDetails ? 'Hide Details' : 'View Details'"></span>
                            <svg x-show="!showDetails" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                            <svg x-show="showDetails" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 ml-1"
                                viewBox="0 0 20 20" fill="currentColor" style="display: none;">
                                <path fill-rule="evenodd"
                                    d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                        <div x-show="showDetails" class="pt-4 mt-4 border-t border-gray-200" style="display: none;">
                            <p class="mb-4 text-sm text-gray-600">{{ $sermon->description }}</p>

                            <div class="space-y-2">
                                @if($sermon->audio_path)
                                <a href="{{ $sermon->audio_url }}" target="_blank"
                                    class="block w-full px-4 py-2 text-sm font-medium text-center text-white transition-colors bg-indigo-600 rounded-md hover:bg-indigo-700">
                                    Download Audio
                                </a>
                                @endif

                                @if($sermon->video_url)
                                <a href="{{ $sermon->video_url }}" target="_blank"
                                    class="block w-full px-4 py-2 text-sm font-medium text-center text-white transition-colors bg-red-600 rounded-md hover:bg-red-700">
                                    Watch Video
                                </a>
                                @endif

                                @if($sermon->pdf_path)
                                <a href="{{ $sermon->pdf_url }}" target="_blank"
                                    class="block w-full px-4 py-2 text-sm font-medium text-center text-white transition-colors bg-blue-600 rounded-md hover:bg-blue-700">
                                    Download PDF
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $sermons->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
