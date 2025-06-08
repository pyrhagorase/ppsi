@extends('user.master')

@section('konten')
<div class="container-fluid py-4">
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

<script>
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