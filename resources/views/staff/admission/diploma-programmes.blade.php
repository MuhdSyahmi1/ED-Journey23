<x-layouts.app title="Diploma Programmes">
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 dark:from-slate-900 dark:to-blue-950 transition-colors duration-300">
        <div class="p-6">
            <div class="max-w-7xl mx-auto space-y-6">
                <!-- Success/Error Messages -->
                @if(session('success'))
                    <div class="bg-green-50 dark:bg-green-900/20 border-2 border-green-200 dark:border-green-700 rounded-xl p-4">
                        <div class="flex items-center gap-3">
                            <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-green-800 dark:text-green-200 font-medium">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-50 dark:bg-red-900/20 border-2 border-red-200 dark:border-red-700 rounded-xl p-4">
                        <div class="flex items-center gap-3">
                            <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-red-800 dark:text-red-200 font-medium">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif

                <!-- Page Header -->
                <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden">
                    <div class="bg-gradient-to-r from-orange-400/90 to-red-500/90 text-white py-4 px-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h1 class="text-2xl font-bold">DIPLOMA PROGRAMMES</h1>
                                <p class="text-sm opacity-90 mt-1">Manage diploma programme requirements and configurations</p>
                            </div>
                            <a href="{{ route('staff.admission.programme-management') }}" 
                               class="px-4 py-2 bg-white/20 hover:bg-white/30 text-white rounded-lg text-sm font-medium transition-all duration-200 flex items-center gap-2 backdrop-blur-sm" 
                               wire:navigate>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Back to Programme Management
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Manage Diploma Programmes</h2>
                <button onclick="document.getElementById('addProgrammeModal').classList.remove('hidden')" 
                        class="px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-lg text-sm font-medium transition-colors duration-200 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add New Programme
                </button>
            </div>

            <!-- Search and Sort Controls -->
            <div class="bg-white/60 dark:bg-slate-800/60 backdrop-blur-sm rounded-2xl shadow-lg border border-slate-200/40 dark:border-slate-700/40 p-4 mb-6">
                <form method="GET" action="{{ route('staff.admission.diploma-programmes') }}" class="flex flex-col md:flex-row gap-4">
                    <!-- Search -->
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Search Programmes</label>
                        <div class="relative">
                            <input type="text" name="search" value="{{ request('search') }}" 
                                   placeholder="Search by programme name, school, or duration..." 
                                   class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                            <svg class="absolute left-3 top-2.5 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                    
                    <!-- School Filter -->
                    <div class="w-full md:w-64">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Filter by School</label>
                        <select name="school" 
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                            <option value="">All Schools</option>
                            @foreach(\App\Models\DiplomaProgramme::getSchoolOptions() as $school)
                                <option value="{{ $school }}" {{ request('school') == $school ? 'selected' : '' }}>{{ $school }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Sort By -->
                    <div class="w-full md:w-48">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Sort By</label>
                        <select name="sort_by" 
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                            <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>Programme Name</option>
                            <option value="id" {{ request('sort_by') == 'id' ? 'selected' : '' }}>ID Number</option>
                            <option value="duration" {{ request('sort_by') == 'duration' ? 'selected' : '' }}>Duration</option>
                            <option value="school" {{ request('sort_by') == 'school' ? 'selected' : '' }}>School</option>
                            <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Date Added</option>
                        </select>
                    </div>
                    
                    <!-- Sort Order -->
                    <div class="w-full md:w-36">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Order</label>
                        <select name="sort_order" 
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                            <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>
                                {{ request('sort_by') == 'created_at' ? 'Oldest First' : 'A to Z' }}
                            </option>
                            <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>
                                {{ request('sort_by') == 'created_at' ? 'Latest First' : 'Z to A' }}
                            </option>
                        </select>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex gap-2 items-end">
                        <button type="submit" 
                                class="px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-lg text-sm font-medium transition-colors duration-200 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Search
                        </button>
                        <a href="{{ route('staff.admission.diploma-programmes') }}" 
                           class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg text-sm font-medium transition-colors duration-200 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <!-- Results Summary -->
            <div class="mb-4 flex justify-between items-center">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    @if(request('search'))
                        Showing {{ $programmes->count() }} results for "<span class="font-medium">{{ request('search') }}</span>"
                    @else
                        Showing {{ $programmes->count() }} programmes total
                    @endif
                </p>
                @if(request('search') || request('school') || request('sort_by') != 'name' || request('sort_order') == 'desc')
                    <span class="text-xs px-2 py-1 bg-orange-100 text-orange-800 dark:bg-orange-900/30 dark:text-orange-300 rounded-full">
                        Filtered/Sorted
                    </span>
                @endif
            </div>

            <!-- Programmes Table -->
            <div class="overflow-x-auto">
                <table class="w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700/50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Programme ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Programme Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Duration (Years)</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">School</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($programmes as $programme)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ $programme->id }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">{{ $programme->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ $programme->duration }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="px-2 py-1 text-xs font-medium rounded-full 
                                        @switch($programme->school)
                                            @case('School of Business')
                                                bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300
                                                @break
                                            @case('School of Health Sciences')
                                                bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300
                                                @break
                                            @case('School of ICT')
                                                bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300
                                                @break
                                            @case('School of Science & Engineering')
                                                bg-orange-100 text-orange-800 dark:bg-orange-900/30 dark:text-orange-300
                                                @break
                                            @case('School of Petrochemical')
                                                bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300
                                                @break
                                            @default
                                                bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-300
                                        @endswitch">
                                        {{ $programme->school }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <div class="flex gap-2">
                                        <button onclick="editProgramme({{ $programme->id }}, '{{ $programme->name }}', '{{ $programme->duration }}', '{{ $programme->school }}')" 
                                                class="text-orange-600 hover:text-orange-800 dark:text-orange-400 dark:hover:text-orange-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </button>
                                        <form method="POST" action="{{ route('staff.admission.diploma-programmes.destroy', $programme->id) }}" 
                                              onsubmit="return confirm('Are you sure you want to delete this programme?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path>
                                    </svg>
                                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">No Diploma Programmes</h3>
                                    <p class="text-gray-600 dark:text-gray-400">Click "Add New Programme" to get started.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Programme Modal -->
    <div id="addProgrammeModal" class="hidden fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center z-50">
        <div class="bg-white/95 dark:bg-slate-800/95 backdrop-blur-sm rounded-2xl shadow-2xl border border-slate-200/60 dark:border-slate-700/60 p-6 w-full max-w-md mx-4">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Add New Programme</h3>
                <button onclick="document.getElementById('addProgrammeModal').classList.add('hidden')" 
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form method="POST" action="{{ route('staff.admission.diploma-programmes.store') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Programme Name</label>
                    <input type="text" name="name" required
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                           placeholder="Enter programme name">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Duration (Years)</label>
                    <select name="duration" required
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        <option value="">Select Duration</option>
                        @foreach(\App\Models\DiplomaProgramme::getDurationOptions() as $duration)
                            <option value="{{ $duration }}">{{ $duration }}</option>
                        @endforeach
                    </select>
                    @error('duration')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">School</label>
                    <select name="school" required
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        <option value="">Select School</option>
                        @foreach(\App\Models\DiplomaProgramme::getSchoolOptions() as $school)
                            <option value="{{ $school }}">{{ $school }}</option>
                        @endforeach
                    </select>
                    @error('school')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex gap-3 pt-4">
                    <button type="submit" class="flex-1 px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg text-sm font-medium transition-colors duration-200">
                        Add Programme
                    </button>
                    <button type="button" onclick="document.getElementById('addProgrammeModal').classList.add('hidden')" 
                            class="flex-1 px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg text-sm font-medium transition-colors duration-200">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Programme Modal -->
    <div id="editProgrammeModal" class="hidden fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm flex items-center justify-center z-50">
        <div class="bg-white/95 dark:bg-slate-800/95 backdrop-blur-sm rounded-2xl shadow-2xl border border-slate-200/60 dark:border-slate-700/60 p-6 w-full max-w-md mx-4">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Edit Programme</h3>
                <button onclick="document.getElementById('editProgrammeModal').classList.add('hidden')" 
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <form id="editForm" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Programme Name</label>
                    <input type="text" id="editName" name="name" required
                           class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Duration (Years)</label>
                    <select id="editDuration" name="duration" required
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        @foreach(\App\Models\DiplomaProgramme::getDurationOptions() as $duration)
                            <option value="{{ $duration }}">{{ $duration }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">School</label>
                    <select id="editSchool" name="school" required
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        @foreach(\App\Models\DiplomaProgramme::getSchoolOptions() as $school)
                            <option value="{{ $school }}">{{ $school }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex gap-3 pt-4">
                    <button type="submit" class="flex-1 px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-lg text-sm font-medium transition-colors duration-200">
                        Update Programme
                    </button>
                    <button type="button" onclick="document.getElementById('editProgrammeModal').classList.add('hidden')" 
                            class="flex-1 px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg text-sm font-medium transition-colors duration-200">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function editProgramme(id, name, duration, school) {
            document.getElementById('editName').value = name;
            document.getElementById('editDuration').value = duration;
            document.getElementById('editSchool').value = school;
            document.getElementById('editForm').action = `/staff/admission/diploma-programmes/${id}`;
            document.getElementById('editProgrammeModal').classList.remove('hidden');
        }

        // Auto-submit form when sort options change
        document.addEventListener('DOMContentLoaded', function() {
            const sortBy = document.querySelector('select[name="sort_by"]');
            const sortOrder = document.querySelector('select[name="sort_order"]');
            const schoolFilter = document.querySelector('select[name="school"]');
            const searchInput = document.querySelector('input[name="search"]');
            const form = document.querySelector('form[method="GET"]');

            // Auto-submit when sort options change
            if (sortBy) {
                sortBy.addEventListener('change', function() {
                    updateSortOrderText();
                    form.submit();
                });
            }

            if (sortOrder) {
                sortOrder.addEventListener('change', function() {
                    form.submit();
                });
            }

            if (schoolFilter) {
                schoolFilter.addEventListener('change', function() {
                    form.submit();
                });
            }

            // Real-time search with debouncing
            if (searchInput) {
                let searchTimeout;
                searchInput.addEventListener('input', function() {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(() => {
                        form.submit();
                    }, 500); // Wait 500ms after user stops typing
                });

                // Clear search timeout if user submits manually
                form.addEventListener('submit', function() {
                    clearTimeout(searchTimeout);
                });
            }

            function updateSortOrderText() {
                const sortByValue = sortBy.value;
                const ascOption = sortOrder.querySelector('option[value="asc"]');
                const descOption = sortOrder.querySelector('option[value="desc"]');

                if (sortByValue === 'created_at') {
                    ascOption.textContent = 'Oldest First';
                    descOption.textContent = 'Latest First';
                } else if (sortByValue === 'id') {
                    ascOption.textContent = 'Lowest ID';
                    descOption.textContent = 'Highest ID';
                } else {
                    ascOption.textContent = 'A to Z';
                    descOption.textContent = 'Z to A';
                }
            }

            // Initialize sort order text
            updateSortOrderText();
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl/Cmd + K to focus search
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                document.querySelector('input[name="search"]').focus();
            }
            
            // Escape to clear search
            if (e.key === 'Escape') {
                const searchInput = document.querySelector('input[name="search"]');
                if (searchInput === document.activeElement) {
                    searchInput.value = '';
                    searchInput.form.submit();
                }
            }
        });
    </script>
</x-layouts.app>