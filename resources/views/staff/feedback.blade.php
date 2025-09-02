<x-layouts.app title="Staff Feedback Management">
    <div class="space-y-6">
        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        <!-- Page Header -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6">
            <div class="text-center">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-2">FEEDBACK CENTER</h1>
                <p class="text-gray-600 dark:text-gray-400">Manage and respond to user feedback</p>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-4">
            <div class="flex flex-wrap gap-4 items-center">
                <div>
                    <select id="statusFilter" class="border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                        <option value="all">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="in-progress">In Progress</option>
                        <option value="solved">Solved</option>
                    </select>
                </div>
                
                <div>
                    <select id="priorityFilter" class="border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                        <option value="all">All Priority</option>
                        <option value="high">High Priority</option>
                        <option value="medium">Medium Priority</option>
                        <option value="low">Low Priority</option>
                    </select>
                </div>
                
                <div>
                    <select id="typeFilter" class="border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                        <option value="all">All Types</option>
                        <option value="technical_issue">Technical Issue / Bug</option>
                        <option value="content_error">Content Error</option>
                        <option value="feature_request">Feature Request / Suggestion</option>
                        <option value="usability_feedback">Usability / User Experience</option>
                        <option value="course_feedback">Course / Instructor Feedback</option>
                        <option value="general_feedback">General Feedback / Other</option>
                        <option value="account_billing">Account / Billing Issue</option>
                    </select>
                </div>
                
                <div class="ml-auto">
                    <input type="text" 
                           id="searchInput"
                           placeholder="Search by name, email, or subject..." 
                           class="border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 text-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 w-64">
                </div>
            </div>
        </div>

        <!-- Feedback Cards with Expandable Details -->
        <div class="space-y-4">
            @forelse($allFeedback as $feedback)
                <div class="feedback-card bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700" 
                     data-status="{{ $feedback->status }}" 
                     data-priority="{{ $feedback->priority }}"
                     data-feedback-type="{{ $feedback->feedback_type ?? 'general_feedback' }}"
                     data-user-name="{{ strtolower($feedback->user->name) }}"
                     data-user-email="{{ strtolower($feedback->user->email) }}"
                     data-subject="{{ strtolower($feedback->subject) }}"
                     data-message="{{ strtolower($feedback->message) }}">
                    <!-- Card Header (Always Visible) -->
                    <div class="p-4 cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors" onclick="toggleFeedback({{ $feedback->id }})">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4 flex-1">
                                <!-- User Avatar -->
                                <div class="h-10 w-10 rounded-full bg-blue-500 flex items-center justify-center text-white font-medium">
                                    {{ substr($feedback->user->name, 0, 2) }}
                                </div>
                                
                                <!-- Basic Info -->
                                <div class="flex-1">
                                    <div class="flex items-center space-x-3 mb-1">
                                        <h3 class="font-semibold text-gray-900 dark:text-gray-100">
                                            {{ $feedback->user->name }}
                                        </h3>
                                        <span class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ $feedback->user->email }}
                                        </span>
                                        <span class="text-xs text-gray-400">
                                            {{ $feedback->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                    <p class="text-sm font-medium text-gray-800 dark:text-gray-200">
                                        {{ $feedback->subject }}
                                    </p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                        {{ Str::limit($feedback->message, 100) }}
                                        @if(strlen($feedback->message) > 100)
                                            <span class="text-blue-600 dark:text-blue-400 font-medium">... Click to read more</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Status and Priority -->
                            <div class="flex items-center space-x-2 flex-wrap">
                                <!-- Feedback Type Badge -->
                                <span class="px-2 py-1 text-xs font-medium rounded-full {{ $feedback->feedback_type_color ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ $feedback->feedback_type_display ?? 'General Feedback' }}
                                </span>
                                
                                <!-- Priority Badge -->
                                @if($feedback->priority === 'high')
                                    <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400 rounded-full">
                                        High Priority
                                    </span>
                                @elseif($feedback->priority === 'medium')
                                    <span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400 rounded-full">
                                        Medium Priority
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400 rounded-full">
                                        Low Priority
                                    </span>
                                @endif
                                
                                <!-- Status Badge -->
                                @if($feedback->status === 'pending')
                                    <span class="px-3 py-1 text-sm font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400 rounded-full">
                                        Pending
                                    </span>
                                @elseif($feedback->status === 'in-progress')
                                    <span class="px-3 py-1 text-sm font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400 rounded-full">
                                        In Progress
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-sm font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400 rounded-full">
                                        Solved ✓
                                    </span>
                                @endif
                                
                                <!-- Expand Arrow -->
                                <svg id="arrow-{{ $feedback->id }}" class="w-5 h-5 text-gray-400 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Expanded Details (Hidden by default) -->
                    <div id="details-{{ $feedback->id }}" class="hidden border-t border-gray-200 dark:border-gray-700">
                        <div class="p-4 space-y-4">
                            <!-- Full Message -->
                            <div>
                                <h4 class="font-medium text-gray-900 dark:text-gray-100 mb-2">Full Message:</h4>
                                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-3">
                                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed">{{ $feedback->message }}</p>
                                </div>
                            </div>
                            
                            <!-- Staff Reply (if exists) -->
                            @if($feedback->admin_reply)
                                <div>
                                    <h4 class="font-medium text-gray-900 dark:text-gray-100 mb-2">Staff Reply:</h4>
                                    <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-3">
                                        <p class="text-blue-800 dark:text-blue-200">{{ $feedback->admin_reply }}</p>
                                        <p class="text-xs text-blue-600 dark:text-blue-400 mt-2">
                                            Replied {{ $feedback->replied_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                            @endif
                            
                            <!-- Action Buttons -->
                            <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
                                <!-- Status Change -->
                                <div class="flex items-center space-x-2">
                                    <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Change Status:</label>
                                    <select onchange="changeStatus({{ $feedback->id }}, this.value)" class="px-3 py-1 border border-gray-300 dark:border-gray-600 rounded text-sm dark:bg-gray-600 dark:text-gray-100">
                                        <option value="pending" {{ $feedback->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="in-progress" {{ $feedback->status === 'in-progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="solved" {{ $feedback->status === 'solved' ? 'selected' : '' }}>Solved</option>
                                    </select>
                                </div>
                                
                                <!-- Reply Button -->
                                @if($feedback->status !== 'solved')
                                    <button onclick="toggleReplyForm({{ $feedback->id }})" 
                                            class="px-3 py-2 text-gray-600 dark:text-gray-400 text-sm hover:text-gray-800 dark:hover:text-gray-200">
                                        Add Reply
                                    </button>
                                @else
                                    <span class="px-4 py-2 bg-green-100 text-green-700 text-sm rounded-md">
                                        Completed
                                    </span>
                                @endif
                            </div>
                            
                            <!-- Reply Form (Hidden by default) -->
                            <div id="reply-form-{{ $feedback->id }}" class="hidden pt-4 border-t border-gray-200 dark:border-gray-700">
                                <form action="@if(auth()->user()->role === 'admin'){{ route('admin.reply-feedback', $feedback->id) }}@elseif(auth()->user()->isProgramManager()){{ route('staff.program.reply-feedback', $feedback->id) }}@else{{ route('staff.reply-feedback', $feedback->id) }}@endif" method="POST" class="space-y-3">
                                    @csrf
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Your Reply:</label>
                                        <textarea name="admin_reply" rows="4" required 
                                                  class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm dark:bg-gray-600 dark:text-gray-100"
                                                  placeholder="Type your detailed response..."></textarea>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-2">
                                            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Update Status:</label>
                                            <select name="status" class="px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md text-sm dark:bg-gray-600 dark:text-gray-100">
                                                <option value="pending">Pending</option>
                                                <option value="in-progress" selected>In Progress</option>
                                                <option value="solved">Solved</option>
                                            </select>
                                        </div>
                                        <div class="space-x-2">
                                            <button type="button" onclick="toggleReplyForm({{ $feedback->id }})" 
                                                    class="px-3 py-2 text-gray-600 dark:text-gray-400 text-sm hover:text-gray-800 dark:hover:text-gray-200">
                                                Cancel
                                            </button>
                                            <button type="submit" class="px-3 py-2 text-gray-600 dark:text-gray-400 text-sm hover:text-gray-800 dark:hover:text-gray-200">
                                                Send Reply
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-12 text-center">
                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">No Feedback Found</h3>
                    <p class="text-gray-600 dark:text-gray-400">There are no feedback messages to display at this time.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        function toggleFeedback(id) {
            const details = document.getElementById('details-' + id);
            const arrow = document.getElementById('arrow-' + id);
            
            if (details.classList.contains('hidden')) {
                details.classList.remove('hidden');
                arrow.style.transform = 'rotate(180deg)';
            } else {
                details.classList.add('hidden');
                arrow.style.transform = 'rotate(0deg)';
            }
        }

        function changeStatus(id, status) {
            let updateUrl;
            @if(auth()->user()->role === 'admin')
                updateUrl = '/admin/update-feedback-status/' + id;
            @elseif(auth()->user()->isProgramManager())
                updateUrl = '/staff/program/update-feedback-status/' + id;
            @else
                updateUrl = '/staff/update-feedback-status/' + id;
            @endif
            fetch(updateUrl, {
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
                    // Show success message
                    const successDiv = document.createElement('div');
                    successDiv.className = 'bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4';
                    successDiv.innerHTML = 'Status updated successfully!';
                    document.querySelector('.space-y-6').insertBefore(successDiv, document.querySelector('.space-y-6').children[0]);
                    
                    // Reload after 1 second to show updated status
                    setTimeout(() => location.reload(), 1000);
                } else {
                    alert('Error updating status. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error updating status. Please try again.');
            });
        }

        function toggleReplyForm(id) {
            const form = document.getElementById('reply-form-' + id);
            form.classList.toggle('hidden');
            
            if (!form.classList.contains('hidden')) {
                const textarea = form.querySelector('textarea');
                textarea.focus();
            }
        }

        // Enhanced Search and Filter functionality
        function filterFeedback() {
            const searchFilter = document.getElementById('searchInput').value.toLowerCase().trim();
            const statusFilter = document.getElementById('statusFilter').value;
            const priorityFilter = document.getElementById('priorityFilter').value;
            const typeFilter = document.getElementById('typeFilter').value;
            const cards = document.querySelectorAll('.feedback-card');
            
            let visibleCount = 0;
            
            cards.forEach(card => {
                const status = card.getAttribute('data-status');
                const priority = card.getAttribute('data-priority');
                const feedbackType = card.getAttribute('data-feedback-type');
                const userName = card.getAttribute('data-user-name');
                const userEmail = card.getAttribute('data-user-email');
                const subject = card.getAttribute('data-subject');
                const message = card.getAttribute('data-message');
                
                let showCard = true;
                
                // Search filter - check name, email, subject, and message
                if (searchFilter && !(
                    userName.includes(searchFilter) || 
                    userEmail.includes(searchFilter) || 
                    subject.includes(searchFilter) || 
                    message.includes(searchFilter)
                )) {
                    showCard = false;
                }
                
                // Status filter
                if (statusFilter !== 'all' && status !== statusFilter) {
                    showCard = false;
                }
                
                // Priority filter
                if (priorityFilter !== 'all' && priority !== priorityFilter) {
                    showCard = false;
                }
                
                // Feedback Type filter
                if (typeFilter !== 'all' && feedbackType !== typeFilter) {
                    showCard = false;
                }
                
                // Show or hide the card
                if (showCard) {
                    card.style.display = 'block';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });
            
            // Show "no results" message if no cards are visible
            updateNoResultsMessage(visibleCount);
        }

        function updateNoResultsMessage(visibleCount) {
            // Remove existing no-results message
            const existingMessage = document.querySelector('.no-results-message');
            if (existingMessage) {
                existingMessage.remove();
            }
            
            // Add no-results message if needed
            if (visibleCount === 0) {
                const noResultsDiv = document.createElement('div');
                noResultsDiv.className = 'no-results-message bg-white dark:bg-gray-800 rounded-xl shadow-sm p-12 text-center';
                noResultsDiv.innerHTML = `
                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">No Feedback Found</h3>
                    <p class="text-gray-600 dark:text-gray-400">No feedback matches your current search and filter criteria.</p>
                    <button onclick="clearFilters()" class="mt-3 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-md">
                        Clear Filters
                    </button>
                `;
                
                // Insert after the filters
                const feedbackContainer = document.querySelector('.space-y-4');
                feedbackContainer.appendChild(noResultsDiv);
            }
        }

        function clearFilters() {
            document.getElementById('searchInput').value = '';
            document.getElementById('statusFilter').value = 'all';
            document.getElementById('priorityFilter').value = 'all';
            document.getElementById('typeFilter').value = 'all';
            filterFeedback();
        }

        // Event listeners for real-time filtering
        document.getElementById('searchInput').addEventListener('input', filterFeedback);
        document.getElementById('statusFilter').addEventListener('change', filterFeedback);
        document.getElementById('priorityFilter').addEventListener('change', filterFeedback);
        document.getElementById('typeFilter').addEventListener('change', filterFeedback);

        // Add some visual feedback for search
        document.getElementById('searchInput').addEventListener('focus', function() {
            this.classList.add('ring-2', 'ring-blue-500');
        });
        
        document.getElementById('searchInput').addEventListener('blur', function() {
            this.classList.remove('ring-2', 'ring-blue-500');
        });

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Set initial state
            filterFeedback();
        });
    </script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
</x-layouts.app>