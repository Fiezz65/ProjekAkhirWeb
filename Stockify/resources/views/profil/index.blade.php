@extends('layouts.master')

@section('judul', 'Profil Saya')

@section('konten')
<div class="flex flex-col gap-6 h-full">
    <div class="mb-2">
        <h1 class="text-3xl font-extrabold">Profil Saya</h1>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">{{ session('error') }}</div>
    @endif
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="ui-card">
        <div class="flex flex-col sm:flex-row items-center gap-6">
            <div class="w-24 h-24 rounded-full bg-gray-200 flex-shrink-0 flex items-center justify-center">
                <i data-feather="user" class="w-12 h-12 text-gray-500"></i>
            </div>
            <div class="flex-grow text-center sm:text-left">
                <h2 class="text-2xl font-bold">
                    {{ $user->nama }}
                </h2>
                <p class="text-gray-500">
                    {{ $user->email }}
                </p>
                <span class="mt-2 inline-block px-4 py-1 text-sm font-semibold rounded-full bg-indigo-100 text-indigo-800 capitalize">{{ $user->role }}</span>
            </div>
        </div>

        <hr class="my-5 border-gray-100">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
            <div>
                <p class="text-xs text-gray-500 uppercase font-semibold">Alamat</p>
                <p class="font-medium text-gray-700">{{ $user->alamat ?? '-' }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-500 uppercase font-semibold">Fakultas</p>
                <p class="font-medium text-gray-700">{{ $user->fakultas ?? '-' }}</p>
            </div>
            <div>
                <p class="text-xs text-gray-500 uppercase font-semibold">Program Studi</p>
                <p class="font-medium text-gray-700">{{ $user->program_studi ?? '-' }}</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 flex-grow">
        <div class="ui-card flex flex-col">
            <h3 class="text-xl font-bold mb-6">Edit Informasi</h3>
            <form action="{{ route($user->role . '.profil.info') }}" method="POST" class="space-y-4 flex-grow flex flex-col">
                @csrf
                @method('PUT')
                <div class="flex-grow space-y-4">
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" class="ui-input" placeholder="Masukkan nama lengkap Anda" value="{{ old('nama', $user->nama) }}" required>
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" id="email" name="email" class="ui-input" placeholder="Masukkan alamat email Anda" value="{{ old('email', $user->email) }}" required>
                    </div>
                    <div>
                        <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat (Opsional)</label>
                        <input type="text" id="alamat" name="alamat" class="ui-input" placeholder="Masukkan alamat domisili" value="{{ old('alamat', $user->alamat) }}">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="fakultas" class="block text-sm font-medium text-gray-700 mb-1">Fakultas (Opsional)</label>
                            <input type="text" id="fakultas" name="fakultas" class="ui-input" placeholder="Nama Fakultas" value="{{ old('fakultas', $user->fakultas) }}">
                        </div>
                        <div>
                            <label for="program_studi" class="block text-sm font-medium text-gray-700 mb-1">Prodi (Opsional)</label>
                            <input type="text" id="program_studi" name="program_studi" class="ui-input" placeholder="Nama Program Studi" value="{{ old('program_studi', $user->program_studi) }}">
                        </div>
                    </div>
                </div>
                <div class="pt-4 text-right">
                    <button type="submit" class="ui-button ui-button-primary">
                        <i data-feather="save" class="w-5 h-5"></i>
                        <span>Simpan Perubahan</span>
                    </button>
                </div>
            </form>
        </div>

        <div class="ui-card flex flex-col">
            <h3 class="text-xl font-bold mb-6">Ubah Password</h3>
            <form action="{{ route($user->role . '.profil.password') }}" method="POST" class="space-y-4 flex-grow flex flex-col">
                @csrf
                @method('PUT')
                <div class="flex-grow space-y-4">
                    <div>
                        <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Password Saat Ini</label>
                        <input type="password" id="current_password" name="current_password" class="ui-input" placeholder="Masukkan password Anda saat ini" required>
                    </div>
                    <div>
                        <label for="new_password" class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                        <input type="password" id="new_password" name="new_password" class="ui-input" placeholder="Masukkan password baru (min. 8 karakter)" required>
                    </div>
                    <div>
                        <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password Baru</label>
                        <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="ui-input" placeholder="Ketik ulang password baru" required>
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
