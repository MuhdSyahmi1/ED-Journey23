<x-layouts.app title="Update Profile">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Update Profile') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 dark:from-slate-900 dark:to-blue-950 transition-colors duration-300">
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

                <!-- Profile Form -->
                <form method="POST" action="{{ route('user.profile.store') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Header -->
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden">
                        <div class="bg-gradient-to-r from-red-400/90 to-pink-500/90 text-white text-center py-4">
                            <h1 class="text-2xl font-bold">UPDATE PROFILE</h1>
                        </div>
                    </div>

                    <!-- IC File Upload Section -->
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 p-8">
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100 mb-2">Upload IC File (JPG, PNG, PDF only)</h3>
                            <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-700 rounded-lg p-4 mb-4">
                                <p class="text-yellow-800 dark:text-yellow-200 text-sm">
                                    <strong>Important:</strong> Please upload a high-quality image or PDF of your IC (front and back) in a single file only.
                                </p>
                            </div>
                            
                            <div class="space-y-4">
                                <!-- Current IC Preview -->
                                @if(isset($profile) && $profile->ic_file_path)
                                    <div id="current-ic-preview" class="mb-4">
                                        <p class="text-sm font-medium text-slate-700 dark:text-slate-200 mb-2">Current IC File:</p>
                                        <div class="relative bg-slate-100 dark:bg-slate-600 rounded-lg p-4 border border-slate-300 dark:border-slate-500">
                                            @php
                                                $fileExtension = pathinfo($profile->ic_file_path, PATHINFO_EXTENSION);
                                                $isImage = in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png']);
                                            @endphp
                                            
                                            @if($isImage)
                                                <img src="{{ route('user.profile.view-ic') }}" 
                                                     alt="Current IC" 
                                                     class="max-w-full h-auto max-h-64 rounded-lg mx-auto"
                                                     id="current-ic-image">
                                            @else
                                                <div class="text-center py-8">
                                                    <svg class="w-16 h-16 mx-auto text-slate-500 dark:text-slate-400" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/>
                                                    </svg>
                                                    <p class="mt-2 text-sm text-slate-600 dark:text-slate-400">PDF File</p>
                                                    <p class="text-xs text-slate-500 dark:text-slate-500">{{ $profile->ic_file_name ?? 'IC Document' }}</p>
                                                </div>
                                            @endif
                                            
                                            <div class="flex justify-center gap-2 mt-3">
                                                <a href="{{ route('user.profile.download-ic') }}" 
                                                   class="inline-flex items-center px-3 py-1 text-xs font-medium text-blue-700 dark:text-blue-300 bg-blue-50 dark:bg-blue-900/20 rounded-full hover:bg-blue-100 dark:hover:bg-blue-900/40 transition-colors">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                                    </svg>
                                                    Download
                                                </a>
                                                <button type="button" 
                                                        id="replace-ic-btn"
                                                        class="inline-flex items-center px-3 py-1 text-xs font-medium text-orange-700 dark:text-orange-300 bg-orange-50 dark:bg-orange-900/20 rounded-full hover:bg-orange-100 dark:hover:bg-orange-900/40 transition-colors">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                                    </svg>
                                                    Replace
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- File Input -->
                                <div id="file-input-section" class="{{ isset($profile) && $profile->ic_file_path ? 'hidden' : '' }}">
                                    <input type="file" 
                                           id="ic_file" 
                                           name="ic_file" 
                                           accept=".jpg,.jpeg,.png,.pdf"
                                           class="block w-full text-sm text-slate-900 dark:text-slate-100
                                                  file:mr-4 file:py-2 file:px-4
                                                  file:rounded-lg file:border-0
                                                  file:text-sm file:font-medium
                                                  file:bg-red-50 file:text-red-700
                                                  hover:file:bg-red-100 dark:file:bg-red-900/20 dark:file:text-red-300
                                                  file:cursor-pointer cursor-pointer
                                                  bg-slate-50 dark:bg-slate-700 border border-slate-300 dark:border-slate-600 rounded-lg">
                                    
                                    <!-- New File Preview -->
                                    <div id="new-file-preview" class="hidden mt-4">
                                        <p class="text-sm font-medium text-slate-700 dark:text-slate-200 mb-2">New IC File Preview:</p>
                                        <div class="relative bg-slate-100 dark:bg-slate-600 rounded-lg p-4 border border-slate-300 dark:border-slate-500">
                                            <img id="preview-image" class="max-w-full h-auto max-h-64 rounded-lg mx-auto hidden" alt="New IC Preview">
                                            <div id="preview-pdf" class="text-center py-8 hidden">
                                                <svg class="w-16 h-16 mx-auto text-slate-500 dark:text-slate-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/>
                                                </svg>
                                                <p class="mt-2 text-sm text-slate-600 dark:text-slate-400">PDF File Selected</p>
                                                <p id="preview-filename" class="text-xs text-slate-500 dark:text-slate-500"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                @error('ic_file')
                                    <p class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Personal Information -->
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 p-8">
                        <h3 class="text-xl font-semibold text-slate-900 dark:text-slate-100 mb-6">Personal Information</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name -->
                            <div class="space-y-2">
                                <label for="name" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">
                                    Name <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name', $profile->name ?? auth()->user()->name) }}"
                                       class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 dark:border-slate-600 
                                              bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100
                                              focus:border-red-500 dark:focus:border-red-400 
                                              focus:ring-4 focus:ring-red-500/20 dark:focus:ring-red-400/20
                                              transition-all duration-200 @error('name') border-red-500 dark:border-red-400 @enderror"
                                       required>
                                @error('name')
                                    <p class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Identity Card -->
                            <div class="space-y-2">
                                <label for="identity_card" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">
                                    Identity Card <span class="text-red-500">*</span> <span class="text-slate-500">(Format: XX-XXXXXX)</span>
                                </label>
                                <input type="text" 
                                       id="identity_card" 
                                       name="identity_card" 
                                       value="{{ old('identity_card', $profile->identity_card ?? '') }}"
                                       maxlength="9"
                                       pattern="[0-9]{2}-[0-9]{6}"
                                       placeholder="12-123456"
                                       class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 dark:border-slate-600 
                                              bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100
                                              focus:border-red-500 dark:focus:border-red-400 
                                              focus:ring-4 focus:ring-red-500/20 dark:focus:ring-red-400/20
                                              transition-all duration-200 @error('identity_card') border-red-500 dark:border-red-400 @enderror"
                                       required>
                                @error('identity_card')
                                    <p class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- ID Color -->
                            <div class="space-y-2">
                                <label for="id_color" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">
                                    ID Color <span class="text-red-500">*</span>
                                </label>
                                <select id="id_color" 
                                        name="id_color" 
                                        class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 dark:border-slate-600 
                                               bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100
                                               focus:border-red-500 dark:focus:border-red-400 
                                               focus:ring-4 focus:ring-red-500/20 dark:focus:ring-red-400/20
                                               transition-all duration-200 @error('id_color') border-red-500 dark:border-red-400 @enderror"
                                        required>
                                    <option value="">Select ID Color</option>
                                    <option value="yellow" {{ old('id_color', $profile->id_color ?? '') == 'yellow' ? 'selected' : '' }}>Yellow</option>
                                    <option value="green" {{ old('id_color', $profile->id_color ?? '') == 'green' ? 'selected' : '' }}>Green</option>
                                    <option value="red" {{ old('id_color', $profile->id_color ?? '') == 'red' ? 'selected' : '' }}>Red</option>
                                </select>
                                @error('id_color')
                                    <p class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Date of Birth -->
                            <div class="space-y-2">
                                <label for="date_of_birth" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">
                                    Date of Birth <span class="text-red-500">*</span>
                                </label>
                                <input type="date" 
                                       id="date_of_birth" 
                                       name="date_of_birth" 
                                       value="{{ old('date_of_birth', $profile->date_of_birth ?? '') }}"
                                       class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 dark:border-slate-600 
                                              bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100
                                              focus:border-red-500 dark:focus:border-red-400 
                                              focus:ring-4 focus:ring-red-500/20 dark:focus:ring-red-400/20
                                              transition-all duration-200 @error('date_of_birth') border-red-500 dark:border-red-400 @enderror"
                                       required>
                                @error('date_of_birth')
                                    <p class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Place of Birth -->
                            <div class="space-y-2">
                                <label for="place_of_birth" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">
                                    Place of Birth <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       id="place_of_birth" 
                                       name="place_of_birth" 
                                       value="{{ old('place_of_birth', $profile->place_of_birth ?? '') }}"
                                       class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 dark:border-slate-600 
                                              bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100
                                              focus:border-red-500 dark:focus:border-red-400 
                                              focus:ring-4 focus:ring-red-500/20 dark:focus:ring-red-400/20
                                              transition-all duration-200 @error('place_of_birth') border-red-500 dark:border-red-400 @enderror"
                                       required>
                                @error('place_of_birth')
                                    <p class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Gender -->
                            <div class="space-y-2">
                                <label for="gender" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">
                                    Gender <span class="text-red-500">*</span>
                                </label>
                                <select id="gender" 
                                        name="gender" 
                                        class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 dark:border-slate-600 
                                               bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100
                                               focus:border-red-500 dark:focus:border-red-400 
                                               focus:ring-4 focus:ring-red-500/20 dark:focus:ring-red-400/20
                                               transition-all duration-200 @error('gender') border-red-500 dark:border-red-400 @enderror"
                                        required>
                                    <option value="">Select Gender</option>
                                    <option value="male" {{ old('gender', $profile->gender ?? '') == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender', $profile->gender ?? '') == 'female' ? 'selected' : '' }}>Female</option>
                                </select>
                                @error('gender')
                                    <p class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Postal Address (Full Width) -->
                        <div class="space-y-2 mt-6">
                            <label for="postal_address" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">
                                Postal Address <span class="text-red-500">*</span>
                            </label>
                            <textarea id="postal_address" 
                                      name="postal_address" 
                                      rows="3"
                                      class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 dark:border-slate-600 
                                             bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100
                                             focus:border-red-500 dark:focus:border-red-400 
                                             focus:ring-4 focus:ring-red-500/20 dark:focus:ring-red-400/20
                                             transition-all duration-200 resize-none @error('postal_address') border-red-500 dark:border-red-400 @enderror"
                                      required>{{ old('postal_address', $profile->postal_address ?? '') }}</textarea>
                            @error('postal_address')
                                <p class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 p-8">
                        <h3 class="text-xl font-semibold text-slate-900 dark:text-slate-100 mb-6">Contact Information</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Telephone No. (H) -->
                            <div class="space-y-2">
                                <label for="telephone_home" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">
                                    Telephone No.(H) <span class="text-slate-500">(Optional)</span>
                                </label>
                                <input type="tel" 
                                       id="telephone_home" 
                                       name="telephone_home" 
                                       value="{{ old('telephone_home', $profile->telephone_home ?? '') }}"
                                       class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 dark:border-slate-600 
                                              bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100
                                              focus:border-red-500 dark:focus:border-red-400 
                                              focus:ring-4 focus:ring-red-500/20 dark:focus:ring-red-400/20
                                              transition-all duration-200 @error('telephone_home') border-red-500 dark:border-red-400 @enderror">
                                @error('telephone_home')
                                    <p class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Mobile Phone No. -->
                            <div class="space-y-2">
                                <label for="mobile_phone" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">
                                    Mobile Phone No. <span class="text-red-500">*</span>
                                </label>
                                <input type="tel" 
                                       id="mobile_phone" 
                                       name="mobile_phone" 
                                       value="{{ old('mobile_phone', $profile->mobile_phone ?? '') }}"
                                       class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 dark:border-slate-600 
                                              bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100
                                              focus:border-red-500 dark:focus:border-red-400 
                                              focus:ring-4 focus:ring-red-500/20 dark:focus:ring-red-400/20
                                              transition-all duration-200 @error('mobile_phone') border-red-500 dark:border-red-400 @enderror"
                                       required>
                                @error('mobile_phone')
                                    <p class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email Address -->
                            <div class="space-y-2 md:col-span-2">
                                <label for="email_address" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">
                                    Email Address <span class="text-red-500">*</span>
                                </label>
                                <input type="email" 
                                       id="email_address" 
                                       name="email_address" 
                                       value="{{ old('email_address', $profile->email_address ?? auth()->user()->email) }}"
                                       class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 dark:border-slate-600 
                                              bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100
                                              focus:border-red-500 dark:focus:border-red-400 
                                              focus:ring-4 focus:ring-red-500/20 dark:focus:ring-red-400/20
                                              transition-all duration-200 @error('email_address') border-red-500 dark:border-red-400 @enderror"
                                       required>
                                @error('email_address')
                                    <p class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Additional Information -->
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 p-8">
                        <h3 class="text-xl font-semibold text-slate-900 dark:text-slate-100 mb-6">Additional Information</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Religion -->
                            <div class="space-y-2">
                                <label for="religion" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">
                                    Religion <span class="text-red-500">*</span>
                                </label>
                                <select id="religion" 
                                        name="religion" 
                                        class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 dark:border-slate-600 
                                               bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100
                                               focus:border-red-500 dark:focus:border-red-400 
                                               focus:ring-4 focus:ring-red-500/20 dark:focus:ring-red-400/20
                                               transition-all duration-200 @error('religion') border-red-500 dark:border-red-400 @enderror"
                                        required>
                                    <option value="">Select Religion</option>
                                    <option value="islam" {{ old('religion', $profile->religion ?? '') == 'islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="christianity" {{ old('religion', $profile->religion ?? '') == 'christianity' ? 'selected' : '' }}>Christianity</option>
                                    <option value="buddhism" {{ old('religion', $profile->religion ?? '') == 'buddhism' ? 'selected' : '' }}>Buddhism</option>
                                    <option value="hinduism" {{ old('religion', $profile->religion ?? '') == 'hinduism' ? 'selected' : '' }}>Hinduism</option>
                                    <option value="other" {{ old('religion', $profile->religion ?? '') == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('religion')
                                    <p class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Nationality -->
                            <div class="space-y-2">
                                <label for="nationality" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">
                                    Nationality <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       id="nationality" 
                                       name="nationality" 
                                       value="{{ old('nationality', $profile->nationality ?? '') }}"
                                       class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 dark:border-slate-600 
                                              bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100
                                              focus:border-red-500 dark:focus:border-red-400 
                                              focus:ring-4 focus:ring-red-500/20 dark:focus:ring-red-400/20
                                              transition-all duration-200 @error('nationality') border-red-500 dark:border-red-400 @enderror"
                                       required>
                                @error('nationality')
                                    <p class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Race -->
                            <div class="space-y-2">
                                <label for="race" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">
                                    Race <span class="text-red-500">*</span>
                                </label>
                                <select id="race" 
                                        name="race" 
                                        class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 dark:border-slate-600 
                                               bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100
                                               focus:border-red-500 dark:focus:border-red-400 
                                               focus:ring-4 focus:ring-red-500/20 dark:focus:ring-red-400/20
                                               transition-all duration-200 @error('race') border-red-500 dark:border-red-400 @enderror"
                                        required>
                                    <option value="">Select Race</option>
                                    <option value="malay" {{ old('race', $profile->race ?? '') == 'malay' ? 'selected' : '' }}>Malay</option>
                                    <option value="chinese" {{ old('race', $profile->race ?? '') == 'chinese' ? 'selected' : '' }}>Chinese</option>
                                    <option value="indian" {{ old('race', $profile->race ?? '') == 'indian' ? 'selected' : '' }}>Indian</option>
                                    <option value="other" {{ old('race', $profile->race ?? '') == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('race')
                                    <p class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Health Record -->
                            <div class="space-y-2">
                                <label for="health_record" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">
                                    Health Record <span class="text-slate-500">(Optional)</span>
                                </label>
                                <p class="text-xs text-slate-500 dark:text-slate-400 mb-2">Please state if any</p>
                                <textarea id="health_record" 
                                          name="health_record" 
                                          rows="3"
                                          placeholder="Leave blank if no health issues..."
                                          class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 dark:border-slate-600 
                                                 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100
                                                 focus:border-red-500 dark:focus:border-red-400 
                                                 focus:ring-4 focus:ring-red-500/20 dark:focus:ring-red-400/20
                                                 transition-all duration-200 resize-none">{{ old('health_record', $profile->health_record ?? '') }}</textarea>
                                @error('health_record')
                                    <p class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-center">
                        <button type="submit" 
                                class="bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 text-white font-bold py-4 px-12 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200">
                            Update Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const identityCardInput = document.getElementById('identity_card');
            const icFileInput = document.getElementById('ic_file');
            const replaceIcBtn = document.getElementById('replace-ic-btn');
            const fileInputSection = document.getElementById('file-input-section');
            const currentIcPreview = document.getElementById('current-ic-preview');
            const newFilePreview = document.getElementById('new-file-preview');
            const previewImage = document.getElementById('preview-image');
            const previewPdf = document.getElementById('preview-pdf');
            const previewFilename = document.getElementById('preview-filename');
            
            // Identity card formatting
            identityCardInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, ''); // Remove non-digits
                
                if (value.length >= 2) {
                    value = value.substring(0, 2) + '-' + value.substring(2, 8);
                }
                
                e.target.value = value;
            });

            identityCardInput.addEventListener('keydown', function(e) {
                // Allow backspace, delete, tab, escape, enter, and decimal point
                if ([46, 8, 9, 27, 13].indexOf(e.keyCode) !== -1 ||
                    // Allow Ctrl+A, Ctrl+C, Ctrl+V, Ctrl+X
                    (e.keyCode === 65 && e.ctrlKey === true) ||
                    (e.keyCode === 67 && e.ctrlKey === true) ||
                    (e.keyCode === 86 && e.ctrlKey === true) ||
                    (e.keyCode === 88 && e.ctrlKey === true) ||
                    // Allow home, end, left, right
                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                    return;
                }
                
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });

            // IC file replacement functionality
            if (replaceIcBtn) {
                replaceIcBtn.addEventListener('click', function() {
                    if (confirm('Are you sure you want to replace your current IC file? This action will permanently replace the existing file when you submit the form.')) {
                        fileInputSection.classList.remove('hidden');
                        currentIcPreview.style.opacity = '0.5';
                        icFileInput.focus();
                    }
                });
            }

            // IC file preview functionality
            if (icFileInput) {
                icFileInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    
                    if (!file) {
                        newFilePreview.classList.add('hidden');
                        return;
                    }

                    const fileExtension = file.name.split('.').pop().toLowerCase();
                    const isImage = ['jpg', 'jpeg', 'png'].includes(fileExtension);
                    
                    if (isImage) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            previewImage.src = e.target.result;
                            previewImage.classList.remove('hidden');
                            previewPdf.classList.add('hidden');
                            newFilePreview.classList.remove('hidden');
                        };
                        reader.readAsDataURL(file);
                    } else if (fileExtension === 'pdf') {
                        previewFilename.textContent = file.name;
                        previewPdf.classList.remove('hidden');
                        previewImage.classList.add('hidden');
                        newFilePreview.classList.remove('hidden');
                    }

                    // Show replacement notification
                    if (currentIcPreview) {
                        const notification = document.createElement('div');
                        notification.className = 'bg-orange-50 dark:bg-orange-900/20 border border-orange-200 dark:border-orange-700 rounded-lg p-3 mt-2 text-sm text-orange-800 dark:text-orange-200';
                        notification.innerHTML = '<strong>Note:</strong> This new file will replace your current IC file when you submit the form.';
                        
                        // Remove existing notification if any
                        const existingNotification = fileInputSection.querySelector('.bg-orange-50, .dark\\:bg-orange-900\\/20');
                        if (existingNotification) {
                            existingNotification.remove();
                        }
                        
                        fileInputSection.appendChild(notification);
                    }
                });
            }
        });
    </script>
</x-layouts.app>