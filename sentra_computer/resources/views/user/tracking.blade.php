@extends('user.master')

@section('konten')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2 class="fw-bold">Service Tracking</h2>
            <p class="text-muted">Track your service request status here</p>
        </div>
        <div class="col-md-6">
            <div class="d-flex justify-content-end">
                <div class="input-group" style="max-width: 300px;">
                    <input type="text" class="form-control" id="trackingInput" placeholder="Masukkan ID Tracking" aria-label="Search by ID">
                    <button class="btn btn-primary" type="button" id="searchBtn">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert untuk menampilkan pesan -->
    <div id="alertContainer"></div>

    <!-- Container untuk menampilkan hasil pencarian -->
    <div class="row g-4" id="searchResults">
        <!-- Card akan ditampilkan di sini setelah pencarian -->
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchBtn = document.getElementById('searchBtn');
    const trackingInput = document.getElementById('trackingInput');
    const searchResults = document.getElementById('searchResults');
    const alertContainer = document.getElementById('alertContainer');

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
    function createServiceCard(service, isSaved = false) {
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
                            <button class="btn btn-primary py-2 save-btn" data-tracking="${service.id_tracking}" ${isSaved ? 'disabled' : ''}>
                                ${isSaved ? 'Tersimpan' : 'Simpan'}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }

    // Search function
    function searchService() {
        const idTracking = trackingInput.value.trim();
        
        if (!idTracking) {
            showAlert('Mohon masukkan ID Tracking');
            return;
        }

        // Show loading
        searchResults.innerHTML = '<div class="col-12"><div class="text-center"><i class="fas fa-spinner fa-spin"></i> Mencari...</div></div>';

        fetch('{{ route("user.search.tracking") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                id_tracking: idTracking
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                searchResults.innerHTML = createServiceCard(data.data, data.is_saved);
                alertContainer.innerHTML = '';
            } else {
                searchResults.innerHTML = '';
                showAlert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            searchResults.innerHTML = '';
            showAlert('Terjadi kesalahan saat mencari service');
        });
    }

    // Event listeners
    searchBtn.addEventListener('click', searchService);
    
    trackingInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            searchService();
        }
    });

    // Save to My Services
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('save-btn')) {
            const trackingId = e.target.getAttribute('data-tracking');
            const button = e.target;
            
            button.disabled = true;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
            
            fetch('{{ route("user.save.service") }}', {
                method: 'POST',
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
                    button.innerHTML = 'Tersimpan';
                    showAlert(data.message, 'success');
                } else {
                    button.disabled = false;
                    button.innerHTML = 'Simpan';
                    showAlert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                button.disabled = false;
                button.innerHTML = 'Simpan';
                showAlert('Terjadi kesalahan saat menyimpan service');
            });
        }
    });
});
</script>
@endsection