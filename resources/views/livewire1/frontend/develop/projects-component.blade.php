<div class="min-h-screen bg-gray-50">
    <!-- Hero Section -->
    <div class="relative text-white bg-[#008000]">
        <div class="relative px-4 py-24 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-extrabold tracking-tight sm:text-5xl lg:text-6xl">
                    Building Together in Faith
                </h1>
                <p class="max-w-xl mx-auto mt-6 text-xl">
                    Join us in developing our church community through these ongoing projects and initiatives
                </p>
                <div class="max-w-sm mx-auto mt-10 sm:max-w-none sm:flex sm:justify-center">
                    <div class="space-y-4 sm:space-y-0 sm:mx-auto sm:inline-grid sm:grid-cols-2 sm:gap-5">
                        <a href="#projects"
                            class="flex items-center justify-center px-4 py-3 text-base font-medium text-indigo-700 bg-white border border-transparent rounded-md shadow-sm hover:bg-indigo-50 sm:px-8">
                            View Projects
                        </a>
                        <a href="#donate"
                            class="flex items-center justify-center px-4 py-3 text-base font-medium text-white bg-[#000fff] border border-transparent rounded-md shadow-sm hover:bg-bg-[#000fff] sm:px-8">
                            Donate Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Projects -->
    <div class="px-4 py-16 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <h2 class="mb-12 text-3xl font-extrabold text-center text-gray-900">Featured Projects</h2>

        <div class="grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-3 xl:gap-x-8">
            @foreach($featuredProjects as $project)
            <div
                class="relative overflow-hidden transition-all duration-300 bg-white rounded-lg shadow-lg group hover:shadow-xl">
                <div class="w-full overflow-hidden bg-gray-200 h-60 aspect-w-1 aspect-h-1">
                    <img src="{{ asset('images/' . $project['image']) }}" alt="{{ $project['title'] }}"
                        class="object-cover w-full h-full group-hover:opacity-75">
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-lg font-bold text-gray-900">
                            <span>{{ $project['title'] }}</span>
                        </h3>
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                            {{ ucfirst($project['category']) }}
                        </span>
                    </div>

                    <div class="mt-4">
                        <div class="relative h-2 bg-gray-200 rounded-full">
                            <div class="absolute top-0 left-0 h-2 bg-[#000fff] rounded-full"
                                style="width: {{ min(100, ($project['raised'] / $project['goal']) * 100) }}%"></div>
                        </div>
                        <div class="flex justify-between mt-2 text-sm">
                            <span>ksh{{ number_format($project['raised']) }} raised</span>
                            <span>ksh{{ number_format($project['goal']) }} goal</span>
                        </div>
                    </div>

                    <div class="mt-4">
                        <p class="text-sm text-gray-500 line-clamp-3">{{ $project['description'] }}</p>
                    </div>

                    <div class="mt-6">
                        <a href="#project-{{ $project['id'] }}"
                            class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-[#000fff] border border-transparent rounded-md shadow-sm hover:bg-indigo-700">
                            Learn More
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Main Projects Section -->
    <div id="projects" class="px-4 py-12 mx-auto max-w-7xl sm:px-6 lg:py-16 lg:px-8">
        <div class="mb-12 lg:text-center">
            <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                Our Development Projects
            </h2>
            <p class="max-w-2xl mt-4 text-xl text-gray-500 lg:mx-auto">
                Through faith and community support, we're growing our ministry and expanding our reach.
            </p>
        </div>

        <!-- Search and Filter Bar -->
        <div class="p-4 mb-10 bg-white rounded-lg shadow">
            <div class="sm:flex sm:justify-between sm:items-center">
                <div class="flex-1 min-w-0">
                    <div class="relative max-w-md rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="text" wire:model.live.debounce.300ms="search"
                            class="block w-full py-2 pl-10 border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            placeholder="Search projects...">
                    </div>
                </div>
                <div class="mt-4 sm:mt-0">
                    <div class="flex py-1 space-x-2 overflow-x-auto">
                        <button wire:click="setActiveTab('all')"
                            class="px-3 py-2 text-sm font-medium rounded-md {{ $activeTab === 'all' ? 'bg-indigo-100 text-indigo-700' : 'text-gray-500 hover:text-gray-700' }}">
                            All
                        </button>
                        <button wire:click="setActiveTab('infrastructure')"
                            class="px-3 py-2 text-sm font-medium rounded-md {{ $activeTab === 'infrastructure' ? 'bg-indigo-100 text-indigo-700' : 'text-gray-500 hover:text-gray-700' }}">
                            Infrastructure
                        </button>
                        <button wire:click="setActiveTab('programs')"
                            class="px-3 py-2 text-sm font-medium rounded-md {{ $activeTab === 'programs' ? 'bg-indigo-100 text-indigo-700' : 'text-gray-500 hover:text-gray-700' }}">
                            Programs
                        </button>
                        <button wire:click="setActiveTab('outreach')"
                            class="px-3 py-2 text-sm font-medium rounded-md {{ $activeTab === 'outreach' ? 'bg-indigo-100 text-indigo-700' : 'text-gray-500 hover:text-gray-700' }}">
                            Outreach
                        </button>
                        <button wire:click="setActiveTab('worship')"
                            class="px-3 py-2 text-sm font-medium rounded-md {{ $activeTab === 'worship' ? 'bg-indigo-100 text-indigo-700' : 'text-gray-500 hover:text-gray-700' }}">
                            Worship
                        </button>
                        <button wire:click="setActiveTab('missions')"
                            class="px-3 py-2 text-sm font-medium rounded-md {{ $activeTab === 'missions' ? 'bg-indigo-100 text-indigo-700' : 'text-gray-500 hover:text-gray-700' }}">
                            Missions
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Project List -->
        <div class="space-y-6">
            @if(count($projects) > 0)
            @foreach($projects as $project)
            <div id="project-{{ $project['id'] }}" class="overflow-hidden bg-white shadow sm:rounded-lg">
                <div class="flex items-center justify-between px-4 py-5 cursor-pointer sm:px-6"
                    wire:click="toggleDetails({{ $project['id'] }})">
                    <div>
                        <h3 class="text-lg font-medium leading-6 text-gray-900">{{ $project['title'] }}</h3>
                        <p class="max-w-2xl mt-1 text-sm text-gray-500">
                            Goal: ksh{{ number_format($project['goal']) }} • Ends {{
                            \Carbon\Carbon::parse($project['end_date'])->format('M d, Y') }}
                        </p>
                    </div>
                    <div class="flex items-center">
                        <span
                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 mr-3">
                            {{ ucfirst($project['category']) }}
                        </span>
                        <span class="transition-transform transform"
                            :class="{'rotate-180': showDetails === {{ $project['id'] }}}">
                            <svg class="w-5 h-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                    </div>
                </div>

                <div x-data="{ open: @entangle('showDetails') === {{ $project['id'] }} }" x-show="open"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 transform -translate-y-2"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform -translate-y-2" class="border-t border-gray-200"
                    style="display: none;">
                    <div class="px-4 py-5 sm:flex sm:items-start sm:px-6">
                        <div class="mb-4 sm:w-2/5 md:w-1/3 sm:mb-0 sm:mr-4">
                            <img src="{{ asset('images/' . $project['image']) }}" alt="{{ $project['title'] }}"
                                class="object-cover w-full h-64 rounded-lg">

                            <div class="mt-6">
                                <div class="relative pt-1">
                                    <div class="flex items-center justify-between mb-2">
                                        <div>
                                            <span
                                                class="inline-block px-2 py-1 text-xs font-semibold text-indigo-600 uppercase bg-indigo-200 rounded-full">
                                                Fundraising Progress
                                            </span>
                                        </div>
                                        <div class="text-right">
                                            <span class="inline-block text-xs font-semibold text-indigo-600">
                                                {{ floor(($project['raised'] / $project['goal']) * 100) }}%
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex h-2 mb-4 overflow-hidden text-xs bg-indigo-200 rounded">
                                        <div style="width:{{ min(100, ($project['raised'] / $project['goal']) * 100) }}%"
                                            class="flex flex-col justify-center text-center text-white bg-[#000fff] shadow-none whitespace-nowrap">
                                        </div>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-sm font-medium text-gray-900">ksh{{
                                            number_format($project['raised']) }} raised</span>
                                        <span class="text-sm font-medium text-gray-500">of ksh{{
                                            number_format($project['goal']) }} goal</span>
                                    </div>
                                </div>

                                <div class="mt-6">
                                    <a href="#donate"
                                        class="flex items-center justify-center w-full px-8 py-3 text-base font-medium text-white bg-[#000fff] border border-transparent rounded-md hover:bg-indigo-700 md:py-4 md:text-lg md:px-10">
                                        Donate to This Project
                                    </a>
                                    <p class="mt-2 text-sm text-center text-gray-500">
                                        Project ID: {{ $project['id'] }} (Use as reference when donating)
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="sm:w-3/5 md:w-2/3">
                            <h4 class="mb-2 text-lg font-medium text-gray-900">About This Project</h4>
                            <p class="mb-6 text-gray-600">{{ $project['description'] }}</p>

                            @if(!empty($project['updates']))
                            <h4 class="mb-2 text-lg font-medium text-gray-900">Latest Updates</h4>
                            <div class="flow-root">
                                <ul class="-mb-8">
                                    @foreach($project['updates'] as $update)
                                    <li>
                                        <div class="relative pb-8">
                                            @if(!$loop->last)
                                            <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200"
                                                aria-hidden="true"></span>
                                            @endif
                                            <div class="relative flex space-x-3">
                                                <div>
                                                    <span
                                                        class="flex items-center justify-center w-8 h-8 bg-indigo-500 rounded-full ring-8 ring-white">
                                                        <svg class="w-5 h-5 text-white"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                            fill="currentColor">
                                                            <path fill-rule="evenodd"
                                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </span>
                                                </div>
                                                <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                                    <div>
                                                        <p class="text-sm text-gray-800">{{ $update['content'] }}</p>
                                                    </div>
                                                    <div class="text-sm text-right text-gray-500 whitespace-nowrap">
                                                        <time>{{ \Carbon\Carbon::parse($update['date'])->format('M d,
                                                            Y') }}</time>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div class="py-12 text-center bg-white rounded-lg shadow">
                <svg class="w-12 h-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No projects found</h3>
                <p class="mt-1 text-sm text-gray-500">Try adjusting your search or filter to find what you're looking
                    for.</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Donation Section -->
    <div id="donate" class="py-16 bg-[#008000]">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="mb-12 lg:text-center">
                <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                    Support Our Mission
                </h2>
                <p class="max-w-2xl mt-4 text-xl text-indigo-100 lg:mx-auto">
                    Your generous donations help us continue our work and grow our ministry.
                </p>
            </div>

            <div class="mt-10 overflow-hidden bg-white rounded-lg shadow-xl">
                <div class="px-4 py-5 sm:p-6">
                    <div x-data="{ amount: '50', customAmount: '', donationType: 'one-time' }">
                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-700">Projects
                            </label>
                            <div class="relative mt-1 rounded-md shadow-sm">
                                <select
                                    class="block w-full py-2 pl-3 pr-10 mt-1 text-base border-gray-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="">General Fund</option>
                                    @foreach($projects as $project)
                                    <option value="{{ $project['id'] }}">{{ $project['title'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="max-w-xl p-6 mx-auto my-8 bg-white rounded-lg shadow-md">
                            <h2 class="mb-4 text-2xl font-semibold text-center text-gray-800">Support Our Mission</h2>
                            <p class="mb-6 text-center text-gray-600">
                                Help us grow and reach more souls through your generous giving.
                            </p>

                            <div class="flex flex-col justify-center gap-4 sm:flex-row">
                                <!-- PayPal Button -->
                                <a href="https://www.paypal.com/donate?hosted_button_id=YOUR_BUTTON_ID" target="_blank"
                                    class="w-full px-6 py-3 text-center text-white transition duration-200 bg-[#000fff] rounded-lg hover:bg-blue-700 sm:w-auto">
                                    Donate via PayPal
                                </a>

                                <!-- M-Pesa Button -->
                                <a href="{{ route('donate') }}" target="_blank"
                                    class="w-full px-6 py-3 text-center text-white transition duration-200 bg-green-600 rounded-lg hover:bg-green-700 sm:w-auto">
                                    Donate via M-Pesa
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
</div>
