<x-front-layout>
<div class="mt-16 bg-white sm:mt-20 dark:bg-gray-900">
    <!-- Hero Section -->
    <div class="relative py-20 bg-[#008000]">
        <div class="absolute inset-0 opacity-20 bg-pattern-overlay"></div>
        <div class="container relative z-10 px-4 mx-auto">
            <div class="max-w-3xl mx-auto text-center" x-data="{ loaded: false }"
                x-init="setTimeout(() => loaded = true, 100)" x-transition:enter.duration.500ms>
                <h1 class="text-4xl font-bold leading-tight text-white transition-all duration-500 transform md:text-5xl"
                    :class="loaded ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'">
                    Contact Our Church
                </h1>
                <p class="mt-4 text-xl font-light text-[#ffffff] opacity-90">
                    We're here to welcome you into our community and
                    answer any questions you might have
                </p>
            </div>
        </div>
    </div>
    <!-- Increased padding-top to py-16 -->
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-8 mb-12 lg:grid-cols-3">
            <!-- Address Card -->
            <div
                class="flex flex-col items-center p-6 text-center transition duration-300 bg-white border-2 border-transparent rounded-lg shadow-md dark:bg-gray-800 hover:shadow-lg group hover:border-green-200">
                <div class="p-3 mb-4 bg-green-100 rounded-full dark:bg-green-900">
                    <svg class="w-8 h-8 text-green-600 dark:text-black" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <h3 class="mb-2 text-xl font-semibold text-[#008000] dark:text-green-200">Our Location</h3>
                <p class="text-black dark:text-black">Christ Is The Way Ministries (CITWAM)</p>
                <p class="text-black dark:text-black">P.O. Box 4199 – 30200</p>
                <p class="text-black dark:text-black">KITALE, KENYA</p>
            </div>

            <!-- Worship Times Card -->
            <div
                class="flex flex-col items-center p-6 text-center transition duration-300 bg-white border-2 border-transparent rounded-lg shadow-md dark:bg-gray-800 hover:shadow-lg group hover:border-green-200">
                <div class="p-3 mb-4 bg-green-100 rounded-full dark:bg-green-900">
                    <svg class="w-8 h-8 text-green-600 dark:text-black" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="mb-2 text-xl font-semibold text-[#008000] dark:text-green-200">Worship Times</h3>
                <p class="text-black dark:text-black">Sunday Services: 9:00 AM & 11:00 AM</p>
                <p class="text-black dark:text-black">Wednesday Prayer: 7:00 PM</p>
            </div>

            <!-- Phone Card -->
            <div
                class="flex flex-col items-center p-6 text-center transition duration-300 bg-white border-2 border-transparent rounded-lg shadow-md dark:bg-gray-800 hover:shadow-lg group hover:border-green-200">
                <div class="p-3 mb-4 bg-green-100 rounded-full dark:bg-green-900">
                    <svg class="w-8 h-8 text-green-600 dark:text-black" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                </div>
                <h3 class="mb-2 text-xl font-semibold text-[#008000] dark:text-green-200">Call Us</h3>
                <p class="text-black dark:text-black">Main Office: +254 (0) 722 123 456</p>
                <p class="text-black dark:text-black">Prayer Line: +254 (0) 722 123 456</p>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-8 mb-12 lg:grid-cols-2" x-data="{ showMap: true }">
            <!-- Map Section -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden h-[450px]">
                <div class="w-full h-full" x-show="showMap">
                    <iframe class="w-full h-full"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d18975.906841727247!2d34.99806430551688!3d1.0144125206471362!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x178226fff8c493c5%3A0x4053f910a811f35c!2sKitale%2C%20Kenya!5e0!3m2!1sen!2sus!4v1743400145903!5m2!1sen!2sus"
                        style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                <div class="flex items-center justify-center w-full h-full bg-gray-100 dark:bg-gray-700"
                    x-show="!showMap">
                    <div class="p-6 text-center">
                        <svg class="w-12 h-12 mx-auto text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Map is currently hidden for privacy
                            reasons</p>
                        <button @click="showMap = true"
                            class="inline-flex items-center px-4 py-2 mt-3 text-sm font-medium text-white bg-green-600 border border-transparent rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Show Map
                        </button>
                    </div>
                </div>
                <div class="absolute z-10 top-4 right-4" x-show="showMap">
                    <button @click="showMap = false"
                        class="p-2 text-gray-500 bg-white rounded-full shadow-md dark:bg-gray-800 dark:text-gray-300 hover:text-green-600 dark:hover:text-black focus:outline-none">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            <!-- Contact Form Section -->
            <div class="p-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <h2 class="mb-6 text-2xl font-semibold text-[#008000] dark:text-green-200">Send Us a Message</h2>

                @if (session('success'))
                <div class="p-4 mb-6 text-black bg-green-100 border-l-4 border-green-500 dark:bg-green-800/20 dark:text-green-400"
                    role="alert">
                    <p>{{ session('success') }}</p>
                </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-black dark:text-black">Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-green-500 focus:ring-green-500 sm:text-sm">
                            @error('name')
                            <span class="mt-1 text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="email"
                                class="block text-sm font-medium text-black dark:text-black">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-green-500 focus:ring-green-500 sm:text-sm">
                            @error('email')
                            <span class="mt-1 text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="subject"
                                class="block text-sm font-medium text-black dark:text-black">Subject</label>
                            <select name="subject" id="subject"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-green-500 focus:ring-green-500 sm:text-sm">
                                <option value="General Inquiry" {{ old('subject')=='General Inquiry' ? 'selected' : ''
                                    }}>General Inquiry
                                </option>
                                <option value="Prayer Request" {{ old('subject')=='Prayer Request' ? 'selected' : '' }}>
                                    Prayer Request</option>
                                <option value="Community Service" {{ old('subject')=='Community Service' ? 'selected'
                                    : '' }}>Community Service
                                </option>
                                <option value="Other" {{ old('subject')=='Other' ? 'selected' : '' }}>Other
                                </option>
                            </select>
                            @error('subject')
                            <span class="mt-1 text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="message"
                                class="block text-sm font-medium text-black dark:text-black">Message</label>
                            <textarea name="message" id="message" rows="4" required
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-green-500 focus:ring-green-500 sm:text-sm">{{ old('message') }}</textarea>
                            @error('message')
                            <span class="mt-1 text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex items-center">
                            <input id="consent" name="consent" type="checkbox" required
                                class="w-4 h-4 text-green-600 border-gray-300 rounded focus:ring-green-500">
                            <label for="consent" class="block ml-2 text-sm text-black dark:text-black">
                                I consent to having this website store my information for future contact
                            </label>
                        </div>

                        <div class="flex items-center justify-end">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out  bg-[#000fff] border border-transparent rounded-md hover:bg-green-700 active:bg-green-800 focus:outline-none focus:border-green-900 focus:ring ring-green-300 disabled:opacity-25">
                                <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                                Send Message
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Hours & FAQ Section -->
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
            <!-- Office Hours -->
            <div class="p-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <h3 class="mb-4 text-xl font-semibold text-[#008000] dark:text-green-200">Service Times</h3>

                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span>Sunday Worship</span>
                        <span>9:00 AM & 11:00 AM</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-black dark:text-black">Saturday</span>
                        <span class="font-medium text-[#008000] dark:text-green-200">10:00 AM - 2:00 PM</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Wednesday Bible Study</span>
                        <span>7:00 PM</span>
                    </div>

                    <div class="flex justify-between">
                        <span>Youth Ministry</span>
                        <span>Fridays at 6:30 PM</span>
                    </div>
                </div>
            </div>

            <!-- FAQ -->
            <div class="p-6 bg-white rounded-lg shadow-md dark:bg-gray-800" x-data="{ activeTab: 'none' }">
                <h3 class="mb-4 text-xl font-semibold text-[#008000] dark:text-green-200">Frequently Asked Questions
                </h3>

                <div class="space-y-3">
                    <div class="border border-green-200 rounded-md dark:border-green-700">
                        <button @click="activeTab = (activeTab === 'faq1') ? 'none' : 'faq1'"
                            class="flex items-center justify-between w-full px-4 py-3 font-medium text-left text-[#008000] dark:text-green-200 focus:outline-none">
                            <span>How can I get involved in church activities?</span>
                            <svg class="w-5 h-5 text-green-600 transition-transform duration-200 transform dark:text-green-400"
                                :class="{ 'rotate-180': activeTab === 'faq1' }" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="activeTab === 'faq1'"
                            class="px-4 py-3 text-sm text-black border-t border-green-200 dark:text-black dark:border-green-700">
                            You can get involved by attending our weekly services, joining a small group, or
                            volunteering for community outreach programs. Check our events calendar for upcoming
                            activities.
                        </div>
                    </div>

                    <div class="border border-green-200 rounded-md dark:border-green-700">
                        <button @click="activeTab = (activeTab === 'faq2') ? 'none' : 'faq2'"
                            class="flex items-center justify-between w-full px-4 py-3 font-medium text-left text-[#008000] dark:text-green-200 focus:outline-none">
                            <span>What programs do you offer for children?</span>
                            <svg class="w-5 h-5 text-green-600 transition-transform duration-200 transform dark:text-green-400"
                                :class="{ 'rotate-180': activeTab === 'faq2' }" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="activeTab === 'faq2'"
                            class="px-4 py-3 text-sm text-black border-t border-green-200 dark:text-black dark:border-green-700">
                            We offer Sunday School, Vacation Bible School, and youth camps designed to help kids grow in
                            their faith in a fun and engaging way.
                        </div>
                    </div>

                    <div class="border border-green-200 rounded-md dark:border-green-700">
                        <button @click="activeTab = (activeTab === 'faq3') ? 'none' : 'faq3'"
                            class="flex items-center justify-between w-full px-4 py-3 font-medium text-left text-[#008000] dark:text-green-200 focus:outline-none">
                            <span>How can I submit a prayer request?</span>
                            <svg class="w-5 h-5 text-green-600 transition-transform duration-200 transform dark:text-green-400"
                                :class="{ 'rotate-180': activeTab === 'faq3' }" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="activeTab === 'faq3'"
                            class="px-4 py-3 text-sm text-black border-t border-green-200 dark:text-black dark:border-green-700">
                            Submit through our website's prayer request form or contact our prayer team directly. We're
                            here to support you.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Church Photo/Banner -->
        <div class="mt-12 overflow-hidden bg-green-700 rounded-lg shadow-lg">
            <div class="relative w-full h-64 overflow-hidden md:h-80 bg-bg-[#008000]">
                <div
                    class="absolute inset-0 flex flex-col items-center justify-center px-4 text-center bg-[#008000] bg-opacity-40">
                    <h2 class="mb-2 text-2xl font-bold text-black md:text-3xl">Join Us This Sunday</h2>
                    <p class="mb-6 text-lg text-black md:text-xl">Everyone is welcome in God's house</p>
                    <a href="#"
                        class="inline-flex items-center px-5 py-2.5  bg-[#000fff] text-white rounded-md font-medium text-sm hover:bg-green-50 transition duration-150">
                        Plan Your Visit
                    </a>
                </div>
            </div>
        </div>

        <br>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
                // Alpine.js initialization if needed
            });
</script>
@endpush
</x-front-layout>
