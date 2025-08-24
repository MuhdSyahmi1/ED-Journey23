<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('School of Business') }}
        </h2>
    </x-slot>

    <div class="py-8 bg-gradient-to-br from-stone-50 to-slate-100 dark:from-slate-900 dark:to-stone-950 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Breadcrumb Navigation -->
            <div class="mb-8">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('school') }}" class="inline-flex items-center text-sm font-medium text-slate-700 hover:text-slate-900 dark:text-slate-400 dark:hover:text-slate-200">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-9 9a1 1 0 001.414 1.414L2 12.414V15a2 2 0 002 2h3a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1h3a2 2 0 002-2v-2.586l.293.293a1 1 0 001.414-1.414l-9-9z"></path>
                                </svg>
                                Schools
                            </a>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-slate-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="ml-1 text-sm font-medium text-slate-500 md:ml-2 dark:text-slate-400">School of Business</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>

            <!-- School Header -->
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-2xl shadow-xl border border-green-200/60 dark:border-green-700/60 overflow-hidden mb-8">
                <div class="px-8 py-12 text-center">
                    <div class="w-20 h-20 mx-auto mb-6 bg-green-100 dark:bg-green-900/50 rounded-2xl flex items-center justify-center">
                        <svg class="w-10 h-10 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6m0 0L8 6m8 0v6h4a2 2 0 002-2V8a2 2 0 00-2-2h-4zM6 12V8a2 2 0 012-2h8v4H8a2 2 0 00-2 2v2z" />
                        </svg>
                    </div>
                    <h1 class="text-4xl font-bold text-green-900 dark:text-green-100 mb-4">
                        School of Business
                    </h1>
                    <p class="text-lg text-green-700 dark:text-green-300 max-w-3xl mx-auto leading-relaxed">
                        Prepare for success in the dynamic world of business with our comprehensive programmes designed to develop entrepreneurial thinking, financial acumen, and strategic leadership skills.
                    </p>
                    <div class="mt-6 inline-flex items-center px-4 py-2 bg-green-100 dark:bg-green-900/50 rounded-full text-green-700 dark:text-green-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        4 Programmes Available
                    </div>
                </div>
            </div>

            <!-- Programmes Grid -->
            <div class="bg-white/90 dark:bg-gray-800 backdrop-blur-sm rounded-2xl shadow-xl border border-stone-200/60 dark:border-slate-700/60 overflow-hidden">
                <div class="bg-gradient-to-r from-stone-100/60 to-slate-100/60 dark:from-slate-700/40 dark:to-slate-600/40 px-8 py-6 border-b border-stone-200/80 dark:border-slate-700/80">
                    <h2 class="text-2xl font-semibold text-slate-800 dark:text-slate-200 flex items-center gap-3">
                        <svg class="w-6 h-6 text-slate-600 dark:text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        Available Programmes
                    </h2>
                    <p class="text-slate-600 dark:text-slate-400 mt-2">Explore our business programmes and find your path to success</p>
                </div>

                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        
                        <!-- Business Accounting & Finance -->
                        <a href="{{ route('school') }}" class="group">
                            <div class="bg-gradient-to-br from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 border-2 border-green-200/60 dark:border-green-700/60 rounded-xl p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="w-14 h-14 bg-green-100 dark:bg-green-900/50 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                        <svg class="w-7 h-7 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <span class="px-3 py-1 bg-green-100 dark:bg-green-900/50 text-green-700 dark:text-green-300 text-xs font-medium rounded-full">
                                        Finance
                                    </span>
                                </div>
                                <h3 class="text-xl font-bold text-green-900 dark:text-green-100 mb-3 group-hover:text-green-700 dark:group-hover:text-green-200 transition-colors">
                                    Business Accounting & Finance
                                </h3>
                                <p class="text-green-700 dark:text-green-300 text-sm leading-relaxed mb-4">
                                    Master the fundamentals of accounting principles, financial management, and business analysis. Learn to prepare financial statements, conduct audits, and make strategic financial decisions.
                                </p>
                                <div class="space-y-2 mb-6">
                                    <div class="flex items-center text-green-600 dark:text-green-400 text-xs">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Financial Statement Analysis
                                    </div>
                                    <div class="flex items-center text-green-600 dark:text-green-400 text-xs">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Corporate Finance
                                    </div>
                                    <div class="flex items-center text-green-600 dark:text-green-400 text-xs">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Taxation & Compliance
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center text-green-600 dark:text-green-400 text-sm font-medium">
                                        <span>Apply</span>
                                        <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </div>
                                    <span class="text-green-600 dark:text-green-400 text-xs bg-green-50 dark:bg-green-900/30 px-2 py-1 rounded">
                                        2.5 Years
                                    </span>
                                </div>
                            </div>
                        </a>

                        <!-- Hospitality Management & Operations -->
                        <a href="{{ route('school') }}" class="group">
                            <div class="bg-gradient-to-br from-blue-50 to-cyan-50 dark:from-blue-900/20 dark:to-cyan-900/20 border-2 border-blue-200/60 dark:border-blue-700/60 rounded-xl p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="w-14 h-14 bg-blue-100 dark:bg-blue-900/50 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                        <svg class="w-7 h-7 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                    </div>
                                    <span class="px-3 py-1 bg-blue-100 dark:bg-blue-900/50 text-blue-700 dark:text-blue-300 text-xs font-medium rounded-full">
                                        Hospitality
                                    </span>
                                </div>
                                <h3 class="text-xl font-bold text-blue-900 dark:text-blue-100 mb-3 group-hover:text-blue-700 dark:group-hover:text-blue-200 transition-colors">
                                   Apprenticeship in Hospitality Management & Operations
                                </h3>
                                <p class="text-blue-700 dark:text-blue-300 text-sm leading-relaxed mb-4">
                                    Excel in the hospitality industry with comprehensive training in hotel operations, customer service excellence, event management, and tourism business strategies.
                                </p>
                                <div class="space-y-2 mb-6">
                                    <div class="flex items-center text-blue-600 dark:text-blue-400 text-xs">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Hotel & Resort Management
                                    </div>
                                    <div class="flex items-center text-blue-600 dark:text-blue-400 text-xs">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Event Planning & Management
                                    </div>
                                    <div class="flex items-center text-blue-600 dark:text-blue-400 text-xs">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Customer Service Excellence
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center text-blue-600 dark:text-blue-400 text-sm font-medium">
                                        <span>Apply</span>
                                        <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </div>
                                    <span class="text-blue-600 dark:text-blue-400 text-xs bg-blue-50 dark:bg-blue-900/30 px-2 py-1 rounded">
                                    Pass all modules,
                                    Pass all On-the-Job Trainings,
                                    Achieve 88 CV,
                                    Satisfactory attendance
                                    </span>
                                </div>
                            </div>
                        </a>

                        <!-- Human Capital Management -->
                        <a href="{{ route('school') }}" class="group">
                            <div class="bg-gradient-to-br from-purple-50 to-violet-50 dark:from-purple-900/20 dark:to-violet-900/20 border-2 border-purple-200/60 dark:border-purple-700/60 rounded-xl p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="w-14 h-14 bg-purple-100 dark:bg-purple-900/50 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                        <svg class="w-7 h-7 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </div>
                                    <span class="px-3 py-1 bg-purple-100 dark:bg-purple-900/50 text-purple-700 dark:text-purple-300 text-xs font-medium rounded-full">
                                        Human Resources
                                    </span>
                                </div>
                                <h3 class="text-xl font-bold text-purple-900 dark:text-purple-100 mb-3 group-hover:text-purple-700 dark:group-hover:text-purple-200 transition-colors">
                                    Human Capital Management
                                </h3>
                                <p class="text-purple-700 dark:text-purple-300 text-sm leading-relaxed mb-4">
                                    Develop expertise in human resource management, talent acquisition, organizational development, and employee engagement strategies for modern workplaces.
                                </p>
                                <div class="space-y-2 mb-6">
                                    <div class="flex items-center text-purple-600 dark:text-purple-400 text-xs">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Talent Acquisition & Retention
                                    </div>
                                    <div class="flex items-center text-purple-600 dark:text-purple-400 text-xs">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Organizational Psychology
                                    </div>
                                    <div class="flex items-center text-purple-600 dark:text-purple-400 text-xs">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Performance Management
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center text-purple-600 dark:text-purple-400 text-sm font-medium">
                                        <span>Apply</span>
                                        <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </div>
                                    <span class="text-purple-600 dark:text-purple-400 text-xs bg-purple-50 dark:bg-purple-900/30 px-2 py-1 rounded">
                                        2.5 Years
                                    </span>
                                </div>
                            </div>
                        </a>

                        <!-- Entrepreneurship & Marketing Strategies -->
                        <a href="{{ route('school') }}" class="group">
                            <div class="bg-gradient-to-br from-orange-50 to-amber-50 dark:from-orange-900/20 dark:to-amber-900/20 border-2 border-orange-200/60 dark:border-orange-700/60 rounded-xl p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="w-14 h-14 bg-orange-100 dark:bg-orange-900/50 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                        <svg class="w-7 h-7 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                        </svg>
                                    </div>
                                    <span class="px-3 py-1 bg-orange-100 dark:bg-orange-900/50 text-orange-700 dark:text-orange-300 text-xs font-medium rounded-full">
                                        Marketing
                                    </span>
                                </div>
                                <h3 class="text-xl font-bold text-orange-900 dark:text-orange-100 mb-3 group-hover:text-orange-700 dark:group-hover:text-orange-200 transition-colors">
                                    Entrepreneurship & Marketing Strategies
                                </h3>
                                <p class="text-orange-700 dark:text-orange-300 text-sm leading-relaxed mb-4">
                                    Learn to create and grow businesses with innovative marketing strategies, digital marketing expertise, and entrepreneurial thinking for the modern economy.
                                </p>
                                <div class="space-y-2 mb-6">
                                    <div class="flex items-center text-orange-600 dark:text-orange-400 text-xs">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Business Development
                                    </div>
                                    <div class="flex items-center text-orange-600 dark:text-orange-400 text-xs">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Digital Marketing
                                    </div>
                                    <div class="flex items-center text-orange-600 dark:text-orange-400 text-xs">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                        Strategic Planning
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center text-orange-600 dark:text-orange-400 text-sm font-medium">
                                        <span>Apply</span>
                                        <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </div>
                                    <span class="text-orange-600 dark:text-orange-400 text-xs bg-orange-50 dark:bg-orange-900/30 px-2 py-1 rounded">
                                        2.5 Years
                                    </span>
                                </div>
                            </div>
                        </a>

                    </div>
                </div>
            </div>

            <!-- Additional Information Section -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <!-- Career Opportunities -->
                <div class="bg-white/90 dark:bg-gray-800 backdrop-blur-sm rounded-xl shadow-lg border border-stone-200/60 dark:border-slate-700/60 p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-green-100 dark:bg-green-900/50 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6m0 0L8 6m8 0v6h4a2 2 0 002-2V8a2 2 0 00-2-2h-4zM6 12V8a2 2 0 012-2h8v4H8a2 2 0 00-2 2v2z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100">Career Opportunities</h3>
                    </div>
                    <p class="text-slate-600 dark:text-slate-300 text-sm mb-4">
                        Our business programmes prepare you for diverse career paths in various industries.
                    </p>
                    <ul class="space-y-2 text-sm text-slate-600 dark:text-slate-300">
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Financial Analyst & Accountant
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Hotel & Restaurant Manager
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            HR Specialist & Recruiter
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Marketing Manager & Entrepreneur
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Business Consultant
                        </li>
                    </ul>
                </div>

                <!-- Admission Requirements -->
                <div class="bg-white/90 dark:bg-gray-800 backdrop-blur-sm rounded-xl shadow-lg border border-stone-200/60 dark:border-slate-700/60 p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/50 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100">Admission Requirements</h3>
                    </div>
                    <p class="text-slate-600 dark:text-slate-300 text-sm mb-4">
                        General requirements for admission to our business programmes.
                    </p>
                    <ul class="space-y-2 text-sm text-slate-600 dark:text-slate-300">
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Secondary School Certificate or equivalent
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Minimum Grade in Mathematics & English
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Portfolio/Interview (for some programmes)
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            English Language Proficiency
                        </li>
                    </ul>
                </div>

            </div>

            

        </div>
    </div>
</x-layouts.app>