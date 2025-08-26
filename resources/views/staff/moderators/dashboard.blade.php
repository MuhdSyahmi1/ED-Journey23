<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Moderator Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium mb-4">Welcome, {{ auth()->user()->name }}!</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">{{ auth()->user()->manager_type_display }}</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Moderation Tools -->
                        <div class="bg-amber-100 dark:bg-amber-900 p-4 rounded-lg">
                            <h4 class="font-semibold">Content Moderation</h4>
                            <p class="text-sm">Review and moderate user content</p>
                        </div>
                        
                        <div class="bg-violet-100 dark:bg-violet-900 p-4 rounded-lg">
                            <h4 class="font-semibold">User Management</h4>
                            <p class="text-sm">Manage user accounts and permissions</p>
                        </div>
                        
                        <div class="bg-rose-100 dark:bg-rose-900 p-4 rounded-lg">
                            <h4 class="font-semibold">Moderation Reports</h4>
                            <p class="text-sm">View moderation activity</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>