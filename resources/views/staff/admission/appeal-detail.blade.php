<x-layouts.app title="Appeal Review">

<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-slate-900 dark:to-slate-800 py-6">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Page Header -->
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Appeal Review</h1>
                <p class="text-lg text-gray-600 dark:text-gray-300">Review and respond to student appeal</p>
            </div>
            <a href="{{ route('staff.admission.appeals') }}" 
               class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
                Back to Appeals
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Appeal Details (Left Column) -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Student Information -->
                <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Student Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Full Name</label>
                            <p class="text-gray-900 dark:text-white">{{ $appeal->user->name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Email</label>
                            <p class="text-gray-900 dark:text-white">{{ $appeal->user->email }}</p>
                        </div>
                        @if($appeal->user->userProfile)
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Identification Card</label>
                                <p class="text-gray-900 dark:text-white">{{ $appeal->user->userProfile->identity_card ?? 'Not provided' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Phone</label>
                                <p class="text-gray-900 dark:text-white">{{ $appeal->user->userProfile->phone_number ?? 'Not provided' }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Original Application Details -->
                <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Original Application</h3>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Programme Applied</label>
                            <p class="text-gray-900 dark:text-white font-medium">
                                {{ $appeal->studentApplication->schoolProgramme->diplomaProgramme->name }}
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-300">
                                {{ ucfirst($appeal->studentApplication->schoolProgramme->school) }} School • 
                                {{ $appeal->studentApplication->schoolProgramme->duration }} years
                            </p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Application Status</label>
                            <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs font-medium">
                                {{ ucfirst($appeal->studentApplication->status) }}
                            </span>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Preference Rank</label>
                            <p class="text-gray-900 dark:text-white">{{ $appeal->studentApplication->preference_text }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Application Date</label>
                            <p class="text-gray-900 dark:text-white">{{ $appeal->studentApplication->applied_at->format('F j, Y') }}</p>
                        </div>
                        @if($appeal->studentApplication->review_notes)
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Original Review Notes</label>
                                <p class="text-gray-900 dark:text-white bg-gray-50 dark:bg-slate-700 p-3 rounded">
                                    {{ $appeal->studentApplication->review_notes }}
                                </p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Appeal Information -->
                <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Appeal Details</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Appeal Reason</label>
                            <div class="bg-gray-50 dark:bg-slate-700 p-4 rounded-lg">
                                <p class="text-gray-900 dark:text-white whitespace-pre-wrap">{{ $appeal->appeal_reason }}</p>
                            </div>
                        </div>
                        
                        @if($appeal->supporting_documents && count($appeal->supporting_documents) > 0)
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Supporting Documents</label>
                                <div class="space-y-2">
                                    @foreach($appeal->supporting_documents as $document)
                                        <div class="flex items-center p-3 bg-gray-50 dark:bg-slate-700 rounded-lg">
                                            <svg class="w-5 h-5 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            <span class="text-gray-900 dark:text-white">{{ basename($document) }}</span>
                                            <a href="#" class="ml-auto text-blue-600 hover:text-blue-800 text-sm">Download</a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Appeal Submitted</label>
                            <p class="text-gray-900 dark:text-white">{{ $appeal->created_at->format('F j, Y \a\t g:i A') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Review Actions (Right Column) -->
            <div class="space-y-6">
                <!-- Current Status -->
                <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Current Status</h3>
                    <div class="text-center">
                        <span class="bg-{{ $appeal->status_color }}-100 text-{{ $appeal->status_color }}-800 px-4 py-2 rounded-full text-sm font-medium">
                            {{ $appeal->status_text }}
                        </span>
                        @if($appeal->reviewer)
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                                Reviewed by {{ $appeal->reviewer->name }}
                            </p>
                            <p class="text-xs text-gray-500">
                                {{ $appeal->reviewed_at->format('M j, Y \a\t g:i A') }}
                            </p>
                        @endif
                    </div>
                </div>

                <!-- Review Form -->
                @if($appeal->canBeReviewed())
                    <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Review Appeal</h3>
                        
                        <form method="POST" action="{{ route('staff.admission.appeal.update-status', $appeal->id) }}">
                            @csrf
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Decision</label>
                                    <select name="status" required class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-slate-700 dark:text-white">
                                        <option value="">Select Decision</option>
                                        <option value="under_review">Mark Under Review</option>
                                        <option value="approved">Approve Appeal</option>
                                        <option value="rejected">Reject Appeal</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Response/Notes</label>
                                    <textarea name="admin_response" rows="4" 
                                              class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-slate-700 dark:text-white"
                                              placeholder="Provide feedback or explanation for your decision..."></textarea>
                                </div>
                                
                                <button type="submit" 
                                        class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium">
                                    Submit Review
                                </button>
                            </div>
                        </form>
                    </div>
                @endif

                <!-- Previous Response (if completed) -->
                @if($appeal->isCompleted() && $appeal->admin_response)
                    <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-6">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Admin Response</h3>
                        <div class="bg-gray-50 dark:bg-slate-700 p-4 rounded-lg">
                            <p class="text-gray-900 dark:text-white whitespace-pre-wrap">{{ $appeal->admin_response }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>

</x-layouts.app>