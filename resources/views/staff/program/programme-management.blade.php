<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Programme Management') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 dark:from-slate-900 dark:to-blue-950 transition-colors duration-300">
        <div class="p-6">
            <div class="max-w-7xl mx-auto">
                
                <!-- Header -->
                <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden mb-6">
                    <div class="bg-gradient-to-r from-blue-400/90 to-purple-500/90 text-white text-center py-6">
                        <h1 class="text-3xl font-bold">PROGRAMME MANAGEMENT</h1>
                        <p class="text-blue-100 mt-2">Select a school to manage its programmes and courses</p>
                    </div>
                </div>
                    
                <!-- Schools Grid -->
                <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-8">
                    <!-- School of Business -->
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 cursor-pointer group" 
                         onclick="window.location.href='{{ route('staff.program.school', 'business') }}'">
                        <div class="bg-gradient-to-br from-blue-400/20 to-blue-600/20 p-6 text-center">
                            <div class="w-20 h-20 mx-auto mb-4 overflow-hidden rounded-full bg-white shadow-lg">
                                <img src="{{ asset('images/schools/business.png') }}" 
                                     alt="School of Business" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            </div>
                            <h4 class="font-bold text-lg mb-2 text-slate-900 dark:text-slate-100">School of Business</h4>
                            <p class="text-sm text-slate-600 dark:text-slate-400 mb-3">Business Administration, Economics, Marketing</p>
                            <div class="flex justify-center">
                                <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900/20 dark:text-blue-300">
                                    12 Programmes
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- School of Health Sciences -->
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 cursor-pointer group" 
                         onclick="window.location.href='{{ route('staff.program.school', 'health') }}'">
                        <div class="bg-gradient-to-br from-green-400/20 to-green-600/20 p-6 text-center">
                            <div class="w-20 h-20 mx-auto mb-4 overflow-hidden rounded-full bg-white shadow-lg">
                                <img src="{{ asset('images/schools/health.png') }}" 
                                     alt="School of Health Sciences" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            </div>
                            <h4 class="font-bold text-lg mb-2 text-slate-900 dark:text-slate-100">School of Health Sciences</h4>
                            <p class="text-sm text-slate-600 dark:text-slate-400 mb-3">Nursing, Medicine, Public Health</p>
                            <div class="flex justify-center">
                                <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-300">
                                    8 Programmes
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- School of ICT -->
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 cursor-pointer group" 
                         onclick="window.location.href='{{ route('staff.program.school', 'ict') }}'">
                        <div class="bg-gradient-to-br from-purple-400/20 to-purple-600/20 p-6 text-center">
                            <div class="w-20 h-20 mx-auto mb-4 overflow-hidden rounded-full bg-white shadow-lg">
                                <img src="{{ asset('images/schools/ict.png') }}" 
                                     alt="School of ICT" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            </div>
                            <h4 class="font-bold text-lg mb-2 text-slate-900 dark:text-slate-100">School of ICT</h4>
                            <p class="text-sm text-slate-600 dark:text-slate-400 mb-3">Computer Science, IT, Software Engineering</p>
                            <div class="flex justify-center">
                                <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-800 dark:bg-purple-900/20 dark:text-purple-300">
                                    10 Programmes
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- School of Science & Engineering -->
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 cursor-pointer group" 
                         onclick="window.location.href='{{ route('staff.program.school', 'engineering') }}'">
                        <div class="bg-gradient-to-br from-red-400/20 to-red-600/20 p-6 text-center">
                            <div class="w-20 h-20 mx-auto mb-4 overflow-hidden rounded-full bg-white shadow-lg">
                                <img src="{{ asset('images/schools/engineering.png') }}" 
                                     alt="School of Science & Engineering" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            </div>
                            <h4 class="font-bold text-lg mb-2 text-slate-900 dark:text-slate-100">School of Science & Engineering</h4>
                            <p class="text-sm text-slate-600 dark:text-slate-400 mb-3">Engineering, Mathematics, Physics</p>
                            <div class="flex justify-center">
                                <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-300">
                                    15 Programmes
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- School of Petrochemical -->
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 cursor-pointer group" 
                         onclick="window.location.href='{{ route('staff.program.school', 'petrochemical') }}'">
                        <div class="bg-gradient-to-br from-orange-400/20 to-yellow-500/20 p-6 text-center">
                            <div class="w-20 h-20 mx-auto mb-4 overflow-hidden rounded-full bg-white shadow-lg">
                                <img src="{{ asset('images/schools/petrochemical.jpg') }}" 
                                     alt="School of Petrochemical" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            </div>
                            <h4 class="font-bold text-lg mb-2 text-slate-900 dark:text-slate-100">School of Petrochemical</h4>
                            <p class="text-sm text-slate-600 dark:text-slate-400 mb-3">Chemical Engineering, Petroleum Studies</p>
                            <div class="flex justify-center">
                                <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-orange-100 text-orange-800 dark:bg-orange-900/20 dark:text-orange-300">
                                    6 Programmes
                                </span>
                            </div>
                        </div>
                    </div>
                    </div>

                <!-- Quick Stats -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <!-- Total Schools -->
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-xl shadow-lg border border-slate-200/60 dark:border-slate-700/60 p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900/20">
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-2xl font-bold text-slate-900 dark:text-slate-100">5</p>
                                <p class="text-sm text-slate-600 dark:text-slate-400">Total Schools</p>
                            </div>
                        </div>
                    </div>

                    <!-- Active Programmes -->
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-xl shadow-lg border border-slate-200/60 dark:border-slate-700/60 p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 dark:bg-green-900/20">
                                <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-2xl font-bold text-slate-900 dark:text-slate-100">51</p>
                                <p class="text-sm text-slate-600 dark:text-slate-400">Active Programmes</p>
                            </div>
                        </div>
                    </div>

                    <!-- Total Courses -->
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-xl shadow-lg border border-slate-200/60 dark:border-slate-700/60 p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-purple-100 dark:bg-purple-900/20">
                                <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-2xl font-bold text-slate-900 dark:text-slate-100">198</p>
                                <p class="text-sm text-slate-600 dark:text-slate-400">Total Courses</p>
                            </div>
                        </div>
                    </div>

                    <!-- Enrolled Students -->
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-xl shadow-lg border border-slate-200/60 dark:border-slate-700/60 p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-orange-100 dark:bg-orange-900/20">
                                <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-2xl font-bold text-slate-900 dark:text-slate-100">3,510</p>
                                <p class="text-sm text-slate-600 dark:text-slate-400">Enrolled Students</p>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</x-layouts.app>