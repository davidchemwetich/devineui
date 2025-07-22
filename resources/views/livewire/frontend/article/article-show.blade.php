<div x-data="{
    isLoading: @entangle('isLoading'),
    shareOptionsOpen: false,
    showScrollTop: false,
    scrollToTop() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    },
    checkScroll() {
        this.showScrollTop = window.scrollY > 500;
    }
}" x-init="window.addEventListener('scroll', checkScroll)" class="relative font-sans">
    <!-- Loading overlay -->
    <div x-show="isLoading" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-100 bg-opacity-90 backdrop-blur-sm">
        <div class="flex flex-col items-center">
            <div class="w-12 h-12 border-4 border-t-blue-600 border-blue-200 rounded-full animate-spin"></div>
            <p class="mt-4 text-lg font-semibold text-blue-600">Loading article...</p>
        </div>
    </div>

    <!-- Breadcrumbs -->
    <nav class="container mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex flex-wrap items-center gap-2 text-sm text-gray-600">
            <a href="{{ route('blog.index') }}" class="hover:text-blue-600 transition-colors">Blog</a>
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <a href="#" wire:click.prevent="$parent.$set('selectedCategory', '{{ $article->category_id }}')"
                class="hover:text-blue-600 transition-colors">{{ $article->category->name }}</a>
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <span class="font-medium text-gray-900">{{ Str::limit($article->title, 50) }}</span>
        </div>
    </nav>

    <!-- Main content -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Article -->
            <div class="lg:col-span-3">
                <article class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    <!-- Featured image -->
                    <div class="relative">
                        @if($article->featured_image)
                        <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}"
                            class="object-cover w-full h-48 sm:h-64 md:h-80 lg:h-96" loading="lazy">
                        @else
                        <div class="flex items-center justify-center w-full h-48 sm:h-64 md:h-80 lg:h-96 bg-gradient-to-br from-green-50 to-blue-50">
                            <svg class="w-20 h-20 text-[#008000]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        @endif
                    </div>

                    <!-- Article content -->
                    <div class="p-4 sm:p-6 md:p-8">
                        <!-- Header -->
                        <header class="mb-6">
                            <div class="flex flex-wrap items-center gap-3 mb-4">
                                <span class="px-3 py-1 text-sm font-medium text-[#008000] bg-green-100 rounded-full">{{ $article->category->name }}</span>
                                <span class="flex items-center text-sm text-gray-500">
                                    <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ $article->published_at->format('F d, Y') }}
                                </span>
                                <span class="flex items-center text-sm text-gray-500">
                                    <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    {{ number_format($article->view_count) }} views
                                </span>
                            </div>
                            <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-[#008000] mb-3">{{ $article->title }}</h1>
                            <p class="text-base sm:text-lg text-gray-600">{{ $article->excerpt }}</p>
                        </header>

                        <!-- Scripture reference -->
                        @if($article->scripture_reference)
                        <div class="p-4 mb-8 bg-green-50 border-l-4 border-green-500 rounded-r-lg">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-green-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2h.01a1 1 0 100-2H9z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <div class="ml-3">
                                    <p class="text-sm text-[#008000] font-medium">Scripture Reference</p>
                                    <p class="mt-1 text-md text-green-900">{{ $article->scripture_reference }}</p>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Main article content -->
                        <div class="prose prose-green max-w-none text-gray-700">
                            {!! $article->body !!}
                        </div>

                        <!-- Share buttons -->
                        <div class="relative mt-8">
                            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between pt-6 border-t border-gray-200 gap-4">
                                <div class="flex items-center gap-4">
                                    <span class="text-sm font-medium text-gray-700">Share this article:</span>
                                    <button @click="shareOptionsOpen = !shareOptionsOpen"
                                        class="p-2 text-white bg-blue-600 rounded-full hover:bg-blue-700 transition-colors">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                        </svg>
                                    </button>

                                </div>
                                <a href="{{ route('blog.index') }}"
                                    class="flex items-center text-sm font-medium text-blue-600 hover:text-blue-800">
                                    <svg class="w-5 h-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Back to Blog
                                </a>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Related articles -->
                @if($relatedArticles->count() > 0)
                <section class="mt-12">
                    <h3 class="text-2xl font-bold text-[#008000] mb-6">Related Articles</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                        @foreach($relatedArticles as $related)
                        <a href="{{ route('blog.show', $related->slug) }}"
                            class="group bg-white rounded-lg shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden">
                            <div class="relative aspect-w-16 aspect-h-9">
                                @if($related->featured_image)
                                <img src="{{ asset('storage/' . $related->featured_image) }}" alt="{{ $related->title }}"
                                    class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-300" loading="lazy">
                                @else
                                <div class="flex items-center justify-center w-full h-full bg-gradient-to-br from-gray-100 to-green-50">
                                    <svg class="w-10 h-10 text-[#008000]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                @endif
                            </div>
                            <div class="p-4">
                                <p class="text-sm text-gray-500 mb-2">{{ $related->published_at->format('M d, Y') }}</p>
                                <h4 class="text-lg font-bold text-[#008000] mb-2 group-hover:text-green-600 transition-colors">{{ Str::limit($related->title, 60) }}</h4>
                                <span class="inline-flex items-center text-sm font-medium text-blue-600 group-hover:text-blue-800">
                                    Read Article
                                    <svg class="w-4 h-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </section>
                @endif
            </div>

            <!-- Sidebar -->
            <aside class="lg:col-span-1 space-y-6">
                <!-- Categories -->
                <div class="p-6 bg-white rounded-2xl shadow-lg">
                    <h3 class="text-lg font-bold text-[#008000] mb-4">Categories</h3>
                    <div class="space-y-2">
                        @foreach($categories as $category)
                        <a href="{{ route('blog.index') }}"
                            wire:click.prevent="$parent.$set('selectedCategory', '{{ $category->id }}')"
                            class="flex items-center justify-between px-3 py-2 rounded-lg hover:bg-green-50 transition-colors"
                            :class="{ 'bg-green-100 text-green-700': '{{ $article->category_id }}' === '{{ $category->id }}' }">
                            <span>{{ $category->name }}</span>
                            <span class="px-2 py-1 text-xs text-green-600 bg-green-100 rounded-full">{{ $category->articles_count ?? 0 }}</span>
                        </a>
                        @endforeach
                    </div>
                </div>

                <!-- Author info -->
                <div class="p-6 bg-white rounded-2xl shadow-lg">
                    <h3 class="text-lg font-bold text-[#008000] mb-4">About the Author</h3>
                    <div class="flex items-center mb-4">
                        @if($article->user && $article->user->profile_photo_path)
                        <img src="{{ asset('storage/' . $article->user->profile_photo_path) }}"
                            alt="{{ $article->user->name }}"
                            class="object-cover w-12 h-12 mr-4 rounded-full border-2 border-green-100">
                        @else
                        <div class="flex items-center justify-center w-12 h-12 mr-4 text-white bg-green-600 rounded-full">
                            <span class="text-lg font-bold">{{ $article->user ? substr($article->user->name, 0, 1) : 'A' }}</span>
                        </div>
                        @endif
                        <div>
                            <h4 class="font-medium text-[#008000]">{{ $article->user ? $article->user->name : 'Anonymous' }}</h4>
                            <p class="text-sm text-gray-600">{{ $article->user && $article->user->bio ? $article->user->bio : 'Writer' }}</p>
                        </div>
                    </div>
                    @if($article->user && $article->user->description)
                    <p class="text-sm text-gray-700">{{ Str::limit($article->user->description, 150) }}</p>
                    @endif
                    @if($article->user)
                    <div class="flex items-center mt-4 gap-3">
                        @if($article->user->twitter)
                        <a href="{{ $article->user->twitter }}" target="_blank" class="text-blue-400 hover:text-blue-600">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723 10.054 10.054 0 01-3.127 1.195 4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                            </svg>
                        </a>
                        @endif
                        @if($article->user->linkedin)
                        <a href="{{ $article->user->linkedin }}" target="_blank" class="text-blue-700 hover:text-blue-900">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                            </svg>
                        </a>
                        @endif
                        @if($article->user->facebook)
                        <a href="{{ $article->user->facebook }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </a>
                        @endif
                        @if($article->user->website)
                        <a href="{{ $article->user->website }}" target="_blank" class="text-gray-600 hover:text-gray-800">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                            </svg>
                        </a>
                        @endif
                    </div>
                    @endif
                </div>

                <!-- Popular tags -->
                <div class="p-6 bg-white rounded-2xl shadow-lg">
                    <h3 class="text-lg font-bold text-[#008000] mb-4">Popular Tags</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($article->tags ?? [] as $tag)
                        <a href="{{ route('blog.index') }}?tag={{ $tag->slug }}"
                            class="px-3 py-1 text-sm font-medium text-green-700 bg-green-100 rounded-full hover:bg-[#008000] transition-colors">
                            {{ $tag->name }}
                        </a>
                        @endforeach
                        @if(!$article->tags || count($article->tags) === 0)
                        <span class="text-sm text-gray-500">No tags for this article</span>
                        @endif
                    </div>
                </div>

                <!-- Newsletter signup -->
                <div class="p-6 bg-white rounded-2xl shadow-lg">
                    <h3 class="text-lg font-bold text-[#008000] mb-4">Subscribe to Newsletter</h3>
                    <p class="text-sm text-gray-600 mb-4">Stay updated with our latest articles and insights.</p>
                    <form class="space-y-3">
                        <input type="email" placeholder="Your email address"
                            class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <button type="submit"
                            class="w-full px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                            Subscribe
                        </button>
                    </form>
                    <p class="mt-3 text-xs text-gray-500">By subscribing, you agree to our Privacy Policy.</p>
                </div>
            </aside>
        </div>
    </div>
</div>