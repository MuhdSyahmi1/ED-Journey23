<x-layouts.app title="Review Student Applications">

<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-slate-900 dark:to-slate-800 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-blue-400/90 to-purple-500/90 text-white text-center py-4">
                <h1 class="text-2xl font-bold">REVIEW STUDENT APPLICATIONS</h1>
                <p class="text-sm opacity-90 mt-1">Manage and process programme applications</p>
            </div>
        </div>

        <!-- Info Notice -->
        <div class="mb-8 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-700 rounded-lg p-4">
            <div class="flex items-center">
                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
                <p class="text-sm text-blue-800 dark:text-blue-200">
                    <strong>Note:</strong> Only applications from verified users are shown here. 
                    If you're missing applications, check 
                    <a href="{{ route('staff.admission.user-profile') }}" class="underline hover:no-underline">User Profile Verification</a> 
                    to verify pending profiles first.
                </p>
            </div>
        </div>

        <!-- Case Report Warning Alert -->
        @php
            $applicationsWithCaseReports = $applications->filter(function($application) {
                return $application->user->caseReport && 
                       in_array($application->user->caseReport->status, ['pending', 'in progress']);
            });
        @endphp
        @if($applicationsWithCaseReports->count() > 0)
            <div class="mb-8 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-700 rounded-lg p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3 flex-1">
                        <h3 class="text-sm font-medium text-red-800 dark:text-red-200">
                            {{ $applicationsWithCaseReports->count() }} Application(s) with Pending Case Reports
                        </h3>
                        <div class="mt-2 text-sm text-red-700 dark:text-red-300">
                            <p>
                                Some students have pending case reports that may need to be resolved before processing their applications.
                                Review the case reports to ensure all issues are addressed.
                            </p>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('staff.case-reports') }}" 
                               class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded text-sm font-medium">
                                View All Case Reports
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-6 gap-4 mb-8">
            <!-- Total Applications -->
            <a href="{{ route('staff.admission.applications') }}" class="block rounded-lg {{ !request('status') ? 'ring-2 ring-blue-500 bg-blue-50/50 dark:bg-blue-900/20' : '' }}">
                <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-4 text-center hover:shadow-xl transition-all duration-200 cursor-pointer hover:scale-105">
                    <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $stats['total'] }}</div>
                    <div class="text-sm text-gray-600 dark:text-gray-400">Total Applications</div>
                </div>
            </a>
            
            <!-- Pending Review -->
            <a href="{{ route('staff.admission.applications', ['status' => 'pending']) }}" class="block rounded-lg {{ request('status') == 'pending' ? 'ring-2 ring-yellow-500 bg-yellow-50/50 dark:bg-yellow-900/20' : '' }}">
                <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-4 text-center hover:shadow-xl transition-all duration-200 cursor-pointer hover:scale-105">
                    <div class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">{{ $stats['pending'] }}</div>
                    <div class="text-sm text-gray-600 dark:text-gray-400">Pending Review</div>
                </div>
            </a>
            
            <!-- Accepted -->
            <a href="{{ route('staff.admission.applications', ['status' => 'accepted']) }}" class="block rounded-lg {{ request('status') == 'accepted' ? 'ring-2 ring-green-500 bg-green-50/50 dark:bg-green-900/20' : '' }}">
                <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-4 text-center hover:shadow-xl transition-all duration-200 cursor-pointer hover:scale-105">
                    <div class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $stats['accepted'] }}</div>
                    <div class="text-sm text-gray-600 dark:text-gray-400">Accepted</div>
                </div>
            </a>
            
            <!-- Rejected -->
            <a href="{{ route('staff.admission.applications', ['status' => 'rejected']) }}" class="block rounded-lg {{ request('status') == 'rejected' ? 'ring-2 ring-red-500 bg-red-50/50 dark:bg-red-900/20' : '' }}">
                <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-4 text-center hover:shadow-xl transition-all duration-200 cursor-pointer hover:scale-105">
                    <div class="text-2xl font-bold text-red-600 dark:text-red-400">{{ $stats['rejected'] }}</div>
                    <div class="text-sm text-gray-600 dark:text-gray-400">Rejected</div>
                </div>
            </a>
            
            <!-- Waitlisted -->
            <a href="{{ route('staff.admission.applications', ['status' => 'waitlisted']) }}" class="block rounded-lg {{ request('status') == 'waitlisted' ? 'ring-2 ring-purple-500 bg-purple-50/50 dark:bg-purple-900/20' : '' }}">
                <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-4 text-center hover:shadow-xl transition-all duration-200 cursor-pointer hover:scale-105">
                    <div class="text-2xl font-bold text-purple-600 dark:text-purple-400">{{ $stats['waitlisted'] }}</div>
                    <div class="text-sm text-gray-600 dark:text-gray-400">Waitlisted</div>
                </div>
            </a>
            
            <!-- Today -->
            <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-4 text-center">
                <div class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">{{ $stats['today'] }}</div>
                <div class="text-sm text-gray-600 dark:text-gray-400">Today</div>
            </div>
        </div>

        <!-- Filters and Search -->
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-6 mb-8">
            <form method="GET" class="space-y-4 md:space-y-0 md:flex md:gap-4 md:items-end">
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Search Students</label>
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Student name or email..."
                           class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                    <select name="status" class="px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="accepted" {{ request('status') === 'accepted' ? 'selected' : '' }}>Accepted</option>
                        <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                        <option value="waitlisted" {{ request('status') === 'waitlisted' ? 'selected' : '' }}>Waitlisted</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">School</label>
                    <select name="school" class="px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">All Schools</option>
                        @foreach($schools as $school)
                            <option value="{{ $school }}" {{ request('school') === $school ? 'selected' : '' }}>
                                {{ ucfirst($school) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Programme</label>
                    <select name="programme" class="px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">All Programmes</option>
                        @foreach($programmes as $programme)
                            <option value="{{ $programme->id }}" {{ request('programme') == $programme->id ? 'selected' : '' }}>
                                {{ $programme->diplomaProgramme->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium">
                        Filter
                    </button>
                    <a href="{{ route('staff.admission.applications') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg font-medium">
                        Clear
                    </a>
                </div>
            </form>
        </div>

        <!-- Bulk Actions -->
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-4 mb-6 hidden" id="bulk-actions">
            <div class="flex items-center justify-between">
                <div>
                    <span id="selected-count" class="font-medium text-gray-900 dark:text-white">0</span> applications selected
                </div>
                <div class="flex gap-2">
                    <button onclick="bulkAction('accepted')" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm">
                        Accept Selected
                    </button>
                    <button onclick="bulkAction('rejected')" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm">
                        Reject Selected
                    </button>
                    <button onclick="bulkAction('waitlisted')" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg text-sm">
                        Waitlist Selected
                    </button>
                </div>
            </div>
        </div>

        <!-- Applications Table -->
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow overflow-hidden">
            @if($applications->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-slate-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    <input type="checkbox" id="select-all" class="rounded border-gray-300">
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Student
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Programme
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Preference
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Applied Date
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-slate-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($applications as $application)
                                <tr class="hover:bg-gray-50 dark:hover:bg-slate-700">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="checkbox" class="application-checkbox rounded border-gray-300" value="{{ $application->id }}">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center mr-3">
                                                <span class="text-blue-600 dark:text-blue-400 font-semibold text-sm">
                                                    {{ substr($application->user->name, 0, 1) }}
                                                </span>
                                            </div>
                                            <div class="flex-1">
                                                <div class="flex items-center gap-2">
                                                    <span class="font-medium text-gray-900 dark:text-white">{{ $application->user->name }}</span>
                                                    @if($application->user->caseReport && in_array($application->user->caseReport->status, ['pending', 'in progress']))
                                                        <div class="flex items-center">
                                                            <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs font-medium flex items-center gap-1" 
                                                                  title="Student has a pending case report that needs attention">
                                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                                </svg>
                                                                Case Report
                                                            </span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="text-sm text-gray-500 dark:text-gray-400">{{ $application->user->email }}</div>
                                                @if($application->user->caseReport && in_array($application->user->caseReport->status, ['pending', 'in progress']))
                                                    <div class="text-xs text-red-600 dark:text-red-400 mt-1">
                                                        ⚠️ Resolve case report before processing application
                                                        <a href="{{ route('staff.case-reports') }}" class="underline hover:no-underline ml-1">View Case Report</a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-gray-900 dark:text-white">{{ $application->schoolProgramme->diplomaProgramme->name }}</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400 capitalize">{{ $application->schoolProgramme->school }} School</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs font-medium">
                                            {{ $application->getPreferenceText() }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $application->applied_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="bg-{{ $application->getStatusColor() }}-100 text-{{ $application->getStatusColor() }}-800 px-2 py-1 rounded-full text-xs font-medium">
                                            {{ $application->getStatusText() }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        <a href="{{ route('staff.admission.application', $application->id) }}" 
                                           class="text-blue-600 hover:text-blue-900 dark:text-blue-400">
                                            Review
                                        </a>
                                        @if($application->status === 'pending')
                                            <button onclick="quickAction({{ $application->id }}, 'accepted')" 
                                                    class="text-green-600 hover:text-green-900 dark:text-green-400">
                                                Accept
                                            </button>
                                            <button onclick="quickAction({{ $application->id }}, 'rejected')" 
                                                    class="text-red-600 hover:text-red-900 dark:text-red-400">
                                                Reject
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                    {{ $applications->withQueryString()->links() }}
                </div>

            @else
                <!-- Empty State -->
                <div class="text-center py-12">
                    <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No Applications Found</h3>
                    <p class="text-gray-500 dark:text-gray-400">No student applications match your current filters.</p>
                </div>
            @endif
        </div>

    </div>
</div>

<!-- Bulk Action Forms -->
<form id="bulk-form" method="POST" action="{{ route('staff.admission.bulk-update') }}" class="hidden">
    @csrf
    <input type="hidden" name="status" id="bulk-status">
    <div id="bulk-application-ids"></div>
</form>

<!-- Quick Action Forms -->
<form id="quick-form" method="POST" class="hidden">
    @csrf
    <input type="hidden" name="status" id="quick-status">
    <input type="hidden" name="application_id" id="quick-application-id">
</form>

<script>
function initializeApplicationsPage() {
    const selectAllCheckbox = document.getElementById('select-all');
    const applicationCheckboxes = document.querySelectorAll('.application-checkbox');
    const bulkActionsDiv = document.getElementById('bulk-actions');
    const selectedCountSpan = document.getElementById('selected-count');

    // Only proceed if elements exist (to avoid errors on other pages)
    if (!selectAllCheckbox || !bulkActionsDiv) return;

    // Handle select all functionality
    selectAllCheckbox.addEventListener('change', function() {
        applicationCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        updateBulkActions();
    });

    // Handle individual checkbox changes
    applicationCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateBulkActions);
    });

    function updateBulkActions() {
        const selected = document.querySelectorAll('.application-checkbox:checked');
        selectedCountSpan.textContent = selected.length;
        
        if (selected.length > 0) {
            bulkActionsDiv.classList.remove('hidden');
        } else {
            bulkActionsDiv.classList.add('hidden');
        }

        // Update select all checkbox state
        selectAllCheckbox.indeterminate = selected.length > 0 && selected.length < applicationCheckboxes.length;
        selectAllCheckbox.checked = selected.length === applicationCheckboxes.length;
    }

    // Bulk action handler
    window.bulkAction = function(status) {
        const selected = document.querySelectorAll('.application-checkbox:checked');
        if (selected.length === 0) {
            alert('Please select applications to update.');
            return;
        }

        if (!confirm(`Are you sure you want to ${status} ${selected.length} applications?`)) {
            return;
        }

        const form = document.getElementById('bulk-form');
        const statusInput = document.getElementById('bulk-status');
        const idsDiv = document.getElementById('bulk-application-ids');

        statusInput.value = status;
        idsDiv.innerHTML = '';

        selected.forEach(checkbox => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'application_ids[]';
            input.value = checkbox.value;
            idsDiv.appendChild(input);
        });

        form.submit();
    }

    // Quick action handler
    window.quickAction = function(applicationId, status) {
        if (!confirm(`Are you sure you want to ${status} this application?`)) {
            return;
        }

        const form = document.getElementById('quick-form');
        form.action = `/staff/admission/application/${applicationId}/status`;
        document.getElementById('quick-status').value = status;
        document.getElementById('quick-application-id').value = applicationId;
        
        form.submit();
    }
}

// Initialize on DOM ready
document.addEventListener('DOMContentLoaded', initializeApplicationsPage);

// Re-initialize on Livewire navigation
document.addEventListener('livewire:navigated', initializeApplicationsPage);
</script>

</x-layouts.app>