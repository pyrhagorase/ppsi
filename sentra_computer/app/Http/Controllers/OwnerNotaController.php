<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class OwnerNotaController extends Controller
{
     public function simpan(Request $request)
    {
        try {
            $validated = $request->validate([
                'id_tracking' => 'required|string',
                'tanggal' => 'required|date',
                'kasir' => 'required|string',
                'status' => 'required|string',
                'metode_bayar' => 'required|string',
                'total' => 'required|numeric',
                'dibayar' => 'required|numeric',
                'kembalian' => 'required|numeric',
                'items' => 'required|array',
                'items.*.nama_item' => 'required|string',
                'items.*.harga' => 'required|numeric',
            ]);

            $nota = Nota::create([
                'id_tracking' => $validated['id_tracking'],
                'tanggal' => $validated['tanggal'],
                'kasir' => $validated['kasir'],
                'status' => $validated['status'],
                'metode_bayar' => $validated['metode_bayar'],
                'total' => $validated['total'],
                'dibayar' => $validated['dibayar'],
                'kembalian' => $validated['kembalian'],
            ]);

            foreach ($validated['items'] as $item) {
                $nota->items()->create([
                    'nama_item' => $item['nama_item'],
                    'harga' => $item['harga'],
                ]);
            }

            return response()->json(['success' => true, 'nota_id' => $nota->id]);
        } catch (\Exception $e) {
            // Tangkap dan tampilkan error asli ke JSON
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan nota: ' . $e->getMessage(),
            ], 500);
        }
    }
    // app/Http/Controllers/NotaController.php

    public function unduhNota($id_tracking) // Pastikan parameter ini sudah $id_tracking
    {
        // Ambil nota terbaru berdasarkan id_tracking
        // Karena ada duplikasi, kita ambil yang terakhir dibuat (paling baru)
        $nota = Nota::with('items')
                    ->where('id_tracking', $id_tracking)
                    ->latest('created_at') // Ambil yang terbaru berdasarkan kolom 'created_at'
                    ->firstOrFail(); // Temukan atau gagalkan

        // Hitung total dari semua harga item
        $total = $nota->items->sum('harga');

        // Ambil nilai dibayar & kembalian dari data nota
        $dibayar = $nota->dibayar;
        $kembalian = $nota->kembalian;

        // Kirim semua data ke view
        return Pdf::loadView('user.nota_pdf', compact('nota', 'total', 'dibayar', 'kembalian'))
            ->download('nota-' . $nota->id_tracking . '.pdf');
    }
}


