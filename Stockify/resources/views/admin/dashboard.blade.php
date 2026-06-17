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
                    <p class="text-3xl font-bold">{{ $totalBarang }}</p>
                </div>
            </div>

            <div class="ui-card flex items-center gap-5">
                <div class="bg-yellow-100 text-yellow-600 p-4 rounded-full">
                    <i data-feather="arrow-up-right" class="w-7 h-7"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm font-medium">Barang Dipinjam</p>
                    <p class="text-3xl font-bold">{{ $barangDipinjam }}</p>
                </div>
            </div>

            <div class="ui-card flex items-center gap-5">
                <div class="bg-orange-100 text-orange-600 p-4 rounded-full">
                    <i data-feather="git-pull-request" class="w-7 h-7"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm font-medium">Permohonan Baru</p>
                    <p class="text-3xl font-bold">{{ $permohonanBaru }}</p>
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
                            <th class="p-4 text-sm font-semibold text-gray-500">Barang & Jumlah</th>
                            <th class="p-4 text-sm font-semibold text-gray-500">Tanggal Pinjam</th>
                            <th class="p-4 text-sm font-semibold text-gray-500 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($peminjamanTerbaru as $req)
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="p-4">
                                <a href="{{ route('admin.peminjam.show', $req->user->id_users) }}" class="font-bold hover:text-blue-600 transition-colors">{{ $req->user->nama }}</a>
                                <p class="text-sm text-gray-500">{{ $req->user->nim }}</p>
                            </td>
                            <td class="p-4 text-gray-600">
                                <ul class="list-disc pl-4">
                                    @foreach($req->detailPeminjaman as $detail)
                                        <li>{{ $detail->barang->nama_barang }} ({{ $detail->jumlah }})</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="p-4 text-gray-600">{{ \Carbon\Carbon::parse($req->tgl_pinjam)->format('d M Y') }}</td>
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
                            <td colspan="4" class="p-4 text-center text-gray-500">Belum ada peminjaman terbaru.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
