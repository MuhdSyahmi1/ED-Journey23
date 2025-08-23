<x-layouts.app title="Admin Dashboard">
    <div class="space-y-4">
        <!-- Welcome Header -->
        <div>
            <h1 class="text-xl font-semibold text-gray-900 dark:text-white mb-1">Welcome back, Admin!</h1>
            <p class="text-gray-600 dark:text-gray-400 text-sm">Here's what's happening with your platform today.</p>
        </div>

        <!-- First Row: Manager Cards (Compact Flex) -->
        <div class="flex flex-wrap -mx-2">
            <!-- Total Managers -->
            <div class="w-full sm:w-1/2 lg:w-1/3 px-2 mb-4">
                <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-4 border border-blue-200 dark:border-blue-800 h-full flex flex-col justify-between">
                    <div>
                        <h3 class="text-md font-medium text-gray-900 dark:text-white mb-1">Total Managers</h3>
                        <p class="text-gray-600 dark:text-gray-300 text-xs mb-2">Overview of all managers</p>
                        <div class="text-2xl font-bold text-blue-600 dark:text-blue-400 mb-1">{{ $totalManagers }}</div>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Active: {{ $activeManagers }} | Inactive: {{ $inactiveManagers }}</p>
                    </div>
                    <a href="{{ route('admin.manage-account') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 text-xs font-medium mt-2 inline-block">
                        Manage Accounts →
                    </a>
                </div>
            </div>

            <!-- Program Managers -->
            <div class="w-full sm:w-1/2 lg:w-1/3 px-2 mb-4">
                <div class="bg-green-50 dark:bg-green-900/20 rounded-lg p-4 border border-green-200 dark:border-green-800 h-full flex flex-col justify-between">
                    <div>
                        <h3 class="text-md font-medium text-gray-900 dark:text-white mb-1">Program Managers</h3>
                        <p class="text-gray-600 dark:text-gray-300 text-xs mb-2">Handle program management</p>
                        <div class="text-2xl font-bold text-green-600 dark:text-green-400 mb-1">{{ $programManagers + $bothRoleManagers }}</div>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Program Only: {{ $programManagers }}</p>
                    </div>
                    <div class="mt-2">
                        <span class="text-green-600 dark:text-green-400 text-xs font-medium">View Details</span>
                    </div>
                </div>
            </div>

            <!-- Admission Managers -->
            <div class="w-full sm:w-1/2 lg:w-1/3 px-2 mb-4">
                <div class="bg-purple-50 dark:bg-purple-900/20 rounded-lg p-4 border border-purple-200 dark:border-purple-800 h-full flex flex-col justify-between">
                    <div>
                        <h3 class="text-md font-medium text-gray-900 dark:text-white mb-1">Admission Managers</h3>
                        <p class="text-gray-600 dark:text-gray-300 text-xs mb-2">Handle admissions process</p>
                        <div class="text-2xl font-bold text-purple-600 dark:text-purple-400 mb-1">{{ $admissionManagers + $bothRoleManagers }}</div>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Admission Only: {{ $admissionManagers }}</p>
                    </div>
                    <div class="mt-2">
                        <span class="text-purple-600 dark:text-purple-400 text-xs font-medium">View Details</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Second Row: Charts (Livewire-Compatible) -->
        <div class="flex flex-wrap -mx-2">
            <!-- Manager Status Chart -->
            <div class="w-full sm:w-1/2 lg:w-1/3 px-2 mb-4" wire:ignore>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 p-4">
                    <h3 class="text-md font-medium text-gray-900 dark:text-white mb-2">Manager Status</h3>
                    <div class="relative h-24 mb-2">
                        <canvas id="managerStatusChart" x-data x-init="
                            new Chart($el, {
                                type: 'doughnut',
                                data: { labels:['Active','Inactive'], datasets:[{ data:[{{ $activeManagers }}, {{ $inactiveManagers }}], backgroundColor:['#10B981','#EF4444'], borderWidth:0 }] },
                                options:{ plugins:{legend:{display:false}}, responsive:true, maintainAspectRatio:false, cutout:'70%' }
                            });
                        "></canvas>
                    </div>
                    <div class="space-y-1 text-xs">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center"><div class="w-2 h-2 bg-green-500 rounded-full mr-1"></div>Active</div>
                            <span class="font-medium text-gray-900 dark:text-white">{{ $activeManagers }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center"><div class="w-2 h-2 bg-red-500 rounded-full mr-1"></div>Inactive</div>
                            <span class="font-medium text-gray-900 dark:text-white">{{ $inactiveManagers }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Manager Roles Chart -->
            <div class="w-full sm:w-1/2 lg:w-1/3 px-2 mb-4" wire:ignore>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 p-4">
                    <h3 class="text-md font-medium text-gray-900 dark:text-white mb-2">Manager Roles</h3>
                    <div class="relative h-24 mb-2">
                        <canvas id="managerRolesChart" x-data x-init="
                            new Chart($el, {
                                type:'doughnut',
                                data:{ labels:['Program','Admission','Both'], datasets:[{ data:[{{ $programManagers }},{{ $admissionManagers }},{{ $bothRoleManagers }}], backgroundColor:['#3B82F6','#F59E0B','#10B981'], borderWidth:0 }] },
                                options:{ plugins:{legend:{display:false}}, responsive:true, maintainAspectRatio:false, cutout:'70%' }
                            });
                        "></canvas>
                    </div>
                    <div class="space-y-1 text-xs">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center"><div class="w-2 h-2 bg-blue-500 rounded-full mr-1"></div>Program</div>
                            <span class="font-medium text-gray-900 dark:text-white">{{ $programManagers }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center"><div class="w-2 h-2 bg-yellow-500 rounded-full mr-1"></div>Admission</div>
                            <span class="font-medium text-gray-900 dark:text-white">{{ $admissionManagers }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center"><div class="w-2 h-2 bg-green-500 rounded-full mr-1"></div>Both</div>
                            <span class="font-medium text-gray-900 dark:text-white">{{ $bothRoleManagers }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Upload Result Case Type Chart -->
            <div class="w-full sm:w-1/2 lg:w-1/3 px-2 mb-4" wire:ignore>
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 p-4">
                    <h3 class="text-md font-medium text-gray-900 dark:text-white mb-2">Upload Result Case Type</h3>
                    <div class="relative h-24 mb-2">
                        <canvas id="uploadCaseChart" x-data x-init="
                            new Chart($el, {
                                type:'doughnut',
                                data:{ labels:['No Data'], datasets:[{ data:[1], backgroundColor:['#9CA3AF'], borderWidth:0 }] },
                                options:{ plugins:{legend:{display:false}}, responsive:true, maintainAspectRatio:false, cutout:'70%' }
                            });
                        "></canvas>
                    </div>
                    <div class="flex items-center justify-center text-xs">
                        <div class="flex items-center"><div class="w-2 h-2 bg-gray-400 rounded-full mr-1"></div>No Data Available</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Feedback Card -->
        <div class="bg-orange-50 dark:bg-orange-900/20 rounded-lg p-4 border border-orange-200 dark:border-orange-800">
            <h3 class="text-md font-medium text-gray-900 dark:text-white mb-1">Pending Feedback</h3>
            <p class="text-gray-600 dark:text-gray-300 text-xs mb-2">User feedback awaiting response</p>
            <div class="text-2xl font-bold text-orange-600 dark:text-orange-400 mb-1">{{ $pendingFeedback }}</div>
            <p class="text-xs text-gray-500 dark:text-gray-400">In Progress: {{ $inProgressFeedback }}</p>
            <a href="{{ route('admin.feedback') }}" class="text-orange-600 dark:text-orange-400 hover:text-orange-800 dark:hover:text-orange-300 text-xs font-medium mt-2 inline-block">
                View Feedback →
            </a>
        </div>

        <!-- Recent Feedback Table -->
        @if($recentFeedback->isNotEmpty())
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700">
            <div class="px-4 py-2 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                <h3 class="text-md font-medium text-gray-900 dark:text-white">Recent Feedback</h3>
                <a href="{{ route('admin.feedback') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 text-xs font-medium">View All →</a>
            </div>
            <div class="overflow-x-auto text-xs">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-3 py-2 text-left font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Subject</th>
                            <th class="px-3 py-2 text-left font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">User</th>
                            <th class="px-3 py-2 text-left font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                            <th class="px-3 py-2 text-left font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($recentFeedback->take(5) as $feedback)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-3 py-2">
                                <div class="text-xs font-medium text-gray-900 dark:text-white">{{ Str::limit($feedback->subject, 40) }}</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">{{ Str::limit($feedback->message, 60) }}</div>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap">{{ $feedback->user->name }}</td>
                            <td class="px-3 py-2 whitespace-nowrap">
                                <span class="px-1 inline-flex text-xs font-semibold rounded-full {{ $feedback->status_color }}">
                                    {{ $feedback->status_display }}
                                </span>
                            </td>
                            <td class="px-3 py-2 whitespace-nowrap text-gray-500 dark:text-gray-400 text-xs">{{ $feedback->created_at->diffForHumans() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</x-layouts.app>
