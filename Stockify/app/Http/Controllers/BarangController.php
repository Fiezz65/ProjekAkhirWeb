<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'foto_barang' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        ], [
            'nama_barang.required' => 'Nama barang wajib diisi.',
            'jumlah_total.required' => 'Jumlah total wajib diisi.',
            'jumlah_total.integer' => 'Jumlah total harus berupa angka.',
            'jumlah_total.min' => 'Jumlah total minimal adalah 1.',
            'kondisi.required' => 'Kondisi barang wajib dipilih.',
            'foto_barang.image' => 'File yang diunggah harus berupa gambar.',
            'foto_barang.mimes' => 'Format foto harus berupa: jpeg, png, jpg, atau gif.',
            'foto_barang.max' => 'Ukuran foto tidak boleh lebih dari 10 MB.',
        ]);

        $path = null;
        if ($request->hasFile('foto_barang')) {
            $path = $request->file('foto_barang')->store('foto_barang', 'public');
        }

        Barang::create([
            'nama_barang' => $request->nama_barang,
            'jumlah_total' => $request->jumlah_total,
            'jumlah_tersedia' => $request->jumlah_total,
            'kondisi' => $request->kondisi,
            'keterangan' => $request->keterangan,
            'foto_barang' => $path,
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
            'foto_barang' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        $selisih = $request->jumlah_total - $barang->jumlah_total;
        $jumlahTersediaBaru = $barang->jumlah_tersedia + $selisih;

        if ($jumlahTersediaBaru < 0) {
            return back()->with('error', 'Gagal update: Jumlah total baru lebih sedikit dari jumlah barang yang sedang dipinjam saat ini.');
        }

        $path = $barang->foto_barang;
        if ($request->hasFile('foto_barang')) {
            if ($barang->foto_barang) {
                Storage::disk('public')->delete($barang->foto_barang);
            }
            $path = $request->file('foto_barang')->store('foto_barang', 'public');
        }

        $barang->update([
            'nama_barang' => $request->nama_barang,
            'jumlah_total' => $request->jumlah_total,
            'jumlah_tersedia' => $jumlahTersediaBaru,
            'kondisi' => $request->kondisi,
            'keterangan' => $request->keterangan,
            'foto_barang' => $path,
        ]);

        return redirect()->route('admin.barang.index')->with('success', 'Data barang berhasil diperbarui!');
    }

    public function destroy(Barang $barang)
    {
        if ($barang->jumlah_tersedia < $barang->jumlah_total) {
            return back()->with('error', 'Gagal menghapus: Barang ini sedang dipinjam oleh seseorang!');
        }

        if ($barang->foto_barang) {
            Storage::disk('public')->delete($barang->foto_barang);
        }

        $barang->delete();

        return redirect()->route('admin.barang.index')->with('success', 'Barang berhasil dihapus!');
    }
}
