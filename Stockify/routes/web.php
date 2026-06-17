<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('autentikasi.login');
});

Route::prefix('auth')->group(function () {
    Route::get('/login', function () {
        return view('autentikasi.login');
    })->name('login');

    Route::get('/register', function () {
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
    Route::patch('/peminjaman/{peminjaman}/approve', [PeminjamanController::class, 'approve'])->name('peminjaman.approve');
    Route::patch('/peminjaman/{peminjaman}/reject', [PeminjamanController::class, 'reject'])->name('peminjaman.reject');
    Route::patch('/peminjaman/{peminjaman}/return', [PeminjamanController::class, 'returnItem'])->name('peminjaman.return');

    Route::get('/riwayat', [PeminjamanController::class, 'riwayatAdmin'])->name('riwayat');

    Route::get('/profil', function () {
        return view('profil.index', ['role' => 'admin']);
    })->name('profil');
});

Route::middleware(['auth'])->prefix('peminjam')->name('peminjam.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'peminjam'])->name('dashboard');

    Route::get('/barang', [PeminjamanController::class, 'createPeminjam'])->name('barang');
    Route::post('/pinjam', [PeminjamanController::class, 'storePeminjam'])->name('pinjam.store');

    Route::get('/riwayat', [PeminjamanController::class, 'riwayatPeminjam'])->name('riwayat');

    Route::get('/profil', function () {
        return view('profil.index', ['role' => 'peminjam']);
    })->name('profil');
});

Route::fallback(function () {
    return "Halaman tidak ditemukan. (404)";
});
