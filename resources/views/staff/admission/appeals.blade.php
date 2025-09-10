<x-layouts.app title="Student Appeals Management">

<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-slate-900 dark:to-slate-800 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-blue-400/90 to-purple-500/90 text-white text-center py-4">
                <h1 class="text-2xl font-bold">STUDENT APPEALS MANAGEMENT</h1>
                <p class="text-sm opacity-90 mt-1">Review and manage student admission appeals</p>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-6 gap-4 mb-8">
            <!-- Total Appeals -->
            <a href="{{ route('staff.admission.appeals') }}" class="block rounded-lg {{ !request('status') ? 'ring-2 ring-blue-500 bg-blue-50/50 dark:bg-blue-900/20' : '' }}">
                <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-4 text-center hover:shadow-xl transition-all duration-200 cursor-pointer hover:scale-105">
                    <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $stats['total'] }}</div>
                    <div class="text-sm text-gray-600 dark:text-gray-400">Total Appeals</div>
                </div>
            </a>
            
            <!-- Pending -->
            <a href="{{ route('staff.admission.appeals', ['status' => 'pending']) }}" class="block rounded-lg {{ request('status') == 'pending' ? 'ring-2 ring-yellow-500 bg-yellow-50/50 dark:bg-yellow-900/20' : '' }}">
                <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-4 text-center hover:shadow-xl transition-all duration-200 cursor-pointer hover:scale-105">
                    <div class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">{{ $stats['pending'] }}</div>
                    <div class="text-sm text-gray-600 dark:text-gray-400">Pending</div>
                </div>
            </a>
            
            <!-- Under Review -->
            <a href="{{ route('staff.admission.appeals', ['status' => 'under_review']) }}" class="block rounded-lg {{ request('status') == 'under_review' ? 'ring-2 ring-blue-500 bg-blue-50/50 dark:bg-blue-900/20' : '' }}">
                <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-4 text-center hover:shadow-xl transition-all duration-200 cursor-pointer hover:scale-105">
                    <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $stats['under_review'] }}</div>
                    <div class="text-sm text-gray-600 dark:text-gray-400">Under Review</div>
                </div>
            </a>
            
            <!-- Approved -->
            <a href="{{ route('staff.admission.appeals', ['status' => 'approved']) }}" class="block rounded-lg {{ request('status') == 'approved' ? 'ring-2 ring-green-500 bg-green-50/50 dark:bg-green-900/20' : '' }}">
                <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-4 text-center hover:shadow-xl transition-all duration-200 cursor-pointer hover:scale-105">
                    <div class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $stats['approved'] }}</div>
                    <div class="text-sm text-gray-600 dark:text-gray-400">Approved</div>
                </div>
            </a>
            
            <!-- Rejected -->
            <a href="{{ route('staff.admission.appeals', ['status' => 'rejected']) }}" class="block rounded-lg {{ request('status') == 'rejected' ? 'ring-2 ring-red-500 bg-red-50/50 dark:bg-red-900/20' : '' }}">
                <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-4 text-center hover:shadow-xl transition-all duration-200 cursor-pointer hover:scale-105">
                    <div class="text-2xl font-bold text-red-600 dark:text-red-400">{{ $stats['rejected'] }}</div>
                    <div class="text-sm text-gray-600 dark:text-gray-400">Rejected</div>
                </div>
            </a>
            
            <!-- Today (non-clickable) -->
            <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-4 text-center">
                <div class="text-2xl font-bold text-purple-600 dark:text-purple-400">{{ $stats['today'] }}</div>
                <div class="text-sm text-gray-600 dark:text-gray-400">Today</div>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-6 mb-8">
            <form method="GET" class="flex gap-4 items-end">
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Filter by Status</label>
                    <select name="status" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="under_review" {{ request('status') === 'under_review' ? 'selected' : '' }}>Under Review</option>
                        <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Search Student</label>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Student name or email" 
                           class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium">
                        Filter
                    </button>
                    <a href="{{ route('staff.admission.appeals') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg font-medium">
                        Clear
                    </a>
                </div>
            </form>
        </div>

        <!-- Appeals Table -->
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow overflow-hidden">
            @if($appeals->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-slate-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Student
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Programme
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Appeal Date
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Reviewed By
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-slate-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($appeals as $appeal)
                                <tr class="hover:bg-gray-50 dark:hover:bg-slate-700">
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-gray-900 dark:text-white">
                                            {{ $appeal->user->name }}
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ $appeal->user->email }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-gray-900 dark:text-white">
                                            {{ $appeal->studentApplication->schoolProgramme->diplomaProgramme->name }}
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ ucfirst($appeal->studentApplication->schoolProgramme->school) }} School
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                        {{ $appeal->created_at->format('M j, Y') }}
                                        <div class="text-xs text-gray-500">{{ $appeal->created_at->format('g:i A') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="bg-{{ $appeal->status_color }}-100 text-{{ $appeal->status_color }}-800 px-2 py-1 rounded-full text-xs font-medium">
                                            {{ $appeal->status_text }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                        @if($appeal->reviewer)
                                            {{ $appeal->reviewer->name }}
                                            <div class="text-xs text-gray-500">
                                                {{ $appeal->reviewed_at->format('M j, Y') }}
                                            </div>
                                        @else
                                            <span class="text-gray-400">Not reviewed</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        <a href="{{ route('staff.admission.appeal', $appeal->id) }}" 
                                           class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm">
                                            Review
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                    {{ $appeals->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-12">
                    <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No Appeals Found</h3>
                    <p class="text-gray-500 dark:text-gray-400">No appeals match your current filters.</p>
                </div>
            @endif
        </div>

    </div>
</div>

</x-layouts.app>