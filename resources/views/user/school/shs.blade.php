<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('School of Health Sciences') }}
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
                                <span class="ml-1 text-sm font-medium text-slate-500 md:ml-2 dark:text-slate-400">School of Health Sciences</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>

            <!-- School Header -->

            <div class="bg-gradient-to-r from-red-50 to-rose-50 dark:from-red-900/20 dark:to-rose-900/20 rounded-2xl shadow-xl border border-red-200/60 dark:border-red-700/60 overflow-hidden mb-8">
                <div class="px-8 py-12 text-center">
                   <div class="w-20 h-20 mx-auto mb-6 bg-red-100 dark:bg-red-900/50 rounded-2xl flex items-center justify-center">
                        <svg class="w-7 h-7 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </div>
                    <h1 class="text-4xl font-bold text-red-900 dark:text-green-100 mb-4">
                        School of Health Sciences
                    </h1>
                    <p class="text-lg text-red-700 dark:text-red-300 max-w-3xl mx-auto leading-relaxed">
                        Prepare for a rewarding career in healthcare with programmes that combine scientific knowledge, practical training, and compassionate care. Our curriculum equips future nurses, midwives, paramedics, and public health professionals with the skills to deliver high-quality healthcare services and improve community well-being.
                    </p>
                    <div class="mt-6 inline-flex items-center px-4 py-2 bg-red-100 dark:bg-red-900/50 rounded-full text-red-700 dark:text-red-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        5 Programmes Available
                    </div>
                </div>
            </div>

            <!-- Programmes Grid -->
        
<div class="p-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        
        <!-- Nursing -->
        <a href="{{ route('school') }}" class="group">
            <div class="bg-gradient-to-br from-red-50 to-rose-50 dark:from-red-900/20 dark:to-rose-900/20 border-2 border-red-200/60 dark:border-red-700/60 rounded-xl p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-14 h-14 bg-red-100 dark:bg-red-900/50 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </div>
                    <span class="px-3 py-1 bg-red-100 dark:bg-red-900/50 text-red-700 dark:text-red-300 text-xs font-medium rounded-full">
                        Level 5 Diploma
                    </span>
                </div>
                <h3 class="text-xl font-bold text-red-900 dark:text-red-100 mb-3 group-hover:text-red-700 dark:group-hover:text-red-200 transition-colors">
                    Nursing
                </h3>
                <p class="text-red-700 dark:text-red-300 text-sm leading-relaxed mb-4">
                    Prepare to become a competent and compassionate first-level nurse through evidence-based training and patient-centred care. Gain the knowledge and hands-on skills to provide safe and quality healthcare in hospitals, clinics, and community settings.   
                </p>
                <div class="space-y-2 mb-6">
                    <div class="flex items-center text-red-600 dark:text-red-400 text-xs">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Evidence-Based Practice
                    </div>
                    <div class="flex items-center text-red-600 dark:text-red-400 text-xs">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Clinical Placements
                    </div>
                    <div class="flex items-center text-red-600 dark:text-red-400 text-xs">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Patient-Centred Care
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center text-red-600 dark:text-red-400 text-sm font-medium">
                        <span>Apply</span>
                        <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                    <span class="text-red-600 dark:text-red-400 text-xs bg-red-50 dark:bg-red-900/30 px-2 py-1 rounded">
                        3 Years
                    </span>
                </div>
            </div>
        </a>

        <!-- Midwifery -->
        <a href="{{ route('school') }}" class="group">
            <div class="bg-gradient-to-br from-pink-50 to-rose-50 dark:from-pink-900/20 dark:to-rose-900/20 border-2 border-pink-200/60 dark:border-pink-700/60 rounded-xl p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-14 h-14 bg-pink-100 dark:bg-pink-900/50 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-pink-600 dark:text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                        </svg>
                    </div>
                    <span class="px-3 py-1 bg-pink-100 dark:bg-pink-900/50 text-pink-700 dark:text-pink-300 text-xs font-medium rounded-full">
                        Level 5 Diploma
                    </span>
                </div>
                <h3 class="text-xl font-bold text-pink-900 dark:text-pink-100 mb-3 group-hover:text-pink-700 dark:group-hover:text-pink-200 transition-colors">
                    Midwifery
                </h3>
                <p class="text-pink-700 dark:text-pink-300 text-sm leading-relaxed mb-4">
                    Train to provide high-quality, woman-centred maternity care with a strong focus on safety and compassion. This programme equips you with the skills to support women throughout pregnancy, childbirth, and postnatal care in both hospital and community settings. 
                </p>
                <div class="space-y-2 mb-6">
                    <div class="flex items-center text-pink-600 dark:text-pink-400 text-xs">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Woman-Centred Approach
                    </div>
                    <div class="flex items-center text-pink-600 dark:text-pink-400 text-xs">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Antenatal & Postnatal Care
                    </div>
                    <div class="flex items-center text-pink-600 dark:text-pink-400 text-xs">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Clinical Training & Placements
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center text-pink-600 dark:text-pink-400 text-sm font-medium">
                        <span>Apply</span>
                        <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                    <span class="text-pink-600 dark:text-pink-400 text-xs bg-pink-50 dark:bg-pink-900/30 px-2 py-1 rounded">
                        3 Years
                    </span>
                </div>
            </div>
        </a>

        <!-- Paramedic -->
        <a href="{{ route('school') }}" class="group">
            <div class="bg-gradient-to-br from-orange-50 to-amber-50 dark:from-orange-900/20 dark:to-amber-900/20 border-2 border-orange-200/60 dark:border-orange-700/60 rounded-xl p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-14 h-14 bg-orange-100 dark:bg-orange-900/50 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 7.172V5L8 4z" />
                        </svg>
                    </div>
                    <span class="px-3 py-1 bg-orange-100 dark:bg-orange-900/50 text-orange-700 dark:text-orange-300 text-xs font-medium rounded-full">
                        Level 5 Diploma
                    </span>
                </div>
                <h3 class="text-xl font-bold text-orange-900 dark:text-orange-100 mb-3 group-hover:text-orange-700 dark:group-hover:text-orange-200 transition-colors">
                    Paramedic
                </h3>
                <p class="text-orange-700 dark:text-orange-300 text-sm leading-relaxed mb-4">
                    Train to become a skilled emergency medical professional capable of providing life-saving care in critical situations. Learn advanced emergency medical procedures, patient assessment, and emergency response protocols for pre-hospital care.
                </p>
                <div class="space-y-2 mb-6">
                    <div class="flex items-center text-orange-600 dark:text-orange-400 text-xs">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Emergency Medical Care
                    </div>
                    <div class="flex items-center text-orange-600 dark:text-orange-400 text-xs">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Pre-Hospital Care
                    </div>
                    <div class="flex items-center text-orange-600 dark:text-orange-400 text-xs">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Critical Care Training
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
                        3 Years
                    </span>
                </div>
            </div>
        </a>

        <!-- Cardiovascular Technology -->
        <a href="{{ route('school') }}" class="group">
            <div class="bg-gradient-to-br from-purple-50 to-violet-50 dark:from-purple-900/20 dark:to-violet-900/20 border-2 border-purple-200/60 dark:border-purple-700/60 rounded-xl p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-14 h-14 bg-purple-100 dark:bg-purple-900/50 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <span class="px-3 py-1 bg-purple-100 dark:bg-purple-900/50 text-purple-700 dark:text-purple-300 text-xs font-medium rounded-full">
                        Level 5 Diploma
                    </span>
                </div>
                <h3 class="text-xl font-bold text-purple-900 dark:text-purple-100 mb-3 group-hover:text-purple-700 dark:group-hover:text-purple-200 transition-colors">
                    Cardiovascular Technology
                </h3>
                <p class="text-purple-700 dark:text-purple-300 text-sm leading-relaxed mb-4">
                    Explore the ever-evolving field of cardiovascular diagnostics with an integrated clinical approach. Gain expertise in cardiovascular diagnostic procedures, imaging technologies, and patient care in specialized cardiac units.
                </p>
                <div class="space-y-2 mb-6">
                    <div class="flex items-center text-purple-600 dark:text-purple-400 text-xs">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Cardiovascular Diagnostics
                    </div>
                    <div class="flex items-center text-purple-600 dark:text-purple-400 text-xs">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Imaging Technologies
                    </div>
                    <div class="flex items-center text-purple-600 dark:text-purple-400 text-xs">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Integrated Clinical Approach
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
                        3 Years
                    </span>
                </div>
            </div>
        </a>

        

        

    </div>
</div>
<div class="mt-8 grid grid-cols-2 md:grid-cols-1 gap-8">
            <!-- Public Health -->
        <a href="{{ route('school') }}" class="group">
            <div class="bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-emerald-900/20 dark:to-teal-900/20 border-2 border-emerald-200/60 dark:border-emerald-700/60 rounded-xl p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-14 h-14 bg-emerald-100 dark:bg-emerald-900/50 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-7 h-7 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <span class="px-3 py-1 bg-emerald-100 dark:bg-emerald-900/50 text-emerald-700 dark:text-emerald-300 text-xs font-medium rounded-full">
                        Level 5 Diploma
                    </span>
                </div>
                <h3 class="text-xl font-bold text-emerald-900 dark:text-emerald-100 mb-3 group-hover:text-emerald-700 dark:group-hover:text-emerald-200 transition-colors">
                    Public Health
                </h3>
                <p class="text-emerald-700 dark:text-emerald-300 text-sm leading-relaxed mb-4">
                    Learn to promote and protect community health through disease prevention, health education, and policy development. Focus on epidemiology, biostatistics, environmental health, and community health interventions.
                </p>
                <div class="space-y-2 mb-6">
                    <div class="flex items-center text-emerald-600 dark:text-emerald-400 text-xs">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Disease Prevention
                    </div>
                    <div class="flex items-center text-emerald-600 dark:text-emerald-400 text-xs">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Epidemiology & Biostatistics
                    </div>
                    <div class="flex items-center text-emerald-600 dark:text-emerald-400 text-xs">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Community Health Interventions
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center text-emerald-600 dark:text-emerald-400 text-sm font-medium">
                        <span>Apply</span>
                        <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                    <span class="text-emerald-600 dark:text-emerald-400 text-xs bg-emerald-50 dark:bg-emerald-900/30 px-2 py-1 rounded">
                        3 Years
                    </span>
                </div>
            </div>
        </a>

        </div>
<!-- Updated Career Opportunities Section -->
<div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-8">
    
    <!-- Career Opportunities -->
    <div class="bg-white/90 dark:bg-gray-800 backdrop-blur-sm rounded-xl shadow-lg border border-stone-200/60 dark:border-slate-700/60 p-6">
        <div class="flex items-center mb-4">
            <div class="w-10 h-10 bg-red-100 dark:bg-red-900/50 rounded-lg flex items-center justify-center mr-3">
                <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6m0 0L8 6m8 0v6h4a2 2 0 002-2V8a2 2 0 00-2-2h-4zM6 12V8a2 2 0 012-2h8v4H8a2 2 0 00-2 2v2z" />
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100">Career Opportunities</h3>
        </div>
        <p class="text-slate-600 dark:text-slate-300 text-sm mb-4">
            Our health sciences programmes prepare you for rewarding careers in healthcare across various settings.
        </p>
        <ul class="space-y-2 text-sm text-slate-600 dark:text-slate-300">
            <li class="flex items-center">
                <svg class="w-4 h-4 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Registered Nurse & Clinical Specialist
            </li>
            <li class="flex items-center">
                <svg class="w-4 h-4 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Certified Midwife & Birth Assistant
            </li>
            <li class="flex items-center">
                <svg class="w-4 h-4 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Emergency Medical Technician
            </li>
            <li class="flex items-center">
                <svg class="w-4 h-4 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Cardiovascular Technologist
            </li>
            <li class="flex items-center">
                <svg class="w-4 h-4 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Public Health Officer & Educator
            </li>
            <li class="flex items-center">
                <svg class="w-4 h-4 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Dental Hygienist & Therapist
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
            General requirements for admission to our health sciences programmes.
        </p>
        <ul class="space-y-2 text-sm text-slate-600 dark:text-slate-300">
            <li class="flex items-center">
                <svg class="w-4 h-4 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                GCE 'O' Level or equivalent qualification
            </li>
            <li class="flex items-center">
                <svg class="w-4 h-4 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Credits in Mathematics, English & Science
            </li>
            <li class="flex items-center">
                <svg class="w-4 h-4 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Medical fitness certificate required
            </li>
            <li class="flex items-center">
                <svg class="w-4 h-4 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Interview & aptitude assessment
            </li>
            <li class="flex items-center">
                <svg class="w-4 h-4 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                English language proficiency
            </li>
        </ul>
    </div>

</div>
            

            

        </div>
    </div>
</x-layouts.app>