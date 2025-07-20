<!-- donation-page.blade.php -->
<div class="min-h-screen pt-24"
    x-data="{ activeTab: 'mpesa', cryptoCurrency: 'bitcoin', processing: false, showMpesaSuccess: false }" x-cloak>
    <!-- Animated Header -->
    <div class="py-12 text-center text-white transition-all duration-500 transform" x-transition:enter="scale-100"
        x-transition:leave="scale-90">
        <div class="container px-4 mx-auto">
            <div class="inline-block mb-8 animate-pulse">
                <div class="flex items-center justify-center w-32 h-32 mx-auto text-4xl rounded-full shadow-2xl bg-gradient-to-r from-yellow-400 to-red-500">
                    ⛪
                </div>
            </div>
            <h1 class="mb-4 text-4xl font-bold">Support Our Ministry</h1>
            <p class="text-xl opacity-90">"Give, and it will be given to you..." - Luke 6:38</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container max-w-4xl px-4 mx-auto">
        <!-- Payment Tabs -->
        <div class="p-8 mb-12 bg-white shadow-2xl rounded-2xl">
            <!-- Tab Buttons -->
            <div class="flex flex-wrap gap-2 mb-8">
                <button @click="activeTab = 'mpesa'"
                    :class="{'bg-[#008000] hover:bg-[#15803d] text-white shadow-lg': activeTab === 'mpesa', 'bg-gray-100 text-gray-600': activeTab !== 'mpesa'}"
                    class="flex-1 min-w-[100px] px-3 sm:px-6 py-2 sm:py-3 rounded-xl font-semibold transition-all transform hover:scale-105 text-sm sm:text-base">
                    M-Pesa
                </button>
                <button @click="activeTab = 'bank'"
                    :class="{'bg-[#008000] hover:bg-[#15803d] text-white shadow-lg': activeTab === 'bank', 'bg-gray-100 text-gray-600': activeTab !== 'bank'}"
                    class="flex-1 min-w-[100px] px-3 sm:px-6 py-2 sm:py-3 rounded-xl font-semibold transition-all transform hover:scale-105 text-sm sm:text-base">
                    Bank
                </button>
                <button @click="activeTab = 'crypto'"
                    :class="{'bg-[#008000] hover:bg-[#15803d] text-white shadow-lg': activeTab === 'crypto', 'bg-gray-100 text-gray-600': activeTab !== 'crypto'}"
                    class="flex-1 min-w-[100px] px-3 sm:px-6 py-2 sm:py-3 rounded-xl font-semibold transition-all transform hover:scale-105 text-sm sm:text-base">
                    Crypto
                </button>
            </div>

            <!-- Tab Contents -->
            <div>
                <!-- M-Pesa Tab -->
                <div x-show="activeTab === 'mpesa'" x-transition>
                    <div class="space-y-6">
                        <div class="relative p-6 overflow-hidden bg-blue-50 rounded-xl">
                            <div x-show="processing"
                                class="absolute inset-0 flex items-center justify-center bg-white bg-opacity-80">
                                <div
                                    class="w-12 h-12 border-4 border-blue-500 rounded-full animate-spin border-t-transparent">
                                </div>
                            </div>

                            <form
                                @submit.prevent="processing = true; setTimeout(() => { processing = false; showMpesaSuccess = true; }, 2000)">
                                <div class="space-y-4">
                                    <div>
                                        <label class="block mb-2 text-gray-700">Phone Number</label>
                                        <input type="tel"
                                            class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500"
                                            placeholder="07XX XXX XXX" pattern="[0-9]{10}">
                                    </div>
                                    <div>
                                        <label class="block mb-2 text-gray-700">Amount (KES)</label>
                                        <input type="number"
                                            class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500"
                                            min="100" value="1000">
                                    </div>
                                    <button type="submit" class="flex items-center justify-center w-full gap-2 py-3 text-white transition-all bg-green-600 rounded-lg hover:bg-green-700">
                                        <span x-show="!processing">Send via M-Pesa</span>
                                        <span x-show="processing">Processing...</span>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Success Message -->
                        <div x-show="showMpesaSuccess" x-transition class="p-4 text-green-800 bg-green-100 rounded-lg">
                            ✅ Donation received! Thank you for your generosity.
                        </div>
                    </div>
                </div>

                <!-- Bank Tab -->
                <div x-show="activeTab === 'bank'" x-transition>
                    <div class="p-6 space-y-4 bg-purple-50 rounded-xl">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="p-4 bg-white rounded-lg">
                                <label class="text-gray-600">Bank Name</label>
                                <p class="font-bold">Equity Bank</p>
                            </div>
                            <div class="p-4 bg-white rounded-lg">
                                <label class="text-gray-600">Account Number</label>
                                <p class="font-bold">1234567890</p>
                            </div>
                            <div class="col-span-2 p-4 bg-white rounded-lg">
                                <label class="text-gray-600">Account Name</label>
                                <p class="font-bold">Christ Is the Way Ministries</p>
                            </div>
                        </div>
                        <button @click="$dispatch('copied', {message: 'Bank details copied to clipboard!'})"
                            class="w-full py-3 text-white transition-all bg-purple-600 rounded-lg hover:bg-purple-700">
                            Copy Bank Details
                        </button>
                    </div>
                </div>

                <!-- Crypto Tab -->
                <div x-show="activeTab === 'crypto'" x-transition>
                    <div class="p-6 space-y-6 bg-orange-50 rounded-xl">
                        <div class="grid grid-cols-2 gap-4">
                            <button @click="cryptoCurrency = 'bitcoin'"
                                :class="cryptoCurrency === 'bitcoin' ? 'bg-orange-600 text-white' : 'bg-white'"
                                class="p-4 transition-all rounded-lg">
                                Bitcoin
                            </button>
                            <button @click="cryptoCurrency = 'ethereum'"
                                :class="cryptoCurrency === 'ethereum' ? 'bg-[#008000] hover:bg-[#15803d] text-white' : 'bg-white'"
                                class="p-4 transition-all rounded-lg">
                                Ethereum
                            </button>
                        </div>

                        <div x-show="cryptoCurrency === 'bitcoin'" x-transition>
                            <div class="p-4 text-center bg-white rounded-lg">
                                <div class="w-48 h-48 mx-auto mb-4 bg-gray-200 rounded-lg animate-pulse"></div>
                                <p class="font-mono text-sm break-words">
                                    bc1qxy2kgdygjrsqtzq2n0yrf2493w83f5w4h4pg6
                                </p>
                                <button @click="$dispatch('copied', {message: 'Bitcoin address copied!'})"
                                    class="mt-4 text-orange-600 hover:text-orange-700">
                                    Copy Address
                                </button>
                            </div>
                        </div>

                        <div x-show="cryptoCurrency === 'ethereum'" x-transition>
                            <div class="p-4 text-center bg-white rounded-lg">
                                <div class="w-48 h-48 mx-auto mb-4 bg-gray-200 rounded-lg animate-pulse"></div>
                                <p class="font-mono text-sm break-words">
                                    0x3E8C7D7eD1234567890aBcDeFghIjKlMnOpQrSt
                                </p>
                                <button @click="$dispatch('copied', {message: 'Ethereum address copied!'})"
                                    class="mt-4 text-blue-600 hover:text-blue-700">
                                    Copy Address
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Animated Progress -->
        <div class="p-8 text-center bg-white shadow-2xl rounded-2xl">
            <h3 class="mb-4 text-2xl font-bold">Community Progress</h3>
            <div class="relative pt-1">
                <div class="flex h-4 mb-4 overflow-hidden text-xs bg-gray-200 rounded-full">
                    <div class="flex flex-col justify-center text-center text-white transition-all duration-1000 shadow-none whitespace-nowrap bg-gradient-to-r from-blue-400 to-purple-600"
                        style="width: 65%"></div>
                </div>
                <p class="text-xl font-bold text-blue-900">
                    Raised: KES 650,000 / 1,000,000
                </p>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div x-data="{ show: false, message: '' }"
        @copied.window="show = true; message = $event.detail.message; setTimeout(() => show = false, 2000)"
        class="fixed bottom-4 right-4">
        <div x-show="show" x-transition class="px-6 py-3 text-white bg-green-500 rounded-lg shadow-lg">
            <span x-text="message"></span>
        </div>
    </div>
</div>
