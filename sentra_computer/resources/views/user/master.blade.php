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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #333;
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        .header {
            padding: 15px 0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            background-color: #fff;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .logo-container {
            display: flex;
            align-items: center;
        }
        
        .logo-text {
            font-weight: 600;
            font-size: 16px;
            margin-left: 10px;
            color: #333;
        }
        
        .logo-img {
            width: 32px;
            height: 32px;
        }
        
        .navbar-nav {
            display: flex;
            justify-content: center;
            width: 100%;
        }
        
        .nav-item {
            margin: 0 15px;
        }
        
        .nav-link {
            color: #666;
            font-weight: 500;
            padding: 8px 0;
            font-size: 14px;
            transition: color 0.3s;
        }
        
        .nav-link:hover {
            color: #0d6efd;
        }
        
        .nav-link.active {
            color: #0d6efd;
            font-weight: 600;
        }
        
        .user-profile {
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }
        
        .user-email {
            margin-right: 12px;
            font-weight: 500;
            font-size: 14px;
            color: #333;
        }
        
        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: #e9ecef;
            cursor: pointer;
            overflow: hidden;
        }
        
        .content-container {
            margin-top: 0;
            flex: 1;
        }
        
        /* Hero section styles */
        .hero-section {
            background-color: #e6f3fb;
            padding: 70px 0;
            text-align: center;
        }
        
        .hero-section h1 {
            font-weight: 700;
            color: #212529;
            font-size: 2.8rem;
        }
        
        .hero-section p {
            color: #6c757d;
            font-size: 1.2rem;
            margin-bottom: 30px;
        }
        
        .hero-section .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
            padding: 10px 25px;
            font-weight: 500;
            border-radius: 4px;
            font-size: 14px;
        }
        
        .dropdown-toggle::after {
            display: none;
        }
        
        /* Testimonial section */
        .testimonial-section {
            padding: 50px 0;
        }
        
        .testimonial-card {
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 20px;
            height: 100%;
            box-shadow: none;
            transition: all 0.3s ease;
            background: white;
        }
        
        .testimonial-card:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
        
        .testimonial-author {
            display: flex;
            align-items: center;
            margin-top: 20px;
        }
        
        .testimonial-author img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 15px;
        }
        
        .testimonial-author-info h5 {
            margin: 0;
            font-size: 14px;
            font-weight: 600;
        }
        
        .testimonial-author-info p {
            margin: 0;
            font-size: 12px;
            color: #6c757d;
        }
        
        /* Footer */
        .footer {
            background-color: #000;
            color: white;
            padding: 25px 0;
            text-align: center;
        }
        
        .footer-logo {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .footer-logo-circle {
            background-color: #7950F2;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
        }
        
        .footer-logo-text {
            color: white;
            font-weight: 600;
            font-size: 20px;
        }
        
        /* Overlay */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1500;
            display: none;
            justify-content: center;
            align-items: center;
        }
        
        .overlay-content {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            max-width: 400px;
            width: 100%;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
        }
        
        .overlay-content h3 {
            margin-bottom: 20px;
            color: #212529;
        }
        
        .overlay-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 25px;
        }
        
        .overlay-buttons .btn {
            padding: 8px 20px;
            font-weight: 500;
        }
        
        /* Logout Button */
        .logout-btn {
            color: #dc3545;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 8px 15px;
            border-radius: 4px;
            transition: background-color 0.3s, color 0.3s;
        }
        
        .logout-btn:hover {
            background-color: #f8d7da;
            color: #dc3545;
        }
        
        .logout-btn i {
            margin-right: 8px;
        }
    </style>
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
                            <path d="M12 20C12 15.6 15.6 12 20 12C24.4 12 28 15.6 28 20" stroke="white" stroke-width="2"/>
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
                                <a class="nav-link" href="{{route('user.homepage')}}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('user.userservice')}}">Tracking Services</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('user.tracking')}}">My Services</a>
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
                                <li><hr class="dropdown-divider"></li>
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
                        <path d="M5 10C5 10 7.5 5 10 5C12.5 5 15 10 15 10" stroke="white" stroke-width="2" stroke-linecap="round"/>
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
                <form action="/logout" method="POST" style="display: inline;">
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