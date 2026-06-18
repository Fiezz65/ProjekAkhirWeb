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
        $totalBarang = Barang::count();

        $barangDipinjam = Peminjaman::where('status', 'Dipinjam')->count();

        $permohonanBaru = Peminjaman::where('status', 'Menunggu')->count();

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

        $peminjamanAktif = Peminjaman::where('id_users', $userId)
            ->where('status', 'Dipinjam')
            ->count();

        $permohonanPending = Peminjaman::where('id_users', $userId)
            ->where('status', 'Menunggu')
            ->count();

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
