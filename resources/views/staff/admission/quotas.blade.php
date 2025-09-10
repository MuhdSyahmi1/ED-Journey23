<x-layouts.app title="Manage Admission Quotas">

<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-slate-900 dark:to-slate-800 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-blue-400/90 to-purple-500/90 text-white text-center py-4">
                <h1 class="text-2xl font-bold">MANAGE ADMISSION QUOTAS</h1>
                <p class="text-sm opacity-90 mt-1">Set and monitor programme admission quotas</p>
            </div>
        </div>

        <!-- Overall Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-8">
            @php
                // Get counts from original data (before filtering)
                $allProgrammes = \App\Models\SchoolProgramme::with(['diplomaProgramme'])->where('is_active', 1)->get();
                $totalProgrammes = $allProgrammes->count();
                $quotasSet = $allProgrammes->where('admission_quota', '>', 0)->count();
                
                // Calculate full and nearly full programmes
                $fullProgrammes = 0;
                $nearlyFullProgrammes = 0;
                $totalUtilization = 0;
                $quotasWithUtilization = 0;
                
                foreach ($allProgrammes as $programme) {
                    $acceptedApplications = \App\Models\StudentApplication::where('school_programme_id', $programme->id)
                        ->where('status', 'accepted')
                        ->count();
                    $quota = $programme->admission_quota ?? 0;
                    
                    if ($quota > 0) {
                        $utilizationPercentage = ($acceptedApplications / $quota) * 100;
                        $totalUtilization += $utilizationPercentage;
                        $quotasWithUtilization++;
                        
                        if ($acceptedApplications >= $quota) {
                            $fullProgrammes++;
                        } elseif ($utilizationPercentage >= 90) {
                            $nearlyFullProgrammes++;
                        }
                    }
                }
                
                $averageUtilization = $quotasWithUtilization > 0 ? round($totalUtilization / $quotasWithUtilization, 1) : 0;
            @endphp
            
            <!-- Total Programmes -->
            <a href="{{ route('staff.admission.quotas', array_merge(request()->except('status'), [])) }}" class="block rounded-lg {{ !request('status') ? 'ring-2 ring-blue-500 bg-blue-50/50 dark:bg-blue-900/20' : '' }}">
                <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-4 text-center hover:shadow-xl transition-all duration-200 cursor-pointer hover:scale-105">
                    <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $totalProgrammes }}</div>
                    <div class="text-sm text-gray-600 dark:text-gray-400">Total Programmes</div>
                </div>
            </a>
            
            <!-- Quotas Set -->
            <a href="{{ route('staff.admission.quotas', array_merge(request()->except('status'), ['status' => 'quotas_set'])) }}" class="block rounded-lg {{ request('status') == 'quotas_set' ? 'ring-2 ring-green-500 bg-green-50/50 dark:bg-green-900/20' : '' }}">
                <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-4 text-center hover:shadow-xl transition-all duration-200 cursor-pointer hover:scale-105">
                    <div class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $quotasSet }}</div>
                    <div class="text-sm text-gray-600 dark:text-gray-400">Quotas Set</div>
                </div>
            </a>
            
            <!-- Full Programmes -->
            <a href="{{ route('staff.admission.quotas', array_merge(request()->except('status'), ['status' => 'full'])) }}" class="block rounded-lg {{ request('status') == 'full' ? 'ring-2 ring-red-500 bg-red-50/50 dark:bg-red-900/20' : '' }}">
                <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-4 text-center hover:shadow-xl transition-all duration-200 cursor-pointer hover:scale-105">
                    <div class="text-2xl font-bold text-red-600 dark:text-red-400">{{ $fullProgrammes }}</div>
                    <div class="text-sm text-gray-600 dark:text-gray-400">Full Programmes</div>
                </div>
            </a>
            
            <!-- Nearly Full -->
            <a href="{{ route('staff.admission.quotas', array_merge(request()->except('status'), ['status' => 'nearly_full'])) }}" class="block rounded-lg {{ request('status') == 'nearly_full' ? 'ring-2 ring-orange-500 bg-orange-50/50 dark:bg-orange-900/20' : '' }}">
                <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-4 text-center hover:shadow-xl transition-all duration-200 cursor-pointer hover:scale-105">
                    <div class="text-2xl font-bold text-orange-600 dark:text-orange-400">{{ $nearlyFullProgrammes }}</div>
                    <div class="text-sm text-gray-600 dark:text-gray-400">Nearly Full</div>
                </div>
            </a>
            
            <!-- Average Utilization (non-clickable) -->
            <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-4 text-center">
                <div class="text-2xl font-bold text-purple-600 dark:text-purple-400">{{ round($averageUtilization ?? 0, 1) }}%</div>
                <div class="text-sm text-gray-600 dark:text-gray-400">Avg Utilization</div>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-6 mb-8">
            <form method="GET" class="flex gap-4 items-end">
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Filter by School</label>
                    <select name="school" class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">All Schools</option>
                        @foreach($schools as $school)
                            <option value="{{ $school }}" {{ request('school') === $school ? 'selected' : '' }}>
                                {{ ucfirst($school) }} School
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium">
                        Filter
                    </button>
                    <a href="{{ route('staff.admission.quotas') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg font-medium">
                        Clear
                    </a>
                </div>
            </form>
        </div>

        <!-- Bulk Update Form -->
        <form id="bulk-quota-form" method="POST" action="{{ route('staff.admission.bulk-update-quotas') }}">
            @csrf
            <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-4 mb-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <span class="font-medium text-gray-900 dark:text-white">Bulk Actions:</span>
                        <input type="number" 
                               id="bulk-quota-value" 
                               placeholder="Quota value" 
                               min="0" 
                               max="1000"
                               class="w-32 px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <button type="button" 
                                onclick="applyBulkQuota()" 
                                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm">
                            Apply to Selected
                        </button>
                    </div>
                    <button type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium">
                        Save All Changes
                    </button>
                </div>
            </div>

            <!-- Quota Management Table -->
            <div class="bg-white dark:bg-slate-800 rounded-lg shadow overflow-hidden">
                @if(count($quotaData) > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-slate-700">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        <input type="checkbox" id="select-all" class="rounded border-gray-300">
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Programme
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        School
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Current Quota
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Applications
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Accepted
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Available
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Utilization
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-slate-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach($quotaData as $index => $data)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-slate-700">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <input type="checkbox" 
                                                   class="programme-checkbox rounded border-gray-300" 
                                                   value="{{ $data['programme']->id }}"
                                                   data-programme-name="{{ $data['programme']->diplomaProgramme->name }}">
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="font-medium text-gray-900 dark:text-white">
                                                {{ $data['programme']->diplomaProgramme->name }}
                                            </div>
                                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $data['programme']->duration }} years
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="capitalize text-gray-900 dark:text-white">{{ $data['programme']->school }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <input type="hidden" name="quotas[{{ $index }}][programme_id]" value="{{ $data['programme']->id }}">
                                            <input type="number" 
                                                   name="quotas[{{ $index }}][quota]" 
                                                   value="{{ $data['quota'] }}"
                                                   min="0" 
                                                   max="1000"
                                                   class="quota-input w-20 px-2 py-1 border border-slate-300 dark:border-slate-600 rounded bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm"
                                                   data-programme-id="{{ $data['programme']->id }}">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <span class="text-blue-600 dark:text-blue-400 font-medium">{{ $data['total_applications'] }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <span class="text-green-600 dark:text-green-400 font-medium">{{ $data['accepted'] }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <span class="text-gray-900 dark:text-white font-medium">{{ $data['available'] }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <div class="flex items-center justify-center">
                                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 mr-2">
                                                    <div class="bg-{{ $data['status']['color'] }}-500 h-2 rounded-full" 
                                                         style="width: {{ min(100, $data['utilization_percentage']) }}%"></div>
                                                </div>
                                                <span class="text-sm text-gray-600 dark:text-gray-400 min-w-max">
                                                    {{ $data['utilization_percentage'] }}%
                                                </span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="bg-{{ $data['status']['color'] }}-100 text-{{ $data['status']['color'] }}-800 px-2 py-1 rounded-full text-xs font-medium">
                                                {{ $data['status']['text'] }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="text-center py-12">
                        <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No Active Programmes Found</h3>
                        <p class="text-gray-500 dark:text-gray-400">No active programmes match your current filters.</p>
                    </div>
                @endif
            </div>
        </form>

        <!-- Quick Actions -->
        <div class="mt-8 bg-white dark:bg-slate-800 rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Quick Actions</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <button onclick="setQuotasForAll(30)" class="bg-green-600 hover:bg-green-700 text-white px-4 py-3 rounded-lg font-medium">
                    Set All to 30
                </button>
                <button onclick="setQuotasForAll(50)" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded-lg font-medium">
                    Set All to 50
                </button>
                <button onclick="clearAllQuotas()" class="bg-red-600 hover:bg-red-700 text-white px-4 py-3 rounded-lg font-medium">
                    Clear All Quotas
                </button>
            </div>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectAllCheckbox = document.getElementById('select-all');
    const programmeCheckboxes = document.querySelectorAll('.programme-checkbox');

    // Handle select all functionality
    selectAllCheckbox.addEventListener('change', function() {
        programmeCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });

    // Handle individual checkbox changes
    programmeCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const checkedCount = document.querySelectorAll('.programme-checkbox:checked').length;
            selectAllCheckbox.indeterminate = checkedCount > 0 && checkedCount < programmeCheckboxes.length;
            selectAllCheckbox.checked = checkedCount === programmeCheckboxes.length;
        });
    });

    // Apply bulk quota to selected programmes
    window.applyBulkQuota = function() {
        const quotaValue = document.getElementById('bulk-quota-value').value;
        const selectedCheckboxes = document.querySelectorAll('.programme-checkbox:checked');
        
        if (!quotaValue || selectedCheckboxes.length === 0) {
            alert('Please enter a quota value and select programmes.');
            return;
        }

        selectedCheckboxes.forEach(checkbox => {
            const programmeId = checkbox.value;
            const quotaInput = document.querySelector(`input[data-programme-id="${programmeId}"]`);
            if (quotaInput) {
                quotaInput.value = quotaValue;
            }
        });

        // Clear bulk quota input
        document.getElementById('bulk-quota-value').value = '';
        
        // Uncheck all checkboxes
        selectAllCheckbox.checked = false;
        programmeCheckboxes.forEach(checkbox => checkbox.checked = false);
    }

    // Quick action functions
    window.setQuotasForAll = function(value) {
        if (!confirm(`Set quota to ${value} for all programmes?`)) return;
        
        document.querySelectorAll('.quota-input').forEach(input => {
            input.value = value;
        });
    }

    window.clearAllQuotas = function() {
        if (!confirm('Clear all quotas? This will set all quotas to 0.')) return;
        
        document.querySelectorAll('.quota-input').forEach(input => {
            input.value = 0;
        });
    }
});
</script>

</x-layouts.app>