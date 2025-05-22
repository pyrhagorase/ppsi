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
                <input type="text" class="form-control border-start-0 border-end-0" placeholder="2dW13" value="2dW13">
                <button class="btn btn-white border border-start-0" type="button" style="border-radius: 0 20px 20px 0;">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
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
                        <td>2dW13</td>
                        <td>Arlene McCoy</td>
                        <td>August 2, 2013</td>
                        <td>Laptop</td>
                        <td>Ganti SSD</td>
                        <td><span class="badge bg-warning text-white">Menunggu konfirmasi</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Information/Keterangan Section - Modified to be half width -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card shadow-sm" style="border-radius: 10px; border: none;">
                <div class="card-body p-4">
                    <h6 class="mb-3"><i class="fas fa-info-circle me-2"></i> Keterangan</h6>
                    <p>Admin ingin anda mengkonfirmasi biaya perbaikan sebesar Rp 150,000, apakah anda setuju?</p>
                    <button class="btn btn-primary btn-sm">Setuju</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection