<div class="bg-white dark:bg-gray-800 shadow rounded-lg">
    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
        <div class="flex flex-col md:flex-row items-center justify-between">
            <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">
                Contact Messages
                @if($unreadCount > 0)
                    <span class="ml-2 px-2 py-1 bg-indigo-500 text-white text-xs rounded-full">{{ $unreadCount }} unread</span>
                @endif
                
                @if($highPriorityCount > 0)
                    <span class="ml-2 px-2 py-1 bg-red-500 text-white text-xs rounded-full">{{ $highPriorityCount }} high priority</span>
                @endif
            </h3>
            
            <div class="mt-4 md:mt-0 flex space-x-3">
                <x-dropdown>
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:border-gray-300 transition">
                            <span>Actions</span>
                            <svg class="ml-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>
                    
                    <x-slot name="content">
                        <button wire:click="bulkMarkAsRead" class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                            Mark as Read
                        </button>
                        <button wire:click="bulkMarkAsUnread" class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                            Mark as Unread
                        </button>
                        <button wire:click="bulkArchive" class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                            Archive
                        </button>
                        <button wire:click="exportSelected" class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                            Export
                        </button>
                        <button wire:click="confirmDelete" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                            Delete
                        </button>
                    </x-slot>
                </x-dropdown>

                <button wire:click="resetFilters" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                    Reset Filters
                </button>
            </div>
        </div>
        
        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Search</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input wire:model.live.debounce.300ms="search" type="text" id="search" class="pl-10 block w-full rounded-md border-gray-300 dark:border-gray-600                     <input wire:model.live.debounce.300ms="search" type="text" id="search" class="pl-10 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Search by name, email, or message">
                </div>
            </div>
            
            <div>
                <label for="filter" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Filter</label>
                <select wire:model.live="filter" id="filter" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                    <option value="all">All Messages</option>
                    <option value="unread">Unread</option>
                    <option value="read">Read</option>
                    <option value="high_priority">High Priority</option>
                    <option value="replied">Replied</option>
                    <option value="archived">Archived</option>
                </select>
            </div>
            
            <div>
                <label for="priority" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Priority</label>
                <select wire:model.live="priorityFilter" id="priority" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                    <option value="all">All Priorities</option>
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>
            </div>
            
            <div>
                <label for="daterange" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date Range</label>
                <input wire:model.live="dateRange" type="text" id="daterange" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md" x-data x-init="flatpickr($el, {mode: 'range', dateFormat: 'Y-m-d'})">
            </div>
        </div>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        <div class="flex items-center">
                            <input wire:model.live="selectAll" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 dark:border-gray-600 rounded">
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        <div class="flex                         <div class="flex items-center cursor-pointer" wire:click="sortBy('name')">
                            <span>Name</span>
                            @if ($sortField === 'name')
                                <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    @if ($sortDirection === 'asc')
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                                    @else
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    @endif
                                </svg>
                            @endif
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        <div class="flex items-center cursor-pointer" wire:click="sortBy('email')">
                            <span>Email</span>
                            @if ($sortField === 'email')
                                <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    @if ($sortDirection === 'asc')
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                                    @else
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    @endif
                                </svg>
                            @endif
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        <div class="flex items-center cursor-pointer" wire:click="sortBy('subject')">
                            <span>Subject</span>
                            @if ($sortField === 'subject')
                                <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    @if ($sortDirection === 'asc')
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                                    @else
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    @endif
                                </svg>
                            @endif
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        <div class="flex items-center cursor-pointer" wire:click="sortBy('status')">
                            <span>Status</span>
                            @if ($sortField === 'status')
                                <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    @if ($sortDirection === 'asc')
                                        <path stroke                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                                        @else
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        @endif
                                    </svg>
                                @endif
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            <div class="flex items-center cursor-pointer" wire:click="sortBy('priority')">
                                <span>Priority</span>
                                @if ($sortField === 'priority')
                                    <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        @if ($sortDirection === 'asc')
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                                        @else
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        @endif
                                    </svg>
                                @endif
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            <div class="flex items-center cursor-pointer" wire:click="sortBy('created_at')">
                                <span>Date</span>
                                @if ($sortField === 'created_at')
                                    <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        @if ($sortDirection === 'asc')
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                                        @else
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        @endif
                                    </svg>
                                @endif
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($messages as $message)
                        <tr class="{{ !$message->isRead() ? 'bg-indigo-50 dark:bg-indigo-900/10' : '' }} hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <input wire:model.live="selectedMessages" value="{{ $message->id }}" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 dark:border-gray-600 rounded">
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                            {{ $message->name }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-gray-100">{{ $message->email }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900 dark:text-gray-100 truncate max-w-xs">
                                    {{ $message->subject }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($message->status === 'unread') bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100 
                                    @elseif($message->status === 'read') bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-100 
                                    @elseif($message->status === 'replied') bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100 
                                    @else bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-100 @endif">
                                    {{ ucfirst($message->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($message->priority === 'high') bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100 
                                    @elseif($message->priority === 'medium') bg-orange-100 text-orange-800 dark:bg-orange-800 dark:text-orange-100 
                                    @else bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100 @endif">
                                    {{ ucfirst($message->priority) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                {{ $message->created_at->diffForHumans() }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex space-x-2">
                                    <button wire:click="viewMessage({{ $message->id }})" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                    
                                    <button wire:click="showReply({{ $message->id }})" class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                                        </svg>
                                    </button>
                                    
                                    <x-dropdown align="right" width="48">
                                        <x-slot name="trigger">
                                            <button>
                                                <svg class="w-5 h-5 text-gray-400 hover:text-gray-500 dark:text-gray-400 dark:hover:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path>
                                                </svg>
                                            </button>
                                        </x-slot>
                                        
                                        <x-slot name="content">
                                            @if($message->isRead())
                                                <button wire:click="markAsUnread({{ $message->id }})" class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                    Mark as Unread
                                                </button>
                                            @else
                                                <button wire:click="markAsRead({{ $message->id }})" class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                    Mark as Read
                                                </button>
                                            @endif
                                            
                                            <div class="border-t border-gray-100 dark:border-gray-700"></div>
                                            
                                            <button wire:click="changePriority({{ $message->id }}, 'high')" class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                Set High Priority
                                            </button>
                                            <button wire:click="changePriority({{ $message->id }}, 'medium')" class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                Set Medium Priority
                                            </button>
                                            <button wire:click="changePriority({{ $message->id }}, 'low')" class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                Set Low Priority
                                            </button>
                                            
                                            <div class="border-t border-gray-100 dark:border-gray-700"></div>
                                            
                                            <button wire:click="archive({{ $message->id }})" class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                Archive
                                            </button>
                                        </x-slot>
                                    </x-dropdown>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                <div class="flex flex-col items-center justify-center py-8">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                    </svg>
                                    <p class="mt-4 text-lg font-medium">No messages found</p>
                                    <p class="mt-1 text-sm">No messages match your current filters.</p>
                                    <button wire:click="resetFilters" class="mt-4 px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
                                        Reset Filters
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
            {{ $messages->links() }}
        </div>
        
        <!-- Message View Modal -->
        <div x-data="{ open: @entangle('showMessageModal').live }">
            <div
                x-show="open"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 z-50 overflow-y-auto"
                style="display: none;"
            >
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity" aria-hidden="true">
                        <div class="absolute inset-0 bg-gray-500 dark:bg-gray-900 opacity-75"></div>
                    </div>
    
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                    <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                        @if ($currentMessage)
                            <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="sm:flex sm:items-start">
                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                        <div class="flex justify-between items-center mb-4">
                                            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100">
                                                {{ $currentMessage->subject }}
                                            </h3>
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if($currentMessage->priority === 'high') bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100 
                                                @elseif($currentMessage->priority === 'medium') bg-orange-100 text-orange-800 dark:bg-orange-800 dark:text-orange-100 
                                                @else bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100 @endif">
                                                {{ ucfirst($currentMessage->priority) }} Priority
                                            </span>
                                        </div>
                                        
                                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 mb-4">
                                            <div class="flex justify-between items-center mb-2">
                                                <div>
                                                    <span class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $currentMessage->name }}</span>
                                                    <span class="text-sm text-gray-500 dark:text-gray-400">&lt;{{ $currentMessage->email }}&gt;</span>
                                                </div>
                                                <span class="text-sm text-gray-500 dark:text-gray-400">{{ $currentMessage->created_at->format('M d, Y h:i A') }}</span>
                                            </div>
                                            <p class="text-sm text-gray-600 dark:text-gray-300 whitespace-pre-line">{{ $currentMessage->message }}</p>
                                        </div>
                                        
                                        <div class="mt-5 grid grid-cols-2 gap-4 text-sm">
                                            <div>
                                                <p class="text-gray-500 dark:text-gray-400">IP Address:</p>
                                                <p class="font-medium text-gray-900 dark:text-gray-100">{{ $currentMessage->ip_address ?? 'Not recorded' }}</p>
                                            </div>
                                            
                                            <div>
                                                <p class="text-gray-500 dark:text-gray-400">Status:</p>
                                                <p class="font-medium text-gray-900 dark:text-gray-100">{{ ucfirst($currentMessage->status) }}</p>
                                            </div>
                                            
                                            <div class="col-span-2">
                                                <p class="text-gray-500 dark:text-gray-400">User Agent:</p>
                                                <p class="font-medium text-gray-900 dark:text-gray-100 truncate">{{ $currentMessage->user_agent ?? 'Not recorded' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                <button wire:click="showReply({{ $currentMessage->id }})" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                                    Reply
                                </button>
                                <button wire:click="closeMessage" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-800 text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                    Close
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Reply Modal -->
        <div x-data="{ open: @entangle('showReplyModal').live }">
            <div
                x-show="open"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 z-50 overflow-y-auto"
                style="display: none;"
            >
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity" aria-hidden="true">
                        <div class="absolute inset-0 bg-gray-500 dark:bg-gray-900 opacity-75"></div>
                    </div>
    
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                    <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
                        @if ($currentMessage)
                            <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="sm:flex sm:items-start">
                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100 mb-4">
                                            Reply to {{ $currentMessage->name }}
                                        </h3>
                                        
                                        <div class="space-y-4">
                                            <div>
                                                <label for="replySubject" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Subject</label>
                                                <input wire:model="replySubject" type="text" id="replySubject" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                @error('replySubject') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                            </div>
                                            
                                            <div>
                                                <label for="replyContent" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Message</label>
                                                <textarea wire:model="replyContent" id="replyContent" rows="6" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"></textarea>
                                                @error('replyContent') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                            </div>
                                            
                                            <div class="bg-gray-50 dark:bg-gray-700 rounded p-3">
                                                <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Original Message</h4>
                                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                                    <p><strong>From:</strong> {{ $currentMessage->name }} ({{ $currentMessage->email }})</p>
                                                    <p><strong>Subject:</strong> {{ $currentMessage->subject }}</p>
                                                    <p><strong>Date:</strong> {{ $currentMessage->created_at->format('M d, Y h:i A') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                <button wire:click="sendReply" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                                    Send Reply
                                </button>
                                <button wire:click="$set('showReplyModal', false)" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-800 text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                    Cancel
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Delete Confirmation Modal - Will use SweetAlert2 via AlpineJS -->
        <div x-data="{
            confirmDelete: false,
            title: '',
            text: '',
            ids: [],
            listen() {
                Livewire.on('confirm-delete', (title, text, ids) => {
                    this.title = title;
                    this.text = text;
                    this.ids = ids;
                    this.confirmDelete = true;
                    
                    // Using sweetalert2 if available
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            title: this.title,
                            text: this.text,
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete them!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                @this.call('deleteConfirmed');
                            }
                        });
                    } else {
                        // Fallback to confirm
                        if (confirm(`${this.title}\n${this.text}`)) {
                            @this.call('deleteConfirmed');
                        }
                    }
                })
            }
        }" x-init="listen()">
        </div>
    </div>
    
<!--
    Scripts for additional functionality
    You can place these in your layout file or include them here
-->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Integration with Flatpickr for date ranges if needed
        if (typeof flatpickr !== 'undefined') {
            flatpickr("#daterange", {
                mode: "range",
                dateFormat: "Y-m-d",
                onChange: function(selectedDates, dateStr, instance) {
                    // This will trigger the Livewire property update
                    Livewire.dispatch('date-range-selected', { range: dateStr });
                }
            });
        }
    });

    // Listen for Livewire events
    document.addEventListener('livewire:initialized', function() {
        Livewire.on('success', (message) => {
            if (typeof Toast !== 'undefined') {
                Toast.fire({
                    icon: 'success',
                    title: message
                });
            } else {
                alert(message);
            }
        });

        Livewire.on('warning', (message) => {
            if (typeof Toast !== 'undefined') {
                Toast.fire({
                    icon: 'warning',
                    title: message
                });
            } else {
                alert(message);
            }
        });

        Livewire.on('reply-sent', (message) => {
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Success!',
                    text: message,
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            } else {
                alert(message);
            }
        });
    });
</script>