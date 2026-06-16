@extends('layouts.master')

@section('judul', 'Manajemen Barang')

@section('konten')
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<div x-data="{ isAddModalOpen: false, isEditModalOpen: false }">
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
                        <th class="p-4 text-xs font-semibold uppercase tracking-wider text-gray-500 border-b border-gray-200">Nama Barang</th>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wider text-gray-500 border-b border-gray-200 text-center">Stok</th>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wider text-gray-500 border-b border-gray-200">Kondisi</th>
                        <th class="p-4 text-xs font-semibold uppercase tracking-wider text-gray-500 border-b border-gray-200 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $items = [
                        ['name' => 'Proyektor Epson', 'total' => 5, 'available' => 5, 'condition' => 'Baik', 'condition_color' => 'green'],
                        ['name' => 'Sound System', 'total' => 2, 'available' => 2, 'condition' => 'Baik', 'condition_color' => 'green'],
                        ['name' => 'Meja Rapat', 'total' => 10, 'available' => 8, 'condition' => 'Rusak Ringan', 'condition_color' => 'yellow'],
                        ['name' => 'Papan Tulis Whiteboard', 'total' => 3, 'available' => 3, 'condition' => 'Rusak Berat', 'condition_color' => 'red']
                    ];
                    @endphp

                    @foreach($items as $item)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="p-4 border-b border-gray-100 font-bold text-gray-800">{{ $item['name'] }}</td>
                        <td class="p-4 border-b border-gray-100 text-center"><span class="font-semibold text-gray-700">{{ $item['available'] }}</span><span class="text-gray-400">/{{ $item['total'] }}</span></td>
                        <td class="p-4 border-b border-gray-100"><span class="px-3 py-1 text-xs font-semibold rounded-full bg-{{$item['condition_color']}}-100 text-{{$item['condition_color']}}-800">{{ $item['condition'] }}</span></td>
                        <td class="p-4 border-b border-gray-100">
                            <div class="flex justify-center items-center gap-2">
                                <button @click="isEditModalOpen = true" title="Edit Barang" class="p-2 rounded-md hover:bg-blue-100 text-blue-600 transition-colors"><i data-feather="edit" class="w-4 h-4"></i></button>
                                <button title="Hapus Barang" class="p-2 rounded-md hover:bg-red-100 text-red-600 transition-colors"><i data-feather="trash-2" class="w-4 h-4"></i></button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
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
            <form class="space-y-4">
                <div>
                    <label for="add_nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Barang</label>
                    <input type="text" id="add_nama" class="ui-input" placeholder="Contoh: Proyektor Epson" required>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="add_jumlah" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Total</label>
                        <input type="number" id="add_jumlah" class="ui-input" placeholder="Contoh: 5" required>
                    </div>
                    <div>
                        <label for="add_kondisi" class="block text-sm font-medium text-gray-700 mb-1">Kondisi</label>
                        <select id="add_kondisi" class="ui-input" required>
                            <option value="Baik">Baik</option>
                            <option value="Rusak Ringan">Rusak Ringan</option>
                            <option value="Rusak Berat">Rusak Berat</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label for="add_keterangan" class="block text-sm font-medium text-gray-700 mb-1">Keterangan (Opsional)</label>
                    <textarea id="add_keterangan" rows="2" class="ui-input" placeholder="Contoh: Lengkap dengan kabel HDMI"></textarea>
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
            <form class="space-y-4">
                <div>
                    <label for="edit_nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Barang</label>
                    <input type="text" id="edit_nama" class="ui-input" value="Proyektor Epson" required>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="edit_jumlah" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Total</label>
                        <input type="number" id="edit_jumlah" class="ui-input" value="5" required>
                    </div>
                    <div>
                        <label for="edit_kondisi" class="block text-sm font-medium text-gray-700 mb-1">Kondisi</label>
                        <select id="edit_kondisi" class="ui-input" required>
                            <option value="Baik" selected>Baik</option>
                            <option value="Rusak Ringan">Rusak Ringan</option>
                            <option value="Rusak Berat">Rusak Berat</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label for="edit_keterangan" class="block text-sm font-medium text-gray-700 mb-1">Keterangan (Opsional)</label>
                    <textarea id="edit_keterangan" rows="2" class="ui-input">Lengkap dengan kabel HDMI dan tas.</textarea>
                </div>
                <div class="pt-2 text-right">
                    <button type="submit" class="ui-button ui-button-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
