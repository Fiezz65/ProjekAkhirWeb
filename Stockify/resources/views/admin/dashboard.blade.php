@extends('layouts.master')

@section('judul', 'Dashboard Admin')

@section('konten')
    <div>
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold">Selamat Datang, Admin!</h1>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">

            <div class="ui-card flex items-center gap-5">
                <div class="bg-indigo-100 text-indigo-600 p-4 rounded-full">
                    <i data-feather="archive" class="w-7 h-7"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm font-medium">Total Barang</p>
                    <p class="text-3xl font-bold">15</p>
                </div>
            </div>

            <div class="ui-card flex items-center gap-5">
                <div class="bg-yellow-100 text-yellow-600 p-4 rounded-full">
                    <i data-feather="arrow-up-right" class="w-7 h-7"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm font-medium">Barang Dipinjam</p>
                    <p class="text-3xl font-bold">3</p>
                </div>
            </div>

            <div class="ui-card flex items-center gap-5">
                <div class="bg-orange-100 text-orange-600 p-4 rounded-full">
                    <i data-feather="git-pull-request" class="w-7 h-7"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm font-medium">Permohonan Baru</p>
                    <p class="text-3xl font-bold">2</p>
                </div>
            </div>
        </div>

        <div class="ui-card">
            <h2 class="text-xl font-bold mb-4">Peminjaman Terbaru</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="border-b border-gray-200">
                        <tr>
                            <th class="p-4 text-sm font-semibold text-gray-500">Peminjam</th>
                            <th class="p-4 text-sm font-semibold text-gray-500">Barang</th>
                            <th class="p-4 text-sm font-semibold text-gray-500">Tgl Pinjam</th>
                            <th class="p-4 text-sm font-semibold text-gray-500 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="p-4 font-medium">Budi Santoso</td>
                            <td class="p-4 text-gray-600">Proyektor Epson</td>
                            <td class="p-4 text-gray-600">15 Mei 2024</td>
                            <td class="p-4 text-center"><span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Dipinjam</span></td>
                        </tr>
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="p-4 font-medium">Ani Lestari</td>
                            <td class="p-4 text-gray-600">Sound System</td>
                            <td class="p-4 text-gray-600">16 Mei 2024</td>
                            <td class="p-4 text-center"><span class="px-3 py-1 text-xs font-semibold rounded-full bg-orange-100 text-orange-800">Menunggu</span></td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="p-4 font-medium">Candra Wijaya</td>
                            <td class="p-4 text-gray-600">Meja Rapat</td>
                            <td class="p-4 text-gray-600">14 Mei 2024</td>
                            <td class="p-4 text-center"><span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Dikembalikan</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
