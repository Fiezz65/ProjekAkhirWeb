@extends('layouts.master')

@section('judul', 'Profil Saya')

@section('konten')
{{-- Kontainer utama diubah menjadi flex column untuk mengisi tinggi layar --}}
<div class="flex flex-col gap-6 h-full">
    <div class="mb-2">
        <h1 class="text-3xl font-extrabold">Profil Saya</h1>
    </div>

    <div class="ui-card">
        <div class="flex flex-col sm:flex-row items-center gap-6">
            <div class="w-24 h-24 rounded-full bg-gray-200 flex-shrink-0 flex items-center justify-center">
                <i data-feather="user" class="w-12 h-12 text-gray-500"></i>
            </div>
            <div class="flex-grow text-center sm:text-left">
                <h2 class="text-2xl font-bold">
                    @if($role == 'admin')
                        Admin Stockify
                    @else
                        Budi Santoso
                    @endif
                </h2>
                <p class="text-gray-500">
                    {{ $role == 'admin' ? 'admin@stockify.com' : 'budi.s@gmail.com' }}
                </p>
                <span class="mt-2 inline-block px-4 py-1 text-sm font-semibold rounded-full bg-indigo-100 text-indigo-800 capitalize">{{ $role }}</span>
            </div>
        </div>

        <hr class="my-5 border-gray-100">

        {{-- PERUBAHAN: Dibuat rata tengah --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
            <div>
                <p class="text-xs text-gray-500 uppercase font-semibold">Alamat</p>
                <p class="font-medium text-gray-700">Jl. Rektorat No. 1</p>
            </div>
            <div>
                <p class="text-xs text-gray-500 uppercase font-semibold">Fakultas</p>
                <p class="font-medium text-gray-700">Ilmu Komputer</p>
            </div>
            <div>
                <p class="text-xs text-gray-500 uppercase font-semibold">Program Studi</p>
                <p class="font-medium text-gray-700">Sistem Informasi</p>
            </div>
        </div>
    </div>

    {{-- PERUBAHAN: Form dibuat 'stretch' untuk mengisi white space --}}
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 flex-grow">
        <div class="ui-card flex flex-col">
            <h3 class="text-xl font-bold mb-6">Edit Informasi</h3>
            <form class="space-y-4 flex-grow flex flex-col">
                <div class="flex-grow space-y-4">
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" id="nama" class="ui-input" placeholder="Masukkan nama lengkap Anda" value="{{ $role == 'admin' ? 'Admin Stockify' : 'Budi Santoso' }}">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" id="email" class="ui-input" placeholder="Masukkan alamat email Anda" value="{{ $role == 'admin' ? 'admin@stockify.com' : 'budi.s@gmail.com' }}">
                    </div>
                </div>
                <div class="pt-4 text-right">
                    <button type="submit" class="ui-button ui-button-primary">
                        <i data-feather="save" class="w-5 h-5"></i>
                        <span>Simpan</span>
                    </button>
                </div>
            </form>
        </div>

        <div class="ui-card flex flex-col">
            <h3 class="text-xl font-bold mb-6">Ubah Password</h3>
            <form class="space-y-4 flex-grow flex flex-col">
                <div class="flex-grow space-y-4">
                    <div>
                        <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Password Saat Ini</label>
                        <input type="password" id="current_password" class="ui-input" placeholder="Masukkan password Anda saat ini">
                    </div>
                    <div>
                        <label for="new_password" class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                        <input type="password" id="new_password" class="ui-input" placeholder="Masukkan password baru (min. 8 karakter)">
                    </div>
                </div>
                <div class="pt-4 text-right">
                    <button type="submit" class="ui-button ui-button-secondary">Ubah Password</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
