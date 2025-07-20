<div class="container px-4 py-8 mx-auto mt-12" x-data="{ selectedImage: '' }">
    <button wire:click="backToList"
        class="flex items-center mb-4 transition-colors text-emerald-600 hover:text-emerald-700">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
                d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                clip-rule="evenodd" />
        </svg>
        Back to Ministries
    </button>

    <div class="overflow-hidden transition-all duration-300 bg-white shadow-xl rounded-2xl hover:shadow-2xl">
        <!-- Hero Section with Gradient Overlay -->
        <div class="relative">
            <img src="{{ $ministry->primary_image_url }}" alt="{{ $ministry->name }}" class="object-cover w-full h-72">
            <div class="absolute inset-0 bg-gradient-to-t from-emerald-800 via-emerald-800/50 to-transparent"></div>
            <h2 class="absolute text-4xl font-bold text-white bottom-4 left-4 drop-shadow-lg">
                {{ $ministry->name }}
            </h2>
        </div>

        <!-- Content Section -->
        <div class="p-6 space-y-6">
            <p class="text-lg leading-relaxed text-gray-700">
                {{ $ministry->description }}
            </p>

            <!-- Leader Card -->
            <div class="p-4 border-l-4 bg-emerald-50 rounded-xl border-emerald-600">
                <h3 class="mb-2 text-xl font-semibold text-emerald-800">Ministry Leader</h3>
                <div class="flex items-center space-x-3">
                    <div class="h-12 w-12bg-[#008000] rounded-full flex items-center justify-center text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-medium text-gray-900">{{ $ministry->leader->name }}</p>
                        <p class="text-emerald-600">Contact: {{ $ministry->leader_contact }}</p>
                    </div>
                </div>
            </div>

            <!-- Gallery Section -->
            <div>
                <h3 class="mb-3 text-xl font-semibold text-emerald-800">Gallery</h3>
                <div class="grid grid-cols-2 gap-3 md:grid-cols-3">

                    {{-- @foreach($ministry->gallery_images as $image)
                    <img src="{{ asset(Storage::url($image)) }}" alt="Gallery Image"
                        class="object-cover w-full h-40 transition-transform duration-300 rounded-lg cursor-pointer hover:scale-105"
                        @click="selectedImage = '{{ asset(Storage::url($image)) }}'">
                    @endforeach --}}

                    @foreach($ministry->formatted_gallery_images as $image)
                    <img src="{{ $image }}" alt="Gallery Image"
                        class="object-cover w-full h-40 transition-transform duration-300 rounded-lg cursor-pointer hover:scale-105"
                        @click="selectedImage = '{{ $image }}'">
                    @endforeach

                </div>
            </div>

            <!-- Activities Section -->
            <div>
                <h3 class="mb-3 text-xl font-semibold text-emerald-800">Upcoming Activities</h3>
                <ul class="space-y-2">
                    @foreach($ministry->events as $event)
                    <li
                        class="flex items-center p-3 transition-colors bg-white border rounded-lg border-emerald-100 hover:bg-emerald-50">
                        <div class="flex items-center justify-center w-8 h-8 mr-3 rounded-full bg-emerald-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-emerald-600" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <span class="font-medium">{{ $event->name }}</span>
                        <span class="ml-2 text-gray-500">on {{ $event->date }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div x-show="selectedImage" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-95" @click.away="selectedImage = ''"
        @keydown.escape.window="selectedImage = ''" class="fixed inset-0 z-50 flex items-center justify-center p-4"
        x-cloak>
        <!-- Backdrop with blur -->
        <div class="absolute inset-0 bg-black/70 backdrop-blur-sm"></div>

        <!-- Modal container -->
        <div class="relative w-full max-w-2xl overflow-hidden border shadow-2xl bg-white/5 rounded-xl border-white/10">
            <!-- Image -->
            <img :src="selectedImage" class="w-full object-contain max-h-[80vh]" alt="Enlarged view">

            <!-- Control buttons -->
            <div class="absolute top-0 left-0 right-0 flex justify-between p-3">
                <!-- Caption/title could go here -->
                <span class="text-sm font-medium text-white/80">{{ $ministry->name }} Gallery</span>

                <!-- Close button -->
                <button @click="selectedImage = ''"
                    class="bg-black/30 text-white hover:bg-white hover:text-black rounded-full p-1.5 transition-all duration-200 transform hover:rotate-90">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

            <!-- Caption area at bottom -->
            <div
                class="absolute bottom-0 left-0 right-0 px-4 py-3 text-center bg-gradient-to-t from-black/80 to-transparent">
                <div class="flex justify-center space-x-3">
                    <!-- Download button -->
                    <a :href="selectedImage" download
                        class="p-2 transition-colors rounded-full text-white/90 hover:text-white bg-emerald-600/80 hover:bg-emerald-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                    </a>

                    <!-- Zoom button (if desired) -->
                    <button @click="selectedImage = selectedImage"
                        class="p-2 transition-colors rounded-full text-white/90 hover:text-white bg-emerald-600/80 hover:bg-emerald-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
