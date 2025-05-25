<!DOCTYPE html>

<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Owner</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styledetail.css">
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
            <a href="{{route('owner.pencatatan')}}" class="menu-item">
                <i class="fas fa-file-alt"></i>
                Pencatatan
            </a>
            <a href="{{route('owner.daftarservis')}}" class="menu-item">
                <i class="fas fa-list"></i>
                Daftar Servis
            </a>
            <a href="{{route('owner.konfirmasibiaya')}}" class="menu-item active">
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
            <h1>Konfirmasi Biaya</h1>
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
        <!-- === Konten Tambahan di Atas Form Registrasi === -->
        <div style="margin-bottom: 30px;">
            <h2>Status Servis</h2>

            <!-- Kotak Status Horizontal -->
            <div class="status-box">
                Konfirmasi Biaya
            </div>

            <!-- Keterangan -->
            <h4 style="margin-top: 20px;">Keterangan</h4>
            <textarea id="keterangan" style="width: 100%; height: 120px; padding: 10px; font-size: 16px;"></textarea>

            <!-- Tombol Aksi -->
            <div class="button-group">
                <button class="btn-status" id="statusBtn">Status Servis</button>
                <button class="btn-keterangan" id="editBtn">Update Keterangan</button>
            </div>

            <!-- Modal Overlay (untuk ubah status servis) -->
            <div id="statusModal" class="modal-overlay">
                <div class="modal-box">
                    <h3>Ubah Status Servis</h3>
                    <select id="statusSelect">
                        <option value="Konfirmasi Biaya">Konfirmasi Biaya</option>
                        <option value="Diproses">Diproses</option>
                        <option value="Selesai">Selesai</option>
                        <option value="Lunas">Lunas</option>
                    </select>
                    <div class="modal-actions">
                        <button class="btn-cancel" onclick="closeModal()">Batal</button>
                        <button class="btn-save" onclick="ubahStatus()">Simpan</button>
                    </div>
                </div>
            </div>


            <div class="form-container">
                <h2>Formulir Registrasi Pelanggan</h2>
                <div class="form-group">
                    <label>Generate id-tracking</label>
                    <div class="inline-group">
                        <input type="text" id="trackingId">
                        <button type="button" id="generateBtn">Generate</button>

                    </div>
                </div>

                <div class="form-group">
                    <label>Nama Pelanggan</label>
                    <input type="text">
                </div>

                <div class="form-group">
                    <label>Kontak Pelanggan</label>
                    <input type="text">
                </div>

                <div class="form-group">
                    <label>Waktu Servis</label>
                    <input type="date">
                </div>

                <div class="form-group">
                    <label>Tipe Barang</label>
                    <input type="text">
                </div>

                <div class="form-group">
                    <label>Kerusakan</label>
                    <input type="text">
                </div>

                <div class="form-group">
                    <label>Estimasi Biaya</label>
                    <input type="text">
                </div>

                <div class="form-group">
                    <label>Status Pembayaran</label>
                    <input type="text">
                </div>

                <button class="submit-btn">Tambah Data</button>
            </div>
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

        // Tampilkan Modal
        document.getElementById("statusBtn").addEventListener("click", function() {
            document.getElementById("statusModal").style.display = "flex";
        });

        // Tutup Modal
        function closeModal() {
            document.getElementById("statusModal").style.display = "none";
        }

        // Ubah isi kotak status
        function ubahStatus() {
            const selected = document.getElementById("statusSelect").value;
            const box = document.querySelector(".status-box");

            // Hapus semua class status lama
            box.classList.remove("status-konfirmasi", "status-diproses", "status-selesai", "status-lunas");

            // Set text dan tambahkan class sesuai status
            box.textContent = selected;

            switch (selected) {
                case "Konfirmasi Biaya":
                    box.classList.add("status-konfirmasi");
                    break;
                case "Diproses":
                    box.classList.add("status-diproses");
                    break;
                case "Selesai":
                    box.classList.add("status-selesai");
                    break;
                case "Lunas":
                    box.classList.add("status-lunas");
                    break;
            }

            closeModal();
        }

        // Edit keterangan
        document.getElementById("editBtn").addEventListener("click", function() {
            alert("Keterangan diperbarui: \n\n" + document.getElementById("keterangan").value);
        });
    </script>

</body>

</html>