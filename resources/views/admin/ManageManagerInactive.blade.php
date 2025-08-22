<x-layouts.app title="Manage Manager Inactive">
<div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Manage Manager:</h1>
            
            <div class="space-y-4 mb-8">
                <div>
                    <span class="font-medium text-gray-700">Email:</span>
                    <span class="text-gray-900">john.carter@gmail.com</span>
                </div>
                <div>
                    <span class="font-medium text-gray-700">Role:</span>
                    <span class="text-gray-900">Program Manager</span>
                </div>
                <div>
                    <span class="font-medium text-gray-700">Status:</span>
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Inactive</span>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-start space-x-4">
                <button class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-md font-medium transition">
                    Activate
                </button>
                
                <button class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded-md font-medium transition">
                    Delete
                </button>
                
                <button class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-md font-medium transition">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</x-layouts.app>