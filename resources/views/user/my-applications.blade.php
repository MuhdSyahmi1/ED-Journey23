<x-layouts.app title="My Applications">

<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 dark:from-slate-900 dark:to-blue-950 transition-colors duration-300">
    <div class="p-6">
        <div class="max-w-6xl mx-auto">
            
            <!-- Header -->
            <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden mb-8">
                <div class="bg-gradient-to-r from-blue-400/90 to-indigo-500/90 text-white text-center py-6">
                    <h1 class="text-3xl font-bold">MY APPLICATIONS</h1>
                    <p class="text-sm opacity-90 mt-2">Track the status of your programme applications</p>
                </div>
            </div>

        @if($applications->count() > 0)
            

            <!-- Applications List -->
            <div class="space-y-6">
                @foreach($applications as $application)
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden">
                        <!-- Application Header -->
                        <div class="p-8 border-b border-slate-200/60 dark:border-slate-700/60">
                            <div class="flex flex-col lg:flex-row lg:items-center justify-between">
                                <div class="mb-4 lg:mb-0">
                                    <div class="flex items-center mb-2">
                                        <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center mr-3">
                                            <span class="text-blue-600 dark:text-blue-400 font-bold">{{ $application->preference_rank }}</span>
                                        </div>
                                        <div>
                                            <h3 class="text-xl font-bold text-slate-900 dark:text-slate-100">
                                                {{ $application->schoolProgramme->diplomaProgramme->name }}
                                            </h3>
                                            <p class="text-sm text-slate-600 dark:text-slate-400">
                                                {{ $application->getPreferenceText() }} • {{ ucfirst($application->schoolProgramme->school) }} School
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="flex flex-col sm:flex-row gap-3">
                                    <span class="bg-{{ $application->getStatusColor() }}-100 text-{{ $application->getStatusColor() }}-800 px-3 py-2 rounded-full text-sm font-medium text-center">
                                        {{ $application->getStatusText() }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Application Details -->
                        <div class="p-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                                <div>
                                    <label class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wide">Applied Date</label>
                                    <div class="mt-1 text-sm text-slate-900 dark:text-slate-100">
                                        {{ $application->applied_at->format('M d, Y') }}
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wide">Duration</label>
                                    <div class="mt-1 text-sm text-slate-900 dark:text-slate-100">
                                        {{ $application->schoolProgramme->duration }} years
                                    </div>
                                </div>
                                
                                @if($application->reviewed_at)
                                <div>
                                    <label class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wide">Reviewed Date</label>
                                    <div class="mt-1 text-sm text-slate-900 dark:text-slate-100">
                                        {{ $application->reviewed_at->format('M d, Y') }}
                                    </div>
                                </div>
                                @endif
                                
                                <div>
                                    <label class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wide">School</label>
                                    <div class="mt-1 text-sm text-slate-900 dark:text-slate-100 capitalize">
                                        {{ $application->schoolProgramme->school }}
                                    </div>
                                </div>
                            </div>

                            <!-- Application Timeline -->
                            <div class="mb-6">
                                <h4 class="text-sm font-medium text-slate-900 dark:text-slate-100 mb-3">Application Timeline</h4>
                                <div class="flex items-center">
                                    <!-- Applied -->
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        <span class="ml-2 text-xs text-slate-600 dark:text-slate-400">Applied</span>
                                    </div>

                                    <!-- Line -->
                                    <div class="flex-1 h-0.5 mx-4 {{ $application->status !== 'pending' ? 'bg-blue-600' : 'bg-gray-300 dark:bg-gray-600' }}"></div>

                                    <!-- Under Review -->
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 {{ $application->status !== 'pending' ? 'bg-blue-600' : 'bg-yellow-500' }} rounded-full flex items-center justify-center">
                                            @if($application->status !== 'pending')
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            @else
                                                <svg class="w-4 h-4 text-white animate-spin" fill="none" viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                                </svg>
                                            @endif
                                        </div>
                                        <span class="ml-2 text-xs text-slate-600 dark:text-slate-400">{{ $application->status === 'pending' ? 'Under Review' : 'Reviewed' }}</span>
                                    </div>

                                    <!-- Line -->
                                    <div class="flex-1 h-0.5 mx-4 {{ in_array($application->status, ['accepted', 'rejected']) ? 'bg-blue-600' : 'bg-gray-300 dark:bg-gray-600' }}"></div>

                                    <!-- Decision -->
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 {{ $application->status === 'accepted' ? 'bg-green-600' : ($application->status === 'rejected' ? 'bg-red-600' : 'bg-gray-300 dark:bg-gray-600') }} rounded-full flex items-center justify-center">
                                            @if($application->status === 'accepted')
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            @elseif($application->status === 'rejected')
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            @else
                                                <div class="w-2 h-2 bg-gray-400 rounded-full"></div>
                                            @endif
                                        </div>
                                        <span class="ml-2 text-xs text-slate-600 dark:text-slate-400">Decision</span>
                                    </div>
                                </div>
                            </div>

                            @if($application->review_notes)
                                <!-- Review Notes -->
                                <div class="bg-slate-50 dark:bg-slate-700/50 rounded-xl p-4">
                                    <h4 class="text-sm font-medium text-slate-900 dark:text-slate-100 mb-2">Review Notes</h4>
                                    <p class="text-sm text-slate-700 dark:text-slate-300">{{ $application->review_notes }}</p>
                                </div>
                            @endif
                        </div>

                        <!-- Actions -->
                        @if($application->status === 'accepted')
                            <div class="bg-green-50 dark:bg-green-900/20 px-6 py-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-green-600 dark:text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span class="text-sm font-medium text-green-800 dark:text-green-200">Congratulations! Your application has been accepted, Please wait for further instructions that will be emailed to you soon!</span>
                                    </div>
                                </div>
                            </div>
                        @elseif($application->status === 'rejected')
                            <div class="bg-red-50 dark:bg-red-900/20 px-6 py-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-red-600 dark:text-red-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span class="text-sm font-medium text-red-800 dark:text-red-200">Unfortunately, your application was not successful this time.</span>
                                    </div>
                                    @php
                                        $existingAppeal = \App\Models\StudentAppeal::where('user_id', auth()->id())
                                            ->where('student_application_id', $application->id)
                                            ->first();
                                    @endphp
                                    @if($existingAppeal)
                                        <a href="{{ route('user.appeals.show', $existingAppeal->id) }}" 
                                           class="text-sm bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">
                                            View Appeal
                                        </a>
                                    @else
                                        <a href="{{ route('user.appeals.create', $application->id) }}" 
                                           class="text-sm text-red-600 dark:text-red-400 hover:underline">
                                            Appeal Decision
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

        @else
            <!-- No Applications State -->
            <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 p-8">
                <div class="text-center py-8">
                    <div class="max-w-md mx-auto">
                    <div class="w-24 h-24 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-12 h-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-medium text-slate-900 dark:text-slate-100 mb-2">No Applications Yet</h3>
                    <p class="text-slate-600 dark:text-slate-400 mb-6">
                        You haven't submitted any programme applications yet. Get started by exploring our recommendations.
                    </p>
                    <a href="{{ route('user.recommendations') }}" 
                       class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        View Recommendations
                    </a>
                    </div>
                </div>
            </div>
        @endif

        

    </div>
</div>

</x-layouts.app>