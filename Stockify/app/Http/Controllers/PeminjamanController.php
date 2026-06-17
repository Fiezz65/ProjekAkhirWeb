<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Peminjaman;
use App\Models\DetailPeminjaman;
use App\Models\User; // Import User model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{

    public function createPeminjam()
    {
        $barangs = Barang::where('jumlah_total', '>', 0)->get();
        return view('peminjam.pinjam_barang', compact('barangs'));
    }

    public function storePeminjam(Request $request)
    {
        $request->validate([
            'tgl_pinjam' => 'required|date',
            'tgl_kembali_plan' => 'required|date|after:tgl_pinjam',
            'items' => 'required|array|min:1',
            'items.*.id_barang' => 'required|exists:barangs,id_barang',
            'items.*.jumlah' => 'required|integer|min:1',
        ], [
            'tgl_pinjam.required' => 'Tanggal pinjam wajib diisi.',
            'tgl_kembali_plan.required' => 'Tanggal rencana kembali wajib diisi.',
            'tgl_kembali_plan.after' => 'Tanggal kembali harus setelah tanggal pinjam.',
            'items.required' => 'Terjadi kesalahan, silakan coba lagi.',
            'items.*.jumlah.min' => 'Jumlah peminjaman minimal 1 barang.',
        ]);

        foreach ($request->items as $item) {
            $barang = Barang::find($item['id_barang']);
            if ($barang->jumlah_tersedia < $item['jumlah']) {
                return back()->with('error', "Stok {$barang->nama_barang} tidak mencukupi. Tersedia: {$barang->jumlah_tersedia}");
            }
        }

        $peminjaman = Peminjaman::create([
            'id_users' => Auth::id(),
            'tgl_pinjam' => $request->tgl_pinjam,
            'tgl_kembali_plan' => $request->tgl_kembali_plan,
            'status' => 'Menunggu',
        ]);

        foreach ($request->items as $item) {
            DetailPeminjaman::create([
                'id_peminjaman' => $peminjaman->id_peminjaman,
                'id_barang' => $item['id_barang'],
                'jumlah' => $item['jumlah'],
            ]);
        }

        return redirect()->route('peminjam.riwayat')->with('success', 'Permohonan peminjaman berhasil diajukan! Silakan tunggu persetujuan Admin.');
    }

    public function riwayatPeminjam()
    {
        $peminjamans = Peminjaman::with('detailPeminjaman.barang')
            ->where('id_users', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('peminjam.riwayat', compact('peminjamans'));
    }

    public function indexAdmin()
    {
        $requests = Peminjaman::with(['user', 'detailPeminjaman.barang'])
            ->orderByRaw("
                CASE status
                    WHEN 'Menunggu' THEN 1
                    WHEN 'Dipinjam' THEN 2
                    WHEN 'Dikembalikan' THEN 3
                    WHEN 'Ditolak' THEN 4
                    ELSE 5
                END
            ")
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.manajemen_peminjaman', compact('requests'));
    }

    public function showPeminjam(User $user)
    {
        $peminjam = $user;

        $peminjamanAktif = Peminjaman::with('detailPeminjaman.barang')
            ->where('id_users', $peminjam->id_users)
            ->where('status', 'Dipinjam')
            ->get();

        $riwayatPeminjaman = Peminjaman::with('detailPeminjaman.barang')
            ->where('id_users', $peminjam->id_users)
            ->orderBy('created_at', 'desc')
            ->get(); // Menghapus batasan .take(5)

        return view('admin.detail_peminjam', compact('peminjam', 'peminjamanAktif', 'riwayatPeminjaman'));
    }

    public function riwayatAdmin()
    {
        $riwayats = Peminjaman::with(['user', 'detailPeminjaman.barang'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.riwayat', compact('riwayats'));
    }

    public function approve(Peminjaman $peminjaman)
    {
        if ($peminjaman->status !== 'Menunggu') {
            return back()->with('error', 'Hanya status Menunggu yang dapat disetujui.');
        }

        foreach ($peminjaman->detailPeminjaman as $detail) {
            $barang = $detail->barang;
            if ($barang->jumlah_tersedia < $detail->jumlah) {
                return back()->with('error', "Gagal! Stok {$barang->nama_barang} tidak mencukupi untuk memenuhi permohonan ini.");
            }
        }

        foreach ($peminjaman->detailPeminjaman as $detail) {
            $barang = $detail->barang;
            $barang->jumlah_tersedia -= $detail->jumlah;
            $barang->save();
        }

        $peminjaman->update(['status' => 'Dipinjam']);

        return back()->with('success', 'Peminjaman disetujui! Stok barang telah dikurangi.');
    }

    public function reject(Peminjaman $peminjaman)
    {
        if ($peminjaman->status !== 'Menunggu') {
            return back()->with('error', 'Hanya status Menunggu yang dapat ditolak.');
        }

        $peminjaman->update(['status' => 'Ditolak']);

        return back()->with('success', 'Peminjaman berhasil ditolak.');
    }

    public function returnItem(Peminjaman $peminjaman)
    {
        if ($peminjaman->status !== 'Dipinjam') {
            return back()->with('error', 'Barang belum berstatus Dipinjam.');
        }

        foreach ($peminjaman->detailPeminjaman as $detail) {
            $barang = $detail->barang;
            $barang->jumlah_tersedia += $detail->jumlah;
            $barang->save();
        }

        $peminjaman->update([
            'status' => 'Dikembalikan',
            'tgl_kembali_asli' => now()->toDateString(),
        ]);

        return back()->with('success', 'Barang telah dikembalikan! Stok barang bertambah otomatis.');
    }
}
