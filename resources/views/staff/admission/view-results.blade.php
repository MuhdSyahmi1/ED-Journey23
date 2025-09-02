<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('View Student Results') }} - {{ $user->name }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 dark:from-slate-900 dark:to-blue-950 transition-colors duration-300">
        <div class="p-6">
            <div class="max-w-7xl mx-auto">
                
                <!-- Success/Error Messages -->
                @if(session('success'))
                    <div class="mb-6 bg-green-50 dark:bg-green-900/20 border-2 border-green-200 dark:border-green-700 rounded-xl p-4">
                        <div class="flex items-center gap-3">
                            <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-green-800 dark:text-green-200 font-medium">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 bg-red-50 dark:bg-red-900/20 border-2 border-red-200 dark:border-red-700 rounded-xl p-4">
                        <div class="flex items-center gap-3">
                            <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-red-800 dark:text-red-200 font-medium">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif

                <!-- Header with Student Info and Case Status -->
                <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden mb-6">
                    <div class="bg-gradient-to-r from-blue-400/90 to-purple-500/90 text-white px-8 py-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mr-4">
                                    <span class="text-xl font-bold">{{ substr($user->name, 0, 2) }}</span>
                                </div>
                                <div>
                                    <h1 class="text-2xl font-bold">{{ $user->name }}</h1>
                                    <p class="text-sm opacity-90">{{ $user->email }} | ID: {{ $user->id }}</p>
                                </div>
                            </div>
                            
                            @if($caseReport)
                                <div class="text-right">
                                    <div class="text-sm opacity-90 mb-2">Case Status</div>
                                    <div id="case-status-container">
                                        <select onchange="updateCaseStatus({{ $caseReport->id }}, this.value)" 
                                                class="text-sm rounded-full border-0 px-3 py-1 font-medium
                                                    @if($caseReport->status == 'pending') bg-red-100 text-red-800
                                                    @elseif($caseReport->status == 'in progress') bg-orange-100 text-orange-800  
                                                    @else bg-green-100 text-green-800 @endif">
                                            <option value="pending" {{ $caseReport->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="in progress" {{ $caseReport->status == 'in progress' ? 'selected' : '' }}>In Progress</option>
                                            <option value="solved" {{ $caseReport->status == 'solved' ? 'selected' : '' }}>Solved</option>
                                        </select>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-xl shadow-sm border border-slate-200/60 dark:border-slate-700/60 mb-6 p-4">
                    <div class="flex items-center justify-between">
                        <div class="flex space-x-4">
                            <button onclick="showSection('olevel')" id="btn-olevel" 
                                    class="px-4 py-2 rounded-lg font-medium transition-colors bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300">
                                O-Level Results
                            </button>
                            <button onclick="showSection('alevel')" id="btn-alevel" 
                                    class="px-4 py-2 rounded-lg font-medium transition-colors text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-700">
                                A-Level Results
                            </button>
                            <button onclick="showSection('hntec')" id="btn-hntec" 
                                    class="px-4 py-2 rounded-lg font-medium transition-colors text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-700">
                                HNTEC Results
                            </button>
                        </div>
                        
                        <a href="{{ route('staff.case-reports') }}" 
                           class="px-4 py-2 bg-slate-500 hover:bg-slate-600 text-white rounded-lg transition-colors">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Back to Case Reports
                        </a>
                    </div>
                </div>

                <!-- O-Level Results Section -->
                <div id="section-olevel" class="results-section">
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden">
                        <div class="bg-gradient-to-r from-blue-400/90 to-blue-500/90 text-white px-8 py-6">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center mr-4">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-2xl font-bold">O-LEVEL RESULTS</h3>
                                        <p class="text-sm opacity-90">Cambridge O-Level Grades</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-3xl font-bold">{{ $oLevelResults && $oLevelResults->studentGrades ? $oLevelResults->studentGrades->count() : 0 }}</div>
                                    <div class="text-sm opacity-90">Subjects Found</div>
                                </div>
                            </div>
                        </div>

                        @if($oLevelResults && $oLevelResults->studentGrades && $oLevelResults->studentGrades->count() > 0)
                            <!-- Show Original Uploaded Image -->
                            @if($oLevelResults->filename)
                                <div class="px-8 py-4 bg-slate-50 dark:bg-slate-700/50 border-b border-slate-200 dark:border-slate-700">
                                    <button onclick="toggleImage('olevel-image')" 
                                            class="text-sm text-blue-600 dark:text-blue-400 hover:underline">
                                        📸 View Original Uploaded Image
                                    </button>
                                    <div id="olevel-image" class="hidden mt-4">
                                        <img src="{{ asset('storage/' . str_replace('\\', '/', $oLevelResults->filename)) }}" 
                                             alt="O-Level Grade Sheet" 
                                             class="max-w-full h-auto rounded-lg shadow-md">
                                    </div>
                                </div>
                            @endif
                            
                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead class="bg-slate-50 dark:bg-slate-700/50">
                                        <tr>
                                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">SUBJECT</th>
                                            <th class="px-6 py-4 text-center text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">GRADE</th>
                                            <th class="px-6 py-4 text-center text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">SYLLABUS</th>
                                            <th class="px-6 py-4 text-center text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">CONFIDENCE</th>
                                            <th class="px-6 py-4 text-center text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">ACTIONS</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                                        @foreach($oLevelResults->studentGrades as $grade)
                                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <input type="text" value="{{ $grade->subject }}" 
                                                       class="font-medium text-slate-900 dark:text-slate-100 bg-transparent border-0 p-0 subject-input"
                                                       data-grade-id="{{ $grade->id }}" data-field="subject" readonly>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                <div class="flex flex-col items-center">
                                                    <input type="text" value="{{ $grade->grade }}" 
                                                           class="inline-flex items-center justify-center w-12 text-center text-lg font-bold bg-transparent border-0 p-1 grade-input text-slate-900 dark:text-slate-100"
                                                           data-grade-id="{{ $grade->id }}" data-field="grade" readonly>
                                                    <div class="text-xs mt-1 px-2 py-1 rounded {{ $grade->getGradeColor() }}">{{ $grade->getGradeDescription() }}</div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                <input type="text" value="{{ $grade->syllabus ?? '' }}" 
                                                       class="text-sm font-medium text-center bg-transparent border-0 p-1 syllabus-input"
                                                       data-grade-id="{{ $grade->id }}" data-field="syllabus" readonly>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                <div class="flex flex-col items-center">
                                                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                                                        {{ number_format($grade->confidence * 100, 1) }}%
                                                    </span>
                                                    <div class="w-16 bg-slate-200 dark:bg-slate-600 rounded-full h-2">
                                                        <div class="bg-gradient-to-r from-blue-400 to-blue-600 h-2 rounded-full" 
                                                             style="width: {{ $grade->confidence * 100 }}%"></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                <button onclick="editGrade({{ $grade->id }}, 'student_grade')" 
                                                        class="edit-btn-{{ $grade->id }} text-blue-600 hover:text-blue-800 mr-2">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                                    </svg>
                                                </button>
                                                <button onclick="saveGrade({{ $grade->id }}, 'student_grade')" 
                                                        class="save-btn-{{ $grade->id }} text-green-600 hover:text-green-800 mr-2 hidden">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                    </svg>
                                                </button>
                                                <button onclick="cancelEdit({{ $grade->id }})" 
                                                        class="cancel-btn-{{ $grade->id }} text-red-600 hover:text-red-800 hidden">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                    </svg>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="p-12 text-center">
                                <svg class="w-16 h-16 text-slate-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <h4 class="text-lg font-medium text-slate-600 dark:text-slate-400 mb-2">No O-Level Results Found</h4>
                                <p class="text-slate-500">This student hasn't uploaded O-Level results yet</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- A-Level Results Section -->
                <div id="section-alevel" class="results-section hidden">
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden">
                        <div class="bg-gradient-to-r from-green-400/90 to-green-500/90 text-white px-8 py-6">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center mr-4">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-2xl font-bold">A-LEVEL RESULTS</h3>
                                        <p class="text-sm opacity-90">Cambridge A-Level Grades</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-3xl font-bold">{{ $aLevelResults && $aLevelResults->studentGrades ? $aLevelResults->studentGrades->count() : 0 }}</div>
                                    <div class="text-sm opacity-90">Subjects Found</div>
                                </div>
                            </div>
                        </div>

                        @if($aLevelResults && $aLevelResults->studentGrades && $aLevelResults->studentGrades->count() > 0)
                            <!-- Show Original Uploaded Image -->
                            @if($aLevelResults->filename)
                                <div class="px-8 py-4 bg-slate-50 dark:bg-slate-700/50 border-b border-slate-200 dark:border-slate-700">
                                    <button onclick="toggleImage('alevel-image')" 
                                            class="text-sm text-blue-600 dark:text-blue-400 hover:underline">
                                        📸 View Original Uploaded Image
                                    </button>
                                    <div id="alevel-image" class="hidden mt-4">
                                        <img src="{{ asset('storage/' . str_replace('\\', '/', $aLevelResults->filename)) }}" 
                                             alt="A-Level Grade Sheet" 
                                             class="max-w-full h-auto rounded-lg shadow-md">
                                    </div>
                                </div>
                            @endif

                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead class="bg-slate-50 dark:bg-slate-700/50">
                                        <tr>
                                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">SUBJECT</th>
                                            <th class="px-6 py-4 text-center text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">GRADE</th>
                                            <th class="px-6 py-4 text-center text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">QUALIFICATION</th>
                                            <th class="px-6 py-4 text-center text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">SYLLABUS</th>
                                            <th class="px-6 py-4 text-center text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">CONFIDENCE</th>
                                            <th class="px-6 py-4 text-center text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">ACTIONS</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                                        @foreach($aLevelResults->studentGrades as $grade)
                                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <input type="text" value="{{ $grade->subject }}" 
                                                       class="font-medium text-slate-900 dark:text-slate-100 bg-transparent border-0 p-0 subject-input"
                                                       data-grade-id="{{ $grade->id }}" data-field="subject" readonly>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                <div class="flex flex-col items-center">
                                                    <input type="text" value="{{ $grade->grade }}" 
                                                           class="inline-flex items-center justify-center w-12 text-center text-lg font-bold bg-transparent border-0 p-1 grade-input text-slate-900 dark:text-slate-100"
                                                           data-grade-id="{{ $grade->id }}" data-field="grade" readonly>
                                                    <div class="text-xs mt-1 px-2 py-1 rounded {{ $grade->getGradeColor() }}">{{ $grade->getGradeDescription() }}</div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                <span class="text-sm font-medium text-slate-700 dark:text-slate-300">
                                                    {{ $grade->qualification ?? 'Advanced Level' }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                <input type="text" value="{{ $grade->syllabus ?? '' }}" 
                                                       class="text-sm font-medium text-center bg-transparent border-0 p-1 syllabus-input"
                                                       data-grade-id="{{ $grade->id }}" data-field="syllabus" readonly>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                <div class="flex flex-col items-center">
                                                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                                                        {{ number_format($grade->confidence * 100, 1) }}%
                                                    </span>
                                                    <div class="w-16 bg-slate-200 dark:bg-slate-600 rounded-full h-2">
                                                        <div class="bg-gradient-to-r from-green-400 to-green-600 h-2 rounded-full" 
                                                             style="width: {{ $grade->confidence * 100 }}%"></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                <button onclick="editGrade({{ $grade->id }}, 'student_grade')" 
                                                        class="edit-btn-{{ $grade->id }} text-blue-600 hover:text-blue-800 mr-2">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                                    </svg>
                                                </button>
                                                <button onclick="saveGrade({{ $grade->id }}, 'student_grade')" 
                                                        class="save-btn-{{ $grade->id }} text-green-600 hover:text-green-800 mr-2 hidden">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                    </svg>
                                                </button>
                                                <button onclick="cancelEdit({{ $grade->id }})" 
                                                        class="cancel-btn-{{ $grade->id }} text-red-600 hover:text-red-800 hidden">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                    </svg>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="p-12 text-center">
                                <svg class="w-16 h-16 text-slate-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <h4 class="text-lg font-medium text-slate-600 dark:text-slate-400 mb-2">No A-Level Results Found</h4>
                                <p class="text-slate-500">This student hasn't uploaded A-Level results yet</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- HNTEC Results Section -->
                <div id="section-hntec" class="results-section hidden">
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden">
                        <div class="bg-gradient-to-r from-purple-400/90 to-purple-500/90 text-white px-8 py-6">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center mr-4">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"/>
                                            <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-2xl font-bold">HNTEC RESULTS</h3>
                                        <p class="text-sm opacity-90">Higher NTEC Grades</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-3xl font-bold">{{ $hntecResults ? $hntecResults->count() : 0 }}</div>
                                    <div class="text-sm opacity-90">Programmes Found</div>
                                </div>
                            </div>
                        </div>

                        @if($hntecResults && $hntecResults->count() > 0)
                            <!-- Show Original Uploaded Image -->
                            @if($hntecResults->first()->ocrResult && $hntecResults->first()->ocrResult->filename)
                                <div class="px-8 py-4 bg-slate-50 dark:bg-slate-700/50 border-b border-slate-200 dark:border-slate-700">
                                    <button onclick="toggleImage('hntec-image')" 
                                            class="text-sm text-blue-600 dark:text-blue-400 hover:underline">
                                        📸 View Original Uploaded Image
                                    </button>
                                    <div id="hntec-image" class="hidden mt-4">
                                        <img src="{{ asset('storage/' . str_replace('\\', '/', $hntecResults->first()->ocrResult->filename)) }}" 
                                             alt="HNTEC Grade Sheet" 
                                             class="max-w-full h-auto rounded-lg shadow-md">
                                    </div>
                                </div>
                            @endif

                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead class="bg-slate-50 dark:bg-slate-700/50">
                                        <tr>
                                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">PROGRAMME</th>
                                            <th class="px-6 py-4 text-center text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">CGPA</th>
                                            <th class="px-6 py-4 text-center text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">QUALIFICATION</th>
                                            <th class="px-6 py-4 text-center text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">CONFIDENCE</th>
                                            <th class="px-6 py-4 text-center text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">ACTIONS</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                                        @foreach($hntecResults as $result)
                                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <input type="text" value="{{ $result->programme }}" 
                                                       class="font-medium text-slate-900 dark:text-slate-100 bg-transparent border-0 p-0 subject-input"
                                                       data-grade-id="{{ $result->id }}" data-field="subject" readonly>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                <div class="flex flex-col items-center">
                                                    <input type="text" value="{{ number_format($result->cgpa, 2) }}" 
                                                           class="inline-flex items-center justify-center px-3 py-1 text-center text-lg font-bold bg-transparent border-0 grade-input text-slate-900 dark:text-slate-100"
                                                           data-grade-id="{{ $result->id }}" data-field="grade" readonly>
                                                    <div class="text-xs mt-1 px-2 py-1 rounded border-2 {{ $result->getCgpaGradeColor() }}">{{ $result->getCgpaDescription() }}</div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                <span class="text-sm font-medium text-slate-700 dark:text-slate-300">
                                                    {{ $result->getCgpaDescription() }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                <div class="flex flex-col items-center">
                                                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                                                        {{ number_format($result->confidence * 100, 1) }}%
                                                    </span>
                                                    <div class="w-16 bg-slate-200 dark:bg-slate-600 rounded-full h-2">
                                                        <div class="bg-gradient-to-r from-purple-400 to-purple-600 h-2 rounded-full" 
                                                             style="width: {{ $result->confidence * 100 }}%"></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                <button onclick="editGrade({{ $result->id }}, 'hntec_result')" 
                                                        class="edit-btn-{{ $result->id }} text-blue-600 hover:text-blue-800 mr-2">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                                    </svg>
                                                </button>
                                                <button onclick="saveGrade({{ $result->id }}, 'hntec_result')" 
                                                        class="save-btn-{{ $result->id }} text-green-600 hover:text-green-800 mr-2 hidden">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                    </svg>
                                                </button>
                                                <button onclick="cancelEdit({{ $result->id }})" 
                                                        class="cancel-btn-{{ $result->id }} text-red-600 hover:text-red-800 hidden">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                    </svg>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="p-12 text-center">
                                <svg class="w-16 h-16 text-slate-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <h4 class="text-lg font-medium text-slate-600 dark:text-slate-400 mb-2">No HNTEC Results Found</h4>
                                <p class="text-slate-500">This student hasn't uploaded HNTEC results yet</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Store original values for canceling edits
        const originalValues = {};

        // Section navigation
        function showSection(section) {
            // Hide all sections
            document.querySelectorAll('.results-section').forEach(s => s.classList.add('hidden'));
            
            // Show selected section
            document.getElementById(`section-${section}`).classList.remove('hidden');
            
            // Update button styles
            document.querySelectorAll('[id^="btn-"]').forEach(btn => {
                btn.className = 'px-4 py-2 rounded-lg font-medium transition-colors text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-700';
            });
            
            document.getElementById(`btn-${section}`).className = 'px-4 py-2 rounded-lg font-medium transition-colors bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300';
        }

        // Toggle image visibility
        function toggleImage(imageId) {
            const image = document.getElementById(imageId);
            image.classList.toggle('hidden');
        }

        // Edit grade function
        function editGrade(gradeId, gradeType) {
            const row = document.querySelector(`[data-grade-id="${gradeId}"]`).closest('tr');
            const inputs = row.querySelectorAll('input');
            
            // Store original values
            originalValues[gradeId] = { grade_type: gradeType };
            inputs.forEach(input => {
                originalValues[gradeId][input.dataset.field] = input.value;
                input.readOnly = false;
                input.classList.add('border', 'border-slate-300', 'rounded', 'px-2', 'py-1');
            });
            
            // Toggle button visibility
            document.querySelector(`.edit-btn-${gradeId}`).classList.add('hidden');
            document.querySelector(`.save-btn-${gradeId}`).classList.remove('hidden');
            document.querySelector(`.cancel-btn-${gradeId}`).classList.remove('hidden');
        }

        // Save grade function
        function saveGrade(gradeId, gradeType) {
            const row = document.querySelector(`[data-grade-id="${gradeId}"]`).closest('tr');
            const inputs = row.querySelectorAll('input');
            
            const data = {
                grade_type: gradeType,
                subject: '',
                grade: '',
                syllabus: ''
            };
            
            inputs.forEach(input => {
                if (input.dataset.field) {
                    data[input.dataset.field] = input.value;
                }
            });
            
            // Send AJAX request
            fetch(`/staff/admission/update-grade/${gradeId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Disable editing
                    inputs.forEach(input => {
                        input.readOnly = true;
                        input.classList.remove('border', 'border-slate-300', 'rounded', 'px-2', 'py-1');
                    });
                    
                    // Toggle button visibility
                    document.querySelector(`.edit-btn-${gradeId}`).classList.remove('hidden');
                    document.querySelector(`.save-btn-${gradeId}`).classList.add('hidden');
                    document.querySelector(`.cancel-btn-${gradeId}`).classList.add('hidden');
                    
                    // Show success message
                    showNotification('Grade updated successfully!', 'success');
                } else {
                    showNotification('Error updating grade. Please try again.', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Error updating grade. Please try again.', 'error');
            });
        }

        // Cancel edit function
        function cancelEdit(gradeId) {
            const row = document.querySelector(`[data-grade-id="${gradeId}"]`).closest('tr');
            const inputs = row.querySelectorAll('input');
            
            // Restore original values
            inputs.forEach(input => {
                if (originalValues[gradeId] && originalValues[gradeId][input.dataset.field] !== undefined) {
                    input.value = originalValues[gradeId][input.dataset.field];
                }
                input.readOnly = true;
                input.classList.remove('border', 'border-slate-300', 'rounded', 'px-2', 'py-1');
            });
            
            // Toggle button visibility
            document.querySelector(`.edit-btn-${gradeId}`).classList.remove('hidden');
            document.querySelector(`.save-btn-${gradeId}`).classList.add('hidden');
            document.querySelector(`.cancel-btn-${gradeId}`).classList.add('hidden');
        }

        // Update case status
        function updateCaseStatus(caseReportId, status) {
            fetch(`/staff/admission/case-report-status/${caseReportId}`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ status: status })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('Case status updated successfully!', 'success');
                    
                    // Update the select styling based on new status
                    const select = document.querySelector('#case-status-container select');
                    select.className = `text-sm rounded-full border-0 px-3 py-1 font-medium
                        ${status === 'pending' ? 'bg-red-100 text-red-800' : 
                          status === 'in progress' ? 'bg-orange-100 text-orange-800' : 
                          'bg-green-100 text-green-800'}`;
                } else {
                    showNotification('Error updating status. Please try again.', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Error updating status. Please try again.', 'error');
            });
        }

        // Show notification
        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.className = `fixed top-4 right-4 z-50 px-6 py-4 rounded-lg shadow-lg ${
                type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
            }`;
            notification.textContent = message;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }

        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            showSection('olevel');
        });
    </script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
</x-layouts.app>