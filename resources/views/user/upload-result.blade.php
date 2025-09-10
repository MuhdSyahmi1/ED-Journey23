<x-layouts.app title="Upload results">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Upload Results') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 dark:from-slate-900 dark:to-blue-950 transition-colors duration-300">
        <div class="p-6">
            <div class="max-w-4xl mx-auto">
                
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

                <!-- Header -->
                <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-400/90 to-purple-500/90 text-white text-center py-4">
                        <h1 class="text-2xl font-bold">UPLOAD RESULTS</h1>
                    </div>
                </div>

                <!-- Upload Results Content -->
                <div class="mt-6 max-w-7xl mx-auto space-y-8">
                    
                    <!-- 1. Upload Grade Sheet Section -->
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 p-8">
                        <h3 class="text-xl font-bold mb-6 text-slate-900 dark:text-slate-100">Upload Grade Sheet</h3>
                        
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                            <div>
                                <form action="{{ route('user.grades.upload') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-6">
                                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                                            Grade Type <span class="text-red-500">*</span>
                                        </label>
                                        <select name="grade_type" required 
                                                class="w-full p-4 border-2 border-slate-300 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 focus:border-purple-500 focus:ring-4 focus:ring-purple-500/20 transition-all">
                                            <option value="">Select Grade Type</option>
                                            <option value="o_level" {{ old('grade_type') == 'o_level' ? 'selected' : '' }}>O-Level</option>
                                            <option value="a_level" {{ old('grade_type') == 'a_level' ? 'selected' : '' }}>A-Level</option>
                                            <option value="hntec" {{ old('grade_type') == 'hntec' ? 'selected' : '' }}>HNTec</option>
                                        </select>
                                        @error('grade_type')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-6">
                                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                                            Select Grade Sheet <span class="text-red-500">*</span>
                                        </label>
                                        <input type="file" name="grade_sheet" required 
                                               accept=".jpg,.jpeg,.png,.pdf"
                                               class="w-full p-4 border-2 border-slate-300 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 focus:border-purple-500 focus:ring-4 focus:ring-purple-500/20 transition-all">
                                        <p class="text-xs text-slate-500 mt-2">Supports: JPG, PNG, PDF (Max: 5MB)</p>
                                        @error('grade_sheet')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <button type="submit" 
                                            class="w-full bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white font-bold py-4 px-6 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200">
                                        <svg class="w-6 h-6 inline mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                        </svg>
                                        Scan Grades with OCR
                                    </button>
                                </form>
                            </div>
                            
                            <div class="bg-gradient-to-br from-blue-50 to-purple-50 dark:from-blue-900/20 dark:to-purple-900/20 rounded-xl p-6">
                                <h4 class="font-bold text-slate-800 dark:text-slate-100 mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Tips for Best Results
                                </h4>
                                <ul class="text-sm text-slate-700 dark:text-slate-300 space-y-2">
                                    <li class="flex items-start">
                                        <svg class="w-4 h-4 mr-2 mt-0.5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                                        </svg>
                                        Use clear, high-contrast images
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="w-4 h-4 mr-2 mt-0.5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                                        </svg>
                                        Ensure good lighting conditions
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="w-4 h-4 mr-2 mt-0.5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                                        </svg>
                                        Avoid blurry or tilted images
                                    </li>
                                    <li class="flex items-start">
                                        <svg class="w-4 h-4 mr-2 mt-0.5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/>
                                        </svg>
                                        Make sure grades are clearly visible
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    @if((isset($oLevelResults) && $oLevelResults && $oLevelResults->studentGrades->count() > 0) || 
                        (isset($aLevelResults) && $aLevelResults && $aLevelResults->studentGrades->count() > 0) || 
                        (isset($hntecResults) && $hntecResults && $hntecResults->count() > 0))
                        
                        <!-- 2. O-Level Results Section -->
                        @if(isset($oLevelResults) && $oLevelResults && $oLevelResults->studentGrades->count() > 0)
                        @php
                            $oLevelGrades = $oLevelResults->studentGrades;
                        @endphp
                        <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden">
                            <!-- O-Level Header -->
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
                                        <div class="text-3xl font-bold">{{ $oLevelGrades->count() }}</div>
                                        <div class="text-sm opacity-90">Subjects Found</div>
                                    </div>
                                </div>
                            </div>

                            <!-- O-Level Administrative Table -->
                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead class="bg-slate-50 dark:bg-slate-700/50">
                                        <tr>
                                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">SUBJECT</th>
                                            <th class="px-6 py-4 text-center text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">GRADE</th>
                                            <th class="px-6 py-4 text-center text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">DESCRIPTION</th>
                                            <th class="px-6 py-4 text-center text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">SYLLABUS</th>
                                            <th class="px-6 py-4 text-center text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">CONFIDENCE</th>
                                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">OCR CONTEXT</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                                        @foreach($oLevelGrades as $grade)
                                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="font-medium text-slate-900 dark:text-slate-100">
                                                    {{ $grade->subject ?? 'Unknown Subject' }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full text-lg font-bold {{ $grade->getGradeColor() }} shadow-md">
                                                    {{ $grade->grade }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                <span class="text-sm font-medium text-slate-700 dark:text-slate-300">
                                                    {{ $grade->getGradeDescription() }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                @if($grade->syllabus)
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300 border border-blue-200 dark:border-blue-700">
                                                    {{ $grade->syllabus }}
                                                </span>
                                                @else
                                                <span class="text-slate-400 dark:text-slate-500 text-sm">—</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                <div class="flex flex-col items-center">
                                                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                                                        {{ number_format($grade->confidence * 100, 1) }}%
                                                    </span>
                                                    <div class="w-16 bg-slate-200 dark:bg-slate-600 rounded-full h-2">
                                                        <div class="bg-gradient-to-r from-blue-400 to-blue-600 h-2 rounded-full transition-all duration-300" 
                                                             style="width: {{ $grade->confidence * 100 }}%"></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-slate-600 dark:text-slate-400 max-w-xs">
                                                    <div class="truncate" title="{{ $grade->context_line }}">
                                                        {{ $grade->context_line }}
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif
                    
                    <!-- 3. A-Level Results Section -->
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
                                    <div class="text-3xl font-bold">{{ isset($aLevelResults) && $aLevelResults ? $aLevelResults->studentGrades->count() : 0 }}</div>
                                    <div class="text-sm opacity-90">Subjects Found</div>
                                </div>
                            </div>
                        </div>

                        <!-- A-Level Administrative Table -->
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-slate-50 dark:bg-slate-700/50">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">SUBJECT</th>
                                        <th class="px-6 py-4 text-center text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">GRADE</th>
                                        <th class="px-6 py-4 text-center text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">QUALIFICATION</th>
                                        <th class="px-6 py-4 text-center text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">SYLLABUS</th>
                                        <th class="px-6 py-4 text-center text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">CONFIDENCE</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">OCR CONTEXT</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                                    @if(isset($aLevelResults) && $aLevelResults && $aLevelResults->studentGrades->count() > 0)
                                        @foreach($aLevelResults->studentGrades as $grade)
                                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="font-medium text-slate-900 dark:text-slate-100">
                                                    {{ $grade->subject ?? 'Unknown Subject' }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full text-lg font-bold {{ $grade->getGradeColor() }} shadow-md">
                                                    {{ $grade->grade }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                <span class="text-sm font-medium text-slate-700 dark:text-slate-300">
                                                    {{ $grade->qualification ?? 'Advanced Level' }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                @if($grade->syllabus)
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300 border border-green-200 dark:border-green-700">
                                                    {{ $grade->syllabus }}
                                                </span>
                                                @else
                                                <span class="text-slate-400 dark:text-slate-500 text-sm">—</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                <div class="flex flex-col items-center">
                                                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                                                        {{ number_format($grade->confidence * 100, 1) }}%
                                                    </span>
                                                    <div class="w-16 bg-slate-200 dark:bg-slate-600 rounded-full h-2">
                                                        <div class="bg-gradient-to-r from-green-400 to-green-600 h-2 rounded-full transition-all duration-300" 
                                                             style="width: {{ $grade->confidence * 100 }}%"></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-slate-600 dark:text-slate-400 max-w-xs">
                                                    <div class="truncate" title="{{ $grade->context_line }}">
                                                        {{ $grade->context_line }}
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6" class="px-6 py-12 text-center">
                                                <div class="flex flex-col items-center">
                                                    <svg class="w-16 h-16 text-slate-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                    </svg>
                                                    <h4 class="text-lg font-medium text-slate-600 dark:text-slate-400 mb-2">No A-Level Results Found</h4>
                                                    <p class="text-slate-500">Upload an A-Level result sheet to see grades here</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                        
                    <!-- 4. HNTEC Results Section -->
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
                                    <div class="text-3xl font-bold">{{ isset($hntecResults) && $hntecResults ? $hntecResults->count() : 0 }}</div>
                                    <div class="text-sm opacity-90">Programmes Found</div>
                                </div>
                            </div>
                        </div>

                        <!-- HNTEC Administrative Table -->
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-slate-50 dark:bg-slate-700/50">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">PROGRAMME</th>
                                        <th class="px-6 py-4 text-center text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">CGPA</th>
                                        <th class="px-6 py-4 text-center text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">QUALIFICATION</th>
                                        <th class="px-6 py-4 text-center text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">CONFIDENCE</th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">OCR CONTEXT</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                                    @if(isset($hntecResults) && $hntecResults && $hntecResults->count() > 0)
                                        @foreach($hntecResults as $result)
                                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="font-medium text-slate-900 dark:text-slate-100">
                                                    {{ $result->programme ?? 'Unknown Programme' }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                <div class="inline-flex items-center justify-center px-3 py-1 rounded-full text-lg font-bold {{ $result->getCgpaGradeColor() }}">
                                                    {{ number_format($result->cgpa, 2) }}
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
                                                        <div class="bg-gradient-to-r from-purple-400 to-purple-600 h-2 rounded-full transition-all duration-300" 
                                                             style="width: {{ $result->confidence * 100 }}%"></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-slate-600 dark:text-slate-400 max-w-xs">
                                                    <div class="truncate" title="{{ $result->context_line }}">
                                                        {{ $result->context_line }}
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="px-6 py-12 text-center">
                                                <div class="flex flex-col items-center">
                                                    <svg class="w-16 h-16 text-slate-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                    </svg>
                                                    <h4 class="text-lg font-medium text-slate-600 dark:text-slate-400 mb-2">No HNTEC Results Found</h4>
                                                    <p class="text-slate-500">Upload a HNTEC result sheet to see grades here</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- 5. Statistics Section -->
                    @if((isset($oLevelStatistics) && $oLevelStatistics['total_grades'] > 0) || 
                        (isset($aLevelStatistics) && $aLevelStatistics['total_grades'] > 0) || 
                        (isset($hntecStatistics) && $hntecStatistics['total_programmes'] > 0))
                        <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 p-8">
                            <div class="flex items-center mb-6">
                                <div class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-lg flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-slate-900 dark:text-slate-100">Statistics</h3>
                                    <p class="text-sm text-slate-600 dark:text-slate-400">Overview of your scanned results</p>
                                </div>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                                @php
                                    $totalGrades = ($oLevelStatistics['total_grades'] ?? 0) + 
                                                   ($aLevelStatistics['total_grades'] ?? 0) + 
                                                   ($hntecStatistics['total_programmes'] ?? 0);
                                    $totalSubjects = ($oLevelStatistics['subjects_found'] ?? 0) + 
                                                    ($aLevelStatistics['subjects_found'] ?? 0) + 
                                                    count($hntecStatistics['programmes'] ?? []);
                                    $lastScan = max(
                                        $oLevelStatistics['last_scan'] ?? null,
                                        $aLevelStatistics['last_scan'] ?? null,
                                        $hntecStatistics['last_scan'] ?? null
                                    );
                                @endphp
                                <div class="bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 rounded-xl p-6 text-center">
                                    <div class="text-3xl font-bold text-blue-600 dark:text-blue-400">{{ $totalGrades }}</div>
                                    <div class="text-sm font-medium text-blue-800 dark:text-blue-300">Total Grades</div>
                                </div>
                                <div class="bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/20 rounded-xl p-6 text-center">
                                    <div class="text-3xl font-bold text-green-600 dark:text-green-400">{{ $totalSubjects }}</div>
                                    <div class="text-sm font-medium text-green-800 dark:text-green-300">Subjects</div>
                                </div>
                                <div class="bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900/20 dark:to-purple-800/20 rounded-xl p-6 text-center">
                                    <div class="text-lg font-bold text-purple-600 dark:text-purple-400">
                                        {{ $lastScan ? \Carbon\Carbon::parse($lastScan)->diffForHumans() : 'Never' }}
                                    </div>
                                    <div class="text-sm font-medium text-purple-800 dark:text-purple-300">Last Scan</div>
                                </div>
                            </div>

                            <!-- Grade Distribution -->
                            <div>
                                <h4 class="text-lg font-bold mb-4 text-slate-900 dark:text-slate-100">Grade Distribution</h4>
                                <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                                    @php
                                        $allDistributions = [];
                                        
                                        // O-Level grades
                                        if (isset($oLevelStatistics['grade_distribution'])) {
                                            foreach ($oLevelStatistics['grade_distribution'] as $grade => $data) {
                                                if ($data['count'] > 0) {
                                                    $allDistributions[$grade] = ($allDistributions[$grade] ?? 0) + $data['count'];
                                                }
                                            }
                                        }
                                        
                                        // A-Level grades
                                        if (isset($aLevelStatistics['grade_distribution'])) {
                                            foreach ($aLevelStatistics['grade_distribution'] as $grade => $data) {
                                                if ($data['count'] > 0) {
                                                    $allDistributions[$grade] = ($allDistributions[$grade] ?? 0) + $data['count'];
                                                }
                                            }
                                        }
                                        
                                        // HNTec has CGPA instead of grades, so we skip it for grade distribution
                                        $totalCount = array_sum($allDistributions);
                                    @endphp
                                    
                                    @if(count($allDistributions) > 0)
                                        @foreach($allDistributions as $grade => $count)
                                        <div class="bg-slate-100 dark:bg-slate-700 rounded-lg p-4 text-center">
                                            <div class="text-2xl font-bold text-slate-800 dark:text-slate-200">{{ $grade }}</div>
                                            <div class="text-sm text-slate-600 dark:text-slate-400">{{ $count }} subjects</div>
                                            <div class="text-xs text-slate-500">({{ $totalCount > 0 ? number_format(($count / $totalCount) * 100, 1) : 0 }}%)</div>
                                        </div>
                                        @endforeach
                                    @else
                                        <div class="col-span-full text-center text-slate-500 dark:text-slate-400">
                                            No grade distribution available
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif
                    @else
                        <!-- No Grades Yet -->
                        <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 p-12 text-center">
                            <svg class="w-24 h-24 text-slate-400 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <h3 class="text-2xl font-bold text-slate-900 dark:text-slate-100 mb-4">No Grades Scanned Yet</h3>
                            <p class="text-lg text-slate-600 dark:text-slate-400 mb-2">Upload your grade sheets to get started with OCR scanning.</p>
                            <p class="text-sm text-slate-500">The system will automatically detect and extract grades from O-Level, A-Level, and HNTEC results.</p>
                        </div>
                    @endif
                </div>

                <!-- Sticky Floating Report Case Button -->
                @if((isset($oLevelResults) && $oLevelResults && $oLevelResults->studentGrades->count() > 0) || 
                    (isset($aLevelResults) && $aLevelResults && $aLevelResults->studentGrades->count() > 0) || 
                    (isset($hntecResults) && $hntecResults && $hntecResults->count() > 0))
                    <div class="fixed bottom-8 right-8 z-50">
                        <button type="button" 
                                onclick="document.getElementById('report-case-section').scrollIntoView({ behavior: 'smooth' })"
                                title="Having Issues? Report if your grades were scanned incorrectly."
                                class="bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 text-white font-bold py-4 px-6 rounded-full shadow-2xl hover:shadow-3xl transform hover:scale-110 transition-all duration-300 group">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                </svg>
                                <span class="hidden sm:inline">Report Case</span>
                            </div>
                        </button>
                    </div>
                @endif

                <!-- Report Case Section -->
                <div id="report-case-section" class="mt-6 bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 p-8">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h3 class="text-xl font-semibold text-slate-900 dark:text-slate-100">Having Issues?</h3>
                            <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">Report if your grades were scanned incorrectly.</p>
                        </div>
                        <div x-data="{ showForm: false }" 
                             x-init="showForm = false">
                            <button type="button" 
                                    x-on:click="showForm = true"
                                    x-show="!showForm"
                                    class="bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 text-white font-bold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200">
                                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                </svg>
                                Report Case
                            </button>

                            <!-- Report Case Form (Initially Hidden) -->
                            <div x-show="showForm" 
                                 x-transition
                                 class="mt-6">
                                <form method="POST" action="{{ route('user.case-report.store') }}" class="space-y-6">
                            @csrf

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Subject -->
                                <div class="space-y-2">
                                    <label for="subject" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">
                                        Subject <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" 
                                           id="subject" 
                                           name="subject" 
                                           value="{{ old('subject') }}"
                                           placeholder="e.g., Mathematics, English, Biology"
                                           class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 dark:border-slate-600 
                                                  bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100
                                                  focus:border-red-500 dark:focus:border-red-400 
                                                  focus:ring-4 focus:ring-red-500/20 dark:focus:ring-red-400/20
                                                  transition-all duration-200 @error('subject') border-red-500 dark:border-red-400 @enderror"
                                           required>
                                    @error('subject')
                                        <p class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Subject Type -->
                                <div class="space-y-2">
                                    <label for="subject_type" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">
                                        Subject Type <span class="text-red-500">*</span>
                                    </label>
                                    <select id="subject_type" 
                                            name="subject_type" 
                                            class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 dark:border-slate-600 
                                                   bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100
                                                   focus:border-red-500 dark:focus:border-red-400 
                                                   focus:ring-4 focus:ring-red-500/20 dark:focus:ring-red-400/20
                                                   transition-all duration-200 @error('subject_type') border-red-500 dark:border-red-400 @enderror"
                                            required>
                                        <option value="">Select Subject Type</option>
                                        <option value="Hntec" {{ old('subject_type') == 'Hntec' ? 'selected' : '' }}>Hntec</option>
                                        <option value="O-Level" {{ old('subject_type') == 'O-Level' ? 'selected' : '' }}>O-Level</option>
                                        <option value="A-Level" {{ old('subject_type') == 'A-Level' ? 'selected' : '' }}>A-Level</option>
                                    </select>
                                    @error('subject_type')
                                        <p class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Case Type -->
                                <div class="space-y-2 md:col-span-2">
                                    <label for="case_type" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">
                                        Case Type <span class="text-red-500">*</span>
                                    </label>
                                    <select id="case_type" 
                                            name="case_type" 
                                            class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 dark:border-slate-600 
                                                   bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100
                                                   focus:border-red-500 dark:focus:border-red-400 
                                                   focus:ring-4 focus:ring-red-500/20 dark:focus:ring-red-400/20
                                                   transition-all duration-200 @error('case_type') border-red-500 dark:border-red-400 @enderror"
                                            required>
                                        <option value="">Select Case Type</option>
                                        <option value="Incorrect Data" {{ old('case_type') == 'Incorrect Data' ? 'selected' : '' }}>Incorrect Data</option>
                                    </select>
                                    @error('case_type')
                                        <p class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="space-y-2">
                                <label for="description" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">
                                    Description <span class="text-red-500">*</span>
                                </label>
                                <textarea id="description" 
                                          name="description" 
                                          rows="4"
                                          placeholder="Please describe the issue with your scanned grades in detail..."
                                          class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 dark:border-slate-600 
                                                 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100
                                                 focus:border-red-500 dark:focus:border-red-400 
                                                 focus:ring-4 focus:ring-red-500/20 dark:focus:ring-red-400/20
                                                 transition-all duration-200 resize-none @error('description') border-red-500 dark:border-red-400 @enderror"
                                          required>{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Form Actions -->
                            <div class="flex justify-end gap-4">
                                <button type="button" 
                                        x-on:click="showForm = false; $el.closest('form').reset()"
                                        class="px-6 py-3 border border-slate-300 dark:border-slate-600 rounded-xl text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                                    Cancel
                                </button>
                                <button type="submit" 
                                        class="bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 text-white font-bold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200">
                                    Submit Report
                                </button>
                            </div>
                        </form>
                    </div>
                        </div>
                </div>
            </div>
        </div>
    </div>

</x-layouts.app>