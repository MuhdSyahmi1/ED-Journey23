<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Program Manager Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Welcome, {{ auth()->user()->name }}!</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">{{ auth()->user()->manager_type_display }}</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Programme Management -->
                        <a href="{{ route('staff.program.programme-management') }}" class="bg-blue-100 dark:bg-blue-900 p-4 rounded-lg hover:bg-blue-200 dark:hover:bg-blue-800 transition-colors cursor-pointer">
                            <h4 class="font-semibold">Programme Management</h4>
                            <p class="text-sm">Manage academic programs and courses</p>
                        </a>
                        
                        <div class="bg-green-100 dark:bg-green-900 p-4 rounded-lg">
                            <h4 class="font-semibold">Feedback Center</h4>
                            <p class="text-sm">View Feedbacks from users</p>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>