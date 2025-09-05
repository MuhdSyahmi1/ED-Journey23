<x-layouts.app title="Feedback">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Feedback') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 dark:from-slate-900 dark:to-blue-950 transition-colors duration-300" x-data="feedbackForm()">
        <div class="p-6">
            <div class="max-w-5xl mx-auto">
                
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

                <!-- Header Section -->
                <div class="flex items-center justify-between mb-10">
                    <div class="space-y-2">
                        <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-600 dark:from-blue-400 dark:via-purple-400 dark:to-indigo-400 bg-clip-text text-transparent">
                            Feedback Center
                        </h1>
                        <p class="text-lg text-slate-600 dark:text-slate-300">
                            Share your thoughts, report issues, or request new features
                        </p>
                    </div>
                    
                    <button 
                        @click="showForm = !showForm"
                        class="group relative inline-flex items-center gap-2 px-6 py-3 rounded-xl font-medium text-sm 
                               bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white shadow-lg hover:shadow-xl dark:shadow-blue-500/25
                               transform hover:scale-105 transition-all duration-200 ease-out"
                    >
                        <svg class="w-5 h-5 transition-transform group-hover:rotate-12" 
                             :class="showForm ? 'rotate-45' : ''" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        <span x-text="showForm ? 'Cancel' : 'Submit Feedback'"></span>
                    </button>
                </div>

                <!-- Feedback Form -->
                <div x-show="showForm" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform scale-95"
                     x-transition:enter-end="opacity-100 transform scale-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 transform scale-100"
                     x-transition:leave-end="opacity-0 transform scale-95"
                     class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 mb-10 overflow-hidden"
                     style="display: none;">
                     
                    <!-- Form Header -->
                    <div class="bg-gradient-to-r from-blue-500/10 to-purple-500/10 dark:from-blue-400/10 dark:to-purple-400/10 px-8 py-6 border-b border-slate-200/60 dark:border-slate-700/60">
                        <div class="flex items-center justify-between">
                            <h2 class="text-2xl font-semibold text-slate-800 dark:text-slate-100 flex items-center gap-3">
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                                Submit New Feedback
                            </h2>
                            <button @click="showForm = false" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition-colors">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('user.feedback.store') }}" class="p-8 space-y-8">
                        @csrf
                        
                        <!-- Subject Field -->
                        <div class="space-y-2">
                            <label for="subject" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">
                                Subject <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text"
                                id="subject"
                                name="subject" 
                                value="{{ old('subject') }}"
                                placeholder="Brief description of your feedback"
                                class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 dark:border-slate-600 
                                       bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100
                                       placeholder-slate-400 dark:placeholder-slate-400
                                       focus:border-blue-500 dark:focus:border-blue-400 
                                       focus:ring-4 focus:ring-blue-500/20 dark:focus:ring-blue-400/20
                                       transition-all duration-200 hover:border-slate-300 dark:hover:border-slate-500
                                       @error('subject') border-red-500 dark:border-red-400 @enderror"
                                maxlength="255"
                                required
                            />
                            @error('subject')
                                <p class="text-red-500 dark:text-red-400 text-sm font-medium flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Feedback Type Field -->
                        <div class="space-y-2">
                            <label for="feedback_type" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">
                                Feedback Type <span class="text-red-500">*</span>
                            </label>
                            <select 
                                id="feedback_type"
                                name="feedback_type" 
                                class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 dark:border-slate-600 
                                       bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100
                                       focus:border-blue-500 dark:focus:border-blue-400 
                                       focus:ring-4 focus:ring-blue-500/20 dark:focus:ring-blue-400/20
                                       transition-all duration-200 hover:border-slate-300 dark:hover:border-slate-500
                                       @error('feedback_type') border-red-500 dark:border-red-400 @enderror"
                                required
                            >
                                <option value="">Select feedback type</option>
                                <option value="technical_issue" {{ old('feedback_type') == 'technical_issue' ? 'selected' : '' }}>🔴 Technical Issue / Bug</option>
                                <option value="account_billing" {{ old('feedback_type') == 'account_billing' ? 'selected' : '' }}>🔴 Account / Billing Issue</option>
                                <option value="content_error" {{ old('feedback_type') == 'content_error' ? 'selected' : '' }}>🟡 Content Error</option>
                                <option value="course_feedback" {{ old('feedback_type') == 'course_feedback' ? 'selected' : '' }}>🟡 Course / Instructor Feedback</option>
                                <option value="feature_request" {{ old('feedback_type') == 'feature_request' ? 'selected' : '' }}>🟢 Feature Request / Suggestion</option>
                                <option value="usability_feedback" {{ old('feedback_type') == 'usability_feedback' ? 'selected' : '' }}>🟢 Usability / User Experience Feedback</option>
                                <option value="general_feedback" {{ old('feedback_type') == 'general_feedback' ? 'selected' : '' }}>🟢 General Feedback / Other</option>
                            </select>
                            <p class="text-sm text-slate-500 dark:text-slate-400">
                                🔴 High Priority &nbsp;&nbsp; 🟡 Medium Priority &nbsp;&nbsp; 🟢 Low Priority
                            </p>
                            @error('feedback_type')
                                <p class="text-red-500 dark:text-red-400 text-sm font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Message Field -->
                        <div class="space-y-2">
                            <label for="message" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">
                                Message <span class="text-red-500">*</span>
                            </label>
                            <textarea 
                                id="message"
                                name="message" 
                                rows="6"
                                x-model="messageContent"
                                placeholder="Please provide detailed information about your feedback..."
                                class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 dark:border-slate-600 
                                       bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100
                                       placeholder-slate-400 dark:placeholder-slate-400
                                       focus:border-blue-500 dark:focus:border-blue-400 
                                       focus:ring-4 focus:ring-blue-500/20 dark:focus:ring-blue-400/20
                                       transition-all duration-200 hover:border-slate-300 dark:hover:border-slate-500
                                       resize-none @error('message') border-red-500 dark:border-red-400 @enderror"
                                maxlength="1000"
                                required
                            >{{ old('message') }}</textarea>
                            <div class="flex justify-between items-center">
                                <p class="text-sm text-slate-500 dark:text-slate-400">
                                    Minimum 10 characters required
                                </p>
                                <p class="text-sm font-medium" 
                                   :class="messageLength > 950 ? 'text-orange-600 dark:text-orange-400' : 'text-slate-500 dark:text-slate-400'"
                                   x-text="`${messageLength}/1000`">
                                </p>
                            </div>
                            @error('message')
                                <p class="text-red-500 dark:text-red-400 text-sm font-medium flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end pt-4">
                            <button type="submit" 
                                class="group inline-flex items-center gap-3 px-8 py-4 rounded-xl font-semibold text-white
                                       bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700
                                       shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200
                                       focus:ring-4 focus:ring-blue-500/30 focus:outline-none
                                       dark:shadow-blue-500/25 dark:hover:shadow-blue-500/40">
                                <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                                Submit Feedback
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Feedback History -->
                <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden">
                    <!-- History Header -->
                    <div class="bg-gradient-to-r from-slate-500/10 to-blue-500/10 dark:from-slate-400/10 dark:to-blue-400/10 px-8 py-6 border-b border-slate-200/60 dark:border-slate-700/60">
                        <h2 class="text-2xl font-semibold text-slate-800 dark:text-slate-100 flex items-center gap-3">
                            <svg class="w-6 h-6 text-slate-600 dark:text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Your Feedback History
                        </h2>
                    </div>

                    @if($feedback->count() > 0)
                        <div class="divide-y divide-slate-200/60 dark:divide-slate-700/60">
                            @foreach($feedback as $item)
                            <div class="p-8 hover:bg-slate-50/50 dark:hover:bg-slate-700/30 transition-colors duration-200">
                                <div class="flex items-start justify-between gap-6">
                                    <div class="flex-1 min-w-0">
                                        <!-- Header with Title -->
                                        <div class="flex items-center gap-4 mb-4">
                                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-700 dark:to-slate-600 flex items-center justify-center text-xl">
                                                📝
                                            </div>
                                            
                                            <h3 class="text-xl font-semibold text-slate-900 dark:text-slate-100 truncate">
                                                {{ $item->subject }}
                                            </h3>
                                        </div>

                                        <!-- Status and Feedback Type Badges -->
                                        <div class="flex flex-wrap items-center gap-3 mb-4">
                                            @php
                                                $statusConfig = match($item->status) {
                                                    'pending' => ['bg' => 'bg-yellow-100 dark:bg-yellow-900/30', 'text' => 'text-yellow-800 dark:text-yellow-200', 'border' => 'border-yellow-200 dark:border-yellow-700'],
                                                    'in-progress' => ['bg' => 'bg-blue-100 dark:bg-blue-900/30', 'text' => 'text-blue-800 dark:text-blue-200', 'border' => 'border-blue-200 dark:border-blue-700'],
                                                    'solved' => ['bg' => 'bg-green-100 dark:bg-green-900/30', 'text' => 'text-green-800 dark:text-green-200', 'border' => 'border-green-200 dark:border-green-700'],
                                                    default => ['bg' => 'bg-slate-100 dark:bg-slate-700', 'text' => 'text-slate-800 dark:text-slate-200', 'border' => 'border-slate-200 dark:border-slate-600']
                                                };

                                                $feedbackTypeConfig = match($item->feedback_type ?? 'general_feedback') {
                                                    'technical_issue' => ['bg' => 'bg-red-100 dark:bg-red-900/30', 'text' => 'text-red-700 dark:text-red-300', 'border' => 'border-red-300 dark:border-red-600', 'emoji' => '🔴'],
                                                    'account_billing' => ['bg' => 'bg-pink-100 dark:bg-pink-900/30', 'text' => 'text-pink-700 dark:text-pink-300', 'border' => 'border-pink-300 dark:border-pink-600', 'emoji' => '🔴'],
                                                    'content_error' => ['bg' => 'bg-orange-100 dark:bg-orange-900/30', 'text' => 'text-orange-700 dark:text-orange-300', 'border' => 'border-orange-300 dark:border-orange-600', 'emoji' => '🟡'],
                                                    'course_feedback' => ['bg' => 'bg-yellow-100 dark:bg-yellow-900/30', 'text' => 'text-yellow-700 dark:text-yellow-300', 'border' => 'border-yellow-300 dark:border-yellow-600', 'emoji' => '🟡'],
                                                    'feature_request' => ['bg' => 'bg-blue-100 dark:bg-blue-900/30', 'text' => 'text-blue-700 dark:text-blue-300', 'border' => 'border-blue-300 dark:border-blue-600', 'emoji' => '🟢'],
                                                    'usability_feedback' => ['bg' => 'bg-purple-100 dark:bg-purple-900/30', 'text' => 'text-purple-700 dark:text-purple-300', 'border' => 'border-purple-300 dark:border-purple-600', 'emoji' => '🟢'],
                                                    'general_feedback' => ['bg' => 'bg-gray-100 dark:bg-gray-900/30', 'text' => 'text-gray-700 dark:text-gray-300', 'border' => 'border-gray-300 dark:border-gray-600', 'emoji' => '🟢'],
                                                    default => ['bg' => 'bg-gray-100 dark:bg-gray-900/30', 'text' => 'text-gray-700 dark:text-gray-300', 'border' => 'border-gray-300 dark:border-gray-600', 'emoji' => '🟢']
                                                };
                                            @endphp
                                            
                                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg text-sm font-medium border {{ $statusConfig['bg'] }} {{ $statusConfig['text'] }} {{ $statusConfig['border'] }}">
                                                {{ ucwords(str_replace('-', ' ', $item->status)) }}
                                            </span>
                                            
                                            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg text-sm font-medium border-2 {{ $feedbackTypeConfig['border'] }} {{ $feedbackTypeConfig['text'] }} {{ $feedbackTypeConfig['bg'] }}">
                                                {{ $feedbackTypeConfig['emoji'] }} {{ $item->feedback_type_display ?? 'General Feedback' }}
                                            </span>
                                        </div>

                                        <!-- Message -->
                                        <p class="text-slate-600 dark:text-slate-300 leading-relaxed mb-4 bg-slate-50 dark:bg-slate-700/50 rounded-lg p-4">
                                            {{ $item->message }}
                                        </p>

                                        <!-- Admin/Staff Response -->
                                        @if($item->admin_reply)
                                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 border-2 border-blue-200 dark:border-blue-700/50 rounded-xl p-6 mt-4">
                                            <div class="flex items-center gap-3 mb-3">
                                                <div class="w-8 h-8 rounded-full bg-blue-600 dark:bg-blue-500 flex items-center justify-center">
                                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                                <div>
                                                    <span class="font-semibold text-blue-900 dark:text-blue-100">
                                                        @if($item->repliedByUser && $item->repliedByUser->role === 'staff')
                                                            Staff Response
                                                        @else
                                                            Admin Response
                                                        @endif
                                                    </span>
                                                    @if($item->replied_at)
                                                        <span class="text-sm text-blue-600 dark:text-blue-300 ml-2">
                                                            {{ $item->replied_at->diffForHumans() }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <p class="text-blue-800 dark:text-blue-200 leading-relaxed">
                                                {{ $item->admin_reply }}
                                            </p>
                                        </div>
                                        @endif
                                    </div>

                                    <!-- Timestamp -->
                                    <div class="text-right text-sm text-slate-500 dark:text-slate-400 min-w-[120px] space-y-1">
                                        <div class="font-semibold">{{ $item->created_at->format('M j, Y') }}</div>
                                        <div>{{ $item->created_at->format('g:i A') }}</div>
                                        <div class="text-xs bg-slate-100 dark:bg-slate-700 px-2 py-1 rounded-full">
                                            {{ $item->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        @if($feedback->hasPages())
                            <div class="px-8 py-6 bg-slate-50/50 dark:bg-slate-700/30 border-t border-slate-200/60 dark:border-slate-700/60">
                                {{ $feedback->links() }}
                            </div>
                        @endif
                    @else
                        <!-- Empty State -->
                        <div class="text-center py-16 px-8">
                            <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-700 dark:to-slate-600 flex items-center justify-center text-3xl">
                                💬
                            </div>
                            <h3 class="text-xl font-semibold text-slate-900 dark:text-slate-100 mb-3">
                                No feedback submitted yet
                            </h3>
                            <p class="text-slate-600 dark:text-slate-400 max-w-md mx-auto">
                                Get started by submitting your first feedback using the button above. We'd love to hear from you!
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function feedbackForm() {
            return {
                showForm: false,
                messageContent: '{{ old('message') }}',
                
                get messageLength() {
                    return this.messageContent.length;
                },
                
                init() {
                    // Auto-show form if there are validation errors
                    @if($errors->any())
                        this.showForm = true;
                    @endif
                }
            }
        }
    </script>
</x-layouts.app>