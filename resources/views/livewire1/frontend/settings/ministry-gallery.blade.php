{{-- <section class="px-4 py-16 pt-24 bg-gradient-to-b from-gray-50 to-white sm:px-6 lg:px-8"> --}}
    <section class="w-full py-16 pt-24 bg-gradient-to-b from-gray-50 to-white">
        <!-- Hero Section -->
        <div class="relative py-20 bg-[#008000]">
            <div class="absolute inset-0 opacity-20 bg-pattern-overlay"></div>
            <div class="container relative z-10 px-4 mx-auto">
                <div class="max-w-3xl mx-auto text-center" x-data="{ loaded: false }"
                    x-init="setTimeout(() => loaded = true, 100)" x-transition:enter.duration.500ms>
                    <h1 class="text-4xl font-bold leading-tight text-white transition-all duration-500 transform md:text-5xl"
                        :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                        Ministry Galleries
                    </h1>
                    <p class="mt-4 text-xl font-light text-[#ffffff] opacity-90">
                        Explore the vibrant activities and moments from our church ministries
                    </p>
                </div>
            </div>
        </div>

        <!-- Header Section with Decorative Elements -->
        <div class="relative mx-auto max-w-7xl">
            <!-- Alpine.js Powered Gallery -->
            <div x-data="{
                activeMinistryId: @entangle('activeMinistryId'),
                showModal: false,
                selectedImage: null,
                modalLoading: true,
                currentImageIndex: 0,
                images: [],
                setImage(image, index, ministry) {
                    this.selectedImage = image;
                    this.currentImageIndex = index;
                    this.images = ministry;
                    this.modalLoading = true;
                    this.showModal = true;
                },
                prevImage() {
                    this.currentImageIndex = (this.currentImageIndex - 1 + this.images.length) % this.images.length;
                    this.selectedImage = this.images[this.currentImageIndex];
                    this.modalLoading = true;
                },
                nextImage() {
                    this.currentImageIndex = (this.currentImageIndex + 1) % this.images.length;
                    this.selectedImage = this.images[this.currentImageIndex];
                    this.modalLoading = true;
                },
                closeModal() {
                    this.showModal = false;
                }
            }" class="mt-12">

                <!-- Ministry Selector Tabs -->
                <div class="mb-10 overflow-hidden border-b border-gray-200 rounded-lg shadow-sm">
                    <div class="sm:flex sm:items-baseline">
                        <div class="w-full sm:mt-0 sm:flex-1">
                            <nav class="flex px-4 -mb-px space-x-8 overflow-x-auto bg-white rounded-t-lg shadow-inner">
                                @foreach($ministries as $ministry)
                                <button @click="activeMinistryId = {{ $ministry->id }}"
                                    wire:click="selectMinistry({{ $ministry->id }})"
                                    class="px-3 py-5 text-base font-medium transition-all duration-200 border-b-3 whitespace-nowrap hover:text-indigo-700"
                                    :class="activeMinistryId == {{ $ministry->id }} ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-500'">
                                    {{ $ministry->name }}
                                </button>
                                @endforeach
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Gallery Grid -->
                @foreach($ministries as $ministry)
                <div x-show="activeMinistryId == {{ $ministry->id }}"
                    class="grid grid-cols-1 gap-6 mb-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    @if(is_array($ministry->formatted_gallery_images) && count($ministry->formatted_gallery_images) > 0)
                    @foreach($ministry->formatted_gallery_images as $image)
                    <div class="relative group">
                        <img src="{{ $image }}" alt="{{ $ministry->name }} Gallery Image"
                            class="object-cover w-full h-48 transition-transform duration-300 transform rounded-lg shadow-md cursor-pointer group-hover:scale-105"
                            @click="setImage('{{ $image }}', {{ $loop->index }}, {{ json_encode($ministry->formatted_gallery_images) }})" />
                    </div>
                    @endforeach
                    @else
                    <p class="py-12 text-center text-gray-500 col-span-full">No gallery images available for this
                        ministry.
                    </p>
                    @endif
                </div>
                @endforeach

                <!-- Modal for Image Preview -->
                <div x-show="showModal"
                    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-75"
                    @click="closeModal()">
                    <div class="bg-white p-4 rounded-lg max-w-lg max-h-[80vh] overflow-hidden" @click.stop>
                        <div class="relative">
                            <img x-show="!modalLoading" :src="selectedImage" alt="Selected Image"
                                class="w-full h-auto max-h-[60vh] object-contain" @load="modalLoading = false" />
                            <div x-show="modalLoading"
                                class="absolute inset-0 flex items-center justify-center bg-gray-200">
                                <span class="loader"></span> <!-- Add a loader here -->
                            </div>
                            <button @click="prevImage()"
                                class="absolute p-2 transform -translate-y-1/2 bg-white rounded-full shadow-md left-2 top-1/2">
                                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>
                            <button @click="nextImage()"
                                class="absolute p-2 transform -translate-y-1/2 bg-white rounded-full shadow-md right-2 top-1/2">
                                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                        {{-- <button @click="closeModal()"
                            class="p-2 mt-2 text-white bg-red-500 rounded-full">Close</button> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
