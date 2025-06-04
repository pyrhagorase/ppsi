<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servis;
use Illuminate\Support\Facades\Log;

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
        //Inisialisasi query dengan semua data Servis
        $query = Servis::orderBy('created_at', 'desc'); // Mulai dengan mengurutkan dari yang terbaru

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
        return view('admin.daftarservis', [
            'servis' => $servis,
            'currentPage' => $servis->currentPage(),
            'totalPages' => $servis->lastPage()
        ]);
    }

    public function showDetail($id_tracking)
    {
        // Mencari servis berdasarkan id_tracking. firstOrFail() akan melempar 404 jika tidak ditemukan.
        $servis = Servis::where('id_tracking', $id_tracking)->firstOrFail();

        // Melewatkan objek $servis ke view 'admin.detail'
        return view('admin.detail', compact('servis'));
    }

    /**
     * Memperbarui status servis.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $id_tracking
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateServisStatus(Request $request, $id_tracking)
    {
        $request->validate([
            'statusservis' => 'required|string|in:KonfirmasiBiaya,Diproses,Selesai,Lunas',
        ]);

        try {
            $servis = Servis::where('id_tracking', $id_tracking)->firstOrFail();
            $servis->statusservis = $request->statusservis;
            $servis->save();

            return response()->json(['success' => true, 'message' => 'Status servis berhasil diperbarui.']);
        } catch (\Exception $e) {
            Log::error('Gagal memperbarui status servis: ' . $e->getMessage(), ['id_tracking' => $id_tracking, 'status' => $request->statusservis]);
            return response()->json(['success' => false, 'message' => 'Gagal memperbarui status servis.'], 500);
        }
    }    
}
