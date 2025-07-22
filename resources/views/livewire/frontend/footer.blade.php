<footer x-data="{ showBackToTop: false }" @scroll.window="showBackToTop = (window.pageYOffset > 200)" class="relative">
    <!-- Back to Top Button -->
    <button x-show="showBackToTop" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform translate-y-2"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        class="fixed p-3 transition-colors rounded-full shadow-lg bottom-6 right-6 bg-emerald-700 hover:bg-emerald-600"
        @click="window.scrollTo({ top: 0, behavior: 'smooth' })">
        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
        </svg>
    </button>

    <div class="w-full bg-[#008000] bg-opacity-50 backdrop-blur-sm">
        <div class="px-4 py-12 mx-auto max-w-7xl sm:px-6 lg:px-8 lg:py-16">
            <div class="grid grid-cols-1 gap-8 md:grid-cols-4 lg:gap-12">
                <!-- Church Info -->
                <div class="md:col-span-2">
                    <div class="flex items-center mb-6">
                        @if($settings && $settings->institution_logo)
                        <img class="w-12 h-12 rounded-lg" src="{{ Storage::url($settings->institution_logo) }}"
                            alt="Church Logo">
                        @endif
                        <h2 class="ml-3 text-2xl font-bold text-black dark:to-gray-100 bg-clip-text">
                            Christ Is the Way Ministries
                        </h2>
                    </div>
                    <p class="mb-6 text-sm leading-relaxed text-black/70 dark:text-white/70">
                        {{ $settings->about ?? 'Reaching the world with the Gospel of Christ through faith, love, and
                        discipleship.' }}
                    </p>

                    <!-- Newsletter Subscription -->
                    <div x-data="{ email: '', submitted: false }" class="mb-6">
                        <h3 class="mb-3 font-semibold text-black dark:text-white">Join Our Newsletter</h3>
                        <form @submit.prevent="submitted = true" class="flex gap-2">
                            <input type="email" x-model="email" required
                                class="flex-1 px-4 py-2 text-sm text-black bg-white border border-gray-300 rounded-lg dark:bg-gray-800 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-emerald-300"
                                placeholder="Enter your email">
                            <button type="submit" class="px-4 py-2 text-sm text-white transition-colors bg-[#000fff]">
                                Subscribe
                            </button>
                        </form>
                        <p x-show="submitted" class="mt-2 text-sm text-black/70 dark:text-white/70">
                            Thank you for subscribing!
                        </p>
                    </div>
                </div>

                <!-- Ministries -->
                <div>
                    <h3 class="mb-4 text-sm font-semibold text-black uppercase dark:text-white">Ministries</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('ministries.index') }}"
                                class="text-sm transition-colors text-black/70 hover:text-black dark:text-white/70 dark:hover:text-white">Children's
                                Ministry</a></li>
                        <li><a href="{{ route('ministries.index') }}"
                                class="text-sm transition-colors text-black/70 hover:text-black dark:text-white/70 dark:hover:text-white">Youth
                                Fellowship</a></li>
                        <li><a href="{{ route('ministries.index') }}"
                                class="text-sm transition-colors text-black/70 hover:text-black dark:text-white/70 dark:hover:text-white">Women
                                of
                                Purpose</a></li>
                        <li><a href="{{ route('churches') }}"
                                class="text-sm transition-colors text-black/70 hover:text-black dark:text-white/70 dark:hover:text-white">Explore
                                Ministries</a>
                        </li>
                    </ul>
                </div>

                <!-- Connect -->
                <div>
                    <h3 class="mb-4 text-sm font-semibold text-black uppercase dark:text-white">Connect</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('contact') }}"
                                class="text-sm transition-colors text-black/70 hover:text-black dark:text-white/70 dark:hover:text-white">Contact
                                Us</a>
                        </li>
                        <li><a href="{{ route('frontend.info-hub') }}"
                                class="text-sm transition-colors text-black/70 hover:text-black dark:text-white/70 dark:hover:text-white">Church-Bulletin</a>
                        </li>
                        <li><a href="https://church.test/privacy-policy"
                                class="text-sm transition-colors text-black/70 hover:text-black dark:text-white/70 dark:hover:text-white">Privacy
                                Policy</a>
                        </li>
                        <li><a href="https://church.test/terms-of-service"
                                class="text-sm transition-colors text-black/70 hover:text-black dark:text-white/70 dark:hover:text-white">Terms
                                of
                                Service</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Divider -->
            <div class="my-8 border-t border-gray-300 dark:border-gray-600"></div>

            <!-- Bottom Section -->
            <div class="md:flex md:items-center md:justify-between">
                <!-- Social Media -->
                <div class="flex mb-4 space-x-4 md:mb-0">
                    @foreach ($socialLinks as $platform => $url)
                    <a href="{{ $url }}"
                        class="transition-colors text-black/70 hover:text-black dark:text-white/70 dark:hover:text-white">
                        @switch(strtolower($platform))
                        @case('facebook')
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                        </svg>
                        @break

                        @case('youtube')
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                        </svg>
                        @break

                        @case('instagram')
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z" />
                        </svg>
                        @break
                        @endswitch
                    </a>
                    @endforeach
                </div>

                <!-- Copyright -->
                <div class="text-sm text-black/70 dark:text-white/70">
                    © {{ date('Y') }} Christ Is the Way Ministries. All rights reserved.
                </div>
            </div>
        </div>
    </div>

    <!-- Watermark Signature -->
    <a href="https://netops.vercel.app/" target="_blank" rel="noopener"
        class="fixed flex items-center px-3 py-1 text-sm transition-all duration-300 rounded-full shadow-lg bg-gradient-to-r from-[#374151] via-[#f43f5e] to-[#fb923c] shadow-cyan-900/30 backdrop-blur-sm hover:bg-gradient-to-r hover:from-cyan-500 hover:to-emerald-400 hover:shadow-cyan-900/40 hover:scale-105 bottom-6 left-6 gap-x-1 group"
        x-data="{ showSignature: true }" x-show="showSignature" x-transition:enter="transition ease-out duration-300"
        x-transition:leave="transition ease-in duration-200">
        <span class="relative flex items-center pr-0.5">
            <svg class="w-4 h-4 shrink-0 stroke-white" fill="none" stroke-width="1.8" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M17.25 6.75L22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3l-4.5 16.5" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
            <span class="ml-1 text-xs font-semibold text-white drop-shadow-md">
                Built by <span class="transition-colors text-cyan-100 group-hover:text-cyan-50">NetOps</span>
            </span>
        </span>
        <span class="absolute inset-0 rounded-full opacity-10 bg-gradient-to-r from-white to-transparent"></span>
    </a>


</footer>
