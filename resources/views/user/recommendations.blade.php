<x-layouts.app title="Programme Recommendations">

<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 dark:from-slate-900 dark:to-blue-950 transition-colors duration-300">
    <div class="p-6">
        <div class="max-w-7xl mx-auto">
            
            <!-- Header -->
            <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden mb-8">
                <div class="bg-gradient-to-r from-blue-400/90 to-indigo-500/90 text-white text-center py-6">
                    <h1 class="text-3xl font-bold">PROGRAMME RECOMMENDATIONS</h1>
                    <p class="text-sm opacity-90 mt-2">Discover the best programmes based on your qualifications</p>
                </div>
            </div>


        <!-- Student Qualifications Summary -->
        <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 p-8 mb-8">
            <h2 class="text-2xl font-semibold text-slate-900 dark:text-slate-100 mb-6">Your Qualifications</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- O-Level Qualifications -->
                <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-4">
                    <h3 class="font-semibold text-blue-800 dark:text-blue-200 mb-2">O-Level Results</h3>
                    @if($oLevelGrades->count() > 0)
                        <div class="space-y-1">
                            @foreach($oLevelGrades as $subject => $grade)
                                <div class="text-sm text-gray-700 dark:text-gray-300">
                                    {{ $subject }}: <span class="font-medium">{{ $grade->grade }}</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm text-gray-500 dark:text-gray-400">No O-Level results uploaded</p>
                    @endif
                </div>

                <!-- A-Level Qualifications -->
                <div class="bg-green-50 dark:bg-green-900/20 rounded-lg p-4">
                    <h3 class="font-semibold text-green-800 dark:text-green-200 mb-2">A-Level Results</h3>
                    @if($aLevelGrades->count() > 0)
                        <div class="space-y-1">
                            @foreach($aLevelGrades as $subject => $grade)
                                <div class="text-sm text-gray-700 dark:text-gray-300">
                                    {{ $subject }}: <span class="font-medium">{{ $grade->grade }}</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm text-gray-500 dark:text-gray-400">No A-Level results uploaded</p>
                    @endif
                </div>

                <!-- HNTec Qualifications -->
                <div class="bg-purple-50 dark:bg-purple-900/20 rounded-lg p-4">
                    <h3 class="font-semibold text-purple-800 dark:text-purple-200 mb-2">HNTec Results</h3>
                    @if($hntecGrades->count() > 0)
                        <div class="space-y-1">
                            @foreach($hntecGrades as $hntecResult)
                                <div class="text-sm text-gray-700 dark:text-gray-300">
                                    {{ $hntecResult->programme }}
                                    @if($hntecResult->cgpa)
                                        : <span class="font-medium">CGPA {{ number_format($hntecResult->cgpa, 2) }}</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm text-gray-500 dark:text-gray-400">No HNTec results uploaded</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Application Status -->
        @if($existingApplications->count() > 0)
            <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 p-8 mb-8">
                <h2 class="text-2xl font-semibold text-slate-900 dark:text-slate-100 mb-6">Your Applications</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($existingApplications as $application)
                        <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="font-medium text-gray-900 dark:text-white">{{ $application->schoolProgramme->diplomaProgramme->name }}</h3>
                                <span class="bg-{{ $application->getStatusColor() }}-100 text-{{ $application->getStatusColor() }}-800 px-2 py-1 rounded-full text-xs">
                                    {{ $application->getStatusText() }}
                                </span>
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $application->getPreferenceText() }} • {{ ucfirst($application->schoolProgramme->school) }} School</p>
                            <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">Applied: {{ $application->applied_at->format('M d, Y') }}</p>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4 p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                    <p class="text-sm text-blue-800 dark:text-blue-200">
                        <span class="font-medium">Application Status:</span> You have submitted {{ $existingApplications->count() }} of 2 maximum applications.
                    </p>
                </div>
            </div>
        @else
            <!-- Application Instructions -->
            <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 p-8 mb-8">
                <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl p-6 text-white">
                <h2 class="text-2xl font-bold mb-2">Ready to Apply?</h2>
                <p class="mb-4">You can apply for up to 2 programmes. Select your preferred programmes from the qualified lists below.</p>
                <div class="bg-white/10 rounded-lg p-4">
                    <div id="selected-programmes" class="hidden">
                        <h3 class="font-semibold mb-2">Selected Programmes:</h3>
                        <div id="programme-list" class="space-y-2 mb-4"></div>
                        <button type="button" id="submit-applications" class="bg-white text-blue-600 px-4 py-2 rounded-lg font-medium hover:bg-gray-100 transition-colors">
                            Submit Applications
                        </button>
                    </div>
                    <div id="no-selection" class="text-center">
                        <p>Select programmes below to start your application</p>
                    </div>
                </div>
                </div>
            </div>
        @endif

        <!-- Qualified Programmes -->
        @if(count($recommendations['qualified']) > 0)
            <div class="mb-8">
                <div class="flex items-center mb-4">
                    <div class="w-4 h-4 bg-green-500 rounded-full mr-3"></div>
                    <h2 class="text-2xl font-bold text-green-800 dark:text-green-400">
                        Qualified Programmes ({{ count($recommendations['qualified']) }})
                    </h2>
                </div>
                <p class="text-gray-600 dark:text-gray-300 mb-6">These programmes perfectly match your qualifications!</p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($recommendations['qualified'] as $item)
                        @php $programme = $item['programme']; $analysis = $item['analysis']; @endphp
                        <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border-2 border-green-200/60 dark:border-green-600/60 p-6 hover:shadow-2xl transition-all duration-300">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                                    <span class="text-sm font-medium text-green-700 dark:text-green-300">Perfect Match</span>
                                </div>
                                <div class="bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-200 px-2 py-1 rounded-full text-xs font-semibold">
                                    {{ round($analysis['match_score']) }}% Match
                                </div>
                            </div>
                            
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">
                                {{ $programme->diplomaProgramme->name }}
                            </h3>
                            
                            <div class="flex items-center text-sm text-gray-600 dark:text-gray-400 mb-4">
                                <span class="capitalize">{{ $programme->school }}</span>
                                <span class="mx-2">•</span>
                                <span>{{ $programme->duration }} years</span>
                            </div>

                            <!-- Qualification Paths -->
                            <div class="space-y-3 mb-4">
                                @if(isset($analysis['olevel_path']) && $analysis['olevel_path']['qualified'])
                                    <div class="bg-blue-50 dark:bg-blue-900/20 p-3 rounded-lg border border-blue-200 dark:border-blue-700">
                                        <div class="flex items-center justify-between mb-2">
                                            <p class="text-xs font-semibold text-blue-700 dark:text-blue-300">✓ O-Level Path Qualified</p>
                                            <span class="text-xs text-blue-600 dark:text-blue-400">{{ round($analysis['olevel_path']['match_score']) }}% Match</span>
                                        </div>
                                        @if(count($analysis['olevel_path']['exceeded_requirements']) > 0)
                                            <div class="space-y-1">
                                                @foreach(array_slice($analysis['olevel_path']['exceeded_requirements'], 0, 2) as $req)
                                                    <p class="text-xs text-gray-600 dark:text-gray-400">• {{ $req }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                @endif
                                
                                @if(isset($analysis['hntec_path']) && $analysis['hntec_path']['qualified'])
                                    <div class="bg-purple-50 dark:bg-purple-900/20 p-3 rounded-lg border border-purple-200 dark:border-purple-700">
                                        <div class="flex items-center justify-between mb-2">
                                            <p class="text-xs font-semibold text-purple-700 dark:text-purple-300">✓ HNTec Path Qualified</p>
                                            <span class="text-xs text-purple-600 dark:text-purple-400">{{ round($analysis['hntec_path']['match_score']) }}% Match</span>
                                        </div>
                                        @if(count($analysis['hntec_path']['exceeded_requirements']) > 0)
                                            <div class="space-y-1">
                                                @foreach(array_slice($analysis['hntec_path']['exceeded_requirements'], 0, 2) as $req)
                                                    <p class="text-xs text-gray-600 dark:text-gray-400">• {{ $req }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            </div>
                            
                            @if($existingApplications->count() == 0)
                                <button type="button" 
                                        class="apply-btn w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition-colors mt-4"
                                        data-programme-id="{{ $programme->id }}"
                                        data-programme-name="{{ $programme->diplomaProgramme->name }}"
                                        data-school="{{ ucfirst($programme->school) }}">
                                    Apply for this Programme
                                </button>
                            @else
                                @php
                                    $hasApplied = $existingApplications->contains('school_programme_id', $programme->id);
                                @endphp
                                @if($hasApplied)
                                    <div class="w-full bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 font-medium py-2 px-4 rounded-lg mt-4 text-center">
                                        ✓ Applied
                                    </div>
                                @endif
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Non-Tailored Qualified Programmes -->
        @if(count($recommendations['non_tailored_qualified']) > 0)
            <div class="mb-8">
                <div class="flex items-center mb-4">
                    <div class="w-4 h-4 bg-yellow-500 rounded-full mr-3"></div>
                    <h2 class="text-2xl font-bold text-yellow-800 dark:text-yellow-400">
                        Non-Tailored Qualified Programmes ({{ count($recommendations['non_tailored_qualified']) }})
                    </h2>
                </div>
                <p class="text-gray-600 dark:text-gray-300 mb-6">You meet the basic requirements but may benefit from additional preparation.</p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($recommendations['non_tailored_qualified'] as $item)
                        @php $programme = $item['programme']; $analysis = $item['analysis']; @endphp
                        <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border-2 border-yellow-200/60 dark:border-yellow-600/60 p-6 hover:shadow-2xl transition-all duration-300">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-yellow-500 rounded-full mr-2"></div>
                                    <span class="text-sm font-medium text-yellow-700 dark:text-yellow-300">Partially Matched</span>
                                </div>
                                <div class="bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-200 px-2 py-1 rounded-full text-xs font-semibold">
                                    {{ round($analysis['match_score']) }}% Match
                                </div>
                            </div>
                            
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">
                                {{ $programme->diplomaProgramme->name }}
                            </h3>
                            
                            <div class="flex items-center text-sm text-gray-600 dark:text-gray-400 mb-4">
                                <span class="capitalize">{{ $programme->school }}</span>
                                <span class="mx-2">•</span>
                                <span>{{ $programme->duration }} years</span>
                            </div>

                            <!-- Qualification Paths -->
                            <div class="space-y-2 mb-3">
                                @if(isset($analysis['olevel_path']) && $analysis['olevel_path']['compulsory_met'])
                                    <div class="bg-blue-50 dark:bg-blue-900/20 p-2 rounded border border-blue-200 dark:border-blue-700">
                                        <p class="text-xs font-semibold text-blue-700 dark:text-blue-300 mb-1">✓ O-Level Requirements Met ({{ round($analysis['olevel_path']['match_score']) }}%)</p>
                                        @if(count($analysis['olevel_path']['exceeded_requirements']) > 0)
                                            <p class="text-xs text-gray-600 dark:text-gray-400">• {{ array_slice($analysis['olevel_path']['exceeded_requirements'], 0, 1)[0] ?? '' }}</p>
                                        @endif
                                    </div>
                                @endif
                                
                                @if(isset($analysis['hntec_path']) && $analysis['hntec_path']['compulsory_met'])
                                    <div class="bg-purple-50 dark:bg-purple-900/20 p-2 rounded border border-purple-200 dark:border-purple-700">
                                        <p class="text-xs font-semibold text-purple-700 dark:text-purple-300 mb-1">✓ HNTec Requirements Met ({{ round($analysis['hntec_path']['match_score']) }}%)</p>
                                        @if(count($analysis['hntec_path']['exceeded_requirements']) > 0)
                                            <p class="text-xs text-gray-600 dark:text-gray-400">• {{ array_slice($analysis['hntec_path']['exceeded_requirements'], 0, 1)[0] ?? '' }}</p>
                                        @endif
                                    </div>
                                @endif
                            </div>
                            
                            @if($existingApplications->count() == 0)
                                <button type="button" 
                                        class="apply-btn w-full bg-yellow-600 hover:bg-yellow-700 text-white font-medium py-2 px-4 rounded-lg transition-colors mt-4"
                                        data-programme-id="{{ $programme->id }}"
                                        data-programme-name="{{ $programme->diplomaProgramme->name }}"
                                        data-school="{{ ucfirst($programme->school) }}">
                                    Apply for this Programme
                                </button>
                            @else
                                @php
                                    $hasApplied = $existingApplications->contains('school_programme_id', $programme->id);
                                @endphp
                                @if($hasApplied)
                                    <div class="w-full bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 font-medium py-2 px-4 rounded-lg mt-4 text-center">
                                        ✓ Applied
                                    </div>
                                @endif
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Non-Qualified Programmes -->
        @if(count($recommendations['non_qualified']) > 0)
            <div class="mb-8">
                <div class="flex items-center mb-4">
                    <div class="w-4 h-4 bg-red-500 rounded-full mr-3"></div>
                    <h2 class="text-2xl font-bold text-red-800 dark:text-red-400">
                        Non-Qualified Programmes ({{ count($recommendations['non_qualified']) }})
                    </h2>
                </div>
                <p class="text-gray-600 dark:text-gray-300 mb-6">These programmes require additional qualifications. Consider them as future goals!</p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach(array_slice($recommendations['non_qualified'], 0, 9) as $item)
                        @php $programme = $item['programme']; $analysis = $item['analysis']; @endphp
                        <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border-2 border-red-200/60 dark:border-red-600/60 p-6 hover:shadow-2xl transition-all duration-300 opacity-75">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 bg-red-500 rounded-full mr-2"></div>
                                    <span class="text-sm font-medium text-red-700 dark:text-red-300">Not Qualified</span>
                                </div>
                                <div class="bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-200 px-2 py-1 rounded-full text-xs font-semibold">
                                    {{ round($analysis['match_score']) }}% Match
                                </div>
                            </div>
                            
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">
                                {{ $programme->diplomaProgramme->name }}
                            </h3>
                            
                            <div class="flex items-center text-sm text-gray-600 dark:text-gray-400 mb-4">
                                <span class="capitalize">{{ $programme->school }}</span>
                                <span class="mx-2">•</span>
                                <span>{{ $programme->duration }} years</span>
                            </div>

                            <!-- Missing Requirements by Path -->
                            <div class="space-y-2 mb-3">
                                @if(isset($analysis['olevel_path']) && !$analysis['olevel_path']['compulsory_met'])
                                    <div class="bg-red-50 dark:bg-red-900/20 p-2 rounded border border-red-200 dark:border-red-700">
                                        <p class="text-xs font-semibold text-red-700 dark:text-red-300 mb-1">⚠ O-Level Subjects Missing:</p>
                                        @if(count($analysis['olevel_path']['missing_requirements']) > 0)
                                            @foreach(array_slice($analysis['olevel_path']['missing_requirements'], 0, 2) as $req)
                                                <p class="text-xs text-gray-600 dark:text-gray-400">• {{ $req }}</p>
                                            @endforeach
                                        @endif
                                    </div>
                                @endif
                                
                                @if(isset($analysis['hntec_path']) && !$analysis['hntec_path']['compulsory_met'])
                                    <div class="bg-orange-50 dark:bg-orange-900/20 p-2 rounded border border-orange-200 dark:border-orange-700">
                                        <p class="text-xs font-semibold text-orange-700 dark:text-orange-300 mb-1">⚠ HNTec Subjects Missing:</p>
                                        @if(count($analysis['hntec_path']['missing_requirements']) > 0)
                                            @foreach(array_slice($analysis['hntec_path']['missing_requirements'], 0, 2) as $req)
                                                <p class="text-xs text-gray-600 dark:text-gray-400">• {{ $req }}</p>
                                            @endforeach
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                
                @if(count($recommendations['non_qualified']) > 9)
                    <div class="text-center mt-4">
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Showing 9 of {{ count($recommendations['non_qualified']) }} non-qualified programmes
                        </p>
                    </div>
                @endif
            </div>
        @endif


        <!-- No Data State -->
        @if(count($recommendations['qualified']) == 0 && count($recommendations['non_tailored_qualified']) == 0 && count($recommendations['non_qualified']) == 0)
            <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 p-8">
                <div class="text-center py-8">
                    <div class="max-w-md mx-auto">
                    <div class="w-24 h-24 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-12 h-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">No Programmes Found</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                        We couldn't find any programmes to recommend. This might be because:
                    </p>
                    <ul class="text-left text-sm text-gray-500 dark:text-gray-400 space-y-1">
                        <li>• No academic results have been uploaded yet</li>
                        <li>• No programmes are currently active</li>
                        <li>• Programme requirements haven't been set up</li>
                    </ul>
                    <div class="mt-6">
                        <a href="{{ route('user.upload-result') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                            Upload Your Results
                        </a>
                    </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Application Confirmation Modal -->
<div id="confirmation-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white/90 dark:bg-slate-800/90 backdrop-blur-sm rounded-2xl shadow-2xl border border-slate-200/60 dark:border-slate-700/60 max-w-md w-full mx-4">
        <div class="p-8">
            <h3 class="text-xl font-semibold text-slate-900 dark:text-slate-100 mb-4">Confirm Application Submission</h3>
            <p class="text-slate-600 dark:text-slate-300 mb-4">You are about to apply for the following programmes:</p>
            <div id="modal-programme-list" class="bg-gray-50 dark:bg-gray-700 rounded-lg p-3 mb-4"></div>
            <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-700 rounded-lg p-3 mb-6">
                <p class="text-sm text-yellow-800 dark:text-yellow-200">
                    <strong>Warning:</strong> You can only apply for 2 programmes maximum. This action cannot be undone.
                </p>
            </div>
            <div class="flex gap-3">
                <button type="button" id="cancel-application" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-700 font-medium py-2 px-4 rounded-lg transition-colors">
                    Cancel
                </button>
                <button type="button" id="confirm-application" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                    Submit Applications
                </button>
            </div>
        </div>
    </div>
</div>

<form id="application-form" action="{{ route('user.applications.store') }}" method="POST" class="hidden">
    @csrf
    <div id="programme-inputs"></div>
</form>

{{-- Include external JavaScript for applications --}}
<script src="{{ asset('js/student-applications.js') }}"></script>

</x-layouts.app>