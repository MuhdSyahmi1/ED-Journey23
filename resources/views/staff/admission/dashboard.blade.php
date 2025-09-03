<x-layouts.app title="Admission Manager">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admission Manager Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Welcome, {{ auth()->user()->name }}!</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">{{ auth()->user()->manager_type_display }}</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Admission Management -->
                        <div class="bg-orange-100 dark:bg-orange-900 p-4 rounded-lg">
                            <h4 class="font-semibold">Application Management</h4>
                            <p class="text-sm">Review and process applications</p>
                        </div>
                        
                        <div class="bg-teal-100 dark:bg-teal-900 p-4 rounded-lg">
                            <h4 class="font-semibold">Admission Criteria</h4>
                            <p class="text-sm">Set and update admission requirements</p>
                        </div>
                        
                        <div class="bg-red-100 dark:bg-red-900 p-4 rounded-lg">
                            <h4 class="font-semibold">Admission Reports</h4>
                            <p class="text-sm">View admission statistics</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>