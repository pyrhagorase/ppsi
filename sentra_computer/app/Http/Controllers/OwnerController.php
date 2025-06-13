<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servis; // Pastikan ini ada dan sesuai dengan nama model Anda
use App\Models\Nota;
use Carbon\Carbon; // Pastikan ini ada jika Anda menggunakan Carbon untuk format tanggal
use Illuminate\Support\Facades\Log;

class OwnerController extends Controller
{
    public function dashboard()
    {
        $totalServis = Servis::count();
        $totalDiproses = Servis::where('statusservis', 'Diproses')->count();

        return view('owner.dashboard', compact('totalServis', 'totalDiproses'));
    }
}
