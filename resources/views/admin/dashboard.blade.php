<x-layouts.app>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 p-6">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                        Admin Dashboard
                    </h1>
                    <p class="text-slate-600 mt-2">Welcome back, {{ auth()->user()->name }}. Here's what's happening today.</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="bg-white rounded-lg px-4 py-2 shadow-sm border">
                        <span class="text-sm text-slate-500">Today</span>
                        <div class="text-lg font-semibold text-slate-800">{{ date('M d, Y') }}</div>
                    </div>
                    <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center text-white font-semibold">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Managers Card -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-500 text-sm font-medium">Total Managers</p>
                        <p class="text-3xl font-bold text-slate-900 mt-1">1</p>
                        <div class="flex items-center mt-2">
                            <span class="text-green-600 text-xs font-medium bg-green-50 px-2 py-1 rounded-full">
                                Active
                            </span>
                        </div>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Pending Cases Card -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-500 text-sm font-medium">Pending Cases</p>
                        <p class="text-3xl font-bold text-slate-900 mt-1">0</p>
                        <div class="flex items-center mt-2">
                            <span class="text-slate-600 text-xs font-medium bg-slate-50 px-2 py-1 rounded-full">
                                Up to date
                            </span>
                        </div>
                    </div>
                    <div class="w-12 h-12 bg-amber-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- System Health Card -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-500 text-sm font-medium">System Health</p>
                        <p class="text-3xl font-bold text-green-600 mt-1">98%</p>
                        <div class="flex items-center mt-2">
                            <span class="text-green-600 text-xs font-medium bg-green-50 px-2 py-1 rounded-full">
                                Excellent
                            </span>
                        </div>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Card -->
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl shadow-sm p-6 text-white hover:shadow-md transition-shadow duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm font-medium">Quick Actions</p>
                        <p class="text-2xl font-bold mt-1">Manage</p>
                        <div class="mt-3">
                            <a href="{{ route('staff.create') }}" class="text-white text-xs font-medium bg-white/20 hover:bg-white/30 px-3 py-1 rounded-full transition-colors duration-200">
                                + Add Staff
                            </a>
                        </div>
                    </div>
                    <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- Manager Status Chart -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-slate-800">Manager Status</h3>
                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                </div>
                <div class="relative h-64 mb-4">
                    <canvas id="managerStatusChart"></canvas>
                </div>
                <div class="flex justify-center space-x-6">
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                        <span class="text-sm text-slate-600 font-medium">Active</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-red-500 rounded-full mr-2"></div>
                        <span class="text-sm text-slate-600 font-medium">Inactive</span>
                    </div>
                </div>
            </div>

            <!-- Manager Roles Chart -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-slate-800">Manager Roles</h3>
                    <div class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></div>
                </div>
                <div class="relative h-64 mb-4">
                    <canvas id="managerRolesChart"></canvas>
                </div>
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-blue-500 rounded-full mr-2"></div>
                            <span class="text-sm text-slate-600">Programme Manager</span>
                        </div>
                        <span class="text-xs text-slate-500 font-medium">60%</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-amber-500 rounded-full mr-2"></div>
                            <span class="text-sm text-slate-600">Admission Manager</span>
                        </div>
                        <span class="text-xs text-slate-500 font-medium">25%</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                            <span class="text-sm text-slate-600">Both Roles</span>
                        </div>
                        <span class="text-xs text-slate-500 font-medium">15%</span>
                    </div>
                </div>
            </div>

            <!-- Upload Result Cases Chart -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-slate-800">Upload Cases</h3>
                    <div class="w-2 h-2 bg-slate-400 rounded-full"></div>
                </div>
                <div class="relative h-64 mb-4 flex items-center justify-center">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mb-3">
                            <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <p class="text-slate-500 text-sm font-medium">No Data Available</p>
                        <p class="text-slate-400 text-xs mt-1">Start uploading to see analytics</p>
                    </div>
                </div>
                <div class="flex justify-center">
                    <button class="text-blue-600 text-sm font-medium hover:text-blue-700 transition-colors duration-200">
                        View Upload History
                    </button>
                </div>
            </div>
        </div>

        <!-- Recent Activity Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Activities -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-slate-800">Recent Activities</h3>
                    <button class="text-blue-600 text-sm font-medium hover:text-blue-700 transition-colors duration-200">
                        View All
                    </button>
                </div>
                <div class="space-y-4">
                    <div class="flex items-center space-x-3 p-3 rounded-lg hover:bg-slate-50 transition-colors duration-200">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-slate-800">New user registered</p>
                            <p class="text-xs text-slate-500">2 minutes ago</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3 p-3 rounded-lg hover:bg-slate-50 transition-colors duration-200">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-slate-800">System backup completed</p>
                            <p class="text-xs text-slate-500">1 hour ago</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3 p-3 rounded-lg hover:bg-slate-50 transition-colors duration-200">
                        <div class="w-8 h-8 bg-amber-100 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.856-.833-2.598 0L4.268 15.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-slate-800">Security update available</p>
                            <p class="text-xs text-slate-500">3 hours ago</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-slate-800">System Overview</h3>
                    <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full font-medium">Online</span>
                </div>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-3 rounded-lg bg-slate-50">
                        <span class="text-sm font-medium text-slate-700">Server Uptime</span>
                        <span class="text-sm font-bold text-green-600">99.9%</span>
                    </div>
                    <div class="flex items-center justify-between p-3 rounded-lg bg-slate-50">
                        <span class="text-sm font-medium text-slate-700">Active Sessions</span>
                        <span class="text-sm font-bold text-blue-600">{{ \DB::table('sessions')->count() }}</span>
                    </div>
                    <div class="flex items-center justify-between p-3 rounded-lg bg-slate-50">
                        <span class="text-sm font-medium text-slate-700">Total Users</span>
                        <span class="text-sm font-bold text-purple-600">{{ \App\Models\User::count() }}</span>
                    </div>
                    <div class="flex items-center justify-between p-3 rounded-lg bg-slate-50">
                        <span class="text-sm font-medium text-slate-700">Storage Used</span>
                        <span class="text-sm font-bold text-amber-600">2.4 GB</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/admin-dashboard.js') }}"></script>
</x-layouts.app>