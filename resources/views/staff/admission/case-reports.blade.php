<x-layouts.app title="Case Reports">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Case Reports') }}
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

                <!-- Header -->
                <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden mb-6">
                    <div class="bg-gradient-to-r from-blue-400/90 to-purple-500/90 text-white text-center py-4">
                        <h1 class="text-2xl font-bold">CASE REPORTS</h1>
                    </div>
                </div>

                <!-- Statistics Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                    @php
                        $totalCases = $caseReports->total();
                        $pendingCases = \App\Models\CaseReport::where('status', 'pending')->count();
                        $inProgressCases = \App\Models\CaseReport::where('status', 'in progress')->count();
                        $solvedCases = \App\Models\CaseReport::where('status', 'solved')->count();
                    @endphp

                    <!-- Total Cases -->
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-xl shadow-lg border border-slate-200/60 dark:border-slate-700/60 p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900/20">
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-2xl font-bold text-slate-900 dark:text-slate-100">{{ $totalCases }}</p>
                                <p class="text-sm text-slate-600 dark:text-slate-400">Total Cases</p>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Cases -->
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-xl shadow-lg border border-slate-200/60 dark:border-slate-700/60 p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-red-100 dark:bg-red-900/20">
                                <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-2xl font-bold text-slate-900 dark:text-slate-100">{{ $pendingCases }}</p>
                                <p class="text-sm text-slate-600 dark:text-slate-400">Pending</p>
                            </div>
                        </div>
                    </div>

                    <!-- In Progress Cases -->
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-xl shadow-lg border border-slate-200/60 dark:border-slate-700/60 p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-orange-100 dark:bg-orange-900/20">
                                <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-2xl font-bold text-slate-900 dark:text-slate-100">{{ $inProgressCases }}</p>
                                <p class="text-sm text-slate-600 dark:text-slate-400">In Progress</p>
                            </div>
                        </div>
                    </div>

                    <!-- Solved Cases -->
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-xl shadow-lg border border-slate-200/60 dark:border-slate-700/60 p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 dark:bg-green-900/20">
                                <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-2xl font-bold text-slate-900 dark:text-slate-100">{{ $solvedCases }}</p>
                                <p class="text-sm text-slate-600 dark:text-slate-400">Solved</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filters and Search -->
                <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 p-6 mb-6">
                    <form method="GET" action="{{ route('staff.case-reports') }}" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                            <!-- Search -->
                            <div class="lg:col-span-2">
                                <label for="search" class="block text-sm font-medium text-slate-700 dark:text-slate-200 mb-1">Search</label>
                                <input type="text" 
                                       id="search" 
                                       name="search" 
                                       value="{{ request('search') }}"
                                       placeholder="Search by subject, user name, or description..."
                                       class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <!-- Subject Type Filter -->
                            <div>
                                <label for="subject_type" class="block text-sm font-medium text-slate-700 dark:text-slate-200 mb-1">Subject Type</label>
                                <select id="subject_type" 
                                        name="subject_type" 
                                        class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">All Types</option>
                                    <option value="Hntec" {{ request('subject_type') == 'Hntec' ? 'selected' : '' }}>Hntec</option>
                                    <option value="O-Level" {{ request('subject_type') == 'O-Level' ? 'selected' : '' }}>O-Level</option>
                                    <option value="A-Level" {{ request('subject_type') == 'A-Level' ? 'selected' : '' }}>A-Level</option>
                                </select>
                            </div>

                            <!-- Case Type Filter -->
                            <div>
                                <label for="case_type" class="block text-sm font-medium text-slate-700 dark:text-slate-200 mb-1">Case Type</label>
                                <select id="case_type" 
                                        name="case_type" 
                                        class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">All Cases</option>
                                    <option value="Incorrect Data" {{ request('case_type') == 'Incorrect Data' ? 'selected' : '' }}>Incorrect Data</option>
                                </select>
                            </div>

                            <!-- Status Filter -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-slate-700 dark:text-slate-200 mb-1">Status</label>
                                <select id="status" 
                                        name="status" 
                                        class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">All Status</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="in progress" {{ request('status') == 'in progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="solved" {{ request('status') == 'solved' ? 'selected' : '' }}>Solved</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex justify-between items-center">
                            <div class="flex gap-2">
                                <button type="submit" 
                                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                    Filter
                                </button>
                                <a href="{{ route('staff.case-reports') }}" 
                                   class="bg-slate-500 hover:bg-slate-600 text-white px-4 py-2 rounded-lg transition-colors">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                    </svg>
                                    Reset
                                </a>
                            </div>
                            
                            @if(request()->hasAny(['search', 'subject_type', 'case_type', 'status']))
                                <div class="text-sm text-slate-600 dark:text-slate-400">
                                    Showing filtered results ({{ $caseReports->total() }} {{ $caseReports->total() == 1 ? 'case' : 'cases' }})
                                </div>
                            @endif
                        </div>
                    </form>
                </div>

                <!-- Case Reports Table -->
                <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-700">
                        <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100">All Case Reports</h3>
                    </div>

                    @if($caseReports->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-slate-50 dark:bg-slate-700/50">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">User ID</th>
                                        <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Subject</th>
                                        <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Subject Type</th>
                                        <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Case Type</th>
                                        <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Description</th>
                                        <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Submitted At</th>
                                        <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">View Results</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                                    @foreach($caseReports as $caseReport)
                                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-8 w-8">
                                                        <div class="h-8 w-8 rounded-full bg-slate-300 dark:bg-slate-600 flex items-center justify-center">
                                                            <span class="text-sm font-medium text-slate-700 dark:text-slate-200">{{ substr($caseReport->user->name, 0, 1) }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="ml-3">
                                                        <div class="text-sm font-medium text-slate-900 dark:text-slate-100">{{ $caseReport->user_id }}</div>
                                                        <div class="text-xs text-slate-500 dark:text-slate-400">{{ $caseReport->user->name }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900 dark:text-slate-100">{{ $caseReport->subject }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                                    @if($caseReport->subject_type == 'Hntec') bg-blue-100 text-blue-800 dark:bg-blue-900/20 dark:text-blue-300
                                                    @elseif($caseReport->subject_type == 'O-Level') bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-300
                                                    @else bg-purple-100 text-purple-800 dark:bg-purple-900/20 dark:text-purple-300 @endif">
                                                    {{ $caseReport->subject_type }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-300">
                                                    {{ $caseReport->case_type }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-sm text-slate-900 dark:text-slate-100">
                                                <div class="max-w-xs">
                                                    <p class="truncate">{{ $caseReport->description }}</p>
                                                    @if(strlen($caseReport->description) > 50)
                                                        <button class="text-blue-600 dark:text-blue-400 text-xs hover:underline" onclick="toggleDescription({{ $caseReport->id }})">
                                                            Show more
                                                        </button>
                                                        <div id="description-{{ $caseReport->id }}" class="hidden mt-2 text-xs">
                                                            {{ $caseReport->description }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 dark:text-slate-400">
                                                {{ $caseReport->created_at->format('M d, Y') }}<br>
                                                <span class="text-xs">{{ $caseReport->created_at->format('H:i A') }}</span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <form method="POST" action="{{ route('staff.case-report.update-status', $caseReport) }}" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <select name="status" 
                                                            onchange="this.form.submit()" 
                                                            class="text-xs rounded-full border-0 px-3 py-1 
                                                                @if($caseReport->status == 'pending') bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-300
                                                                @elseif($caseReport->status == 'in progress') bg-orange-100 text-orange-800 dark:bg-orange-900/20 dark:text-orange-300
                                                                @else bg-green-100 text-green-800 dark:bg-green-900/20 dark:text-green-300 @endif">
                                                        <option value="pending" {{ $caseReport->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                        <option value="in progress" {{ $caseReport->status == 'in progress' ? 'selected' : '' }}>In Progress</option>
                                                        <option value="solved" {{ $caseReport->status == 'solved' ? 'selected' : '' }}>Solved</option>
                                                    </select>
                                                </form>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('staff.admission.view-results', $caseReport->user_id) }}" 
                                                   class="inline-flex items-center px-3 py-2 text-sm font-medium text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 bg-blue-50 hover:bg-blue-100 dark:bg-blue-900/20 dark:hover:bg-blue-900/40 rounded-lg transition-colors">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                    </svg>
                                                    View Results
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-700">
                            {{ $caseReports->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-24 w-24 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <h3 class="mt-4 text-lg font-medium text-slate-900 dark:text-slate-100">
                                @if(request()->hasAny(['search', 'subject_type', 'case_type', 'status']))
                                    No Matching Case Reports
                                @else
                                    No Case Reports
                                @endif
                            </h3>
                            <p class="mt-2 text-sm text-slate-600 dark:text-slate-400">
                                @if(request()->hasAny(['search', 'subject_type', 'case_type', 'status']))
                                    No case reports match your current filter criteria. Try adjusting your filters or search terms.
                                @else
                                    There are no case reports submitted yet.
                                @endif
                            </p>
                            @if(request()->hasAny(['search', 'subject_type', 'case_type', 'status']))
                                <div class="mt-4">
                                    <a href="{{ route('staff.case-reports') }}" 
                                       class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                        </svg>
                                        Clear All Filters
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleDescription(caseId) {
            const descriptionDiv = document.getElementById(`description-${caseId}`);
            descriptionDiv.classList.toggle('hidden');
        }
    </script>
</x-layouts.app>