@extends('layouts.master')

@section('judul', 'Daftar Akun Baru')
@section('body-class', 'overflow-hidden')
@section('main-class', '')

@section('konten')
<div class="flex items-center justify-center min-h-screen w-full bg-gray-50">
    <div class="w-full max-w-lg p-4">

        <div class="text-center mb-4">
            <h1 class="text-3xl font-extrabold tracking-wider text-indigo-600">STOCKIFY</h1>
        </div>

        <div class="ui-card p-4">
            <div class="text-center mb-3">
                <h2 class="text-xl font-bold">Buat Akun Baru</h2>
            </div>

            @if ($errors->any())
                <div class="mb-3 p-3 bg-red-100 text-red-700 rounded-md text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('register.post') }}" method="POST" class="space-y-1">
                @csrf

                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" id="nama" name="nama" class="ui-input py-2 px-3 text-sm" placeholder="Masukkan nama lengkap" value="{{ old('nama') }}" required>
                </div>
                <div>
                    <label for="nim" class="block text-sm font-medium text-gray-700 mb-1">NIM</label>
                    <input type="text" id="nim" name="nim" class="ui-input py-2 px-3 text-sm" placeholder="Masukkan NIM" value="{{ old('nim') }}" required>
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="email" name="email" class="ui-input py-2 px-3 text-sm" placeholder="Masukkan alamat email" value="{{ old('email') }}" required>
                </div>
                <div>
                    <label for="no_telp" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                    <input type="text" id="no_telp" name="no_telp" class="ui-input py-2 px-3 text-sm" placeholder="Masukkan nomor telepon" value="{{ old('no_telp') }}">
                </div>
                <div class="relative">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" id="password" name="password" class="ui-input py-2 px-3 text-sm pr-10" placeholder="Minimal 8 karakter" required>
                    <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 top-6 flex items-center px-3 text-gray-400 hover:text-indigo-600 focus:outline-none">
                        <i id="icon-eye" data-feather="eye" class="w-5 h-5"></i>
                        <i id="icon-eye-off" data-feather="eye-off" class="w-5 h-5" style="display: none;"></i>
                    </button>
                </div>
                <div>
                    <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                    <input type="text" id="alamat" name="alamat" class="ui-input py-2 px-3 text-sm" placeholder="Masukkan alamat tinggal" value="{{ old('alamat') }}" required>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                    <div>
                        <label for="fakultas" class="block text-sm font-medium text-gray-700 mb-1">Fakultas</label>
                        <select id="fakultas" name="fakultas" class="ui-input py-2 px-3 text-sm" required>
                            <option value="">Pilih fakultas</option>
                        </select>
                    </div>
                    <div>
                        <label for="program_studi" class="block text-sm font-medium text-gray-700 mb-1">Program Studi</label>
                        <select id="program_studi" name="program_studi" class="ui-input py-2 px-3 text-sm" required disabled>
                            <option value="">Pilih program studi</option>
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

            <div class="text-center mt-2">
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
document.addEventListener('DOMContentLoaded', function () {
    const dataAkademik = {
        "Ilmu Komputer": ["Sistem Informasi", "Teknik Informatika", "Desain Komunikasi Visual"],
        "Teknik": ["Teknik Elektro", "Teknik Mesin", "Teknik Sipil"],
        "Ekonomi dan Bisnis": ["Manajemen", "Akuntansi", "Ekonomi Pembangunan"],
        "Ilmu Sosial dan Politik": ["Ilmu Komunikasi", "Hubungan Internasional", "Administrasi Publik"]
    };

    const fakultasSelect = document.getElementById('fakultas');
    const prodiSelect = document.getElementById('program_studi');
    const oldFakultas = "{!! old('fakultas') !!}";
    const oldProdi = "{!! old('program_studi') !!}";

    Object.keys(dataAkademik).forEach(fakultas => {
        fakultasSelect.add(new Option(fakultas, fakultas));
    });

    fakultasSelect.addEventListener('change', () => {
        const selectedFakultas = fakultasSelect.value;
        prodiSelect.innerHTML = '<option value="">Pilih program studi</option>';
        prodiSelect.disabled = true;

        if (selectedFakultas && dataAkademik[selectedFakultas]) {
            prodiSelect.disabled = false;
            dataAkademik[selectedFakultas].forEach(prodi => {
                prodiSelect.add(new Option(prodi, prodi));
            });
            if (selectedFakultas === oldFakultas && oldProdi) {
                prodiSelect.value = oldProdi;
            }
        }
    });

    if (oldFakultas) {
        fakultasSelect.value = oldFakultas;
        fakultasSelect.dispatchEvent(new Event('change'));
    }

    const passwordInput = document.getElementById('password');
    const togglePasswordButton = document.getElementById('togglePassword');
    const iconEye = document.getElementById('icon-eye');
    const iconEyeOff = document.getElementById('icon-eye-off');

    togglePasswordButton.addEventListener('click', function () {
        const isPassword = passwordInput.type === 'password';
        passwordInput.type = isPassword ? 'text' : 'password';

        if (isPassword) {
            iconEye.style.display = 'none';
            iconEyeOff.style.display = 'inline';
        } else {
            iconEye.style.display = 'inline';
            iconEyeOff.style.display = 'none';
        }
    });
});
</script>
@endsection
