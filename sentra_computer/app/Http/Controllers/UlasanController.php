<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use App\Models\Servis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UlasanController extends Controller
{
    // Method untuk menyimpan ulasan dari user
    public function store(Request $request)
    {
        $request->validate([
            'id_tracking' => 'required|exists:servis,id_tracking',
            'rating' => 'required|integer|min:1|max:5',
            'ulasan' => 'required|string|max:500'
        ]);

        // Cek apakah servis sudah lunas
        $servis = Servis::where('id_tracking', $request->id_tracking)
                       ->where('statusservis', 'Lunas')
                       ->first();

        if (!$servis) {
            return response()->json([
                'success' => false,
                'message' => 'Servis belum lunas atau tidak ditemukan'
            ], 400);
        }

        // Cek apakah user sudah memberikan ulasan untuk servis ini
        $existingUlasan = Ulasan::where('id_tracking', $request->id_tracking)
                               ->where('user_id', Auth::id())
                               ->first();

        if ($existingUlasan) {
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah memberikan ulasan untuk servis ini'
            ], 400);
        }

        // Simpan ulasan
        $ulasan = Ulasan::create([
            'id_tracking' => $request->id_tracking,
            'user_id' => Auth::id(),
            'nama_pelanggan' => $servis->nama_pelanggan,
            'rating' => $request->rating,
            'ulasan' => $request->ulasan,
            'is_approved' => true // Otomatis disetujui, bisa diubah jadi false jika perlu moderasi
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Terima kasih! Ulasan Anda telah berhasil disimpan.'
        ]);
    }

    // Method untuk admin mengelola ulasan
    public function adminIndex()
    {
        $ulasan = Ulasan::with(['user', 'servis'])
                       ->orderBy('created_at', 'desc')
                       ->paginate(10);

        return view('admin.ulasan', compact('ulasan'));
    }

    // Method untuk admin menghapus ulasan
    public function destroy($id)
    {
        try {
            $ulasan = Ulasan::findOrFail($id);
            $ulasan->delete();

            return response()->json([
                'success' => true,
                'message' => 'Ulasan berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus ulasan: ' . $e->getMessage()
            ], 500);
        }
    }

    // Method untuk toggle status persetujuan ulasan
    public function toggleApproval($id)
    {
        try {
            $ulasan = Ulasan::findOrFail($id);
            $ulasan->is_approved = !$ulasan->is_approved;
            $ulasan->save();

            return response()->json([
                'success' => true,
                'message' => 'Status ulasan berhasil diubah',
                'is_approved' => $ulasan->is_approved
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengubah status ulasan: ' . $e->getMessage()
            ], 500);
        }
    }

    // Method untuk mendapatkan ulasan yang disetujui untuk homepage
    public function getApprovedUlasan()
    {
        $ulasan = Ulasan::approved()
                       ->with(['servis'])
                       ->orderBy('created_at', 'desc')
                       ->limit(6)
                       ->get();

        return $ulasan;
    }
}