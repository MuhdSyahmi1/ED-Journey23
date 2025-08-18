<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'EduJourney' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- Navigation Bar -->
    <nav class="bg-white shadow-md fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">

                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-700 hover:text-blue-800 transition-transform transform hover:scale-105">EduJourney</a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-blue-700 font-semibold' : 'text-gray-700 hover:text-blue-700 transition' }}">Home</a>
                    
                    <!-- Authentication Links -->
                    @guest
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-700 transition px-3 py-2 rounded-md text-sm font-medium">Login</a>
                        <a href="{{ route('register') }}" class="bg-blue-700 text-white hover:bg-blue-800 px-4 py-2 rounded-md text-sm font-medium transition">Register</a>
                    @else
                        <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-blue-700 transition px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-700 hover:text-blue-700 transition px-3 py-2 rounded-md text-sm font-medium">Logout</button>
                        </form>
                    @endguest
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button id="menu-button" class="text-gray-700 focus:outline-none" aria-expanded="false">
                        <svg class="h-6 w-6 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>

            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out md:hidden bg-white">
            <a href="{{ route('home') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition">Home</a>

            @guest
                <a href="{{ route('login') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition">Login</a>
                <a href="{{ route('register') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition">Register</a>
            @else
                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 transition">Logout</button>
                </form>
            @endguest
        </div>
    </nav>

    <!-- Page Content -->
    <main class="pt-20 pb-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{ $slot }}
        </div>
    </main>

    <!-- Mobile Menu Script -->
    <script>
        const menuButton = document.getElementById('menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        if (menuButton && mobileMenu) {
            menuButton.addEventListener('click', () => {
                const isOpen = mobileMenu.style.maxHeight && mobileMenu.style.maxHeight !== "0px";
                mobileMenu.style.maxHeight = isOpen ? "0" : mobileMenu.scrollHeight + "px";

                const expanded = menuButton.getAttribute('aria-expanded') === 'true';
                menuButton.setAttribute('aria-expanded', !expanded);

                menuButton.querySelector('svg').classList.toggle('rotate-90');
            });
        }
    </script>

</body>
</html>