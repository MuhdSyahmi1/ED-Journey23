<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Profile Management') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 dark:from-slate-900 dark:to-blue-950 transition-colors duration-300">
        <div class="p-6">
            <div class="max-w-7xl mx-auto">
                
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

                <!-- Header -->
                <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-400/90 to-purple-500/90 text-white text-center py-4">
                        <h1 class="text-2xl font-bold">USER PROFILE MANAGEMENT</h1>
                        <p class="text-sm opacity-90 mt-1">Verify and manage user profiles</p>
                    </div>
                </div>

                <!-- Search and Filters -->
                <div class="mt-6 bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 p-6">
                    <form method="GET" action="{{ route('staff.admission.user-profile') }}" class="space-y-4">
                        <div class="flex flex-col lg:flex-row gap-4">
                            <!-- Search -->
                            <div class="flex-1">
                                <label for="search" class="block text-sm font-medium text-slate-700 dark:text-slate-200 mb-2">
                                    Search
                                </label>
                                <div class="relative">
                                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    <input type="text" 
                                           name="search" 
                                           id="search"
                                           value="{{ request('search') }}"
                                           placeholder="Search by name, email, or IC number..."
                                           class="w-full pl-10 pr-4 py-3 rounded-xl border-2 border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 focus:border-blue-500 dark:focus:border-blue-400 focus:ring-4 focus:ring-blue-500/20 dark:focus:ring-blue-400/20 transition-all duration-200">
                                </div>
                            </div>

                            <!-- Status Filter -->
                            <div class="w-full lg:w-48">
                                <label for="status" class="block text-sm font-medium text-slate-700 dark:text-slate-200 mb-2">
                                    Status
                                </label>
                                <select name="status" 
                                        id="status"
                                        class="w-full px-4 py-3 rounded-xl border-2 border-slate-200 dark:border-slate-600 bg-white dark:bg-slate-700 text-slate-900 dark:text-slate-100 focus:border-blue-500 dark:focus:border-blue-400 focus:ring-4 focus:ring-blue-500/20 dark:focus:ring-blue-400/20 transition-all duration-200">
                                    <option value="">All Status</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="verified" {{ request('status') == 'verified' ? 'selected' : '' }}>Verified</option>
                                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                            </div>

                            <!-- Filter/Reset Buttons -->
                            <div class="flex items-end gap-2">
                                <button type="submit" class="bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-bold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200">
                                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.207A1 1 0 013 6.5V4z" />
                                    </svg>
                                    Filter
                                </button>
                                <a href="{{ route('staff.admission.user-profile') }}" class="bg-slate-500 hover:bg-slate-600 text-white font-bold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200">
                                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                    Reset
                                </a>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Statistics -->
                @php
                    $totalProfiles = \DB::table('user_profiles')->join('users', 'user_profiles.user_id', '=', 'users.id')->count();
                    $verifiedProfiles = \DB::table('user_profiles')->where('verification_status', 'verified')->count();
                    $pendingProfiles = \DB::table('user_profiles')->where('verification_status', 'pending')->count();
                    $rejectedProfiles = \DB::table('user_profiles')->where('verification_status', 'rejected')->count();
                @endphp

                <div class="mt-6 grid grid-cols-1 md:grid-cols-4 gap-6">
                    <!-- Total Profiles -->
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-slate-600 dark:text-slate-400">Total Profiles</p>
                                <p class="text-3xl font-bold text-slate-900 dark:text-slate-100">{{ $totalProfiles }}</p>
                            </div>
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-400/20 to-indigo-500/20 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Verified Profiles -->
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-slate-600 dark:text-slate-400">Verified</p>
                                <p class="text-3xl font-bold text-green-600 dark:text-green-400">{{ $verifiedProfiles }}</p>
                            </div>
                            <div class="w-12 h-12 bg-gradient-to-r from-green-400/20 to-emerald-500/20 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Profiles -->
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-slate-600 dark:text-slate-400">Pending</p>
                                <p class="text-3xl font-bold text-orange-600 dark:text-orange-400">{{ $pendingProfiles }}</p>
                            </div>
                            <div class="w-12 h-12 bg-gradient-to-r from-orange-400/20 to-amber-500/20 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Rejected Profiles -->
                    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-slate-600 dark:text-slate-400">Rejected</p>
                                <p class="text-3xl font-bold text-red-600 dark:text-red-400">{{ $rejectedProfiles }}</p>
                            </div>
                            <div class="w-12 h-12 bg-gradient-to-r from-red-400/20 to-rose-500/20 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- User Profiles Table -->
                <div class="mt-6 bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-slate-200/60 dark:border-slate-700/60 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-slate-50 dark:bg-slate-700/50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">USER ID</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">FULL NAME</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">IC NUMBER</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">STATUS</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">ACTION</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                                @forelse($userProfiles as $profile)
                                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="text-sm font-medium text-slate-900 dark:text-slate-100">#{{ $profile->user_id }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div>
                                                <div class="text-sm font-medium text-slate-900 dark:text-slate-100">{{ $profile->full_name }}</div>
                                                <div class="text-sm text-slate-500 dark:text-slate-400">{{ $profile->email }}</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="text-sm text-slate-900 dark:text-slate-100">{{ $profile->identity_card ?? 'Not provided' }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($profile->verification_status === 'verified')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300 border border-green-200 dark:border-green-700">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                    </svg>
                                                    Verified
                                                </span>
                                            @elseif($profile->verification_status === 'rejected')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300 border border-red-200 dark:border-red-700">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.293a1 1 0 00-1.414-1.414L9 11.586 7.707 10.293a1 1 0 00-1.414 1.414L8.586 13l-2.293 2.293a1 1 0 001.414 1.414L9 14.414l2.293 2.293a1 1 0 001.414-1.414L10.414 13l2.293-2.293z" clip-rule="evenodd" />
                                                    </svg>
                                                    Rejected
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-orange-100 dark:bg-orange-900/30 text-orange-800 dark:text-orange-300 border border-orange-200 dark:border-orange-700">
                                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                                    </svg>
                                                    Pending
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            @if($profile->verification_status === 'verified')
                                                <span class="inline-flex items-center px-3 py-2 rounded-lg text-sm font-medium bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300">
                                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                    </svg>
                                                    Verified
                                                </span>
                                            @elseif($profile->verification_status === 'rejected')
                                                <span class="inline-flex items-center px-3 py-2 rounded-lg text-sm font-medium bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300">
                                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.293a1 1 0 00-1.414-1.414L9 11.586 7.707 10.293a1 1 0 00-1.414 1.414L8.586 13l-2.293 2.293a1 1 0 001.414 1.414L9 14.414l2.293 2.293a1 1 0 001.414-1.414L10.414 13l2.293-2.293z" clip-rule="evenodd" />
                                                    </svg>
                                                    Rejected
                                                </span>
                                            @else
                                                <a href="{{ route('staff.admission.user-profile.show', $profile->user_id) }}" 
                                                   class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-bold rounded-lg shadow-md hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    Verify
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center justify-center">
                                                <svg class="w-12 h-12 text-slate-400 dark:text-slate-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                                </svg>
                                                <h3 class="text-lg font-medium text-slate-900 dark:text-slate-100 mb-2">No user profiles found</h3>
                                                <p class="text-sm text-slate-600 dark:text-slate-400">
                                                    @if(request()->hasAny(['search', 'status']))
                                                        Try adjusting your search criteria or filters.
                                                    @else
                                                        No users have completed their profiles yet.
                                                    @endif
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($userProfiles->hasPages())
                        <!-- Pagination -->
                        <div class="bg-slate-50 dark:bg-slate-700/50 px-6 py-4 border-t border-slate-200 dark:border-slate-700">
                            {{ $userProfiles->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-layouts.app>