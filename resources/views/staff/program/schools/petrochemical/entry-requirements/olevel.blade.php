@php
    $schoolName = 'School of Petrochemical';
    $schoolSlug = 'petrochemical';
    // This would normally come from the controller
    $programmeId = request()->route('programmeId') ?? 1;
    $programmeName = 'Sample Programme'; // This would come from database
@endphp

<x-layouts.app>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('staff.program.school', 'petrochemical') }}" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $programmeName }} - O Level Entry Requirements
            </h2>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-orange-50 dark:from-slate-900 dark:to-orange-950 transition-colors duration-300">
        <div class="p-6">
            <div class="max-w-7xl mx-auto">
                
                <!-- Back Button -->
                <div class="mb-6">
                    <flux:button variant="ghost" size="sm" href="{{ route('staff.program.school', 'petrochemical') }}">
                        <flux:icon.arrow-left class="w-4 h-4 mr-2" />
                        Back to Petrochemical School
                    </flux:button>
                </div>
                
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
                    <div class="bg-gradient-to-r from-orange-400/90 to-orange-600/90 text-white p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h1 class="text-3xl font-bold">O Level Entry Requirements</h1>
                                <p class="text-orange-100 mt-2">{{ $programmeName }} - {{ $schoolName }}</p>
                            </div>
                            <button onclick="openAddOLevelModal()" class="bg-white/20 hover:bg-white/30 text-white px-6 py-3 rounded-lg transition-colors flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Add New Entry Requirement
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Statistics Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-xl shadow-lg border border-slate-200/60 dark:border-slate-700/60 p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-orange-100 dark:bg-orange-900/20">
                                <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-2xl font-bold text-slate-900 dark:text-slate-100" id="totalOLevel">8</p>
                                <p class="text-sm text-slate-600 dark:text-slate-400">Total Requirements</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-xl shadow-lg border border-slate-200/60 dark:border-slate-700/60 p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-orange-100 dark:bg-orange-900/20">
                                <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-2xl font-bold text-slate-900 dark:text-slate-100">5</p>
                                <p class="text-sm text-slate-600 dark:text-slate-400">Compulsory Subjects</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-xl shadow-lg border border-slate-200/60 dark:border-slate-700/60 p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900/20">
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-2xl font-bold text-slate-900 dark:text-slate-100">3</p>
                                <p class="text-sm text-slate-600 dark:text-slate-400">General Subjects</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-xl shadow-lg border border-slate-200/60 dark:border-slate-700/60 p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 dark:bg-green-900/20">
                                <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-2xl font-bold text-slate-900 dark:text-slate-100">C</p>
                                <p class="text-sm text-slate-600 dark:text-slate-400">Average Min Grade</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filters and Search -->
                <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 p-6 mb-6">
                    <form method="GET" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                            <!-- Search -->
                            <div class="lg:col-span-2">
                                <label for="search" class="block text-sm font-medium text-slate-700 dark:text-slate-200 mb-1">Search</label>
                                <input type="text" 
                                       id="search" 
                                       name="search" 
                                       value="{{ request('search') }}"
                                       placeholder="Search O Level subjects..."
                                       class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                            </div>

                            <!-- Qualification Filter -->
                            <div>
                                <label for="qualification" class="block text-sm font-medium text-slate-700 dark:text-slate-200 mb-1">Qualification</label>
                                <select id="qualification" 
                                        name="qualification" 
                                        class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                    <option value="">All Qualifications</option>
                                    <option value="IGCSE" {{ request('qualification') == 'IGCSE' ? 'selected' : '' }}>IGCSE</option>
                                    <option value="GCE" {{ request('qualification') == 'GCE' ? 'selected' : '' }}>GCE</option>
                                </select>
                            </div>

                            <!-- Category Filter -->
                            <div>
                                <label for="category" class="block text-sm font-medium text-slate-700 dark:text-slate-200 mb-1">Category</label>
                                <select id="category" 
                                        name="category" 
                                        class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                    <option value="">All Categories</option>
                                    <option value="Compulsory" {{ request('category') == 'Compulsory' ? 'selected' : '' }}>Compulsory</option>
                                    <option value="General" {{ request('category') == 'General' ? 'selected' : '' }}>General</option>
                                </select>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex items-end gap-2">
                                <button type="submit" class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-lg transition-colors">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                    Filter
                                </button>
                                <a href="{{ route('staff.program.school.programmes.olevel', ['school' => 'petrochemical', 'programmeId' => $programmeId]) }}" class="bg-slate-500 hover:bg-slate-600 text-white px-4 py-2 rounded-lg transition-colors">
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
                            <span id="selectedCount">0</span> requirements selected
                        </span>
                        <button onclick="bulkDelete()" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition-colors">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Delete Selected
                        </button>
                    </div>
                </div>

                <!-- O Level Requirements Table -->
                <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-700">
                        <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100">O Level Entry Requirements</h3>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-slate-50 dark:bg-slate-700/50">
                                <tr>
                                    <th class="px-6 py-4 text-left">
                                        <input type="checkbox" id="selectAll" class="rounded border-slate-300 text-orange-600 focus:ring-orange-500">
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Subject Name</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Qualifications</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Category</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Min. Grade</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200 dark:divide-slate-700" id="oLevelTableBody">
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

    <!-- Add O Level Requirement Modal -->
    <div id="addOLevelModal" class="fixed inset-0 z-[9999] hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-75" onclick="closeAddOLevelModal()"></div>
            <div class="relative inline-block w-full max-w-md p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white dark:bg-slate-800 shadow-2xl rounded-2xl border border-slate-200 dark:border-slate-700">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Add O Level Entry Requirement</h3>
                    <button onclick="closeAddOLevelModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                
                <form id="addOLevelForm" onsubmit="submitAddOLevel(event)">
                    <div class="space-y-4">
                        <div>
                            <label for="oLevelSubjectName" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Subject Name</label>
                            <select id="oLevelSubjectName" name="subject_name" required class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-slate-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500" onchange="updateQualifications()">
                                <option value="">Select Subject</option>
                                <!-- Will be populated by JavaScript -->
                            </select>
                        </div>

                        <div>
                            <label for="oLevelQualification" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Qualification</label>
                            <select id="oLevelQualification" name="qualification" required class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-slate-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                <option value="">Select Qualification</option>
                                <!-- Will be populated based on subject selection -->
                            </select>
                        </div>
                        
                        <div>
                            <label for="oLevelCategory" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Category</label>
                            <select id="oLevelCategory" name="category" required class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-slate-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                <option value="">Select Category</option>
                                <option value="Compulsory">Compulsory</option>
                                <option value="General">General</option>
                            </select>
                        </div>

                        <div>
                            <label for="minGrade" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Minimum Grade</label>
                            <select id="minGrade" name="min_grade" required class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-slate-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                                <option value="">Select Minimum Grade</option>
                                <option value="A*">A*</option>
                                <option value="A(a)">A(a)</option>
                                <option value="B(b)">B(b)</option>
                                <option value="C(c)">C(c)</option>
                                <option value="D(d)">D(d)</option>
                                <option value="E(e)">E(e)</option>
                                <option value="F(f)">F(f)</option>
                                <option value="U">U</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="flex justify-end gap-3 mt-6">
                        <button type="button" onclick="closeAddOLevelModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 dark:bg-gray-600 dark:text-gray-300 dark:hover:bg-gray-500">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-orange-600 rounded-lg hover:bg-orange-700">
                            Add Requirement
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const school = '{{ $schoolSlug }}';
        const programmeId = {{ $programmeId }};
        let oLevelRequirements = [];
        let availableOLevelSubjects = [];
        let currentPage = 1;
        let lastPage = 1;
        
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

        document.addEventListener('DOMContentLoaded', function() {
            loadOLevelRequirements();
            loadAvailableOLevelSubjects();
            loadStatistics();
            setupEventListeners();
        });

        function setupEventListeners() {
            // Select all checkbox
            document.getElementById('selectAll').addEventListener('change', function() {
                const checkboxes = document.querySelectorAll('input[name="selected_olevel[]"]');
                checkboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
                updateBulkActions();
            });

            // Search functionality
            const searchInput = document.getElementById('search');
            const categorySelect = document.getElementById('category');
            const qualificationSelect = document.getElementById('qualification');
            
            if (searchInput) {
                searchInput.addEventListener('input', debounce(() => {
                    currentPage = 1;
                    loadOLevelRequirements();
                }, 300));
            }

            if (categorySelect) {
                categorySelect.addEventListener('change', () => {
                    currentPage = 1;
                    loadOLevelRequirements();
                });
            }

            if (qualificationSelect) {
                qualificationSelect.addEventListener('change', () => {
                    currentPage = 1;
                    loadOLevelRequirements();
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

        // API request helper
        async function apiRequest(url, options = {}) {
            const defaultOptions = {
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            };

            const response = await fetch(url, { ...defaultOptions, ...options });
            
            if (!response.ok) {
                const errorData = await response.json().catch(() => ({ message: 'Request failed' }));
                throw new Error(errorData.message || `HTTP error! status: ${response.status}`);
            }
            
            return await response.json();
        }

        // Show success message
        function showSuccess(message) {
            const successDiv = document.createElement('div');
            successDiv.className = 'mb-6 bg-green-50 dark:bg-green-900/20 border-2 border-green-200 dark:border-green-700 rounded-xl p-4';
            successDiv.innerHTML = `
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-green-800 dark:text-green-200 font-medium">${message}</p>
                </div>
            `;
            
            const container = document.querySelector('.max-w-7xl');
            container.insertBefore(successDiv, container.firstChild);
            
            setTimeout(() => successDiv.remove(), 5000);
        }

        // Show error message
        function showError(message) {
            const errorDiv = document.createElement('div');
            errorDiv.className = 'mb-6 bg-red-50 dark:bg-red-900/20 border-2 border-red-200 dark:border-red-700 rounded-xl p-4';
            errorDiv.innerHTML = `
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-red-800 dark:text-red-200 font-medium">${message}</p>
                </div>
            `;
            
            const container = document.querySelector('.max-w-7xl');
            container.insertBefore(errorDiv, container.firstChild);
            
            setTimeout(() => errorDiv.remove(), 5000);
        }

        async function loadOLevelRequirements() {
            try {
                const searchTerm = document.getElementById('search').value;
                const category = document.getElementById('category').value;
                const qualification = document.getElementById('qualification').value;
                
                const params = new URLSearchParams();
                if (searchTerm) params.append('search', searchTerm);
                if (category) params.append('category', category);
                if (qualification) params.append('qualification', qualification);
                params.append('page', currentPage);
                
                const url = `/staff/program/api/school/${school}/programmes/${programmeId}/olevel-requirements?${params}`;
                const response = await apiRequest(url);
                
                oLevelRequirements = response.data || [];
                
                updateOLevelRequirementsTable();
                updatePagination(response.meta);
                
            } catch (error) {
                console.error('Error loading O Level requirements:', error);
                showError('Failed to load O Level requirements: ' + error.message);
            }
        }

        async function loadAvailableOLevelSubjects() {
            try {
                const url = `/staff/program/api/school/${school}/programmes/${programmeId}/available-olevel-subjects`;
                const response = await apiRequest(url);
                
                availableOLevelSubjects = response.data || [];
                updateAvailableSubjectsDropdown();
                
            } catch (error) {
                console.error('Error loading available O Level subjects:', error);
                showError('Failed to load available O Level subjects: ' + error.message);
            }
        }

        async function loadStatistics() {
            try {
                const url = `/staff/program/api/school/${school}/programmes/${programmeId}/olevel-statistics`;
                const response = await apiRequest(url);
                
                if (response.success && response.data) {
                    document.getElementById('totalOLevel').textContent = response.data.total_requirements;
                    document.querySelector('[id="totalOLevel"]').closest('.bg-white\\/80').nextElementSibling.querySelector('.text-2xl').textContent = response.data.compulsory_subjects;
                    document.querySelector('[id="totalOLevel"]').closest('.bg-white\\/80').nextElementSibling.nextElementSibling.querySelector('.text-2xl').textContent = response.data.general_subjects;
                    document.querySelector('[id="totalOLevel"]').closest('.bg-white\\/80').nextElementSibling.nextElementSibling.nextElementSibling.querySelector('.text-2xl').textContent = response.data.average_min_grade || 'N/A';
                }
                
            } catch (error) {
                console.error('Error loading statistics:', error);
            }
        }

        function updateAvailableSubjectsDropdown() {
            const select = document.getElementById('oLevelSubjectName');
            // Clear existing options except the first one
            while (select.children.length > 1) {
                select.removeChild(select.lastChild);
            }
            
            availableOLevelSubjects.forEach(subject => {
                const option = document.createElement('option');
                option.value = subject.id;
                option.textContent = subject.name;
                option.dataset.qualification = subject.qualification;
                select.appendChild(option);
            });
        }

        function updateQualifications() {
            const subjectSelect = document.getElementById('oLevelSubjectName');
            const qualificationSelect = document.getElementById('oLevelQualification');
            const selectedOption = subjectSelect.options[subjectSelect.selectedIndex];
            
            // Clear existing options
            qualificationSelect.innerHTML = '<option value="">Select Qualification</option>';
            
            if (selectedOption.dataset.qualification) {
                const option = document.createElement('option');
                option.value = selectedOption.dataset.qualification;
                option.textContent = selectedOption.dataset.qualification;
                qualificationSelect.appendChild(option);
                qualificationSelect.value = selectedOption.dataset.qualification;
            }
        }

        function updateOLevelRequirementsTable() {
            const tbody = document.getElementById('oLevelTableBody');
            tbody.innerHTML = '';

            if (oLevelRequirements.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-slate-500 dark:text-slate-400">
                            <svg class="w-12 h-12 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                            <p class="text-lg font-medium">No O Level requirements found</p>
                            <p class="mt-1">Add some O Level entry requirements to get started.</p>
                        </td>
                    </tr>
                `;
                return;
            }

            oLevelRequirements.forEach(requirement => {
                const categoryColor = requirement.category === 'Compulsory' ? 'red' : 'blue';
                const qualificationColor = requirement.o_level_subject?.qualification === 'IGCSE' ? 'orange' : 'indigo';
                const subjectName = requirement.o_level_subject?.name || 'Unknown Subject';
                const qualification = requirement.o_level_subject?.qualification || 'Unknown';
                
                const row = `
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input type="checkbox" name="selected_olevel[]" value="${requirement.id}" class="rounded border-slate-300 text-orange-600 focus:ring-orange-500" onchange="updateBulkActions()">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900 dark:text-slate-100">${subjectName}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-${qualificationColor}-100 text-${qualificationColor}-800 dark:bg-${qualificationColor}-900/20 dark:text-${qualificationColor}-300">
                                ${qualification}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-${categoryColor}-100 text-${categoryColor}-800 dark:bg-${categoryColor}-900/20 dark:text-${categoryColor}-300">
                                ${requirement.category}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 dark:text-slate-400">${requirement.min_grade}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex gap-2">
                                <button onclick="editOLevelRequirement(${requirement.id})" class="text-orange-600 hover:text-orange-900 dark:text-orange-400 dark:hover:text-orange-300">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </button>
                                <button onclick="deleteOLevelRequirement(${requirement.id})" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 ml-2">
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

        function updatePagination(meta) {
            if (!meta) return;
            
            currentPage = meta.current_page;
            lastPage = meta.last_page;
            
            const pagination = document.getElementById('pagination');
            if (lastPage <= 1) {
                pagination.innerHTML = '';
                return;
            }
            
            let paginationHTML = '<div class="flex items-center justify-between">';
            paginationHTML += `<div class="text-sm text-slate-600 dark:text-slate-400">Showing ${meta.per_page * (currentPage - 1) + 1} to ${Math.min(meta.per_page * currentPage, meta.total)} of ${meta.total} results</div>`;
            paginationHTML += '<div class="flex gap-2">';
            
            if (currentPage > 1) {
                paginationHTML += `<button onclick="changePage(${currentPage - 1})" class="px-3 py-2 text-sm bg-white dark:bg-slate-700 border border-slate-300 dark:border-slate-600 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-600">Previous</button>`;
            }
            
            if (currentPage < lastPage) {
                paginationHTML += `<button onclick="changePage(${currentPage + 1})" class="px-3 py-2 text-sm bg-white dark:bg-slate-700 border border-slate-300 dark:border-slate-600 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-600">Next</button>`;
            }
            
            paginationHTML += '</div></div>';
            pagination.innerHTML = paginationHTML;
        }

        function changePage(page) {
            currentPage = page;
            loadOLevelRequirements();
        }

        function updateBulkActions() {
            const selectedCheckboxes = document.querySelectorAll('input[name="selected_olevel[]"]:checked');
            const bulkActions = document.getElementById('bulkActions');
            const selectedCount = document.getElementById('selectedCount');
            
            if (selectedCheckboxes.length > 0) {
                bulkActions.style.display = 'block';
                selectedCount.textContent = selectedCheckboxes.length;
            } else {
                bulkActions.style.display = 'none';
            }
        }

        function openAddOLevelModal() {
            console.log('Opening add O Level modal...');
            const modal = document.getElementById('addOLevelModal');
            if (modal) {
                modal.classList.remove('hidden');
                console.log('Modal should be visible now');
                loadAvailableOLevelSubjects();
            } else {
                console.error('Modal element not found!');
            }
        }

        function closeAddOLevelModal() {
            document.getElementById('addOLevelModal').classList.add('hidden');
            document.getElementById('addOLevelForm').reset();
            document.getElementById('oLevelQualification').innerHTML = '<option value="">Select Qualification</option>';
        }

        async function submitAddOLevel(event) {
            event.preventDefault();
            
            try {
                const formData = new FormData(event.target);
                const data = {
                    o_level_subject_id: formData.get('subject_name'),
                    category: formData.get('category'),
                    min_grade: formData.get('min_grade')
                };
                
                const url = `/staff/program/api/school/${school}/programmes/${programmeId}/olevel-requirements`;
                await apiRequest(url, {
                    method: 'POST',
                    body: JSON.stringify(data)
                });
                
                showSuccess('O Level entry requirement added successfully!');
                closeAddOLevelModal();
                loadOLevelRequirements();
                loadStatistics();
                
            } catch (error) {
                console.error('Error adding O Level requirement:', error);
                showError('Failed to add O Level requirement: ' + error.message);
            }
        }

        function editOLevelRequirement(id) {
            showError('Edit functionality will be implemented in a future update.');
        }

        async function deleteOLevelRequirement(id) {
            if (confirm('Are you sure you want to delete this O Level entry requirement?')) {
                try {
                    const url = `/staff/program/api/school/${school}/programmes/${programmeId}/olevel-requirements/${id}`;
                    await apiRequest(url, { method: 'DELETE' });
                    
                    showSuccess('O Level requirement deleted successfully!');
                    loadOLevelRequirements();
                    loadStatistics();
                    
                } catch (error) {
                    console.error('Error deleting O Level requirement:', error);
                    showError('Failed to delete O Level requirement: ' + error.message);
                }
            }
        }

        async function bulkDelete() {
            const selected = document.querySelectorAll('input[name="selected_olevel[]"]:checked');
            if (selected.length > 0 && confirm(`Are you sure you want to delete ${selected.length} O Level entry requirements?`)) {
                try {
                    const ids = Array.from(selected).map(checkbox => checkbox.value);
                    const url = `/staff/program/api/school/${school}/programmes/${programmeId}/olevel-requirements/bulk-delete`;
                    
                    await apiRequest(url, {
                        method: 'DELETE',
                        body: JSON.stringify({ requirement_ids: ids })
                    });
                    
                    showSuccess(`${selected.length} O Level requirements deleted successfully!`);
                    loadOLevelRequirements();
                    loadStatistics();
                    document.getElementById('selectAll').checked = false;
                    updateBulkActions();
                    
                } catch (error) {
                    console.error('Error bulk deleting O Level requirements:', error);
                    showError('Failed to bulk delete O Level requirements: ' + error.message);
                }
            }
        }
    </script>
</x-layouts.app>