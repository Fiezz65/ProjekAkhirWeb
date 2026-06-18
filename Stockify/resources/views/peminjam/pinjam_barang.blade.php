@extends('layouts.master')

@section('judul', 'Pinjam Barang')

@section('konten')
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<div x-data="{
    isLoanModalOpen: false,
    selectedBarang: {},
    openModal(barang) {
        this.selectedBarang = barang;
        this.isLoanModalOpen = true;

        // Set default date to today
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('loan_tgl_pinjam').value = today;
    }
}">
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold">Pinjam Barang</h1>
    </div>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

        @forelse($barangs as $barang)
        <div class="ui-card {{ $barang->jumlah_tersedia > 0 && $barang->kondisi != 'Rusak Berat' ? 'ui-card-hover' : 'bg-gray-50 opacity-70' }} flex flex-col">
            <div class="h-48 bg-gray-100 rounded-lg mb-4 flex items-center justify-center overflow-hidden">
                @if($barang->foto_barang)
                    <img src="{{ Illuminate\Support\Facades\Storage::url($barang->foto_barang) }}" alt="{{ $barang->nama_barang }}" class="w-full h-full object-cover">
                @else
                    <i data-feather="camera" class="w-10 h-10 text-gray-400"></i>
                @endif
            </div>
            <h3 class="font-bold text-lg mb-1">{{ $barang->nama_barang }}</h3>
            <div class="flex items-center gap-2 text-sm text-gray-500 mb-3">
                @php
                    $color = 'green';
                    if($barang->kondisi == 'Rusak Ringan') $color = 'yellow';
                    if($barang->kondisi == 'Rusak Berat') $color = 'red';
                @endphp
                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-{{$color}}-100 text-{{$color}}-800">{{ $barang->kondisi }}</span>
                <span>•</span>
                <span>Tersedia: <span class="font-bold">{{ $barang->jumlah_tersedia }}</span></span>
            </div>
            <p class="text-sm text-gray-500 flex-grow mb-4">{{ $barang->keterangan ?? 'Tidak ada keterangan tambahan.' }}</p>

            @if($barang->jumlah_tersedia > 0 && $barang->kondisi != 'Rusak Berat')
            <button @click="openModal({{ $barang->toJson() }})" class="ui-button ui-button-primary w-full">
                <i data-feather="shopping-bag" class="w-5 h-5"></i>
                <span>Ajukan Pinjam</span>
            </button>
            @else
            <button class="ui-button ui-button-secondary w-full cursor-not-allowed" disabled>
                <i data-feather="x-circle" class="w-5 h-5"></i>
                <span>{{ $barang->kondisi == 'Rusak Berat' ? 'Barang Rusak' : 'Stok Habis' }}</span>
            </button>
            @endif
        </div>
        @empty
        <div class="col-span-full text-center py-8 text-gray-500">
            Belum ada barang yang bisa dipinjam saat ini.
        </div>
        @endforelse

    </div>

    <div x-show="isLoanModalOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 p-4" style="display: none;">
        <div @click.away="isLoanModalOpen = false" class="ui-card w-full max-w-lg">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold">Ajukan Peminjaman</h3>
                <button @click="isLoanModalOpen = false" class="p-2 rounded-full hover:bg-gray-100"><i data-feather="x" class="w-5 h-5"></i></button>
            </div>
            <form action="{{ route('peminjam.pinjam.store') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="items[0][id_barang]" x-model="selectedBarang.id_barang">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Barang yang Dipinjam</label>
                    <input type="text" class="ui-input bg-gray-100" x-model="selectedBarang.nama_barang" disabled>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="loan_jumlah" class="block text-sm font-medium text-gray-700 mb-1">Jumlah</label>
                        <input type="number" name="items[0][jumlah]" id="loan_jumlah" class="ui-input" value="1" min="1" :max="selectedBarang.jumlah_tersedia" required>
                    </div>
                    <div>
                        <label for="loan_tgl_pinjam" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pinjam</label>
                        <input type="date" name="tgl_pinjam" id="loan_tgl_pinjam" class="ui-input" required>
                    </div>
                </div>
                <div>
                    <label for="loan_tgl_kembali" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Kembali (Rencana)</label>
                    <input type="date" name="tgl_kembali_plan" id="loan_tgl_kembali" class="ui-input" required>
                </div>
                <div class="pt-2 text-right">
                    <button type="submit" class="ui-button ui-button-primary">Kirim Permohonan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
