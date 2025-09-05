<x-layouts.app title="Questionnaire">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Complete Questionnaire') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 dark:from-slate-900 dark:to-blue-950 transition-colors duration-300" x-data="questionnaire()">
        <div class="p-6">
            <div class="max-w-4xl mx-auto">
                
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

                <!-- Header -->
                <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden mb-8">
                    <div class="bg-gradient-to-r from-red-500/90 to-pink-500/90 text-white text-center py-4">
                        <h1 class="text-2xl font-bold">COMPLETE QUESTIONNAIRE</h1>
                    </div>
                </div>

                <!-- Intro Section -->
                <div x-show="!showQuestions && !showReview && !showResults" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform scale-95"
                     x-transition:enter-end="opacity-100 transform scale-100"
                     class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 p-8 text-center">
                    <div class="mb-6">
                        <svg class="w-20 h-20 mx-auto mb-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <p class="text-lg text-slate-700 dark:text-slate-300 mb-8 max-w-2xl mx-auto">
                        Help us understand your interests by completing these questions, and we'll match you with the perfect programmes!
                    </p>
                    <button @click="startQuestionnaire()" 
                            class="bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 text-white font-semibold py-3 px-8 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200">
                        START QUESTIONNAIRE
                    </button>
                </div>

                <!-- Questions Section -->
                <div x-show="showQuestions" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform scale-95"
                     x-transition:enter-end="opacity-100 transform scale-100"
                     class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden"
                     style="display: none;">
                    
                    <!-- Progress Bar -->
                    <div class="p-6 border-b border-slate-200/60 dark:border-slate-700/60">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Progress</span>
                            <span class="text-sm font-medium text-green-600 dark:text-green-400" x-text="Math.round(progress) + '%'"></span>
                        </div>
                        <div class="w-full bg-slate-200 dark:bg-slate-700 rounded-full h-3">
                            <div class="bg-gradient-to-r from-green-500 to-emerald-500 h-3 rounded-full transition-all duration-500 ease-out" 
                                 :style="`width: ${progress}%`"></div>
                        </div>
                    </div>

                    <!-- Question Content -->
                    <div class="p-8">
                        <div class="text-center mb-8">
                            <h3 class="text-2xl font-bold text-red-500 mb-4" x-text="`Question ${currentQuestion + 1}`"></h3>
                            <p class="text-lg text-slate-700 dark:text-slate-300" x-text="questions[currentQuestion]?.question"></p>
                        </div>

                        <!-- Options -->
                        <div class="max-w-2xl mx-auto space-y-3">
                            <template x-for="(option, index) in questions[currentQuestion]?.options || []" :key="index">
                                <button @click="selectOption(index)" 
                                        :class="selectedOptions[currentQuestion]?.includes(index) 
                                               ? 'bg-red-500 text-white border-red-500' 
                                               : 'bg-white dark:bg-slate-700 text-slate-700 dark:text-slate-300 border-red-300 dark:border-red-700 hover:bg-red-50 dark:hover:bg-red-900/20'"
                                        class="w-full p-4 rounded-xl border-2 text-left font-medium transition-all duration-200 transform hover:scale-[1.02] shadow-sm hover:shadow-md">
                                    <span x-text="option.text"></span>
                                </button>
                            </template>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="p-6 border-t border-slate-200/60 dark:border-slate-700/60 bg-slate-50/50 dark:bg-slate-700/30">
                        <div class="flex justify-between items-center">
                            <button @click="prevQuestion()" 
                                    x-show="currentQuestion > 0"
                                    class="bg-slate-500 hover:bg-slate-600 text-white font-semibold py-2 px-6 rounded-lg transition-colors duration-200">
                                Previous
                            </button>
                            <div x-show="currentQuestion === 0"></div>
                            
                            <div class="flex gap-3">
                                <button @click="nextQuestion()" 
                                        x-show="currentQuestion < totalQuestions - 1"
                                        class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-6 rounded-lg transition-colors duration-200">
                                    Next
                                </button>
                                <button @click="reviewAnswers()" 
                                        x-show="currentQuestion === totalQuestions - 1"
                                        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-6 rounded-lg transition-colors duration-200">
                                    Review Answers
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Review Section -->
                <div x-show="showReview" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform scale-95"
                     x-transition:enter-end="opacity-100 transform scale-100"
                     class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden"
                     style="display: none;">
                    
                    <div class="p-6 border-b border-slate-200/60 dark:border-slate-700/60">
                        <h3 class="text-2xl font-bold text-red-500">Review Your Answers</h3>
                    </div>

                    <div class="p-6 space-y-6 max-h-96 overflow-y-auto">
                        <template x-for="(question, qIndex) in questions" :key="qIndex">
                            <div class="border border-slate-200 dark:border-slate-600 rounded-lg p-4">
                                <p class="font-semibold text-slate-900 dark:text-slate-100 mb-3" x-text="`${qIndex + 1}. ${question.question}`"></p>
                                <div class="space-y-2">
                                    <template x-for="optionIndex in selectedOptions[qIndex] || []" :key="optionIndex">
                                        <div class="bg-red-50 dark:bg-red-900/20 text-red-800 dark:text-red-200 px-3 py-2 rounded-lg">
                                            <span x-text="question.options[optionIndex]?.text"></span>
                                        </div>
                                    </template>
                                </div>
                                <button @click="editQuestion(qIndex)" 
                                        class="mt-3 text-red-500 hover:text-red-700 text-sm font-medium">
                                    Edit Answer
                                </button>
                            </div>
                        </template>
                    </div>

                    <div class="p-6 border-t border-slate-200/60 dark:border-slate-700/60 bg-slate-50/50 dark:bg-slate-700/30">
                        <div class="flex justify-between items-center">
                            <button @click="backToQuestions()" 
                                    class="bg-slate-500 hover:bg-slate-600 text-white font-semibold py-2 px-6 rounded-lg transition-colors duration-200">
                                Back to Questions
                            </button>
                            <button @click="submitQuestionnaire()" 
                                    class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-6 rounded-lg transition-colors duration-200">
                                Submit Questionnaire
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Results Section -->
                <div x-show="showResults" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform scale-95"
                     x-transition:enter-end="opacity-100 transform scale-100"
                     class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden"
                     style="display: none;">
                    
                    <div class="p-6 border-b border-slate-200/60 dark:border-slate-700/60">
                        <h3 class="text-2xl font-bold text-green-500">Your Results</h3>
                    </div>

                    <div class="p-6">
                        <div class="mb-6">
                            <h4 class="text-lg font-semibold text-slate-900 dark:text-slate-100 mb-4">School Scores:</h4>
                            <div class="space-y-3">
                                <template x-for="(score, school) in scores" :key="school">
                                    <div class="flex justify-between items-center p-3 bg-slate-50 dark:bg-slate-700 rounded-lg">
                                        <span class="font-medium text-slate-700 dark:text-slate-300" x-text="getSchoolName(school)"></span>
                                        <span class="font-bold text-lg text-slate-900 dark:text-slate-100" x-text="score"></span>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <div class="p-6 bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-xl border-2 border-green-200 dark:border-green-700">
                            <h4 class="text-lg font-semibold text-green-800 dark:text-green-200 mb-2">Recommended School:</h4>
                            <p class="text-xl font-bold text-green-600 dark:text-green-400" x-text="getSchoolName(recommendedSchool)"></p>
                        </div>
                    </div>

                    <div class="p-6 border-t border-slate-200/60 dark:border-slate-700/60 bg-slate-50/50 dark:bg-slate-700/30">
                        <button @click="resetQuestionnaire()" 
                                class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-6 rounded-lg transition-colors duration-200">
                            Retake Questionnaire
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function questionnaire() {
            return {
                showQuestions: false,
                showReview: false,
                showResults: false,
                currentQuestion: 0,
                totalQuestions: 10,
                selectedOptions: Array(10).fill(null).map(() => []),
                scores: { SICT: 0, SHS: 0, SSE: 0, SPC: 0, SBS: 0 },
                recommendedSchool: '',
                
                questions: [
                    {
                        question: "What areas are you interested in pursuing long-term? (You may choose more than one)",
                        options: [
                            { text: "Healthcare & Medical Sciences", score: { SHS: 3 } },
                            { text: "Business, Accounting & Finance", score: { SBS: 3 } },
                            { text: "Information Technology & Software development", score: { SICT: 3 } },
                            { text: "Creative Fields (Design, Media, Arts)", score: { SICT: 3, SSE: 3 } },
                            { text: "Engineering & Technical Fields", score: { SSE: 3 } },
                            { text: "Applied Sciences & Technology", score: { SPC: 3 } },
                            { text: "Still exploring", score: {} }
                        ],
                        multiple: true
                    },
                    {
                        question: "What are your career goals? (You may choose more than one)",
                        options: [
                            { text: "To become a doctor, nurse, or healthcare professional", score: { SHS: 3 } },
                            { text: "To start my own business or become an entrepreneur", score: { SBS: 3 } },
                            { text: "To work in the technology industry as a developer or programmer", score: { SICT: 3 } },
                            { text: "To work in the creative industry as a designer or artist", score: { SICT: 3, SSE: 3 } },
                            { text: "To become an engineer or work in the technical field", score: { SSE: 3 } },
                            { text: "To work in the field of applied sciences or technology", score: { SPC: 3 } },
                            { text: "I am still exploring my career options", score: {} }
                        ],
                        multiple: true
                    },
                    {
                        question: "What skills do you enjoy or want to excel at? (You may choose more than one)",
                        options: [
                            { text: "Managing finance, analysing numbers", score: { SBS: 3 } },
                            { text: "Marketing, entrepreneurship, leadership", score: { SBS: 3 } },
                            { text: "Coding, programming, software development", score: { SICT: 3 } },
                            { text: "Data analysis, AI, cybersecurity", score: { SICT: 3 } },
                            { text: "Graphic design, digital content creation", score: { SICT: 3 } },
                            { text: "Caring for patients, medical field", score: { SHS: 3 } },
                            { text: "Engineering, problem-solving, technical design", score: { SSE: 3 } },
                            { text: "Scientific research, experiments", score: { SPC: 3 } },
                        ],
                        multiple: true
                    },
                    {
                        question: "What are your interests outside of school? (You may choose more than one)",
                        options: [
                            { text: "Reading, writing, or storytelling", score: { SICT: 2, SSE: 1, SBS: 1 } },
                            { text: "Playing video games, coding, or digital art", score: { SICT: 2, SSE: 2 } },
                            { text: "Sports, fitness, or outdoor activities", score: { SHS: 2, SSE: 1 } },
                            { text: "Music, dance, or performing arts", score: { SICT: 1, SSE: 2 } },
                            { text: "Volunteering, community service, or social causes", score: { SBS: 1, SHS: 1 } },
                            { text: "Traveling, exploring new places, or trying new things", score: { SBS: 1, SHS: 1 } },
                            { text: "Cooking, baking, or food-related activities", score: { SBS: 1, SHS: 1 } },
                            { text: "I prefer indoor activities like reading, gaming, or watching movies", score: { SICT: 1, SSE: 1 } },
                            { text: "Scientific research, experiments, or technology-related activities", score: { SPC: 3 } }
                        ],
                        multiple: true
                    },
                    {
                        question: "What kind of learning environment do you prefer?",
                        options: [
                            { text: "Collaborative projects with teamwork", score: { SICT: 1, SSE: 1, SBS: 1, SHS: 1 } },
                            { text: "Independent assignments and research", score: { SBS: 1, SICT: 1, SPC: 1 } },
                            { text: "I like a mix of both", score: { SICT: 1, SSE: 1, SBS: 1, SHS: 1, SPC: 1 } }
                        ],
                        multiple: false
                    },
                    {
                        question: "What are your strongest subjects in school? (You may choose more than one)",
                        options: [
                            { text: "Science (Biology, Chemistry, Physics)", score: { SHS: 2, SSE: 1, SPC: 2 } },
                            { text: "Mathematics", score: { SICT: 2, SSE: 2, SBS: 2, SHS: 1, SPC: 1 } },
                            { text: "Languages (English, Malay, etc.)", score: { SSE: 2, SBS: 1, SICT: 1, SPC: 1, SHS: 1 } },
                            { text: "Business & Economics", score: { SBS: 2, SICT: 1 } },
                            { text: "Technical & Vocational Subjects", score: { SSE: 2, SICT: 1, SPC: 1 } }
                        ],
                        multiple: true
                    },
                    {
                        question: "How do you prefer to solve problems? (You may choose more than one)",
                        options: [
                            { text: "Through logical reasoning and analysis", score: { SICT: 2, SSE: 2 } },
                            { text: "Through creativity and innovation", score: { SICT: 2, SSE: 1 } },
                            { text: "Through practical experimentation", score: { SSE: 2, SPC: 2 } },
                            { text: "Through research and theoretical study", score: { SHS: 2, SBS: 2 } }
                        ],
                        multiple: true
                    },
                    {
                        question: "Are you comfortable with subjects like biology, physics, chemistry, and mathematics?",
                        options: [
                            { text: "Yes, I enjoy and excel in them", score: { SSE: 3, SPC: 3, SICT: 2, SHS: 3 } },
                            { text: "I can manage, but I prefer other subjects", score: { SBS: 2, SICT: 1, SHS: 1, SSE: 1, SPC: 1 } },
                            { text: "No, I struggle with these subjects", score: {} }
                        ],
                        multiple: false
                    },
                    {
                        question: "Have you undergone a medical fitness test?",
                        options: [
                            { text: "Yes, and I meet the health requirements", score: { SHS: 3, SICT: 1, SBS: 1, SPC: 1, SSE: 1 } },
                            { text: "No, but I am planning to", score: { SHS: 2 } },
                            { text: "No, and I am unsure of my medical status", score: {} }
                        ],
                        multiple: false
                    },
                    {
                        question: "Do you have any of the following medical conditions? (Tick all that apply)",
                        options: [
                            { text: "Active Tuberculosis", score: { SHS: -1 } },
                            { text: "Acquired Immune Deficiency Syndrome (AIDS)/ HIV Positive", score: { SHS: -1 } },
                            { text: "Colour Blindness", score: { SHS: -1, SICT: -1 } },
                            { text: "Epilepsy", score: { SHS: -1 } },
                            { text: "HbsAg Positive or Hepatitis B Carrier", score: { SHS: -1 } },
                            { text: "Profound Deafness", score: { SHS: -1 } },
                            { text: "Psychiatric Conditions", score: { SHS: -1 } },
                            { text: "None of the above", score: {} }
                        ],
                        multiple: true
                    }
                ],

                get progress() {
                    const answeredQuestions = this.selectedOptions.filter(options => options.length > 0).length;
                    return (answeredQuestions / this.totalQuestions) * 100;
                },

                startQuestionnaire() {
                    this.showQuestions = true;
                },

                selectOption(optionIndex) {
                    const questionData = this.questions[this.currentQuestion];
                    const selected = this.selectedOptions[this.currentQuestion];

                    if (!questionData.multiple) {
                        // Single select - replace selection
                        this.selectedOptions[this.currentQuestion] = [optionIndex];
                    } else {
                        // Multiple select - toggle selection
                        const index = selected.indexOf(optionIndex);
                        if (index > -1) {
                            selected.splice(index, 1);
                        } else {
                            selected.push(optionIndex);
                        }
                    }
                },

                nextQuestion() {
                    if (this.selectedOptions[this.currentQuestion].length === 0) {
                        alert('Please select at least one option before proceeding.');
                        return;
                    }
                    if (this.currentQuestion < this.totalQuestions - 1) {
                        this.currentQuestion++;
                    }
                },

                prevQuestion() {
                    if (this.currentQuestion > 0) {
                        this.currentQuestion--;
                    }
                },

                reviewAnswers() {
                    this.showQuestions = false;
                    this.showReview = true;
                },

                backToQuestions() {
                    this.showReview = false;
                    this.showQuestions = true;
                },

                editQuestion(questionIndex) {
                    this.currentQuestion = questionIndex;
                    this.showReview = false;
                    this.showQuestions = true;
                },

                submitQuestionnaire() {
                    if (confirm('Are you sure you want to submit the questionnaire?')) {
                        this.calculateScores();
                        this.showReview = false;
                        this.showResults = true;
                        
                        // Submit to server
                        this.sendToServer();
                    }
                },

                calculateScores() {
                    // Reset scores
                    this.scores = { SICT: 0, SHS: 0, SSE: 0, SPC: 0, SBS: 0 };
                    
                    this.selectedOptions.forEach((selected, questionIndex) => {
                        const questionData = this.questions[questionIndex];
                        selected.forEach(optionIndex => {
                            const option = questionData.options[optionIndex];
                            for (const [category, score] of Object.entries(option.score)) {
                                this.scores[category] = (this.scores[category] || 0) + score;
                            }
                        });
                    });

                    // Find recommended school
                    this.recommendedSchool = Object.keys(this.scores).reduce((a, b) => 
                        this.scores[a] > this.scores[b] ? a : b
                    );
                },

                getSchoolName(schoolCode) {
                    const schoolNames = {
                        'SICT': 'School of Information & Communication Technology',
                        'SHS': 'School of Health Sciences',
                        'SSE': 'School of Science & Engineering',
                        'SPC': 'School of Process & Chemical',
                        'SBS': 'School of Business'
                    };
                    return schoolNames[schoolCode] || schoolCode;
                },

                resetQuestionnaire() {
                    this.showQuestions = false;
                    this.showReview = false;
                    this.showResults = false;
                    this.currentQuestion = 0;
                    this.selectedOptions = Array(10).fill(null).map(() => []);
                    this.scores = { SICT: 0, SHS: 0, SSE: 0, SPC: 0, SBS: 0 };
                    this.recommendedSchool = '';
                },

                sendToServer() {
                    const responses = {};
                    this.selectedOptions.forEach((options, questionIndex) => {
                        responses[questionIndex + 1] = options;
                    });

                    fetch('{{ route("user.questionnaire.store") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            questionnaire: responses,
                            scores: this.scores,
                            recommended_school: this.recommendedSchool
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log('Questionnaire submitted successfully');
                        }
                    })
                    .catch(error => {
                        console.error('Error submitting questionnaire:', error);
                    });
                }
            }
        }
    </script>
</x-layouts.app>