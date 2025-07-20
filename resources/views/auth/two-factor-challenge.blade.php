<x-guest-layout>
    <div class="space-y-6" x-data="{ recovery: false }">
        <!-- Header -->
        <div class="text-center">
            <div class="w-16 h-16 mx-auto bg-indigo-100 rounded-full flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Two-Factor Authentication</h2>
            <p class="text-gray-600" x-show="!recovery">
                Please enter the 6-digit code from your authenticator app to complete your sign-in.
            </p>
            <p class="text-gray-600" x-show="recovery" x-cloak>
                Please enter one of your recovery codes to complete your sign-in.
            </p>
        </div>

        <!-- Two-Factor Challenge Form -->
        <form method="POST" action="{{ route('two-factor.login') }}" class="space-y-6">
            @csrf

            <!-- Authentication Code Input -->
            <div x-show="!recovery">
                <label for="code" class="block text-sm font-semibold text-gray-700 mb-2">
                    Authentication Code
                </label>
                <input id="code" name="code" type="text" inputmode="numeric" autocomplete="one-time-code" autofocus
                    x-ref="code"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#000fff] focus:border-[#000fff] transition-all duration-200 text-center text-2xl font-mono tracking-wider @error('code') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                    placeholder="000000" maxlength="6" />
                @error('code')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-2 text-sm text-gray-500 text-center">
                    Enter the 6-digit code from your authenticator app
                </p>
            </div>

            <!-- Recovery Code Input -->
            <div x-show="recovery" x-cloak>
                <label for="recovery_code" class="block text-sm font-semibold text-gray-700 mb-2">
                    Recovery Code
                </label>
                <input id="recovery_code" name="recovery_code" type="text" autocomplete="one-time-code"
                    x-ref="recovery_code"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#000fff] focus:border-[#000fff] transition-all duration-200 text-center font-mono tracking-wider @error('recovery_code') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                    placeholder="Enter recovery code" />
                @error('recovery_code')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-2 text-sm text-gray-500 text-center">
                    Use one of your saved recovery codes
                </p>
            </div>

            <!-- Security Notice -->
            <div class="bg-amber-50 border border-amber-200 rounded-lg p-4">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-amber-600 mt-0.5 mr-3 flex-shrink-0" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                    <div>
                        <h3 class="text-sm font-medium text-amber-800">Security Verification</h3>
                        <p class="text-sm text-amber-700 mt-1">
                            This extra step helps protect your account from unauthorized access.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Verify Button -->
            <button type="submit"
                class="w-full bg-[#000fff] text-white py-3 px-4 rounded-lg font-semibold shadow-lg hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-[#000fff] focus:ring-offset-2 transform hover:scale-[1.02] transition-all duration-200 active:scale-[0.98]">
                <span x-show="!recovery">Verify Code</span>
                <span x-show="recovery" x-cloak>Use Recovery Code</span>
            </button>

            <!-- Recovery Code Toggle -->
            <div class="text-center">
                <button type="button"
                    class="text-sm text-[#000fff] hover:text-blue-800 font-medium transition-colors duration-200"
                    x-show="!recovery" x-on:click="recovery = true; $nextTick(() => $refs.recovery_code.focus())">
                    Use a recovery code instead
                </button>

                <button type="button"
                    class="text-sm text-[#000fff] hover:text-blue-800 font-medium transition-colors duration-200"
                    x-show="recovery" x-cloak x-on:click="recovery = false; $nextTick(() => $refs.code.focus())">
                    Use authentication code instead
                </button>
            </div>

            <!-- Divider -->
            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-gray-500">having trouble?</span>
                </div>
            </div>

            <!-- Help Links -->
            <div class="text-center space-y-2">
                <p class="text-sm text-gray-600">
                    Lost your device?
                    <a href="#" class="text-[#000fff] hover:text-blue-800 font-medium transition-colors duration-200">
                        Contact support
                    </a>
                </p>
                <p class="text-sm text-gray-600">
                    <a href="{{ route('login') }}"
                        class="text-[#000fff] hover:text-blue-800 font-medium transition-colors duration-200">
                        ← Back to login
                    </a>
                </p>
            </div>
        </form>
    </div>

    <!-- Auto-focus and input formatting for authentication code -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const codeInput = document.getElementById('code');
            if (codeInput) {
                // Auto-format the code input
                codeInput.addEventListener('input', function(e) {
                    // Remove non-numeric characters
                    let value = e.target.value.replace(/\D/g, '');
                    // Limit to 6 digits
                    if (value.length > 6) {
                        value = value.substring(0, 6);
                    }
                    e.target.value = value;
                });

                // Auto-submit when 6 digits are entered
                codeInput.addEventListener('input', function(e) {
                    if (e.target.value.length === 6) {
                        // Small delay to ensure user can see the complete code
                        setTimeout(() => {
                            e.target.closest('form').submit();
                        }, 300);
                    }
                });
            }
        });
    </script>
</x-guest-layout>
