<footer class="bg-[#008000] text-white" aria-labelledby="footer-heading">
    <h2 id="footer-heading" class="sr-only">Footer</h2>

    {{-- Alpine.js component for handling footer-wide state --}}
    <div x-data="{
            showBackToTop: false,
            newsletter: { email: '', status: 'idle' }, // idle, sending, success, error
            handleSubscription() {
                if (!this.$refs.emailInput.checkValidity()) {
                    this.newsletter.status = 'error';
                    return;
                }
                this.newsletter.status = 'sending';
                // Simulate API call
                setTimeout(() => {
                    this.newsletter.status = 'success';
                }, 1500);
            }
        }"
         @scroll.window="showBackToTop = (window.pageYOffset > 300)">

        {{-- Main Footer Content --}}
        <div class="mx-auto max-w-7xl px-6 pb-8 pt-16 sm:pt-24 lg:px-8 lg:pt-32">
            <div class="xl:grid xl:grid-cols-3 xl:gap-8">
                {{-- Church Info, Newsletter, & App Section --}}
                <div class="space-y-8 xl:col-span-1">
                    <div class="flex items-center space-x-3">
                        @if($settings && $settings->institution_logo)
                            <img class="h-12 w-auto rounded-lg bg-white/10 p-1" src="{{ Storage::url($settings->institution_logo) }}" alt="Church Logo">
                        @else
                             {{-- Placeholder Logo --}}
                            <div class="h-12 w-12 flex-shrink-0 rounded-lg bg-white/20 flex items-center justify-center">
                                <svg class="h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 21.75l-3.75-3.75m3.75 3.75L15.75 18m-3.75 3.75V4.5m3.75 13.5L12 12m-9-6l6-6m-6 6l6 6m6-6l-6-6m6 6l-6 6" />
                                </svg>
                            </div>
                        @endif
                        <span class="text-2xl font-bold tracking-tight text-white">Christ Is the Way</span>
                    </div>
                    <p class="text-sm text-gray-200">
                        {{ $settings->about ?? 'Reaching the world with the Gospel of Christ through faith, love, and discipleship. Join us in our journey.' }}
                    </p>

                    {{-- Newsletter Form --}}
                    <div>
                        <h3 class="text-sm font-semibold leading-6 text-white">Subscribe to our newsletter</h3>
                        <p class="mt-2 text-sm text-gray-300">The latest news, articles, and resources, sent to your inbox weekly.</p>
                        <form class="mt-4 sm:flex sm:max-w-md" @submit.prevent="handleSubscription">
                            <label for="email-address" class="sr-only">Email address</label>
                            <input type="email" name="email-address" id="email-address" autocomplete="email" required
                                   x-ref="emailInput"
                                   x-model="newsletter.email"
                                   class="w-full min-w-0 appearance-none rounded-md border-0 bg-white/10 px-3 py-2 text-base text-white shadow-sm ring-1 ring-inset ring-white/20 placeholder:text-gray-300 focus:ring-2 focus:ring-inset focus:ring-[#000fff] sm:w-64 sm:text-sm sm:leading-6"
                                   placeholder="Enter your email">
                            <div class="mt-3 sm:ml-4 sm:mt-0 sm:flex-shrink-0">
                                <button type="submit"
                                        class="flex w-full items-center justify-center rounded-md bg-[#000fff] px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-[#000fff]/90 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#000fff] transition-all duration-200"
                                        :disabled="newsletter.status === 'sending' || newsletter.status === 'success'"
                                        :class="{ 'opacity-50 cursor-not-allowed': newsletter.status === 'sending' || newsletter.status === 'success' }">
                                    <span x-show="newsletter.status === 'idle' || newsletter.status === 'error'">Subscribe</span>
                                    <span x-show="newsletter.status === 'sending'">Subscribing...</span>
                                    <span x-show="newsletter.status === 'success'">Subscribed!</span>
                                </button>
                            </div>
                        </form>
                        <p x-show="newsletter.status === 'success'" x-transition class="mt-2 text-sm text-green-200">Thank you for subscribing!</p>
                        <p x-show="newsletter.status === 'error'" x-transition class="mt-2 text-sm text-red-300">Please enter a valid email address.</p>
                    </div>

                    {{-- Get Our App Section --}}
                    <div class="pt-4">
                        <h3 class="text-sm font-semibold leading-6 text-white">Get Our App</h3>
                        <div class="mt-4 flex flex-wrap gap-4">
                            {{-- Google Play Store Link --}}
                            <a href="#" aria-label="Get it on Google Play" class="inline-block rounded-lg overflow-hidden transition-transform hover:scale-105 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#000fff]">
                                <img src="https://play.google.com/intl/en_us/badges/static/images/badges/en_badge_web_generic.png" alt="Get it on Google Play" class="h-12">
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Links Grid --}}
                <div class="mt-16 grid grid-cols-2 gap-8 xl:col-span-2 xl:mt-0">
                    <div class="md:grid md:grid-cols-2 md:gap-8">
                        <div>
                            <h3 class="text-sm font-semibold leading-6 text-white">Ministries</h3>
                            <ul role="list" class="mt-6 space-y-4">
                                <li><a href="{{ route('ministries.index') }}" class="text-sm leading-6 text-gray-200 hover:text-white transition-colors">Children's Ministry</a></li>
                                <li><a href="{{ route('ministries.index') }}" class="text-sm leading-6 text-gray-200 hover:text-white transition-colors">Youth Fellowship</a></li>
                                <li><a href="{{ route('ministries.index') }}" class="text-sm leading-6 text-gray-200 hover:text-white transition-colors">Women of Purpose</a></li>
                                <li><a href="{{ route('ministries.index') }}" class="text-sm leading-6 text-gray-200 hover:text-white transition-colors">Explore All</a></li>
                            </ul>
                        </div>
                        <div class="mt-10 md:mt-0">
                            <h3 class="text-sm font-semibold leading-6 text-white">Connect</h3>
                            <ul role="list" class="mt-6 space-y-4">
                                <li><a href="{{ route('contact') }}" class="text-sm leading-6 text-gray-200 hover:text-white transition-colors">Contact Us</a></li>
                                <li><a href="{{ route('blog.index') }}" class="text-sm leading-6 text-gray-200 hover:text-white transition-colors">Church Bulletin</a></li>
                                <li><a href="#" class="text-sm leading-6 text-gray-200 hover:text-white transition-colors">Prayer Requests</a></li>
                                <li><a href="#" class="text-sm leading-6 text-gray-200 hover:text-white transition-colors">Events Calendar</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="md:grid md:grid-cols-2 md:gap-8">
                        <div>
                            <h3 class="text-sm font-semibold leading-6 text-white">Resources</h3>
                            <ul role="list" class="mt-6 space-y-4">
                                <li><a href="#" class="text-sm leading-6 text-gray-200 hover:text-white transition-colors">Sermons</a></li>
                                <li><a href="#" class="text-sm leading-6 text-gray-200 hover:text-white transition-colors">Bible Study</a></li>
                                <li><a href="#" class="text-sm leading-6 text-gray-200 hover:text-white transition-colors">Giving</a></li>
                            </ul>
                        </div>
                        <div class="mt-10 md:mt-0">
                            <h3 class="text-sm font-semibold leading-6 text-white">Legal</h3>
                            <ul role="list" class="mt-6 space-y-4">
                                <li><a href="#" class="text-sm leading-6 text-gray-200 hover:text-white transition-colors">Privacy Policy</a></li>
                                <li><a href="#" class="text-sm leading-6 text-gray-200 hover:text-white transition-colors">Terms of Service</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bottom Section: Copyright & Socials --}}
            <div class="mt-16 border-t border-white/20 pt-8 sm:mt-20 lg:mt-24 lg:flex lg:items-center lg:justify-between">
                <div class="flex space-x-6 lg:order-2">
                    @foreach ($socialLinks as $platform => $url)
                    <a href="{{ $url }}" target="_blank" rel="noopener" class="text-gray-300 hover:text-white transition-transform hover:scale-110">
                        <span class="sr-only">{{ ucfirst($platform) }}</span>
                        @switch(strtolower($platform))
                            @case('facebook')
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
                                @break
                            @case('instagram')
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.024.06 1.378.06 3.808s-.012 2.784-.06 3.808c-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.024.048-1.378.06-3.808.06s-2.784-.013-3.808-.06c-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.048-1.024-.06-1.378-.06-3.808s.012-2.784.06-3.808c.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 016.45 2.525c.636-.247 1.363-.416 2.427.465C9.9 2.013 10.254 2 12.315 2zM12 0C9.58 0 9.22.01 8.05.058c-1.268.049-2.148.277-2.91.57a6.917 6.917 0 00-2.163 1.36c-.784.785-1.18 1.642-1.36 2.163-.293.762-.522 1.642-.57 2.91-.048 1.17-.058 1.53-.058 4.05s.01 2.88.058 4.05c.049 1.268.277 2.148.57 2.91a6.917 6.917 0 001.36 2.163c.785.784 1.642 1.18 2.163 1.36.762.293 1.642.522 2.91.57 1.17.048 1.53.058 4.05.058s2.88-.01 4.05-.058c1.268-.049 2.148-.277 2.91-.57a6.917 6.917 0 002.163-1.36c.784-.785 1.18-1.642 1.36-2.163.293-.762.522-1.642-.57-2.91.048-1.17.058-1.53.058-4.05s-.01-2.88-.058-4.05c-.049-1.268-.277-2.148-.57-2.91a6.917 6.917 0 00-1.36-2.163c-.785-.784-1.642-1.18-2.163-1.36-.762-.293-1.642-.522-2.91-.57C14.78.01 14.42 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" clip-rule="evenodd" /></svg>
                                @break
                            @case('youtube')
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M19.812 5.418c.861.23 1.538.907 1.768 1.768C21.998 8.78 22 12 22 12s0 3.22-.42 4.814a2.506 2.506 0 01-1.768 1.768c-1.59.42-7.812.42-7.812.42s-6.22 0-7.812-.42a2.506 2.506 0 01-1.768-1.768C2 15.22 2 12 2 12s0-3.22.42-4.814a2.506 2.506 0 011.768-1.768C5.78 5 12 5 12 5s6.22 0 7.812.418zM9.5 15.5V8.5l6 3.5-6 3.5z" clip-rule="evenodd" /></svg>
                                @break
                        @endswitch
                    </a>
                    @endforeach
                </div>
                <p class="mt-8 text-xs leading-5 text-gray-300 lg:order-1 lg:mt-0">
                    &copy; {{ date('Y') }} Christ Is the Way Ministries. All rights reserved.
                </p>
            </div>
        </div>

        {{-- Back to Top Button --}}
        <button x-show="showBackToTop"
                @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 translate-y-4"
                class="fixed bottom-6 right-6 rounded-full bg-[#000fff] p-3 text-white shadow-lg hover:bg-[#000fff]/90 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-[#008000]"
                aria-label="Go to top">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
            </svg>
        </button>

    </div>
</footer>