<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'EduJourney' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #5DADE2;
            --secondary-color: #34a853;
            --accent-color: #ea4335;
            --warning-color: #fbbc04;
            --purple-color: #9c27b0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
        }

        /* Navigation Styles */
        .navbar {
            background: linear-gradient(135deg, #5DADE2 0%, #3498DB 100%);
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        /* Logo Styles */
        .navbar-logo {
            height: 124px;
            width: auto;
            max-width: 124px;
            object-fit: contain;
            transition: transform 0.3s ease;
        }

        .navbar-brand {
            display: flex !important;
            align-items: center;
            font-weight: bold;
            font-size: 1.5rem;
            color: white !important;
            transition: transform 0.3s ease;
            text-decoration: none;
            padding: 0.5rem 0;
        }

        .navbar-brand:hover {
            transform: scale(1.05);
            color: white !important;
        }

        .navbar-brand:hover .navbar-logo {
            transform: scale(1.1);
        }

        .navbar-nav .nav-link {
            color: white !important;
            font-weight: 500;
            margin: 0 10px;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: #f8f9fa !important;
            transform: translateY(-2px);
        }

        .dropdown-menu {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: none;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            border-radius: 10px;
        }

        .dropdown-item {
            color: #333;
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background: linear-gradient(135deg, #5DADE2 0%, #3498DB 100%);
            color: white;
        }

        /* Auth Buttons */
        .btn-auth {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
            padding: 8px 20px;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-auth:hover {
            background: white;
            color: #5DADE2;
            transform: translateY(-2px);
        }

        .btn-auth-primary {
            background: white;
            color: #5DADE2;
            border: 2px solid white;
        }

        .btn-auth-primary:hover {
            background: rgba(255, 255, 255, 0.9);
            color: #3498DB;
        }

        /* Mobile Menu Styles */
        .navbar-toggler {
            border: none;
            padding: 4px 8px;
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        .navbar-collapse {
            background: linear-gradient(135deg, #5DADE2 0%, #3498DB 100%);
            margin-top: 10px;
            border-radius: 10px;
            padding: 15px;
        }

        /* Responsive logo adjustments */
        @media (max-width: 768px) {
            .navbar-logo {
                height: 30px;
                max-width: 30px;
            }
        }

        @media (max-width: 480px) {
            .navbar-logo {
                height: 25px;
                max-width: 25px;
            }
        }

        @media (max-width: 991.98px) {
            .navbar-nav .nav-link {
                margin: 5px 0;
                padding: 10px 15px;
                border-radius: 8px;
                transition: all 0.3s ease;
            }

            .navbar-nav .nav-link:hover {
                background: rgba(255, 255, 255, 0.1);
                transform: translateX(5px);
            }

            .btn-auth {
                margin: 5px 0;
                text-align: center;
                display: block;
            }
        }
    </style>
</head>
<body class="bg-light text-dark">

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <!-- Logo Section -->
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <img src="{{ asset('images/pb_logo.png') }}" alt="School Logo" class="navbar-logo me-2">
            </a>
            
            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Navigation Menu -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active fw-bold' : '' }}" href="{{ route('home') }}">
                            <i class="fas fa-home me-1"></i>Home
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="schoolsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-university me-1"></i>Schools
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="schoolsDropdown">
                            <li><a class="dropdown-item" href="#schools"><i class="fas fa-briefcase me-2 text-success"></i>School of Business</a></li>
                            <li><a class="dropdown-item" href="#schools"><i class="fas fa-heartbeat me-2 text-danger"></i>School of Health Sciences</a></li>
                            <li><a class="dropdown-item" href="#schools"><i class="fas fa-laptop-code me-2 text-purple"></i>School of ICT</a></li>
                            <li><a class="dropdown-item" href="#schools"><i class="fas fa-cogs me-2 text-primary"></i>School of Science & Engineering</a></li>
                            <li><a class="dropdown-item" href="#schools"><i class="fas fa-industry me-2 text-warning"></i>School of Petrochemical</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#help">
                            <i class="fas fa-question-circle me-1"></i>Help
                        </a>
                    </li>
                </ul>

                <!-- Authentication Links -->
                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item me-2">
                            <a href="{{ route('login') }}" class="btn-auth">
                                <i class="fas fa-sign-in-alt me-1"></i>Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="btn-auth btn-auth-primary">
                                <i class="fas fa-user-plus me-1"></i>Register
                            </a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle me-1"></i>{{ Auth::user()->name ?? 'User' }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main style="padding-top: 80px;">
        {{ $slot }}
    </main>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add active class to current navigation item
        const currentLocation = location.pathname;
        const menuItems = document.querySelectorAll('.navbar-nav .nav-link');
        menuItems.forEach(item => {
            if(item.getAttribute('href') === currentLocation){
                item.classList.add('active', 'fw-bold');
            }
        });

        // Close mobile menu when clicking on a link
        document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
            link.addEventListener('click', () => {
                const navbarCollapse = document.querySelector('.navbar-collapse');
                if (navbarCollapse.classList.contains('show')) {
                    const bsCollapse = new bootstrap.Collapse(navbarCollapse);
                    bsCollapse.hide();
                }
            });
        });
    </script>

</body>
</html>