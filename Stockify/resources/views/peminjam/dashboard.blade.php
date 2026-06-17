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
                    <p class="text-3xl font-bold">{{ $peminjamanAktif }}</p>
                </div>
            </div>

            <div class="ui-card flex items-center gap-5">
                <div class="bg-orange-100 text-orange-600 p-4 rounded-full">
                    <i data-feather="git-pull-request" class="w-7 h-7"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm font-medium">Permohonan Pending</p>
                    <p class="text-3xl font-bold">{{ $permohonanPending }}</p>
                </div>
            </div>
        </div>

        <div class="ui-card">
            <h2 class="text-xl font-bold mb-4">Riwayat Peminjaman Terbaru</h2>
            <div class="overflow-x-auto">
                <table class="w-full min-w-max text-left">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="p-4 text-sm font-semibold text-gray-500">Barang & Jumlah</th>
                            <th class="p-4 text-sm font-semibold text-gray-500">Tanggal Pinjam</th>
                            <th class="p-4 text-sm font-semibold text-gray-500">Tanggal Kembali</th>
                            <th class="p-4 text-sm font-semibold text-gray-500 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($riwayatTerbaru as $req)
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="p-4 text-gray-600">
                                <ul class="list-disc pl-4 font-bold text-gray-800">
                                    @foreach($req->detailPeminjaman as $detail)
                                        <li>{{ $detail->barang->nama_barang }} ({{ $detail->jumlah }})</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="p-4 text-gray-600">{{ \Carbon\Carbon::parse($req->tgl_pinjam)->format('d M Y') }}</td>
                            <td class="p-4 text-gray-600">
                                @if($req->tgl_kembali_asli)
                                    <span class="text-green-600 font-bold">{{ \Carbon\Carbon::parse($req->tgl_kembali_asli)->format('d M Y') }}</span>
                                @else
                                    {{ \Carbon\Carbon::parse($req->tgl_kembali_plan)->format('d M Y') }} (Rencana)
                                @endif
                            </td>
                            <td class="p-4 text-center">
                                @php
                                    $statusColor = 'gray';
                                    if($req->status == 'Menunggu') $statusColor = 'orange';
                                    if($req->status == 'Dipinjam') $statusColor = 'yellow';
                                    if($req->status == 'Dikembalikan') $statusColor = 'green';
                                    if($req->status == 'Ditolak') $statusColor = 'red';
                                @endphp
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-{{$statusColor}}-100 text-{{$statusColor}}-800">{{ $req->status }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="p-4 text-center text-gray-500">Belum ada riwayat peminjaman.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
