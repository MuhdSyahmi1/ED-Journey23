<x-layouts.app title="Edit Manager">
<div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Edit Manager</h1>
            
            <form class="space-y-6">
                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="john.carter@gmail.com"
                           required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <!-- Role Field -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="checkbox" name="roles[]" value="programme" checked class="mr-2 text-blue-600">
                            <span class="text-sm text-gray-700">Program Manager</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="roles[]" value="admission" class="mr-2 text-blue-600">
                            <span class="text-sm text-gray-700">Admission Manager</span>
                        </label>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-center space-x-4 pt-4">
                    <button type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md font-medium transition">
                        Update
                    </button>
                    <button type="button" 
                            class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-md font-medium transition">
                        Back
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>