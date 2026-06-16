<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;

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

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
    Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
    Route::put('/barang/{barang}', [BarangController::class, 'update'])->name('barang.update');
    Route::delete('/barang/{barang}', [BarangController::class, 'destroy'])->name('barang.destroy');

    Route::get('/peminjaman', function () {
        return view('admin.manajemen_peminjaman', ['role' => 'admin']);
    })->name('peminjaman');

    Route::get('/riwayat', function () {
        return view('admin.riwayat', ['role' => 'admin']);
    })->name('riwayat');

    Route::get('/profil', function () {
        return view('profil.index', ['role' => 'admin']);
    })->name('profil');
});

Route::prefix('peminjam')->name('peminjam.')->group(function () {

    Route::get('/dashboard', function () {
        return view('peminjam.dashboard', ['role' => 'peminjam']);
    })->name('dashboard');

    Route::get('/barang', function () {
        return view('peminjam.pinjam_barang', ['role' => 'peminjam']);
    })->name('barang');

    Route::get('/riwayat', function () {
        return view('peminjam.riwayat', ['role' => 'peminjam']);
    })->name('riwayat');

    Route::get('/profil', function () {
        return view('profil.index', ['role' => 'peminjam']);
    })->name('profil');
});

Route::fallback(function () {
    return "Halaman tidak ditemukan. (404)";
});
