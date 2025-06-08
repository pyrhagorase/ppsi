@extends('user.master')

@section('konten')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2 class="fw-bold">My Services</h2>
            <p class="text-muted">Your saved service requests</p>
        </div>
        <div class="col-md-6">
            <div class="d-flex justify-content-end">
                <button class="btn btn-primary" id="refreshBtn">
                    <i class="fas fa-sync-alt"></i> Refresh
                </button>
            </div>
        </div>
    </div>

    <!-- Alert untuk menampilkan pesan -->
    <div id="alertContainer"></div>

    <!-- Container untuk menampilkan My Services -->
    <div class="row g-4" id="myServicesContainer">
        <!-- Cards akan ditampilkan di sini -->
    </div>

    <!-- Empty state -->
    <div id="emptyState" class="text-center py-5" style="display: none;">
        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
        <h4 class="text-muted">Belum ada service yang disimpan</h4>
        <p class="text-muted">Simpan service dari halaman tracking untuk melihatnya di sini</p>
        <a href="{{ route('user.tracking') }}" class="btn btn-primary">
            <i class="fas fa-search"></i> Cari Service
        </a>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const myServicesContainer = document.getElementById('myServicesContainer');
    const alertContainer = document.getElementById('alertContainer');
    const emptyState = document.getElementById('emptyState');
    const refreshBtn = document.getElementById('refreshBtn');

    // Function to show alert
    function showAlert(message, type = 'danger') {
        alertContainer.innerHTML = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;
    }

    // Function to format date
    function formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('id-ID');
    }

    // Function to get status badge class
    function getStatusBadgeClass(status) {
        switch(status) {
            case 'Menunggu': return 'bg-secondary';
            case 'KonfirmasiBiaya': return 'bg-warning';
            case 'Diproses': return 'bg-info';
            case 'Selesai': return 'bg-success';
            case 'Lunas': return 'bg-primary';
            default: return 'bg-secondary';
        }
    }

    // Function to create service card
    function createServiceCard(myService) {
        const service = myService.servis;
        return `
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="text-muted small mb-2">ID Tracking</h5>
                        <h3 class="card-title fw-bold mb-3">${service.id_tracking}</h3>
                        <ul class="list-unstyled mb-3">
                            <li class="mb-2">
                                <i class="fas fa-user-circle text-primary me-2"></i>${service.nama_pelanggan}
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-calendar-alt text-primary me-2"></i>${formatDate(service.waktu_servis)}
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-laptop text-primary me-2"></i>${service.tipe_barang}
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-clock text-primary me-2"></i> Status: 
                                <span class="badge ${getStatusBadgeClass(service.statusservis)}">${service.statusservis}</span>
                            </li>
                        </ul>
                        <div class="d-grid gap-2">
                            <a href="/user/detailservice/${service.id_tracking}" class="btn btn-dark">Details</a>
                            <button class="btn btn-danger py-2 remove-btn" data-tracking="${service.id_tracking}">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }

    // Function to load My Services
    function loadMyServices() {
        myServicesContainer.innerHTML = '<div class="col-12"><div class="text-center"><i class="fas fa-spinner fa-spin"></i> Memuat...</div></div>';
        emptyState.style.display = 'none';

        fetch('{{ route("user.my.services") }}')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                if (data.data.length === 0) {
                    myServicesContainer.innerHTML = '';
                    emptyState.style.display = 'block';
                } else {
                    emptyState.style.display = 'none';
                    myServicesContainer.innerHTML = data.data.map(createServiceCard).join('');
                }
            } else {
                myServicesContainer.innerHTML = '';
                showAlert(data.message || 'Gagal memuat My Services');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            myServicesContainer.innerHTML = '';
            showAlert('Terjadi kesalahan saat memuat My Services');
        });
    }

    // Function to remove service
    function removeService(trackingId) {
        if (!confirm('Apakah Anda yakin ingin menghapus service ini dari My Services?')) {
            return;
        }

        fetch('{{ route("user.remove.service") }}', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                id_tracking: trackingId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showAlert(data.message, 'success');
                loadMyServices(); // Reload the services
            } else {
                showAlert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('Terjadi kesalahan saat menghapus service');
        });
    }

    // Event listeners
    refreshBtn.addEventListener('click', loadMyServices);

    // Remove service event
    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-btn')) {
            const trackingId = e.target.closest('.remove-btn').getAttribute('data-tracking');
            removeService(trackingId);
        }
    });

    // Load My Services on page load
    loadMyServices();
});
</script>
@endsection