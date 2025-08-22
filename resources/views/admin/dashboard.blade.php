<x-layouts.app title="Dashboard">
    <div class="space-y-8">
        <!-- Page Title -->
        <div class="text-center">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">ADMIN DASHBOARD</h1>
        </div>

        <!-- Statistics Cards -->
        <div class="flex gap-6 justify-center mb-8">
            <div class="bg-blue-100 rounded-lg shadow-lg p-8 text-center min-w-[200px]">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Total Managers</h2>
                <p class="text-4xl font-bold text-gray-800">1</p>
            </div>
            <div class="bg-blue-100 rounded-lg shadow-lg p-8 text-center min-w-[200px]">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Pending Case Reports</h2>
                <p class="text-4xl font-bold text-gray-800">0</p>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="max-w-6xl mx-auto grid md:grid-cols-3 gap-8">
            <!-- Manager Status Chart -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4 text-center">Manager Status</h3>
                <div class="relative h-64">
                    <canvas id="managerStatusChart"></canvas>
                </div>
                <div class="flex justify-center mt-4 space-x-4">
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                        <span class="text-sm text-gray-600">Active Manager</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-red-500 rounded-full mr-2"></div>
                        <span class="text-sm text-gray-600">Inactive Manager</span>
                    </div>
                </div>
            </div>

            <!-- Manager Roles Chart -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4 text-center">Manager Roles</h3>
                <div class="relative h-64">
                    <canvas id="managerRolesChart"></canvas>
                </div>
                <div class="flex justify-center mt-4 space-x-4">
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-blue-500 rounded-full mr-2"></div>
                        <span class="text-sm text-gray-600">Programme Manager</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-yellow-500 rounded-full mr-2"></div>
                        <span class="text-sm text-gray-600">Admission Manager</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                        <span class="text-sm text-gray-600">Both</span>
                    </div>
                </div>
            </div>

            <!-- Upload Result Case Type Chart -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h3 class="text-lg font-semibold text-gray-700 mb-4 text-center">Upload Result Case Type</h3>
                <div class="relative h-64">
                    <canvas id="uploadCaseChart"></canvas>
                </div>
                <div class="flex justify-center mt-4">
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-gray-400 rounded-full mr-2"></div>
                        <span class="text-sm text-gray-600">No Data Available</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/admin-dashboard.js') }}"></script>
</x-layouts.app>