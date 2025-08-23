<x-layout title="Home Page">
    <div class="space-y-16">

        <!-- Hero Section -->
        <div class="bg-gradient-to-r from-blue-50 to-white rounded-lg shadow-lg p-12 text-center max-w-3xl mx-auto transform hover:scale-105 transition-transform duration-300">
            <h1 class="text-4xl md:text-5xl font-bold text-blue-700 mb-4">Welcome to EduJourney!</h1>
            <p class="text-gray-700 mb-6 text-lg md:text-xl">This is the first page using the stylish, professional navigation bar. Perfect for university or institutional websites.</p>
            <a href="#"
               class="inline-block px-8 py-3 bg-blue-700 text-white font-semibold rounded hover:bg-blue-800 transition">
               Get Started
            </a>
        </div>

        <!-- Features Section -->
        <div class="max-w-5xl mx-auto grid md:grid-cols-3 gap-8">
            
            <!-- Feature 1 -->
            <div class="bg-white rounded-lg shadow p-6 text-center hover:shadow-lg transition">
                <svg class="mx-auto h-12 w-12 text-blue-700 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <h2 class="text-xl font-bold mb-2 text-blue-700">Reliable</h2>
                <p class="text-gray-700">Built with stability and best practices in mind for educational platforms.</p>
            </div>

            <!-- Feature 2 -->
            <div class="bg-white rounded-lg shadow p-6 text-center hover:shadow-lg transition">
                <svg class="mx-auto h-12 w-12 text-blue-700 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3z" />
                </svg>
                <h2 class="text-xl font-bold mb-2 text-blue-700">Professional</h2>
                <p class="text-gray-700">Clean and modern design suitable for universities and institutions.</p>
            </div>

            <!-- Feature 3 -->
            <div class="bg-white rounded-lg shadow p-6 text-center hover:shadow-lg transition">
                <svg class="mx-auto h-12 w-12 text-blue-700 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h2l1 5h13l1-5h2" />
                </svg>
                <h2 class="text-xl font-bold mb-2 text-blue-700">Responsive</h2>
                <p class="text-gray-700">Optimized for all devices, from desktop to mobile.</p>
            </div>

        </div>

    </div>
</x-layout>