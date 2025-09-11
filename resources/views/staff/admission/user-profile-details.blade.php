<x-layouts.app title="User Profile">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Profile Details') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 dark:from-slate-900 dark:to-blue-950 transition-colors duration-300">
        <div class="p-6">
            <div class="max-w-6xl mx-auto">
                
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

                <!-- Back Button -->
                <div class="mb-6">
                    <a href="{{ route('staff.admission.user-profile') }}" class="inline-flex items-center px-4 py-2 bg-slate-500 hover:bg-slate-600 text-white font-medium rounded-lg shadow-md hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to User Profiles
                    </a>
                </div>

                <!-- Header -->
                <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden mb-6">
                    <div class="bg-gradient-to-r from-blue-400/90 to-purple-500/90 text-white text-center py-4">
                        <h1 class="text-2xl font-bold">USER PROFILE VERIFICATION</h1>
                        <p class="text-sm opacity-90 mt-1">{{ $profile->full_name }} - User ID: #{{ $profile->user_id }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- User Information -->
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 p-6">
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Personal Information
                            </h3>
                            
                            <div class="space-y-3">
                                <!-- Full Name -->
                                <div class="flex items-start">
                                    <span class="text-sm font-medium text-slate-600 dark:text-slate-400 w-40 flex-shrink-0">Full Name: </span>
                                    <span class="text-sm text-slate-900 dark:text-slate-100">{{ $profile->full_name }}</span>
                                </div>

                                <!-- Email -->
                                <div class="flex items-start">
                                    <span class="text-sm font-medium text-slate-600 dark:text-slate-400 w-40 flex-shrink-0">Email Address: </span>
                                    <span class="text-sm text-slate-900 dark:text-slate-100">{{ $profile->email }}</span>
                                </div>

                                <!-- Identity Card -->
                                <div class="flex items-start">
                                    <span class="text-sm font-medium text-slate-600 dark:text-slate-400 w-40 flex-shrink-0">Identity Card Number: </span>
                                    <span class="text-sm text-slate-900 dark:text-slate-100">{{ $profile->identity_card ?? '-' }}</span>
                                </div>

                                <!-- Date of Birth -->
                                <div class="flex items-start">
                                    <span class="text-sm font-medium text-slate-600 dark:text-slate-400 w-40 flex-shrink-0">Date of Birth: </span>
                                    <span class="text-sm text-slate-900 dark:text-slate-100">
                                        {{ $profile->date_of_birth ? \Carbon\Carbon::parse($profile->date_of_birth)->format('d M Y') : '-' }}
                                    </span>
                                </div>

                                <!-- Gender -->
                                <div class="flex items-start">
                                    <span class="text-sm font-medium text-slate-600 dark:text-slate-400 w-40 flex-shrink-0">Gender: </span>
                                    <span class="text-sm text-slate-900 dark:text-slate-100">{{ $profile->gender ?? '-' }}</span>
                                </div>

                                <!-- Race -->
                                <div class="flex items-start">
                                    <span class="text-sm font-medium text-slate-600 dark:text-slate-400 w-40 flex-shrink-0">Race: </span>
                                    <span class="text-sm text-slate-900 dark:text-slate-100">{{ $profile->race ?? '-' }}</span>
                                </div>

                                <!-- Nationality -->
                                <div class="flex items-start">
                                    <span class="text-sm font-medium text-slate-600 dark:text-slate-400 w-40 flex-shrink-0">Nationality: </span>
                                    <span class="text-sm text-slate-900 dark:text-slate-100">{{ $profile->nationality ?? '-' }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="border-t border-slate-200 dark:border-slate-700 pt-6">
                            <h4 class="text-md font-semibold text-slate-900 dark:text-slate-100 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                Contact Details
                            </h4>
                            
                            <div class="space-y-3">
                                <!-- Mobile -->
                                <div class="flex items-start">
                                    <span class="text-sm font-medium text-slate-600 dark:text-slate-400 w-32 flex-shrink-0">Mobile Phone: </span>
                                    <span class="text-sm text-slate-900 dark:text-slate-100">{{ $profile->mobile_phone ?? '-' }}</span>
                                </div>

                                <!-- Home Phone -->
                                <div class="flex items-start">
                                    <span class="text-sm font-medium text-slate-600 dark:text-slate-400 w-32 flex-shrink-0">Home Phone: </span>
                                    <span class="text-sm text-slate-900 dark:text-slate-100">{{ $profile->telephone_home ?? '-' }}</span>
                                </div>

                                <!-- Address -->
                                <div class="flex items-start">
                                    <span class="text-sm font-medium text-slate-600 dark:text-slate-400 w-32 flex-shrink-0">Address: </span>
                                    <span class="text-sm text-slate-900 dark:text-slate-100">{{ $profile->postal_address ?? '-' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- IC Document & Verification -->
                    <div class="space-y-6">
                        <!-- IC Document -->
                        <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 p-6">
                            <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                IC Document
                            </h3>
                            
                            @if($profile->ic_file_path)
                                <div class="text-center">
                                    @php
                                        $fileExtension = pathinfo($profile->ic_file_path, PATHINFO_EXTENSION);
                                        $isImage = in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png']);
                                    @endphp
                                    
                                    @if($isImage)
                                        <!-- Display IC Image -->
                                        <div class="border-2 border-slate-300 dark:border-slate-600 rounded-xl p-4 mb-4 bg-slate-50 dark:bg-slate-700">
                                            <p class="text-sm text-slate-600 dark:text-slate-400 mb-3">IC Document ({{ $profile->ic_file_name }})</p>
                                            <img src="{{ route('staff.admission.user-profile.view-ic', $profile->user_id) }}" 
                                                 alt="IC Document" 
                                                 class="max-w-full h-auto max-h-96 rounded-lg mx-auto shadow-lg"
                                                 style="max-width: 600px;">
                                            <div class="mt-3">
                                                <a href="{{ route('staff.admission.user-profile.view-ic', $profile->user_id) }}" 
                                                   target="_blank"
                                                   class="inline-flex items-center px-3 py-2 text-sm bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white font-medium rounded-lg shadow-md hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                                    </svg>
                                                    Open Full Size
                                                </a>
                                            </div>
                                        </div>
                                    @else
                                        <!-- Display PDF placeholder with view button -->
                                        <div class="border-2 border-dashed border-slate-300 dark:border-slate-600 rounded-xl p-8 mb-4">
                                            <svg class="mx-auto h-16 w-16 text-slate-400 dark:text-slate-500 mb-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/>
                                            </svg>
                                            <p class="text-sm text-slate-600 dark:text-slate-400 mb-2">IC Document (PDF)</p>
                                            <p class="text-xs text-slate-500 dark:text-slate-400 mb-4">{{ $profile->ic_file_name }}</p>
                                            <a href="{{ route('staff.admission.user-profile.view-ic', $profile->user_id) }}" 
                                               target="_blank"
                                               class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white font-bold rounded-lg shadow-md hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                View PDF Document
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            @else
                                <div class="text-center py-12">
                                    <svg class="mx-auto h-12 w-12 text-slate-400 dark:text-slate-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <p class="text-sm text-slate-600 dark:text-slate-400">No IC document uploaded</p>
                                </div>
                            @endif
                        </div>

                        <!-- Verification Status & Actions -->
                        <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 p-6">
                            <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Verification Status
                            </h3>
                            
                            <div class="space-y-4">
                                <!-- Current Status -->
                                <div>
                                    <label class="block text-sm font-medium text-slate-600 dark:text-slate-400 mb-2">Current Status</label>
                                    @if($profile->verification_status === 'verified')
                                        <div class="inline-flex items-center px-4 py-2 rounded-lg bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300 border border-green-200 dark:border-green-700">
                                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                            </svg>
                                            <span class="font-semibold">Verified</span>
                                        </div>
                                    @elseif($profile->verification_status === 'rejected')
                                        <div class="inline-flex items-center px-4 py-2 rounded-lg bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300 border border-red-200 dark:border-red-700">
                                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.293a1 1 0 00-1.414-1.414L9 11.586 7.707 10.293a1 1 0 00-1.414 1.414L8.586 13l-2.293 2.293a1 1 0 001.414 1.414L9 14.414l2.293 2.293a1 1 0 001.414-1.414L10.414 13l2.293-2.293z" clip-rule="evenodd" />
                                            </svg>
                                            <span class="font-semibold">Rejected</span>
                                        </div>
                                    @else
                                        <div class="inline-flex items-center px-4 py-2 rounded-lg bg-orange-100 dark:bg-orange-900/30 text-orange-800 dark:text-orange-300 border border-orange-200 dark:border-orange-700">
                                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                            </svg>
                                            <span class="font-semibold">Pending Verification</span>
                                        </div>
                                    @endif
                                </div>

                                <!-- Verification Details -->
                                @if($profile->verification_status === 'verified')
                                    <div>
                                        <label class="block text-sm font-medium text-slate-600 dark:text-slate-400 mb-1">Verified On</label>
                                        <div class="text-slate-900 dark:text-slate-100">
                                            {{ $profile->verified_at ? \Carbon\Carbon::parse($profile->verified_at)->format('d M Y, H:i') : 'Not available' }}
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-600 dark:text-slate-400 mb-1">Verified By</label>
                                        <div class="text-slate-900 dark:text-slate-100">
                                            Staff ID: {{ $profile->verified_by ?? 'Not available' }}
                                        </div>
                                    </div>
                                @elseif($profile->verification_status === 'rejected')
                                    <div>
                                        <label class="block text-sm font-medium text-slate-600 dark:text-slate-400 mb-1">Rejected On</label>
                                        <div class="text-slate-900 dark:text-slate-100">
                                            {{ $profile->verified_at ? \Carbon\Carbon::parse($profile->verified_at)->format('d M Y, H:i') : 'Not available' }}
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-600 dark:text-slate-400 mb-1">Rejected By</label>
                                        <div class="text-slate-900 dark:text-slate-100">
                                            Staff ID: {{ $profile->verified_by ?? 'Not available' }}
                                        </div>
                                    </div>
                                @endif

                                <!-- Verification Actions -->
                                @if($profile->verification_status === 'pending')
                                    <div class="border-t border-slate-200 dark:border-slate-700 pt-4">
                                        <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-700 rounded-lg p-4 mb-4">
                                            <div class="flex items-start">
                                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 mt-0.5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                                </svg>
                                                <div class="flex-1">
                                                    <h4 class="text-sm font-medium text-blue-800 dark:text-blue-300">Verification Process</h4>
                                                    <p class="mt-1 text-sm text-blue-700 dark:text-blue-400">
                                                        Please review all the user's profile information and IC document before making a decision. You can verify or reject the profile.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="flex justify-end gap-4">
                                            <form method="POST" action="{{ route('staff.admission.user-profile.reject', $profile->user_id) }}" class="inline">
                                                @csrf
                                                <button type="submit" 
                                                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-red-500 to-rose-600 hover:from-red-600 hover:to-rose-700 text-white font-bold rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200"
                                                        onclick="return confirm('Are you sure you want to reject this user profile? This action cannot be undone.')">
                                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                    Reject Profile
                                                </button>
                                            </form>
                                            
                                            <form method="POST" action="{{ route('staff.admission.user-profile.verify', $profile->user_id) }}" class="inline">
                                                @csrf
                                                <button type="submit" 
                                                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-bold rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200"
                                                        onclick="return confirm('Are you sure you want to verify this user profile? This action cannot be undone.')">
                                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    Verify Profile
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layouts.app>