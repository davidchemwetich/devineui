<x-shield-layout>
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6 flex justify-between items-center">
                <div>
                    <p class="mt-1 text-sm text-gray-500">Welcome back, {{ Auth::user()->name }}!</p>
                    <p class="mt-1 text-xs text-gray-400">Current Version: <span class="font-semibold">1.1-beta</span>
                    </p>
                </div>
                <a href="https://netops.ink/sales" target="_blank"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700 transition">
                    <!-- Green Spinning Refresh Icon -->
                    <svg class="w-5 h-5 mr-2 text-white animate-spin-slow" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4 4v5h.582m15.21 4A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.001 8.001 0 01-15.21-4" />
                    </svg>
                    Check for Updates
                </a>
            </div>
        </div>

        <!-- Add this to your CSS or Tailwind config if needed -->
        <style>
            .animate-spin-slow {
                animation: spin 2s linear infinite;
            }
        </style>


        <!-- Stats Cards -->
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
            <livewire:shield.stats-card title="Total Users" :value="App\Models\User::count()" icon="users"
                color="blue" />

            <livewire:shield.stats-card title="Admin Users" :value="App\Models\User::role('admin')->count()"
                icon="shield" color="green" />

            <livewire:shield.stats-card title="Support Users" :value="App\Models\User::role('support')->count()"
                icon="headphones" color="yellow" />

            <livewire:shield.stats-card title="Regular Users" :value="App\Models\User::role('user')->count()"
                icon="user" color="purple" />
        </div>

        <!-- Recent Activity -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Recent Activity</h3>
                <livewire:shield.recent-activity />
            </div>
        </div>

        <!-- User Management -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">User Management</h3>
                    <button
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        Add User
                    </button>
                </div>
                <livewire:shield.user-table />
            </div>
        </div>
    </div>
</x-shield-layout>