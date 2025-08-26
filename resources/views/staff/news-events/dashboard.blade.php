<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('News & Events Manager Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Welcome, {{ auth()->user()->name }}!</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">{{ auth()->user()->manager_type_display }}</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- News & Events Management -->
                        <div class="bg-cyan-100 dark:bg-cyan-900 p-4 rounded-lg">
                            <h4 class="font-semibold">News Management</h4>
                            <p class="text-sm">Create and manage news articles</p>
                        </div>
                        
                        <div class="bg-pink-100 dark:bg-pink-900 p-4 rounded-lg">
                            <h4 class="font-semibold">Event Planning</h4>
                            <p class="text-sm">Plan and organize events</p>
                        </div>
                        
                        <div class="bg-lime-100 dark:bg-lime-900 p-4 rounded-lg">
                            <h4 class="font-semibold">Content Calendar</h4>
                            <p class="text-sm">Schedule content publication</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>