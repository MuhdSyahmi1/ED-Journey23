<x-layouts.app title="Academic Advisor - Offline">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Academic Advisor') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 dark:from-slate-900 dark:to-blue-950 transition-colors duration-300">
        <div class="p-6">
            <div class="max-w-4xl mx-auto">
                
                <!-- Header -->
                <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden mb-8">
                    <div class="bg-gradient-to-r from-red-500/90 to-orange-500/90 text-white text-center py-4">
                        <h1 class="text-2xl font-bold flex items-center justify-center gap-2">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.728-.833-2.498 0L4.316 16.5c-.77.833.192 2.5 1.732 2.5z" />
                            </svg>
                            Academic Advisor Unavailable
                        </h1>
                        <p class="text-orange-100 text-sm">AI Service is currently offline</p>
                    </div>
                </div>

                <!-- Offline Message -->
                <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 p-8 text-center">
                    <div class="mb-6">
                        <svg class="w-20 h-20 mx-auto mb-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-slate-100 mb-4">AI Academic Advisor is Currently Offline</h2>
                    <p class="text-lg text-slate-700 dark:text-slate-300 mb-8 max-w-2xl mx-auto">
                        Our AI-powered Academic Advisor is temporarily unavailable. This could be because:
                    </p>
                    
                    <div class="grid md:grid-cols-2 gap-6 max-w-3xl mx-auto mb-8">
                        <div class="bg-slate-50 dark:bg-slate-700/50 rounded-xl p-6">
                            <svg class="w-8 h-8 text-blue-500 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                            </svg>
                            <h3 class="font-semibold text-slate-900 dark:text-slate-100 mb-2">System Maintenance</h3>
                            <p class="text-sm text-slate-600 dark:text-slate-400">The AI service is being updated or maintained</p>
                        </div>
                        
                        <div class="bg-slate-50 dark:bg-slate-700/50 rounded-xl p-6">
                            <svg class="w-8 h-8 text-orange-500 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="font-semibold text-slate-900 dark:text-slate-100 mb-2">Connection Issue</h3>
                            <p class="text-sm text-slate-600 dark:text-slate-400">Unable to connect to the AI service</p>
                        </div>
                    </div>

                    <!-- Alternative Options -->
                    <div class="bg-blue-50 dark:bg-blue-900/20 rounded-2xl p-6 mb-8">
                        <h3 class="text-lg font-semibold text-blue-800 dark:text-blue-200 mb-4">What You Can Do Instead</h3>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div class="text-left">
                                <div class="flex items-start gap-3 mb-3">
                                    <div class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                                        <span class="text-white text-sm font-bold">1</span>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-blue-800 dark:text-blue-200">Explore Schools Directly</h4>
                                        <p class="text-sm text-blue-700 dark:text-blue-300">Browse our 5 schools and their programmes</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                                        <span class="text-white text-sm font-bold">2</span>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-blue-800 dark:text-blue-200">Upload Your Results</h4>
                                        <p class="text-sm text-blue-700 dark:text-blue-300">Get programme recommendations based on your grades</p>
                                    </div>
                                </div>
                            </div>
                            <div class="text-left">
                                <div class="flex items-start gap-3 mb-3">
                                    <div class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                                        <span class="text-white text-sm font-bold">3</span>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-blue-800 dark:text-blue-200">Try Again Later</h4>
                                        <p class="text-sm text-blue-700 dark:text-blue-300">Refresh the page or return in a few minutes</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                                        <span class="text-white text-sm font-bold">4</span>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-blue-800 dark:text-blue-200">Contact Support</h4>
                                        <p class="text-sm text-blue-700 dark:text-blue-300">Report the issue if it persists</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-wrap gap-4 justify-center">
                        <button onclick="window.location.reload()" 
                                class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Try Again
                        </button>
                        <a href="{{ route('user.school') }}" 
                           class="bg-green-500 hover:bg-green-600 text-white font-semibold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200">
                            Explore Schools
                        </a>
                        <a href="{{ route('user.upload-result') }}" 
                           class="bg-purple-500 hover:bg-purple-600 text-white font-semibold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200">
                            Upload Results
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>