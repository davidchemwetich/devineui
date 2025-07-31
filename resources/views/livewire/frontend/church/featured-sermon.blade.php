<div class="bg-gray-50 dark:bg-gray-900">
    <div class="px-4 py-16 mx-auto max-w-7xl sm:px-6 lg:px-8" x-data="sermonModal()"
        @keydown.escape.window="closeModal()">

        @if($featuredSermon)
        <!-- Header Section -->
        <div class="mb-12 text-center">
            <h2 class="text-3xl font-extrabold tracking-tight text-[#008000] sm:text-4xl">
                Featured Sermon
            </h2>
            <div class="w-20 h-1 mx-auto mt-3 rounded-full bg-[#008000]"></div>
            <p class="max-w-2xl mx-auto mt-4 text-xl text-gray-600 dark:text-gray-400">
                Experience God's word through our latest featured message.
            </p>
        </div>

        <div class="grid items-start grid-cols-1 gap-12 lg:grid-cols-2">
            <!-- Left Column: Video Thumbnail -->
            <div class="relative order-1">
                <div @click="openModal('video', '{{ $featuredSermon->video_embed_url }}')"
                    class="relative overflow-hidden transition-all duration-300 rounded-lg shadow-lg cursor-pointer group aspect-video hover:shadow-2xl hover:-translate-y-1">
                    <img src="{{ $featuredSermon->cover_image_url }}" alt="Cover image for {{ $featuredSermon->title }}"
                        class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-105"
                        onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=1280&h=720&fit=crop&crop=center';" />

                    <!-- Gradient Overlay -->
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent group-hover:from-black/80">
                    </div>

                    <!-- Play Button -->
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div
                            class="flex items-center justify-center p-6 transition-all duration-300 transform bg-white/20 backdrop-blur-sm rounded-full group-hover:bg-[#008000] group-hover:scale-110">
                            <svg class="w-16 h-16 text-white transition-transform duration-300 group-hover:scale-110"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Bottom Info -->
                    <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                        <span
                            class="inline-flex items-center px-3 py-1 text-sm font-medium rounded-full bg-[#008000]/90 backdrop-blur-sm">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034 1.07 3.292c.3.921-.755 1.688-1.54 1.118L10 12.347l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292-2.8-2.034c-.784-.57-.38-1.81.588-1.81h3.461l1.07-3.292z" />
                            </svg>
                            Featured Message
                        </span>
                        <h3 class="mt-3 text-2xl font-bold line-clamp-2">{{ $featuredSermon->title }}</h3>
                    </div>
                </div>
            </div>

            <!-- Right Column: Details & Actions -->
            <div class="order-2 space-y-6">
                <!-- Preacher Info -->
                <div
                    class="flex items-center p-6 transition-shadow bg-white shadow-md rounded-xl dark:bg-gray-800 hover:shadow-lg">
                    <div class="relative">
                        <img class="w-16 h-16 rounded-full ring-4 ring-offset-2 dark:ring-offset-gray-800 ring-[#008000]/20"
                            src="{{ $featuredSermon->user->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($featuredSermon->user->name) . '&background=008000&color=ffffff&size=64' }}"
                            alt="{{ $featuredSermon->user->name }}">
                        <div
                            class="absolute -bottom-1 -right-1 w-6 h-6 bg-[#008000] rounded-full flex items-center justify-center">
                            <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                <path fill-rule="evenodd"
                                    d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1 ml-4">
                        <div class="text-lg font-bold text-gray-900 dark:text-white">{{ $featuredSermon->user->name }}
                        </div>
                        <div class="flex items-center mt-1 text-sm text-gray-500 dark:text-gray-400">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                    clip-rule="evenodd" />
                            </svg>
                            Preached on {{ $featuredSermon->formatted_date }}
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="p-6 transition-shadow bg-white shadow-md rounded-xl dark:bg-gray-800 hover:shadow-lg">
                    <h4 class="flex items-center mb-3 font-semibold text-gray-900 dark:text-white">
                        <svg class="w-5 h-5 mr-2 text-[#008000]" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                clip-rule="evenodd" />
                        </svg>
                        About This Message
                    </h4>
                    <p class="leading-relaxed text-gray-600 dark:text-gray-300">
                        {{ Str::limit($featuredSermon->description, 300) }}
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-3">
                    <!-- Primary Watch Button -->
                    <button @click="openModal('video', '{{ $featuredSermon->video_embed_url }}')"
                        class="flex items-center justify-center w-full px-6 py-4 text-lg font-semibold text-white bg-gradient-to-r from-[#008000] to-green-600 rounded-xl hover:from-green-600 hover:to-[#008000] transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                        <svg class="w-6 h-6 mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path
                                d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z" />
                        </svg>
                        Watch Full Sermon
                    </button>

                    <!-- Secondary Actions -->
                    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                        @if($featuredSermon->hasAudio())
                        <button @click="openModal('audio', '{{ $featuredSermon->audio_url }}')"
                            class="flex items-center justify-center px-4 py-3 text-sm font-semibold text-[#008000] bg-green-50 border-2 border-green-100 rounded-lg hover:bg-green-100 hover:border-[#008000] dark:bg-green-900/20 dark:border-green-800 dark:text-green-300 dark:hover:bg-green-900/40 transition-all duration-300">
                            <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                    d="M18 3a1 1 0 00-1.196-.98l-10 2A1 1 0 006 5v9.114A4.369 4.369 0 005 14c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V7.82l8-1.6v5.894A4.37 4.37 0 0015 12c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V3z" />
                            </svg>
                            Listen Audio
                        </button>
                        @endif

                        @if($featuredSermon->hasPdf())
                        <button @click="openModal('pdf', '{{ $featuredSermon->pdf_url }}')"
                            class="flex items-center justify-center px-4 py-3 text-sm font-semibold text-[#008000] bg-green-50 border-2 border-green-100 rounded-lg hover:bg-green-100 hover:border-[#008000] dark:bg-green-900/20 dark:border-green-800 dark:text-green-300 dark:hover:bg-green-900/40 transition-all duration-300">
                            <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                                    clip-rule="evenodd" />
                            </svg>
                            View Notes
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @else
        <!-- No Featured Sermon State -->
        <div class="py-16 text-center bg-white shadow-md rounded-xl dark:bg-gray-800">
            <div
                class="flex items-center justify-center w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full dark:bg-gray-700">
                <svg class="w-12 h-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z" />
                </svg>
            </div>
            <h3 class="mb-2 text-xl font-semibold text-gray-900 dark:text-white">No Featured Sermon</h3>
            <p class="max-w-md mx-auto text-gray-500 dark:text-gray-400">
                We're preparing something special for you. Please check back soon for our latest featured message.
            </p>
        </div>
        @endif

        <!-- Enhanced Universal Modal -->
        <div x-show="isOpen" x-cloak @click.self="closeModal()"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm"
            x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

            <div class="relative w-full max-w-6xl max-h-[90vh] bg-white dark:bg-gray-900 rounded-2xl shadow-2xl overflow-hidden"
                :class="modalClasses()" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-95 translate-y-4">

                <!-- Close Button -->
                <button @click="closeModal()"
                    class="absolute z-30 p-2 text-gray-400 transition-all duration-200 rounded-full top-4 right-4 bg-white/90 dark:bg-gray-800/90 hover:text-gray-600 hover:bg-white dark:hover:bg-gray-800 backdrop-blur-sm">
                    <span class="sr-only">Close modal</span>
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <!-- Video Modal Content -->
                <template x-if="activeModal === 'video'">
                    <div class="relative w-full h-full">
                        <div class="w-full h-full aspect-video">
                            <iframe x-ref="videoFrame" :src="getVideoUrl()" class="w-full h-full rounded-2xl"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                allowfullscreen>
                            </iframe>
                        </div>
                    </div>
                </template>

                <!-- Audio Modal Content -->
                <template x-if="activeModal === 'audio'">
                    <div class="p-8">
                        <div class="mb-6 text-center">
                            <div
                                class="w-20 h-20 mx-auto mb-4 bg-gradient-to-br from-[#008000] to-green-600 rounded-full flex items-center justify-center">
                                <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M18 3a1 1 0 00-1.196-.98l-10 2A1 1 0 006 5v9.114A4.369 4.369 0 005 14c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V7.82l8-1.6v5.894A4.37 4.37 0 0015 12c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V3z" />
                                </svg>
                            </div>
                            <h3 class="mb-2 text-2xl font-bold text-gray-900 dark:text-white">Listen to Sermon</h3>
                            <p class="text-gray-600 dark:text-gray-400">{{ $featuredSermon->title ?? '' }}</p>
                        </div>

                        <div class="p-6 bg-gray-50 dark:bg-gray-800 rounded-xl">
                            <audio :src="mediaUrl" controls autoplay
                                class="w-full h-12 mb-4 focus:outline-none focus:ring-2 focus:ring-[#008000]">
                            </audio>

                            <div class="flex items-center justify-between text-sm text-gray-500 dark:text-gray-400">
                                <span>Audio Sermon</span>
                                <a :href="mediaUrl" download
                                    class="flex items-center text-[#008000] hover:text-green-600 font-medium transition-colors">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Download MP3
                                </a>
                            </div>
                        </div>
                    </div>
                </template>

                <!-- PDF Modal Content -->
                <template x-if="activeModal === 'pdf'">
                    <div class="flex flex-col h-full max-h-[90vh]">
                        <div
                            class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-gray-700">
                            <div class="flex items-center">
                                <div
                                    class="flex items-center justify-center w-10 h-10 mr-3 bg-red-100 rounded-lg dark:bg-red-900/30">
                                    <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Sermon Notes</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $featuredSermon->title ?? ''
                                        }}</p>
                                </div>
                            </div>
                            <a :href="mediaUrl" target="_blank"
                                class="flex items-center px-4 py-2 text-sm font-medium text-[#008000] bg-green-50 rounded-lg hover:bg-green-100 dark:bg-green-900/20 dark:hover:bg-green-900/40 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                Open in New Tab
                            </a>
                        </div>
                        <div class="flex-1 min-h-0">
                            <iframe :src="mediaUrl" class="w-full h-full" frameborder="0">
                            </iframe>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>

    <script>
        function sermonModal() {
            return {
                isOpen: false,
                activeModal: null,
                mediaUrl: '',

                openModal(type, url) {
                    if (!url) {
                        console.warn('No URL provided for modal');
                        return;
                    }

                    this.activeModal = type;
                    this.mediaUrl = url;
                    this.isOpen = true;

                    // Prevent body scroll when modal is open
                    document.body.style.overflow = 'hidden';

                    // Handle video-specific logic
                    if (type === 'video') {
                        this.$nextTick(() => {
                            this.setupVideoAutoplay();
                        });
                    }
                },

                closeModal() {
                    // Stop video if it's playing
                    if (this.activeModal === 'video' && this.$refs.videoFrame) {
                        this.$refs.videoFrame.src = 'about:blank';
                    }

                    this.isOpen = false;
                    this.activeModal = null;
                    this.mediaUrl = '';

                    // Restore body scroll
                    document.body.style.overflow = '';
                },

                setupVideoAutoplay() {
                    if (this.$refs.videoFrame && this.mediaUrl) {
                        const url = new URL(this.mediaUrl);
                        url.searchParams.set('autoplay', '1');
                        url.searchParams.set('rel', '0');
                        url.searchParams.set('modestbranding', '1');
                        this.$refs.videoFrame.src = url.toString();
                    }
                },

                getVideoUrl() {
                    if (!this.mediaUrl) return '';

                    const url = new URL(this.mediaUrl);
                    url.searchParams.set('autoplay', '1');
                    url.searchParams.set('rel', '0');
                    url.searchParams.set('modestbranding', '1');
                    return url.toString();
                },

                modalClasses() {
                    if (this.activeModal === 'video') {
                        return 'aspect-video max-w-6xl';
                    } else if (this.activeModal === 'pdf') {
                        return 'max-w-6xl h-[90vh]';
                    } else {
                        return 'max-w-2xl';
                    }
                }
            }
        }
    </script>
</div>
