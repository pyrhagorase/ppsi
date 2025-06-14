<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OwnerServisController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ServisController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RekapController;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\NotaUserController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\OwnerNotaController;
use App\Http\Controllers\OwnerRekapController;
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
    Route::post('admin/servis/store', [ServisController::class, 'store'])->name('admin.servis.store');
    Route::get('/admin/daftarservis', [HomeController::class, 'adminDaftarServis'])->name('admin.daftarservis');
    Route::get('/admin/konfirmasibiaya', [HomeController::class, 'adminKonfirmasiBiaya'])->name('admin.konfirmasibiaya');
    Route::get('/admin/diproses', [HomeController::class, 'adminDiproses'])->name('admin.diproses');
    Route::get('/admin/selesai', [HomeController::class, 'adminSelesai'])->name('admin.selesai');
    Route::get('/admin/Lunas', [HomeController::class, 'adminLunas'])->name('admin.lunas');
    Route::get('/admin/rekap', [HomeController::class, 'adminRekap'])->name('admin.rekap');
    // Route untuk admin kelola ulasan
    Route::get('/admin/ulasan', [UlasanController::class, 'adminIndex'])->name('admin.ulasan');
    Route::delete('/admin/ulasan/{id}', [UlasanController::class, 'destroy'])->name('admin.ulasan.delete');
    Route::post('/admin/ulasan/{id}/toggle-approval', [UlasanController::class, 'toggleApproval'])->name('admin.ulasan.toggle');
    Route::get('/admin/detail/{id_tracking}', [ServisController::class, 'showDetail'])->name('admin.detail');
    Route::post('/admin/servis/update-status/{id_tracking}', [ServisController::class, 'updateServisStatus'])->name('admin.updateServisStatus');
    Route::get('/admin/daftarservis', [ServisController::class, 'index'])->name('admin.daftarservis');
    Route::get('/admin/konfirmasibiaya', [AdminController::class, 'adminKonfirmasiBiaya'])->name('admin.konfirmasibiaya');
    Route::get('/admin/diproses', [AdminController::class, 'diproses'])->name('admin.diproses');
    Route::get('/admin/selesai', [AdminController::class, 'selesai'])->name('admin.selesai');
    Route::get('/admin/lunas', [AdminController::class, 'lunas'])->name('admin.lunas');
    Route::post('/admin/update-keterangan/{id_tracking}', [AdminController::class, 'updateKeterangan'])->name('admin.updateKeterangan');
    Route::post('/admin/servis/update-detail/{id_tracking}', [AdminController::class, 'updateServisDetail'])->name('admin.updateServisDetail');
    Route::delete('/admin/servis/{id_tracking}/delete', [AdminController::class, 'deleteServis'])->name('admin.deleteServis');
    // routes/web.php
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/rekap', [RekapController::class, 'index'])->name('admin.rekap');
    Route::post('/admin/rekap/export', [RekapController::class, 'exportPDF'])->name('admin.rekap.export');
    // nota
    Route::post('/admin/nota/simpan', [NotaController::class, 'simpan'])->name('admin.nota.simpan');
});

// Owner routes
Route::middleware(['auth', 'role:owner'])->group(function () {
    Route::get('/owner/dashboard', [HomeController::class, 'ownerDashboard'])->name('owner.dashboard');
    // pencatatan
    Route::get('/owner/pencatatan', [HomeController::class, 'ownerPencatatan'])->name('owner.pencatatan');
    Route::post('owner/servis/store', [OwnerServisController::class, 'store'])->name('owner.servis.store');
    Route::get('/owner/daftarservis', [HomeController::class, 'ownerDaftarServis'])->name('owner.daftarservis');
    Route::get('/owner/daftarservis', [OwnerServisController::class, 'index'])->name('owner.daftarservis');

    Route::get('/owner/konfirmasibiaya', [HomeController::class, 'ownerKonfirmasiBiaya'])->name('owner.konfirmasibiaya');
    Route::get('/owner/diproses', [HomeController::class, 'ownerDiproses'])->name('owner.diproses');
    Route::get('/owner/selesai', [HomeController::class, 'ownerSelesai'])->name('owner.selesai');
    Route::get('/owner/Lunas', [HomeController::class, 'ownerLunas'])->name('owner.lunas');
    Route::get('/owner/rekap', [HomeController::class, 'ownerRekap'])->name('owner.rekap');
    Route::get('/owner/detail', [HomeController::class, 'ownerDetail'])->name('owner.detail');
    Route::get('/owner/akunpelanggan', [HomeController::class, 'ownerAkunPelanggan'])->name('owner.akunpelanggan');
    Route::get('/owner/tambahadmin', [HomeController::class, 'ownerTambahAdmin'])->name('owner.tambahadmin');
    Route::get('/owner/ulasan', [HomeController::class, 'ownerUlasan'])->name('owner.ulasan');
    // dashboard
    Route::get('/owner/dashboard', [OwnerController::class, 'dashboard'])->name('owner.dashboard');
    // detail servis
    Route::get('/owner/detail/{id_tracking}', [OwnerServisController::class, 'showDetail'])->name('owner.detail');
    Route::post('/owner/servis/update-status/{id_tracking}', [OwnerServisController::class, 'updateServisStatus'])->name('owner.updateServisStatus');
    Route::get('/owner/konfirmasibiaya', [OwnerController::class, 'ownerKonfirmasiBiaya'])->name('owner.konfirmasibiaya');
    Route::get('/owner/diproses', [OwnerController::class, 'diproses'])->name('owner.diproses');
    Route::get('/owner/selesai', [OwnerController::class, 'selesai'])->name('owner.selesai');
    Route::get('/owner/lunas', [OwnerController::class, 'lunas'])->name('owner.lunas');
    Route::post('/owner/update-keterangan/{id_tracking}', [OwnerController::class, 'updateKeterangan'])->name('owner.updateKeterangan');
    Route::post('/owner/servis/update-detail/{id_tracking}', [OwnerController::class, 'updateServisDetail'])->name('owner.updateServisDetail');
    Route::delete('/owner/servis/{id_tracking}/delete', [OwnerController::class, 'deleteServis'])->name('owner.deleteServis');
    Route::post('/owner/nota/simpan', [OwnerNotaController::class, 'simpan'])->name('owner.nota.simpan');
    Route::get('/owner/rekap', [OwnerRekapController::class, 'index'])->name('owner.rekap');
    Route::post('/owner/rekap/export', [OwnerRekapController::class, 'exportPDF'])->name('owner.rekap.export');
    // Route untuk memproses registrasi admin baru
    Route::post('/owner/register-admin', [OwnerController::class, 'store'])->name('owner.register.admin');
});

// User routes
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/homepage', [HomeController::class, 'userDashboard'])->name('user.homepage');
    Route::get('/user/tracking', [HomeController::class, 'tracking'])->name('user.tracking');
    Route::get('/user/userservice', [HomeController::class, 'userservice'])->name('user.userservice');
    // Update route untuk detail service - tambahkan route dengan parameter
    Route::get('/user/detailservice', [HomeController::class, 'detailservice'])->name('user.detailservice');
    Route::get('/user/detailservice/{id_tracking}', [HomeController::class, 'detailservice'])->name('user.detailservice.show');
    // User API routes
    Route::post('/user/search-tracking', [UserController::class, 'searchTracking'])->name('user.search.tracking');
    Route::post('/user/save-service', [UserController::class, 'saveToMyServices'])->name('user.save.service');
    Route::get('/user/my-services', [UserController::class, 'getMyServices'])->name('user.my.services');
    Route::delete('/user/remove-service', [UserController::class, 'removeFromMyServices'])->name('user.remove.service');
    Route::post('/user/confirm-payment', [UserController::class, 'confirmPayment'])->name('user.confirm.payment');
    // Nota
    Route::get('/user/nota/{id_tracking}/unduh', [NotaController::class, 'unduhNota'])->name('user.unduh.nota');
    // Route untuk submit ulasan
    Route::post('/user/submit-ulasan', [UlasanController::class, 'store'])->name('user.submit.ulasan');
});
