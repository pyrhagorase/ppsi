<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servis; // Pastikan ini ada dan sesuai dengan nama model Anda
use Carbon\Carbon; // Pastikan ini ada jika Anda menggunakan Carbon untuk format tanggal


class AdminController extends Controller
{
    public function diproses(Request $request)
    {
        $query = Servis::where('statusservis', 'Diproses');

        // Tambahkan logika pencarian
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('id_tracking', 'like', '%' . $search . '%')
                  ->orWhere('nama_pelanggan', 'like', '%' . $search . '%')
                  ->orWhere('tipe_barang', 'like', '%' . $search . '%');
            });
        }

        $servis = $query->paginate(10); // Ambil 10 item per halaman

        // Teruskan data pagination ke view
        return view('admin.diproses', [
            'servis' => $servis,
            'currentPage' => $servis->currentPage(),
            'totalPages' => $servis->lastPage()
        ]);
    }

     public function adminKonfirmasiBiaya(Request $request)
    {
        $query = Servis::where('statusservis', 'KonfirmasiBiaya');

        // Tambahkan logika pencarian
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('id_tracking', 'like', '%' . $search . '%')
                  ->orWhere('nama_pelanggan', 'like', '%' . $search . '%')
                  ->orWhere('tipe_barang', 'like', '%' . $search . '%');
            });
        }

        $servis = $query->paginate(10); // Ambil 10 item per halaman

        // Teruskan data pagination ke view
        return view('admin.konfirmasibiaya', [
            'servis' => $servis,
            'currentPage' => $servis->currentPage(),
            'totalPages' => $servis->lastPage()
        ]);
    }

    public function selesai(Request $request)
    {
        $query = Servis::where('statusservis', 'Selesai');

        // Tambahkan logika pencarian
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('id_tracking', 'like', '%' . $search . '%')
                  ->orWhere('nama_pelanggan', 'like', '%' . $search . '%')
                  ->orWhere('tipe_barang', 'like', '%' . $search . '%');
            });
        }

        $servis = $query->paginate(10); // Ambil 10 item per halaman

        // Teruskan data pagination ke view
        return view('admin.selesai', [
            'servis' => $servis,
            'currentPage' => $servis->currentPage(),
            'totalPages' => $servis->lastPage()
        ]);
    }

     public function lunas(Request $request)
    {
        $query = Servis::where('statusservis', 'Lunas');

        // Tambahkan logika pencarian
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('id_tracking', 'like', '%' . $search . '%')
                  ->orWhere('nama_pelanggan', 'like', '%' . $search . '%')
                  ->orWhere('tipe_barang', 'like', '%' . $search . '%');
            });
        }

        $servis = $query->paginate(10); // Ambil 10 item per halaman

        // Teruskan data pagination ke view
        return view('admin.lunas', [
            'servis' => $servis,
            'currentPage' => $servis->currentPage(),
            'totalPages' => $servis->lastPage()
        ]);
    }
}

