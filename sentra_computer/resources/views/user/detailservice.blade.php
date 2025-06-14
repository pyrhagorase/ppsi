@extends('user.master')

@section('konten')
<div class="container py-4">
    <div class="row">
        <!-- Search bar - Modified to be more rounded with shadow -->
        <div class="col-12 text-end">
            <div class="input-group shadow" style="border-radius: 20px; overflow: hidden; max-width: 350px; float: right;">
                <span class="input-group-text bg-white border-end-0" style="border-radius: 20px 0 0 20px;">
                    <i class="fas fa-bars"></i>
                </span>
                <input type="text" class="form-control border-start-0 border-end-0" placeholder="Masukkan ID Tracking" value="{{ isset($servis) ? $servis->id_tracking : '' }}" readonly>
                <button class="btn btn-white border border-start-0" type="button" style="border-radius: 0 20px 20px 0;">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            @if(isset($servis) && $servis)
            <table class="table">
                <thead>
                    <tr>
                        <th>ID.Tracking</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Tipe Barang</th>
                        <th>Kerusakan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $servis->id_tracking }}</td>
                        <td>{{ $servis->nama_pelanggan }}</td>
                        <td>{{ \Carbon\Carbon::parse($servis->waktu_servis)->format('d F Y') }}</td>
                        <td>{{ $servis->tipe_barang }}</td>
                        <td>{{ $servis->kerusakan ?? 'Belum dianalisa' }}</td>
                        <td>
                            @php
                            $statusClass = match($servis->statusservis) {
                            'Menunggu' => 'bg-secondary',
                            'KonfirmasiBiaya' => 'bg-warning',
                            'Diproses' => 'bg-info',
                            'Selesai' => 'bg-success',
                            'Lunas' => 'bg-primary',
                            default => 'bg-secondary'
                            };
                            @endphp
                            <span class="badge {{ $statusClass }} text-white">{{ $servis->statusservis }}</span>
                        </td>
                    </tr>
                </tbody>
            </table>
            @else
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                Tidak ada data service yang ditampilkan. Gunakan halaman tracking untuk mencari service.
            </div>
            @endif
        </div>
    </div>

    <!-- Information/Keterangan Section - Modified to be half width -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card shadow-sm" style="border-radius: 10px; border: none;">
                <div class="card-body p-4">
                    <h6 class="mb-3"><i class="fas fa-info-circle me-2"></i> Keterangan</h6>
                    @if(isset($servis) && $servis)
                    @if($servis->keterangan)
                    <p>{{ $servis->keterangan }}</p>
                    @else
                    <p class="text-muted">Belum ada keterangan dari admin.</p>
                    @endif

                    @if($servis->statusservis === 'KonfirmasiBiaya')
                    <div class="mt-3">
                        @php
                        // Cek kedua kemungkinan nama field untuk biaya
                        $biaya = $servis->biaya_servis ?? $servis->biaya ?? null;
                        @endphp

                        @if($biaya)
                        <div class="alert alert-warning">
                            <p><strong>💰 Biaya Servis: Rp {{ number_format($biaya, 0, ',', '.') }}</strong></p>
                            <p class="mb-3">Silakan konfirmasi apakah Anda setuju dengan biaya servis ini.</p>
                            <button class="btn btn-success btn-sm me-2" onclick="confirmPayment('{{ $servis->id_tracking }}')">
                                <i class="fas fa-check me-1"></i>Setuju
                            </button>
                            <button class="btn btn-outline-danger btn-sm" onclick="rejectPayment('{{ $servis->id_tracking }}')">
                                <i class="fas fa-times me-1"></i>Tidak Setuju
                            </button>
                        </div>
                        @else
                        <div class="alert alert-info">
                            <p>Menunggu admin untuk memberikan estimasi biaya servis.</p>
                        </div>
                        @endif
                    </div>
                    @endif

                    @if($servis->statusservis === 'Diproses')
                    <div class="alert alert-info mt-3">
                        <i class="fas fa-tools me-2"></i>
                        Service Anda sedang dalam proses perbaikan. Mohon tunggu hingga selesai.
                    </div>
                    @endif

                    @if($servis->statusservis === 'Selesai')
                    <div class="alert alert-success mt-3">
                        <i class="fas fa-check-circle me-2"></i>
                        Service Anda telah selesai. Silakan datang untuk mengambil barang dan melakukan pembayaran.
                    </div>
                    @endif

                    @if($servis->statusservis === 'Lunas')
                    <div class="alert alert-primary mt-3">
                        <i class="fas fa-star me-2"></i>
                        Terima kasih! Pembayaran telah lunas dan service telah selesai.
                    </div>

                    @php
                    $nota = $servis->nota; // atau $nota = optional($servis->nota);
                    @endphp

                    @if($nota && $nota->status === 'Lunas')
                    <a href="{{ route('user.unduh.nota', ['id_tracking' => $nota->id_tracking]) }}" class="btn btn-primary">
                        <i class="fas fa-download me-1"></i> Unduh Nota
                    </a>
                    @endif

                    {{-- Button Rating dan Ulasan untuk status Lunas --}}
                    @php
                    $existingUlasan = App\Models\Ulasan::where('id_tracking', $servis->id_tracking)
                                                       ->where('user_id', Auth::id())
                                                       ->first();
                    @endphp
                    
                    @if(!$existingUlasan)
                    <button class="btn btn-warning ms-2" onclick="showRatingModal('{{ $servis->id_tracking }}')">
                        <i class="fas fa-star me-1"></i> Berikan Rating & Ulasan
                    </button>
                    @else
                    <div class="alert alert-success mt-3">
                        <i class="fas fa-check-circle me-2"></i>
                        Terima kasih! Anda sudah memberikan rating dan ulasan untuk service ini.
                    </div>
                    @endif

                    @endif

                    @else
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Tidak ada data service yang dapat ditampilkan. Pastikan ID Tracking yang Anda masukkan benar.
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Rating dan Ulasan --}}
<div class="modal fade" id="ratingModal" tabindex="-1" aria-labelledby="ratingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ratingModalLabel">
                    <i class="fas fa-star text-warning me-2"></i>Rating & Ulasan
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="ratingForm">
                <div class="modal-body">
                    <input type="hidden" id="trackingId" name="id_tracking">
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Rating</label>
                        <div class="rating-stars">
                            <i class="fas fa-star star" data-rating="1"></i>
                            <i class="fas fa-star star" data-rating="2"></i>
                            <i class="fas fa-star star" data-rating="3"></i>
                            <i class="fas fa-star star" data-rating="4"></i>
                            <i class="fas fa-star star" data-rating="5"></i>
                        </div>
                        <input type="hidden" id="rating" name="rating" value="0">
                        <small class="text-muted">Klik bintang untuk memberikan rating</small>
                    </div>
                    
                    <div class="mb-3">
                        <label for="ulasan" class="form-label fw-bold">Ulasan</label>
                        <textarea class="form-control" id="ulasan" name="ulasan" rows="4" 
                                  placeholder="Bagikan pengalaman Anda dengan layanan kami..." required></textarea>
                        <small class="text-muted">Maksimal 500 karakter</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane me-1"></i>Kirim Ulasan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.rating-stars {
    font-size: 2rem;
    color: #ddd;
    cursor: pointer;
}

.rating-stars .star {
    transition: color 0.2s;
    margin-right: 5px;
}

.rating-stars .star:hover,
.rating-stars .star.active {
    color: #ffc107;
}

.rating-stars .star.hover {
    color: #ffc107;
}
</style>

<script>
    let selectedRating = 0;

    function showRatingModal(idTracking) {
        document.getElementById('trackingId').value = idTracking;
        const modal = new bootstrap.Modal(document.getElementById('ratingModal'));
        modal.show();
    }

    // Rating stars functionality
    document.addEventListener('DOMContentLoaded', function() {
        const stars = document.querySelectorAll('.star');
        
        stars.forEach((star, index) => {
            star.addEventListener('click', function() {
                selectedRating = index + 1;
                document.getElementById('rating').value = selectedRating;
                updateStars(selectedRating);
            });
            
            star.addEventListener('mouseenter', function() {
                updateStars(index + 1, true);
            });
        });
        
        document.querySelector('.rating-stars').addEventListener('mouseleave', function() {
            updateStars(selectedRating);
        });
    });

    function updateStars(rating, isHover = false) {
        const stars = document.querySelectorAll('.star');
        stars.forEach((star, index) => {
            if (index < rating) {
                star.classList.add(isHover ? 'hover' : 'active');
                if (!isHover) star.classList.remove('hover');
            } else {
                star.classList.remove('active', 'hover');
            }
        });
    }

    // Submit rating form
document.getElementById('ratingForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const rating = document.getElementById('rating').value;
    
    if (rating == 0) {
        alert('Silakan pilih rating terlebih dahulu');
        return;
    }
    
    fetch('/user/submit-ulasan', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            id_tracking: formData.get('id_tracking'),
            rating: formData.get('rating'),
            ulasan: formData.get('ulasan')
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            const modal = bootstrap.Modal.getInstance(document.getElementById('ratingModal'));
            modal.hide();
            location.reload();
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat mengirim ulasan');
    });
});

    function confirmPayment(idTracking) {
        if (confirm('Apakah Anda yakin ingin menyetujui biaya servis ini?')) {
            // Implementasi konfirmasi pembayaran
            // Anda bisa menambahkan AJAX request ke backend untuk update status
            fetch('/user/confirm-payment', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        id_tracking: idTracking,
                        action: 'confirm'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Konfirmasi berhasil dikirim!');
                        location.reload();
                    } else {
                        alert('Terjadi kesalahan: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengirim konfirmasi');
                });
        }
    }

    function rejectPayment(idTracking) {
        if (confirm('Apakah Anda yakin menolak biaya servis ini?')) {
            // Implementasi penolakan pembayaran
            fetch('/user/confirm-payment', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        id_tracking: idTracking,
                        action: 'reject'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Penolakan berhasil dikirim!');
                        location.reload();
                    } else {
                        alert('Terjadi kesalahan: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengirim penolakan');
                });
        }
    }
</script>
@endsection