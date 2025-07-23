<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg">
    <!-- Status Messages -->
    @if($message)
        <div class="mb-6 p-4 rounded-lg {{ $messageType === 'success' ? 'bg-green-100 border border-green-400 text-green-700' : 'bg-red-100 border border-red-400 text-red-700' }}">
            <div class="flex items-center">
                @if($messageType === 'success')
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                @else
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                @endif
                {{ $message }}
            </div>
        </div>
    @endif

    <!-- Sitemap Status Card -->
    <div class="bg-gray-50 rounded-lg p-6 mb-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Sitemap Status</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Status -->
            <div class="text-center">
                <div class="text-sm text-gray-500 mb-1">Status</div>
                <div class="flex items-center justify-center">
                    @if($sitemapExists)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            Generated
                        </span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                            Not Generated
                        </span>
                    @endif
                </div>
            </div>

            <!-- Last Generated -->
            <div class="text-center">
                <div class="text-sm text-gray-500 mb-1">Last Generated</div>
                <div class="text-sm font-medium text-gray-900">
                    @if($lastGenerated)
                        {{ $lastGenerated->format('M j, Y') }}<br>
                        <span class="text-xs text-gray-500">{{ $lastGenerated->format('g:i A') }}</span>
                    @else
                        <span class="text-gray-400">Never</span>
                    @endif
                </div>
            </div>

            <!-- File Size -->
            <div class="text-center">
                <div class="text-sm text-gray-500 mb-1">File Size</div>
                <div class="text-sm font-medium text-gray-900">
                    {{ $sitemapSize ?? 'N/A' }}
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex flex-col sm:flex-row gap-4">
        <!-- Generate Button -->
        <button 
            wire:click="generateSitemap" 
            wire:loading.attr="disabled"
            class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed"
            @if($isGenerating) disabled @endif
        >
            <div wire:loading wire:target="generateSitemap" class="mr-2">
                <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>
            <div wire:loading.remove wire:target="generateSitemap">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
            </div>
            <span wire:loading.remove wire:target="generateSitemap">Generate Sitemap</span>
            <span wire:loading wire:target="generateSitemap">Generating...</span>
        </button>

        <!-- Download Button -->
        @if($sitemapExists)
            <button 
                wire:click="downloadSitemap"
                class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
            >
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Download Sitemap
            </button>
        @endif

        <!-- View Sitemap Link -->
        @if($sitemapExists)
            <a 
                href="{{ url('/sitemap.xml') }}" 
                target="_blank"
                class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
            >
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                </svg>
                View Sitemap
            </a>
        @endif

        <!-- Refresh Status -->
        <button 
            wire:click="checkSitemapStatus"
            class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
        >
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
            </svg>
            Refresh Status
        </button>
    </div>

    <!-- Information Section -->
    <div class="mt-8 bg-blue-50 rounded-lg p-6">
        <h4 class="text-sm font-medium text-blue-900 mb-2">Information</h4>
        <ul class="text-sm text-blue-800 space-y-1">
            <li>• The sitemap includes all public routes from your website</li>
            <li>• Generated sitemap will be available at: <code class="bg-blue-100 px-1 rounded">{{ url('/sitemap.xml') }}</code></li>
            <li>• Submit your sitemap to Google Search Console for better SEO indexing</li>
            <li>• It's recommended to regenerate the sitemap regularly or after content updates</li>
        </ul>
    </div>
</div>