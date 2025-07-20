<div class="py-12 bg-gray-50">
    <div class="max-w-3xl px-4 mx-auto sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white rounded-lg shadow-md">
            <div class="px-6 py-8">
                <h2 class="mb-8 text-2xl font-bold text-center text-gray-800">Contact Us</h2>

                @if (session()->has('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                    class="p-4 mb-6 text-green-700 bg-green-100 border-l-4 border-green-500" role="alert">
                    <p>{{ session('success') }}</p>
                    <button type="button" @click="show = false" class="float-right text-green-700">&times;</button>
                </div>
                @endif

                @if (session()->has('error'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                    class="p-4 mb-6 text-red-700 bg-red-100 border-l-4 border-red-500" role="alert">
                    <p>{{ session('error') }}</p>
                    <button type="button" @click="show = false" class="float-right text-red-700">&times;</button>
                </div>
                @endif

                <form wire:submit.prevent="submitForm" class="space-y-6">
                    <div>
                        <label for="fullname" class="block text-sm font-medium text-gray-700">Full Name</label>
                        <div class="mt-1">
                            <input wire:model.blur="fullname" type="text" id="fullname"
                                class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                placeholder="John D">
                        </div>
                        @error('fullname') <span class="mt-1 text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                            <div class="mt-1">
                                <input wire:model.blur="email" type="email" id="email"
                                    class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    placeholder="example@gmail.com">
                            </div>
                            @error('email') <span class="mt-1 text-xs text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                            <div class="mt-1">
                                <input wire:model.blur="phone" type="tel" id="phone"
                                    class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    placeholder="+ (254)70000000">
                            </div>
                            @error('phone') <span class="mt-1 text-xs text-red-500">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label for="communicationType" class="block text-sm font-medium text-gray-700">Preferred
                            Communication Method</label>
                        <div class="mt-1">
                            <select wire:model.blur="communicationType" id="communicationType"
                                class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="">Select an option</option>
                                @foreach($communicationTypes as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('communicationType') <span class="mt-1 text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700">Subject</label>
                        <div class="mt-1">
                            <input wire:model.blur="subject" type="text" id="subject"
                                class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                placeholder="Prayer Request">
                        </div>
                        @error('subject') <span class="mt-1 text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                        <div class="mt-1">
                            <textarea wire:model.blur="message" id="message" rows="5"
                                class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                placeholder="Your message here..."></textarea>
                        </div>
                        @error('message') <span class="mt-1 text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-500">
                            <p>We'll get back to you as soon as possible.</p>
                        </div>
                        <button type="submit" class="inline-flex items-center
                               px-4 py-2 sm:px-5 sm:py-2.5 md:px-6 md:py-3
                               text-sm sm:text-base
                               border border-transparent
                               font-medium rounded-md shadow-sm
                               text-white bg-indigo-600
                               hover:bg-indigo-700
                               focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            wire:loading.attr="disabled">

                            <span wire:loading.remove>Send Message</span>

                            <span wire:loading>
                                <svg class="w-5 h-5 mr-2 -ml-1 text-white animate-spin"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373
                                         0 0 5.373 0 12h4zm2
                                         5.291A7.962 7.962 0
                                         014 12H0c0 3.042
                                         1.135 5.824 3
                                         7.938l3-2.647z"></path>
                                </svg>
                                Sending...
                            </span>
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
