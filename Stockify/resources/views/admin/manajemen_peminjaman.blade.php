@extends('layouts.master')

@section('judul', 'Manajemen Peminjaman')

@section('konten')
    <div>
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold">Manajemen Peminjaman</h1>
        </div>

        <div class="ui-card">
            <div class="overflow-x-auto">
                <table class="w-full min-w-max text-left">
                    <thead>
                        <tr>
                            <th class="p-4 text-xs font-semibold uppercase tracking-wider text-gray-500 border-b border-gray-200">Detail Peminjam</th>
                            <th class="p-4 text-xs font-semibold uppercase tracking-wider text-gray-500 border-b border-gray-200">Barang</th>
                            <th class="p-4 text-xs font-semibold uppercase tracking-wider text-gray-500 border-b border-gray-200">Status</th>
                            <th class="p-4 text-xs font-semibold uppercase tracking-wider text-gray-500 border-b border-gray-200 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $requests = [
                            ['user' => 'Ani Lestari', 'item' => 'Sound System (1)', 'date' => '16 Mei 2024', 'status' => 'Menunggu', 'status_color' => 'orange', 'actions' => ['approve', 'reject']],
                            ['user' => 'Budi Santoso', 'item' => 'Proyektor Epson (1)', 'date' => '15 Mei 2024', 'status' => 'Dipinjam', 'status_color' => 'yellow', 'actions' => ['process_return']],
                            ['user' => 'Candra Wijaya', 'item' => 'Meja Rapat (2)', 'date' => '14 Mei 2024', 'status' => 'Dikembalikan', 'status_color' => 'green', 'actions' => ['done']],
                            ['user' => 'Deni Saputra', 'item' => 'Papan Tulis (1)', 'date' => '13 Mei 2024', 'status' => 'Ditolak', 'status_color' => 'red', 'actions' => ['done']]
                        ];
                        @endphp

                        @foreach($requests as $req)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="p-4 border-b border-gray-100">
                                <p class="font-bold text-gray-800">{{ $req['user'] }}</p>
                                <p class="text-sm text-gray-500">Tgl. Pinjam: {{ $req['date'] }}</p>
                            </td>
                            <td class="p-4 border-b border-gray-100 font-medium text-gray-700">{{ $req['item'] }}</td>
                            <td class="p-4 border-b border-gray-100">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-{{$req['status_color']}}-100 text-{{$req['status_color']}}-800">{{ $req['status'] }}</span>
                            </td>
                            <td class="p-4 border-b border-gray-100 text-center">
                                <div class="flex justify-center items-center gap-2">
                                    @if(in_array('approve', $req['actions']))
                                        <button title="Setujui" class="p-2 rounded-md hover:bg-green-100 text-green-600"><i data-feather="check-circle" class="w-5 h-5"></i></button>
                                        <button title="Tolak" class="p-2 rounded-md hover:bg-red-100 text-red-600"><i data-feather="x-circle" class="w-5 h-5"></i></button>
                                    @endif

                                    @if(in_array('process_return', $req['actions']))
                                        <button title="Tandai Sudah Kembali" class="p-2 rounded-md hover:bg-blue-100 text-blue-600">
                                            <i data-feather="corner-down-left" class="w-5 h-5"></i>
                                        </button>
                                    @endif

                                    @if(in_array('done', $req['actions']))
                                        <span class="text-gray-400" title="Selesai"><i data-feather="check" class="w-5 h-5"></i></span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
