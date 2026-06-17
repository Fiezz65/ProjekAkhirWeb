<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function admin()
    {
        // 1. Total tipe barang yang ada di sistem
        $totalBarang = Barang::count();

        // 2. Jumlah transaksi yang sedang berjalan (barang dipinjam)
        $barangDipinjam = Peminjaman::where('status', 'Dipinjam')->count();

        // 3. Jumlah permohonan baru yang menunggu persetujuan
        $permohonanBaru = Peminjaman::where('status', 'Menunggu')->count();

        // 4. Riwayat 5 peminjaman terbaru untuk tabel kilat
        $peminjamanTerbaru = Peminjaman::with(['user', 'detailPeminjaman.barang'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalBarang',
            'barangDipinjam',
            'permohonanBaru',
            'peminjamanTerbaru'
        ));
    }

    public function peminjam()
    {
        $userId = Auth::id();

        // 1. Peminjaman Aktif (Sedang dipinjam oleh user ini)
        $peminjamanAktif = Peminjaman::where('id_users', $userId)
            ->where('status', 'Dipinjam')
            ->count();

        // 2. Permohonan Pending (Menunggu persetujuan untuk user ini)
        $permohonanPending = Peminjaman::where('id_users', $userId)
            ->where('status', 'Menunggu')
            ->count();

        // 3. Riwayat 5 peminjaman terbaru milik user ini
        $riwayatTerbaru = Peminjaman::with(['detailPeminjaman.barang'])
            ->where('id_users', $userId)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('peminjam.dashboard', compact(
            'peminjamanAktif',
            'permohonanPending',
            'riwayatTerbaru'
        ));
    }
}
