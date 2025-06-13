<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servis;
use Barryvdh\DomPDF\Facade\Pdf;

class OwnerRekapController extends Controller
{
    public function index()
    {
        return view('owner.rekap');
    }

    public function exportPDF(Request $request)
    {
        // Get start_date and end_date from the request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Query for services within the date range and with status 'Lunas'
        $servis = Servis::whereBetween('waktu_servis', [$startDate, $endDate])
            ->where('statusservis', 'Lunas')
            ->get();

        // Calculate total pemasukan
        $totalPemasukan = $servis->sum(function ($item) {
            // Ensure 'biaya' is cleaned from non-numeric characters before summing
            return (int) preg_replace('/[^\d]/', '', $item->biaya);
        });

        // Load the PDF view with the collected data and dates
        $pdf = Pdf::loadView('owner.rekap_pdf', compact('servis', 'totalPemasukan', 'startDate', 'endDate'))
            ->setPaper('a4', 'landscape');

        // Return the PDF for download with a dynamic filename
        return $pdf->download("Rekap_Servis_Lunas_{$startDate}_to_{$endDate}.pdf");
    }
}

// composer require barryvdh/laravel-dompdf//

// jalankan kode diatas diterminal agar tidak error//
