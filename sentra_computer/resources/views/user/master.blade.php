<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sentra Computer - Website Manajemen Servis</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/userstyle.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
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

                <div class="col-md-6">
                    <nav class="navbar navbar-expand">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('user.homepage') ? 'active' : '' }}" href="{{ route('user.homepage') }}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('user.userservice') ? 'active' : '' }}" href="{{ route('user.userservice') }}">Tracking Services</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('user.tracking') ? 'active' : '' }}" href="{{ route('user.tracking') }}">My Services</a>
                            </li>
                        </ul>
                    </nav>
                </div>

                <div class="col-md-3">
                    <div class="user-profile">
                        <div class="user-email">
                            <i class="fa-regular fa-user me-1"></i>
                            {{Auth::user()->email ?? 'user@gmail.com'}}
                        </div>
                        <div class="dropdown">
                            <div class="user-avatar dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="/api/placeholder/36/36" class="w-100 h-100" alt="User Avatar">
                            </div>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item">Level: {{Auth::user()->role ?? 'User'}}</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item logout-btn" href="{{route('actionlogout')}}" id="logoutBtn">
                                        <i class="fa-solid fa-power-off"></i> Log Out
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Container untuk konten halaman -->
    <div class="content-container">
        @yield('konten')
    </div>

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

    <!-- Logout Confirmation Overlay -->
    <div class="overlay" id="logoutOverlay">
        <div class="overlay-content">
            <h3>Logout Confirmation</h3>
            <p>Are you sure you want to logout from your account?</p>
            <div class="overlay-buttons">
                <button class="btn btn-secondary" id="cancelLogout">Cancel</button>
                <form action="/" method="GET" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Logout Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const logoutBtn = document.getElementById('logoutBtn');
            const logoutOverlay = document.getElementById('logoutOverlay');
            const cancelLogout = document.getElementById('cancelLogout');

            // Show overlay when logout button is clicked
            logoutBtn.addEventListener('click', function(e) {
                e.preventDefault();
                logoutOverlay.style.display = 'flex';
            });

            // Hide overlay when cancel button is clicked
            cancelLogout.addEventListener('click', function() {
                logoutOverlay.style.display = 'none';
            });

            // Close overlay when clicking outside the content
            logoutOverlay.addEventListener('click', function(e) {
                if (e.target === logoutOverlay) {
                    logoutOverlay.style.display = 'none';
                }
            });
        });
    </script>
</body>

</html>