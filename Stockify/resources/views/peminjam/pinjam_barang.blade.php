@extends('layouts.master')

@section('judul', 'Pinjam Barang')

@section('konten')
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<div x-data="{ isLoanModalOpen: false }">
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold">Pinjam Barang</h1>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

        <div class="ui-card ui-card-hover flex flex-col">
            <div class="h-48 bg-gray-100 rounded-lg mb-4 flex items-center justify-center"><i data-feather="camera" class="w-10 h-10 text-gray-400"></i></div>
            <h3 class="font-bold text-lg mb-1">Proyektor Epson</h3>
            <div class="flex items-center gap-2 text-sm text-gray-500 mb-3">
                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Baik</span>
                <span>•</span>
                <span>Tersedia: <span class="font-bold">5</span></span>
            </div>
            <p class="text-sm text-gray-500 flex-grow mb-4">Lengkap dengan kabel HDMI dan tas.</p>
            <button @click="isLoanModalOpen = true" class="ui-button ui-button-primary w-full">
                <i data-feather="shopping-bag" class="w-5 h-5"></i>
                <span>Ajukan Pinjam</span>
            </button>
        </div>

        <div class="ui-card ui-card-hover flex flex-col">
            <div class="h-48 bg-gray-100 rounded-lg mb-4 flex items-center justify-center"><i data-feather="camera" class="w-10 h-10 text-gray-400"></i></div>
            <h3 class="font-bold text-lg mb-1">Sound System</h3>
            <div class="flex items-center gap-2 text-sm text-gray-500 mb-3">
                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Baik</span>
                <span>•</span>
                <span>Tersedia: <span class="font-bold">2</span></span>
            </div>
            <p class="text-sm text-gray-500 flex-grow mb-4">2 speaker aktif + 1 mixer.</p>
            <button @click="isLoanModalOpen = true" class="ui-button ui-button-primary w-full">
                <i data-feather="shopping-bag" class="w-5 h-5"></i>
                <span>Ajukan Pinjam</span>
            </button>
        </div>

        <div class="ui-card flex flex-col bg-gray-50 opacity-70">
            <div class="h-48 bg-gray-200 rounded-lg mb-4 flex items-center justify-center"><i data-feather="camera-off" class="w-10 h-10 text-gray-400"></i></div>
            <h3 class="font-bold text-lg mb-1 text-gray-600">Meja Rapat</h3>
            <div class="flex items-center gap-2 text-sm text-gray-500 mb-3">
                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Rusak Ringan</span>
                <span>•</span>
                <span>Tersedia: <span class="font-bold">0</span></span>
            </div>
            <p class="text-sm text-gray-500 flex-grow mb-4">Ada beberapa goresan di permukaan.</p>
            <button class="ui-button ui-button-secondary w-full cursor-not-allowed">
                <i data-feather="x-circle" class="w-5 h-5"></i>
                <span>Stok Habis</span>
            </button>
        </div>
    </div>

    <div x-show="isLoanModalOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 p-4" style="display: none;">
        <div @click.away="isLoanModalOpen = false" class="ui-card w-full max-w-lg">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-xl font-bold">Ajukan Peminjaman</h3>
                <button @click="isLoanModalOpen = false" class="p-2 rounded-full hover:bg-gray-100"><i data-feather="x" class="w-5 h-5"></i></button>
            </div>
            <form class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Barang yang Dipinjam</label>
                    <input type="text" class="ui-input bg-gray-100" value="Proyektor Epson" disabled>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="loan_jumlah" class="block text-sm font-medium text-gray-700 mb-1">Jumlah</label>
                        <input type="number" id="loan_jumlah" class="ui-input" placeholder="Jumlah yang dipinjam" value="1" required>
                    </div>
                    <div>
                        <label for="loan_tgl_pinjam" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pinjam</label>
                        <input type="date" id="loan_tgl_pinjam" class="ui-input" required>
                    </div>
                </div>
                <div>
                    <label for="loan_tgl_kembali" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Kembali</label>
                    <input type="date" id="loan_tgl_kembali" class="ui-input" required>
                </div>
                <div class="pt-2 text-right">
                    <button type="submit" class="ui-button ui-button-primary">Kirim Permohonan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
