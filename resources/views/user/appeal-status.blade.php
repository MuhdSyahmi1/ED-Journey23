<x-layouts.app title="Appeal Status">

<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-slate-900 dark:to-slate-800 py-6">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Page Header -->
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Appeal Status</h1>
                <p class="text-lg text-gray-600 dark:text-gray-300">Track your application appeal progress</p>
            </div>
            <a href="{{ route('user.my-applications') }}" 
               class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                Back to Applications
            </a>
        </div>

        <!-- Current Status -->
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-6 mb-8">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Current Status</h3>
            <div class="flex items-center justify-center py-8">
                <div class="text-center">
                    <span class="bg-{{ $appeal->status_color }}-100 text-{{ $appeal->status_color }}-800 px-6 py-3 rounded-full text-lg font-medium">
                        {{ $appeal->status_text }}
                    </span>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                        Appeal submitted on {{ $appeal->created_at->format('F j, Y') }}
                    </p>
                    @if($appeal->reviewer)
                        <p class="text-xs text-gray-500 mt-1">
                            Reviewed by {{ $appeal->reviewer->name }} on {{ $appeal->reviewed_at->format('F j, Y') }}
                        </p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Progress Timeline -->
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-6 mb-8">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Appeal Progress</h3>
            <div class="relative">
                <!-- Timeline -->
                <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-gray-200 dark:bg-gray-600"></div>
                
                <!-- Step 1: Submitted -->
                <div class="relative flex items-center mb-6">
                    <div class="flex items-center justify-center w-8 h-8 bg-green-500 rounded-full z-10">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h4 class="font-medium text-gray-900 dark:text-white">Appeal Submitted</h4>
                        <p class="text-sm text-gray-500">{{ $appeal->created_at->format('F j, Y \a\t g:i A') }}</p>
                    </div>
                </div>

                <!-- Step 2: Under Review -->
                <div class="relative flex items-center mb-6">
                    @if(in_array($appeal->status, ['under_review', 'approved', 'rejected']))
                        <div class="flex items-center justify-center w-8 h-8 bg-blue-500 rounded-full z-10">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    @else
                        <div class="flex items-center justify-center w-8 h-8 bg-gray-300 dark:bg-gray-600 rounded-full z-10">
                            <div class="w-2 h-2 bg-white rounded-full"></div>
                        </div>
                    @endif
                    <div class="ml-4">
                        <h4 class="font-medium text-gray-900 dark:text-white">Under Review</h4>
                        <p class="text-sm text-gray-500">
                            @if(in_array($appeal->status, ['under_review', 'approved', 'rejected']))
                                Being reviewed by admission team
                            @else
                                Waiting for review
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Step 3: Decision -->
                <div class="relative flex items-center">
                    @if($appeal->status === 'approved')
                        <div class="flex items-center justify-center w-8 h-8 bg-green-500 rounded-full z-10">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    @elseif($appeal->status === 'rejected')
                        <div class="flex items-center justify-center w-8 h-8 bg-red-500 rounded-full z-10">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    @else
                        <div class="flex items-center justify-center w-8 h-8 bg-gray-300 dark:bg-gray-600 rounded-full z-10">
                            <div class="w-2 h-2 bg-white rounded-full"></div>
                        </div>
                    @endif
                    <div class="ml-4">
                        <h4 class="font-medium text-gray-900 dark:text-white">Decision</h4>
                        <p class="text-sm text-gray-500">
                            @if($appeal->status === 'approved')
                                Appeal approved - Application accepted
                            @elseif($appeal->status === 'rejected')
                                Appeal rejected
                            @else
                                Pending decision
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Appeal Details -->
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-6 mb-8">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Appeal Details</h3>
            
            <!-- Application Info -->
            <div class="border-b border-gray-200 dark:border-gray-600 pb-4 mb-4">
                <h4 class="font-medium text-gray-900 dark:text-white mb-2">Application Information</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="text-gray-500 dark:text-gray-400">Programme:</span>
                        <span class="ml-2 text-gray-900 dark:text-white">
                            {{ $appeal->studentApplication->schoolProgramme->diplomaProgramme->name }}
                        </span>
                    </div>
                    <div>
                        <span class="text-gray-500 dark:text-gray-400">School:</span>
                        <span class="ml-2 text-gray-900 dark:text-white">
                            {{ ucfirst($appeal->studentApplication->schoolProgramme->school) }} School
                        </span>
                    </div>
                </div>
            </div>

            <!-- Appeal Reason -->
            <div class="mb-4">
                <h4 class="font-medium text-gray-900 dark:text-white mb-2">Your Appeal Reason</h4>
                <div class="bg-gray-50 dark:bg-slate-700 p-4 rounded-lg">
                    <p class="text-gray-900 dark:text-white whitespace-pre-wrap">{{ $appeal->appeal_reason }}</p>
                </div>
            </div>

            <!-- Supporting Documents -->
            @if($appeal->supporting_documents && count($appeal->supporting_documents) > 0)
                <div class="mb-4">
                    <h4 class="font-medium text-gray-900 dark:text-white mb-2">Supporting Documents</h4>
                    <div class="space-y-2">
                        @foreach($appeal->supporting_documents as $document)
                            <div class="flex items-center p-3 bg-gray-50 dark:bg-slate-700 rounded-lg">
                                <svg class="w-5 h-5 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <span class="text-gray-900 dark:text-white">{{ basename($document) }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <!-- Admin Response (if available) -->
        @if($appeal->admin_response)
            <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Admin Response</h3>
                <div class="bg-gray-50 dark:bg-slate-700 p-4 rounded-lg">
                    <p class="text-gray-900 dark:text-white whitespace-pre-wrap">{{ $appeal->admin_response }}</p>
                </div>
                @if($appeal->reviewed_at)
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                        Reviewed on {{ $appeal->reviewed_at->format('F j, Y \a\t g:i A') }}
                    </p>
                @endif
            </div>
        @endif

    </div>
</div>

</x-layouts.app>