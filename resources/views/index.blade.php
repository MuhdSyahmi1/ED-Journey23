<x-layouts.app title="Admin Dashboard">
    <div class="space-y-8">
        <!-- Hero Section -->
        <div class="bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500 rounded-2xl p-8 text-white shadow-lg relative overflow-hidden">
            <h1 class="text-3xl md:text-4xl font-bold mb-2">Welcome back, Admin!</h1>
            <p class="text-lg md:text-xl text-white/80">Here's what's happening with your platform today.</p>
            <div class="absolute -bottom-10 -right-10 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
        </div>

        <!-- First Row: Manager Cards -->
        <div class="flex flex-wrap -mx-3 gap-6">
            <!-- Total Managers Card -->
            <div class="w-full md:w-1/2 lg:w-1/3 px-3">
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow hover:shadow-xl transition flex flex-col justify-between h-full border border-gray-200 dark:border-gray-700">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Total Managers</h3>
                        <p class="text-gray-500 dark:text-gray-400 text-sm mb-4">Overview of all managers</p>
                        <div class="text-3xl font-bold text-blue-600 dark:text-blue-400 mb-2">{{ $totalManagers }}</div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Active: {{ $activeManagers }} | Inactive: {{ $inactiveManagers }}</p>
                    </div>
                    <a href="{{ route('admin.manage-account') }}" class="mt-4 text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-medium text-sm inline-block">
                        Manage Accounts →
                    </a>
                </div>
            </div>

            <!-- Program Managers Card -->
            <div class="w-full md:w-1/2 lg:w-1/3 px-3">
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow hover:shadow-xl transition flex flex-col justify-between h-full border border-gray-200 dark:border-gray-700">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Program Managers</h3>
                        <p class="text-gray-500 dark:text-gray-400 text-sm mb-4">Handle program management</p>
                        <div class="text-3xl font-bold text-green-600 dark:text-green-400 mb-2">{{ $programManagers + $bothRoleManagers }}</div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Program Only: {{ $programManagers }}</p>
                    </div>
                    <span class="mt-4 text-green-600 dark:text-green-400 font-medium text-sm">View Details</span>
                </div>
            </div>

            <!-- Admission Managers Card -->
            <div class="w-full md:w-1/2 lg:w-1/3 px-3">
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow hover:shadow-xl transition flex flex-col justify-between h-full border border-gray-200 dark:border-gray-700">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Admission Managers</h3>
                        <p class="text-gray-500 dark:text-gray-400 text-sm mb-4">Handle admissions process</p>
                        <div class="text-3xl font-bold text-purple-600 dark:text-purple-400 mb-2">{{ $admissionManagers + $bothRoleManagers }}</div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Admission Only: {{ $admissionManagers }}</p>
                    </div>
                    <span class="mt-4 text-purple-600 dark:text-purple-400 font-medium text-sm">View Details</span>
                </div>
            </div>
        </div>

        <!-- Second Row: Charts -->
        <div class="flex flex-wrap -mx-3 gap-6">
            <!-- Manager Status Chart -->
            <div class="w-full lg:w-1/3 px-3">
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow hover:shadow-xl transition h-full border border-gray-200 dark:border-gray-700 flex flex-col">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Manager Status</h3>
                    <div class="relative h-48 mb-4">
                        <canvas id="managerStatusChart"></canvas>
                    </div>
                    <div class="mt-auto space-y-2">
                        <div class="flex items-center justify-between text-sm">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                                <span class="text-gray-500 dark:text-gray-400">Active</span>
                            </div>
                            <span class="font-medium text-gray-900 dark:text-white">{{ $activeManagers }}</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-red-500 rounded-full mr-2"></div>
                                <span class="text-gray-500 dark:text-gray-400">Inactive</span>
                            </div>
                            <span class="font-medium text-gray-900 dark:text-white">{{ $inactiveManagers }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Manager Roles Chart -->
            <div class="w-full lg:w-1/3 px-3">
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow hover:shadow-xl transition h-full border border-gray-200 dark:border-gray-700 flex flex-col">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Manager Roles</h3>
                    <div class="relative h-48 mb-4">
                        <canvas id="managerRolesChart"></canvas>
                    </div>
                    <div class="mt-auto space-y-2">
                        <div class="flex items-center justify-between text-sm">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-blue-500 rounded-full mr-2"></div>
                                <span class="text-gray-500 dark:text-gray-400">Program</span>
                            </div>
                            <span class="font-medium text-gray-900 dark:text-white">{{ $programManagers }}</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-yellow-500 rounded-full mr-2"></div>
                                <span class="text-gray-500 dark:text-gray-400">Admission</span>
                            </div>
                            <span class="font-medium text-gray-900 dark:text-white">{{ $admissionManagers }}</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                                <span class="text-gray-500 dark:text-gray-400">Both</span>
                            </div>
                            <span class="font-medium text-gray-900 dark:text-white">{{ $bothRoleManagers }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Upload Result Case Type Chart -->
            <div class="w-full lg:w-1/3 px-3">
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow hover:shadow-xl transition h-full border border-gray-200 dark:border-gray-700 flex flex-col items-center justify-center">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Upload Result Case Type</h3>
                    <div class="relative h-48 mb-4 w-full">
                        <canvas id="uploadCaseChart"></canvas>
                    </div>
                    <div class="flex items-center justify-center">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-gray-400 rounded-full mr-2"></div>
                            <span class="text-gray-500 dark:text-gray-400 text-sm">No Data Available</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Feedback Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow hover:shadow-xl transition border border-gray-200 dark:border-gray-700 flex flex-col md:flex-row justify-between items-center">
            <div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Pending Feedback</h3>
                <p class="text-gray-500 dark:text-gray-400 text-sm mb-2">User feedback awaiting response</p>
                <div class="text-3xl font-bold text-orange-600 dark:text-orange-400 mb-1">{{ $pendingFeedback }}</div>
                <p class="text-sm text-gray-500 dark:text-gray-400">In Progress: {{ $inProgressFeedback }}</p>
            </div>
            <a href="{{ route('admin.feedback') }}" class="mt-4 md:mt-0 text-orange-600 dark:text-orange-400 hover:text-orange-800 dark:hover:text-orange-300 font-medium text-sm inline-block">
                View Feedback →
            </a>
        </div>

        <!-- Recent Feedback Table -->
        @if($recentFeedback->isNotEmpty())
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Recent Feedback</h3>
                <a href="{{ route('admin.feedback') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-medium text-sm">View All →</a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Subject</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">User</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($recentFeedback->take(5) as $feedback)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900 dark:text-white">{{ Str::limit($feedback->subject, 40) }}</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">{{ Str::limit($feedback->message, 60) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                {{ $feedback->user->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $feedback->status_color }}">
                                    {{ $feedback->status_display }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                {{ $feedback->created_at->diffForHumans() }}
                            </td>
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
    <script>
        const chartConfig = {
            plugins: { legend: { display: false } },
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%'
        };

        new Chart(document.getElementById('managerStatusChart'), {
            type: 'doughnut',
            data: {
                labels: ['Active', 'Inactive'],
                datasets: [{ data: [{{ $activeManagers }}, {{ $inactiveManagers }}], backgroundColor: ['#10B981', '#EF4444'], borderWidth: 0 }]
            },
            options: chartConfig
        });

        new Chart(document.getElementById('managerRolesChart'), {
            type: 'doughnut',
            data: {
                labels: ['Program', 'Admission', 'Both'],
                datasets: [{ data: [{{ $programManagers }}, {{ $admissionManagers }}, {{ $bothRoleManagers }}], backgroundColor: ['#3B82F6', '#F59E0B', '#10B981'], borderWidth: 0 }]
            },
            options: chartConfig
        });

        new Chart(document.getElementById('uploadCaseChart'), {
            type: 'doughnut',
            data: {
                labels: ['No Data'],
                datasets: [{ data: [1], backgroundColor: ['#9CA3AF'], borderWidth: 0 }]
            },
            options: chartConfig
        });
    </script>
</x-layouts.app>
