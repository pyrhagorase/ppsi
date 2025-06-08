<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ServisController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
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
    Route::get('/user/tracking', [HomeController::class, 'tracking'])->name('user.tracking');
    Route::get('/user/userservice', [HomeController::class, 'userservice'])->name('user.userservice');
    Route::get('/user/detailservice', [HomeController::class, 'detailservice'])->name('user.detailservice');
    Route::get('/user/detailservice/{id_tracking}', [HomeController::class, 'detailservice'])->name('user.detailservice.show');
    
    // User API routes
    Route::post('/user/search-tracking', [UserController::class, 'searchTracking'])->name('user.search.tracking');
    Route::post('/user/save-service', [UserController::class, 'saveToMyServices'])->name('user.save.service');
    Route::get('/user/my-services', [UserController::class, 'getMyServices'])->name('user.my.services');
    Route::delete('/user/remove-service', [UserController::class, 'removeFromMyServices'])->name('user.remove.service');
    Route::post('/user/confirm-payment', [UserController::class, 'confirmPayment'])->name('user.confirm.payment');
    //Route::get('/user/service-detail/{id_tracking}', [UserController::class, 'getServiceDetail'])->name('user.service.detail');
});
