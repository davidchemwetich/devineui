<x-guest-layout>
    <div class="space-y-6">
        <!-- Header -->
        <div class="text-center">
            <div class="w-16 h-16 mx-auto bg-amber-100 rounded-full flex items-center justify-center mb-4">
                <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Confirm Password</h2>
            <p class="text-gray-600">Please confirm your password before continuing. This helps keep your account
                secure.</p>
        </div>

        <!-- Confirm Password Form -->
        <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
            @csrf

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                    Current Password
                </label>
                <input id="password" name="password" type="password" autocomplete="current-password" required autofocus
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#000fff] focus:border-[#000fff] transition-all duration-200 @error('password') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                    placeholder="Enter your current password" />
                @error('password')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Security Notice -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-3 flex-shrink-0" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                            clip-rule="evenodd" />
                    </svg>
                    <div>
                        <h3 class="text-sm font-medium text-blue-800">Security Confirmation</h3>
                        <p class="text-sm text-blue-700 mt-1">
                            We need to verify your identity before accessing sensitive areas of your account.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Confirm Button -->
            <button type="submit"
                class="w-full bg-[#000fff] text-white py-3 px-4 rounded-lg font-semibold shadow-lg hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-[#000fff] focus:ring-offset-2 transform hover:scale-[1.02] transition-all duration-200 active:scale-[0.98]">
                Confirm Password
            </button>

            <!-- Divider -->
            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-gray-500">or</span>
                </div>
            </div>

            <!-- Forgot Password Link -->
            <div class="text-center">
                <p class="text-sm text-gray-600">
                    Forgot your password?
                    <a href="{{ route('password.request') }}"
                        class="text-[#000fff] hover:text-blue-800 font-semibold transition-colors duration-200">
                        Reset it here
                    </a>
                </p>
            </div>
        </form>
    </div>
</x-guest-layout>
