<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <link rel="icon" type="image/png" href="{{ asset('images/user/pb_icon.png') }}">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:sidebar sticky stashable class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ route('dashboard') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
                <div x-data="{
                    appearance: $flux.appearance,
                    isDark() {
                        if (this.appearance === 'dark') return true;
                        if (this.appearance === 'light') return false;
                        // System preference
                        return window.matchMedia('(prefers-color-scheme: dark)').matches;
                    }
                }" 
                x-init="$watch('appearance', () => $nextTick(() => {}))">
                    <!-- Light mode logo -->
                    <img x-show="!isDark()" 
                        src="{{ asset('images/PB_LOGO_Light.png') }}" 
                        alt="EduJourney" 
                        class="h-15 w-auto"
                        x-transition>
                    
                    <!-- Dark mode logo -->
                    <img x-show="isDark()" 
                        src="{{ asset('images/PB_LOGO.png') }}" 
                        alt="EduJourney" 
                        class="h-15 w-auto"
                        x-transition>
                </div>
            </a>

            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Platform')" class="grid">
                    <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>{{ __('Dashboard') }}</flux:navlist.item>
                </flux:navlist.group>

                {{-- Admin Navigation --}}
                @if(auth()->user()->role === 'admin')
                    <flux:navlist.item icon="users" :href="route('admin.manage-account')" :current="request()->routeIs('admin.manage-account')" wire:navigate>
                        {{ __('Manage Account') }}
                    </flux:navlist.item>

                    <flux:navlist.item icon="chat-bubble-left-right" :href="route('admin.feedback')" :current="request()->routeIs('admin.feedback')" wire:navigate>
                        {{ __('Feedback') }}
                    </flux:navlist.item>
                @endif

                {{-- Staff Navigation - Role Based --}}
                @if(auth()->user()->role === 'staff')
                    {{-- Program Manager Navigation --}}
                    @if(auth()->user()->isProgramManager())
                        <flux:navlist.group :heading="__('Program Management')" class="grid">
                            <flux:navlist.item icon="academic-cap" href="/staff/program/programme-management" wire:navigate>
                                {{ __('Programme Management') }}
                            </flux:navlist.item>
                            <flux:navlist.item icon="chat-bubble-left-right" :href="route('staff.program.feedback')" :current="request()->routeIs('staff.program.feedback*')" wire:navigate>
                                {{ __('Feedback Center') }}
                            </flux:navlist.item>
                        </flux:navlist.group>
                    @endif

                    {{-- Admission Manager Navigation --}}
                    @if(auth()->user()->isAdmissionManager())
                        <flux:navlist.group :heading="__('Admission Management')" class="grid">
                            <flux:navlist.item icon="user-circle" :href="route('staff.admission.user-profile')" :current="request()->routeIs('staff.admission.user-profile*')" wire:navigate>
                                {{ __('User Profile') }}
                            </flux:navlist.item>
                            <flux:navlist.item icon="document-text" :href="route('staff.case-reports')" :current="request()->routeIs('staff.case-reports')" wire:navigate>
                                {{ __('Case Report') }}
                            </flux:navlist.item>
                            <flux:navlist.item icon="chart-bar" href="#" wire:navigate>
                                {{ __('Report Data') }}
                            </flux:navlist.item>
                            <flux:navlist.item icon="bell" href="#" wire:navigate>
                                {{ __('Notifications') }}
                            </flux:navlist.item>
                            <flux:navlist.item icon="chat-bubble-left-right" :href="route('staff.feedback')" :current="request()->routeIs('staff.feedback')" wire:navigate>
                                {{ __('Feedback Center') }}
                            </flux:navlist.item>
                            <flux:navlist.item icon="academic-cap" href="{{ route('staff.admission.programme-management') }}" wire:navigate>
                                {{ __('Program Management') }}
                            </flux:navlist.item>
                        </flux:navlist.group>
                    @endif

                    {{-- News & Events Manager Navigation --}}
                    @if(auth()->user()->isNewsEventsManager())
                        <flux:navlist.group :heading="__('News & Events')" class="grid">
                            <flux:navlist.item icon="newspaper" href="#" wire:navigate>
                                {{ __('News Management') }}
                            </flux:navlist.item>
                            <flux:navlist.item icon="calendar-days" href="#" wire:navigate>
                                {{ __('Event Planning') }}
                            </flux:navlist.item>
                            <flux:navlist.item icon="calendar" href="#" wire:navigate>
                                {{ __('Content Calendar') }}
                            </flux:navlist.item>
                            <flux:navlist.item icon="chat-bubble-left-right" :href="route('staff.feedback')" :current="request()->routeIs('staff.feedback')" wire:navigate>
                                {{ __('Feedback Center') }}
                            </flux:navlist.item>
                        </flux:navlist.group>
                    @endif

                    {{-- Moderator Navigation --}}
                    @if(auth()->user()->isModerator())
                        <flux:navlist.group :heading="__('Moderation')" class="grid">
                            <flux:navlist.item icon="shield-check" href="#" wire:navigate>
                                {{ __('Content Moderation') }}
                            </flux:navlist.item>
                            <flux:navlist.item icon="users" href="#" wire:navigate>
                                {{ __('User Management') }}
                            </flux:navlist.item>
                            <flux:navlist.item icon="document-check" href="#" wire:navigate>
                                {{ __('Moderation Reports') }}
                            </flux:navlist.item>
                            <flux:navlist.item icon="chat-bubble-left-right" :href="route('staff.feedback')" :current="request()->routeIs('staff.feedback')" wire:navigate>
                                {{ __('Feedback Center') }}
                            </flux:navlist.item>
                        </flux:navlist.group>
                    @endif

                    {{-- Data & Analytics Manager Navigation --}}
                    @if(auth()->user()->isDataAnalyticsManager())
                        <flux:navlist.group :heading="__('Data & Analytics')" class="grid">
                            <flux:navlist.item icon="chart-bar-square" href="#" wire:navigate>
                                {{ __('Data Analytics') }}
                            </flux:navlist.item>
                            <flux:navlist.item icon="presentation-chart-line" href="#" wire:navigate>
                                {{ __('Performance Metrics') }}
                            </flux:navlist.item>
                            <flux:navlist.item icon="document-chart-bar" href="#" wire:navigate>
                                {{ __('Custom Reports') }}
                            </flux:navlist.item>
                            <flux:navlist.item icon="chat-bubble-left-right" :href="route('staff.feedback')" :current="request()->routeIs('staff.feedback')" wire:navigate>
                                {{ __('Feedback Center') }}
                            </flux:navlist.item>
                        </flux:navlist.group>
                    @endif

                    {{-- Common Staff Navigation --}}
                    <flux:navlist.group :heading="__('General')" class="grid">
                        <flux:navlist.item icon="user-circle" :href="route('staff.profile-information')" :current="request()->routeIs('staff.profile-information')" wire:navigate>
                            {{ __('Profile Information') }}
                        </flux:navlist.item>
                    </flux:navlist.group>
                @endif

                {{-- User Navigation - Updated with new menu items --}}
@if(auth()->user()->role === 'user')
    <flux:navlist.group :heading="__('My Profile')" class="grid">
        <div class="relative">
            <flux:navlist.item icon="pencil-square" :href="route('user.profile')" :current="request()->routeIs('user.profile.*')" wire:navigate>
                {{ __('Update Profile') }}
            </flux:navlist.item>
            @php
                $profileExists = \DB::table('user_profiles')->where('user_id', auth()->id())->exists();
                if ($profileExists) {
                    $profile = \DB::table('user_profiles')->where('user_id', auth()->id())->first();
                    $requiredFields = [
                        'ic_file_path', 'name', 'identity_card', 'id_color', 'postal_address',
                        'date_of_birth', 'place_of_birth', 'mobile_phone',
                        'gender', 'religion', 'nationality', 'race', 'email_address'
                    ];
                    $completedFields = 0;
                    foreach ($requiredFields as $field) {
                        if (!empty($profile->$field)) {
                            $completedFields++;
                        }
                    }
                    $progress = round(($completedFields / count($requiredFields)) * 100);
                } else {
                    $progress = 0;
                }
                $badgeColor = $progress === 100 ? 'green' : ($progress > 0 ? 'orange' : 'red');
            @endphp
            <div class="ml-9 -mt-1 mb-2">
                <flux:badge size="sm" color="{{ $badgeColor }}">{{ $progress }}% Complete</flux:badge>
            </div>
        </div>

                        <div class="relative">
                            <flux:navlist.item icon="document-text" :href="route('user.questionnaire')" :current="request()->routeIs('user.questionnaire*')" wire:navigate>
                                {{ __('Complete Questionnaire') }}
                            </flux:navlist.item>
                                @php
                                $hasCompleted = \DB::table('user_questionnaire_responses')
                                ->where('user_id', auth()->id())
                                ->exists();
                                $progress = $hasCompleted ? 100 : 0;
                                $badgeColor = $hasCompleted ? 'green' : 'red';
                                @endphp
                                <div class="ml-9 -mt-1 mb-2">
                                    <flux:badge size="sm" color="{{ $badgeColor }}">{{ $progress }}% Complete</flux:badge>
                                </div>
                        </div>

                        <div class="relative">
                            <flux:navlist.item icon="cloud-arrow-up" :href="route('user.upload-result')" :current="request()->routeIs('user.upload-result')" wire:navigate>
                                {{ __('Upload Result') }}
                            </flux:navlist.item>
                            <div class="ml-9 -mt-1 mb-2">
                                <flux:badge size="sm" color="red">{{ __('0% Complete') }}</flux:badge>
                            </div>
                        </div>
                    </flux:navlist.group>

                    <flux:navlist.group :heading="__('Services')" class="grid">
                        <flux:navlist.item icon="academic-cap" :href="route('user.school')" :current="request()->routeIs('user.school')" wire:navigate>
                            {{ __('Schools') }}
                        </flux:navlist.item>

                        <flux:navlist.item icon="light-bulb" :href="route('user.recommendations')" :current="request()->routeIs('user.recommendations')" wire:navigate>
                            {{ __('Get Recommendations') }}
                        </flux:navlist.item>

                        <flux:navlist.item icon="building-library" :href="route('user.hecas-info')" :current="request()->routeIs('user.hecas-info')" wire:navigate>
                            {{ __('HECAS Information') }}
                        </flux:navlist.item>

                        <flux:navlist.item icon="heart" :href="route('user.favourites')" :current="request()->routeIs('user.favourites')" wire:navigate>
                            {{ __('My Favourite') }}
                        </flux:navlist.item>
                    </flux:navlist.group>

                    <flux:navlist.group :heading="__('Support')" class="grid">
                        <flux:navlist.item icon="chat-bubble-left-right" :href="route('user.feedback')" :current="request()->routeIs('user.feedback')" wire:navigate>
                            {{ __('Feedback') }}
                        </flux:navlist.item>

                        <flux:navlist.item icon="question-mark-circle" :href="route('user.help')" :current="request()->routeIs('user.help')" wire:navigate>
                            {{ __('Help') }}
                        </flux:navlist.item>
                    </flux:navlist.group>
                @endif
            </flux:navlist>

            <flux:spacer />

            <!-- Desktop User Menu -->
            <flux:dropdown class="hidden lg:block" position="bottom" align="start">
                <flux:profile
                    :name="auth()->user()->name"
                    :initials="auth()->user()->initials()"
                    icon:trailing="chevrons-up-down"
                />

                <flux:menu class="w-[220px]">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                    {{-- Display user role --}}
                                    <span class="truncate text-xs text-zinc-500 capitalize">
                                        {{ auth()->user()->role ?? 'User' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                    <span class="truncate text-xs text-zinc-500 capitalize">
                                        {{ auth()->user()->role ?? 'User' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @fluxScripts
        <script>
// Listen for system preference changes and update Flux accordingly
window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function(e) {
    // Only update if system mode is selected
    if (document.querySelector('[x-data]')?.__x?.$data?.appearance === 'system') {
        // Force a reactivity update
        document.dispatchEvent(new CustomEvent('appearance-changed'));
    }
});

// Debug: Log appearance changes
document.addEventListener('DOMContentLoaded', function() {
    // Watch for Flux appearance changes
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === 'attributes' && 
                (mutation.attributeName === 'class' || mutation.attributeName === 'data-theme')) {
                console.log('Theme changed - HTML classes:', document.documentElement.className);
                console.log('Data theme:', document.documentElement.getAttribute('data-theme'));
            }
        });
    });
    
    observer.observe(document.documentElement, {
        attributes: true,
        attributeFilter: ['class', 'data-theme', 'style']
    });
});
</script>   
    </body>
</html>