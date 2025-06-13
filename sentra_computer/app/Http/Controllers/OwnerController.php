<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servis; // Pastikan ini ada dan sesuai dengan nama model Anda
use App\Models\Nota;
use Carbon\Carbon; // Pastikan ini ada jika Anda menggunakan Carbon untuk format tanggal
use Illuminate\Support\Facades\Log;
use App\Models\User; // Import model User
use Illuminate\Support\Facades\Hash; // Import facade Hash
use Illuminate\Validation\ValidationException; // Import ValidationException

class OwnerController extends Controller
{
    public function dashboard()
    {
        $totalServis = Servis::count();
        $totalDiproses = Servis::where('statusservis', 'Diproses')->count();

        return view('owner.dashboard', compact('totalServis', 'totalDiproses'));
    }

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
        return view('owner.diproses', [
            'servis' => $servis,
            'currentPage' => $servis->currentPage(),
            'totalPages' => $servis->lastPage()
        ]);
    }

    public function ownerKonfirmasiBiaya(Request $request)
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
        return view('owner.konfirmasibiaya', [
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
        return view('owner.selesai', [
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
        return view('owner.lunas', [
            'servis' => $servis,
            'currentPage' => $servis->currentPage(),
            'totalPages' => $servis->lastPage()
        ]);
    }

    public function updateKeterangan(Request $request, $id_tracking)
    {
        // Baris debugging telah dihapus.
        // Log::info('Method updateKeterangan di OwnerController dipanggil.', [
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
            Log::error('Gagal memperbarui keterangan di OwnerController.', [
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

    /**
     * Menampilkan formulir registrasi admin baru.
     * Mungkin sudah ada jika Anda menggunakan route GET untuk form.
     */
    public function create()
    {
        return view('owner.tambahadmin'); // Sesuaikan dengan nama view Blade Anda
    }

    /**
     * Menyimpan data admin baru dari formulir registrasi.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 1. Validasi Data Input
        try {
            $validatedData = $request->validate([
                'full_name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'], // 'confirmed' akan otomatis memeriksa 'password_confirmation'
            ], [
                'full_name.required' => 'Nama lengkap wajib diisi.',
                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email ini sudah terdaftar.',
                'password.required' => 'Password wajib diisi.',
                'password.min' => 'Password minimal 8 karakter.',
                'password.confirmed' => 'Konfirmasi password tidak cocok.',
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        // 2. Buat User Baru dengan Role "admin"
        User::create([
            'name' => $validatedData['full_name'], // Sesuaikan dengan nama kolom 'name' di tabel users
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']), // Hash password sebelum disimpan
            'role' => 'admin', // Otomatis set role menjadi 'admin'
        ]);

        // 3. Redirect Setelah Berhasil Registrasi
        return redirect()->route('owner.tambahadmin')->with('success', 'Admin baru berhasil didaftarkan!');
    }

}
