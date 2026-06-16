<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::orderBy('created_at', 'desc')->get();
        return view('admin.manajemen_barang', compact('barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'jumlah_total' => 'required|integer|min:1',
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'keterangan' => 'nullable|string',
        ]);

        Barang::create([
            'nama_barang' => $request->nama_barang,
            'jumlah_total' => $request->jumlah_total,
            'jumlah_tersedia' => $request->jumlah_total, // Awal tambah, tersedia = total
            'kondisi' => $request->kondisi,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('admin.barang.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'jumlah_total' => 'required|integer|min:1',
            'kondisi' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
            'keterangan' => 'nullable|string',
        ]);

        // Hitung selisih jumlah total untuk menyesuaikan jumlah tersedia
        $selisih = $request->jumlah_total - $barang->jumlah_total;
        $jumlahTersediaBaru = $barang->jumlah_tersedia + $selisih;

        // Cegah update jika jumlah tersedia menjadi negatif (karena sedang dipinjam lebih dari jumlah baru)
        if ($jumlahTersediaBaru < 0) {
            return back()->with('error', 'Gagal update: Jumlah total baru lebih sedikit dari jumlah barang yang sedang dipinjam saat ini.');
        }

        $barang->update([
            'nama_barang' => $request->nama_barang,
            'jumlah_total' => $request->jumlah_total,
            'jumlah_tersedia' => $jumlahTersediaBaru,
            'kondisi' => $request->kondisi,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('admin.barang.index')->with('success', 'Data barang berhasil diperbarui!');
    }

    public function destroy(Barang $barang)
    {
        // Validasi: Cek apakah barang sedang dipinjam
        // Di PRD: Barang tidak bisa dihapus jika masih ada transaksi berstatus "Dipinjam"
        // Logika ini akan lebih akurat saat relasi Peminjaman sudah dibuat. 
        // Sementara kita pakai jumlah_tersedia != jumlah_total sebagai deteksi sederhana
        if ($barang->jumlah_tersedia < $barang->jumlah_total) {
            return back()->with('error', 'Gagal menghapus: Barang ini sedang dipinjam oleh seseorang!');
        }

        $barang->delete();

        return redirect()->route('admin.barang.index')->with('success', 'Barang berhasil dihapus!');
    }
}
