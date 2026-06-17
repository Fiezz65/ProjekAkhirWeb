@extends('layouts.master')

@section('judul', 'Riwayat Peminjaman')

@section('konten')
    <div>
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold">Riwayat Peminjaman Keseluruhan</h1>
        </div>

        <div class="ui-card">
            <div class="overflow-x-auto">
                <table class="w-full min-w-max text-left">
                    <thead>
                        <tr>
                            <th class="p-4 text-xs font-semibold uppercase tracking-wider text-gray-500 border-b border-gray-200">Peminjam</th>
                            <th class="p-4 text-xs font-semibold uppercase tracking-wider text-gray-500 border-b border-gray-200">Barang & Jumlah</th>
                            <th class="p-4 text-xs font-semibold uppercase tracking-wider text-gray-500 border-b border-gray-200">Tanggal Transaksi</th>
                            <th class="p-4 text-xs font-semibold uppercase tracking-wider text-gray-500 border-b border-gray-200 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($riwayats as $req)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="p-4 border-b border-gray-100 font-bold text-gray-800">{{ $req->user->nama }}</td>
                            <td class="p-4 border-b border-gray-100 font-medium text-gray-700">
                                <ul class="list-disc pl-4">
                                    @foreach($req->detailPeminjaman as $detail)
                                        <li>{{ $detail->barang->nama_barang }} ({{ $detail->jumlah }} unit)</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="p-4 border-b border-gray-100">
                                <p class="text-sm text-gray-600">Pinjam: {{ \Carbon\Carbon::parse($req->tgl_pinjam)->format('d M Y') }}</p>
                                <p class="text-sm text-gray-600">Rencana Kembali: {{ \Carbon\Carbon::parse($req->tgl_kembali_plan)->format('d M Y') }}</p>
                                @if($req->tgl_kembali_asli)
                                    <p class="text-sm text-green-600 font-bold mt-1">Dikembalikan: {{ \Carbon\Carbon::parse($req->tgl_kembali_asli)->format('d M Y') }}</p>
                                @endif
                            </td>
                            <td class="p-4 border-b border-gray-100 text-center">
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
                            <td colspan="4" class="p-4 text-center text-gray-500">Belum ada riwayat peminjaman apapun di sistem.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
