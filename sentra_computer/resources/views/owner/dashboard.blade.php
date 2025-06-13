<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Owner</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styledashboard.css">
</head>

<body>
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-logo">
            <div class="logo-icon">
                <i class="fas fa-dice-d20"></i>
            </div>
            <span>Logoipsum</span>
        </div>
        <nav class="sidebar-menu">
            <a href="{{ route('owner.dashboard') }}" class="menu-item active">
                <i class="fas fa-home"></i>
                Dashboard
            </a>
            <a href="{{route('owner.pencatatan')}}" class="menu-item">
                <i class="fas fa-file-alt"></i>
                Pencatatan
            </a>
            <a href="{{route('owner.daftarservis')}}" class="menu-item">
                <i class="fas fa-list"></i>
                Daftar Servis
            </a>
            <a href="{{route('owner.konfirmasibiaya')}}" class="menu-item">
                <i class="fas fa-credit-card"></i>
                Konfirmasi Biaya
            </a>
            <a href="{{route('owner.diproses')}}" class="menu-item">
                <i class="fas fa-cogs"></i>
                Diproses
            </a>
            <a href="{{route('owner.selesai')}}" class="menu-item">
                <i class="fas fa-check-circle"></i>
                Selesai
            </a>
            <a href="{{route('owner.lunas')}}" class="menu-item">
                <i class="fas fa-clock"></i>
                Lunas
            </a>
            <a href="{{route('owner.rekap')}}" class="menu-item">
                <i class="fas fa-file-invoice"></i>
                Rekap Pemasukan
            </a>
             <a href="{{route('owner.ulasan')}}" class="menu-item">
                <i class="fas fa-comment-dots"></i>
                Kelola Ulasan
            </a>
            <a href="{{route('owner.akunpelanggan')}}" class="menu-item">
                <i class="fas fa-users"></i>
                Akun Pelanggan
            </a>
            <a href="{{route('owner.tambahadmin')}}" class="menu-item">
                <i class="fas fa-user-plus"></i>
                Tambah Admin
            </a>
        </nav>
    </aside>

    <!-- Header -->
    <header class="header">
        <div class="header-left">
            <button class="menu-toggle" id="menu-toggle">
                <i class="fas fa-bars"></i>
            </button>
            <h1>Dashboard</h1>
        </div>
        <div class="user-profile">
            <span class="user-email">{{Auth::user()->email}}</span>
            <div class="user-dropdown">
                <button class="dropdown-toggle" id="dropdown-toggle">
                    <div class="user-avatar"></div>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="dropdown-menu" id="dropdown-menu">
                    <div class="dropdown-item">
                        <i class="fas fa-user-shield"></i>
                        <span>Level:{{Auth::user()->role}}</span>
                    </div>
                    <div class="dropdown-divider"></div>
                    <a href="{{route('actionlogout')}}" class="dropdown-item">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

   <!-- Main Content -->
    <main class="main-content">
        <!-- Info Cards -->
        <div class="info-cards">
            <div class="info-card info-card-blue">
                <div class="info-content">
                    <div class="info-icon">
                        <i class="fas fa-list"></i>
                    </div>
                    <div class="info-text">
                        <h3 class="info-title">Total Daftar Servis</h3>
                        <p class="info-value">{{ $totalServis }}</p>
                        <span class="info-subtitle">Keseluruhan</span>
                    </div>
                </div>
            </div>

            <div class="info-card info-card-orange">
                <div class="info-content">
                    <div class="info-icon">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <div class="info-text">
                        <h3 class="info-title">Total Servis Diproses</h3>
                        <p class="info-value">{{ $totalDiproses }}</p>
                        <span class="info-subtitle">Sedang Berlangsung</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="nav-grid">

            <!-- Pencatatan -->
            <a href="{{route('owner.pencatatan')}}" class="nav-item">
                <div class="nav-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <span class="nav-label">Pencatatan</span>
            </a>

            <!-- Daftar Servis -->
            <a href="{{route('owner.daftarservis')}}" class="nav-item">
                <div class="nav-icon">
                    <i class="fas fa-list"></i>
                </div>
                <span class="nav-label">Daftar Servis</span>
            </a>

            <!-- Konfirmasi Biaya -->
            <a href="{{route('owner.konfirmasibiaya')}}" class="nav-item">
                <div class="nav-icon">
                    <i class="fas fa-credit-card"></i>
                </div>
                <span class="nav-label">Konfirmasi Biaya</span>
            </a>

            <!-- Diproses -->
            <a href="{{route('owner.diproses')}}" class="nav-item">
                <div class="nav-icon">
                    <i class="fas fa-cogs"></i>
                </div>
                <span class="nav-label">Diproses</span>
            </a>

            <!-- Selesai -->
            <a href="{{route('owner.selesai')}}" class="nav-item">
                <div class="nav-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <span class="nav-label">Selesai</span>
            </a>

            <!-- Lunas -->
            <a href="{{route('owner.lunas')}}" class="nav-item">
                <div class="nav-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <span class="nav-label">Lunas</span>
            </a>

            <!-- Rekap Pemasukan -->
            <a href="{{route('owner.rekap')}}" class="nav-item">
                <div class="nav-icon">
                    <i class="fas fa-file-invoice"></i>
                </div>
                <span class="nav-label">Rekap Pemasukan</span>
            </a>

            <!-- Kelola Ulasan dan Rating -->
            <a href="{{route('owner.ulasan')}}" class="nav-item">
                <div class="nav-icon">
                    <i class="fas fa-comment-dots"></i>
                </div>
                <span class="nav-label">Kelola Ulasan</span>
            </a>

            <!-- Akun Pelanggan -->
            <a href="{{route('owner.akunpelanggan')}}" class="nav-item">
                <div class="nav-icon">
                    <i class="fas fa-users"></i>
                </div>
                <span class="nav-label">Akun Pelanggan</span>
            </a>

            <!-- Tambah Admin -->
            <a href="{{route('owner.tambahadmin')}}" class="nav-item">
                <div class="nav-icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <span class="nav-label">Tambah Admin</span>
            </a>
        </div>

        <!-- Footer -->
        <footer class="footer">
            <div class="footer-logo">
                <div class="logo-icon">
                    <i class="fas fa-dice-d20"></i>
                </div>
                <span>Logoipsum</span>
            </div>
        </footer>
    </main>

    <script>
        // Toggle sidebar visibility for mobile
        document.getElementById('menu-toggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const menuToggle = document.getElementById('menu-toggle');

            if (window.innerWidth <= 768 &&
                !sidebar.contains(event.target) &&
                !menuToggle.contains(event.target) &&
                sidebar.classList.contains('active')) {
                sidebar.classList.remove('active');
            }
        });

        // Responsive adjustments
        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('sidebar');
            if (window.innerWidth > 768) {
                sidebar.classList.remove('active');
            }
        });

        // User Dropdown Menu Toggle
        const dropdownToggle = document.getElementById('dropdown-toggle');
        const dropdownMenu = document.getElementById('dropdown-menu');

        dropdownToggle.addEventListener('click', function(event) {
            event.stopPropagation();
            dropdownMenu.classList.toggle('show');
            const chevronIcon = this.querySelector('.fa-chevron-down');
            if (chevronIcon) {
                chevronIcon.style.transform = dropdownMenu.classList.contains('show') ? 'rotate(180deg)' : 'rotate(0)';
            }
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!dropdownToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.remove('show');
                const chevronIcon = dropdownToggle.querySelector('.fa-chevron-down');
                if (chevronIcon) {
                    chevronIcon.style.transform = 'rotate(0)';
                }
            }
        });
    </script>

</body>

</html>