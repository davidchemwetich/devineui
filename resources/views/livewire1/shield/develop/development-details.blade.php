<div class="py-6">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <!-- Header with navigation and actions -->
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center space-x-2">
                <a href="{{ route('shield.development.index') }}"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-blue-700 bg-blue-100 border border-transparent rounded-md dark:text-blue-300 dark:bg-blue-900 hover:bg-blue-200 dark:hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Projects
                </a>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('shield.development.edit', $development->id) }}"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit Project
                </a>
            </div>
        </div>

        <!-- Status message -->
        <div x-data="{ show: {{ session()->has('message') ? 'true' : 'false' }} }" x-show="show" x-transition
            x-init="setTimeout(() => show = false, 3000)"
            class="p-4 mb-4 text-green-700 bg-green-100 border-l-4 border-green-500 dark:bg-green-800 dark:text-green-200">
            {{ session('message') }}
        </div>

        <!-- Project Overview Card -->
        <div class="mb-6 overflow-hidden bg-white shadow-xl dark:bg-gray-800 sm:rounded-lg">
            <div class="relative">
                @if ($development->featured_image)
                <div class="w-full h-64">
                    <img src="{{ Storage::url($development->featured_image) }}" alt="{{ $development->title }}"
                        class="object-cover w-full h-full">
                </div>
                @else
                <div class="flex items-center justify-center w-full h-64 bg-gradient-to-r from-blue-400 to-indigo-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-20 h-20 text-white opacity-50" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                @endif

                <div class="absolute top-4 right-4">
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-{{ $development->status === 'Planned' ? 'yellow' : ($development->status === 'Ongoing' ? 'blue' : 'green') }}-100 text-{{ $development->status === 'Planned' ? 'yellow' : ($development->status === 'Ongoing' ? 'blue' : 'green') }}-800">
                        {{ $development->status }}
                    </span>
                </div>

                <div class="absolute top-4 left-4">
                    <span
                        class="inline-flex items-center px-3 py-1 text-sm font-medium text-purple-800 bg-purple-100 rounded-full">
                        {{ $development->type }}
                    </span>
                </div>
            </div>

            <div class="p-6">
                <h1 class="mb-2 text-2xl font-bold text-gray-900 dark:text-white">{{ $development->title }}</h1>

                <div class="flex flex-wrap items-center mb-4 text-sm text-gray-500 dark:text-gray-400">
                    @if($development->location)
                    <div class="flex items-center mb-2 mr-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        {{ $development->location }}
                    </div>
                    @endif

                    @if($development->start_date)
                    <div class="flex items-center mb-2 mr-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{ date('M d, Y', strtotime($development->start_date)) }}
                        @if($development->end_date)
                        - {{ date('M d, Y', strtotime($development->end_date)) }}
                        @endif
                    </div>
                    @endif

                    @if($development->projectLead)
                    <div class="flex items-center mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Project Lead: {{ $development->projectLead->name }}
                    </div>
                    @endif
                </div>

                <div class="mb-6 prose dark:prose-invert max-w-none">
                    {{ $development->description }}
                </div>

                @if($development->tags && count($development->tags) > 0)
                <div class="flex flex-wrap gap-2 mb-6">
                    @foreach($development->tags as $tag)
                    <span
                        class="inline-flex items-center px-2.5 py-0.5 rounded-md text-sm font-medium bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                        {{ $tag }}
                    </span>
                    @endforeach
                </div>
                @endif

                @if($development->target_amount > 0)
                <div class="mb-6">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Fundraising Progress</h3>
                        <div class="text-sm font-medium text-gray-500 dark:text-gray-400">
                            ${{ number_format($development->amount_raised, 2) }} of ${{
                            number_format($development->target_amount, 2) }}
                        </div>
                    </div>
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2.5">
                        <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $progressPercentage }}%"></div>
                    </div>
                    <div class="flex items-center justify-between mt-2 text-xs text-gray-500 dark:text-gray-400">
                        <div>{{ $progressPercentage }}% Complete</div>
                        <div>{{ $development->donors_count }} Donor{{ $development->donors_count != 1 ? 's' : '' }}
                        </div>
                    </div>

                    <div class="mt-4">
                        <button wire:click="openDonationModal"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Add Donation
                        </button>

                        @if($development->donation_link)
                        <a href="{{ $development->donation_link }}" target="_blank"
                            class="inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm dark:text-gray-200 dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                            External Donation Link
                        </a>
                        @endif
                    </div>
                </div>
                @endif

                @if($development->volunteer_needed)
                <div class="p-4 mb-6 rounded-md bg-blue-50 dark:bg-blue-900">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-blue-800 dark:text-blue-200">Volunteers Needed</h3>
                            <div class="mt-2 text-sm text-blue-700 dark:text-blue-300">
                                <p>{{ $development->volunteer_description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Donations and Volunteers Tabs -->
        <div x-data="{ activeTab: 'donations' }">
            <div class="border-b border-gray-200 dark:border-gray-700">
                <nav class="flex -mb-px space-x-8">
                    <button @click="activeTab = 'donations'"
                        :class="{ 'border-blue-500 text-blue-600 dark:text-blue-400': activeTab === 'donations', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300': activeTab !== 'donations' }"
                        class="px-1 py-4 text-sm font-medium border-b-2 whitespace-nowrap">
                        Donations
                    </button>
                    <button @click="activeTab = 'volunteers'"
                        :class="{ 'border-blue-500 text-blue-600 dark:text-blue-400': activeTab === 'volunteers', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300': activeTab !== 'volunteers' }"
                        class="px-1 py-4 text-sm font-medium border-b-2 whitespace-nowrap">
                        Volunteers
                    </button>
                </nav>
            </div>

            <!-- Donations Tab -->
            <div x-show="activeTab === 'donations'" class="py-6">
                @if(count($donations) > 0)
                <div class="overflow-x-auto sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                    Donor</th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                    Amount</th>
                                <th scope="col"
                                    class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-gray-300">
                                    Date</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            @foreach($donations as $donation)
                            <tr>
                                <td
                                    class="px-6 py-4 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    @if($donation->user)
                                    {{ $donation->user->name }}
                                    @else
                                    Anonymous
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap dark:text-gray-300">
                                    ${{ number_format($donation->amount, 2) }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 whitespace-nowrap dark:text-gray-300">
                                    {{ $donation->donated_at->format('M d, Y') }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $donations->links() }}
                </div>
                @else
                <div class="py-12 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No donations yet</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Get started by adding a new donation.</p>
                    <div class="mt-6">
                        <button wire:click="openDonationModal"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 -ml-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Add Donation
                        </button>
                    </div>
                </div>
                @endif
            </div>

            <!-- Volunteers Tab -->
            <div x-show="activeTab === 'volunteers'" class="py-6">
                @if(count($volunteers) > 0)
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($volunteers as $volunteer)
                    <div class="p-4 bg-white rounded-lg shadow dark:bg-gray-800">
                        <div class="flex items-center space-x-4">
                            <div
                                class="flex items-center justify-center flex-shrink-0 w-10 h-10 text-gray-500 bg-gray-200 rounded-full dark:bg-gray-700 dark:text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $volunteer->name }}
                                </div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">{{ $volunteer->email }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-4">
                    {{ $volunteers->links() }}
                </div>
                @else
                <div class="py-12 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No volunteers yet</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">This project doesn't have any volunteers
                        registered yet.</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Donation Modal -->
    <div x-data="{ show: @entangle('showDonationModal') }" x-show="show" x-cloak
        class="fixed inset-0 z-50 overflow-y-auto" x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true" x-show="show">
                <div class="absolute inset-0 bg-gray-500 opacity-75 dark:bg-gray-900"></div>
            </div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div x-show="show" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl dark:bg-gray-800 sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                <div class="sm:flex sm:items-start">
                    <div
                        class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-blue-100 rounded-full dark:bg-blue-900 sm:mx-0 sm:h-10 sm:w-10">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600 dark:text-blue-400"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="w-full mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">
                            Add Donation
                        </h3>
                        <div class="mt-4">
                            <form wire:submit.prevent="addDonation">
                                <div class="mb-4">
                                    <label for="donationAmount"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Amount
                                        ($)</label>
                                    <div class="mt-1">
                                        <input type="number" step="0.01" min="1" wire:model.lazy="donationAmount"
                                            id="donationAmount"
                                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                    </div>
                                    @error('donationAmount')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="donationUserId"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Donor
                                        (Optional)</label>
                                    <div class="mt-1">
                                        <select wire:model.lazy="donationUserId" id="donationUserId"
                                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                            <option value="">Anonymous</option>
                                            @foreach(App\Models\User::all() as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('donationUserId')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                                    <button type="submit"
                                        class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                                        Add Donation
                                    </button>
                                    <button type="button" wire:click="closeDonationModal"
                                        class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:w-auto sm:text-sm">
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
