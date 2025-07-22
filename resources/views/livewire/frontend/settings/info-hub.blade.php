<div>
    <!-- Hero Section -->
    <div class="relative py-20 bg-[#008000]">
        <div class="absolute inset-0 opacity-20 bg-pattern-overlay"></div>
        <div class="container relative z-10 px-4 mx-auto">
            <div class="max-w-3xl mx-auto text-center" x-data="{ loaded: false }"
                x-init="setTimeout(() => loaded = true, 100)" x-transition:enter.duration.500ms>
                <h1 class="text-4xl font-bold leading-tight text-white transition-all duration-500 transform md:text-5xl"
                    :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                    Events & News & Services
                </h1>
                <p class="mt-4 text-xl font-light text-[#ffffff] opacity-90">
                    Stay updated with the latest events, news, and announcements from CITWAM
                </p>
            </div>
        </div>
    </div>

    <!-- Tab Navigation -->
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-center mb-8" x-data="{ activeTab: @entangle('activeTab') }">
            <div class="inline-flex rounded-md shadow-sm bg-gray-100 p-1">
                <button @click="activeTab = 'events'"
                    :class="{'bg-blue-600 text-white': activeTab === 'events', 'text-gray-700 hover:bg-gray-200': activeTab !== 'events'}"
                    class="px-4 py-2 text-sm font-medium rounded-md transition-all duration-300 ease-in-out">
                    Events
                </button>
                <button @click="activeTab = 'articles'"
                    :class="{'bg-blue-600 text-white': activeTab === 'articles', 'text-gray-700 hover:bg-gray-200': activeTab !== 'articles'}"
                    class="px-4 py-2 text-sm font-medium rounded-md transition-all duration-300 ease-in-out">
                    News & Articles
                </button>
                <button @click="activeTab = 'services'"
                    :class="{'bg-blue-600 text-white': activeTab === 'services', 'text-gray-700 hover:bg-gray-200': activeTab !== 'services'}"
                    class="px-4 py-2 text-sm font-medium rounded-md transition-all duration-300 ease-in-out">
                    Service Times
                </button>
            </div>
        </div>

        <!-- Content Panels -->
        <div x-data="{ activeTab: @entangle('activeTab'), previousTab: null }"
            x-init="$watch('activeTab', value => { previousTab = value })" class="relative">


            <!-- Events Tab -->
            <div x-show="activeTab === 'events'" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform translate-x-8"
                x-transition:enter-end="opacity-100 transform translate-x-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform translate-x-0"
                x-transition:leave-end="opacity-0 transform -translate-x-8">
                @livewire('frontend.ministry.events-front')
            </div>

            <!-- Articles Tab -->
            <div x-show="activeTab === 'articles'" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform translate-x-8"
                x-transition:enter-end="opacity-100 transform translate-x-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform translate-x-0"
                x-transition:leave-end="opacity-0 transform -translate-x-8">
                @livewire('frontend.article.article-index')
            </div>

            <!-- Services Tab -->
            <div x-show="activeTab === 'services'" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform translate-x-8"
                x-transition:enter-end="opacity-100 transform translate-x-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform translate-x-0"
                x-transition:leave-end="opacity-0 transform -translate-x-8">
                @livewire('frontend.church.service-times')
            </div>
        </div>
    </div>
</div>