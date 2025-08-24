<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('School of ICT') }}
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
                                <span class="ml-1 text-sm font-medium text-slate-500 md:ml-2 dark:text-slate-400">School of ICT</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>

            <!-- School Header -->
            <div class="bg-gradient-to-r from-purple-50 to-violet-50 dark:from-purple-900/20 dark:to-violet-900/20 rounded-2xl shadow-xl border border-purple-200/60 dark:border-purple-700/60 overflow-hidden mb-8">
                <div class="px-8 py-12 text-center">
                   <div class="w-20 h-20 mx-auto mb-6 bg-purple-100 dark:bg-purple-900/50 rounded-2xl flex items-center justify-center">
                        <svg class="w-10 h-10 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h1 class="text-4xl font-bold text-purple-900 dark:text-purple-100 mb-4">
                        School of Information & Communication Technology
                    </h1>
                    <p class="text-lg text-purple-700 dark:text-purple-300 max-w-3xl mx-auto leading-relaxed">
                        Shape the digital future with cutting-edge technology programmes designed for the modern tech industry. Master programming, web development, digital media, cloud technologies, and data analytics to drive innovation and digital transformation.
                    </p>
                    <div class="mt-6 inline-flex items-center px-4 py-2 bg-purple-100 dark:bg-purple-900/50 rounded-full text-purple-700 dark:text-purple-300">
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
                    
                    <!-- Application Development -->
                    <a href="{{ route('school') }}" class="group">
                        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 border-2 border-blue-200/60 dark:border-blue-700/60 rounded-xl p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                            <div class="flex items-start justify-between mb-4">
                                <div class="w-14 h-14 bg-blue-100 dark:bg-blue-900/50 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-7 h-7 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                                    </svg>
                                </div>
                                <span class="px-3 py-1 bg-blue-100 dark:bg-blue-900/50 text-blue-700 dark:text-blue-300 text-xs font-medium rounded-full">
                                    Level 5 Diploma
                                </span>
                            </div>
                            <h3 class="text-xl font-bold text-blue-900 dark:text-blue-100 mb-3 group-hover:text-blue-700 dark:group-hover:text-blue-200 transition-colors">
                                Application Development
                            </h3>
                            <p class="text-blue-700 dark:text-blue-300 text-sm leading-relaxed mb-4">
                                Master modern programming languages and frameworks to build robust desktop, web, and mobile applications. Learn software engineering principles, database design, and user interface development for creating innovative digital solutions.
                            </p>
                            <div class="space-y-2 mb-6">
                                <div class="flex items-center text-blue-600 dark:text-blue-400 text-xs">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Java, C#, Python Programming
                                </div>
                                <div class="flex items-center text-blue-600 dark:text-blue-400 text-xs">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Mobile App Development
                                </div>
                                <div class="flex items-center text-blue-600 dark:text-blue-400 text-xs">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Database Design & Management
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
                                    2.5 Years
                                </span>
                            </div>
                        </div>
                    </a>

                    <!-- Web Technology -->
                    <a href="{{ route('school') }}" class="group">
                        <div class="bg-gradient-to-br from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 border-2 border-green-200/60 dark:border-green-700/60 rounded-xl p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                            <div class="flex items-start justify-between mb-4">
                                <div class="w-14 h-14 bg-green-100 dark:bg-green-900/50 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-7 h-7 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                    </svg>
                                </div>
                                <span class="px-3 py-1 bg-green-100 dark:bg-green-900/50 text-green-700 dark:text-green-300 text-xs font-medium rounded-full">
                                    Level 5 Diploma
                                </span>
                            </div>
                            <h3 class="text-xl font-bold text-green-900 dark:text-green-100 mb-3 group-hover:text-green-700 dark:group-hover:text-green-200 transition-colors">
                                Web Technology
                            </h3>
                            <p class="text-green-700 dark:text-green-300 text-sm leading-relaxed mb-4">
                                Become a full-stack web developer by mastering front-end and back-end technologies. Learn modern web frameworks, responsive design, server management, and e-commerce solutions to create dynamic, interactive websites and web applications.
                            </p>
                            <div class="space-y-2 mb-6">
                                <div class="flex items-center text-green-600 dark:text-green-400 text-xs">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    HTML5, CSS3, JavaScript, React
                                </div>
                                <div class="flex items-center text-green-600 dark:text-green-400 text-xs">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    PHP, Node.js, Laravel Framework
                                </div>
                                <div class="flex items-center text-green-600 dark:text-green-400 text-xs">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    E-commerce & CMS Development
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

                    <!-- Digital Arts & Media -->
                    <a href="{{ route('school') }}" class="group">
                        <div class="bg-gradient-to-br from-pink-50 to-rose-50 dark:from-pink-900/20 dark:to-rose-900/20 border-2 border-pink-200/60 dark:border-pink-700/60 rounded-xl p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                            <div class="flex items-start justify-between mb-4">
                                <div class="w-14 h-14 bg-pink-100 dark:bg-pink-900/50 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-7 h-7 text-pink-600 dark:text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <span class="px-3 py-1 bg-pink-100 dark:bg-pink-900/50 text-pink-700 dark:text-pink-300 text-xs font-medium rounded-full">
                                    Level 5 Diploma
                                </span>
                            </div>
                            <h3 class="text-xl font-bold text-pink-900 dark:text-pink-100 mb-3 group-hover:text-pink-700 dark:group-hover:text-pink-200 transition-colors">
                                Digital Arts & Media
                            </h3>
                            <p class="text-pink-700 dark:text-pink-300 text-sm leading-relaxed mb-4">
                                Unleash your creativity through digital design and multimedia production. Master graphic design, video editing, animation, and digital marketing to create compelling visual content for various media platforms and marketing campaigns.
                            </p>
                            <div class="space-y-2 mb-6">
                                <div class="flex items-center text-pink-600 dark:text-pink-400 text-xs">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Adobe Creative Suite Mastery
                                </div>
                                <div class="flex items-center text-pink-600 dark:text-pink-400 text-xs">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Video Production & Animation
                                </div>
                                <div class="flex items-center text-pink-600 dark:text-pink-400 text-xs">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    UI/UX Design & Branding
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
                                    2.5 Years
                                </span>
                            </div>
                        </div>
                    </a>

                    <!-- Cloud Networking -->
                    <a href="{{ route('school') }}" class="group">
                        <div class="bg-gradient-to-br from-cyan-50 to-blue-50 dark:from-cyan-900/20 dark:to-blue-900/20 border-2 border-cyan-200/60 dark:border-cyan-700/60 rounded-xl p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                            <div class="flex items-start justify-between mb-4">
                                <div class="w-14 h-14 bg-cyan-100 dark:bg-cyan-900/50 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-7 h-7 text-cyan-600 dark:text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                                    </svg>
                                </div>
                                <span class="px-3 py-1 bg-cyan-100 dark:bg-cyan-900/50 text-cyan-700 dark:text-cyan-300 text-xs font-medium rounded-full">
                                    Level 5 Diploma
                                </span>
                            </div>
                            <h3 class="text-xl font-bold text-cyan-900 dark:text-cyan-100 mb-3 group-hover:text-cyan-700 dark:group-hover:text-cyan-200 transition-colors">
                                Cloud Networking
                            </h3>
                            <p class="text-cyan-700 dark:text-cyan-300 text-sm leading-relaxed mb-4">
                                Master the future of IT infrastructure with cloud computing and network administration. Learn to design, implement, and manage cloud solutions, network security, and enterprise-level IT systems for modern organizations.
                            </p>
                            <div class="space-y-2 mb-6">
                                <div class="flex items-center text-cyan-600 dark:text-cyan-400 text-xs">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    AWS, Azure, Google Cloud Platform
                                </div>
                                <div class="flex items-center text-cyan-600 dark:text-cyan-400 text-xs">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Network Security & Cybersecurity
                                </div>
                                <div class="flex items-center text-cyan-600 dark:text-cyan-400 text-xs">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Server Administration & DevOps
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center text-cyan-600 dark:text-cyan-400 text-sm font-medium">
                                    <span>Apply</span>
                                    <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </div>
                                <span class="text-cyan-600 dark:text-cyan-400 text-xs bg-cyan-50 dark:bg-cyan-900/30 px-2 py-1 rounded">
                                    2.5 Years
                                </span>
                            </div>
                        </div>
                    </a>

                </div>
            </div>
            
            <!-- Data Analytics Programme (Full Width) -->
            <div class="mt-8 px-8">
                <a href="{{ route('school') }}" class="group block">
                    <div class="bg-gradient-to-br from-amber-50 to-orange-50 dark:from-amber-900/20 dark:to-orange-900/20 border-2 border-amber-200/60 dark:border-amber-700/60 rounded-xl p-6 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="flex items-start justify-between mb-4">
                            <div class="w-14 h-14 bg-amber-100 dark:bg-amber-900/50 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-7 h-7 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                            <span class="px-3 py-1 bg-amber-100 dark:bg-amber-900/50 text-amber-700 dark:text-amber-300 text-xs font-medium rounded-full">
                                Level 5 Diploma
                            </span>
                        </div>
                        <h3 class="text-xl font-bold text-amber-900 dark:text-amber-100 mb-3 group-hover:text-amber-700 dark:group-hover:text-amber-200 transition-colors">
                            Data Analytics
                        </h3>
                        <p class="text-amber-700 dark:text-amber-300 text-sm leading-relaxed mb-4">
                            Transform raw data into actionable business insights through advanced analytics and visualization techniques. Master statistical analysis, machine learning, big data processing, and business intelligence tools to drive data-driven decision making in modern organizations.
                        </p>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                            <div class="flex items-center text-amber-600 dark:text-amber-400 text-xs">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Python, R, SQL Programming
                            </div>
                            <div class="flex items-center text-amber-600 dark:text-amber-400 text-xs">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Machine Learning & AI
                            </div>
                            <div class="flex items-center text-amber-600 dark:text-amber-400 text-xs">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Tableau, Power BI Visualization
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center text-amber-600 dark:text-amber-400 text-sm font-medium">
                                <span>Apply</span>
                                <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                            <span class="text-amber-600 dark:text-amber-400 text-xs bg-amber-50 dark:bg-amber-900/30 px-2 py-1 rounded">
                                2.5 Years
                            </span>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Career Opportunities Section -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <!-- Career Opportunities -->
                <div class="bg-white/90 dark:bg-gray-800 backdrop-blur-sm rounded-xl shadow-lg border border-stone-200/60 dark:border-slate-700/60 p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900/50 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6m0 0L8 6m8 0v6h4a2 2 0 002-2V8a2 2 0 00-2-2h-4zM6 12V8a2 2 0 012-2h8v4H8a2 2 0 00-2 2v2z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100">Career Opportunities</h3>
                    </div>
                    <p class="text-slate-600 dark:text-slate-300 text-sm mb-4">
                        Our ICT programmes prepare you for high-demand careers in the rapidly evolving technology sector.
                    </p>
                    <ul class="space-y-2 text-sm text-slate-600 dark:text-slate-300">
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-purple-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Software Developer & Mobile App Developer
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-purple-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Full-Stack Web Developer & UI/UX Designer
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-purple-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Digital Media Specialist & Content Creator
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-purple-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Cloud Solutions Architect & DevOps Engineer
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-purple-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Data Analyst & Business Intelligence Specialist
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-purple-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Network Administrator & Cybersecurity Analyst
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
                        General requirements for admission to our ICT programmes.
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
                            Credits in Mathematics & English Language
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Basic computer literacy & logical thinking
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Portfolio submission (for Digital Arts & Media)
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Interview & aptitude assessment
                        </li>
                    </ul>
                </div>

            </div>

            <!-- Industry Partners & Facilities -->
            <div class="mt-8 bg-white/90 dark:bg-gray-800 backdrop-blur-sm rounded-xl shadow-lg border border-stone-200/60 dark:border-slate-700/60 p-8">
                <div class="text-center mb-8">
                    <h3 class="text-2xl font-semibold text-slate-900 dark:text-slate-100 mb-4">
                        State-of-the-Art Facilities & Industry Partnerships
                    </h3>
                    <p class="text-slate-600 dark:text-slate-300 max-w-3xl mx-auto">
                        Learn with the latest technology and gain real-world experience through our industry collaborations
                    </p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div class="w-16 h-16 mx-auto mb-4 bg-purple-100 dark:bg-purple-900/50 rounded-xl flex items-center justify-center">
                            <svg class="w-8 h-8 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 7.172V5L8 4z" />
                            </svg>
                        </div>
                        <h4 class="text-lg font-semibold text-slate-900 dark:text-slate-100 mb-2">Modern Labs</h4>
                        <p class="text-sm text-slate-600 dark:text-slate-300">
                            Advanced computer labs, multimedia studios, and cloud infrastructure for hands-on learning
                        </p>
                    </div>
                    
                    <div class="text-center">
                        <div class="w-16 h-16 mx-auto mb-4 bg-green-100 dark:bg-green-900/50 rounded-xl flex items-center justify-center">
                            <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6m0 0L8 6m8 0v6h4a2 2 0 002-2V8a2 2 0 00-2-2h-4zM6 12V8a2 2 0 012-2h8v4H8a2 2 0 00-2 2v2z" />
                            </svg>
                        </div>
                        <h4 class="text-lg font-semibold text-slate-900 dark:text-slate-100 mb-2">Industry Partners</h4>
                        <p class="text-sm text-slate-600 dark:text-slate-300">
                            Partnerships with Microsoft, Google, Amazon, and local tech companies for internships and jobs
                        </p>
                    </div>
                    
                    <div class="text-center">
                        <div class="w-16 h-16 mx-auto mb-4 bg-blue-100 dark:bg-blue-900/50 rounded-xl flex items-center justify-center">
                            <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <h4 class="text-lg font-semibold text-slate-900 dark:text-slate-100 mb-2">Certifications</h4>
                        <p class="text-sm text-slate-600 dark:text-slate-300">
                            Industry-recognized certifications including AWS, Microsoft Azure, Google Cloud, and Adobe
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-layouts.app>