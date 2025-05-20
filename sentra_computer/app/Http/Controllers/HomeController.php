<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            // Kalau belum login, redirect ke login
            return redirect()->route('login');
        }

        // Arahkan berdasarkan role
        switch ($user->role) {
            case 'admin':
                return view('admin.dashboard');  // views/admin/dashboard.blade.php
            case 'user':
                return view('user.homepage');    // views/user/homepage.blade.php
            default:
                abort(403, 'Role tidak dikenali.');
        }
    }

    public function adminDashboard()
    {
        return view('admin.dashboard');  // pastikan view ini ada
    }

    public function adminPencatatan()
    {
        return view('admin.pencatatan');  // pastikan view ini ada
    }

    public function adminDaftarServis()
    {
        return view('admin.daftarservis');  // pastikan view ini ada
    }

    public function adminKonfirmasiBiaya()
    {
        return view('admin.konfirmasibiaya');  // pastikan view ini ada
    }

    public function adminDiproses()
    {
        return view('admin.diproses');  // pastikan view ini ada
    }

    
    public function adminSelesai()
    {
        return view('admin.selesai');  // pastikan view ini ada
    }

    public function adminLunas()
    {
        return view('admin.lunas');  // pastikan view ini ada
    }

    
    public function adminRekap()
    {
        return view('admin.rekap');  // pastikan view ini ada
    }

    public function adminDetail()
    {
        return view('admin.detail');  // pastikan view ini ada
    }

    public function userDashboard()
    {
        return view('user.homepage');    // pastikan view ini ada
    }
}
