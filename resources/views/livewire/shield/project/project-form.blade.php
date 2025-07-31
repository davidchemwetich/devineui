<div
    class="min-h-screen p-4 bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-gray-900 dark:to-gray-800 sm:p-6 md:p-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8 text-center">
            <h1 class="mb-2 text-3xl font-bold text-gray-800 dark:text-gray-100">
                {{ $projectId ? 'Edit Project' : 'Create New Project' }}
            </h1>
            <p class="text-gray-600 dark:text-gray-400">
                {{ $projectId ? 'Update your church project details' : 'Share God\'s work with your community' }}
            </p>
        </div>

        <!-- Progress Stepper -->
        <div class="mb-8">
            <div class="flex items-center justify-center">
                @for($step = 1; $step <= $totalSteps; $step++) <div class="flex items-center">
                    <!-- Step Circle -->
                    <div class="relative">
                        <div
                            class="w-10 h-10 mx-auto rounded-full border-2 flex items-center justify-center text-sm font-semibold
                                {{ $currentStep >= $step
                                    ? 'bg-indigo-600 border-indigo-600 text-white'
                                    : 'bg-white border-gray-300 text-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-500' }}">
                            @if($currentStep > $step)
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" />
                            </svg>
                            @else
                            {{ $step }}
                            @endif
                        </div>
                        <!-- Step Label -->
                        <div class="absolute transform -translate-x-1/2 top-12 left-1/2 whitespace-nowrap">
                            <span class="text-xs font-medium text-gray-600 dark:text-gray-400">
                                @switch($step)
                                @case(1) Project Details @break
                                @case(2) Financial Goals @break
                                @case(3) Media & Updates @break
                                @case(4) Review & Submit @break
                                @endswitch
                            </span>
                        </div>
                    </div>

                    <!-- Connector Line -->
                    @if($step < $totalSteps) <div class="w-12 sm:w-20 h-1 mx-2
                                {{ $currentStep > $step ? 'bg-indigo-600' : 'bg-gray-300 dark:bg-gray-600' }}">
            </div>
            @endif
        </div>
        @endfor
    </div>
</div>

<!-- Form Card -->
<div class="overflow-hidden bg-white shadow-xl dark:bg-gray-800 rounded-xl">
    <form wire:submit.prevent="save">
        <div class="p-6 sm:p-8">

            <!-- Step 1: Project Details -->
            @if($currentStep === 1)
            <div class="space-y-6" x-data x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform translate-x-6"
                x-transition:enter-end="opacity-100 transform translate-x-0">
                <div class="mb-6 text-center">
                    <div
                        class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-indigo-100 rounded-full dark:bg-indigo-900">
                        <svg class="w-8 h-8 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Project Information</h3>
                    <p class="text-gray-600 dark:text-gray-400">Tell us about your ministry project</p>
                </div>

                <!-- Project Type -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Project Type <span class="text-red-500">*</span>
                    </label>
                    <select wire:model="project_type_id"
                        class="w-full border-gray-300 rounded-lg shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Select a project type...</option>
                        @foreach($project_types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                    @error('project_type_id') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Title -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Project Title <span class="text-red-500">*</span>
                    </label>
                    <input type="text" wire:model="title" placeholder="e.g., Youth Ministry Building Fund"
                        class="w-full border-gray-300 rounded-lg shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                    @error('title') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                </div>

                <!-- Description -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Project Description <span class="text-red-500">*</span>
                    </label>
                    <textarea wire:model="description" rows="5"
                        placeholder="Share the vision and purpose of this project. How will it serve the church and community?"
                        class="w-full border-gray-300 rounded-lg shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                    @error('description') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            @endif

            <!-- Step 2: Financial Goals -->
            @if($currentStep === 2)
            <div class="space-y-6" x-data x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform translate-x-6"
                x-transition:enter-end="opacity-100 transform translate-x-0">
                <div class="mb-6 text-center">
                    <div
                        class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-green-100 rounded-full dark:bg-green-900">
                        <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Financial Planning</h3>
                    <p class="text-gray-600 dark:text-gray-400">Set your fundraising goals</p>
                </div>

                <div class="grid gap-6 md:grid-cols-2">
                    <!-- Goal Amount -->
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                            Goal Amount <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span
                                class="absolute text-gray-500 transform -translate-y-1/2 left-3 top-1/2 dark:text-gray-400">ksh</span>
                            <input type="number" wire:model="goal_amount" step="0.01" min="1" placeholder="10000.00"
                                class="w-full py-2 pl-8 pr-4 border-gray-300 rounded-lg shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        @error('goal_amount') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Raised Amount -->
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                            Current Raised Amount
                        </label>
                        <div class="relative">
                            <span
                                class="absolute text-gray-500 transform -translate-y-1/2 left-3 top-1/2 dark:text-gray-400">ksh</span>
                            <input type="number" wire:model="raised_amount" step="0.01" min="0" placeholder="0.00"
                                class="w-full py-2 pl-8 pr-4 border-gray-300 rounded-lg shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        @error('raised_amount') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}
                        </p> @enderror
                    </div>
                </div>

                <!-- Progress Preview -->
                @if($goal_amount > 0)
                <div class="p-4 rounded-lg bg-gray-50 dark:bg-gray-700">
                    <h4 class="mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Progress Preview</h4>
                    <div class="w-full h-3 mb-2 bg-gray-200 rounded-full dark:bg-gray-600">
                        <div class="h-3 transition-all duration-300 bg-indigo-600 rounded-full"
                            style="width: {{ min(100, ($raised_amount / $goal_amount) * 100) }}%"></div>
                    </div>
                    <div class="flex justify-between text-sm text-gray-600 dark:text-gray-400">
                        <span>${{ number_format($raised_amount, 2) }} raised</span>
                        <span>{{ number_format(min(100, ($raised_amount / $goal_amount) * 100), 1) }}%</span>
                        <span>${{ number_format($goal_amount, 2) }} goal</span>
                    </div>
                </div>
                @endif
            </div>
            @endif

            <!-- Step 3: Media & Updates -->
            @if($currentStep === 3)
            <div class="space-y-6" x-data x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform translate-x-6"
                x-transition:enter-end="opacity-100 transform translate-x-0">
                <div class="mb-6 text-center">
                    <div
                        class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-purple-100 rounded-full dark:bg-purple-900">
                        <svg class="w-8 h-8 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Media & Updates</h3>
                    <p class="text-gray-600 dark:text-gray-400">Add images and project updates</p>
                </div>

                <!-- Featured Image -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Featured Image
                    </label>

                    @if($existing_image && !$featured_image)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $existing_image) }}" alt="Current featured image"
                            class="object-cover w-32 h-32 rounded-lg shadow-md">
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Current image</p>
                    </div>
                    @endif

                    <div class="p-6 text-center border-2 border-gray-300 border-dashed rounded-lg dark:border-gray-600">
                        <input type="file" wire:model="featured_image" accept="image/*" class="hidden"
                            id="featured_image">

                        @if($featured_image)
                        <div class="mb-4">
                            <img src="{{ $featured_image->temporaryUrl() }}" alt="Preview"
                                class="object-cover w-32 h-32 mx-auto rounded-lg shadow-md">
                        </div>
                        @endif

                        <label for="featured_image" class="cursor-pointer">
                            <div class="text-gray-600 dark:text-gray-400">
                                <svg class="w-12 h-12 mx-auto mb-4" stroke="currentColor" fill="none"
                                    viewBox="0 0 48 48">
                                    <path
                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <p class="text-sm">
                                    {{ $featured_image ? 'Click to change image' : 'Click to upload an image' }}
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-500">PNG, JPG up to 2MB</p>
                            </div>
                        </label>
                    </div>
                    @error('featured_image') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Latest Update -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Latest Update
                    </label>
                    <textarea wire:model="latest_update" rows="4"
                        placeholder="Share any recent progress, milestones, or news about this project..."
                        class="w-full border-gray-300 rounded-lg shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                    @error('latest_update') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Update Date -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Update Date
                    </label>
                    <input type="date" wire:model="latest_update_date"
                        class="w-full border-gray-300 rounded-lg shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-indigo-500 focus:border-indigo-500">
                    @error('latest_update_date') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}
                    </p> @enderror
                </div>
            </div>
            @endif

            <!-- Step 4: Review & Submit -->
            @if($currentStep === 4)
            <div class="space-y-6" x-data x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform translate-x-6"
                x-transition:enter-end="opacity-100 transform translate-x-0">
                <div class="mb-6 text-center">
                    <div
                        class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-blue-100 rounded-full dark:bg-blue-900">
                        <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Review & Submit</h3>
                    <p class="text-gray-600 dark:text-gray-400">Confirm your project details</p>
                </div>

                <!-- Review Card -->
                <div class="p-6 space-y-4 rounded-lg bg-gray-50 dark:bg-gray-700">
                    <div class="grid gap-6 md:grid-cols-2">
                        <div>
                            <h4 class="mb-2 font-medium text-gray-700 dark:text-gray-300">Project Details</h4>
                            <div class="space-y-2 text-sm">
                                <p><span class="font-medium">Type:</span>
                                    {{ $project_types->firstWhere('id', $project_type_id)?->name ?? 'Not selected' }}
                                </p>
                                <p><span class="font-medium">Title:</span> {{ $title ?: 'Not provided' }}</p>
                                <p><span class="font-medium">Description:</span>
                                    {{ $description ? Str::limit($description, 100) : 'Not provided' }}
                                </p>
                            </div>
                        </div>

                        <div>
                            <h4 class="mb-2 font-medium text-gray-700 dark:text-gray-300">Financial Goals</h4>
                            <div class="space-y-2 text-sm">
                                <p><span class="font-medium">Goal Amount:</span> ${{ number_format($goal_amount, 2) }}
                                </p>
                                <p><span class="font-medium">Raised Amount:</span> ${{ number_format($raised_amount, 2)
                                    }}</p>
                                @if($goal_amount > 0)
                                <div class="w-full h-2 bg-gray-200 rounded-full dark:bg-gray-600">
                                    <div class="h-2 bg-indigo-600 rounded-full"
                                        style="width: {{ min(100, ($raised_amount / $goal_amount) * 100) }}%"></div>
                                </div>
                                <p class="text-xs text-gray-600 dark:text-gray-400">
                                    {{ number_format(min(100, ($raised_amount / $goal_amount) * 100), 1) }}% Complete
                                </p>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if($featured_image || $existing_image || $latest_update)
                    <div class="pt-4 border-t border-gray-200 dark:border-gray-600">
                        <h4 class="mb-2 font-medium text-gray-700 dark:text-gray-300">Media & Updates</h4>
                        <div class="flex items-start space-x-4">
                            @if($featured_image)
                            <img src="{{ $featured_image->temporaryUrl() }}" alt="Featured image"
                                class="object-cover w-16 h-16 rounded-lg">
                            @elseif($existing_image)
                            <img src="{{ asset('storage/' . $existing_image) }}" alt="Featured image"
                                class="object-cover w-16 h-16 rounded-lg">
                            @endif

                            @if($latest_update)
                            <div class="flex-1">
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    <span class="font-medium">Latest Update:</span>
                                    {{ Str::limit($latest_update, 150) }}
                                </p>
                                @if($latest_update_date)
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-500">
                                    {{ \Carbon\Carbon::parse($latest_update_date)->format('M j, Y') }}
                                </p>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Final Confirmation -->
                <div class="p-4 border border-blue-200 rounded-lg bg-blue-50 dark:bg-blue-900/30 dark:border-blue-800">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 mt-0.5 mr-3" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <h4 class="font-medium text-blue-800 dark:text-blue-200">Ready to {{ $projectId ? 'update' :
                                'create' }} your project?</h4>
                            <p class="mt-1 text-sm text-blue-700 dark:text-blue-300">
                                {{ $projectId ? 'Your changes will be saved and visible to the community.' : 'Your
                                project will be created and shared with the church community.' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Form Actions -->
        <div class="flex items-center justify-between px-6 py-4 bg-gray-50 dark:bg-gray-700 sm:px-8">
            <div>
                @if($currentStep > 1)
                <button type="button" wire:click="previousStep"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg dark:border-gray-600 dark:text-gray-300 dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Previous
                </button>
                @else
                <a href="{{ route(config('app.admin_prefix', 'shield') . '.project.index') }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg dark:border-gray-600 dark:text-gray-300 dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Projects
                </a>
                @endif
            </div>

            <div class="flex items-center space-x-3">
                <!-- Step Navigation Dots -->
                <div class="hidden space-x-2 sm:flex">
                    @for($step = 1; $step <= $totalSteps; $step++) <button type="button"
                        wire:click="goToStep({{ $step }})" @if($step> $currentStep) disabled @endif
                        class="w-2 h-2 rounded-full transition-colors duration-200
                        {{ $currentStep === $step
                        ? 'bg-indigo-600'
                        : ($currentStep > $step ? 'bg-indigo-400' : 'bg-gray-300 dark:bg-gray-600') }}
                        {{ $step <= $currentStep ? 'cursor-pointer' : 'cursor-not-allowed' }}">
                            </button>
                            @endfor
                </div>

                @if($currentStep < $totalSteps) <button type="button" wire:click="nextStep"
                    class="inline-flex items-center px-6 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Next
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                    </button>
                    @else
                    <button type="submit"
                        class="inline-flex items-center px-6 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        {{ $projectId ? 'Update Project' : 'Create Project' }}
                    </button>
                    @endif
            </div>
        </div>
    </form>
</div>
</div>
</div>
