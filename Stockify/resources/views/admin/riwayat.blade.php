@extends('layouts.master')

@section('judul', 'Riwayat Peminjaman')

@section('konten')
    <div>
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold">Riwayat Peminjaman</h1>
        </div>

        <div class="ui-card">
            <div class="overflow-x-auto">
                <table class="w-full min-w-max text-left">
                    <thead>
                        <tr>
                            <th class="p-4 text-xs font-semibold uppercase tracking-wider text-gray-500 border-b border-gray-200">Peminjam</th>
                            <th class="p-4 text-xs font-semibold uppercase tracking-wider text-gray-500 border-b border-gray-200">Barang</th>
                            <th class="p-4 text-xs font-semibold uppercase tracking-wider text-gray-500 border-b border-gray-200">Tanggal Transaksi</th>
                            <th class="p-4 text-xs font-semibold uppercase tracking-wider text-gray-500 border-b border-gray-200 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $history = [
                            ['user' => 'Candra Wijaya', 'item' => 'Meja Rapat (2)', 'date_start' => '14 Mei 2024', 'date_end' => '15 Mei 2024', 'status' => 'Dikembalikan', 'status_color' => 'green'],
                            ['user' => 'Budi Santoso', 'item' => 'Proyektor Epson (1)', 'date_start' => '15 Mei 2024', 'date_end' => '17 Mei 2024', 'status' => 'Dipinjam', 'status_color' => 'yellow'],
                            ['user' => 'Ani Lestari', 'item' => 'Sound System (1)', 'date_start' => '16 Mei 2024', 'date_end' => '18 Mei 2024', 'status' => 'Menunggu', 'status_color' => 'orange'],
                            ['user' => 'Deni Saputra', 'item' => 'Papan Tulis (1)', 'date_start' => '13 Mei 2024', 'date_end' => '14 Mei 2024', 'status' => 'Ditolak', 'status_color' => 'red']
                        ];
                        @endphp

                        @foreach($history as $item)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="p-4 border-b border-gray-100 font-bold text-gray-800">{{ $item['user'] }}</td>
                            <td class="p-4 border-b border-gray-100 font-medium text-gray-700">{{ $item['item'] }}</td>
                            <td class="p-4 border-b border-gray-100">
                                <p class="text-sm text-gray-600">Pinjam: {{ $item['date_start'] }}</p>
                                <p class="text-sm text-gray-400">Kembali: {{ $item['date_end'] }}</p>
                            </td>
                            <td class="p-4 border-b border-gray-100 text-center">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-{{$item['status_color']}}-100 text-{{$item['status_color']}}-800">{{ $item['status'] }}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
