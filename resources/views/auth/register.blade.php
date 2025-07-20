<x-guest-layout>

    <div class="space-y-6">
        <!-- Header -->
        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Join Our Community</h2>
            <p class="text-gray-600">Create your account to get started</p>
        </div>

        <!-- Registration Form -->
        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                    Full Name
                </label>
                <input id="name" name="name" type="text" autocomplete="name" required value="{{ old('name') }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#000fff] focus:border-[#000fff] transition-all duration-200 @error('name') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                    placeholder="Enter your full name" />
                @error('name')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                    Email Address
                </label>
                <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#000fff] focus:border-[#000fff] transition-all duration-200 @error('email') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                    placeholder="Enter your email address" />
                @error('email')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                    Password
                </label>
                <input id="password" name="password" type="password" autocomplete="new-password" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#000fff] focus:border-[#000fff] transition-all duration-200 @error('password') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                    placeholder="Choose a strong password" />
                @error('password')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                    Confirm Password
                </label>
                <input id="password_confirmation" name="password_confirmation" type="password"
                    autocomplete="new-password" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#000fff] focus:border-[#000fff] transition-all duration-200"
                    placeholder="Confirm your password" />
            </div>

            <!-- Terms of Service -->
            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
            <div class="flex items-start">
                <div class="flex items-center h-5">
                    <input id="terms" name="terms" type="checkbox" required
                        class="w-4 h-4 text-[#000fff] bg-gray-100 border-gray-300 rounded focus:ring-[#000fff] focus:ring-2 transition-all duration-200" />
                </div>
                <div class="ml-3 text-sm">
                    <label for="terms" class="text-gray-700">
                        I agree to the
                        <a href="{{ route('terms.show') }}"
                            class="text-[#000fff] hover:text-blue-800 font-medium transition-colors duration-200">
                            Terms of Service
                        </a>
                        and
                        <a href="{{ route('policy.show') }}"
                            class="text-[#000fff] hover:text-blue-800 font-medium transition-colors duration-200">
                            Privacy Policy
                        </a>
                    </label>
                </div>
            </div>
            @endif

            <!-- Register Button -->
            <button type="submit"
                class="w-full bg-[#000fff] text-white py-3 px-4 rounded-lg font-semibold shadow-lg hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-[#000fff] focus:ring-offset-2 transform hover:scale-[1.02] transition-all duration-200 active:scale-[0.98]">
                Create Account
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

            <!-- Login Link -->
            <div class="text-center">
                <p class="text-sm text-gray-600">
                    Already have an account?
                    <a href="{{ route('login') }}"
                        class="text-[#000fff] hover:text-blue-800 font-semibold transition-colors duration-200">
                        Sign in here
                    </a>
                </p>
            </div>
        </form>
    </div>
</x-guest-layout>
