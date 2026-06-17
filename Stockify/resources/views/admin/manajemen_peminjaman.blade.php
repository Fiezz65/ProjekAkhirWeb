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
                            <th class="p-4 text-xs font-semibold uppercase tracking-wider text-gray-500 border-b border-gray-200">Barang & Jumlah</th>
                            <th class="p-4 text-xs font-semibold uppercase tracking-wider text-gray-500 border-b border-gray-200">Status</th>
                            <th class="p-4 text-xs font-semibold uppercase tracking-wider text-gray-500 border-b border-gray-200 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($requests as $req)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="p-4 border-b border-gray-100">
                                <a href="{{ route('admin.peminjam.show', $req->user->id_users) }}" class="font-bold text-gray-800 hover:text-blue-600 transition-colors">{{ $req->user->nama }}</a>
                                <p class="text-sm text-gray-500">{{ $req->user->nim }}</p>
                                <p class="text-sm text-gray-500 mt-1">Tanggal Pinjam: {{ \Carbon\Carbon::parse($req->tgl_pinjam)->format('d M Y') }}</p>
                                <p class="text-sm text-gray-500">Rencana Kembali: {{ \Carbon\Carbon::parse($req->tgl_kembali_plan)->format('d M Y') }}</p>
                            </td>
                            <td class="p-4 border-b border-gray-100 font-medium text-gray-700">
                                <ul class="list-disc pl-4">
                                    @foreach($req->detailPeminjaman as $detail)
                                        <li>{{ $detail->barang->nama_barang }} ({{ $detail->jumlah }} unit)</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="p-4 border-b border-gray-100">
                                @php
                                    $statusColor = 'gray';
                                    if($req->status == 'Menunggu') $statusColor = 'orange';
                                    if($req->status == 'Dipinjam') $statusColor = 'yellow';
                                    if($req->status == 'Dikembalikan') $statusColor = 'green';
                                    if($req->status == 'Ditolak') $statusColor = 'red';
                                @endphp
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-{{$statusColor}}-100 text-{{$statusColor}}-800">{{ $req->status }}</span>
                            </td>
                            <td class="p-4 border-b border-gray-100 text-center">
                                <div class="flex justify-center items-center gap-2">
                                    @if($req->status == 'Menunggu')
                                        <form action="{{ route('admin.peminjaman.approve', $req->id_peminjaman) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" title="Setujui" class="p-2 rounded-md hover:bg-green-100 text-green-600">
                                                <i data-feather="check-circle" class="w-5 h-5"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.peminjaman.reject', $req->id_peminjaman) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" title="Tolak" class="p-2 rounded-md hover:bg-red-100 text-red-600">
                                                <i data-feather="x-circle" class="w-5 h-5"></i>
                                            </button>
                                        </form>
                                    @elseif($req->status == 'Dipinjam')
                                        <form action="{{ route('admin.peminjaman.return', $req->id_peminjaman) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" title="Tandai Sudah Kembali" class="p-2 rounded-md hover:bg-blue-100 text-blue-600">
                                                <i data-feather="corner-down-left" class="w-5 h-5"></i>
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-gray-400" title="Selesai"><i data-feather="check" class="w-5 h-5"></i></span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="p-4 text-center text-gray-500">Belum ada data peminjaman.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
