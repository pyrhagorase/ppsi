<!DOCTYPE html>

<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencatatan Owner</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/stylepencatatan.css">
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
            <a href="{{ route('owner.dashboard') }}" class="menu-item">
                <i class="fas fa-home"></i>
                Dashboard
            </a>
            <a href="{{route('owner.pencatatan')}}" class="menu-item active">
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
            <h1>Pencatatan</h1>
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
                        <span>Level: {{Auth::user()->role}}</span>
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

    <main class="main-content">
        <div class="form-container">
            <h2>Formulir Registrasi Pelanggan</h2>

            <form action="{{ route('owner.servis.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Generate id-tracking</label>
                    <div class="inline-group">
                        <input type="text" id="trackingId" name="id_tracking" readonly>
                        <button type="button" id="generateBtn">Generate</button>
                    </div>
                </div>

                <div class="form-group">
                    <label>Nama Pelanggan</label>
                    <input type="text" name="nama_pelanggan" required>
                </div>

                <div class="form-group">
                    <label>Kontak Pelanggan</label>
                    <input type="text" name="kontak" required>
                </div>

                <div class="form-group">
                    <label>Waktu Servis</label>
                    <input type="datetime-local" name="waktu_servis" required>
                </div>

                <div class="form-group">
                    <label>Tipe Barang</label>
                    <input type="text" name="tipe_barang" required>
                </div>

                <div class="form-group">
                    <label>Kerusakan</label>
                    <input type="text" name="kerusakan" required>
                </div>

                <div class="form-group">
                    <label>Estimasi Biaya</label>
                    <input type="text" name="biaya" required>
                </div>

                <div class="form-group">
                    <label>Status Pembayaran</label>
                    <select name="status_pembayaran" required>
                        <option value="Belum Lunas">Belum Lunas</option>
                        <option value="Lunas">Lunas</option>
                    </select>
                </div>

                <button type="submit" class="submit-btn">Tambah Data</button>
            </form>
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

        document.getElementById("generateBtn").addEventListener("click", function() {
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            let id = '';
            for (let i = 0; i < 5; i++) {
                const randomIndex = Math.floor(Math.random() * characters.length);
                id += characters[randomIndex];
            }
            document.getElementById("trackingId").value = id;
        });
    </script>

</body>

</html>