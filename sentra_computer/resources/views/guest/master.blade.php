<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sentra Computer - Website Manajemen Servis</title>

    <!-- Bootstrap & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/userstyle.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body class="d-flex flex-column min-vh-100">
    <!-- Header section -->
    <header class="header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <div class="logo-container">
                        <svg class="logo-img" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="20" cy="20" r="20" fill="#7950F2" />
                            <path d="M12 20C12 15.6 15.6 12 20 12C24.4 12 28 15.6 28 20" stroke="white" stroke-width="2" />
                            <circle cx="15" cy="20" r="3" fill="white" />
                            <circle cx="25" cy="20" r="3" fill="white" />
                        </svg>
                        <span class="logo-text">Logoipsum</span>
                    </div>
                </div>

                <!-- Navbar -->
                <div class="col-md-6">
                    <nav class="navbar navbar-expand">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('guest.homepage') ? 'active fw-bold' : '' }}" href="{{ route('guest.homepage') }}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('guest.tracking') ? 'active fw-bold' : '' }}" href="{{ route('guest.tracking') }}">Tracking Services</a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <!-- Guest Buttons (Simplest) -->
                <div class="col-md-3 text-end">
                    <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">
                        <i class="fas fa-arrow-right me-1"></i> Login
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-primary">
                        <i class="fas fa-user me-1"></i> Register
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Page Content -->
    <main class="flex-grow-1 py-4">
        @yield('konten')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-logo">
                <div class="footer-logo-circle">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 10C5 10 7.5 5 10 5C12.5 5 15 10 15 10" stroke="white" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </div>
                <div class="footer-logo-text">Logoipsum</div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>