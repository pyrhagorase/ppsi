<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servis;

class ServisController extends Controller
{
    public function store(Request $request)
    {
        // validasi input
        $validated = $request->validate([
            'id_tracking' => 'required|unique:servis,id_tracking',
            'nama_pelanggan' => 'required|string|max:255',
            'kontak' => 'required|string|max:255',
            'waktu_servis' => 'required|date',
            'tipe_barang' => 'required|string|max:255',
            'kerusakan' => 'required|string',
            'biaya' => 'required|string',
            'status_pembayaran' => 'required|in:Belum Lunas,Lunas',
        ]);

        // buat data servis baru
        Servis::create($validated + ['statusservis' => 'Menunggu']);

        // redirect misal ke halaman daftar servis dengan pesan sukses
        return redirect()->route('admin.daftarservis')->with('success', 'Data servis berhasil disimpan!');
    }

    // ServisController.php
    public function index(Request $request)
    {
        $page = $request->input('page', 1); // Ambil parameter page dari URL
        $perPage = 5; // Jumlah item per halaman
        $servis = Servis::orderBy('created_at', 'desc')
            ->offset(($page - 1) * $perPage)
            ->limit($perPage)
            ->get();

        $total = Servis::count();

        return view('admin.daftarservis', [
            'servis' => $servis,
            'currentPage' => $page,
            'totalPages' => ceil($total / $perPage)
        ]);
    }
}
