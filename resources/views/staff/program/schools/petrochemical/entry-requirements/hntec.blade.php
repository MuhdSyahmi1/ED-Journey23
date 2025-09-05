@php
    $schoolName = 'School of Petrochemical';
    $schoolSlug = 'petrochemical';
    // This would normally come from the controller
    $programmeId = request()->route('programmeId') ?? 1;
    $programmeName = 'Bachelor of Business Administration'; // This would come from database
@endphp

<x-layouts.app>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('staff.program.school.programmes', 'petrochemical') }}" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $programmeName }} - HNTec Entry Requirements
            </h2>
        </div>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 dark:from-slate-900 dark:to-blue-950 transition-colors duration-300">
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
                    <div class="bg-gradient-to-r from-purple-400/90 to-purple-600/90 text-white p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h1 class="text-3xl font-bold">HNTec Entry Requirements</h1>
                                <p class="text-purple-100 mt-2">{{ $programmeName }} - {{ $schoolName }}</p>
                            </div>
                            <button onclick="openAddHntecModal()" class="bg-white/20 hover:bg-white/30 text-white px-6 py-3 rounded-lg transition-colors flex items-center gap-2">
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
                            <div class="p-3 rounded-full bg-purple-100 dark:bg-purple-900/20">
                                <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-2xl font-bold text-slate-900 dark:text-slate-100" id="totalHntec">5</p>
                                <p class="text-sm text-slate-600 dark:text-slate-400">Total Requirements</p>
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
                                <p class="text-2xl font-bold text-slate-900 dark:text-slate-100">3</p>
                                <p class="text-sm text-slate-600 dark:text-slate-400">Relevant Programmes</p>
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
                                <p class="text-2xl font-bold text-slate-900 dark:text-slate-100">2</p>
                                <p class="text-sm text-slate-600 dark:text-slate-400">Not Relevant</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-xl shadow-lg border border-slate-200/60 dark:border-slate-700/60 p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900/20">
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-2xl font-bold text-slate-900 dark:text-slate-100">3.0</p>
                                <p class="text-sm text-slate-600 dark:text-slate-400">Average Min CGPA</p>
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
                                       placeholder="Search HNTec programmes..."
                                       class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <!-- Category Filter -->
                            <div>
                                <label for="category" class="block text-sm font-medium text-slate-700 dark:text-slate-200 mb-1">Category</label>
                                <select id="category" 
                                        name="category" 
                                        class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">All Categories</option>
                                    <option value="Relevant" {{ request('category') == 'Relevant' ? 'selected' : '' }}>Relevant</option>
                                    <option value="Not Relevant" {{ request('category') == 'Not Relevant' ? 'selected' : '' }}>Not Relevant</option>
                                </select>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex items-end gap-2">
                                <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg transition-colors">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                    Filter
                                </button>
                                <a href="{{ route('staff.program.school.programmes.hntec', ['school' => 'business', 'programmeId' => $programmeId]) }}" class="bg-slate-500 hover:bg-slate-600 text-white px-4 py-2 rounded-lg transition-colors">
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

                <!-- HNTec Requirements Table -->
                <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-700">
                        <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100">HNTec Entry Requirements</h3>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-slate-50 dark:bg-slate-700/50">
                                <tr>
                                    <th class="px-6 py-4 text-left">
                                        <input type="checkbox" id="selectAll" class="rounded border-slate-300 text-purple-600 focus:ring-purple-500">
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">HNTec Programme Name</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Category</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Min. CGPA</th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200 dark:divide-slate-700" id="hntecTableBody">
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

    <!-- Add HNTec Requirement Modal -->
    <div id="addHntecModal" class="fixed inset-0 z-[9999] hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-75" onclick="closeAddHntecModal()"></div>
            <div class="relative inline-block w-full max-w-md p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white dark:bg-slate-800 shadow-2xl rounded-2xl border border-slate-200 dark:border-slate-700">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Add HNTec Entry Requirement</h3>
                    <button onclick="closeAddHntecModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                
                <form id="addHntecForm" onsubmit="submitAddHntec(event)">
                    <div class="space-y-4">
                        <div>
                            <label for="hntecProgrammeName" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">HNTec Programme Name</label>
                            <select id="hntecProgrammeName" name="hntec_programme_name" required class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-slate-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                <option value="">Select HNTec Programme</option>
                                <!-- Will be populated by JavaScript -->
                            </select>
                        </div>
                        
                        <div>
                            <label for="hntecCategory" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Category</label>
                            <select id="hntecCategory" name="category" required class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-slate-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                <option value="">Select Category</option>
                                <option value="Relevant">Relevant</option>
                                <option value="Not Relevant">Not Relevant</option>
                            </select>
                        </div>

                        <div>
                            <label for="minCgpa" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Minimum CGPA</label>
                            <select id="minCgpa" name="min_cgpa" required class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-slate-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                <option value="">Select Minimum CGPA</option>
                                <option value="1.0">1.0</option>
                                <option value="1.1">1.1</option>
                                <option value="1.2">1.2</option>
                                <option value="1.3">1.3</option>
                                <option value="1.4">1.4</option>
                                <option value="1.5">1.5</option>
                                <option value="1.6">1.6</option>
                                <option value="1.7">1.7</option>
                                <option value="1.8">1.8</option>
                                <option value="1.9">1.9</option>
                                <option value="2.0">2.0</option>
                                <option value="2.1">2.1</option>
                                <option value="2.2">2.2</option>
                                <option value="2.3">2.3</option>
                                <option value="2.4">2.4</option>
                                <option value="2.5">2.5</option>
                                <option value="2.6">2.6</option>
                                <option value="2.7">2.7</option>
                                <option value="2.8">2.8</option>
                                <option value="2.9">2.9</option>
                                <option value="3.0">3.0</option>
                                <option value="3.1">3.1</option>
                                <option value="3.2">3.2</option>
                                <option value="3.3">3.3</option>
                                <option value="3.4">3.4</option>
                                <option value="3.5">3.5</option>
                                <option value="3.6">3.6</option>
                                <option value="3.7">3.7</option>
                                <option value="3.8">3.8</option>
                                <option value="3.9">3.9</option>
                                <option value="4.0">4.0</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="flex justify-end gap-3 mt-6">
                        <button type="button" onclick="closeAddHntecModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 dark:bg-gray-600 dark:text-gray-300 dark:hover:bg-gray-500">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700">
                            Add Requirement
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit HNTec Requirement Modal -->
    <div id="editHntecModal" class="fixed inset-0 z-[9999] hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-75" onclick="closeEditHntecModal()"></div>
            <div class="relative inline-block w-full max-w-md p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white dark:bg-slate-800 shadow-2xl rounded-2xl border border-slate-200 dark:border-slate-700">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Edit HNTec Entry Requirement</h3>
                    <button onclick="closeEditHntecModal()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                
                <form id="editHntecForm" onsubmit="submitEditHntecRequirement(event)">
                    <input type="hidden" id="editRequirementId" name="requirement_id">
                    <div class="space-y-4">
                        <div>
                            <label for="editHntecProgrammeName" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">HNTec Programme</label>
                            <input type="text" id="editHntecProgrammeName" readonly class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-100 dark:bg-slate-600 text-gray-900 dark:text-gray-100 cursor-not-allowed">
                        </div>
                        
                        <div>
                            <label for="editHntecCategory" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Category</label>
                            <select id="editHntecCategory" name="category" required class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-slate-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                <option value="">Select Category</option>
                                <option value="Relevant">Relevant</option>
                                <option value="Not Relevant">Not Relevant</option>
                            </select>
                        </div>

                        <div>
                            <label for="editMinCgpa" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Minimum CGPA</label>
                            <select id="editMinCgpa" name="min_cgpa" required class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-slate-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                <option value="">Select Minimum CGPA</option>
                                <option value="1.0">1.0</option>
                                <option value="1.1">1.1</option>
                                <option value="1.2">1.2</option>
                                <option value="1.3">1.3</option>
                                <option value="1.4">1.4</option>
                                <option value="1.5">1.5</option>
                                <option value="1.6">1.6</option>
                                <option value="1.7">1.7</option>
                                <option value="1.8">1.8</option>
                                <option value="1.9">1.9</option>
                                <option value="2.0">2.0</option>
                                <option value="2.1">2.1</option>
                                <option value="2.2">2.2</option>
                                <option value="2.3">2.3</option>
                                <option value="2.4">2.4</option>
                                <option value="2.5">2.5</option>
                                <option value="2.6">2.6</option>
                                <option value="2.7">2.7</option>
                                <option value="2.8">2.8</option>
                                <option value="2.9">2.9</option>
                                <option value="3.0">3.0</option>
                                <option value="3.1">3.1</option>
                                <option value="3.2">3.2</option>
                                <option value="3.3">3.3</option>
                                <option value="3.4">3.4</option>
                                <option value="3.5">3.5</option>
                                <option value="3.6">3.6</option>
                                <option value="3.7">3.7</option>
                                <option value="3.8">3.8</option>
                                <option value="3.9">3.9</option>
                                <option value="4.0">4.0</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="flex justify-end gap-3 mt-6">
                        <button type="button" onclick="closeEditHntecModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 dark:bg-gray-600 dark:text-gray-300 dark:hover:bg-gray-500">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700">
                            Update Requirement
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const school = '{{ $schoolSlug }}';
        const programmeId = {{ $programmeId }};
        let hntecRequirements = [];
        let availableHntecProgrammes = [];
        let currentPage = 1;
        let lastPage = 1;
        
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

        document.addEventListener('DOMContentLoaded', function() {
            loadHntecRequirements();
            loadAvailableHntecProgrammes();
            loadStatistics();
            setupEventListeners();
        });

        function setupEventListeners() {
            // Select all checkbox
            document.getElementById('selectAll').addEventListener('change', function() {
                const checkboxes = document.querySelectorAll('input[name="selected_hntec[]"]');
                checkboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
                updateBulkActions();
            });

            // Search functionality
            const searchInput = document.getElementById('search');
            const categorySelect = document.getElementById('category');
            
            if (searchInput) {
                searchInput.addEventListener('input', debounce(() => {
                    currentPage = 1;
                    loadHntecRequirements();
                }, 300));
            }

            if (categorySelect) {
                categorySelect.addEventListener('change', () => {
                    currentPage = 1;
                    loadHntecRequirements();
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

        async function loadHntecRequirements() {
            try {
                const searchTerm = document.getElementById('search').value;
                const category = document.getElementById('category').value;
                
                const params = new URLSearchParams();
                if (searchTerm) params.append('search', searchTerm);
                if (category) params.append('category', category);
                params.append('page', currentPage);
                
                const url = `/staff/program/api/school/${school}/programmes/${programmeId}/hntec-requirements?${params}`;
                const response = await apiRequest(url);
                
                hntecRequirements = response.data || [];
                
                updateHntecRequirementsTable();
                updatePagination(response.meta);
                
            } catch (error) {
                console.error('Error loading HNTec requirements:', error);
                showError('Failed to load HNTec requirements: ' + error.message);
            }
        }

        async function loadAvailableHntecProgrammes() {
            try {
                const url = `/staff/program/api/school/${school}/programmes/${programmeId}/available-hntec-programmes`;
                const response = await apiRequest(url);
                
                availableHntecProgrammes = response.data || [];
                updateAvailableProgrammesDropdown();
                
            } catch (error) {
                console.error('Error loading available HNTec programmes:', error);
                showError('Failed to load available HNTec programmes: ' + error.message);
            }
        }

        async function loadStatistics() {
            try {
                const url = `/staff/program/api/school/${school}/programmes/${programmeId}/hntec-statistics`;
                const response = await apiRequest(url);
                
                if (response.success && response.data) {
                    document.getElementById('totalHntec').textContent = response.data.total_requirements;
                    document.querySelector('[id="totalHntec"]').closest('.bg-white\\/80').nextElementSibling.querySelector('.text-2xl').textContent = response.data.relevant_programmes;
                    document.querySelector('[id="totalHntec"]').closest('.bg-white\\/80').nextElementSibling.nextElementSibling.querySelector('.text-2xl').textContent = response.data.not_relevant_programmes;
                    document.querySelector('[id="totalHntec"]').closest('.bg-white\\/80').nextElementSibling.nextElementSibling.nextElementSibling.querySelector('.text-2xl').textContent = response.data.average_min_cgpa || '0.0';
                }
                
            } catch (error) {
                console.error('Error loading statistics:', error);
            }
        }

        function updateAvailableProgrammesDropdown() {
            const select = document.getElementById('hntecProgrammeName');
            // Clear existing options except the first one
            while (select.children.length > 1) {
                select.removeChild(select.lastChild);
            }
            
            availableHntecProgrammes.forEach(programme => {
                const option = document.createElement('option');
                option.value = programme.id;
                option.textContent = programme.name;
                select.appendChild(option);
            });
        }

        function updateHntecRequirementsTable() {
            const tbody = document.getElementById('hntecTableBody');
            tbody.innerHTML = '';

            if (hntecRequirements.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-slate-500 dark:text-slate-400">
                            <svg class="w-12 h-12 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <p class="text-lg font-medium">No HNTec requirements found</p>
                            <p class="mt-1">Add some HNTec entry requirements to get started.</p>
                        </td>
                    </tr>
                `;
                return;
            }

            hntecRequirements.forEach(requirement => {
                const categoryColor = requirement.category === 'Relevant' ? 'green' : 'orange';
                const programmeName = requirement.hntec_programme?.name || 'Unknown Programme';
                
                const row = `
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input type="checkbox" name="selected_hntec[]" value="${requirement.id}" class="rounded border-slate-300 text-purple-600 focus:ring-purple-500" onchange="updateBulkActions()">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900 dark:text-slate-100">${programmeName}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-${categoryColor}-100 text-${categoryColor}-800 dark:bg-${categoryColor}-900/20 dark:text-${categoryColor}-300">
                                ${requirement.category}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 dark:text-slate-400">${requirement.min_cgpa}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex gap-2">
                                <button onclick="editHntecRequirement(${requirement.id})" class="text-purple-600 hover:text-purple-900 dark:text-purple-400 dark:hover:text-purple-300">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </button>
                                <button onclick="deleteHntecRequirement(${requirement.id})" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 ml-2">
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
            loadHntecRequirements();
        }

        function updateBulkActions() {
            const selectedCheckboxes = document.querySelectorAll('input[name="selected_hntec[]"]:checked');
            const bulkActions = document.getElementById('bulkActions');
            const selectedCount = document.getElementById('selectedCount');
            
            if (selectedCheckboxes.length > 0) {
                bulkActions.style.display = 'block';
                selectedCount.textContent = selectedCheckboxes.length;
            } else {
                bulkActions.style.display = 'none';
            }
        }

        function openAddHntecModal() {
            console.log('Opening add HNTec modal...');
            const modal = document.getElementById('addHntecModal');
            if (modal) {
                modal.classList.remove('hidden');
                console.log('Modal should be visible now');
                loadAvailableHntecProgrammes();
            } else {
                console.error('Modal element not found!');
            }
        }

        function closeAddHntecModal() {
            document.getElementById('addHntecModal').classList.add('hidden');
            document.getElementById('addHntecForm').reset();
        }

        async function submitAddHntec(event) {
            event.preventDefault();
            
            try {
                const formData = new FormData(event.target);
                const data = {
                    hntec_programme_id: formData.get('hntec_programme_name'),
                    category: formData.get('category'),
                    min_cgpa: formData.get('min_cgpa')
                };
                
                const url = `/staff/program/api/school/${school}/programmes/${programmeId}/hntec-requirements`;
                await apiRequest(url, {
                    method: 'POST',
                    body: JSON.stringify(data)
                });
                
                showSuccess('HNTec entry requirement added successfully!');
                closeAddHntecModal();
                loadHntecRequirements();
                loadStatistics();
                
            } catch (error) {
                console.error('Error adding HNTec requirement:', error);
                showError('Failed to add HNTec requirement: ' + error.message);
            }
        }

        function editHntecRequirement(id) {
            const requirement = hntecRequirements.find(req => req.id === id);
            if (!requirement) {
                showError('HNTec requirement not found');
                return;
            }

            // Populate the edit form
            document.getElementById('editRequirementId').value = requirement.id;
            document.getElementById('editHntecProgrammeName').value = requirement.hntec_programme?.name || 'Unknown Programme';
            document.getElementById('editHntecCategory').value = requirement.category;
            document.getElementById('editMinCgpa').value = requirement.min_cgpa;

            // Show the modal
            document.getElementById('editHntecModal').classList.remove('hidden');
        }

        function closeEditHntecModal() {
            document.getElementById('editHntecModal').classList.add('hidden');
            document.getElementById('editHntecForm').reset();
        }

        async function submitEditHntecRequirement(event) {
            event.preventDefault();
            
            const form = document.getElementById('editHntecForm');
            const formData = new FormData(form);
            const requirementId = formData.get('requirement_id');
            const data = {
                category: formData.get('category'),
                min_cgpa: formData.get('min_cgpa')
            };

            try {
                const url = `/staff/program/api/school/${school}/programmes/${programmeId}/hntec-requirements/${requirementId}`;
                await apiRequest(url, {
                    method: 'PUT',
                    body: JSON.stringify(data)
                });

                showSuccess('HNTec requirement updated successfully!');
                closeEditHntecModal();
                loadHntecRequirements(); // Refresh the table
                loadStatistics(); // Update statistics
                
            } catch (error) {
                showError('Failed to update HNTec requirement: ' + error.message);
            }
        }

        async function deleteHntecRequirement(id) {
            if (confirm('Are you sure you want to delete this HNTec entry requirement?')) {
                try {
                    const url = `/staff/program/api/school/${school}/programmes/${programmeId}/hntec-requirements/${id}`;
                    await apiRequest(url, { method: 'DELETE' });
                    
                    showSuccess('HNTec requirement deleted successfully!');
                    loadHntecRequirements();
                    loadStatistics();
                    
                } catch (error) {
                    console.error('Error deleting HNTec requirement:', error);
                    showError('Failed to delete HNTec requirement: ' + error.message);
                }
            }
        }

        async function bulkDelete() {
            const selected = document.querySelectorAll('input[name="selected_hntec[]"]:checked');
            if (selected.length > 0 && confirm(`Are you sure you want to delete ${selected.length} HNTec entry requirements?`)) {
                try {
                    const ids = Array.from(selected).map(checkbox => checkbox.value);
                    const url = `/staff/program/api/school/${school}/programmes/${programmeId}/hntec-requirements/bulk-delete`;
                    
                    await apiRequest(url, {
                        method: 'DELETE',
                        body: JSON.stringify({ requirement_ids: ids })
                    });
                    
                    showSuccess(`${selected.length} HNTec requirements deleted successfully!`);
                    loadHntecRequirements();
                    loadStatistics();
                    document.getElementById('selectAll').checked = false;
                    updateBulkActions();
                    
                } catch (error) {
                    console.error('Error bulk deleting HNTec requirements:', error);
                    showError('Failed to bulk delete HNTec requirements: ' + error.message);
                }
            }
        }
    </script>
</x-layouts.app>