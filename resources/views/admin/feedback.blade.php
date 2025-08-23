<x-layouts.app title="Admin Feedback Management">
    <div class="space-y-6">
        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100">FEEDBACK MANAGEMENT</h1>
                <p class="text-gray-600 dark:text-gray-400">Review and respond to user feedback</p>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Feedback -->
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold mb-1">Total Feedback</h3>
                        <p class="text-3xl font-bold">{{ $stats['total'] }}</p>
                    </div>
                    <div class="p-3 bg-blue-400 bg-opacity-50 rounded-lg">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Pending Feedback -->
            <div class="bg-gradient-to-r from-yellow-500 to-orange-500 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold mb-1">Pending</h3>
                        <p class="text-3xl font-bold">{{ $stats['pending'] }}</p>
                        <p class="text-yellow-100 text-sm">Awaiting Response</p>
                    </div>
                    <div class="p-3 bg-yellow-400 bg-opacity-50 rounded-lg">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- In Progress -->
            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold mb-1">In Progress</h3>
                        <p class="text-3xl font-bold">{{ $stats['in_progress'] }}</p>
                        <p class="text-blue-100 text-sm">Being Handled</p>
                    </div>
                    <div class="p-3 bg-blue-400 bg-opacity-50 rounded-lg">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Solved -->
            <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold mb-1">Solved</h3>
                        <p class="text-3xl font-bold">{{ $stats['solved'] }}</p>
                        <p class="text-green-100 text-sm">Completed</p>
                    </div>
                    <div class="p-3 bg-green-400 bg-opacity-50 rounded-lg">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters and Search -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
            <div class="flex flex-wrap gap-4 items-center justify-between">
                <div class="flex flex-wrap gap-4 items-center">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status Filter</label>
                        <select id="statusFilter" class="border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="all">All Status</option>
                            <option value="pending">Pending</option>
                            <option value="in-progress">In Progress</option>
                            <option value="solved">Solved</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Priority Filter</label>
                        <select id="priorityFilter" class="border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="all">All Priority</option>
                            <option value="high">High Priority</option>
                            <option value="medium">Medium Priority</option>
                            <option value="low">Low Priority</option>
                        </select>
                    </div>
                </div>

                <div class="relative">
                    <input type="text" 
                           id="searchInput"
                           placeholder="Search feedback..." 
                           class="w-64 pl-4 pr-10 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <button class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:text-gray-500 dark:hover:text-gray-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Feedback List -->
        <div class="space-y-4">
            @forelse($allFeedback as $feedback)
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden feedback-item" 
                     data-status="{{ $feedback->status }}" 
                     data-priority="{{ $feedback->priority }}"
                     data-subject="{{ strtolower($feedback->subject) }}"
                     data-user="{{ strtolower($feedback->user->name) }}">
                    
                    <div class="p-6">
                        <!-- Header -->
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <div class="flex items-center space-x-3 mb-2">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $feedback->subject }}</h3>
                                    <span class="px-3 py-1 text-xs font-medium rounded-full {{ $feedback->status_color }}">
                                        {{ $feedback->status_display }}
                                    </span>
                                    <span class="px-3 py-1 text-xs font-medium rounded-full {{ $feedback->priority_color }}">
                                        {{ $feedback->priority_display }} Priority
                                    </span>
                                </div>
                                
                                <div class="flex items-center text-sm text-gray-600 dark:text-gray-400 space-x-4 mb-3">
                                    <div class="flex items-center space-x-2">
                                        <div class="h-6 w-6 rounded-full bg-blue-500 flex items-center justify-center text-white text-xs font-medium">
                                            {{ $feedback->user->initials() }}
                                        </div>
                                        <span>{{ $feedback->user->name }}</span>
                                        <span class="text-gray-400">•</span>
                                        <span>{{ $feedback->user->email }}</span>
                                    </div>
                                    <span class="text-gray-400">•</span>
                                    <span>{{ $feedback->created_at->diffForHumans() }}</span>
                                    @if($feedback->days_old > 7)
                                        <span class="px-2 py-1 text-xs bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400 rounded-full">
                                            {{ $feedback->days_old }} days old
                                        </span>
                                    @endif
                                </div>
                                
                                <p class="text-gray-700 dark:text-gray-300 leading-relaxed">{{ $feedback->message }}</p>
                            </div>
                            
                            <div class="flex items-center space-x-2 ml-4">
                                @if($feedback->status !== 'solved')
                                    <button onclick="openReplyModal({{ $feedback->id }}, '{{ $feedback->subject }}', '{{ $feedback->status }}')" 
                                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors flex items-center space-x-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                                        </svg>
                                        <span>Reply</span>
                                    </button>
                                @endif
                                
                                <div class="relative">
                                    <button onclick="toggleDropdown({{ $feedback->id }})" 
                                            class="p-2 text-gray-400 hover:text-gray-600 dark:text-gray-500 dark:hover:text-gray-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                                        </svg>
                                    </button>
                                    <div id="dropdown-{{ $feedback->id }}" class="hidden absolute right-0 mt-2 w-48 bg-white dark:bg-gray-700 rounded-lg shadow-lg z-10 border border-gray-200 dark:border-gray-600">
                                        <div class="py-1">
                                            @if($feedback->status !== 'pending')
                                                <button onclick="updateStatus({{ $feedback->id }}, 'pending')" 
                                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600">
                                                    Mark as Pending
                                                </button>
                                            @endif
                                            @if($feedback->status !== 'in-progress')
                                                <button onclick="updateStatus({{ $feedback->id }}, 'in-progress')" 
                                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600">
                                                    Mark as In Progress
                                                </button>
                                            @endif
                                            @if($feedback->status !== 'solved')
                                                <button onclick="updateStatus({{ $feedback->id }}, 'solved')" 
                                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600">
                                                    Mark as Solved
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Admin Reply (if exists) -->
                        @if($feedback->hasReply())
                            <div class="mt-6 pt-4 border-t border-gray-200 dark:border-gray-700">
                                <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-4">
                                    <div class="flex items-center space-x-2 mb-2">
                                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                        </svg>
                                        <span class="font-medium text-blue-900 dark:text-blue-100">Admin Reply</span>
                                        <span class="text-sm text-blue-600 dark:text-blue-400">
                                            by {{ $feedback->repliedByUser->name ?? 'Unknown' }} • {{ $feedback->replied_at->diffForHumans() }}
                                        </span>
                                    </div>
                                    <p class="text-blue-800 dark:text-blue-200">{{ $feedback->admin_reply }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-12 text-center">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">No Feedback Found</h3>
                    <p class="text-gray-600 dark:text-gray-400">There are no feedback messages to display at this time.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Reply Modal -->
    <div id="replyModal" class="fixed inset-0 overflow-y-auto h-full w-full hidden z-50" style="background-color: rgba(0,0,0,0.6);">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl w-full max-w-2xl">
                <!-- Header -->
                <div class="border-b border-gray-200 dark:border-gray-700 px-6 py-4">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Reply to Feedback</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1" id="replySubject"></p>
                </div>
                
                <!-- Form -->
                <form id="replyForm" method="POST" class="p-6">
                    @csrf
                    
                    <!-- Admin Reply -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Your Reply</label>
                        <textarea name="admin_reply" required rows="6"
                                  class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100 resize-none"
                                  placeholder="Type your response to the user..."></textarea>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Minimum 10 characters required</p>
                    </div>
                    
                    <!-- Status Update -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Update Status</label>
                        <select name="status" id="replyStatus" required
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-100">
                            <option value="pending">Pending</option>
                            <option value="in-progress">In Progress</option>
                            <option value="solved">Solved</option>
                        </select>
                    </div>
                    
                    <!-- Buttons -->
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeReplyModal()" 
                                class="px-4 py-2 text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 font-medium">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                            Send Reply
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript for Feedback Management -->
    <script>
        // Modal Management
        function openReplyModal(id, subject, currentStatus) {
            document.getElementById('replyModal').classList.remove('hidden');
            document.getElementById('replySubject').textContent = `Subject: ${subject}`;
            document.getElementById('replyStatus').value = currentStatus;
            document.getElementById('replyForm').action = `/admin/reply-feedback/${id}`;
        }

        function closeReplyModal() {
            document.getElementById('replyModal').classList.add('hidden');
            document.querySelector('#replyModal form').reset();
        }

        // Dropdown Management
        function toggleDropdown(id) {
            const dropdown = document.getElementById(`dropdown-${id}`);
            // Close all other dropdowns first
            document.querySelectorAll('[id^="dropdown-"]').forEach(d => {
                if (d.id !== `dropdown-${id}`) {
                    d.classList.add('hidden');
                }
            });
            dropdown.classList.toggle('hidden');
        }

        // Quick Status Update
        function updateStatus(id, status) {
            fetch(`/admin/update-feedback-status/${id}`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ status: status })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload(); // Simple reload for now
                }
            })
            .catch(error => console.error('Error:', error));
        }

        // Search and Filter
        function filterFeedback() {
            const searchFilter = document.getElementById('searchInput').value.toLowerCase();
            const statusFilter = document.getElementById('statusFilter').value;
            const priorityFilter = document.getElementById('priorityFilter').value;
            const items = document.querySelectorAll('.feedback-item');
            
            items.forEach(item => {
                const status = item.getAttribute('data-status');
                const priority = item.getAttribute('data-priority');
                const subject = item.getAttribute('data-subject');
                const user = item.getAttribute('data-user');
                
                let showItem = true;
                
                // Search filter
                if (searchFilter && !(subject.includes(searchFilter) || user.includes(searchFilter))) {
                    showItem = false;
                }
                
                // Status filter
                if (statusFilter !== 'all' && status !== statusFilter) {
                    showItem = false;
                }
                
                // Priority filter
                if (priorityFilter !== 'all' && priority !== priorityFilter) {
                    showItem = false;
                }
                
                item.style.display = showItem ? 'block' : 'none';
            });
        }

        // Event listeners
        document.getElementById('searchInput').addEventListener('keyup', filterFeedback);
        document.getElementById('statusFilter').addEventListener('change', filterFeedback);
        document.getElementById('priorityFilter').addEventListener('change', filterFeedback);

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('[onclick*="toggleDropdown"]') && !event.target.closest('[id^="dropdown-"]')) {
                document.querySelectorAll('[id^="dropdown-"]').forEach(dropdown => {
                    dropdown.classList.add('hidden');
                });
            }
        });

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('replyModal');
            if (event.target === modal) {
                closeReplyModal();
            }
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeReplyModal();
            }
        });

        // Form validation
        document.getElementById('replyForm').addEventListener('submit', function(e) {
            const reply = this.querySelector('textarea[name="admin_reply"]').value.trim();
            
            if (reply.length < 10) {
                e.preventDefault();
                alert('Reply must be at least 10 characters long.');
                return false;
            }
        });
    </script>

    <!-- Add CSRF token meta tag for AJAX requests -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</x-layouts.app>