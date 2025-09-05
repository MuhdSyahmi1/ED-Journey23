<x-layouts.app title="Questionnaire - results">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Questionnaire Results') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 dark:from-slate-900 dark:to-blue-950 transition-colors duration-300">
        <div class="p-6">
            <div class="max-w-4xl mx-auto space-y-6">
                
                <!-- Header Card -->
                <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden">
                    <div class="bg-gradient-to-r from-green-500/90 to-emerald-500/90 text-white text-center py-6">
                        <h1 class="text-3xl font-bold mb-2">Your Questionnaire Results</h1>
                        <p class="text-green-100">Completed on {{ \Carbon\Carbon::parse($response->completed_at)->format('F j, Y \a\t g:i A') }}</p>
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
                            @php
                                $schoolNames = [
                                    'SICT' => 'School of Information & Communication Technology',
                                    'SHS' => 'School of Health Sciences',
                                    'SSE' => 'School of Science & Engineering',
                                    'SPC' => 'School of Process & Chemical',
                                    'SBS' => 'School of Business'
                                ];
                            @endphp
                            {{ $schoolNames[$response->recommended_school] ?? $response->recommended_school }}
                        </p>
                        <p class="text-slate-600 dark:text-slate-400 max-w-2xl mx-auto">
                            Based on your responses, this school aligns best with your interests, skills, and career goals.
                        </p>
                    </div>
                </div>

                <!-- Detailed Scores -->
                <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden">
                    <div class="p-6 border-b border-slate-200/60 dark:border-slate-700/60">
                        <h3 class="text-xl font-bold text-slate-900 dark:text-slate-100">Detailed School Scores</h3>
                        <p class="text-slate-600 dark:text-slate-400">See how well each school matches your profile</p>
                    </div>
                    <div class="p-6">
                        @php
                            $maxScore = max(array_values($scores));
                            $schoolNames = [
                                'SICT' => 'School of Information & Communication Technology',
                                'SHS' => 'School of Health Sciences',
                                'SSE' => 'School of Science & Engineering',
                                'SPC' => 'School of Process & Chemical',
                                'SBS' => 'School of Business'
                            ];
                            $schoolColors = [
                                'SICT' => 'from-purple-500 to-violet-500',
                                'SHS' => 'from-red-500 to-rose-500',
                                'SSE' => 'from-blue-500 to-indigo-500',
                                'SPC' => 'from-amber-500 to-orange-500',
                                'SBS' => 'from-green-500 to-emerald-500'
                            ];
                        @endphp

                        <div class="space-y-4">
                            @foreach($scores as $school => $score)
                                @php
                                    $percentage = $maxScore > 0 ? ($score / $maxScore) * 100 : 0;
                                    $isRecommended = $school === $response->recommended_school;
                                @endphp
                                <div class="relative">
                                    <div class="flex justify-between items-center mb-2">
                                        <div class="flex items-center gap-2">
                                            <span class="font-semibold text-slate-900 dark:text-slate-100">
                                                {{ $schoolNames[$school] }}
                                            </span>
                                            @if($isRecommended)
                                                <span class="bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-200 text-xs font-medium px-2 py-1 rounded-full">
                                                    Recommended
                                                </span>
                                            @endif
                                        </div>
                                        <span class="font-bold text-lg text-slate-900 dark:text-slate-100">{{ $score }}</span>
                                    </div>
                                    <div class="w-full bg-slate-200 dark:bg-slate-700 rounded-full h-3">
                                        <div class="bg-gradient-to-r {{ $schoolColors[$school] }} h-3 rounded-full transition-all duration-1000 ease-out" 
                                             style="width: {{ $percentage }}%"></div>
                                    </div>
                                </div>
                            @endforeach
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
                                        <p class="text-slate-600 dark:text-slate-400 text-sm">Upload your academic results to get personalized recommendations.</p>
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
                                        <h4 class="font-semibold text-slate-900 dark:text-slate-100">Get Recommendations</h4>
                                        <p class="text-slate-600 dark:text-slate-400 text-sm">Receive detailed programme recommendations based on your profile.</p>
                                        <a href="{{ route('user.recommendations') }}" class="text-purple-600 dark:text-purple-400 hover:text-purple-800 dark:hover:text-purple-300 text-sm font-medium mt-1 inline-block">
                                            Get Recommendations →
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
                    <a href="{{ route('user.questionnaire.retake') }}" 
                       class="bg-slate-500 hover:bg-slate-600 text-white font-semibold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200">
                        Retake Questionnaire
                    </a>
                    <a href="{{ route('user.school') }}" 
                       class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200">
                        Explore Schools
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>