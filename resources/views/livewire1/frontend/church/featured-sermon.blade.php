<div class="px-4 py-16 mx-auto max-w-7xl sm:px-6 lg:px-8" x-data="{
    showVideoModal: false,
    showAudioPlayer: false,
    showPdfViewer: false,
    audioSrc: '',
    pdfSrc: ''
 }">
    <!-- Video Modal -->
    <div x-show="showVideoModal" x-cloak x-transition:enter="transition ease-out duration-300"
        x-transition:leave="transition ease-in duration-200"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-75"
        @click.away="showVideoModal = false">
        <div class="w-full max-w-4xl p-4">
            <div class="relative aspect-video">
                @if($featuredSermon && $featuredSermon->video_url)
                <iframe class="absolute inset-0 w-full h-full" src="{{ $featuredSermon->video_url ? (preg_match('/youtu\.be\/([a-zA-Z0-9_-]+)(\?|$)/', $featuredSermon->video_url, $matches)
                    ? 'https://www.youtube.com/embed/' . $matches[1] . (strpos($featuredSermon->video_url, '?list=') !== false ? '?' . substr(strstr($featuredSermon->video_url, '?list='), 1) : '')
                    : (Str::contains($featuredSermon->video_url, 'youtube.com/watch?v=')
                        ? str_replace('youtube.com/watch?v=', 'youtube.com/embed/', $featuredSermon->video_url)
                        : $featuredSermon->video_url)) : '' }}&autoplay=0&rel=0" frameborder="0"
                    allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
                </iframe>
                @endif
                <button @click="showVideoModal = false"
                    class="absolute p-2 text-white bg-black bg-opacity-50 rounded-full top-4 right-4 hover:bg-opacity-70">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Audio Player Modal -->
    <div x-show="showAudioPlayer" x-cloak x-transition:enter="transition ease-out duration-300"
        x-transition:leave="transition ease-in duration-200"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-75"
        @click.away="showAudioPlayer = false">
        <div class="w-full max-w-2xl p-6 bg-white rounded-lg shadow-xl">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-bold text-[#008000]">Listen to Sermon</h3>
                <button @click="showAudioPlayer = false" class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="p-4 rounded-lg bg-emerald-50">
                <audio x-bind:src="audioSrc" controls class="w-full" preload="metadata">
                    Your browser does not support the audio element.
                </audio>
            </div>
            <div class="mt-4 text-right">
                <a x-bind:href="audioSrc" download
                    class="inline-flex items-center px-4 py-2 text-white rounded-lg bg-emerald- 700 hover:bg-[#008000]">
                    Download MP3
                </a>
            </div>
        </div>
    </div>

    <!-- PDF Viewer Modal -->
    <div x-show="showPdfViewer" x-cloak x-transition:enter="transition ease-out duration-300"
        x-transition:leave="transition ease-in duration-200"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-75"
        @click.away="showPdfViewer = false">
        <div class="w-full max-w-2xl p-6 bg-white rounded-lg shadow-xl">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-bold text-[#008000]">View Sermon Notes</h3>
                <button @click="showPdfViewer = false" class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <iframe x-bind:src="pdfSrc" class="w-full h-96" frameborder="0"></iframe>
            <div class="mt-4 text-right">
                <a x-bind:href="pdfSrc" target="_blank"
                    class="inline-flex items-center px-4 py-2 text-white rounded-lg bg-[#008000] hover:bg-[#008000]">
                    Open PDF in New Tab
                </a>
            </div>
        </div>
    </div>

    <div class="mb-12 text-center">
        <h2 class="text-3xl font-bold text-[#008000]">Featured Sermon</h2>
        <div class="w-20 h-1 mx-auto mt-3 rounded-full bg-[#008000]"></div>
        <p class="mt-6 text-lg text-black">Experience God's word through our featured message</p>
    </div>

    @if($featuredSermon)
    <div class="grid items-center grid-cols-1 gap-12 lg:grid-cols-2">
        <!-- Sermon Thumbnail -->
        <div class="relative overflow-hidden shadow-lg cursor-pointer group aspect-video rounded-2xl"
            @click="showVideoModal = true" wire:loading.class="opacity-75">
            <img src="{{ $featuredSermon->getCoverImageUrlAttribute() }}" alt="{{ $featuredSermon->title }}"
                class="object-cover w-full h-full transition-transform duration-300 group-hover:scale-105">
            <div class="absolute inset-0 bg-gradient-to-t from-emerald-900/60 to-emerald-900/30">
                <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                    <div class="flex items-center gap-2">
                        <span class="px-3 py-1 text-sm font-medium rounded-full bg-[#008000]">Featured Message</span>
                        <span class="text-sm opacity-90">{{ $featuredSermon->category }}</span>
                    </div>
                    <h3 class="mt-4 text-2xl font-bold">{{ $featuredSermon->title }}</h3>
                </div>
            </div>
            <div
                class="absolute transition-opacity transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 opacity-90 group-hover:opacity-100">
                <div class="p-5 bg-[#008000] rounded-full shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-white" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Sermon Details -->
        <div class="space-y-6">
            <div class="p-6 bg-white rounded-lg shadow-sm">
                <h3 class="text-2xl font-bold text-[#008000]">{{ $featuredSermon->title }}</h3>
                <div class="flex items-center mt-4 gap-x-3">
                    <div class="flex items-center flex-1 gap-x-3">
                        <img src="{{ $featuredSermon->user->profile_photo_url }}"
                            alt="{{ $featuredSermon->user->name }}"
                            class="object-cover w-12 h-12 rounded-full ring-2 ring-emerald-500">
                        <div>
                            <div class="font-medium text-[#008000]">{{ $featuredSermon->user->name }}</div>
                            <div class="text-sm text-[#008000]">{{ $featuredSermon->getPreachedDateAttribute() }}
                            </div>
                        </div>
                    </div>
                    <div class="px-3 py-1 text-sm rounded-full bg-emerald-50 text-[#008000]">
                        {{ $featuredSermon->category }}
                    </div>
                </div>
            </div>

            <!-- Sermon Description -->
            <div class="p-6 prose text-black bg-white rounded-lg shadow-sm">
                <p>{{ $featuredSermon->description }}</p>
            </div>



            <!-- Action Buttons -->
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <button @click="showVideoModal = true" class="flex items-center justify-center px-4 py-3 font-medium text-white transition-all rounded-lg  bg-[#000FFF] hover:bg-[#2563eb]
">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                    </svg>
                    Watch Now
                </button>
                <button @click="showAudioPlayer = true; audioSrc = '{{ $featuredSermon->getAudioUrlAttribute() }}'"
                    class="flex items-center justify-center px-4 py-3 font-medium text-white transition-all rounded-lg  bg-[#000FFF] hover:bg-[#2563eb]
">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                    </svg>
                    Listen Now
                </button>
                <button @click="showPdfViewer = true; pdfSrc = '{{ $featuredSermon->getPdfUrlAttribute() }}'"
                    class="flex items-center justify-center px-4 py-3 font-medium transition-all bg-white border-2 rounded-lg text-[#008000] border-emerald-200 hover:border-emerald-300 gap-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    View Notes
                </button>
            </div>


            <!-- Additional Links -->
            <div class="flex flex-wrap items-center justify-between gap-4 pt-6">
                <a href="{{ route('sermons') }}"
                    class="flex items-center font-medium text-[#008000] hover:text-[#008000] gap-x-2">
                    View Sermon Series
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
                <div class="flex items-center gap-x-4">
                    <span class="text-sm text-[#008000]">Share:</span>
                    <div class="flex gap-x-3">
                        <!-- Facebook -->
                        <a href="" target="_blank" class="text-[#008000] hover:text-[#008000]">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </a>
                        <!-- Twitter/X -->
                        <a href="" target="_blank" class="text-[#008000] hover:text-[#008000]">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                            </svg>
                        </a>
                        <!-- WhatsApp -->
                        <a href="" target="_blank" class="text-[#008000] hover:text-[#008000]">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>


            <!-- Tags -->
            <div class="pt-4">
                <div class="flex flex-wrap gap-2">
                    @if($featuredSermon->tags)
                    @foreach ($featuredSermon->tags as $tag)
                    <span class="px-3 py-1 text-xs font-medium rounded-full bg-emerald-100 text-[#008000]">
                        #{{ $tag }}
                    </span>
                    @endforeach
                    @else
                    <span class="px-3 py-1 text-xs font-medium text-red-800 bg-red-100 rounded-full">
                        No tags available
                    </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="text-center">
        <p class="text-lg text-red-600">No featured sermon available at the moment.</p>
    </div>
    @endif

    <!-- Optional Flash Message -->
    @if (session()->has('message'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
        class="fixed px-6 py-3 text-[#008000] bg-green-100 rounded-lg shadow-md bottom-4 right-4">
        {{ session('message') }}
    </div>
    @endif
</div>