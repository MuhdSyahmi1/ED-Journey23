<x-layouts.app title="Academic Advisor">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Academic Advisor') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 dark:from-slate-900 dark:to-blue-950 transition-colors duration-300">
        <div class="p-6">
            <div class="max-w-4xl mx-auto">
                
                <!-- Header -->
                <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden mb-6">
                    <div class="bg-gradient-to-r from-blue-500/90 to-indigo-500/90 text-white text-center py-4">
                        <h1 class="text-2xl font-bold flex items-center justify-center gap-2">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-4l-4 4z" />
                            </svg>
                            Academic Advisor
                        </h1>
                        <p class="text-blue-100 text-sm">Get personalized school recommendations through AI-powered conversation</p>
                    </div>
                </div>

                <!-- Chat Container -->
                <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden">
                    
                    <!-- Messages Area -->
                    <div id="messages-container" class="h-96 overflow-y-auto p-6 space-y-4 bg-gradient-to-b from-slate-50/50 to-white dark:from-slate-900/50 dark:to-slate-800">
                        @forelse($messages as $message)
                            <div class="flex {{ $message->role === 'user' ? 'justify-end' : 'justify-start' }}">
                                <div class="max-w-xs lg:max-w-md">
                                    @if($message->role === 'user')
                                        <!-- User Message -->
                                        <div class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white rounded-2xl rounded-br-md p-4 shadow-lg">
                                            @if(!empty($message->metadata['image_path'] ?? null))
                                                <div class="mb-2">
                                                    <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.293-1.293a2 2 0 012.828 0L20 15m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                    <span class="text-sm opacity-90">Image uploaded</span>
                                                </div>
                                            @endif
                                            <p class="text-sm">{{ $message->message }}</p>
                                            <p class="text-xs opacity-75 mt-1">{{ $message->created_at->diffForHumans() }}</p>
                                        </div>
                                    @else
                                        <!-- AI Message -->
                                        <div class="flex items-start gap-3">
                                            <div class="w-8 h-8 bg-gradient-to-r from-green-500 to-emerald-500 rounded-full flex items-center justify-center flex-shrink-0">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                                </svg>
                                            </div>
                                            <div class="bg-slate-100 dark:bg-slate-700 rounded-2xl rounded-bl-md p-4 shadow-lg">
                                                <p class="text-sm text-slate-800 dark:text-slate-200 whitespace-pre-line">{{ $message->message }}</p>
                                                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">{{ $message->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-slate-500 dark:text-slate-400">
                                <svg class="w-16 h-16 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-4l-4 4z" />
                                </svg>
                                <p>No messages yet. Start a conversation!</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Input Area -->
                    <div class="p-6 bg-slate-50/50 dark:bg-slate-700/30 border-t border-slate-200/60 dark:border-slate-600/60">
                        <form id="message-form" action="{{ route('user.academic-advisor.send') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="session_id" value="{{ $session->session_id }}">
                            
                            <div class="flex items-end gap-3">
                                <div class="flex gap-2">
                                    <label for="image-upload" class="cursor-pointer p-2 text-slate-600 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                        </svg>
                                    </label>
                                    <input type="file" id="image-upload" name="image" accept="image/*" class="hidden">
                                </div>
                                
                                <div class="flex-1">
                                    <textarea 
                                        name="message"
                                        placeholder="Ask me about schools, programmes, or upload your academic documents..."
                                        rows="2"
                                        required
                                        class="w-full px-4 py-3 border border-slate-300 dark:border-slate-600 rounded-xl bg-white dark:bg-slate-800 text-slate-900 dark:text-slate-100 placeholder-slate-500 dark:placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                                    ></textarea>
                                </div>
                                
                                <button 
                                    type="submit"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                    </svg>
                                </button>
                            </div>
                            
                            <div class="mt-3 flex items-center justify-between text-sm text-slate-600 dark:text-slate-400">
                                <div class="flex items-center gap-4">
                                    <span>Press Ctrl+Enter to send</span>
                                    <span id="image-status" class="text-green-600 dark:text-green-400 hidden">📎 Image selected</span>
                                </div>
                                <a href="{{ route('user.academic-advisor.new') }}" class="text-blue-600 dark:text-blue-400 hover:underline">
                                    Start New Conversation
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-6 flex justify-center gap-4">
                    <button onclick="scrollToTop()" class="bg-slate-500 hover:bg-slate-600 text-white px-4 py-2 rounded-lg transition-colors">
                        <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg>
                        Scroll to Top
                    </button>
                    
                    @if($messages->count() >= 4)
                        <form action="{{ route('user.academic-advisor.complete') }}" method="POST" class="inline">
                            @csrf
                            <input type="hidden" name="session_id" value="{{ $session->session_id }}">
                            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition-colors">
                                <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Get My Recommendation
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        // Handle image upload preview
        document.getElementById('image-upload').addEventListener('change', function(e) {
            const status = document.getElementById('image-status');
            if (e.target.files.length > 0) {
                status.classList.remove('hidden');
            } else {
                status.classList.add('hidden');
            }
        });

        // Handle form submission with AJAX
        document.getElementById('message-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const form = this;
            const formData = new FormData(form);
            const messageInput = form.querySelector('textarea[name="message"]');
            const submitButton = form.querySelector('button[type="submit"]');
            const messagesContainer = document.getElementById('messages-container');
            
            // Don't submit if message is empty and no image
            if (!messageInput.value.trim() && !document.getElementById('image-upload').files.length) {
                return;
            }
            
            // Disable form while sending
            messageInput.disabled = true;
            submitButton.disabled = true;
            submitButton.innerHTML = '<svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" class="opacity-25"></circle><path fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" class="opacity-75"></path></svg>';
            
            // Add user message to UI immediately
            const userMessage = createMessageElement('user', messageInput.value, 'just now', document.getElementById('image-upload').files.length > 0);
            messagesContainer.appendChild(userMessage);
            scrollToBottom();
            
            // Clear form
            const messageText = messageInput.value;
            messageInput.value = '';
            document.getElementById('image-upload').value = '';
            document.getElementById('image-status').classList.add('hidden');
            
            // Send AJAX request
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Add AI response
                    const aiMessage = createMessageElement('assistant', data.message, data.timestamp);
                    messagesContainer.appendChild(aiMessage);
                    scrollToBottom();
                } else {
                    // Add error message
                    const errorMessage = createMessageElement('assistant', 'Sorry, I encountered an error: ' + (data.error || 'Unknown error'), 'just now');
                    messagesContainer.appendChild(errorMessage);
                    scrollToBottom();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                const errorMessage = createMessageElement('assistant', 'Sorry, I\'m having trouble connecting right now. Please try again.', 'just now');
                messagesContainer.appendChild(errorMessage);
                scrollToBottom();
            })
            .finally(() => {
                // Re-enable form
                messageInput.disabled = false;
                submitButton.disabled = false;
                submitButton.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" /></svg>';
                messageInput.focus();
            });
        });

        // Create message element
        function createMessageElement(role, message, timestamp, hasImage = false) {
            const messageDiv = document.createElement('div');
            messageDiv.className = `flex ${role === 'user' ? 'justify-end' : 'justify-start'}`;
            
            if (role === 'user') {
                messageDiv.innerHTML = `
                    <div class="max-w-xs lg:max-w-md">
                        <div class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white rounded-2xl rounded-br-md p-4 shadow-lg">
                            ${hasImage ? '<div class="mb-2"><svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.293-1.293a2 2 0 012.828 0L20 15m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg><span class="text-sm opacity-90">Image uploaded</span></div>' : ''}
                            <p class="text-sm">${message}</p>
                            <p class="text-xs opacity-75 mt-1">${timestamp}</p>
                        </div>
                    </div>
                `;
            } else {
                messageDiv.innerHTML = `
                    <div class="max-w-xs lg:max-w-md">
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 bg-gradient-to-r from-green-500 to-emerald-500 rounded-full flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                </svg>
                            </div>
                            <div class="bg-slate-100 dark:bg-slate-700 rounded-2xl rounded-bl-md p-4 shadow-lg">
                                <p class="text-sm text-slate-800 dark:text-slate-200 whitespace-pre-line">${message}</p>
                                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">${timestamp}</p>
                            </div>
                        </div>
                    </div>
                `;
            }
            
            return messageDiv;
        }

        // Scroll to bottom function
        function scrollToBottom() {
            const container = document.getElementById('messages-container');
            container.scrollTop = container.scrollHeight;
        }

        // Handle Ctrl+Enter to submit
        document.querySelector('textarea').addEventListener('keydown', function(e) {
            if (e.ctrlKey && e.key === 'Enter') {
                e.preventDefault();
                document.getElementById('message-form').dispatchEvent(new Event('submit'));
            }
        });

        // Scroll to top function
        function scrollToTop() {
            window.scrollTo({top: 0, behavior: 'smooth'});
        }

        // Auto-scroll to bottom of messages on page load
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('messages-container');
            container.scrollTop = container.scrollHeight;
        });
    </script>
</x-layouts.app>