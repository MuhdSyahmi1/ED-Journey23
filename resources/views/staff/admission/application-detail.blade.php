<x-layouts.app title="Application Review - {{ $application->user->name }}">

<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-slate-900 dark:to-slate-800 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Back Button and Header -->
        <div class="mb-6">
            <a href="{{ route('staff.admission.applications') }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 mb-4 inline-flex items-center">
                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Applications
            </a>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Application Review</h1>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
            
            <!-- Main Content -->
            <div class="xl:col-span-2 space-y-8">
                
                <!-- Student Information -->
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Student Information</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Full Name</label>
                            <div class="mt-1 text-lg font-medium text-gray-900 dark:text-white">{{ $application->user->name }}</div>
                        </div>
                        
                        <div>
                            <label class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Email</label>
                            <div class="mt-1 text-lg text-gray-900 dark:text-white">{{ $application->user->email }}</div>
                        </div>

                        @if($application->user->userProfile)
                            <div>
                                <label class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Phone Number</label>
                                <div class="mt-1 text-lg text-gray-900 dark:text-white">
                                    {{ $application->user->userProfile->phone_number ?? 'Not provided' }}
                                </div>
                            </div>
                            
                            <div>
                                <label class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Identification Card</label>
                                <div class="mt-1 text-lg text-gray-900 dark:text-white">
                                    {{ $application->user->userProfile->ic_passport_number ?? 'Not provided' }}
                                </div>
                            </div>

                            @if($application->user->userProfile->hecas_id)
                                <div>
                                    <label class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">HECAS ID</label>
                                    <div class="mt-1 text-lg text-gray-900 dark:text-white">
                                        {{ $application->user->userProfile->hecas_id }}
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>

                <!-- Application Details -->
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Application Details</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Programme Applied</label>
                            <div class="mt-1 text-lg font-medium text-gray-900 dark:text-white">
                                {{ $application->schoolProgramme->diplomaProgramme->name }}
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400 capitalize">
                                {{ $application->schoolProgramme->school }} School • {{ $application->schoolProgramme->duration }} years
                            </div>
                        </div>
                        
                        <div>
                            <label class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Application Preference</label>
                            <div class="mt-1">
                                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                                    {{ $application->getPreferenceText() }}
                                </span>
                            </div>
                        </div>
                        
                        <div>
                            <label class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Application Date</label>
                            <div class="mt-1 text-lg text-gray-900 dark:text-white">
                                {{ $application->applied_at->format('F d, Y \a\t g:i A') }}
                            </div>
                        </div>
                        
                        <div>
                            <label class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide">Current Status</label>
                            <div class="mt-1">
                                <span class="bg-{{ $application->getStatusColor() }}-100 text-{{ $application->getStatusColor() }}-800 px-3 py-1 rounded-full text-sm font-medium">
                                    {{ $application->getStatusText() }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- All Student Applications -->
                    @if($allApplications->count() > 1)
                        <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-3">All Student Applications</h3>
                            <div class="space-y-3">
                                @foreach($allApplications as $app)
                                    <div class="flex items-center justify-between p-3 {{ $app->id === $application->id ? 'bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-700' : 'bg-gray-50 dark:bg-gray-700' }} rounded-lg">
                                        <div>
                                            <div class="font-medium text-gray-900 dark:text-white">
                                                {{ $app->schoolProgramme->diplomaProgramme->name }}
                                            </div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $app->getPreferenceText() }} • {{ ucfirst($app->schoolProgramme->school) }} School
                                            </div>
                                        </div>
                                        <span class="bg-{{ $app->getStatusColor() }}-100 text-{{ $app->getStatusColor() }}-800 px-2 py-1 rounded-full text-xs font-medium">
                                            {{ $app->getStatusText() }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Qualification Analysis -->
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4">Qualification Analysis</h2>
                    
                    <div class="space-y-6">
                        <!-- Overall Match Score -->
                        <div class="text-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <div class="text-3xl font-bold mb-2 {{ $qualificationAnalysis['match_score'] >= 80 ? 'text-green-600' : ($qualificationAnalysis['match_score'] >= 60 ? 'text-yellow-600' : 'text-red-600') }}">
                                {{ round($qualificationAnalysis['match_score']) }}%
                            </div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Overall Match Score</div>
                        </div>

                        <!-- O-Level Path Analysis -->
                        @if(isset($qualificationAnalysis['olevel_path']))
                            <div class="border border-blue-200 dark:border-blue-700 rounded-lg p-4">
                                <div class="flex items-center justify-between mb-3">
                                    <h3 class="font-semibold text-blue-800 dark:text-blue-200">O-Level Path Analysis</h3>
                                    <div class="flex items-center">
                                        @if($qualificationAnalysis['olevel_path']['qualified'])
                                            <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span class="text-green-600 font-medium">Qualified</span>
                                        @else
                                            <svg class="w-5 h-5 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                            <span class="text-red-600 font-medium">Not Qualified</span>
                                        @endif
                                        <span class="ml-3 text-sm text-gray-600 dark:text-gray-400">
                                            ({{ round($qualificationAnalysis['olevel_path']['match_score']) }}% Match)
                                        </span>
                                    </div>
                                </div>

                                @if(count($qualificationAnalysis['olevel_path']['exceeded_requirements']) > 0)
                                    <div class="mb-3">
                                        <h4 class="text-sm font-medium text-green-700 dark:text-green-300 mb-2">Met Requirements:</h4>
                                        <ul class="text-sm text-gray-700 dark:text-gray-300 space-y-1">
                                            @foreach($qualificationAnalysis['olevel_path']['exceeded_requirements'] as $req)
                                                <li>• {{ $req }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if(count($qualificationAnalysis['olevel_path']['missing_requirements']) > 0)
                                    <div class="mb-3">
                                        <h4 class="text-sm font-medium text-red-700 dark:text-red-300 mb-2">Missing Requirements:</h4>
                                        <ul class="text-sm text-gray-700 dark:text-gray-300 space-y-1">
                                            @foreach($qualificationAnalysis['olevel_path']['missing_requirements'] as $req)
                                                <li>• {{ $req }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                {{-- View Image Button for O-Level Results --}}
                                @php
                                    $oLevelResult = $studentGrades->first(function($grade) {
                                        return ($grade->ocrResult && $grade->ocrResult->ocr_type === 'o_level') ||
                                               $grade->qualification === 'O-Level';
                                    });
                                @endphp
                                @if($oLevelResult && $oLevelResult->ocrResult && $oLevelResult->ocrResult->filename)
                                    <div class="mt-3 pt-3 border-t border-blue-200 dark:border-blue-700">
                                        <button onclick="toggleImage('olevel-application-image')" 
                                                class="text-sm text-blue-600 dark:text-blue-400 hover:underline">
                                            📸 View Original O-Level Results Image
                                        </button>
                                        <div id="olevel-application-image" class="hidden mt-4">
                                            <img src="{{ asset('storage/' . str_replace('\\', '/', $oLevelResult->ocrResult->filename)) }}" 
                                                 alt="O-Level Results" 
                                                 class="max-w-full h-auto rounded-lg border shadow-lg">
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                                                Original uploaded O-Level results document
                                            </p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif

                        <!-- HNTec Path Analysis -->
                        @if(isset($qualificationAnalysis['hntec_path']))
                            <div class="border border-purple-200 dark:border-purple-700 rounded-lg p-4">
                                <div class="flex items-center justify-between mb-3">
                                    <h3 class="font-semibold text-purple-800 dark:text-purple-200">HNTec Path Analysis</h3>
                                    <div class="flex items-center">
                                        @if($qualificationAnalysis['hntec_path']['qualified'])
                                            <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span class="text-green-600 font-medium">Qualified</span>
                                        @else
                                            <svg class="w-5 h-5 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                            <span class="text-red-600 font-medium">Not Qualified</span>
                                        @endif
                                        <span class="ml-3 text-sm text-gray-600 dark:text-gray-400">
                                            ({{ round($qualificationAnalysis['hntec_path']['match_score']) }}% Match)
                                        </span>
                                    </div>
                                </div>

                                @if(count($qualificationAnalysis['hntec_path']['exceeded_requirements']) > 0)
                                    <div class="mb-3">
                                        <h4 class="text-sm font-medium text-green-700 dark:text-green-300 mb-2">Met Requirements:</h4>
                                        <ul class="text-sm text-gray-700 dark:text-gray-300 space-y-1">
                                            @foreach($qualificationAnalysis['hntec_path']['exceeded_requirements'] as $req)
                                                <li>• {{ $req }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if(count($qualificationAnalysis['hntec_path']['missing_requirements']) > 0)
                                    <div class="mb-3">
                                        <h4 class="text-sm font-medium text-red-700 dark:text-red-300 mb-2">Missing Requirements:</h4>
                                        <ul class="text-sm text-gray-700 dark:text-gray-300 space-y-1">
                                            @foreach($qualificationAnalysis['hntec_path']['missing_requirements'] as $req)
                                                <li>• {{ $req }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                {{-- View Image Button for HNTec Results --}}
                                @php
                                    $hntecResultWithImage = $hntecResults->first(function($result) {
                                        return $result->ocrResult && $result->ocrResult->filename && $result->ocrResult->ocr_type === 'hntec';
                                    });
                                @endphp
                                @if($hntecResultWithImage && $hntecResultWithImage->ocrResult->filename)
                                    <div class="mt-3 pt-3 border-t border-purple-200 dark:border-purple-700">
                                        <button onclick="toggleImage('hntec-application-image')" 
                                                class="text-sm text-purple-600 dark:text-purple-400 hover:underline">
                                            📸 View Original HNTec Results Image
                                        </button>
                                        <div id="hntec-application-image" class="hidden mt-4">
                                            <img src="{{ asset('storage/' . str_replace('\\', '/', $hntecResultWithImage->ocrResult->filename)) }}" 
                                                 alt="HNTec Results" 
                                                 class="max-w-full h-auto rounded-lg border shadow-lg">
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                                                Original uploaded HNTec results document
                                            </p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>

            </div>

            <!-- Sidebar -->
            <div class="space-y-8">
                
                <!-- Decision Making -->
                @if($application->status === 'pending')
                    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Make Decision</h3>
                        
                        <form method="POST" action="{{ route('staff.admission.application.update-status', $application->id) }}">
                            @csrf
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Decision</label>
                                    <select name="status" required class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-slate-700 dark:text-white">
                                        <option value="">Select Decision</option>
                                        <option value="accepted">Accept</option>
                                        <option value="rejected">Reject</option>
                                        <option value="waitlisted">Waitlist</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Review Notes</label>
                                    <textarea name="review_notes" 
                                              rows="4" 
                                              placeholder="Add notes about your decision..."
                                              class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-slate-700 dark:text-white"></textarea>
                                </div>
                                
                                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg">
                                    Submit Decision
                                </button>
                            </div>
                        </form>
                    </div>
                @endif

                <!-- Review History -->
                @if($application->reviewed_at)
                    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Review History</h3>
                        
                        <div class="space-y-3">
                            <div class="flex items-center text-sm">
                                <span class="text-gray-500 dark:text-gray-400">Reviewed by:</span>
                                <span class="ml-2 font-medium text-gray-900 dark:text-white">
                                    {{ $application->reviewer->name ?? 'Unknown' }}
                                </span>
                            </div>
                            
                            <div class="flex items-center text-sm">
                                <span class="text-gray-500 dark:text-gray-400">Review date:</span>
                                <span class="ml-2 text-gray-900 dark:text-white">
                                    {{ $application->reviewed_at->format('F d, Y \a\t g:i A') }}
                                </span>
                            </div>
                            
                            @if($application->review_notes)
                                <div class="mt-4">
                                    <span class="text-gray-500 dark:text-gray-400 text-sm block mb-2">Review Notes:</span>
                                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-3 text-sm text-gray-900 dark:text-white">
                                        {{ $application->review_notes }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Quick Actions -->
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Quick Actions</h3>
                    
                    <div class="space-y-3">
                        <a href="mailto:{{ $application->user->email }}" 
                           class="w-full inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Email Student
                        </a>
                        
                        <a href="{{ route('user.recommendations') }}" 
                           class="w-full inline-flex items-center justify-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg text-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            View All Recommendations
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<script>
function toggleImage(imageId) {
    const imageDiv = document.getElementById(imageId);
    if (imageDiv.classList.contains('hidden')) {
        imageDiv.classList.remove('hidden');
    } else {
        imageDiv.classList.add('hidden');
    }
}
</script>

</x-layouts.app>