<x-layouts.app title="Application Submitted">

<div class="min-h-screen bg-gradient-to-br from-green-50 to-blue-100 dark:from-slate-900 dark:to-slate-800 py-6">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Success Header -->
        <div class="text-center mb-8">
            <div class="w-20 h-20 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">Applications Submitted Successfully!</h1>
            <p class="text-lg text-gray-600 dark:text-gray-300">Your programme applications are now awaiting approval</p>
        </div>

        <!-- Applications Overview -->
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg p-6 mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-6">Your Submitted Applications</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($applications as $application)
                    <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 hover:shadow-md transition-shadow">
                        <div class="flex justify-between items-start mb-3">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-blue-600 dark:text-blue-400 font-bold text-sm">{{ $application->preference_rank }}</span>
                                </div>
                                <span class="text-sm font-medium text-gray-600 dark:text-gray-400">{{ $application->getPreferenceText() }}</span>
                            </div>
                            <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs font-medium">
                                {{ $application->getStatusText() }}
                            </span>
                        </div>
                        
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">
                            {{ $application->schoolProgramme->diplomaProgramme->name }}
                        </h3>
                        
                        <div class="flex items-center text-sm text-gray-600 dark:text-gray-400 mb-2">
                            <span class="capitalize">{{ $application->schoolProgramme->school }} School</span>
                            <span class="mx-2">•</span>
                            <span>{{ $application->schoolProgramme->duration }} years</span>
                        </div>
                        
                        <p class="text-xs text-gray-500 dark:text-gray-500">
                            Submitted: {{ $application->applied_at->format('M d, Y \a\t g:i A') }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- What Happens Next -->
        <div class="bg-blue-50 dark:bg-blue-900/20 rounded-xl p-6 mb-8">
            <h3 class="text-xl font-semibold text-blue-900 dark:text-blue-100 mb-4">What Happens Next?</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="flex items-start">
                    <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                        <span class="text-white font-bold text-sm">1</span>
                    </div>
                    <div>
                        <h4 class="font-medium text-blue-900 dark:text-blue-100">Review Process</h4>
                        <p class="text-sm text-blue-700 dark:text-blue-200">Our admission team will review your applications and qualifications</p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                        <span class="text-white font-bold text-sm">2</span>
                    </div>
                    <div>
                        <h4 class="font-medium text-blue-900 dark:text-blue-100">Decision Made</h4>
                        <p class="text-sm text-blue-700 dark:text-blue-200">You'll receive an email notification with the admission decision</p>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                        <span class="text-white font-bold text-sm">3</span>
                    </div>
                    <div>
                        <h4 class="font-medium text-blue-900 dark:text-blue-100">Next Steps</h4>
                        <p class="text-sm text-blue-700 dark:text-blue-200">If accepted, you'll receive enrollment instructions and requirements</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Important Information -->
        <div class="bg-amber-50 dark:bg-amber-900/20 rounded-xl p-6 mb-8">
            <div class="flex items-start">
                <div class="w-8 h-8 bg-amber-400 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                    <svg class="w-5 h-5 text-amber-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="font-medium text-amber-900 dark:text-amber-100 mb-2">Important Notes</h4>
                    <ul class="text-sm text-amber-800 dark:text-amber-200 space-y-1">
                        <li>• Review process typically takes 5-10 business days</li>
                        <li>• Keep your contact information updated in your profile</li>
                        <li>• Check your email regularly for updates</li>
                        <li>• Applications are processed in order of preference (1st choice first)</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="text-center space-y-4 md:space-y-0 md:space-x-4 md:flex md:justify-center">
            <a href="{{ route('user.my-applications') }}" 
               class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                View My Applications
            </a>
            
            <a href="{{ route('user.recommendations') }}" 
               class="inline-flex items-center px-6 py-3 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Recommendations
            </a>
        </div>

        <!-- Contact Information -->
        <div class="text-center mt-8 p-4 bg-gray-50 dark:bg-gray-800/50 rounded-lg">
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Have questions about your application? Contact our admissions office at 
                <a href="mailto:admissions@example.com" class="text-blue-600 hover:underline">admissions@example.com</a>
                or call <a href="tel:+1234567890" class="text-blue-600 hover:underline">+123 456 7890</a>
            </p>
        </div>

    </div>
</div>

</x-layouts.app>