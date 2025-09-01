@php
    $schoolNames = [
        'business' => 'School of Business',
        'health' => 'School of Health Sciences',
        'ict' => 'School of Information and Communication Technology',
        'engineering' => 'School of Science & Engineering',
        'petrochemical' => 'School of Petrochemical'
    ];
    
    $schoolImages = [
        'business' => 'business.png',
        'health' => 'health.png',
        'ict' => 'ict.png',
        'engineering' => 'engineering.png',
        'petrochemical' => 'petrochemical.jpg'
    ];
    
    $schoolColors = [
        'business' => 'blue',
        'health' => 'green',
        'ict' => 'purple',
        'engineering' => 'red',
        'petrochemical' => 'orange'
    ];
    
    $currentSchoolName = $schoolNames[$school] ?? 'Unknown School';
    $currentSchoolImage = $schoolImages[$school] ?? 'default.png';
    $currentColor = $schoolColors[$school] ?? 'gray';
@endphp

<x-layouts.app>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('staff.program.programme-management') }}" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $currentSchoolName }}
            </h2>
        </div>
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

                <!-- School Header -->
                <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden mb-6">
                    <div class="bg-gradient-to-r from-{{ $currentColor }}-400/90 to-{{ $currentColor }}-600/90 text-white p-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-6">
                                <div class="w-20 h-20 overflow-hidden rounded-full bg-white shadow-lg flex-shrink-0">
                                    <img src="{{ asset('images/schools/' . $currentSchoolImage) }}" 
                                         alt="{{ $currentSchoolName }}" 
                                         class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <h1 class="text-3xl font-bold">{{ $currentSchoolName }}</h1>
                                    <p class="text-{{ $currentColor }}-100 mt-2">Programme Management</p>
                                </div>
                            </div>
                            <button onclick="openAddProgrammeModal()" class="bg-white/20 hover:bg-white/30 text-white px-6 py-3 rounded-lg transition-colors flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Add New Programme
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Statistics Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-xl shadow-lg border border-slate-200/60 dark:border-slate-700/60 p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-{{ $currentColor }}-100 dark:bg-{{ $currentColor }}-900/20">
                                <svg class="w-6 h-6 text-{{ $currentColor }}-600 dark:text-{{ $currentColor }}-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-2xl font-bold text-slate-900 dark:text-slate-100" id="totalProgrammes">12</p>
                                <p class="text-sm text-slate-600 dark:text-slate-400">Total Programmes</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-xl shadow-lg border border-slate-200/60 dark:border-slate-700/60 p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 dark:bg-green-900/20">
                                <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-2xl font-bold text-slate-900 dark:text-slate-100">8</p>
                                <p class="text-sm text-slate-600 dark:text-slate-400">Active Programmes</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-xl shadow-lg border border-slate-200/60 dark:border-slate-700/60 p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-purple-100 dark:bg-purple-900/20">
                                <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-2xl font-bold text-slate-900 dark:text-slate-100">850</p>
                                <p class="text-sm text-slate-600 dark:text-slate-400">Total Students</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-xl shadow-lg border border-slate-200/60 dark:border-slate-700/60 p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-orange-100 dark:bg-orange-900/20">
                                <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-2xl font-bold text-slate-900 dark:text-slate-100">25</p>
                                <p class="text-sm text-slate-600 dark:text-slate-400">Faculty Members</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filters and Search -->
                <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 p-6 mb-6">
                    <form method="GET" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <!-- Search -->
                            <div class="lg:col-span-2">
                                <label for="search" class="block text-sm font-medium text-slate-700 dark:text-slate-200 mb-1">Search</label>
                                <input type="text" 
                                       id="search" 
                                       name="search" 
                                       value="{{ request('search') }}"
                                       placeholder="Search programmes..."
                                       class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-{{ $currentColor }}-500 focus:border-{{ $currentColor }}-500">
                            </div>

                            <!-- Duration Filter -->
                            <div>
                                <label for="duration" class="block text-sm font-medium text-slate-700 dark:text-slate-200 mb-1">Duration</label>
                                <select id="duration" 
                                        name="duration" 
                                        class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-{{ $currentColor }}-500 focus:border-{{ $currentColor }}-500">
                                    <option value="">All Durations</option>
                                    <option value="1.0" {{ request('duration') == '1.0' ? 'selected' : '' }}>1.0</option>
                                    <option value="1.5" {{ request('duration') == '1.5' ? 'selected' : '' }}>1.5</option>
                                    <option value="2.0" {{ request('duration') == '2.0' ? 'selected' : '' }}>2.0</option>
                                    <option value="2.5" {{ request('duration') == '2.5' ? 'selected' : '' }}>2.5</option>
                                    <option value="3.0" {{ request('duration') == '3.0' ? 'selected' : '' }}>3.0</option>
                                    <option value="3.5" {{ request('duration') == '3.5' ? 'selected' : '' }}>3.5</option>
                                    <option value="4.0" {{ request('duration') == '4.0' ? 'selected' : '' }}>4.0</option>
                                    <option value="4.5" {{ request('duration') == '4.5' ? 'selected' : '' }}>4.5</option>
                                    <option value="5.0" {{ request('duration') == '5.0' ? 'selected' : '' }}>5.0</option>
                                </select>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex items-end gap-2">
                                <button type="submit" class="bg-{{ $currentColor }}-600 hover:bg-{{ $currentColor }}-700 text-white px-4 py-2 rounded-lg transition-colors">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                    Filter
                                </button>
                                <a href="{{ route('staff.program.school', $school) }}" class="bg-slate-500 hover:bg-slate-600 text-white px-4 py-2 rounded-lg transition-colors">
                                    Reset
                                </a>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Bulk Actions -->
                <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 mb-6 p-4" id="bulkActions" style="display: none;">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-slate-600 dark:text-slate-400">
                            <span id="selectedCount">0</span> programmes selected
                        </span>
                        <button onclick="bulkDelete()" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition-colors">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Delete Selected
                        </button>
                    </div>
                </div>

                <!-- Programmes Table -->
                <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-700">
                        <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100">{{ $currentSchoolName }} Programmes</h3>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-slate-50 dark:bg-slate-700/50">
                                <tr>
                                    <th class="px-6 py-4 text-left">
                                        <input type="checkbox" id="selectAll" class="rounded border-slate-300 text-{{ $currentColor }}-600 focus:ring-{{ $currentColor }}-500">
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Programme</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Duration</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Entry Requirements</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200 dark:divide-slate-700" id="programmesTableBody">
                                <!-- This will be populated by JavaScript -->
                            </tbody>
                        </table>
                    </div>

                    <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-700" id="pagination">
                        <!-- Pagination will be added here -->
                    </div>
                </div>

                </div>
        </div>
    </div>

    <!-- Add Programme Modal -->
    <div id="addProgrammeModal" class="fixed inset-0 z-[9999] hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-75" onclick="closeAddProgrammeModal()"></div>
            <div class="relative inline-block w-full max-w-md p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white dark:bg-slate-800 shadow-2xl rounded-2xl border border-slate-200 dark:border-slate-700">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Add New Programme</h3>
                    <button onclick="closeAddProgrammeModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                
                <form id="addProgrammeForm" onsubmit="submitAddProgramme(event)">
                    <div class="space-y-4">
                        <div>
                            <label for="programmeName" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Programme Name</label>
                            <select id="programmeName" name="programme_name" required class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-slate-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-{{ $currentColor }}-500 focus:border-{{ $currentColor }}-500">
                                <option value="">Select Programme</option>
                                <!-- Will be populated by JavaScript -->
                            </select>
                        </div>
                        
                        <div>
                            <label for="programmeDuration" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Duration</label>
                            <select id="programmeDuration" name="duration" required class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-slate-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-{{ $currentColor }}-500 focus:border-{{ $currentColor }}-500">
                                <option value="">Select Duration</option>
                                <option value="1.0">1.0</option>
                                <option value="1.5">1.5</option>
                                <option value="2.0">2.0</option>
                                <option value="2.5">2.5</option>
                                <option value="3.0">3.0</option>
                                <option value="3.5">3.5</option>
                                <option value="4.0">4.0</option>
                                <option value="4.5">4.5</option>
                                <option value="5.0">5.0</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="flex justify-end gap-3 mt-6">
                        <button type="button" onclick="closeAddProgrammeModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 dark:bg-gray-600 dark:text-gray-300 dark:hover:bg-gray-500">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-{{ $currentColor }}-600 rounded-lg hover:bg-{{ $currentColor }}-700">
                            Add Programme
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Global variables
        let programmes = [];
        let availableDiplomaProgrammes = [];
        let currentPage = 1;
        let totalPages = 1;
        const school = '{{ $school }}';

        // CSRF token for API requests
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        document.addEventListener('DOMContentLoaded', function() {
            loadProgrammes();
            loadAvailableProgrammes();
            loadStatistics();
            setupEventListeners();
        });

        function setupEventListeners() {
            // Select all checkbox
            document.getElementById('selectAll').addEventListener('change', function() {
                const checkboxes = document.querySelectorAll('input[name="selected_programmes[]"]');
                checkboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
                updateBulkActions();
            });

            // Search functionality
            const searchInput = document.getElementById('search');
            const durationSelect = document.getElementById('duration');
            
            if (searchInput) {
                searchInput.addEventListener('input', debounce(() => {
                    currentPage = 1;
                    loadProgrammes();
                }, 300));
            }

            if (durationSelect) {
                durationSelect.addEventListener('change', () => {
                    currentPage = 1;
                    loadProgrammes();
                });
            }
        }

        // Debounce function for search
        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        async function apiRequest(url, options = {}) {
            const defaultOptions = {
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            };

            const response = await fetch(url, { ...defaultOptions, ...options });
            
            if (!response.ok) {
                const error = await response.json().catch(() => ({ message: 'Network error' }));
                throw new Error(error.message || 'API request failed');
            }
            
            return response.json();
        }

        async function loadProgrammes() {
            try {
                const searchTerm = document.getElementById('search').value;
                const duration = document.getElementById('duration').value;
                
                const params = new URLSearchParams();
                if (searchTerm) params.append('search', searchTerm);
                if (duration) params.append('duration', duration);
                params.append('page', currentPage);
                
                const url = `/staff/program/api/school/${school}/programmes?${params}`;
                const response = await apiRequest(url);
                programmes = response.data;
                
                updateProgrammesTable();
                updatePagination(response.meta);
                
            } catch (error) {
                console.error('Error loading programmes:', error);
                showError('Failed to load programmes: ' + error.message);
            }
        }

        async function loadAvailableProgrammes() {
            try {
                const response = await apiRequest(`/staff/program/api/school/${school}/programmes/available`);
                availableDiplomaProgrammes = response.data;
                updateAvailableProgrammesDropdown();
                
            } catch (error) {
                console.error('Error loading available programmes:', error);
            }
        }

        async function loadStatistics() {
            try {
                const response = await apiRequest(`/staff/program/api/school/${school}/programmes/statistics`);
                updateStatistics(response.data);
                
            } catch (error) {
                console.error('Error loading statistics:', error);
            }
        }

        function updateProgrammesTable() {
            const tbody = document.getElementById('programmesTableBody');
            tbody.innerHTML = '';

            if (programmes.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-slate-500 dark:text-slate-400">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <h3 class="text-lg font-medium mb-2">No programmes found</h3>
                                <p class="text-sm">Add your first programme to get started.</p>
                            </div>
                        </td>
                    </tr>
                `;
                return;
            }

            programmes.forEach(programme => {
                const row = `
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input type="checkbox" name="selected_programmes[]" value="${programme.id}" class="rounded border-slate-300 text-{{ $currentColor }}-600 focus:ring-{{ $currentColor }}-500" onchange="updateBulkActions()">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900 dark:text-slate-100">${programme.diploma_programme?.name || 'Unknown Programme'}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 dark:text-slate-400">${programme.duration}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex gap-2">
                                <button onclick="navigateToHntec(${programme.id})" class="bg-purple-100 hover:bg-purple-200 text-purple-800 dark:bg-purple-900/20 dark:text-purple-300 px-3 py-1 rounded-full text-xs font-medium transition-colors">
                                    HNTec Programmes
                                </button>
                                <button onclick="navigateToOLevel(${programme.id})" class="bg-green-100 hover:bg-green-200 text-green-800 dark:bg-green-900/20 dark:text-green-300 px-3 py-1 rounded-full text-xs font-medium transition-colors">
                                    O Level Subjects
                                </button>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex gap-2">
                                <button onclick="editProgramme(${programme.id})" class="text-{{ $currentColor }}-600 hover:text-{{ $currentColor }}-900 dark:text-{{ $currentColor }}-400 dark:hover:text-{{ $currentColor }}-300" title="Edit Programme">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </button>
                                <button onclick="deleteProgramme(${programme.id})" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 ml-2" title="Delete Programme">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
                tbody.innerHTML += row;
            });
        }

        function updateAvailableProgrammesDropdown() {
            const select = document.getElementById('programmeName');
            // Clear existing options except the first placeholder
            select.innerHTML = '<option value="">Select Programme</option>';
            
            availableDiplomaProgrammes.forEach(programme => {
                const option = document.createElement('option');
                option.value = programme.id;
                option.textContent = programme.name;
                select.appendChild(option);
            });
        }

        function updateStatistics(stats) {
            document.getElementById('totalProgrammes').textContent = stats.total_programmes;
        }

        function updatePagination(meta) {
            if (!meta) return;
            
            currentPage = meta.current_page;
            totalPages = meta.last_page;
            
            const pagination = document.getElementById('pagination');
            if (totalPages <= 1) {
                pagination.innerHTML = '';
                return;
            }
            
            let paginationHTML = '<div class="flex items-center justify-between">';
            paginationHTML += `<div class="text-sm text-slate-600 dark:text-slate-400">Showing ${meta.per_page * (currentPage - 1) + 1} to ${Math.min(meta.per_page * currentPage, meta.total)} of ${meta.total} results</div>`;
            paginationHTML += '<div class="flex gap-2">';
            
            if (currentPage > 1) {
                paginationHTML += `<button onclick="changePage(${currentPage - 1})" class="px-3 py-2 text-sm bg-white dark:bg-slate-700 border border-slate-300 dark:border-slate-600 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-600">Previous</button>`;
            }
            
            if (currentPage < totalPages) {
                paginationHTML += `<button onclick="changePage(${currentPage + 1})" class="px-3 py-2 text-sm bg-white dark:bg-slate-700 border border-slate-300 dark:border-slate-600 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-600">Next</button>`;
            }
            
            paginationHTML += '</div></div>';
            pagination.innerHTML = paginationHTML;
        }

        function changePage(page) {
            currentPage = page;
            loadProgrammes();
        }

        function updateBulkActions() {
            const selectedCheckboxes = document.querySelectorAll('input[name="selected_programmes[]"]:checked');
            const bulkActions = document.getElementById('bulkActions');
            const selectedCount = document.getElementById('selectedCount');
            
            if (selectedCheckboxes.length > 0) {
                bulkActions.style.display = 'block';
                selectedCount.textContent = selectedCheckboxes.length;
            } else {
                bulkActions.style.display = 'none';
            }
        }

        async function openAddProgrammeModal() {
            console.log('Opening add programme modal...'); // Debug log
            
            // Show modal first
            const modal = document.getElementById('addProgrammeModal');
            if (modal) {
                modal.classList.remove('hidden');
                console.log('Modal should be visible now'); // Debug log
            } else {
                console.error('Modal element not found!'); // Debug log
                return;
            }
            
            // Then load available programmes
            try {
                await loadAvailableProgrammes();
            } catch (error) {
                console.error('Error loading programmes for modal:', error);
                // Don't prevent modal from showing even if API fails
            }
        }

        function closeAddProgrammeModal() {
            document.getElementById('addProgrammeModal').classList.add('hidden');
            document.getElementById('addProgrammeForm').reset();
        }

        async function submitAddProgramme(event) {
            event.preventDefault();
            
            const form = document.getElementById('addProgrammeForm');
            const formData = new FormData(form);
            const data = {
                diploma_programme_id: parseInt(formData.get('programme_name')),
                duration: formData.get('duration')
            };

            try {
                await apiRequest(`/staff/program/api/school/${school}/programmes`, {
                    method: 'POST',
                    body: JSON.stringify(data)
                });

                showSuccess('Programme added successfully!');
                closeAddProgrammeModal();
                loadProgrammes(); // Refresh the table
                loadAvailableProgrammes(); // Refresh available programmes
                loadStatistics(); // Update statistics
                
            } catch (error) {
                showError('Failed to add programme: ' + error.message);
            }
        }

        function editProgramme(id) {
            // TODO: Implement edit modal and functionality
            showInfo('Edit functionality coming soon!');
        }

        async function deleteProgramme(id) {
            if (!confirm('Are you sure you want to delete this programme? This will also delete all related entry requirements.')) {
                return;
            }

            try {
                await apiRequest(`/staff/program/api/school/${school}/programmes/${id}`, {
                    method: 'DELETE'
                });

                showSuccess('Programme deleted successfully!');
                loadProgrammes(); // Refresh the table
                loadAvailableProgrammes(); // Refresh available programmes
                loadStatistics(); // Update statistics
                
            } catch (error) {
                showError('Failed to delete programme: ' + error.message);
            }
        }

        async function bulkDelete() {
            const selected = document.querySelectorAll('input[name="selected_programmes[]"]:checked');
            if (selected.length === 0) {
                showError('Please select programmes to delete.');
                return;
            }

            if (!confirm(`Are you sure you want to delete ${selected.length} programmes? This will also delete all related entry requirements.`)) {
                return;
            }

            const programmeIds = Array.from(selected).map(checkbox => parseInt(checkbox.value));

            try {
                await apiRequest(`/staff/program/api/school/${school}/programmes/bulk`, {
                    method: 'DELETE',
                    body: JSON.stringify({ programme_ids: programmeIds })
                });

                showSuccess(`${selected.length} programmes deleted successfully!`);
                loadProgrammes(); // Refresh the table
                loadAvailableProgrammes(); // Refresh available programmes
                loadStatistics(); // Update statistics
                
            } catch (error) {
                showError('Failed to delete programmes: ' + error.message);
            }
        }

        function navigateToHntec(programmeId) {
            window.location.href = `/staff/program/school/${school}/programmes/${programmeId}/entry-requirements/hntec`;
        }

        function navigateToOLevel(programmeId) {
            window.location.href = `/staff/program/school/${school}/programmes/${programmeId}/entry-requirements/olevel`;
        }

        // Utility functions for showing messages
        function showSuccess(message) {
            showMessage(message, 'success');
        }

        function showError(message) {
            showMessage(message, 'error');
        }

        function showInfo(message) {
            showMessage(message, 'info');
        }

        function showMessage(message, type) {
            // Create a temporary message div
            const messageDiv = document.createElement('div');
            const bgColor = type === 'success' ? 'bg-green-50 border-green-200 text-green-800' : 
                           type === 'error' ? 'bg-red-50 border-red-200 text-red-800' : 
                           'bg-blue-50 border-blue-200 text-blue-800';
            
            messageDiv.innerHTML = `
                <div class="fixed top-4 right-4 z-50 ${bgColor} border-2 rounded-xl p-4 shadow-lg max-w-md">
                    <div class="flex items-center gap-3">
                        <p class="font-medium">${message}</p>
                        <button onclick="this.parentElement.parentElement.remove()" class="text-current hover:opacity-75">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
            `;
            
            document.body.appendChild(messageDiv);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                if (messageDiv.parentElement) {
                    messageDiv.remove();
                }
            }, 5000);
        }
    </script>
</x-layouts.app>