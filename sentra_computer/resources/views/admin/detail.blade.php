<!DOCTYPE html>

<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Admin</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styledetail.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}"> </head>

<body>

    <aside class="sidebar" id="sidebar">
        <div class="sidebar-logo">
            <div class="logo-icon">
                <i class="fas fa-dice-d20"></i>
            </div>
            <span>Logoipsum</span>
        </div>
        <nav class="sidebar-menu">
            <a href="{{route('admin.dashboard')}}" class="menu-item">
                <i class="fas fa-home"></i>
                Dashboard
            </a>
            <a href="{{route('admin.pencatatan')}}" class="menu-item">
                <i class="fas fa-file-alt"></i>
                Pencatatan
            </a>
            <a href="{{route('admin.daftarservis')}}" class="menu-item">
                <i class="fas fa-list"></i>
                Daftar Servis
            </a>
            <a href="{{route('admin.konfirmasibiaya')}}" class="menu-item">
                <i class="fas fa-credit-card"></i>
                Konfirmasi Biaya
            </a>
            <a href="{{route('admin.diproses')}}" class="menu-item">
                <i class="fas fa-cogs"></i>
                Diproses
            </a>
            <a href="{{route('admin.selesai')}}" class="menu-item">
                <i class="fas fa-check-circle"></i>
                Selesai
            </a>
            <a href="{{route('admin.lunas')}}" class="menu-item">
                <i class="fas fa-clock"></i>
                Lunas
            </a>
            <a href="{{route('admin.rekap')}}" class="menu-item">
                <i class="fas fa-file-invoice"></i>
                Rekap Pemasukan
            </a>
        </nav>
    </aside>

    <header class="header">
        <div class="header-left">
            <button class="menu-toggle" id="menu-toggle">
                <i class="fas fa-bars"></i>
            </button>
            <h1>Detail Servis: {{ $servis->id_tracking ?? 'N/A' }}</h1> </div>
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
        <div style="margin-bottom: 30px;">
            <h2>Status Servis</h2>

            <div class="status-box" id="currentStatusBox">
                {{ $servis->statusservis ?? 'Belum Ada Status' }} </div>

            <h4 style="margin-top: 20px;">Keterangan</h4>
            <textarea id="keterangan" style="width: 100%; height: 120px; padding: 10px; font-size: 16px;">{{ $servis->keterangan ?? '' }}</textarea>

            <div class="button-group">
                <button class="btn-status" id="statusBtn">Status Servis</button>
                <button class="btn-keterangan" id="editBtn">Update Keterangan</button>
            </div>

            <div id="statusModal" class="modal-overlay">
                <div class="modal-box">
                    <h3>Ubah Status Servis</h3>
                    <select id="statusSelect">
                        <option value="KonfirmasiBiaya" {{ ($servis->statusservis ?? '') == 'KonfirmasiBiaya' ? 'selected' : '' }}>Konfirmasi Biaya</option>
                        <option value="Diproses" {{ ($servis->statusservis ?? '') == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="Selesai" {{ ($servis->statusservis ?? '') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="Lunas" {{ ($servis->statusservis ?? '') == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                    </select>
                    <div class="modal-actions">
                        <button class="btn-cancel" onclick="closeModal()">Batal</button>
                        <button class="btn-save" onclick="ubahStatus()">Simpan</button>
                    </div>
                </div>
            </div>


            <div class="form-container">
                <h2>Formulir Detail Servis</h2> <input type="hidden" id="trackingId" value="{{ $servis->id_tracking ?? '' }}">

                <div class="form-group">
                    <label>ID Tracking</label>
                    <input type="text" value="{{ $servis->id_tracking ?? '' }}" readonly>
                </div>

                <div class="form-group">
                    <label>Nama Pelanggan</label>
                    <input type="text" value="{{ $servis->nama_pelanggan ?? '' }}">
                </div>

                <div class="form-group">
                    <label>Kontak Pelanggan</label>
                    <input type="text" value="{{ $servis->kontak ?? '' }}">
                </div>

                <div class="form-group">
                    <label>Waktu Servis</label>
                    <input type="date" value="{{ \Carbon\Carbon::parse($servis->waktu_servis ?? now())->format('Y-m-d') }}">
                </div>

                <div class="form-group">
                    <label>Tipe Barang</label>
                    <input type="text" value="{{ $servis->tipe_barang ?? '' }}">
                </div>

                <div class="form-group">
                    <label>Kerusakan</label>
                    <input type="text" value="{{ $servis->kerusakan ?? '' }}">
                </div>

                <div class="form-group">
                    <label>Estimasi Biaya</label>
                    <input type="text" value="{{ $servis->biaya ?? '' }}">
                </div>

                <div class="form-group">
                    <label>Status Pembayaran</label>
                    <input type="text" value="{{ $servis->status_pembayaran ?? '' }}">
                </div>

                <button class="submit-btn">Update Data</button>
                <button class="delete-btn">Delete Data</button>
            </div>
        </div>

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

        // --- HAPUS FUNGSI GENERATE ID TRACKING INI JIKA HANYA UNTUK DETAIL, BUKAN PENCATATAN BARU ---
        // document.getElementById("generateBtn").addEventListener("click", function() {
        //     const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        //     let id = '';
        //     for (let i = 0; i < 5; i++) {
        //         const randomIndex = Math.floor(Math.random() * characters.length);
        //         id += characters[randomIndex];
        //     }
        //     document.getElementById("trackingId").value = id;
        // });
        // --- AKHIR HAPUS FUNGSI GENERATE ---

        // Tampilkan Modal
        document.getElementById("statusBtn").addEventListener("click", function() {
            document.getElementById("statusModal").style.display = "flex";
            // Set nilai default select sesuai status saat ini
            document.getElementById("statusSelect").value = document.getElementById("currentStatusBox").textContent.trim();
        });

        // Tutup Modal
        function closeModal() {
            document.getElementById("statusModal").style.display = "none";
        }

        // --- FUNGSI UBBAH STATUS YANG BARU ---
        function ubahStatus() {
            const selectedStatus = document.getElementById("statusSelect").value;
            const trackingId = document.getElementById("trackingId").value; // Ambil ID Tracking dari hidden input

            // Periksa apakah trackingId tersedia
            if (!trackingId) {
                alert('ID Tracking tidak ditemukan. Tidak dapat memperbarui status.');
                closeModal();
                return;
            }

            fetch("{{ route('admin.updateServisStatus', ['id_tracking' => ':trackingId']) }}".replace(':trackingId', trackingId), {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ statusservis: selectedStatus })
            })
            .then(response => {
                if (!response.ok) { // Cek jika respons bukan 2xx (misal 404, 500)
                    return response.json().then(err => { throw err; });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert('Status servis berhasil diperbarui!');
                    // Redirect ke halaman yang sesuai
                    switch (selectedStatus) {
                        case "KonfirmasiBiaya":
                            window.location.href = "{{ route('admin.konfirmasibiaya') }}";
                            break;
                        case "Diproses":
                            window.location.href = "{{ route('admin.diproses') }}";
                            break;
                        case "Selesai":
                            window.location.href = "{{ route('admin.selesai') }}";
                            break;
                        case "Lunas":
                            window.location.href = "{{ route('admin.lunas') }}";
                            break;
                        default:
                            window.location.href = "{{ route('admin.daftarservis') }}";
                            break;
                    }
                } else {
                    alert('Gagal mengubah status servis: ' + (data.message || 'Terjadi kesalahan.'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat berkomunikasi dengan server: ' + (error.message || 'Tidak diketahui.'));
            });

            closeModal();
        }
        // --- AKHIR FUNGSI UBBAH STATUS YANG BARU ---

        // Edit keterangan (perlu diimplementasikan untuk terhubung ke backend)
        document.getElementById("editBtn").addEventListener("click", function() {
            // Logika untuk menyimpan keterangan ke database perlu ditambahkan di sini
            // Ini juga memerlukan permintaan AJAX (fetch POST) ke endpoint backend baru.
            alert("Keterangan diperbarui (simulasi): \n\n" + document.getElementById("keterangan").value);
        });

        // Initialize status box color based on current status (optional, but good for UI)
        document.addEventListener('DOMContentLoaded', function() {
            const currentStatus = document.getElementById('currentStatusBox').textContent.trim();
            const statusBox = document.getElementById('currentStatusBox');
            statusBox.classList.remove("status-menunggu", "status-konfirmasi", "status-diproses", "status-selesai", "status-lunas"); // Clear existing
            switch (currentStatus) {
                case "Menunggu":
                    statusBox.classList.add("status-menunggu");
                    break;
                case "KonfirmasiBiaya":
                    statusBox.classList.add("status-konfirmasi");
                    break;
                case "Diproses":
                    statusBox.classList.add("status-diproses");
                    break;
                case "Selesai":
                    statusBox.classList.add("status-selesai");
                    break;
                case "Lunas":
                    statusBox.classList.add("status-lunas");
                    break;
            }
        });
    </script>

</body>

</html>