@extends('layouts.master')

@section('judul', 'Daftar Akun Baru')
@section('body-class', 'overflow-hidden')

@section('konten')
{{-- Padding vertikal utama dipangkas habis --}}
<div class="flex items-center justify-center min-h-screen w-full bg-gray-50 py-2">
    <div class="w-full max-w-lg p-4">

        {{-- Margin bawah judul dikurangi --}}
        <div class="text-center mb-4">
            <h1 class="text-3xl font-extrabold tracking-wider text-indigo-600">STOCKIFY</h1>
        </div>

        <div class="ui-card p-5">
            <div class="text-center mb-4">
                <h2 class="text-xl font-bold">Buat Akun Baru</h2>
            </div>

            {{-- PERBAIKAN FINAL: LAYOUT KEMBALI KE VERTIKAL, SEMUA JARAK DIPADATKAN --}}
            <form action="#" method="POST" class="space-y-2">

                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" class="ui-input py-2 px-3" placeholder="Masukkan nama lengkap" required>
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="email" name="email" class="ui-input py-2 px-3" placeholder="Masukkan alamat email" required>
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" id="password" name="password" class="ui-input py-2 px-3" placeholder="Minimal 8 karakter" required>
                </div>
                <div>
                    <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                    <input type="text" id="alamat" name="alamat" class="ui-input py-2 px-3" placeholder="Masukkan alamat tinggal" required>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                    <div>
                        <label for="fakultas" class="block text-sm font-medium text-gray-700 mb-1">Fakultas</label>
                        <select id="fakultas" name="fakultas" class="ui-input py-2 px-3" required>
                            <option value="">Pilih fakultas</option>
                        </select>
                    </div>
                    <div>
                        <label for="program_studi" class="block text-sm font-medium text-gray-700 mb-1">Program Studi</label>
                        <select id="program_studi" name="program_studi" class="ui-input py-2 px-3" required disabled>
                            <option value="">Pilih program studi</d>
                        </select>
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full ui-button ui-button-primary py-2 px-4 text-sm">
                        <i data-feather="user-plus" class="w-4 h-4"></i>
                        <span>Daftar</span>
                    </button>
                </div>
            </form>

            <div class="text-center mt-3">
                <p class="text-xs text-gray-600">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:underline">
                        Login di sini
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    const dataAkademik = {
        "Ilmu Komputer": ["Sistem Informasi", "Teknik Informatika", "Desain Komunikasi Visual"],
        "Teknik": ["Teknik Elektro", "Teknik Mesin", "Teknik Sipil"],
        "Ekonomi dan Bisnis": ["Manajemen", "Akuntansi", "Ekonomi Pembangunan"],
        "Ilmu Sosial dan Politik": ["Ilmu Komunikasi", "Hubungan Internasional", "Administrasi Publik"]
    };

    const fakultasSelect = document.getElementById('fakultas');
    const prodiSelect = document.getElementById('program_studi');

    document.addEventListener('DOMContentLoaded', () => {
        Object.keys(dataAkademik).forEach(fakultas => {
            fakultasSelect.add(new Option(fakultas, fakultas));
        });
    });

    fakultasSelect.addEventListener('change', () => {
        prodiSelect.innerHTML = '<option value="">Pilih program studi</option>';
        prodiSelect.disabled = true;
        if (fakultasSelect.value && dataAkademik[fakultasSelect.value]) {
            prodiSelect.disabled = false;
            dataAkademik[fakultasSelect.value].forEach(prodi => {
                prodiSelect.add(new Option(prodi, prodi));
            });
        }
    });
</script>
@endsection
