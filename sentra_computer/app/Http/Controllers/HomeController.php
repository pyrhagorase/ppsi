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

    // Admin 
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


    // Owner
     public function ownerDashboard()
    {
        return view('owner.dashboard');  // pastikan view ini ada
    }

    public function ownerPencatatan()
    {
        return view('owner.pencatatan');  // pastikan view ini ada
    }

    public function ownerDaftarServis()
    {
        return view('owner.daftarservis');  // pastikan view ini ada
    }

      public function ownerKonfirmasiBiaya()
    {
        return view('owner.konfirmasibiaya');  // pastikan view ini ada
    }

    public function ownerDiproses()
    {
        return view('owner.diproses');  // pastikan view ini ada
    }

     public function ownerSelesai()
    {
        return view('owner.selesai');  // pastikan view ini ada
    }

      public function ownerLunas()
    {
        return view('owner.lunas');  // pastikan view ini ada
    }

    public function ownerRekap()
    {
        return view('owner.rekap');  // pastikan view ini ada
    }

       public function ownerDetail()
    {
        return view('owner.detail');  // pastikan view ini ada
    }

        public function ownerAkunPelanggan()
    {
        return view('owner.akunpelanggan');  // pastikan view ini ada
    }

        public function ownertambahadmin()
    {
        return view('owner.tambahadmin');  // pastikan view ini ada
    }




    // User
    public function userDashboard()
    {
        return view('user.homepage');    // pastikan view ini ada
    }
    
    public function detailservice() 
    {
        return view('user.detailservice');
    }

    public function tracking() 
    {
        return view('user.tracking');
    }

    public function userservice() 
    {
        return view('user.userservice');
    }
}
