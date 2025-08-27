<x-layouts.app>
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
                <div class="mt-6 bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 p-8">
                    <div class="text-center py-12">
                        <svg class="mx-auto h-24 w-24 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-slate-900 dark:text-slate-100">Upload Your Results</h3>
                        <p class="mt-2 text-sm text-slate-600 dark:text-slate-400">
                            OCR functionality for grade scanning will be implemented here.
                        </p>
                        <p class="mt-2 text-xs text-slate-500 dark:text-slate-500">
                            Upload your exam results to get personalized recommendations.
                        </p>
                    </div>
                </div>

                <!-- Report Case Section -->
                <div class="mt-6 bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 p-8">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h3 class="text-xl font-semibold text-slate-900 dark:text-slate-100">Having Issues?</h3>
                            <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">Report if your grades were scanned incorrectly</p>
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