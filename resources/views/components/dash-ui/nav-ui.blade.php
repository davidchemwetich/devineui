<nav
    class="flex-1 px-3 py-4 space-y-1 overflow-y-auto text-gray-700 border-r border-gray-200 dark:text-gray-200 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-900 dark:border-gray-700">
    <!-- Dashboard -->
    <a href="{{ route(config('app.admin_prefix') . '.dashboard') }}"
        x-bind:class="activeMenu === 'dashboard' ? 'sidebar-link active' : 'sidebar-link'"
        @click="activeMenu = 'dashboard'; sidebarOpen = false"
        class="group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 hover:bg-white hover:shadow-sm dark:hover:bg-gray-800 border border-transparent hover:border-gray-200 dark:hover:border-gray-600">
        <div
            class="flex items-center justify-center w-8 h-8 transition-all duration-200 rounded-lg bg-gradient-to-br from-blue-500 to-blue-600 group-hover:from-blue-600 group-hover:to-blue-700">
            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
            </svg>
        </div>
        <span class="ml-2.5 font-medium">Dashboard</span>
    </a>

    {{-- Ministries & Departments --}}
    <div x-data="{ schoolOpen: false }" class="space-y-1">
        <button @click="schoolOpen = !schoolOpen"
            class="group flex items-center justify-between w-full px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 hover:bg-white hover:shadow-sm dark:hover:bg-gray-800 border border-transparent hover:border-gray-200 dark:hover:border-gray-600">
            <div class="flex items-center">
                <div
                    class="flex items-center justify-center w-8 h-8 transition-all duration-200 rounded-lg bg-gradient-to-br from-orange-500 to-orange-600 group-hover:from-orange-600 group-hover:to-orange-700">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                        </path>
                    </svg>
                </div>
                <span class="ml-2.5 font-medium">Ministries&Events</span>
            </div>
            <svg :class="schoolOpen ? 'rotate-180' : ''" class="w-4 h-4 transition-transform duration-300" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>

        <div x-show="schoolOpen" x-collapse class="pl-3 ml-6 space-y-1 border-l border-gray-200 dark:border-gray-600">
            <a href="{{ route(config('app.admin_prefix') . '.ministry.index') }}"
                x-bind:class="activeMenu === 'courses' ? 'text-orange-600 dark:text-orange-400 font-semibold' : 'text-gray-600 dark:text-gray-300'"
                @click="activeMenu = 'courses'; sidebarOpen = false"
                class="block px-3 py-1.5 text-sm rounded hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                Manage Ministries
            </a>
            <a href="{{ route(config('app.admin_prefix') . '.ministry.create') }}"
                x-bind:class="activeMenu === 'intakes' ? 'text-orange-600 dark:text-orange-400 font-semibold' : 'text-gray-600 dark:text-gray-300'"
                @click="activeMenu = 'intakes'; sidebarOpen = false"
                class="block px-3 py-1.5 text-sm rounded hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                Create Ministries
            </a>
            <a href="{{ route(config('app.admin_prefix', 'shield') . '.church.service-schedule-settings') }}"
                x-bind:class="activeMenu === 'departments' ? 'text-orange-600 dark:text-orange-400 font-semibold' : 'text-gray-600 dark:text-gray-300'"
                @click="activeMenu = 'departments'; sidebarOpen = false"
                class="block px-3 py-1.5 text-sm rounded hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                Church Programs
            </a>
            <a href="{{ route(config('app.admin_prefix') . '.ministry.events.index') }}"
                x-bind:class="activeMenu === 'departments' ? 'text-orange-600 dark:text-orange-400 font-semibold' : 'text-gray-600 dark:text-gray-300'"
                @click="activeMenu = 'departments'; sidebarOpen = false"
                class="block px-3 py-1.5 text-sm rounded hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                Manage Events
            </a>
            <a href="{{ route(config('app.admin_prefix') . '.ministry.events.create') }}"
                x-bind:class="activeMenu === 'departments' ? 'text-orange-600 dark:text-orange-400 font-semibold' : 'text-gray-600 dark:text-gray-300'"
                @click="activeMenu = 'departments'; sidebarOpen = false"
                class="block px-3 py-1.5 text-sm rounded hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                Create Events
            </a>
            <a href="{{ route(config('app.admin_prefix') . '.churches.shield.churches') }}"
                x-bind:class="activeMenu === 'departments' ? 'text-orange-600 dark:text-orange-400 font-semibold' : 'text-gray-600 dark:text-gray-300'"
                @click="activeMenu = 'departments'; sidebarOpen = false"
                class="block px-3 py-1.5 text-sm rounded hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                Manage Churches
            </a>
        </div>
    </div>
    <!-- Team & Staff Management Dropdown -->
    <div x-data="{ analyticsOpen: false }" class="space-y-1">
        <button @click="analyticsOpen = !analyticsOpen"
            class="group flex items-center justify-between w-full px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 hover:bg-white hover:shadow-sm dark:hover:bg-gray-800 border border-transparent hover:border-gray-200 dark:hover:border-gray-600">
            <div class="flex items-center">
                <div
                    class="flex items-center justify-center w-8 h-8 transition-all duration-200 rounded-lg bg-gradient-to-br from-pink-500 to-pink-600 group-hover:from-pink-600 group-hover:to-pink-700">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 00-2-2z">
                        </path>
                    </svg>
                </div>
                <span class="ml-2.5 font-medium">T&S Management</span>
            </div>
            <svg :class="analyticsOpen ? 'rotate-180' : ''" class="w-4 h-4 transition-transform duration-300"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>

        <div x-show="analyticsOpen" x-collapse
            class="pl-3 ml-6 space-y-1 border-l border-gray-200 dark:border-gray-600">
            <a href="{{ route(config('app.admin_prefix') . '.team-members.team-members') }}"
                x-bind:class="activeMenu === 'analytics.overview' ? 'text-pink-600 dark:text-pink-400 font-medium' : 'text-gray-500 dark:text-gray-400'"
                @click="activeMenu = 'analytics.overview'; sidebarOpen = false"
                class="block px-3 py-1.5 text-sm rounded hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                Team & Staff
            </a>
            <a href="{{ route(config('app.admin_prefix') . '.team-members.team-members.order') }}"
                x-bind:class="activeMenu === 'analytics.traffic' ? 'text-pink-600 dark:text-pink-400 font-medium' : 'text-gray-500 dark:text-gray-400'"
                @click="activeMenu = 'analytics.traffic'; sidebarOpen = false"
                class="block px-3 py-1.5 text-sm rounded hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                Order Team & Staff
            </a>
            <a href="{{ route(config('app.admin_prefix') . '.team-members.shield.church.team-categories') }}"
                x-bind:class="activeMenu === 'analytics.performance' ? 'text-pink-600 dark:text-pink-400 font-medium' : 'text-gray-500 dark:text-gray-400'"
                @click="activeMenu = 'analytics.performance'; sidebarOpen = false"
                class="block px-3 py-1.5 text-sm rounded hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                Team & Staff Categories
            </a>
        </div>
    </div>

    <!-- Contact Messages -->
    <a href="{{ route(config('app.admin_prefix') . '.contact.messages') }}"
        x-bind:class="activeMenu.startsWith('users') ? 'sidebar-link active' : 'sidebar-link'"
        @click="activeMenu = 'users.index'; sidebarOpen = false"
        class="group flex items-center justify-between px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 hover:bg-white hover:shadow-sm dark:hover:bg-gray-800 border border-transparent hover:border-gray-200 dark:hover:border-gray-600">
        <div class="flex items-center">
            <div
                class="flex items-center justify-center w-8 h-8 transition-all duration-200 rounded-lg bg-gradient-to-br from-purple-500 to-purple-600 group-hover:from-purple-600 group-hover:to-purple-700">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                    </path>
                </svg>
            </div>
            <span class="ml-2.5 font-medium">Contact Messages</span>
        </div>
        <span
            class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 dark:from-blue-900 dark:to-blue-800 dark:text-blue-100">
            {{ App\Models\ContactMessage::count() }}
        </span>
    </a>
    <!-- Management Section -->
    <div x-data="{ schoolOpen: false }" class="space-y-1">
        <button @click="schoolOpen = !schoolOpen"
            class="group flex items-center justify-between w-full px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 hover:bg-white hover:shadow-sm dark:hover:bg-gray-800 border border-transparent hover:border-gray-200 dark:hover:border-gray-600">
            <div class="flex items-center">
                <div
                    class="flex items-center justify-center w-8 h-8 transition-all duration-200 rounded-lg bg-gradient-to-br from-orange-500 to-orange-600 group-hover:from-orange-600 group-hover:to-orange-700">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                        </path>
                    </svg>
                </div>
                <span class="ml-2.5 font-medium">Sermon Library</span>
            </div>
            <svg :class="schoolOpen ? 'rotate-180' : ''" class="w-4 h-4 transition-transform duration-300" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>

        <div x-show="schoolOpen" x-collapse class="pl-3 ml-6 space-y-1 border-l border-gray-200 dark:border-gray-600">
            <a href="{{ route(config('app.admin_prefix') . '.church.sermons.index') }}"
                x-bind:class="activeMenu === 'courses' ? 'text-orange-600 dark:text-orange-400 font-semibold' : 'text-gray-600 dark:text-gray-300'"
                @click="activeMenu = 'courses'; sidebarOpen = false"
                class="block px-3 py-1.5 text-sm rounded hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                Manage Sermons
            </a>
            <a href="{{ route(config('app.admin_prefix') . '.church.regions') }}"
                x-bind:class="activeMenu === 'intakes' ? 'text-orange-600 dark:text-orange-400 font-semibold' : 'text-gray-600 dark:text-gray-300'"
                @click="activeMenu = 'intakes'; sidebarOpen = false"
                class="block px-3 py-1.5 text-sm rounded hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                Manage Regions
            </a>
            <a href="{{ route(config('app.admin_prefix') . '.church.clusters') }}"
                x-bind:class="activeMenu === 'departments' ? 'text-orange-600 dark:text-orange-400 font-semibold' : 'text-gray-600 dark:text-gray-300'"
                @click="activeMenu = 'departments'; sidebarOpen = false"
                class="block px-3 py-1.5 text-sm rounded hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                Manage Clusters
            </a>
        </div>
    </div>
    <!-- Content dropdown Dropdown -->
    <div x-data="{ analyticsOpen: false }" class="space-y-1">
        <button @click="analyticsOpen = !analyticsOpen"
            class="group flex items-center justify-between w-full px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 hover:bg-white hover:shadow-sm dark:hover:bg-gray-800 border border-transparent hover:border-gray-200 dark:hover:border-gray-600">
            <div class="flex items-center">
                <div
                    class="flex items-center justify-center w-8 h-8 transition-all duration-200 rounded-lg bg-gradient-to-br from-pink-500 to-pink-600 group-hover:from-pink-600 group-hover:to-pink-700">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 00-2-2z">
                        </path>
                    </svg>
                </div>
                <span class="ml-2.5 font-medium">Content&Media</span>
            </div>
            <svg :class="analyticsOpen ? 'rotate-180' : ''" class="w-4 h-4 transition-transform duration-300"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>

        <div x-show="analyticsOpen" x-collapse
            class="pl-3 ml-6 space-y-1 border-l border-gray-200 dark:border-gray-600">
            <a href="{{ route(config('app.admin_prefix') . '.articles.index') }}"
                x-bind:class="activeMenu === 'analytics.overview' ? 'text-pink-600 dark:text-pink-400 font-medium' : 'text-gray-500 dark:text-gray-400'"
                @click="activeMenu = 'analytics.overview'; sidebarOpen = false"
                class="block px-3 py-1.5 text-sm rounded hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                Article Management
            </a>
            <a href="{{ route(config('app.admin_prefix') . '.categories.index') }}"
                x-bind:class="activeMenu === 'analytics.traffic' ? 'text-pink-600 dark:text-pink-400 font-medium' : 'text-gray-500 dark:text-gray-400'"
                @click="activeMenu = 'analytics.traffic'; sidebarOpen = false"
                class="block px-3 py-1.5 text-sm rounded hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                Manage Categories
            </a>
            <a href="{{ route(config('app.admin_prefix') . '.settings.announcements') }}"
                x-bind:class="activeMenu === 'analytics.performance' ? 'text-pink-600 dark:text-pink-400 font-medium' : 'text-gray-500 dark:text-gray-400'"
                @click="activeMenu = 'analytics.performance'; sidebarOpen = false"
                class="block px-3 py-1.5 text-sm rounded hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                Create Announcement
            </a>
        </div>
    </div>

    <!-- Administration Dropdown -->
    <div x-data="{ adminOpen: false }" class="space-y-1">
        <button @click="adminOpen = !adminOpen"
            class="group flex items-center justify-between w-full px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 hover:bg-white hover:shadow-sm dark:hover:bg-gray-800 border border-transparent hover:border-gray-200 dark:hover:border-gray-600">
            <div class="flex items-center">
                <div
                    class="flex items-center justify-center w-8 h-8 transition-all duration-200 rounded-lg bg-gradient-to-br from-slate-500 to-slate-600 group-hover:from-slate-600 group-hover:to-slate-700">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <span class="ml-2.5 font-medium">Administration</span>
            </div>
            <svg :class="adminOpen ? 'rotate-180' : ''" class="w-4 h-4 transition-transform duration-300" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>

        <div x-show="adminOpen" x-collapse class="pl-3 ml-6 space-y-1 border-l border-gray-200 dark:border-gray-600">
            <a href=""
                x-bind:class="activeMenu.startsWith('admin.users') ? 'text-slate-600 dark:text-slate-300 font-medium' : 'text-gray-500 dark:text-gray-400'"
                @click="activeMenu = 'admin.users'; sidebarOpen = false"
                class="flex items-center justify-between px-3 py-1.5 text-sm rounded hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                <span>Users</span>
                <span
                    class="inline-flex items-center px-1.5 py-0.5 rounded-full text-xs font-medium bg-gradient-to-r from-slate-100 to-slate-200 text-slate-800 dark:from-slate-900 dark:to-slate-800 dark:text-slate-100">
                    {{ App\Models\User::count() }}
                </span>
            </a>
            <a href=""
                x-bind:class="activeMenu.startsWith('roles') ? 'text-slate-600 dark:text-slate-300 font-medium' : 'text-gray-500 dark:text-gray-400'"
                @click="activeMenu = 'roles.index'; sidebarOpen = false"
                class="block px-3 py-1.5 text-sm rounded hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                User Roles
            </a>
            <a href=""
                x-bind:class="activeMenu.startsWith('permissions') ? 'text-slate-600 dark:text-slate-300 font-medium' : 'text-gray-500 dark:text-gray-400'"
                @click="activeMenu = 'permissions.index'; sidebarOpen = false"
                class="block px-3 py-1.5 text-sm rounded hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                Permissions
            </a>
            <a href=""
                x-bind:class="activeMenu.startsWith('role.assignment') ? 'text-slate-600 dark:text-slate-300 font-medium' : 'text-gray-500 dark:text-gray-400'"
                @click="activeMenu = 'role.assignment'; sidebarOpen = false"
                class="block px-3 py-1.5 text-sm rounded hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                Role Assignment
            </a>
        </div>
    </div>

    <!-- App Settings Dropdown -->
    <div x-data="{ settingsOpen: false }" class="space-y-1">
        <button @click="settingsOpen = !settingsOpen"
            class="group flex items-center justify-between w-full px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200 hover:bg-white hover:shadow-sm dark:hover:bg-gray-800 border border-transparent hover:border-gray-200 dark:hover:border-gray-600">
            <div class="flex items-center">
                <div
                    class="flex items-center justify-center w-8 h-8 transition-all duration-200 rounded-lg bg-gradient-to-br from-gray-500 to-gray-600 group-hover:from-gray-600 group-hover:to-gray-700">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                        </path>
                    </svg>
                </div>
                <span class="ml-2.5 font-medium">System Settings</span>
            </div>
            <svg :class="settingsOpen ? 'rotate-180' : ''" class="w-4 h-4 transition-transform duration-300" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>

        <div x-show="settingsOpen" x-collapse class="pl-3 ml-6 space-y-1 border-l border-gray-200 dark:border-gray-600">
            <a href=""
                x-bind:class="activeMenu === 'staff.profiles' ? 'text-gray-700 dark:text-gray-300 font-medium' : 'text-gray-500 dark:text-gray-400'"
                @click="activeMenu = 'staff.profiles'; sidebarOpen = false"
                class="block px-3 py-1.5 text-sm rounded hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                Staff Profiles
            </a>
            <a href="{{ route(config('app.admin_prefix', 'shield') . '.settings.about') }}"
                x-bind:class="activeMenu === 'settings.index' ? 'text-gray-700 dark:text-gray-300 font-medium' : 'text-gray-500 dark:text-gray-400'"
                @click="activeMenu = 'settings.index'; sidebarOpen = false"
                class="block px-3 py-1.5 text-sm rounded hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                About Settings
            </a>
            <a href="{{ route(config('app.admin_prefix', 'shield') . '.settings.general') }}"
                x-bind:class="activeMenu === 'settings.index' ? 'text-gray-700 dark:text-gray-300 font-medium' : 'text-gray-500 dark:text-gray-400'"
                @click="activeMenu = 'settings.index'; sidebarOpen = false"
                class="block px-3 py-1.5 text-sm rounded hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                General Settings
            </a>
        </div>
    </div>
</nav>

<style>
    .sidebar-link {
        @apply flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200;
    }

    .sidebar-link.active {
        @apply bg-gradient-to-r from-blue-500 to-blue-600 text-white shadow-md;
    }

    .sidebar-link:hover:not(.active) {
        @apply bg-gray-50 dark: bg-gray-800;
    }

    /* Custom scrollbar */
    nav::-webkit-scrollbar {
        width: 5px;
    }

    nav::-webkit-scrollbar-track {
        @apply bg-transparent;
    }

    nav::-webkit-scrollbar-thumb {
        @apply bg-gray-300 dark: bg-gray-600 rounded-full;
    }

    /* Smooth dropdown transitions */
    [x-cloak] {
        display: none !important;
    }

    /* Icon hover effect */
    .group:hover .bg-gradient-to-br {
        transform: scale(1.05);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
</style>
