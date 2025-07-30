<div class="min-h-screen bg-gray-50">
    <!-- Hero Section -->
    <div class="relative overflow-hidden bg-gradient-to-br from-[#008000] to-green-700">
        <div class="absolute inset-0 bg-black opacity-20"></div>
        <div class="relative px-4 py-16 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex items-center mb-6">
                <a href="{{ route('projects.index') }}"
                    class="inline-flex items-center text-green-100 transition-colors duration-200 hover:text-white">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                        </path>
                    </svg>
                    Back to Projects
                </a>
            </div>

            <div class="lg:grid lg:grid-cols-2 lg:gap-12 lg:items-center">
                <div>
                    <div class="mb-4">
                        <span
                            class="inline-flex items-center px-3 py-1 text-sm font-medium text-white rounded-full bg-white/20">
                            {{ $project->type->name }}
                        </span>
                    </div>
                    <h1 class="text-4xl font-bold text-white sm:text-5xl lg:text-6xl">
                        {{ $project->title }}
                    </h1>
                    <p class="mt-6 text-xl leading-relaxed text-green-100">
                        {{ Str::limit($project->description, 200) }}
                    </p>
                </div>

                <div class="mt-10 lg:mt-0">
                    <div class="p-8 border bg-white/10 backdrop-blur-sm rounded-2xl border-white/20">
                        <div class="mb-6 text-center">
                            <div class="mb-2 text-4xl font-bold text-white">
                                {{ number_format($project->progress_percentage, 0) }}%
                            </div>
                            <div class="text-green-100">Funding Progress</div>
                        </div>

                        <div class="mb-6">
                            <div class="w-full h-4 rounded-full bg-white/20">
                                <div class="bg-[#000fff] h-4 rounded-full transition-all duration-1000 ease-out"
                                    style="width: {{ $project->progress_percentage }}%" x-data
                                    x-init="$el.style.width = '0%'; setTimeout(() => $el.style.width = '{{ $project->progress_percentage }}%', 500)">
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-between mb-6 text-white">
                            <div class="text-center">
                                <div class="text-2xl font-bold">KSh {{ $project->formatted_raised }}</div>
                                <div class="text-sm text-green-100">Raised</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold">KSh {{ $project->formatted_goal }}</div>
                                <div class="text-sm text-green-100">Goal</div>
                            </div>
                        </div>

                        <a href="#donate"
                            class="block w-full text-center px-8 py-4 bg-[#000fff] text-white font-semibold rounded-xl hover:bg-blue-700 transition-all duration-200 transform hover:-translate-y-0.5 hover:shadow-xl">
                            Support This Project
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="px-4 py-16 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="lg:grid lg:grid-cols-3 lg:gap-12">
            <!-- Main Content Column -->
            <div class="lg:col-span-2">
                <!-- Project Image -->
                <div class="mb-8">
                    <div class="overflow-hidden shadow-2xl rounded-2xl">
                        <img src="{{ $project->featured_image_url }}" alt="{{ $project->title }}"
                            class="object-cover w-full h-64 sm:h-80 lg:h-96">
                    </div>
                </div>

                <!-- Project Description -->
                <div class="p-8 mb-8 bg-white shadow-lg rounded-2xl">
                    <h2 class="mb-6 text-2xl font-bold text-gray-900">About This Project</h2>
                    <div class="leading-relaxed prose prose-lg text-gray-700 max-w-none">
                        {{ $project->description }}
                    </div>
                </div>

                <!-- Latest Updates -->
                @if($project->latest_update)
                <div class="p-8 mb-8 bg-white shadow-lg rounded-2xl">
                    <h2 class="mb-6 text-2xl font-bold text-gray-900">Latest Update</h2>
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-[#000fff] rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1">
                            <div class="mb-2 text-sm text-gray-500">
                                {{ $project->latest_update_date ? $project->latest_update_date->format('F j, Y') :
                                'Recent' }}
                            </div>
                            <p class="leading-relaxed text-gray-700">{{ $project->latest_update }}</p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Share Section -->
                <div class="p-8 bg-white shadow-lg rounded-2xl">
                    <h2 class="mb-6 text-2xl font-bold text-gray-900">Share This Project</h2>
                    <p class="mb-6 text-gray-600">Help us spread the word about this important initiative.</p>

                    <div class="flex flex-wrap gap-4" x-data="{
                        shareUrl: '{{ url()->current() }}',
                        shareText: '{{ $project->title }} - {{ Str::limit($project->description, 100) }}',

                        shareOnFacebook() {
                            window.open(`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(this.shareUrl)}`, '_blank', 'width=600,height=400');
                        },

                        shareOnTwitter() {
                            window.open(`https://twitter.com/intent/tweet?url=${encodeURIComponent(this.shareUrl)}&text=${encodeURIComponent(this.shareText)}`, '_blank', 'width=600,height=400');
                        },

                        shareOnWhatsApp() {
                            window.open(`https://wa.me/?text=${encodeURIComponent(this.shareText + ' ' + this.shareUrl)}`, '_blank');
                        },

                        copyLink() {
                            navigator.clipboard.writeText(this.shareUrl).then(() => {
                                alert('Link copied to clipboard!');
                            });
                        }
                    }">
                        <button @click="shareOnFacebook()"
                            class="inline-flex items-center px-4 py-2 text-white transition-colors duration-200 bg-blue-600 rounded-lg hover:bg-blue-700">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                            Facebook
                        </button>

                        <button @click="shareOnTwitter()"
                            class="inline-flex items-center px-4 py-2 text-white transition-colors duration-200 rounded-lg bg-sky-500 hover:bg-sky-600">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                            </svg>
                            Twitter
                        </button>

                        <button @click="shareOnWhatsApp()"
                            class="inline-flex items-center px-4 py-2 text-white transition-colors duration-200 bg-green-500 rounded-lg hover:bg-green-600">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488" />
                            </svg>
                            WhatsApp
                        </button>

                        <button @click="copyLink()"
                            class="inline-flex items-center px-4 py-2 text-white transition-colors duration-200 bg-gray-600 rounded-lg hover:bg-gray-700">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z">
                                </path>
                            </svg>
                            Copy Link
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="mt-12 lg:mt-0">
                <!-- Donation Card -->
                <div class="sticky p-8 mb-8 bg-white shadow-lg rounded-2xl top-8">
                    <h3 class="mb-6 text-xl font-bold text-gray-900">Support This Project</h3>

                    <div class="mb-6 text-center">
                        <div class="text-3xl font-bold text-[#008000] mb-2">
                            KSh {{ $project->formatted_raised }}
                        </div>
                        <div class="text-gray-600">of KSh {{ $project->formatted_goal }} goal</div>
                    </div>

                    <div class="mb-6">
                        <div class="w-full h-3 bg-gray-200 rounded-full">
                            <div class="bg-[#000fff] h-3 rounded-full transition-all duration-1000 ease-out"
                                style="width: {{ $project->progress_percentage }}%"></div>
                        </div>
                        <div class="flex justify-between mt-2 text-sm text-gray-600">
                            <span>{{ number_format($project->progress_percentage, 1) }}% Complete</span>
                            <span>KSh {{ number_format($project->goal_amount - $project->raised_amount, 2) }}
                                remaining</span>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <a href="#donate"
                            class="block w-full text-center px-6 py-3 bg-[#000fff] text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors duration-200">
                            Donate Now
                        </a>
                        <button
                            class="block w-full text-center px-6 py-3 border-2 border-[#008000] text-[#008000] font-semibold rounded-lg hover:bg-[#008000] hover:text-white transition-colors duration-200">
                            Share Project
                        </button>
                    </div>

                    <div class="pt-6 mt-6 border-t border-gray-200">
                        <div class="text-sm text-center text-gray-600">
                            <p class="mb-2">Project Reference: <span class="font-medium">{{ $project->id }}</span></p>
                            <p>Use this reference when making donations</p>
                        </div>
                    </div>
                </div>

                <!-- Project Stats -->
                <div class="p-8 mb-8 bg-white shadow-lg rounded-2xl">
                    <h3 class="mb-6 text-xl font-bold text-gray-900">Project Details</h3>

                    <div class="space-y-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Category</span>
                            <span class="font-medium text-gray-900">{{ $project->type->name }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Goal Amount</span>
                            <span class="font-medium text-gray-900">KSh {{ $project->formatted_goal }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Amount Raised</span>
                            <span class="font-medium text-[#008000]">KSh {{ $project->formatted_raised }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Progress</span>
                            <span class="font-medium text-[#000fff]">{{ number_format($project->progress_percentage, 1)
                                }}%</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Created</span>
                            <span class="font-medium text-gray-900">{{ $project->created_at->format('M j, Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Projects -->
    @if($relatedProjects->count() > 0)
    <div class="py-16 bg-gray-100">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="mb-12 text-center">
                <h2 class="text-3xl font-bold text-gray-900">Related Projects</h2>
                <p class="mt-4 text-lg text-gray-600">
                    Other {{ strtolower($project->type->name) }} projects you might be interested in
                </p>
            </div>

            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($relatedProjects as $relatedProject)
                <div
                    class="overflow-hidden transition-all duration-300 transform bg-white shadow-lg rounded-2xl hover:shadow-2xl hover:-translate-y-1">
                    <div class="relative overflow-hidden">
                        <img src="{{ $relatedProject->featured_image_url }}" alt="{{ $relatedProject->title }}"
                            class="object-cover w-full h-48 transition-transform duration-300 hover:scale-105">
                        <div class="absolute top-3 right-3">
                            <span
                                class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-[#000fff] text-white">
                                {{ number_format($relatedProject->progress_percentage, 0) }}%
                            </span>
                        </div>
                    </div>

                    <div class="p-6">
                        <h3 class="mb-2 text-lg font-bold text-gray-900 line-clamp-2">
                            {{ $relatedProject->title }}
                        </h3>

                        <p class="mb-4 text-sm text-gray-600 line-clamp-3">
                            {{ Str::limit($relatedProject->description, 120) }}
                        </p>

                        <div class="mb-4">
                            <div class="flex justify-between mb-1 text-xs text-gray-600">
                                <span>KSh {{ $relatedProject->formatted_raised }}</span>
                                <span>KSh {{ $relatedProject->formatted_goal }}</span>
                            </div>
                            <div class="w-full h-2 bg-gray-200 rounded-full">
                                <div class="bg-[#000fff] h-2 rounded-full"
                                    style="width: {{ $relatedProject->progress_percentage }}%"></div>
                            </div>
                        </div>

                        <a href="{{ route('project.show', $relatedProject->slug) }}"
                            class="inline-flex items-center justify-center w-full px-4 py-2.5 text-sm font-medium text-white bg-[#008000] rounded-lg hover:bg-green-700 transition-colors duration-200">
                            View Project
                            <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- Donation Section -->
    <div id="donate" class="py-16 bg-gradient-to-r from-[#008000] to-green-700">
        <div class="max-w-4xl px-4 mx-auto sm:px-6 lg:px-8">
            <div class="mb-12 text-center">
                <h2 class="text-3xl font-bold text-white sm:text-4xl">
                    Support {{ $project->title }}
                </h2>
                <p class="max-w-2xl mx-auto mt-4 text-xl text-green-100">
                    Your generous donation will help us achieve our goal and make a lasting impact in our community.
                </p>
            </div>

            <div class="p-8 bg-white shadow-2xl rounded-2xl lg:p-12">
                <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
                    <!-- Donation Options -->
                    <div>
                        <h3 class="mb-6 text-2xl font-bold text-gray-900">Choose Your Donation Method</h3>

                        <div class="space-y-4">
                            <!-- PayPal Option -->
                            <div
                                class="border border-gray-200 rounded-lg p-4 hover:border-[#000fff] transition-colors duration-200">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div
                                            class="w-12 h-12 bg-[#000fff] rounded-lg flex items-center justify-center mr-4">
                                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M7.076 21.337H2.47a.641.641 0 0 1-.633-.74L4.944.901C5.026.382 5.474 0 5.998 0h7.46c2.57 0 4.578.543 5.69 1.81 1.01 1.15 1.304 2.42 1.012 4.287-.023.143-.047.288-.077.437-.983 5.05-4.349 6.797-8.647 6.797h-2.19c-.524 0-.968.382-1.05.9l-1.12 7.106zm14.146-14.42a3.35 3.35 0 0 0-.607-.421c-.297-.168-.652-.31-1.085-.421C18.85 5.776 18.104 5.718 17.2 5.718h-5.770c-.524 0-.968.382-1.05.9L9.653 9.89c-.082.518.302.94.826.94h2.038c4.298 0 7.664-1.747 8.647-6.797.03-.149.054-.294.077-.437.202-1.3.043-2.19-.615-2.679z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-900">PayPal</h4>
                                            <p class="text-sm text-gray-600">Secure international payments</p>
                                        </div>
                                    </div>
                                    <a href="https://www.paypal.com/donate?hosted_button_id=YOUR_BUTTON_ID"
                                        target="_blank"
                                        class="px-6 py-2 bg-[#000fff] text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                        Donate
                                    </a>
                                </div>
                            </div>

                            <!-- M-Pesa Option -->
                            <div
                                class="p-4 transition-colors duration-200 border border-gray-200 rounded-lg hover:border-green-500">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div
                                            class="flex items-center justify-center w-12 h-12 mr-4 bg-green-600 rounded-lg">
                                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-900">M-Pesa</h4>
                                            <p class="text-sm text-gray-600">Mobile money payments (Kenya)</p>
                                        </div>
                                    </div>
                                    <a href="{{ route('donate') }}" target="_blank"
                                        class="px-6 py-2 text-white transition-colors duration-200 bg-green-600 rounded-lg hover:bg-green-700">
                                        Donate
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 mt-8 rounded-lg bg-gray-50">
                            <p class="mb-2 text-sm text-gray-600">
                                <strong>Important:</strong> When making your donation, please include the project
                                reference:
                                <span class="font-bold text-[#008000]">{{ $project->id }}</span>
                            </p>
                            <p class="text-sm text-gray-600">
                                This helps us track donations and send you updates about this specific project.
                            </p>
                        </div>
                    </div>

                    <!-- Impact Information -->
                    <div>
                        <h3 class="mb-6 text-2xl font-bold text-gray-900">Your Impact</h3>

                        <div class="space-y-6">
                            <div class="p-6 rounded-lg bg-gray-50">
                                <h4 class="mb-2 font-semibold text-gray-900">Current Progress</h4>
                                <div class="flex justify-between mb-2 text-lg font-bold">
                                    <span class="text-[#008000]">KSh {{ $project->formatted_raised }}</span>
                                    <span class="text-gray-600">KSh {{ $project->formatted_goal }}</span>
                                </div>
                                <div class="w-full h-3 bg-gray-200 rounded-full">
                                    <div class="bg-[#000fff] h-3 rounded-full"
                                        style="width: {{ $project->progress_percentage }}%"></div>
                                </div>
                                <p class="mt-2 text-sm text-gray-600">
                                    {{ number_format($project->progress_percentage, 1) }}% of goal reached
                                </p>
                            </div>

                            <div class="p-6 rounded-lg bg-gray-50">
                                <h4 class="mb-3 font-semibold text-gray-900">How Your Donation Helps</h4>
                                <ul class="space-y-2 text-sm text-gray-700">
                                    <li class="flex items-start">
                                        <svg class="w-4 h-4 text-[#008000] mt-0.5 mr-2 flex-shrink-0"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Directly supports the {{ $project->type->name }} initiative
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="w-4 h-4 text-[#008000] mt-0.5 mr-2 flex-shrink-0"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Builds stronger community connections
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="w-4 h-4 text-[#008000] mt-0.5 mr-2 flex-shrink-0"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Creates lasting positive change
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="w-4 h-4 text-[#008000] mt-0.5 mr-2 flex-shrink-0"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Spreads God's love in practical ways
                                    </li>
                                </ul>
                            </div>

                            <div class="text-center p-4 bg-gradient-to-r from-[#008000]/10 to-green-100 rounded-lg">
                                <p class="text-sm italic text-gray-700">
                                    "Every donation, no matter the size, brings us closer to our goal and makes a
                                    meaningful difference in our community."
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
