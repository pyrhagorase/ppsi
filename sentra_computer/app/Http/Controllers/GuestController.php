<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servis;
use App\Models\Ulasan;

class GuestController extends Controller
{
    public function guestHomepage()
    {
        // Ambil ulasan yang disetujui untuk ditampilkan di testimoni
        $ulasan = Ulasan::approved()
            ->with('servis')
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        return view('guest.homepage', compact('ulasan'));
    }

    public function detailservice($id_tracking = null)
    {
        // Jika ada ID tracking, ambil data servis
        if ($id_tracking) {
            $servis = Servis::where('id_tracking', $id_tracking)->first();

            if (!$servis) {
                // Jika data tidak ditemukan, redirect dengan pesan error
                return redirect()->route('guest.tracking')->with('error', 'Service dengan ID Tracking tersebut tidak ditemukan');
            }

            return view('guest.detailservice', compact('servis'));
        }

        // Jika tidak ada ID tracking, tampilkan halaman kosong atau redirect
        return view('guest.detailservice');
    }

    public function tracking()
    {
        return view('guest.tracking');
    }

    public function searchTracking(Request $request)
    {
        $request->validate([
            'id_tracking' => 'required|string'
        ]);

        $servis = Servis::where('id_tracking', $request->id_tracking)->first();

        if (!$servis) {
            return response()->json([
                'success' => false,
                'message' => 'Service dengan ID Tracking tersebut tidak ditemukan'
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $servis
        ]);
    }
}
