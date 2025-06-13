<!DOCTYPE html>

<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>konfirmasi Biaya Owner</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/stylekonfirmasibiaya.css') }}"> </head>
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
            <h1>Konfirmasi Biaya</h1>
        </div>
        <div class="user-profile">
            <span class="user-email">{{Auth::user()->role}}</span>
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

    <main>
        <div class="search-container">
            <span class="search-icon">
                <i class="fas fa-search"></i>
            </span>
            <form action="{{ route('owner.konfirmasibiaya') }}" method="GET" class="flex-grow">
                <input type="text" name="search" class="search-input" placeholder="Search..." value="{{ request('search') }}">
                </form>
        </div>

         <!-- Table -->
        <section class="flex-1 px-6 pb-12 overflow-x-auto">
            <table class="w-full border-collapse text-sm text-left text-gray-600">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="py-3 pr-6 font-semibold whitespace-nowrap cursor-pointer">
                            ID_Tracking
                        </th>
                        <th class="py-3 pr-6 font-semibold whitespace-nowrap">
                            Name
                        </th>
                        <th class="py-3 pr-6 font-semibold whitespace-nowrap">
                            Tanggal
                        </th>
                        <th class="py-3 pr-6 font-semibold whitespace-nowrap">
                            Tipe Barang
                        </th>
                        <th class="py-3 pr-6 font-semibold whitespace-nowrap">
                            Status
                        </th>
                        <th class="py-3 font-semibold whitespace-nowrap">
                            Act
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($servis as $item)
                    <tr class="border-b border-gray-100">
                        <td class="py-3 pr-6 whitespace-nowrap text-gray-700 font-medium">
                            {{ $item->id_tracking }}
                        </td>
                        <td class="py-3 pr-6 whitespace-nowrap text-gray-700 font-medium">
                            {{ $item->nama_pelanggan }}
                        </td>
                        <td class="py-3 pr-6 whitespace-nowrap text-gray-400">
                            {{ \Carbon\Carbon::parse($item->waktu_servis)->format('F j, Y') }}
                        </td>
                        <td class="py-3 pr-6 whitespace-nowrap">
                            {{ $item->tipe_barang }}
                        </td>
                        <td class="py-3 pr-6 whitespace-nowrap">
                            <span class="inline-block bg-yellow-400 text-white text-xs font-semibold rounded-full px-3 py-1 select-none">
                                {{ $item->statusservis }}
                            </span>
                        </td>
                        <td class="py-3 whitespace-nowrap text-gray-400 cursor-pointer">
                            <a href="{{ route('owner.detail', ['id_tracking' => $item->id_tracking]) }}">
                                <i class="fas fa-ellipsis-h"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-3 pr-6 text-center text-gray-500">Tidak ada servis dengan status "Konfirmasi Biaya".</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </section>

        <!-- Pagination -->
        <div class="pagination mt-6 flex justify-center space-x-2 text-sm">
            @if($servis->onFirstPage())
            <span class="px-3 py-1 bg-gray-200 rounded cursor-not-allowed">Previous</span>
            @else
            <a href="{{ $servis->previousPageUrl() . (request('search') ? '&search=' . request('search') : '') }}" class="px-3 py-1 bg-gray-200 hover:bg-gray-300 rounded">Previous</a>
            @endif

            @foreach ($servis->getUrlRange(max(1, $servis->currentPage() - 1), min($servis->lastPage(), $servis->currentPage() + 1)) as $page => $url)
            @if ($page == $servis->currentPage())
            <span class="px-3 py-1 bg-blue-500 text-white rounded">{{ $page }}</span>
            @else
            <a href="{{ $url . (request('search') ? '&search=' . request('search') : '') }}" class="px-3 py-1 bg-gray-200 hover:bg-gray-300 rounded">{{ $page }}</a>
            @endif
            @endforeach

            @if($servis->hasMorePages())
            <a href="{{ $servis->nextPageUrl() . (request('search') ? '&search=' . request('search') : '') }}" class="px-3 py-1 bg-gray-200 hover:bg-gray-300 rounded">Next</a>
            @else
            <span class="px-3 py-1 bg-gray-200 rounded cursor-not-allowed">Next</span>
            @endif
        </div>
    </main>

    <footer class="footer">
        <div class="footer-content">
            © 2025 Sentra Computer. All rights reserved.
        </div>
    </footer>

    <script>
        // Toggle sidebar visibility for mobile
        document.getElementById('menu-toggle').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('active');
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function (event) {
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
        window.addEventListener('resize', function () {
            const sidebar = document.getElementById('sidebar');
            if (window.innerWidth > 768) {
                sidebar.classList.remove('active');
            }
        });

        // User Dropdown Menu Toggle
        const dropdownToggle = document.getElementById('dropdown-toggle');
        const dropdownMenu = document.getElementById('dropdown-menu');

        dropdownToggle.addEventListener('click', function (event) {
            event.stopPropagation();
            dropdownMenu.classList.toggle('show');
            const chevronIcon = this.querySelector('.fa-chevron-down');
            if (chevronIcon) {
                chevronIcon.style.transform = dropdownMenu.classList.contains('show') ? 'rotate(180deg)' : 'rotate(0)';
            }
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function (event) {
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