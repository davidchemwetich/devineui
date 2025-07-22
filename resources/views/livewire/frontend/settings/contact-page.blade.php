<div>
    {{-- HERO --}}
    <section class="relative py-20 bg-[#008000]">
        <div class="absolute inset-0 opacity-20 bg-pattern-overlay"></div>
        <div class="container relative z-10 px-4 mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white transition-all duration-500"
                x-data="{ show:false }"
                x-init="setTimeout(()=>show=true,100)"
                x-show="show"
                x-transition>
                Contact Our Church
            </h1>
            <p class="mt-4 text-xl font-light text-white/90">
                We're here to welcome you into our community and answer any questions.
            </p>
        </div>
    </section>

    {{-- CARDS --}}
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 gap-8 mb-12 lg:grid-cols-3">
            @foreach([
                ['icon'=>'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z','title'=>'Our Location','lines'=>['Christ Is The Way Ministries (CITWAM)','P.O. Box 4199 – 30200','KITALE, KENYA']],
                ['icon'=>'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z','title'=>'Worship Times','lines'=>['Sunday Services: 9:00 AM & 11:00 AM','Wednesday Prayer: 7:00 PM']],
                ['icon'=>'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z','title'=>'Call Us','lines'=>['Main Office: +254 (0) 722 123 456','Prayer Line: +254 (0) 722 123 456']]
            ] as $card)
            <div class="flex flex-col items-center p-6 text-center bg-white border-2 border-transparent rounded-lg shadow-md dark:bg-gray-800 hover:shadow-lg hover:border-green-200 transition">
                <div class="p-3 mb-4 bg-green-100 rounded-full">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $card['icon'] }}"/>
                    </svg>
                </div>
                <h3 class="mb-2 text-xl font-semibold text-[#008000]">{{ $card['title'] }}</h3>
                @foreach($card['lines'] as $l)
                    <p class="text-black">{{ $l }}</p>
                @endforeach
            </div>
            @endforeach
        </div>

        {{-- MAP + FORM --}}
        <div class="grid grid-cols-1 gap-8 mb-12 lg:grid-cols-2" x-data="{showMap:true}">
            {{-- Map --}}
            <div class="relative bg-white rounded-lg shadow-md overflow-hidden h-[450px] dark:bg-gray-800">
                <template x-if="showMap">
                    <iframe class="w-full h-full"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d18975.906841727247!2d34.99806430551688!3d1.0144125206471362!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x178226fff8c493c5%3A0x4053f910a811f35c!2sKitale%2C%20Kenya!5e0!3m2!1sen!2sus!4v1743400145903!5m2!1sen!2sus"
                            style="border:0;" allowfullscreen loading="lazy"></iframe>
                </template>
                <template x-if="!showMap">
                    <div class="flex items-center justify-center w-full h-full bg-gray-100 dark:bg-gray-700">
                        <div class="p-6 text-center">
                            <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            <p class="mt-2 text-sm text-gray-500">Map hidden for privacy</p>
                            <button @click="showMap=true"
                                    class="mt-3 px-4 py-2 text-sm font-medium text-white bg-[#000fff] rounded-md hover:bg-green-700">
                                Show Map
                            </button>
                        </div>
                    </div>
                </template>
                <button x-show="showMap" @click="showMap=false"
                        class="absolute top-4 right-4 p-2 bg-white rounded-full shadow-md text-gray-500 hover:text-green-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Form --}}
            <div class="p-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <h2 class="mb-6 text-2xl font-semibold text-[#008000]">Send Us a Message</h2>

                @if($success)
                    <div class="p-4 mb-4 text-sm bg-green-100 border-l-4 border-green-500 text-green-700">
                        {{ $success }}
                    </div>
                @endif

                <form wire:submit="submit" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-black">Name</label>
                        <input type="text" wire:model="name" required
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm dark:bg-gray-700 dark:text-white">
                        @error('name') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-black">Email</label>
                        <input type="email" wire:model="email" required
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm dark:bg-gray-700 dark:text-white">
                        @error('email') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-black">Subject</label>
                        <select wire:model="subject"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm dark:bg-gray-700 dark:text-white">
                            <option>General Inquiry</option>
                            <option>Prayer Request</option>
                            <option>Community Service</option>
                            <option>Other</option>
                        </select>
                        @error('subject') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-black">Message</label>
                        <textarea wire:model="message" rows="4" required
                                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm dark:bg-gray-700 dark:text-white"></textarea>
                        @error('message') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" wire:model="consent" required class="h-4 w-4 text-green-600">
                        <label class="ml-2 text-sm text-black">I consent to storing my information</label>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-[#000fff] border border-transparent rounded-md hover:bg-green-700 active:bg-green-800 focus:outline-none">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                            </svg>
                            Send Message
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- TIMES + FAQ --}}
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
            {{-- Service Times --}}
            <div class="p-6 bg-white rounded-lg shadow-md dark:bg-gray-800">
                <h3 class="mb-4 text-xl font-semibold text-[#008000]">Service Times</h3>
                <div class="space-y-3 text-black">
                    <div class="flex justify-between"><span>Sunday Worship</span><span class="font-medium text-[#008000]">9:00 AM & 11:00 AM</span></div>
                    <div class="flex justify-between"><span>Saturday</span><span class="font-medium text-[#008000]">10:00 AM – 2:00 PM</span></div>
                    <div class="flex justify-between"><span>Wednesday Bible Study</span><span class="font-medium text-[#008000]">7:00 PM</span></div>
                    <div class="flex justify-between"><span>Youth Ministry</span><span class="font-medium text-[#008000]">Fridays 6:30 PM</span></div>
                </div>
            </div>

            {{-- FAQ --}}
            <div class="p-6 bg-white rounded-lg shadow-md dark:bg-gray-800" x-data="{active:null}">
                <h3 class="mb-4 text-xl font-semibold text-[#008000]">Frequently Asked Questions</h3>
                @foreach([
                    ['q'=>'How can I get involved?','a'=>'Attend services, join small groups or volunteer for outreach.'],
                    ['q'=>'What children programs?','a'=>'Sunday School, VBS and youth camps.'],
                    ['q'=>'How to submit prayer request?','a'=>'Use the form above or contact the prayer team.']
                ] as $faq)
                <div class="border border-green-200 rounded-md mb-2">
                    <button @click="active = (active === {{ $loop->index }}) ? null : {{ $loop->index }}"
                            class="w-full flex justify-between items-center px-4 py-3 font-medium text-left text-[#008000] focus:outline-none">
                        <span>{{ $faq['q'] }}</span>
                        <svg class="w-5 h-5 transition-transform" :class="{ 'rotate-180': active === {{ $loop->index }} }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="active === {{ $loop->index }}" x-collapse class="px-4 py-3 text-sm text-black border-t border-green-200">
                        {{ $faq['a'] }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>