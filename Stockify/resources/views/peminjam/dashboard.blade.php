@extends('layouts.master')

@section('judul', 'Dashboard Peminjam')

@section('konten')
    <div>
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold">Dashboard Saya</h1>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">

            <div class="ui-card flex items-center gap-5">
                <div class="bg-blue-100 text-blue-600 p-4 rounded-full">
                    <i data-feather="arrow-up-right" class="w-7 h-7"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm font-medium">Peminjaman Aktif</p>
                    <p class="text-3xl font-bold">1</p>
                </div>
            </div>

            <div class="ui-card flex items-center gap-5">
                <div class="bg-orange-100 text-orange-600 p-4 rounded-full">
                    <i data-feather="git-pull-request" class="w-7 h-7"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm font-medium">Permohonan Pending</p>
                    <p class="text-3xl font-bold">1</p>
                </div>
            </div>
        </div>

        <div class="ui-card">
            <h2 class="text-xl font-bold mb-4">Riwayat Peminjaman Terbaru</h2>
            <div class="overflow-x-auto">
                <table class="w-full min-w-max text-left">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="p-4 text-sm font-semibold text-gray-500">Barang</th>
                            <th class="p-4 text-sm font-semibold text-gray-500">Tgl. Pinjam</th>
                            <th class="p-4 text-sm font-semibold text-gray-500">Tgl. Kembali</th>
                            <th class="p-4 text-sm font-semibold text-gray-500 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="p-4 font-medium">Proyektor Epson</td>
                            <td class="p-4 text-gray-600">15 Mei 2024</td>
                            <td class="p-4 text-gray-600">17 Mei 2024</td>
                            <td class="p-4 text-center"><span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Dipinjam</span></td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="p-4 font-medium">Sound System</td>
                            <td class="p-4 text-gray-600">16 Mei 2024</td>
                            <td class="p-4 text-gray-600">18 Mei 2024</td>
                            <td class="p-4 text-center"><span class="px-3 py-1 text-xs font-semibold rounded-full bg-orange-100 text-orange-800">Menunggu</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
