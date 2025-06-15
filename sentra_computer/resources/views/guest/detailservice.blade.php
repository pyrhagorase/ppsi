@extends('guest.master')

@section('konten')
<div class="container py-4">
    <div class="row">
        <!-- Search bar - Dimodifikasi agar lebih membulat dengan shadow -->
        <div class="col-12 text-end">
            <div class="input-group shadow" style="border-radius: 20px; overflow: hidden; max-width: 350px; float: right;">
                <span class="input-group-text bg-white border-end-0" style="border-radius: 20px 0 0 20px;">
                    <i class="fas fa-bars"></i>
                </span>
                {{-- Input ID Tracking ini akan selalu menampilkan ID Tracking jika ada, tetapi hanya untuk dibaca --}}
                <input type="text" class="form-control border-start-0 border-end-0" placeholder="Masukkan ID Tracking" value="{{ isset($servis) ? $servis->id_tracking : '' }}" readonly>
                {{-- Tombol pencarian tidak berfungsi langsung di sini karena ini adalah halaman detail. Pencarian dilakukan di halaman tracking. --}}
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

    <!-- Bagian Informasi/Keterangan - Dimodifikasi menjadi setengah lebar -->
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

                    <hr class="my-4">

                    <div class="p-4 bg-light border rounded shadow-sm">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-circle-info fa-2x text-primary me-3 mt-1"></i>
                            <div>
                                <p class="mb-2 fw-semibold">
                                    Ingin memberikan ulasan, mengunduh nota digital, dan mengakses fitur lainnya?
                                </p>
                                <div class="d-flex flex-wrap gap-2">
                                    <a href="{{ route('login') }}" class="btn btn-sm btn-outline-primary"> Login
                                    </a>
                                    <a href="{{ route('register') }}" class="btn btn-sm btn-primary"> Daftar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>



                    {{-- Bagian konfirmasi biaya, unduh nota, dan ulasan DIHAPUS untuk mode tamu --}}
                    {{-- Karena fitur-fitur ini hanya relevan untuk pengguna terautentikasi --}}

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

{{-- Modal Rating dan Ulasan DIHAPUS karena ini adalah mode tamu --}}

{{-- Script JavaScript terkait rating dan konfirmasi pembayaran DIHAPUS --}}
@endsection