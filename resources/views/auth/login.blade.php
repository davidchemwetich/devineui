<x-guest-layout>
    <div class="space-y-6">
        <!-- Header -->
        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Welcome Back</h2>
            <p class="text-gray-600">Sign in to your account to continue</p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg text-sm">
            {{ session('status') }}
        </div>
        @endif

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

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
                <input id="password" name="password" type="password" autocomplete="current-password" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#000fff] focus:border-[#000fff] transition-all duration-200 @error('password') border-red-500 focus:ring-red-500 focus:border-red-500 @enderror"
                    placeholder="Enter your password" />
                @error('password')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember_me" name="remember" type="checkbox"
                        class="w-4 h-4 text-[#000fff] bg-gray-100 border-gray-300 rounded focus:ring-[#000fff] focus:ring-2 transition-all duration-200" />
                    <label for="remember_me" class="ml-2 text-sm text-gray-700">
                        Remember me
                    </label>
                </div>

                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                    class="text-sm text-[#000fff] hover:text-blue-800 font-medium transition-colors duration-200">
                    Forgot password?
                </a>
                @endif
            </div>

            <!-- Sign In Button -->
            <button type="submit"
                class="w-full bg-[#000fff] text-white py-3 px-4 rounded-lg font-semibold shadow-lg hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-[#000fff] focus:ring-offset-2 transform hover:scale-[1.02] transition-all duration-200 active:scale-[0.98]">
                Sign In
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

            <!-- Register Link -->
            <div class="text-center">
                <p class="text-sm text-gray-600">
                    Don't have an account?
                    <a href="{{ route('register') }}"
                        class="text-[#000fff] hover:text-blue-800 font-semibold transition-colors duration-200">
                        Create one here
                    </a>
                </p>
            </div>
        </form>
    </div>
</x-guest-layout>
