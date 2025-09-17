<x-layouts.app title="Academic Advisor - Results">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Academic Advisor Results') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 dark:from-slate-900 dark:to-blue-950 transition-colors duration-300">
        <div class="p-6">
            <div class="max-w-4xl mx-auto space-y-6">
                
                <!-- Header Card -->
                <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden">
                    <div class="bg-gradient-to-r from-green-500/90 to-emerald-500/90 text-white text-center py-6">
                        <h1 class="text-3xl font-bold mb-2">Your Academic Recommendation</h1>
                        <p class="text-green-100">Based on our AI-powered conversation on {{ $session->completed_at->format('F j, Y \a\t g:i A') }}</p>
                    </div>
                </div>

                <!-- Recommended School Card -->
                <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden">
                    <div class="p-8 text-center">
                        <div class="w-20 h-20 mx-auto mb-4 bg-gradient-to-r from-green-500 to-emerald-500 rounded-full flex items-center justify-center">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-slate-900 dark:text-slate-100 mb-2">Recommended School</h2>
                        <p class="text-3xl font-bold text-green-600 dark:text-green-400 mb-4">
                            {{ $schoolNames[$session->recommended_school] ?? $session->recommended_school }}
                        </p>
                        
                        @if(!empty($session->user_preferences['reasoning']))
                            <div class="bg-green-50 dark:bg-green-900/20 rounded-xl p-6 mt-6">
                                <h3 class="text-lg font-semibold text-green-800 dark:text-green-200 mb-3">Why This School?</h3>
                                <p class="text-green-700 dark:text-green-300 text-left">{{ $session->user_preferences['reasoning'] }}</p>
                            </div>
                        @endif
                        
                        @if(!empty($session->user_preferences['confidence']))
                            <div class="mt-4">
                                <div class="flex items-center justify-center gap-2">
                                    <span class="text-sm font-medium text-slate-600 dark:text-slate-400">Confidence Level:</span>
                                    <div class="flex items-center gap-1">
                                        <div class="w-32 bg-slate-200 dark:bg-slate-700 rounded-full h-2">
                                            <div class="bg-gradient-to-r from-green-500 to-emerald-500 h-2 rounded-full" 
                                                 style="width: {{ $session->user_preferences['confidence'] }}%"></div>
                                        </div>
                                        <span class="text-sm font-bold text-green-600 dark:text-green-400">{{ $session->user_preferences['confidence'] }}%</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                @if($session->school_scores)
                <!-- Detailed Scores -->
                <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden">
                    <div class="p-6 border-b border-slate-200/60 dark:border-slate-700/60">
                        <h3 class="text-xl font-bold text-slate-900 dark:text-slate-100">How You Match With Each School</h3>
                        <p class="text-slate-600 dark:text-slate-400">Based on your interests, strengths, and career goals</p>
                    </div>
                    <div class="p-6">
                        @php
                            $maxScore = max(array_values($session->school_scores));
                            $schoolColors = [
                                'SICT' => 'from-purple-500 to-violet-500',
                                'SHS' => 'from-red-500 to-rose-500',
                                'SSE' => 'from-blue-500 to-indigo-500',
                                'SPC' => 'from-amber-500 to-orange-500',
                                'SBS' => 'from-green-500 to-emerald-500'
                            ];
                        @endphp

                        <div class="space-y-4">
                            @foreach($session->school_scores as $schoolCode => $score)
                                @php
                                    $percentage = $maxScore > 0 ? ($score / $maxScore) * 100 : 0;
                                    $isRecommended = $schoolCode === $session->recommended_school;
                                @endphp
                                <div class="relative">
                                    <div class="flex justify-between items-center mb-2">
                                        <div class="flex items-center gap-2">
                                            <span class="font-semibold text-slate-900 dark:text-slate-100">
                                                {{ $schoolNames[$schoolCode] ?? $schoolCode }}
                                            </span>
                                            @if($isRecommended)
                                                <span class="bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-200 text-xs font-medium px-2 py-1 rounded-full">
                                                    Recommended
                                                </span>
                                            @endif
                                        </div>
                                        <span class="font-bold text-lg text-slate-900 dark:text-slate-100">{{ $score }}/100</span>
                                    </div>
                                    <div class="w-full bg-slate-200 dark:bg-slate-700 rounded-full h-3">
                                        <div class="bg-gradient-to-r {{ $schoolColors[$schoolCode] ?? 'from-slate-500 to-slate-600' }} h-3 rounded-full transition-all duration-1000 ease-out" 
                                             style="width: {{ $percentage }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                <!-- Conversation Summary -->
                <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden">
                    <div class="p-6 border-b border-slate-200/60 dark:border-slate-700/60">
                        <h3 class="text-xl font-bold text-slate-900 dark:text-slate-100">Conversation Summary</h3>
                        <p class="text-slate-600 dark:text-slate-400">Your discussion with the Academic Advisor</p>
                    </div>
                    <div class="p-6 max-h-64 overflow-y-auto">
                        <div class="space-y-3">
                            @foreach($session->messages->take(6) as $message)
                                <div class="flex {{ $message->role === 'user' ? 'justify-end' : 'justify-start' }}">
                                    <div class="max-w-sm">
                                        @if($message->role === 'user')
                                            <div class="bg-blue-50 dark:bg-blue-900/20 text-blue-800 dark:text-blue-200 rounded-lg p-3 text-sm">
                                                <strong>You:</strong> {{ Str::limit($message->message, 100) }}
                                            </div>
                                        @else
                                            <div class="bg-slate-100 dark:bg-slate-700 text-slate-800 dark:text-slate-200 rounded-lg p-3 text-sm">
                                                <strong>Advisor:</strong> {{ Str::limit($message->message, 100) }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                            
                            @if($session->messages->count() > 6)
                                <div class="text-center">
                                    <span class="text-sm text-slate-500 dark:text-slate-400">
                                        ... and {{ $session->messages->count() - 6 }} more messages
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Next Steps -->
                <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden">
                    <div class="p-6 border-b border-slate-200/60 dark:border-slate-700/60">
                        <h3 class="text-xl font-bold text-slate-900 dark:text-slate-100">What's Next?</h3>
                    </div>
                    <div class="p-6">
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div class="flex items-start gap-4">
                                    <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center flex-shrink-0">
                                        <span class="text-blue-600 dark:text-blue-400 font-bold">1</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-slate-900 dark:text-slate-100">Explore School Details</h4>
                                        <p class="text-slate-600 dark:text-slate-400 text-sm">Learn more about the programmes offered by your recommended school.</p>
                                        <a href="{{ route('user.school') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 text-sm font-medium mt-1 inline-block">
                                            View Schools →
                                        </a>
                                    </div>
                                </div>

                                <div class="flex items-start gap-4">
                                    <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center flex-shrink-0">
                                        <span class="text-green-600 dark:text-green-400 font-bold">2</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-slate-900 dark:text-slate-100">Upload Your Results</h4>
                                        <p class="text-slate-600 dark:text-slate-400 text-sm">Upload your academic results to get specific programme recommendations.</p>
                                        <a href="{{ route('user.upload-result') }}" class="text-green-600 dark:text-green-400 hover:text-green-800 dark:hover:text-green-300 text-sm font-medium mt-1 inline-block">
                                            Upload Results →
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div class="flex items-start gap-4">
                                    <div class="w-8 h-8 bg-purple-100 dark:bg-purple-900/30 rounded-full flex items-center justify-center flex-shrink-0">
                                        <span class="text-purple-600 dark:text-purple-400 font-bold">3</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-slate-900 dark:text-slate-100">Get More Advice</h4>
                                        <p class="text-slate-600 dark:text-slate-400 text-sm">Have more questions? Start a new conversation with our Academic Advisor.</p>
                                        <a href="{{ route('user.academic-advisor.new') }}" class="text-purple-600 dark:text-purple-400 hover:text-purple-800 dark:hover:text-purple-300 text-sm font-medium mt-1 inline-block">
                                            New Conversation →
                                        </a>
                                    </div>
                                </div>

                                <div class="flex items-start gap-4">
                                    <div class="w-8 h-8 bg-orange-100 dark:bg-orange-900/30 rounded-full flex items-center justify-center flex-shrink-0">
                                        <span class="text-orange-600 dark:text-orange-400 font-bold">4</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-slate-900 dark:text-slate-100">HECAS Information</h4>
                                        <p class="text-slate-600 dark:text-slate-400 text-sm">Learn about the Higher Education Application Centre of Admission Services.</p>
                                        <a href="{{ route('user.hecas-info') }}" class="text-orange-600 dark:text-orange-400 hover:text-orange-800 dark:hover:text-orange-300 text-sm font-medium mt-1 inline-block">
                                            Learn More →
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-wrap gap-4 justify-center">
                    <a href="{{ route('user.academic-advisor.new') }}" 
                       class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200">
                        Ask More Questions
                    </a>
                    <a href="{{ route('user.school') }}" 
                       class="bg-green-500 hover:bg-green-600 text-white font-semibold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200">
                        Explore Schools
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>