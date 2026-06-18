<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfilController;

Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->role == 'admin') return redirect()->route('admin.dashboard');
        return redirect()->route('peminjam.dashboard');
    }
    return redirect()->route('login');
});

Route::prefix('auth')->group(function () {
    Route::get('/login', function () {
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') return redirect()->route('admin.dashboard');
            return redirect()->route('peminjam.dashboard');
        }
        return view('autentikasi.login');
    })->name('login');

    Route::get('/register', function () {
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') return redirect()->route('admin.dashboard');
            return redirect()->route('peminjam.dashboard');
        }
        return view('autentikasi.register');
    })->name('register');

    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');

    Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
    Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
    Route::put('/barang/{barang}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/barang/{barang}', [BarangController::class, 'destroy'])->name('barang.destroy');

    Route::get('/peminjaman', [PeminjamanController::class, 'indexAdmin'])->name('peminjaman');
    Route::get('/peminjam/{user}', [PeminjamanController::class, 'showPeminjam'])->name('peminjam.show');
    Route::patch('/peminjaman/{peminjaman}/approve', [PeminjamanController::class, 'approve'])->name('peminjaman.approve');
    Route::patch('/peminjaman/{peminjaman}/reject', [PeminjamanController::class, 'reject'])->name('peminjaman.reject');
    Route::patch('/peminjaman/{peminjaman}/return', [PeminjamanController::class, 'returnItem'])->name('peminjaman.return');

    Route::get('/riwayat', [PeminjamanController::class, 'riwayatAdmin'])->name('riwayat');

    Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
    Route::put('/profil/info', [ProfilController::class, 'updateInfo'])->name('profil.info');
    Route::post('/profil/picture', [ProfilController::class, 'updatePicture'])->name('profil.picture');
    Route::put('/profil/password', [ProfilController::class, 'updatePassword'])->name('profil.password');
});

Route::middleware(['auth'])->prefix('peminjam')->name('peminjam.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'peminjam'])->name('dashboard');

    Route::get('/barang', [PeminjamanController::class, 'createPeminjam'])->name('barang');
    Route::post('/pinjam', [PeminjamanController::class, 'storePeminjam'])->name('pinjam.store');

    Route::get('/riwayat', [PeminjamanController::class, 'riwayatPeminjam'])->name('riwayat');

    Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
    Route::put('/profil/info', [ProfilController::class, 'updateInfo'])->name('profil.info');
    Route::post('/profil/picture', [ProfilController::class, 'updatePicture'])->name('profil.picture');
    Route::put('/profil/password', [ProfilController::class, 'updatePassword'])->name('profil.password');
});

Route::fallback(function () {
    return "Halaman tidak ditemukan. (404)";
});
