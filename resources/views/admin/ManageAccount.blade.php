<x-layouts.app title="Manage Account">
    <div class="space-y-6">
        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="bg-green-100 dark:bg-green-900/30 border border-green-400 dark:border-green-700 text-green-800 dark:text-green-300 px-4 py-3 rounded-lg shadow-sm" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 dark:bg-red-900/30 border border-red-400 dark:border-red-700 text-red-800 dark:text-red-300 px-4 py-3 rounded-lg shadow-sm" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100">MANAGE MANAGERS</h1>
                <p class="text-gray-600 dark:text-gray-400 mt-1">Create and manage staff accounts with role assignments</p>
            </div>
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                <!-- Search Bar -->
                <div class="relative w-full sm:w-64">
                    <input type="text" 
                           id="searchInput"
                           placeholder="Search managers..." 
                           class="w-full pl-4 pr-10 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                    <button class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:text-gray-500 dark:hover:text-gray-300 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </div>

                <!-- Create Manager Button -->
                <button onclick="openCreateModal()" 
                        class="border-2 border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white px-4 py-2 rounded-lg font-medium transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <span>CREATE MANAGER</span>
                </button>
            </div>
        </div>

        <!-- Filters and Stats -->
        <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
            <div class="flex items-center space-x-4 flex-wrap">
                <span class="text-sm text-gray-600 dark:text-gray-400">Filter by Status:</span>
                <select id="statusFilter" class="border border-gray-300 dark:border-gray-600 rounded-md px-3 py-1 text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    <option value="all">All Status</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
                <select id="roleFilter" class="border border-gray-300 dark:border-gray-600 rounded-md px-3 py-1 text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    <option value="all">All Roles</option>
                    <option value="program">Program Manager</option>
                    <option value="admission">Admission Manager</option>
                    <option value="both">Both Roles</option>
                </select>
            </div>
            <div>
                <span class="text-sm text-gray-600 dark:text-gray-400">Total Managers: <strong class="text-gray-900 dark:text-gray-100">{{ $managers->count() }}</strong></span>
            </div>
        </div>

        <!-- Managers Table -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700" id="managersTable">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Manager Info</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Role Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date Added</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($managers as $manager)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 manager-row transition-colors" 
                            data-name="{{ strtolower($manager->name) }}" 
                            data-email="{{ strtolower($manager->email) }}"
                            data-status="{{ $manager->status }}"
                            data-role="{{ $manager->manager_type }}">
                            <!-- Manager Info -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="h-10 w-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-semibold">
                                            {{ $manager->initials() }}
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $manager->name }}</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $manager->email }}</div>
                                    </div>
                                </div>
                            </td>

                            <!-- Role Type -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full 
                                    @if($manager->manager_type === 'program') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300
                                    @elseif($manager->manager_type === 'admission') bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300
                                    @elseif($manager->manager_type === 'both') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                                    @else bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-300 @endif">
                                    {{ $manager->manager_type_display ?? 'Manager' }}
                                </span>
                            </td>

                            <!-- Status -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-3 py-1 text-xs font-medium rounded-full {{ $manager->status_color }}">
                                    {{ ucfirst($manager->status) }}
                                </span>
                            </td>

                            <!-- Date Added -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                {{ $manager->created_at->format('M d, Y') }}
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-3">
                                    <!-- Toggle Status -->
                                    <button onclick="toggleStatus({{ $manager->id }}, '{{ $manager->name }}', '{{ $manager->status }}')" 
                                            class="text-{{ $manager->status === 'active' ? 'orange' : 'green' }}-600 hover:text-{{ $manager->status === 'active' ? 'orange' : 'green' }}-900 transition"
                                            title="{{ $manager->status === 'active' ? 'Deactivate' : 'Activate' }}">
                                        @if($manager->status === 'active')
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728"></path>
                                            </svg>
                                        @else
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        @endif
                                    </button>

                                    <!-- Edit Button -->
                                    <button onclick="openEditModal({{ $manager->id }}, '{{ $manager->name }}', '{{ $manager->email }}', '{{ $manager->manager_type }}', '{{ $manager->status }}')" 
                                            class="text-indigo-600 hover:text-indigo-900 transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </button>

                                    <!-- Delete Button -->
                                    <button onclick="openDeleteModal({{ $manager->id }}, '{{ $manager->name }}')" 
                                            class="text-red-600 hover:text-red-900 transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                                <div class="flex flex-col items-center">
                                    <svg class="w-12 h-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    <p class="text-lg font-medium">No managers found</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Click "CREATE MANAGER" to add the first one.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Create Manager Modal -->
    <div id="createModal" class="fixed inset-0 overflow-y-auto h-full w-full hidden z-50" style="background-color: rgba(0,0,0,0.6);">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-md">
                <!-- Header -->
                <div class="border-b border-gray-200 dark:border-gray-700 px-6 py-4">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Create New Manager</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Add a new manager to the system with role assignment</p>
                </div>
                
                <!-- Form -->
                <form action="{{ route('admin.create-manager') }}" method="POST" class="p-6 space-y-4">
                    @csrf
                    
                    <!-- Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Full Name</label>
                        <input type="text" name="name" required
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100"
                               placeholder="Enter full name">
                    </div>
                    
                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email Address</label>
                        <input type="email" name="email" required
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100"
                               placeholder="manager@example.com">
                    </div>

                    <!-- Manager Type -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Manager Role</label>
                        <select name="manager_type" required
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100">
                            <option value="">Select role type</option>
                            <option value="program">Program Manager</option>
                            <option value="admission">Admission Manager</option>
                            <option value="both">Program & Admission Manager</option>
                        </select>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
                        <select name="status" required
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    
                    <!-- Password -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Password</label>
                        <input type="password" name="password" required minlength="8"
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100"
                               placeholder="Minimum 8 characters">
                    </div>
                    
                    <!-- Confirm Password -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Confirm Password</label>
                        <input type="password" name="password_confirmation" required minlength="8"
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100"
                               placeholder="Repeat password">
                    </div>
                    
                    <!-- Buttons -->
                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" onclick="closeCreateModal()" 
                                class="px-4 py-2 text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 font-medium">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                            Create Manager
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Manager Modal -->
    <div id="editModal" class="fixed inset-0 overflow-y-auto h-full w-full hidden z-50" style="background-color: rgba(0,0,0,0.6);">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-md">
                <!-- Header -->
                <div class="border-b border-gray-200 dark:border-gray-700 px-6 py-4">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Edit Manager</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Update manager information and role</p>
                </div>
                
                <!-- Form -->
                <form id="editForm" method="POST" class="p-6 space-y-4">
                    @csrf
                    @method('PUT')
                    
                    <!-- Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Full Name</label>
                        <input type="text" name="name" id="edit_name" required
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100">
                    </div>
                    
                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email Address</label>
                        <input type="email" name="email" id="edit_email" required
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100">
                    </div>

                    <!-- Manager Type -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Manager Role</label>
                        <select name="manager_type" id="edit_manager_type" required
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100">
                            <option value="program">Program Manager</option>
                            <option value="admission">Admission Manager</option>
                            <option value="both">Program & Admission Manager</option>
                        </select>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
                        <select name="status" id="edit_status" required
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    
                    <!-- Buttons -->
                    <div class="flex justify-end space-x-3 pt-4">
                        <button type="button" onclick="closeEditModal()" 
                                class="px-4 py-2 text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 font-medium">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                            Update Manager
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 overflow-y-auto h-full w-full hidden z-50" style="background-color: rgba(0,0,0,0.6);">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-md">
                <!-- Header with Warning -->
                <div class="text-center p-6">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 dark:bg-red-900/30 mb-4">
                        <svg class="h-6 w-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">Delete Manager</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">
                        Are you sure you want to delete <strong id="deleteManagerName" class="text-gray-900 dark:text-gray-100"></strong>?
                    </p>
                    <p class="text-xs text-red-600 dark:text-red-400">This action cannot be undone.</p>
                </div>
                
                <!-- Buttons -->
                <div class="flex justify-center space-x-3 p-6 pt-0">
                    <button type="button" onclick="closeDeleteModal()" 
                            class="px-4 py-2 text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 font-medium">
                        Cancel
                    </button>
                    <form id="deleteForm" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="px-6 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition-colors">
                            Delete Manager
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Toggle Status Modal -->
    <div id="statusModal" class="fixed inset-0 overflow-y-auto h-full w-full hidden z-50" style="background-color: rgba(0,0,0,0.6);">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-md">
                <div class="text-center p-6">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full mb-4" id="statusIcon">
                        <!-- Icon will be set by JavaScript -->
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2" id="statusTitle"></h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400" id="statusMessage"></p>
                </div>
                
                <div class="flex justify-center space-x-3 p-6 pt-0">
                    <button type="button" onclick="closeStatusModal()" 
                            class="px-4 py-2 text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 font-medium">
                        Cancel
                    </button>
                    <form id="statusForm" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" id="statusButton"
                                class="px-6 py-2 rounded-lg font-medium transition-colors">
                            <!-- Button text will be set by JavaScript -->
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Enhanced Functionality -->
    <script>
        // Modal Management
        function openCreateModal() {
            document.getElementById('createModal').classList.remove('hidden');
        }

        function closeCreateModal() {
            document.getElementById('createModal').classList.add('hidden');
            document.querySelector('#createModal form').reset();
        }

        function openEditModal(id, name, email, managerType, status) {
            document.getElementById('editModal').classList.remove('hidden');
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_email').value = email;
            document.getElementById('edit_manager_type').value = managerType;
            document.getElementById('edit_status').value = status;
            document.getElementById('editForm').action = `/admin/update-manager/${id}`;
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        function openDeleteModal(id, name) {
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteManagerName').textContent = name;
            document.getElementById('deleteForm').action = `/admin/delete-manager/${id}`;
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        function toggleStatus(id, name, currentStatus) {
            const modal = document.getElementById('statusModal');
            const icon = document.getElementById('statusIcon');
            const title = document.getElementById('statusTitle');
            const message = document.getElementById('statusMessage');
            const button = document.getElementById('statusButton');
            const form = document.getElementById('statusForm');

            const newStatus = currentStatus === 'active' ? 'inactive' : 'active';
            const action = newStatus === 'active' ? 'activate' : 'deactivate';

            // Set modal content based on action
            if (newStatus === 'active') {
                icon.className = 'mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100 dark:bg-green-900/30 mb-4';
                icon.innerHTML = '<svg class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>';
                title.textContent = 'Activate Manager';
                message.textContent = `Are you sure you want to activate ${name}?`;
                button.className = 'px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-colors';
                button.textContent = 'Activate';
            } else {
                icon.className = 'mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-orange-100 dark:bg-orange-900/30 mb-4';
                icon.innerHTML = '<svg class="h-6 w-6 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728"></path></svg>';
                title.textContent = 'Deactivate Manager';
                message.textContent = `Are you sure you want to deactivate ${name}?`;
                button.className = 'px-6 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-lg font-medium transition-colors';
                button.textContent = 'Deactivate';
            }

            form.action = `/admin/toggle-manager-status/${id}`;
            modal.classList.remove('hidden');
        }

        function closeStatusModal() {
            document.getElementById('statusModal').classList.add('hidden');
        }

        // Search and Filter Functionality
        document.getElementById('searchInput').addEventListener('keyup', function() {
            filterTable();
        });

        document.getElementById('statusFilter').addEventListener('change', function() {
            filterTable();
        });

        document.getElementById('roleFilter').addEventListener('change', function() {
            filterTable();
        });

        function filterTable() {
            const searchFilter = document.getElementById('searchInput').value.toLowerCase();
            const statusFilter = document.getElementById('statusFilter').value;
            const roleFilter = document.getElementById('roleFilter').value;
            const rows = document.querySelectorAll('.manager-row');
            
            rows.forEach(row => {
                const name = row.getAttribute('data-name');
                const email = row.getAttribute('data-email');
                const status = row.getAttribute('data-status');
                const role = row.getAttribute('data-role');
                
                let showRow = true;
                
                // Search filter
                if (searchFilter && !(name.includes(searchFilter) || email.includes(searchFilter))) {
                    showRow = false;
                }
                
                // Status filter
                if (statusFilter !== 'all' && status !== statusFilter) {
                    showRow = false;
                }
                
                // Role filter
                if (roleFilter !== 'all' && role !== roleFilter) {
                    showRow = false;
                }
                
                row.style.display = showRow ? '' : 'none';
            });
        }

        // Close modals when clicking outside
        window.onclick = function(event) {
            const modals = ['createModal', 'editModal', 'deleteModal', 'statusModal'];
            modals.forEach(modalId => {
                const modal = document.getElementById(modalId);
                if (event.target === modal) {
                    modal.classList.add('hidden');
                }
            });
        }

        // Close modals with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeCreateModal();
                closeEditModal();
                closeDeleteModal();
                closeStatusModal();
            }
        });

        // Form validation
        document.querySelector('#createModal form').addEventListener('submit', function(e) {
            const password = this.querySelector('input[name="password"]').value;
            const confirmPassword = this.querySelector('input[name="password_confirmation"]').value;
            
            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Passwords do not match!');
                return false;
            }
        });
    </script>
</x-layouts.app>