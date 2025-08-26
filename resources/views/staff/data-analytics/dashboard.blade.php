<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data & Analytics Manager Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Welcome, {{ auth()->user()->name }}!</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">{{ auth()->user()->manager_type_display }}</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Analytics Tools -->
                        <div class="bg-indigo-100 dark:bg-indigo-900 p-4 rounded-lg">
                            <h4 class="font-semibold">Data Analytics</h4>
                            <p class="text-sm">Analyze system and user data</p>
                        </div>
                        
                        <div class="bg-emerald-100 dark:bg-emerald-900 p-4 rounded-lg">
                            <h4 class="font-semibold">Performance Metrics</h4>
                            <p class="text-sm">Monitor system performance</p>
                        </div>
                        
                        <div class="bg-slate-100 dark:bg-slate-900 p-4 rounded-lg">
                            <h4 class="font-semibold">Custom Reports</h4>
                            <p class="text-sm">Create custom analytics reports</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>