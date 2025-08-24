<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Schools & Programmes') }}
        </h2>
    </x-slot>

    <div class="py-8 bg-gradient-to-br from-stone-50 to-slate-100 dark:from-slate-900 dark:to-stone-950 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            


            <!-- Schools Section -->
            <div class="bg-white/90 dark:bg-gray-800 backdrop-blur-sm rounded-2xl shadow-xl border border-stone-200/60 dark:border-slate-700/60 overflow-hidden">
                <div class="bg-gradient-to-r from-stone-100/60 to-slate-100/60 dark:from-slate-700/40 dark:to-slate-600/40 px-8 py-6 border-b border-stone-200/80 dark:border-slate-700/80">
                    <h2 class="text-2xl font-semibold text-slate-800 dark:text-slate-200 flex items-center gap-3">
                        <svg class="w-6 h-6 text-slate-600 dark:text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        Our Schools
                    </h2>
                    <p class="text-slate-600 dark:text-slate-400 mt-2">Choose a school to explore available programmes</p>
                </div>

                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        
                        <!-- School of Science and Engineering -->
                        <a href="{{ route('sse') }}" class="group">
                            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 border-2 border-blue-200/60 dark:border-blue-700/60 rounded-xl p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                <div class="w-14 h-14 mb-4 bg-blue-100 dark:bg-blue-900/50 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-7 h-7 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 7.172V5L8 4z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-blue-900 dark:text-blue-100 mb-3 group-hover:text-blue-700 dark:group-hover:text-blue-200 transition-colors">
                                    School of Science & Engineering
                                </h3>
                                <p class="text-blue-700 dark:text-blue-300 text-sm leading-relaxed mb-4">
                                    Architecture, Interior Design, Civil Engineering, Electrical Engineering, Mechanical Engineering, Petroleum Engineering, Electronic & Communication Engineering
                                </p>
                                <div class="flex items-center text-blue-600 dark:text-blue-400 text-sm font-medium">
                                    <span>7 Programmes Available</span>
                                    <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </div>
                            </div>
                        </a>

                        <!-- School of Business -->
                        <a href="{{ route('sbs') }}" class="group">
                            <div class="bg-gradient-to-br from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 border-2 border-green-200/60 dark:border-green-700/60 rounded-xl p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                <div class="w-14 h-14 mb-4 bg-green-100 dark:bg-green-900/50 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-7 h-7 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6m0 0L8 6m8 0v6h4a2 2 0 002-2V8a2 2 0 00-2-2h-4zM6 12V8a2 2 0 012-2h8v4H8a2 2 0 00-2 2v2z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-green-900 dark:text-green-100 mb-3 group-hover:text-green-700 dark:group-hover:text-green-200 transition-colors">
                                    School of Business
                                </h3>
                                <p class="text-green-700 dark:text-green-300 text-sm leading-relaxed mb-4">
                                    Business Accounting & Finance, Hospitality Management & Operations, Human Capital Management, Entrepreneurship & Marketing Strategies
                                </p>
                                <div class="flex items-center text-green-600 dark:text-green-400 text-sm font-medium">
                                    <span>4 Programmes Available</span>
                                    <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </div>
                            </div>
                        </a>

                        <!-- School of Health Sciences -->
                        <a href="{{ route('shs') }}" class="group">
                            <div class="bg-gradient-to-br from-red-50 to-rose-50 dark:from-red-900/20 dark:to-rose-900/20 border-2 border-red-200/60 dark:border-red-700/60 rounded-xl p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                <div class="w-14 h-14 mb-4 bg-red-100 dark:bg-red-900/50 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-7 h-7 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-red-900 dark:text-red-100 mb-3 group-hover:text-red-700 dark:group-hover:text-red-200 transition-colors">
                                    School of Health Sciences
                                </h3>
                                <p class="text-red-700 dark:text-red-300 text-sm leading-relaxed mb-4">
                                    Midwifery, Cardiovascular Technology, Paramedic, Nursing, Public Health, Dental Hygiene & Therapy
                                </p>
                                <div class="flex items-center text-red-600 dark:text-red-400 text-sm font-medium">
                                    <span>6 Programmes Available</span>
                                    <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </div>
                            </div>
                        </a>

                        <!-- School of ICT -->
                        <a href="{{ route('sict') }}" class="group">
                            <div class="bg-gradient-to-br from-purple-50 to-violet-50 dark:from-purple-900/20 dark:to-violet-900/20 border-2 border-purple-200/60 dark:border-purple-700/60 rounded-xl p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                <div class="w-14 h-14 mb-4 bg-purple-100 dark:bg-purple-900/50 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-7 h-7 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-purple-900 dark:text-purple-100 mb-3 group-hover:text-purple-700 dark:group-hover:text-purple-200 transition-colors">
                                    School of ICT
                                </h3>
                                <p class="text-purple-700 dark:text-purple-300 text-sm leading-relaxed mb-4">
                                    Application Development, Web Technology, Digital Arts & Media, Cloud Networking, Data Analytics
                                </p>
                                <div class="flex items-center text-purple-600 dark:text-purple-400 text-sm font-medium">
                                    <span>5 Programmes Available</span>
                                    <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </div>
                            </div>
                        </a>

                        <!-- School of Process and Chemical -->
                        <a href="{{ route('spc') }}" class="group">
                            <div class="bg-gradient-to-br from-amber-50 to-orange-50 dark:from-amber-900/20 dark:to-orange-900/20 border-2 border-amber-200/60 dark:border-amber-700/60 rounded-xl p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                <div class="w-14 h-14 mb-4 bg-amber-100 dark:bg-amber-900/50 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-7 h-7 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 7.172V5L8 4z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-amber-900 dark:text-amber-100 mb-3 group-hover:text-amber-700 dark:group-hover:text-amber-200 transition-colors">
                                    School of Process & Chemical
                                </h3>
                                <p class="text-amber-700 dark:text-amber-300 text-sm leading-relaxed mb-4">
                                    Applied Science Technology - Comprehensive programme covering chemical processes and applied scientific principles
                                </p>
                                <div class="flex items-center text-amber-600 dark:text-amber-400 text-sm font-medium">
                                    <span>1 Programme Available</span>
                                    <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </div>
                            </div>
                        </a>

                        <!-- Additional Info Card -->
                        <div class="bg-gradient-to-br from-slate-50 to-stone-50 dark:from-slate-800/60 dark:to-stone-800/60 border-2 border-slate-200/60 dark:border-slate-700/60 rounded-xl p-6">
                            <div class="w-14 h-14 mb-4 bg-slate-100 dark:bg-slate-700/80 rounded-xl flex items-center justify-center">
                                <svg class="w-7 h-7 text-slate-600 dark:text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900 dark:text-slate-100 mb-3">
                                Need Help?
                            </h3>
                            <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed mb-4">
                                Get guidance on choosing the right programme for your future career path and academic goals.
                            </p>
                            <div class="flex items-center text-slate-600 dark:text-slate-400 text-sm font-medium">
                                <span>Get Support</span>
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>