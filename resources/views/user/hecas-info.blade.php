<x-layouts.app title="HECAS Information">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('HECAS Information') }}
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

                <!-- HECAS Information Form -->
                <form method="POST" action="{{ route('user.hecas-info.store') }}" class="space-y-6">
                    @csrf

                    <!-- Header -->
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden">
                        <div class="bg-gradient-to-r from-blue-400/90 to-indigo-500/90 text-white text-center py-4">
                            <h1 class="text-2xl font-bold">HECAS INFORMATION</h1>
                            <p class="text-sm opacity-90 mt-1">Higher Education Central Application System</p>
                        </div>
                    </div>

                    <!-- Information Section -->
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 p-8">
                        <div class="mb-6">
                            <h3 class="text-xl font-semibold text-slate-900 dark:text-slate-100 mb-4">What is HECAS?</h3>
                            <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-700 rounded-lg p-4 mb-6">
                                <p class="text-blue-800 dark:text-blue-200 text-sm leading-relaxed">
                                    HECAS (Higher Education Central Application System) is Brunei's centralized application system for higher education institutions. 
                                    If you have applied through HECAS before, you can enter your HECAS ID below to help us better match your academic history and preferences.
                                </p>
                            </div>
                        </div>

                        <!-- HECAS ID Field -->
                        <div class="space-y-2">
                            <label for="hecas_id" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">
                                HECAS ID <span class="text-slate-500">(Optional)</span>
                            </label>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mb-3">
                                Format: 31/12345678/01 (If you have applied through HECAS before)
                            </p>
                            <input type="text" 
                                   id="hecas_id" 
                                   name="hecas_id" 
                                   value="{{ old('hecas_id', (isset($profile) && property_exists($profile, 'hecas_id')) ? $profile->hecas_id : '') }}"
                                   maxlength="14"
                                   pattern="[0-9]{2}\/[0-9]{8}\/[0-9]{2}"
                                   placeholder="31/12345678/01"
                                   class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 dark:border-slate-600 
                                          bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100
                                          focus:border-blue-500 dark:focus:border-blue-400 
                                          focus:ring-4 focus:ring-blue-500/20 dark:focus:ring-blue-400/20
                                          transition-all duration-200 @error('hecas_id') border-red-500 dark:border-red-400 @enderror">
                            
                            <div class="text-xs text-slate-500 dark:text-slate-400 mt-2">
                                <strong>Note:</strong> Leave this field empty if you have never applied through HECAS or don't have a HECAS ID.
                            </div>
                            
                            @error('hecas_id')
                                <p class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Current HECAS ID Display -->
                        @if(isset($profile) && property_exists($profile, 'hecas_id') && $profile->hecas_id)
                            <div class="mt-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-700 rounded-lg">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-green-600 dark:text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <div>
                                        <p class="text-green-800 dark:text-green-200 font-medium">Current HECAS ID: {{ $profile->hecas_id }}</p>
                                        <p class="text-green-600 dark:text-green-300 text-xs">You can update this information anytime using the form above.</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Additional Information -->
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 p-8">
                        <h3 class="text-xl font-semibold text-slate-900 dark:text-slate-100 mb-4">Benefits of Providing Your HECAS ID</h3>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0 w-6 h-6 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center mt-0.5">
                                    <svg class="w-3 h-3 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-slate-900 dark:text-slate-100">Better Recommendations</h4>
                                    <p class="text-xs text-slate-600 dark:text-slate-400">Get more accurate programme recommendations based on your previous HECAS applications.</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0 w-6 h-6 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center mt-0.5">
                                    <svg class="w-3 h-3 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-slate-900 dark:text-slate-100">Streamlined Process</h4>
                                    <p class="text-xs text-slate-600 dark:text-slate-400">Potentially faster application processing when applying to institutions.</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0 w-6 h-6 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center mt-0.5">
                                    <svg class="w-3 h-3 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-slate-900 dark:text-slate-100">Academic History</h4>
                                    <p class="text-xs text-slate-600 dark:text-slate-400">Link your academic records for a comprehensive educational profile.</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0 w-6 h-6 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center mt-0.5">
                                    <svg class="w-3 h-3 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-slate-900 dark:text-slate-100">Future Applications</h4>
                                    <p class="text-xs text-slate-600 dark:text-slate-400">Easier reference for future higher education applications.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-center">
                        <button type="submit" 
                                class="bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-600 hover:to-indigo-600 text-white font-bold py-4 px-12 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200">
                            {{ (isset($profile) && property_exists($profile, 'hecas_id') && $profile->hecas_id) ? 'Update HECAS Information' : 'Save HECAS Information' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const hecasIdInput = document.getElementById('hecas_id');
            
            // HECAS ID formatting
            hecasIdInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, ''); // Remove non-digits
                
                // Format as XX/XXXXXXXX/XX
                if (value.length >= 2) {
                    value = value.substring(0, 2) + '/' + value.substring(2);
                }
                if (value.length >= 11) {
                    value = value.substring(0, 11) + '/' + value.substring(11, 13);
                }
                
                e.target.value = value;
            });

            hecasIdInput.addEventListener('keydown', function(e) {
                // Allow backspace, delete, tab, escape, enter, and forward slash
                if ([46, 8, 9, 27, 13, 191].indexOf(e.keyCode) !== -1 ||
                    // Allow Ctrl+A, Ctrl+C, Ctrl+V, Ctrl+X
                    (e.keyCode === 65 && e.ctrlKey === true) ||
                    (e.keyCode === 67 && e.ctrlKey === true) ||
                    (e.keyCode === 86 && e.ctrlKey === true) ||
                    (e.keyCode === 88 && e.ctrlKey === true) ||
                    // Allow home, end, left, right
                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                    return;
                }
                
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });
        });
    </script>
</x-layouts.app>