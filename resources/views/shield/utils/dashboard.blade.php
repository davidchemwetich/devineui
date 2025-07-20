<x-shield-layout>
    <div class="space-y-6">
        <!-- Page Header -->
        <div class="bg-white shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <p class="mt-1 text-sm text-gray-500">Welcome back, {{ Auth::user()->name }}!</p>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
            <livewire:shield.stats-card 
                title="Total Users" 
                :value="App\Models\User::count()" 
                icon="users" 
                color="blue" />
            
            <livewire:shield.stats-card 
                title="Admin Users" 
                :value="App\Models\User::role('admin')->count()" 
                icon="shield" 
                color="green" />
            
            <livewire:shield.stats-card 
                title="Support Users" 
                :value="App\Models\User::role('support')->count()" 
                icon="headphones" 
                color="yellow" />
            
            <livewire:shield.stats-card 
                title="Regular Users" 
                :value="App\Models\User::role('user')->count()" 
                icon="user" 
                color="purple" />
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
                    <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        Add User
                    </button>
                </div>
                <livewire:shield.user-table />
            </div>
        </div>
    </div>
</x-shield-layout>