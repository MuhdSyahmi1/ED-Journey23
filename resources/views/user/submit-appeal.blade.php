<x-layouts.app title="Submit Appeal">

<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-slate-900 dark:to-slate-800 py-6">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Submit Appeal</h1>
            <p class="text-lg text-gray-600 dark:text-gray-300">Appeal your rejected application</p>
        </div>

        <!-- Application Details -->
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-6 mb-8">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Application Details</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Programme Applied</label>
                    <p class="text-gray-900 dark:text-white font-medium">
                        {{ $application->schoolProgramme->diplomaProgramme->name }}
                    </p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">School</label>
                    <p class="text-gray-900 dark:text-white">
                        {{ ucfirst($application->schoolProgramme->school) }} School
                    </p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Application Status</label>
                    <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs font-medium">
                        {{ ucfirst($application->status) }}
                    </span>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Application Date</label>
                    <p class="text-gray-900 dark:text-white">{{ $application->applied_at->format('F j, Y') }}</p>
                </div>
                @if($application->review_notes)
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-500 dark:text-gray-400">Review Notes</label>
                    <p class="text-gray-900 dark:text-white bg-gray-50 dark:bg-slate-700 p-3 rounded mt-1">
                        {{ $application->review_notes }}
                    </p>
                </div>
                @endif
            </div>
        </div>

        <!-- Appeal Guidelines -->
        <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-700 rounded-lg p-6 mb-8">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-yellow-800 dark:text-yellow-200">Appeal Guidelines</h3>
                    <ul class="mt-2 text-sm text-yellow-700 dark:text-yellow-300 list-disc list-inside space-y-1">
                        <li>Provide a detailed explanation for why you believe the decision should be reconsidered</li>
                        <li>Include any new information or circumstances that weren't available during the initial review</li>
                        <li>Upload supporting documents (transcripts, certificates, medical records, etc.)</li>
                        <li>Appeals are reviewed by admission managers within 5-7 business days</li>
                        <li>You can only submit one appeal per rejected application</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Appeal Form -->
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-6">
            <form method="POST" action="{{ route('user.appeals.store', $application->id) }}" enctype="multipart/form-data">
                @csrf
                
                <!-- Appeal Reason -->
                <div class="mb-6">
                    <label for="appeal_reason" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Appeal Reason <span class="text-red-500">*</span>
                    </label>
                    <textarea id="appeal_reason" 
                              name="appeal_reason" 
                              rows="8" 
                              required
                              class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-slate-700 dark:text-white"
                              placeholder="Please provide a detailed explanation for why you believe your application should be reconsidered. Include any new information, changed circumstances, or additional qualifications that weren't available during the initial review.">{{ old('appeal_reason') }}</textarea>
                    @error('appeal_reason')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Minimum 50 characters, maximum 2000 characters</p>
                </div>

                <!-- Supporting Documents -->
                <div class="mb-6">
                    <label for="supporting_documents" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Supporting Documents (Optional)
                    </label>
                    <input type="file" 
                           id="supporting_documents" 
                           name="supporting_documents[]" 
                           multiple
                           accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                           class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-slate-700 dark:text-white">
                    @error('supporting_documents.*')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                        Upload relevant documents that support your appeal (PDF, DOC, DOCX, JPG, PNG). Maximum 5MB per file.
                    </p>
                </div>

                <!-- Character Counter -->
                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const textarea = document.getElementById('appeal_reason');
                    const counter = document.getElementById('char-counter');
                    
                    function updateCounter() {
                        const length = textarea.value.length;
                        counter.textContent = `${length}/2000 characters`;
                        
                        if (length < 50) {
                            counter.className = 'text-xs text-red-500';
                        } else if (length > 1800) {
                            counter.className = 'text-xs text-yellow-500';
                        } else {
                            counter.className = 'text-xs text-green-500';
                        }
                    }
                    
                    textarea.addEventListener('input', updateCounter);
                    updateCounter();
                });
                </script>
                <div id="char-counter" class="text-xs text-gray-500 mb-4"></div>

                <!-- Form Actions -->
                <div class="flex items-center justify-between">
                    <a href="{{ route('user.my-applications') }}" 
                       class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium">
                        Submit Appeal
                    </button>
                </div>
            </form>
        </div>

        <!-- Additional Information -->
        <div class="mt-8 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-700 rounded-lg p-6">
            <h4 class="text-sm font-medium text-blue-800 dark:text-blue-200 mb-2">What happens next?</h4>
            <ol class="text-sm text-blue-700 dark:text-blue-300 list-decimal list-inside space-y-1">
                <li>Your appeal will be submitted and you'll receive a confirmation</li>
                <li>An admission manager will review your appeal within 5-7 business days</li>
                <li>You'll be notified via email once a decision has been made</li>
                <li>If approved, your application status will be updated to "Accepted"</li>
            </ol>
        </div>

    </div>
</div>

</x-layouts.app>