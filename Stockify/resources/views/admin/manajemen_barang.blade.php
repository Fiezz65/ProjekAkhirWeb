@extends('layouts.master')

@section('judul', 'Manajemen Barang')

@section('konten')
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<div x-data="{
    isAddModalOpen: false,
    isEditModalOpen: false,
    editData: { id_barang: '', nama_barang: '', jumlah_total: '', kondisi: '', keterangan: '' },
    editBarang(barang) {
        this.editData = barang;
        this.isEditModalOpen = true;
    }
}">
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="flex flex-wrap justify-between items-center gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-extrabold">Manajemen Barang</h1>
        </div>
        <button @click="isAddModalOpen = true" class="ui-button ui-button-primary">
            <i data-feather="plus" class="w-5 h-5"></i>
            <span>Tambah Barang Baru</span>
        </button>
    </div>

    <div class="ui-card">
        <div class="overflow-x-auto">
            <table class="w-full min-w-max text-left">
                <thead>
                    <tr>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wider text-gray-500 border-b border-gray-200">Foto</th>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wider text-gray-500 border-b border-gray-200">Nama Barang</th>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wider text-gray-500 border-b border-gray-200 text-center">Stok</th>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wider text-gray-500 border-b border-gray-200">Kondisi</th>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wider text-gray-500 border-b border-gray-200">Keterangan</th>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wider text-gray-500 border-b border-gray-200 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($barangs as $barang)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="p-4 border-b border-gray-100">
                            @if($barang->foto_barang)
                                <img src="{{ Illuminate\Support\Facades\Storage::url($barang->foto_barang) }}" alt="{{ $barang->nama_barang }}" class="w-16 h-16 object-cover rounded-md">
                            @else
                                <div class="w-16 h-16 bg-gray-200 rounded-md flex items-center justify-center">
                                    <i data-feather="camera-off" class="w-6 h-6 text-gray-400"></i>
                                </div>
                            @endif
                        </td>
                        <td class="p-4 border-b border-gray-100 font-bold text-gray-800">{{ $barang->nama_barang }}</td>
                        <td class="p-4 border-b border-gray-100 text-center"><span class="font-semibold text-gray-700">{{ $barang->jumlah_tersedia }}</span><span class="text-gray-400">/{{ $barang->jumlah_total }}</span></td>
                        <td class="p-4 border-b border-gray-100">
                            @php
                                $color = 'green';
                                if($barang->kondisi == 'Rusak Ringan') $color = 'yellow';
                                if($barang->kondisi == 'Rusak Berat') $color = 'red';
                            @endphp
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-{{$color}}-100 text-{{$color}}-800">{{ $barang->kondisi }}</span>
                        </td>
                        <td class="p-4 border-b border-gray-100 text-sm text-gray-600">
                            {{ $barang->keterangan ?: '-' }}
                        </td>
                        <td class="p-4 border-b border-gray-100">
                            <div class="flex justify-center items-center gap-2">
                                <button @click="editBarang({{ $barang->toJson() }})" title="Edit Barang" class="p-2 rounded-md hover:bg-blue-100 text-blue-600 transition-colors"><i data-feather="edit" class="w-4 h-4"></i></button>
                                <form action="{{ route('admin.barang.destroy', $barang->id_barang) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Hapus Barang" class="p-2 rounded-md hover:bg-red-100 text-red-600 transition-colors"><i data-feather="trash-2" class="w-4 h-4"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-4 text-center text-gray-500">Belum ada data barang.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div x-show="isAddModalOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 p-4" style="display: none;">
        <div @click.away="isAddModalOpen = false" class="ui-card w-full max-w-lg">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold">Tambah Barang Baru</h3>
                <button @click="isAddModalOpen = false" class="p-2 rounded-full hover:bg-gray-100"><i data-feather="x" class="w-5 h-5"></i></button>
            </div>
            <form action="{{ route('admin.barang.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label for="add_nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Barang</label>
                    <input type="text" name="nama_barang" id="add_nama" class="ui-input" placeholder="Contoh: Proyektor Epson" required>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="add_jumlah" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Total</label>
                        <input type="number" name="jumlah_total" id="add_jumlah" class="ui-input" placeholder="Contoh: 5" required min="1">
                    </div>
                    <div>
                        <label for="add_kondisi" class="block text-sm font-medium text-gray-700 mb-1">Kondisi</label>
                        <select name="kondisi" id="add_kondisi" class="ui-input" required>
                            <option value="Baik">Baik</option>
                            <option value="Rusak Ringan">Rusak Ringan</option>
                            <option value="Rusak Berat">Rusak Berat</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label for="add_foto" class="block text-sm font-medium text-gray-700 mb-1">Foto Barang (Opsional)</label>
                    <input type="file" name="foto_barang" id="add_foto" class="ui-input" accept="image/*">
                </div>
                <div>
                    <label for="add_keterangan" class="block text-sm font-medium text-gray-700 mb-1">Keterangan (Opsional)</label>
                    <textarea name="keterangan" id="add_keterangan" rows="2" class="ui-input" placeholder="Contoh: Lengkap dengan kabel HDMI"></textarea>
                </div>
                <div class="pt-2 text-right">
                    <button type="submit" class="ui-button ui-button-primary">Simpan Barang</button>
                </div>
            </form>
        </div>
    </div>

    <div x-show="isEditModalOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 p-4" style="display: none;">
        <div @click.away="isEditModalOpen = false" class="ui-card w-full max-w-lg">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold">Edit Barang</h3>
                <button @click="isEditModalOpen = false" class="p-2 rounded-full hover:bg-gray-100"><i data-feather="x" class="w-5 h-5"></i></button>
            </div>
            <form :action="`/admin/barang/${editData.id_barang}`" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label for="edit_nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Barang</label>
                    <input type="text" name="nama_barang" id="edit_nama" class="ui-input" x-model="editData.nama_barang" required>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="edit_jumlah" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Total</label>
                        <input type="number" name="jumlah_total" id="edit_jumlah" class="ui-input" x-model="editData.jumlah_total" required min="1">
                    </div>
                    <div>
                        <label for="edit_kondisi" class="block text-sm font-medium text-gray-700 mb-1">Kondisi</label>
                        <select name="kondisi" id="edit_kondisi" class="ui-input" x-model="editData.kondisi" required>
                            <option value="Baik">Baik</option>
                            <option value="Rusak Ringan">Rusak Ringan</option>
                            <option value="Rusak Berat">Rusak Berat</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label for="edit_foto" class="block text-sm font-medium text-gray-700 mb-1">Foto Barang (Biarkan kosong jika tidak ingin mengubah)</label>
                    <input type="file" name="foto_barang" id="edit_foto" class="ui-input" accept="image/*">
                </div>
                <div>
                    <label for="edit_keterangan" class="block text-sm font-medium text-gray-700 mb-1">Keterangan (Opsional)</label>
                    <textarea name="keterangan" id="edit_keterangan" rows="2" class="ui-input" x-model="editData.keterangan"></textarea>
                </div>
                <div class="pt-2 text-right">
                    <button type="submit" class="ui-button ui-button-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
