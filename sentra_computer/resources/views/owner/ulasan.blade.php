<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Ulasan Owner</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styleulasan.css">
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
            <a href="{{route('owner.ulasan')}}" class="menu-item active">
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
            <h1>Kelola Ulasan Pelanggan</h1>
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
        <div class="container-fluid p-4">
            <!-- Filter dan Search -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="filter-section">
                        <h5><i class="fas fa-filter me-2"></i>Filter Ulasan</h5>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-outline-primary active" onclick="filterUlasan('all')">
                                Semua <span class="badge bg-primary ms-1">{{$ulasan->total()}}</span>
                            </button>
                            <button type="button" class="btn btn-outline-success" onclick="filterUlasan('approved')">
                                Disetujui <span class="badge bg-success ms-1">{{$ulasan->where('is_approved', true)->count()}}</span>
                            </button>
                            <button type="button" class="btn btn-outline-warning" onclick="filterUlasan('pending')">
                                Pending <span class="badge bg-warning ms-1">{{$ulasan->where('is_approved', false)->count()}}</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="search-section">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="Cari berdasarkan nama pelanggan atau ID tracking..." id="searchInput">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Ulasan -->
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-comments me-2"></i>
                        Daftar Ulasan Pelanggan
                    </h5>
                </div>
                <div class="card-body">
                    @if($ulasan->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>ID Tracking</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Rating</th>
                                    <th>Ulasan</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ulasan as $index => $item)
                                <tr class="ulasan-row" data-status="{{$item->is_approved ? 'approved' : 'pending'}}">
                                    <td>{{ $ulasan->firstItem() + $index }}</td>
                                    <td>
                                        <span class="badge bg-info">{{$item->id_tracking}}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle me-2">
                                                <i class="fas fa-user"></i>
                                            </div>
                                            <div>
                                                <strong>{{$item->nama_pelanggan}}</strong>
                                                <br>
                                                <small class="text-muted">{{$item->user->email ?? 'N/A'}}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="rating-display">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $item->rating)
                                                    <i class="fas fa-star text-warning"></i>
                                                @else
                                                    <i class="far fa-star text-muted"></i>
                                                @endif
                                            @endfor
                                            <span class="ms-2">({{$item->rating}}/5)</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="ulasan-text">
                                            <p class="mb-0">{{Str::limit($item->ulasan, 100)}}</p>
                                            @if(strlen($item->ulasan) > 100)
                                            <button class="btn btn-link btn-sm p-0" onclick="showFullUlasan('{{$item->ulasan}}', '{{$item->nama_pelanggan}}')">
                                                Lihat Selengkapnya
                                            </button>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <small>{{$item->created_at->format('d M Y')}}</small>
                                        <br>
                                        <small class="text-muted">{{$item->created_at->format('H:i')}}</small>
                                    </td>
                                    <td>
                                        @if($item->is_approved)
                                            <span class="badge bg-success">
                                                <i class="fas fa-check me-1"></i>Disetujui
                                            </span>
                                        @else
                                            <span class="badge bg-warning">
                                                <i class="fas fa-clock me-1"></i>Pending
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button class="btn btn-sm btn-outline-primary" 
                                                    onclick="toggleApproval({{$item->id}}, {{$item->is_approved ? 'false' : 'true'}})"
                                                    title="{{$item->is_approved ? 'Sembunyikan' : 'Setujui'}}">
                                                <i class="fas fa-{{$item->is_approved ? 'eye-slash' : 'check'}}"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-danger" 
                                                    onclick="deleteUlasan({{$item->id}})"
                                                    title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="d-flex justify-content-center">
                        {{ $ulasan->links() }}
                    </div>
                    @else
                    <div class="text-center py-5">
                        <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                        <h5>Belum Ada Ulasan</h5>
                        <p class="text-muted">Belum ada ulasan dari pelanggan yang dapat ditampilkan.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </main>

    <!-- Modal untuk Menampilkan Ulasan Lengkap -->
    <div class="modal fade" id="fullUlasanModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-comment-dots me-2"></i>
                        Ulasan dari <span id="modalCustomerName"></span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p id="modalUlasanText"></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            © 2025 Sentra Computer. All rights reserved.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle sidebar visibility for mobile
        document.getElementById('menu-toggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
        });

        // User Dropdown Menu Toggle
        const dropdownToggle = document.getElementById('dropdown-toggle');
        const dropdownMenu = document.getElementById('dropdown-menu');

        dropdownToggle.addEventListener('click', function(event) {
            event.stopPropagation();
            dropdownMenu.classList.toggle('show');
        });

        // Filter ulasan
        function filterUlasan(status) {
            const rows = document.querySelectorAll('.ulasan-row');
            const buttons = document.querySelectorAll('.btn-group .btn');
            
            // Remove active class from all buttons
            buttons.forEach(btn => btn.classList.remove('active'));
            
            // Add active class to clicked button
            event.target.classList.add('active');
            
            rows.forEach(row => {
                if (status === 'all') {
                    row.style.display = '';
                } else {
                    const rowStatus = row.getAttribute('data-status');
                    row.style.display = rowStatus === status ? '' : 'none';
                }
            });
        }

        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function() {
            const query = this.value.toLowerCase();
            const rows = document.querySelectorAll('.ulasan-row');
            
            rows.forEach(row => {
                const nama = row.cells[2].textContent.toLowerCase();
                const idTracking = row.cells[1].textContent.toLowerCase();
                const ulasan = row.cells[4].textContent.toLowerCase();
                
                if (nama.includes(query) || idTracking.includes(query) || ulasan.includes(query)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Show full ulasan
        function showFullUlasan(ulasan, customerName) {
            document.getElementById('modalCustomerName').textContent = customerName;
            document.getElementById('modalUlasanText').textContent = ulasan;
            new bootstrap.Modal(document.getElementById('fullUlasanModal')).show();
        }

        // Toggle approval
        function toggleApproval(id, newStatus) {
            if (confirm('Apakah Anda yakin ingin mengubah status ulasan ini?')) {
                fetch(`/owner/ulasan/${id}/toggle-approval`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Terjadi kesalahan: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengubah status');
                });
            }
        }

        // Delete ulasan
        function deleteUlasan(id) {
            if (confirm('Apakah Anda yakin ingin menghapus ulasan ini? Tindakan ini tidak dapat dibatalkan.')) {
                fetch(`/owner/ulasan/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Ulasan berhasil dihapus');
                        location.reload();
                    } else {
                        alert('Terjadi kesalahan: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menghapus ulasan');
                });
            }
        }
    </script>

    <style>
        .main-content {
            margin-left: 250px;
            margin-top: 80px;
            min-height: calc(100vh - 80px);
        }

        .avatar-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .rating-display {
            font-size: 0.9rem;
        }

        .ulasan-text {
            max-width: 300px;
        }

        .filter-section {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .search-section {
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                margin-top: 70px;
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .sidebar {
                transform: translateX(-100%);
            }
        }
    </style>
</body>
</html>