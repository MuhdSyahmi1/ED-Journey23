<x-layouts.app title="Subject/Programme Management">
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 dark:from-slate-900 dark:to-blue-950 transition-colors duration-300">
        <div class="p-6">
            <div class="max-w-7xl mx-auto space-y-6">
                <!-- Page Header -->
                <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-400/90 to-purple-500/90 text-white text-center py-4">
                        <h1 class="text-2xl font-bold">SUBJECT/PROGRAMME MANAGEMENT</h1>
                        <p class="text-sm opacity-90 mt-1">Manage academic subjects and programmes</p>
                    </div>
                </div>

                <!-- Navigation Cards -->
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- O Level Subjects -->
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 hover:shadow-2xl transition-all duration-200 overflow-hidden group">
                <a href="{{ route('staff.admission.olevel-subjects') }}" class="block p-4 h-full" wire:navigate>
                    <div class="text-center">
                        <div class="w-12 h-12 mx-auto mb-3 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center group-hover:bg-blue-200 dark:group-hover:bg-blue-900/50 transition-colors duration-200">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C20.832 18.477 19.246 18 17.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100 mb-1">O LEVEL SUBJECTS</h3>
                        <p class="text-xs text-gray-600 dark:text-gray-400">Manage O Level subject requirements</p>
                    </div>
                </a>
            </div>

                    <!-- A Level Subjects -->
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 hover:shadow-2xl transition-all duration-200 overflow-hidden group">
                <a href="{{ route('staff.admission.alevel-subjects') }}" class="block p-4 h-full" wire:navigate>
                    <div class="text-center">
                        <div class="w-12 h-12 mx-auto mb-3 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center group-hover:bg-green-200 dark:group-hover:bg-green-900/50 transition-colors duration-200">
                            <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100 mb-1">A LEVEL SUBJECTS</h3>
                        <p class="text-xs text-gray-600 dark:text-gray-400">Manage A Level subject requirements</p>
                    </div>
                </a>
            </div>

                    <!-- HNTEC Programmes -->
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 hover:shadow-2xl transition-all duration-200 overflow-hidden group">
                <a href="#" class="block p-4 h-full">
                    <div class="text-center">
                        <div class="w-12 h-12 mx-auto mb-3 bg-purple-100 dark:bg-purple-900/30 rounded-full flex items-center justify-center group-hover:bg-purple-200 dark:group-hover:bg-purple-900/50 transition-colors duration-200">
                            <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15"></path>
                            </svg>
                        </div>
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100 mb-1">HNTEC PROGRAMMES</h3>
                        <p class="text-xs text-gray-600 dark:text-gray-400">Manage Higher National Technical programmes</p>
                    </div>
                </a>
            </div>

                    <!-- Diploma Programmes -->
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 hover:shadow-2xl transition-all duration-200 overflow-hidden group">
                <a href="#" class="block p-4 h-full">
                    <div class="text-center">
                        <div class="w-12 h-12 mx-auto mb-3 bg-orange-100 dark:bg-orange-900/30 rounded-full flex items-center justify-center group-hover:bg-orange-200 dark:group-hover:bg-orange-900/50 transition-colors duration-200">
                            <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path>
                            </svg>
                        </div>
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100 mb-1">DIPLOMA PROGRAMMES</h3>
                        <p class="text-xs text-gray-600 dark:text-gray-400">Manage diploma programme requirements</p>
                    </div>
                </a>
            </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>