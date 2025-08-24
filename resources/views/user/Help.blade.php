<x-layouts.app title="Help">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Help & Support') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="text-center mb-12">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                    Frequently Asked Questions
                </h1>
                <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                    Find answers to common questions about our programme recommendation system
                </p>
            </div>

            <!-- FAQ Section -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden">
                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                    
                    <!-- FAQ Item 1 -->
                    <div class="p-8 hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors duration-200">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-3 flex items-start gap-3">
                            <span class="flex-shrink-0 w-6 h-6 bg-blue-100 dark:bg-blue-900/50 text-blue-600 dark:text-blue-400 rounded-full flex items-center justify-center text-sm font-bold">1</span>
                            Who can use this website?
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 leading-relaxed ml-9">
                            Any student who has completed their O' Level, A' Level, or HNTec qualifications and is looking for the right programme to pursue further studies.
                        </p>
                    </div>

                    <!-- FAQ Item 2 -->
                    <div class="p-8 hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors duration-200">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-3 flex items-start gap-3">
                            <span class="flex-shrink-0 w-6 h-6 bg-emerald-100 dark:bg-emerald-900/50 text-emerald-600 dark:text-emerald-400 rounded-full flex items-center justify-center text-sm font-bold">2</span>
                            Do I have to pay to get programme recommendation?
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 leading-relaxed ml-9">
                            No, but a user must create an account and upload their O' Level, A' Level, or HNTec result to get their programme recommendation.
                        </p>
                    </div>

                    <!-- FAQ Item 3 -->
                    <div class="p-8 hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors duration-200">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-3 flex items-start gap-3">
                            <span class="flex-shrink-0 w-6 h-6 bg-amber-100 dark:bg-amber-900/50 text-amber-600 dark:text-amber-400 rounded-full flex items-center justify-center text-sm font-bold">3</span>
                            What are the entry requirements for Politeknik Brunei?
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 leading-relaxed ml-9">
                            Entry requirements vary by programme. Please check individual programme details or contact our admissions office for specific requirements.
                        </p>
                    </div>

                    <!-- FAQ Item 4 -->
                    <div class="p-8 hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors duration-200">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-3 flex items-start gap-3">
                            <span class="flex-shrink-0 w-6 h-6 bg-purple-100 dark:bg-purple-900/50 text-purple-600 dark:text-purple-400 rounded-full flex items-center justify-center text-sm font-bold">4</span>
                            Can I change my selected programme later?
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 leading-relaxed ml-9">
                            Yes, you can update your preferences anytime in your account settings.
                        </p>
                    </div>

                    <!-- FAQ Item 5 -->
                    <div class="p-8 hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors duration-200">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-3 flex items-start gap-3">
                            <span class="flex-shrink-0 w-6 h-6 bg-rose-100 dark:bg-rose-900/50 text-rose-600 dark:text-rose-400 rounded-full flex items-center justify-center text-sm font-bold">5</span>
                            Is my data secure?
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 leading-relaxed ml-9">
                            All personal data is encrypted and only used for providing recommendations. We follow strict privacy policies to protect your information.
                        </p>
                    </div>

                    <!-- FAQ Item 6 -->
                    <div class="p-8 hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors duration-200">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-3 flex items-start gap-3">
                            <span class="flex-shrink-0 w-6 h-6 bg-indigo-100 dark:bg-indigo-900/50 text-indigo-600 dark:text-indigo-400 rounded-full flex items-center justify-center text-sm font-bold">6</span>
                            Do I need an account to use this service?
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 leading-relaxed ml-9">
                            Yes, creating an account allows you to save your preferences, track your progress, and receive personalized recommendations.
                        </p>
                    </div>

                    <!-- FAQ Item 7 -->
                    <div class="p-8 hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors duration-200">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-3 flex items-start gap-3">
                            <span class="flex-shrink-0 w-6 h-6 bg-teal-100 dark:bg-teal-900/50 text-teal-600 dark:text-teal-400 rounded-full flex items-center justify-center text-sm font-bold">7</span>
                            Can I get advice for multiple programmes?
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 leading-relaxed ml-9">
                            Yes, you can explore recommendations for several fields or courses and compare them to make the best decision for your future.
                        </p>
                    </div>

                    <!-- FAQ Item 8 -->
                    <div class="p-8 hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors duration-200">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-3 flex items-start gap-3">
                            <span class="flex-shrink-0 w-6 h-6 bg-cyan-100 dark:bg-cyan-900/50 text-cyan-600 dark:text-cyan-400 rounded-full flex items-center justify-center text-sm font-bold">8</span>
                            Are recommendations updated regularly?
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 leading-relaxed ml-9">
                            We update our programme database regularly to ensure you get the latest options and most accurate information available.
                        </p>
                    </div>

                    <!-- FAQ Item 9 -->
                    <div class="p-8 hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors duration-200">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-3 flex items-start gap-3">
                            <span class="flex-shrink-0 w-6 h-6 bg-orange-100 dark:bg-orange-900/50 text-orange-600 dark:text-orange-400 rounded-full flex items-center justify-center text-sm font-bold">9</span>
                            Can I share my recommended programmes?
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 leading-relaxed ml-9">
                            Yes, you can share your recommendations with friends, family, or mentors to get their input on your educational choices.
                        </p>
                    </div>

                    <!-- FAQ Item 10 -->
                    <div class="p-8 hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors duration-200">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-3 flex items-start gap-3">
                            <span class="flex-shrink-0 w-6 h-6 bg-slate-100 dark:bg-slate-900/50 text-slate-600 dark:text-slate-400 rounded-full flex items-center justify-center text-sm font-bold">10</span>
                            Who can I contact for support?
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 leading-relaxed ml-9">
                            You can reach our support team via the contact page for any help, or use the feedback system for suggestions and issues.
                        </p>
                    </div>

                </div>
            </div>

            <!-- Contact Section -->
            <div class="mt-12 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-2xl p-8 text-center border border-blue-200 dark:border-blue-800/50">
                <h3 class="text-xl font-semibold text-blue-900 dark:text-blue-100 mb-3">
                    Still have questions?
                </h3>
                <p class="text-blue-700 dark:text-blue-300 mb-6">
                    Our support team is here to help you with any questions or concerns.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Contact Support
                    </a>
                    <a href="#" class="inline-flex items-center px-6 py-3 bg-white dark:bg-gray-700 border border-blue-300 dark:border-blue-600 text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-gray-600 rounded-lg font-medium transition-colors duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                        Give Feedback
                    </a>
                </div> 
            </div>
        </div> 
    </div>
</x-layouts.app>