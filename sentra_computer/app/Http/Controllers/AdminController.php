<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servis; // Pastikan ini ada dan sesuai dengan nama model Anda
use Carbon\Carbon; // Pastikan ini ada jika Anda menggunakan Carbon untuk format tanggal
use Illuminate\Support\Facades\Log;


class AdminController extends Controller
{
    public function diproses(Request $request)
    {
        $query = Servis::where('statusservis', 'Diproses');

        // Tambahkan logika pencarian
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
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
            $query->where(function ($q) use ($search) {
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
            $query->where(function ($q) use ($search) {
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
            $query->where(function ($q) use ($search) {
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

    public function updateKeterangan(Request $request, $id_tracking)
    {
        // Baris debugging telah dihapus.
        // Log::info('Method updateKeterangan di AdminController dipanggil.', [
        //     'id_tracking_dari_route' => $id_tracking,
        //     'request_data_lengkap' => $request->all()
        // ]);

        try {
            // 1. Validasi input dari request (opsional, tapi sangat direkomendasikan)
            // Misalnya, pastikan 'keterangan' ada dan berupa string
            $request->validate([
                'keterangan' => 'nullable|string|max:1000', // Sesuaikan max length jika perlu
            ]);

            // 2. Cari data servis berdasarkan 'id_tracking'
            // Gunakan metode 'where' dan 'first()' untuk mendapatkan satu record
            $servis = Servis::where('id_tracking', $id_tracking)->first();

            // 3. Periksa apakah data servis ditemukan
            if (!$servis) {
                // Jika tidak ditemukan, kembalikan response JSON dengan status 404 (Not Found)
                return response()->json([
                    'success' => false,
                    'message' => 'Data servis dengan ID tracking ' . $id_tracking . ' tidak ditemukan.'
                ], 404);
            }

            // 4. Perbarui kolom 'keterangan' dengan nilai dari request
            // Pastikan nama field di request body sesuai, misalnya 'keterangan'
            $servis->keterangan = $request->input('keterangan');

            // 5. Simpan perubahan ke database
            $servis->save();

            // 6. Kembalikan response JSON sukses
            return response()->json([
                'success' => true,
                'message' => 'Keterangan berhasil diperbarui.',
                'data' => $servis // Mengembalikan data servis yang telah diperbarui
            ], 200); // Status HTTP 200 OK

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Tangani error validasi
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $e->errors()
            ], 422); // Status HTTP 422 Unprocessable Entity

        } catch (\Exception $e) {
            // Tangani error umum lainnya yang mungkin terjadi selama proses update
            // Catat error ke log untuk debugging lebih lanjut
            Log::error('Gagal memperbarui keterangan di AdminController.', [
                'id_tracking' => $id_tracking,
                'error_message' => $e->getMessage(),
                'request_data' => $request->all(),
                'trace' => $e->getTraceAsString() // Menambahkan trace untuk debugging
            ]);

            // Kembalikan response JSON error dengan status 500 (Internal Server Error)
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan internal saat memperbarui keterangan. Silakan coba lagi nanti.'
            ], 500);
        }
    }

    public function updateServisDetail(Request $request, $id_tracking)
    {
        $servis = Servis::where('id_tracking', $id_tracking)->first();

        if (!$servis) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan.']);
        }

        $servis->update([
            'nama_pelanggan' => $request->nama_pelanggan,
            'kontak' => $request->kontak,
            'waktu_servis' => $request->waktu_servis,
            'tipe_barang' => $request->tipe_barang,
            'kerusakan' => $request->kerusakan,
            'biaya' => $request->biaya,
            'status_pembayaran' => $request->status_pembayaran,
        ]);

        return response()->json(['success' => true]);
    }

    public function deleteServis($id_tracking)
{
    $servis = Servis::where('id_tracking', $id_tracking)->first();

    if (!$servis) {
        return response()->json(['success' => false, 'message' => 'Data tidak ditemukan.'], 404);
    }

    $servis->delete();

    return response()->json(['success' => true]);
}

}
