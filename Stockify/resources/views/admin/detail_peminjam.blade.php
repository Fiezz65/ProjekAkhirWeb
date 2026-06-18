@extends('layouts.master')

@section('judul', 'Detail Peminjam')

@section('konten')
    <div>
        <div class="flex items-center gap-4 mb-6">
            <a href="{{ url()->previous() }}" class="flex items-center justify-center w-10 h-10 bg-white border border-gray-200 rounded-full text-gray-600 hover:bg-gray-100 hover:text-gray-800 transition-colors duration-200">
                <i data-feather="arrow-left" class="w-5 h-5"></i>
            </a>
            <h1 class="text-2xl font-bold text-gray-800">Detail Peminjam</h1>
        </div>

        <div class="ui-card mb-8">
            <div class="flex flex-col sm:flex-row items-start gap-6">
                <img src="{{ $peminjam->profile_picture_path ? asset('storage/' . $peminjam->profile_picture_path) : 'https://ui-avatars.com/api/?name='.urlencode($peminjam->nama).'&background=EBF4FF&color=7F9CF5' }}" alt="Foto Profil" class="w-24 h-24 rounded-full object-cover flex-shrink-0 ring-4 ring-blue-50">
                <div class="w-full">
                    <h1 class="text-2xl font-bold text-gray-800">{{ $peminjam->nama }}</h1>
                    <p class="text-md text-gray-500">{{ $peminjam->nim }}</p>
                    <hr class="my-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-5 text-sm">
                        <div class="flex items-start">
                            <i data-feather="mail" class="w-4 h-4 mt-1 mr-3 text-gray-400 flex-shrink-0"></i>
                            <div>
                                <p class="font-semibold text-gray-500">Email</p>
                                <p class="text-gray-800 break-all">{{ $peminjam->email }}</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i data-feather="phone" class="w-4 h-4 mt-1 mr-3 text-gray-400 flex-shrink-0"></i>
                            <div>
                                <p class="font-semibold text-gray-500">Nomor Telepon</p>
                                <p class="text-gray-800">{{ $peminjam->no_telp ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i data-feather="book-open" class="w-4 h-4 mt-1 mr-3 text-gray-400 flex-shrink-0"></i>
                            <div>
                                <p class="font-semibold text-gray-500">Fakultas & Prodi</p>
                                <p class="text-gray-800 break-words">{{ $peminjam->fakultas ?? '-' }} / {{ $peminjam->program_studi ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i data-feather="map-pin" class="w-4 h-4 mt-1 mr-3 text-gray-400 flex-shrink-0"></i>
                            <div>
                                <p class="font-semibold text-gray-500">Alamat</p>
                                <p class="text-gray-800 break-words">{{ $peminjam->alamat ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="ui-card">
            <h2 class="text-xl font-bold mb-4">Riwayat Peminjaman</h2>
            <div class="overflow-x-auto">
                <table class="w-full min-w-max text-left">
                    <thead>
                        <tr>
                            <th class="p-4 text-xs font-semibold uppercase tracking-wider text-gray-500 border-b">Detail Barang</th>
                            <th class="p-4 text-xs font-semibold uppercase tracking-wider text-gray-500 border-b">Tanggal</th>
                            <th class="p-4 text-xs font-semibold uppercase tracking-wider text-gray-500 border-b text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($riwayatPeminjaman as $peminjaman)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="p-4 border-b border-gray-100">
                                <ul class="list-disc pl-5 space-y-1 text-gray-700">
                                    @foreach($peminjaman->detailPeminjaman as $detail)
                                        <li>
                                            <span class="font-medium">{{ $detail->barang->nama_barang }}</span>
                                            <span class="text-gray-600">({{ $detail->jumlah }} unit)</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="p-4 border-b border-gray-100 text-sm">
                                <p><span class="font-semibold">Pinjam:</span> {{ \Carbon\Carbon::parse($peminjaman->tgl_pinjam)->format('d M Y') }}</p>
                                <p><span class="font-semibold">Kembali:</span> {{ \Carbon\Carbon::parse($peminjaman->tgl_kembali_plan)->format('d M Y') }}</p>
                                @if($peminjaman->tgl_kembali_asli)
                                    <p class="text-green-600 mt-1"><span class="font-bold">Dikembalikan:</span> {{ \Carbon\Carbon::parse($peminjaman->tgl_kembali_asli)->format('d M Y') }}</p>
                                @endif
                            </td>
                            <td class="p-4 border-b border-gray-100 text-center">
                                @php
                                    $statusColor = 'gray';
                                    if($peminjaman->status == 'Menunggu') $statusColor = 'orange';
                                    if($peminjaman->status == 'Dipinjam') $statusColor = 'yellow';
                                    if($peminjaman->status == 'Dikembalikan') $statusColor = 'green';
                                    if($peminjaman->status == 'Ditolak') $statusColor = 'red';
                                @endphp
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-{{$statusColor}}-100 text-{{$statusColor}}-800">{{ $peminjaman->status }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="p-8 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <i data-feather="archive" class="w-10 h-10 mb-2 text-gray-400"></i>
                                    <p>Pengguna ini belum memiliki riwayat peminjaman.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
