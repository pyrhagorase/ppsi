<!DOCTYPE html>

<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Admin</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styledetail.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

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
            <h1>Detail Servis: {{ $servis->id_tracking ?? 'N/A' }}</h1>
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
        <div style="margin-bottom: 30px;">
            <h2>Status Servis</h2>

            <div class="status-box" id="currentStatusBox">
                {{ $servis->statusservis ?? 'Belum Ada Status' }}
            </div>

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

                <button class="submit-btn" id="updateDataBtn">Update Data</button>
                <button class="delete-btn" id="deleteDataBtn">Delete Data</button>
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
                    body: JSON.stringify({
                        statusservis: selectedStatus
                    })
                })
                .then(response => {
                    if (!response.ok) { // Cek jika respons bukan 2xx (misal 404, 500)
                        return response.json().then(err => {
                            throw err;
                        });
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


        // --- FUNGSI UNTUK UPDATE KETERANGAN ---
        // Menargetkan tombol dengan ID "editBtn"
        document.getElementById("editBtn").addEventListener("click", function() {
            const keteranganValue = document.getElementById("keterangan").value;
            const trackingId = document.getElementById("trackingId").value;

            // Log untuk debugging: Pastikan nilai-nilai ini ada
            console.log("Tombol Update Keterangan (ID: editBtn) diklik!");
            console.log("Keterangan yang akan dikirim:", keteranganValue);
            console.log("ID Tracking yang akan dikirim:", trackingId);

            // Validasi dasar di frontend
            if (!trackingId) {
                alert('ID Tracking tidak ditemukan. Tidak dapat memperbarui keterangan.');
                return;
            }

            // Permintaan AJAX menggunakan Fetch API
            fetch("{{ route('admin.updateKeterangan', ['id_tracking' => ':trackingId']) }}".replace(':trackingId', trackingId), {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        keterangan: keteranganValue
                    })
                })
                .then(response => {
                    console.log('Raw server response object:', response); // Untuk melihat objek respons
                    // Baca body respons sebagai teks terlebih dahulu, karena hanya bisa dibaca sekali
                    return response.text().then(responseText => {
                        console.log('Server response text:', responseText); // Untuk melihat respons dalam bentuk teks
                        if (!response.ok) { // Jika respons bukan 2xx (misal 404, 500, 422)
                            try {
                                const errorData = JSON.parse(responseText); // Coba parse sebagai JSON
                                console.error('Server error parsed as JSON:', errorData);
                                throw errorData; // Lempar error JSON untuk ditangkap .catch()
                            } catch (jsonParseError) {
                                // Jika tidak bisa di-parse sebagai JSON (misal HTML error page)
                                console.error('Server error (non-JSON response):', responseText);
                                throw new Error('Server error: ' + response.status + ' ' + response.statusText + '. Detail di console browser.');
                            }
                        }
                        // Jika respons OK (status 2xx), diasumsikan itu JSON sukses
                        return JSON.parse(responseText);
                    });
                })
                .then(data => {
                    console.log('Parsed data (success response):', data);
                    if (data.success) {
                        alert('Keterangan berhasil diperbarui!');
                        // Opsional: refresh halaman atau update UI lainnya
                        // window.location.reload(); 
                    } else {
                        alert('Gagal memperbarui keterangan: ' + (data.message || 'Terjadi kesalahan tidak diketahui.'));
                    }
                })
                .catch(error => {
                    console.error('Fetch operation failed (catch block):', error);
                    let errorMessage = 'Terjadi kesalahan saat berkomunikasi dengan server.';
                    if (error.message) {
                        errorMessage = error.message;
                    } else if (error.errors) { // Untuk error validasi dari Laravel
                        errorMessage = 'Validasi Gagal:\n';
                        for (const key in error.errors) {
                            errorMessage += `- ${error.errors[key].join(', ')}\n`;
                        }
                    } else if (typeof error === 'string') { // Jika error adalah string sederhana
                        errorMessage = error;
                    }
                    alert(errorMessage + '\nSilakan cek console browser untuk detail.');
                });
        });
        // --- AKHIR FUNGSI UPDATE KETERANGAN ---

        // Update data pelanggan
        document.getElementById("updateDataBtn").addEventListener("click", function() {
            const trackingId = document.getElementById("trackingId").value;
            if (!trackingId) {
                alert("ID Tracking tidak ditemukan.");
                return;
            }

            // Ambil nilai dari semua input
            const formContainer = document.querySelector(".form-container");
            const inputs = formContainer.querySelectorAll("input");
            const formData = {};

            inputs.forEach(input => {
                const label = input.previousElementSibling?.innerText?.trim();
                if (label) {
                    // Mapping berdasarkan label (pastikan label form sama dengan nama field di controller)
                    switch (label) {
                        case "Nama Pelanggan":
                            formData.nama_pelanggan = input.value;
                            break;
                        case "Kontak Pelanggan":
                            formData.kontak = input.value;
                            break;
                        case "Waktu Servis":
                            formData.waktu_servis = input.value;
                            break;
                        case "Tipe Barang":
                            formData.tipe_barang = input.value;
                            break;
                        case "Kerusakan":
                            formData.kerusakan = input.value;
                            break;
                        case "Estimasi Biaya":
                            formData.biaya = input.value;
                            break;
                        case "Status Pembayaran":
                            formData.status_pembayaran = input.value;
                            break;
                        default:
                            break;
                    }
                }
            });

            // Kirim ke controller via route POST
            fetch("{{ route('admin.updateServisDetail', ['id_tracking' => ':trackingId']) }}".replace(':trackingId', trackingId), {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                    },
                    body: JSON.stringify(formData)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Data servis berhasil diperbarui.");
                    } else {
                        alert("Gagal memperbarui data: " + (data.message || "Terjadi kesalahan."));
                    }
                })
                .catch(error => {
                    console.error("Fetch error:", error);
                    alert("Terjadi kesalahan saat mengirim data ke server.");
                });
        });

        // --- FUNGSI DELETE DATA ---
        document.getElementById("deleteDataBtn").addEventListener("click", function() {
            const trackingId = document.getElementById("trackingId").value;

            if (!trackingId) {
                alert("ID Tracking tidak ditemukan.");
                return;
            }

            if (!confirm("Yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.")) {
                return;
            }

            fetch("{{ route('admin.deleteServis', ['id_tracking' => ':trackingId']) }}".replace(':trackingId', trackingId), {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => {
                            throw err;
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        alert("Data berhasil dihapus.");
                        window.location.href = "{{ route('admin.daftarservis') }}"; // redirect setelah delete
                    } else {
                        alert("Gagal menghapus data: " + (data.message || "Terjadi kesalahan."));
                    }
                })
                .catch(error => {
                    console.error("Error saat menghapus data:", error);
                    alert("Terjadi kesalahan saat menghapus data. Cek konsol browser untuk detail.");
                });
        });
        // --- AKHIR FUNGSI DELETE DATA ---
    </script>

</body>

</html>