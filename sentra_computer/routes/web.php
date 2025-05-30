<?php

use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ServisController;
use App\Http\Controllers\ResetPasswordController;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');

// Registration Routes
Route::get('register', [RegisterController::class, 'register'])->name('register');
Route::post('actionregister', [RegisterController::class, 'actionregister'])->name('actionregister');

Route::get('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
        ? back()->with('success', __($status))
        : back()->withErrors(['email' => __($status)]);
})->name('password.email');

Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->save();
        }
    );

    return $status === Password::PASSWORD_RESET
        ? redirect()->route('login')->with('success', __($status))
        : back()->withErrors(['email' => [__($status)]]);
})->name('password.update');

// Admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [HomeController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/admin/pencatatan', [HomeController::class, 'adminPencatatan'])->name('admin.pencatatan');
    Route::post('/servis/store', [ServisController::class, 'store'])->name('servis.store');
    Route::get('/admin/daftarservis', [HomeController::class, 'adminDaftarServis'])->name('admin.daftarservis');
    Route::get('/admin/konfirmasibiaya', [HomeController::class, 'adminKonfirmasiBiaya'])->name('admin.konfirmasibiaya');
    Route::get('/admin/diproses', [HomeController::class, 'adminDiproses'])->name('admin.diproses');
    Route::get('/admin/selesai', [HomeController::class, 'adminSelesai'])->name('admin.selesai');
    Route::get('/admin/Lunas', [HomeController::class, 'adminLunas'])->name('admin.lunas');
    Route::get('/admin/rekap', [HomeController::class, 'adminRekap'])->name('admin.rekap');
    Route::get('/admin/detail', [HomeController::class, 'adminDetail'])->name('admin.detail');
    Route::get('/admin/daftarservis', [ServisController::class, 'index'])->name('admin.daftarservis');
});

// Owner routes
Route::middleware(['auth', 'role:owner'])->group(function () {
    Route::get('/owner/dashboard', [HomeController::class, 'ownerDashboard'])->name('owner.dashboard');
    Route::get('/owner/pencatatan', [HomeController::class, 'ownerPencatatan'])->name('owner.pencatatan');
    Route::get('/owner/daftarservis', [HomeController::class, 'ownerDaftarServis'])->name('owner.daftarservis');
    Route::get('/owner/konfirmasibiaya', [HomeController::class, 'ownerKonfirmasiBiaya'])->name('owner.konfirmasibiaya');
    Route::get('/owner/diproses', [HomeController::class, 'ownerDiproses'])->name('owner.diproses');
    Route::get('/owner/selesai', [HomeController::class, 'ownerSelesai'])->name('owner.selesai');
    Route::get('/owner/Lunas', [HomeController::class, 'ownerLunas'])->name('owner.lunas');
    Route::get('/owner/rekap', [HomeController::class, 'ownerRekap'])->name('owner.rekap');
    Route::get('/owner/detail', [HomeController::class, 'ownerDetail'])->name('owner.detail');
    Route::get('/owner/akunpelanggan', [HomeController::class, 'ownerAkunPelanggan'])->name('owner.akunpelanggan');
    Route::get('/owner/tambahadmin', [HomeController::class, 'ownerTambahAdmin'])->name('owner.tambahadmin');
});

// User routes
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/homepage', [HomeController::class, 'userDashboard'])->name('user.homepage');
    Route::get('/user/detailservice', [HomeController::class, 'detailservice'])->name('user.detailservice');
    Route::get('/user/tracking', [HomeController::class, 'tracking'])->name('user.tracking');
    Route::get('/user/userservice', [HomeController::class, 'userservice'])->name('user.userservice');
});
