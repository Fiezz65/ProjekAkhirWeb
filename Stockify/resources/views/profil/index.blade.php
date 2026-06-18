@extends('layouts.master')

@section('judul', 'Profil Saya')
@section('body-class', 'bg-gray-50')
@section('main-class', 'p-4 sm:p-6 lg:p-8 overflow-hidden')

@section('konten')
<div class="flex flex-col h-full">
    <header class="mb-6 flex-shrink-0">
        <h1 class="text-4xl font-extrabold text-gray-800">Profil Saya</h1>
    </header>

    <div id="success-toast" class="hidden fixed top-5 right-5 bg-green-500 text-white p-3 rounded-lg shadow-lg">
        Foto profil berhasil diperbarui!
    </div>

    @if ($errors->any())
        <div class="p-4 mb-4 bg-red-100 text-red-800 rounded-xl text-sm border border-red-200 flex-shrink-0">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="flex-grow grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="ui-card p-6 flex flex-col items-center text-center">
            <form id="picture-form" class="relative">
                <img id="profile-preview" src="{{ $user->profile_picture_path ? asset('storage/' . $user->profile_picture_path) : 'https://ui-avatars.com/api/?name='.urlencode($user->nama).'&background=EBF4FF&color=7F9CF5' }}" alt="Foto Profil" class="w-32 h-32 rounded-full object-cover mb-4 ring-4 ring-blue-100 cursor-pointer hover:ring-blue-300 transition-all">
                <input type="file" id="profile_picture" name="profile_picture" class="hidden">
            </form>
            <h2 class="text-2xl font-bold text-gray-800">{{ $user->nama }}</h2>
            <p class="text-gray-500">{{ $user->email }}</p>
            <span class="mt-2 inline-block px-3 py-1 text-xs font-semibold rounded-full bg-indigo-100 text-indigo-800 capitalize">{{ $user->role }}</span>

            @if($user->role != 'admin')
            <hr class="my-6 w-full">
            <div class="space-y-4 text-sm w-full">
                <div class="flex justify-between items-center"><p class="text-gray-500 font-medium">NIM</p><p class="font-bold text-gray-700">{{ $user->nim }}</p></div>
                <div class="flex justify-between items-center"><p class="text-gray-500 font-medium">Fakultas</p><p class="font-semibold text-gray-700 text-right truncate">{{ $user->fakultas ?? '-' }}</p></div>
                <div class="flex justify-between items-center"><p class="text-gray-500 font-medium">Program Studi</p><p class="font-semibold text-gray-700 text-right truncate">{{ $user->program_studi ?? '-' }}</p></div>
            </div>
            @endif
        </div>

        <div class="ui-card p-6 flex flex-col">
            <h3 class="text-xl font-bold mb-4 text-gray-800 flex-shrink-0">Edit Informasi</h3>
            <form action="{{ route($user->role . '.profil.info') }}" method="POST" class="flex-grow flex flex-col">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    @if($user->role != 'admin')
                        <input type="hidden" name="nama" value="{{ $user->nama }}"><input type="hidden" name="fakultas" value="{{ $user->fakultas }}"><input type="hidden" name="program_studi" value="{{ $user->program_studi }}">
                        <div><label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label><input type="email" id="email" name="email" class="ui-input" value="{{ old('email', $user->email) }}" required></div>
                        <div><label for="no_telp" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label><input type="text" id="no_telp" name="no_telp" class="ui-input" value="{{ old('no_telp', $user->no_telp) }}"></div>
                        <div><label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label><input type="text" id="alamat" name="alamat" class="ui-input" value="{{ old('alamat', $user->alamat) }}"></div>
                    @else
                        <div><label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label><input type="text" id="nama" name="nama" class="ui-input" value="{{ old('nama', $user->nama) }}" required></div>
                        <div><label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label><input type="email" id="email" name="email" class="ui-input" value="{{ old('email', $user->email) }}" required></div>
                    @endif
                </div>
                <div class="mt-auto pt-6 text-right"><button type="submit" class="ui-button ui-button-primary"><i data-feather="save" class="w-5 h-5"></i><span>Simpan</span></button></div>
            </form>
        </div>

        <div class="ui-card p-6 flex flex-col">
            <h3 class="text-xl font-bold mb-4 text-gray-800 flex-shrink-0">Ubah Password</h3>
            <form action="{{ route($user->role . '.profil.password') }}" method="POST" class="flex-grow flex flex-col">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <div><label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Password Saat Ini</label><input type="password" id="current_password" name="current_password" class="ui-input" required></div>
                    <div><label for="new_password" class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label><input type="password" id="new_password" name="new_password" class="ui-input" required></div>
                    <div><label for="new_password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label><input type="password" id="new_password_confirmation" name="new_password_confirmation" class="ui-input" required></div>
                </div>
                <div class="mt-auto pt-6 text-right"><button type="submit" class="ui-button ui-button-outline">Ubah Password</button></div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const profilePreview = document.getElementById('profile-preview');
    const pictureInput = document.getElementById('profile_picture');

    profilePreview.addEventListener('click', function() {
        pictureInput.click();
    });

    pictureInput.addEventListener('change', function() {
        const formData = new FormData();
        formData.append('profile_picture', this.files[0]);
        formData.append('_token', '{{ csrf_token() }}');

        fetch('{{ route($user->role . ".profil.picture") }}', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                profilePreview.src = data.path;
                const toast = document.getElementById('success-toast');
                toast.classList.remove('hidden');
                setTimeout(() => {
                    toast.classList.add('hidden');
                }, 3000);
            } else {
                alert('Gagal mengunggah gambar. Pastikan format dan ukuran sesuai.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengunggah gambar.');
        });
    });
});
</script>
@endsection
