<div x-data="{
    isLoading: @entangle('isLoading'),
    mobileFiltersOpen: false,
    showScrollTop: false,
    scrollToTop() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    },
    checkScroll() {
        this.showScrollTop = window.scrollY > 400;
    }
}" x-init="window.addEventListener('scroll', checkScroll)" class="relative font-sans">

    <!-- Loading overlay -->
    <div x-show="isLoading" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-100 bg-opacity-90">
        <div class="flex flex-col items-center">
            <div class="border-4 border-green-200 rounded-full w-14 h-14 border-t-blue-600 animate-spin"></div>
            <p class="mt-3 text-lg font-semibold text-[#008000]">Loading inspiration...</p>
        </div>
    </div>
    <!-- Hero Section -->
    <div class="relative py-20 bg-[#008000]">
        <div class="absolute inset-0 opacity-20 bg-pattern-overlay"></div>
        <div class="container relative z-10 px-4 mx-auto">
            <div class="max-w-3xl mx-auto text-center" x-data="{ loaded: false }"
                x-init="setTimeout(() => loaded = true, 100)" x-transition:enter.duration.500ms>
                <h1 class="text-4xl font-bold leading-tight text-white transition-all duration-500 transform md:text-5xl"
                    :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                    Welcome to Our Church Blog
                </h1>
                <p class="mt-4 text-xl font-light text-[#ffffff] opacity-90">
                    Discover stories, teachings, and
                    spiritual insights
                </p>
            </div>
        </div>
    </div>


    <!-- Filters and view toggle -->
    <div class="flex flex-col gap-4 mb-8 md:flex-row md:items-center md:justify-between">
        <button @click="mobileFiltersOpen = !mobileFiltersOpen"
            class="flex items-center px-5 py-3 space-x-2 text-white transition bg-blue-600 shadow-lg md:hidden rounded-xl hover:bg-blue-700">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
            </svg>
            <span>Filters</span>
        </button>
        <div class="flex items-center space-x-3">
            <button wire:click="setView('grid')" class="p-3 transition rounded-xl hover:bg-green-100"
                :class="{ 'bg-green-100 text-[#008000]': '{{ $view }}' === 'grid' }">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
            </button>
            <button wire:click="setView('list')" class="p-3 transition rounded-xl hover:bg-green-100"
                :class="{ 'bg-green-100 text-[#008000]': '{{ $view }}' === 'list' }">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile filter dropdown -->
    <div x-show="mobileFiltersOpen" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
        class="mb-6 md:hidden">
        <div class="p-5 bg-white shadow-xl rounded-2xl">
            <div class="mb-5">
                <label class="block mb-2 text-sm font-semibold text-gray-800">Category</label>
                <select wire:model="selectedCategory"
                    class="w-full px-4 py-3 border border-gray-200 rounded-lg bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-5">
                <label class="block mb-2 text-sm font-semibold text-gray-800">Search</label>
                <div class="relative">
                    <input type="text" wire:model.debounce.500ms="search"
                        class="w-full py-3 pl-10 pr-4 border border-gray-200 rounded-lg bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="Search articles...">
                    <svg class="absolute w-5 h-5 text-gray-400 -translate-y-1/2 left-3 top-1/2" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
            <button wire:click="clearFilters"
                class="w-full px-5 py-3 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500">Clear
                Filters</button>
        </div>
    </div>

    <!-- Desktop filters -->
    <div class="items-center hidden gap-4 mb-8 md:flex">
        <div class="relative flex-1 max-w-md">
            <input type="text" wire:model.debounce.500ms="search"
                class="w-full py-3 pl-10 pr-4 border border-gray-200 rounded-lg bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                placeholder="Search articles...">
            <svg class="absolute w-5 h-5 text-gray-400 -translate-y-1/2 left-3 top-1/2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>
        <select wire:model="selectedCategory"
            class="px-4 py-3 border border-gray-200 rounded-lg bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            <option value="">All Categories</option>
            @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <button wire:click="clearFilters"
            class="px-5 py-3 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500">Clear
            Filters</button>
    </div>

    <!-- Main content -->
    <div class="grid grid-cols-1 gap-8 lg:grid-cols-4">
        <!-- Articles section -->
        <div class="lg:col-span-3">
            <!-- Featured article -->
            @if($featuredArticle && !$search && !$selectedCategory)
            <div class="p-1 mb-10 shadow-xl bg-gradient-to-r from-green-600 to-blue-600 rounded-2xl">
                <div class="overflow-hidden bg-white rounded-xl">
                    <div class="relative">
                        @if($featuredArticle->featured_image)
                        <img src="{{ asset('storage/' . $featuredArticle->featured_image) }}"
                            alt="{{ $featuredArticle->title }}" class="object-cover w-full h-64 sm:h-80 lg:h-96"
                            loading="lazy">
                        @else
                        <div
                            class="flex items-center justify-center w-full h-64 sm:h-80 lg:h-96 bg-gradient-to-br from-green-50 to-blue-50">
                            <svg class="w-24 h-24 text-green-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        @endif
                        <span
                            class="absolute px-3 py-1 text-xs font-bold text-white bg-blue-600 rounded-full top-4 right-4">FEATURED</span>
                    </div>
                    <div class="p-6 sm:p-8">
                        <div class="flex items-center mb-4 space-x-3">
                            <span class="px-3 py-1 text-xs font-medium text-[#008000] bg-green-100 rounded-full">{{
                                $featuredArticle->category->name }}</span>
                            <span class="text-sm text-gray-600">{{ $featuredArticle->published_at->format('M d, Y')
                                }}</span>
                        </div>
                        <h2 class="mb-4 text-2xl font-extrabold sm:text-3xl" style="color: #008000;">{{
                            $featuredArticle->title }}</h2>
                        <p class="mb-5 leading-relaxed text-gray-700">{{ $featuredArticle->excerpt }}</p>
                        @if($featuredArticle->scripture_reference)
                        <div class="p-4 mb-5 italic text-gray-700 border-l-4 border-green-500 rounded-lg bg-green-50">
                            "{{ $featuredArticle->scripture_reference }}"</div>
                        @endif
                        <a href="{{ route('blog.show', $featuredArticle->slug) }}"
                            class="inline-flex items-center px-6 py-3 text-white transition bg-blue-600 rounded-lg hover:bg-blue-700">
                            Read Article
                            <svg class="w-5 h-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @endif

            <!-- No results -->
            @if($articles->count() === 0)
            <div class="p-10 text-center bg-white shadow-md rounded-2xl">
                <svg class="w-16 h-16 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="mt-4 text-xl font-semibold" style="color: #008000;">No articles found</h3>
                <p class="mt-2 text-gray-600">
                    @if($search)
                    No articles match "{{ $search }}".
                    @elseif($selectedCategory)
                    No articles in this category.
                    @else
                    No articles available yet.
                    @endif
                </p>
                <button wire:click="clearFilters"
                    class="px-5 py-3 mt-5 text-white bg-blue-600 rounded-lg hover:bg-blue-700">Clear Filters</button>
            </div>
            @else
            <!-- Grid view -->
            @if($view === 'grid')
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($articles as $article)
                <div
                    class="transition duration-300 transform bg-white shadow-sm rounded-xl hover:shadow-lg hover:-translate-y-1">
                    <div class="relative overflow-hidden rounded-t-xl aspect-w-16 aspect-h-9">
                        @if($article->featured_image)
                        <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}"
                            class="object-cover w-full h-full transition-transform duration-500 hover:scale-105"
                            loading="lazy">
                        @else
                        <div
                            class="flex items-center justify-center w-full h-full bg-gradient-to-br from-green-50 to-blue-50">
                            <svg class="w-12 h-12 text-green-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        @endif
                        <div
                            class="absolute bottom-0 left-0 right-0 h-20 bg-gradient-to-t from-black/60 to-transparent">
                        </div>
                        <span
                            class="absolute px-2 py-1 text-xs font-medium text-white bg-blue-600 rounded-full bottom-3 left-3">{{
                            $article->category->name }}</span>
                    </div>
                    <div class="p-5">
                        <div class="flex items-center mb-3 text-sm text-gray-600">
                            <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            {{ $article->published_at->format('M d, Y') }}
                            @if($article->view_count > 0)
                            <span class="flex items-center ml-4">
                                <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                {{ $article->view_count }}
                            </span>
                            @endif
                        </div>
                        <h3 class="mb-3 text-xl font-bold" style="color: #008000;">{{ $article->title }}</h3>
                        <p class="mb-4 text-sm text-gray-700 line-clamp-3">{{ $article->excerpt }}</p>
                        @if($article->scripture_reference)
                        <div
                            class="p-3 mb-4 text-xs italic text-gray-700 border-l-2 border-green-500 rounded bg-green-50">
                            {{ $article->scripture_reference }}</div>
                        @endif
                        <a href="{{ route('blog.show', $article->slug) }}"
                            class="inline-flex items-center text-sm font-semibold text-blue-600 hover:text-blue-800">
                            Read More
                            <svg class="w-4 h-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <!-- List view -->
            <div class="space-y-6">
                @foreach($articles as $article)
                <div class="transition bg-white shadow-sm rounded-xl hover:shadow-lg">
                    <div class="flex flex-col md:flex-row">
                        <div class="md:w-1/3">
                            @if($article->featured_image)
                            <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}"
                                class="object-cover w-full h-48 md:h-full rounded-t-xl md:rounded-l-xl md:rounded-t-none"
                                loading="lazy">
                            @else
                            <div
                                class="flex items-center justify-center w-full h-48 md:h-full bg-gradient-to-br from-green-50 to-blue-50 rounded-t-xl md:rounded-l-xl md:rounded-t-none">
                                <svg class="w-12 h-12 text-green-200" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            @endif
                        </div>
                        <div class="flex flex-col justify-between flex-1 p-6">
                            <div>
                                <div class="flex items-center mb-3 space-x-3">
                                    <span
                                        class="px-3 py-1 text-xs font-medium text-[#008000] bg-green-100 rounded-full">{{
                                        $article->category->name }}</span>
                                    <span class="text-sm text-gray-600">{{ $article->published_at->format('M d, Y')
                                        }}</span>
                                    @if($article->view_count > 0)
                                    <span class="flex items-center text-sm text-gray-600">
                                        <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        {{ $article->view_count }}
                                    </span>
                                    @endif
                                </div>
                                <h3 class="mb-3 text-xl font-bold" style="color: #008000;">{{ $article->title }}</h3>
                                <p class="mb-4 leading-relaxed text-gray-700">{{ $article->excerpt }}</p>
                                @if($article->scripture_reference)
                                <div
                                    class="p-4 mb-4 text-sm italic text-gray-700 border-l-4 border-green-500 rounded-lg bg-green-50">
                                    {{ $article->scripture_reference }}</div>
                                @endif
                            </div>
                            <a href="{{ route('blog.show', $article->slug) }}"
                                class="inline-flex items-center self-start px-5 py-3 text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                                Read Article
                                <svg class="w-4 h-4 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
            @endif

            <!-- Pagination -->
            <div class="mt-10">
                {{ $articles->links() }}
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <!-- Search for mobile -->
            <div class="p-5 mb-6 bg-white shadow-sm rounded-2xl lg:hidden">
                <div class="relative">
                    <input type="text" wire:model.debounce.500ms="search"
                        class="w-full py-3 pl-10 pr-4 border border-gray-200 rounded-lg bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="Search articles...">
                    <svg class="absolute w-5 h-5 text-gray-400 -translate-y-1/2 left-3 top-1/2" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>

            <!-- Categories -->
            <div class="p-6 mb-6 bg-white shadow-sm rounded-2xl">
                <h3 class="mb-5 text-xl font-bold" style="color: #008000;">Categories</h3>
                <div class="space-y-2">
                    <a href="#" wire:click.prevent="$set('selectedCategory', null)"
                        class="flex items-center justify-between px-3 py-2 transition rounded-lg hover:bg-green-50"
                        :class="{ 'bg-green-100 text-[#008000]': '{{ $selectedCategory }}' === '' }">
                        <span>All Categories</span>
                    </a>
                    @foreach($categories as $category)
                    <a href="#" wire:click.prevent="$set('selectedCategory', '{{ $category->id }}')"
                        class="flex items-center justify-between px-3 py-2 transition rounded-lg hover:bg-green-50"
                        :class="{ 'bg-green-100 text-[#008000]': '{{ $selectedCategory }}' === '{{ $category->id }}' }">
                        <span>{{ $category->name }}</span>
                        <span class="px-2 py-1 text-xs text-white bg-blue-600 rounded-full">{{ $category->articles_count
                            ?? 0 }}</span>
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- Recent posts -->
            <div class="p-6 mb-6 bg-white shadow-sm rounded-2xl">
                <h3 class="mb-5 text-xl font-bold" style="color: #008000;">Recent Posts</h3>
                @if($recentArticles->count() > 0)
                <div class="space-y-5">
                    @foreach($recentArticles as $recent)
                    <div class="flex space-x-4">
                        <div class="flex-shrink-0 w-16 h-16">
                            @if($recent->featured_image)
                            <img src="{{ asset('storage/' . $recent->featured_image) }}" alt="{{ $recent->title }}"
                                class="object-cover w-full h-full rounded-md" loading="lazy">
                            @else
                            <div class="flex items-center justify-center w-full h-full bg-green-100 rounded-md">
                                <svg class="w-6 h-6 text-green-300" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            @endif
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-900 line-clamp-2">
                                <a href="{{ route('blog.show', $recent->slug) }}" class="hover:text-blue-600">{{
                                    $recent->title }}</a>
                            </h4>
                            <p class="text-xs text-gray-600">{{ $recent->published_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-gray-600">No recent articles found.</p>
                @endif
            </div>

            <!-- Subscribe section -->
            <div class="p-6 rounded-2xl shadow-sm bg-[#008000]">
                <h3 class="mb-3 text-xl font-bold text-white">Stay Inspired</h3>
                <p class="mb-4 text-sm text-green-100">Join our newsletter for the latest spiritual insights and
                    updates.</p>
                <div class="space-y-3">
                    <input type="email" placeholder="Your email address"
                        class="w-full px-4 py-3 bg-white border-0 rounded-lg focus:ring-2 focus:ring-blue-300 focus:outline-none">
                    <button type="button"
                        class="w-full px-4 py-3 text-white transition bg-blue-600 rounded-lg hover:bg-blue-700">Subscribe</button>
                </div>
            </div>
            <br>
        </div>
    </div>

    <!-- Scroll to top -->
    <button x-show="showScrollTop" @click="scrollToTop" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
        class="fixed p-3 text-white transition bg-blue-600 rounded-full shadow-lg bottom-6 right-6 hover:bg-blue-700">
        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
        </svg>
    </button>
</div>
