@extends('layouts.master')

@section('judul', 'Login ke Stockify')
@section('body-class', 'overflow-hidden')

@section('konten')
<div class="flex items-center justify-center min-h-screen w-full bg-gray-50">
    <div class="w-full max-w-md p-4">

        <div class="text-center mb-8">
            <h1 class="text-4xl font-extrabold tracking-wider text-indigo-600">STOCKIFY</h1>
        </div>

        <div class="ui-card">
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold">Login</h2>
                <p class="text-gray-500 text-sm">Selamat datang kembali!</p>
            </div>

            <form action="#" method="POST" class="space-y-5">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="email" name="email" class="ui-input" placeholder="contoh@email.com" value="admin@stockify.com" required>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" class="ui-input pr-10" placeholder="********" value="password123" required>
                        <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-400 hover:text-indigo-600">
                            <i id="icon-eye" data-feather="eye" class="w-5 h-5"></i>
                            <i id="icon-eye-off" data-feather="eye-off" class="w-5 h-5 hidden"></i>
                        </button>
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full ui-button ui-button-primary">
                        <i data-feather="log-in" class="w-5 h-5"></i>
                        <span>Login</span>
                    </button>
                </div>
            </form>

            <div class="text-center mt-6">
                <p class="text-sm text-gray-600">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="font-semibold text-indigo-600 hover:underline">
                        Daftar di sini
                    </a>
                </p>
            </div>
        </div>

        <div class="ui-card mt-6">
            <h3 class="text-center font-bold text-gray-600 mb-3 text-sm">Menu Navigasi Developer</h3>
            <div class="grid grid-cols-2 gap-2 text-center text-xs">
                <a href="{{ route('admin.dashboard') }}" class="bg-gray-100 p-2 rounded-md hover:bg-indigo-100">Admin</a>
                <a href="{{ route('peminjam.dashboard') }}" class="bg-gray-100 p-2 rounded-md hover:bg-indigo-100">Peminjam</a>
            </div>
        </div>

    </div>
</div>

<script>
    const passwordInput = document.getElementById('password');
    const togglePasswordButton = document.getElementById('togglePassword');
    const iconEye = document.getElementById('icon-eye');
    const iconEyeOff = document.getElementById('icon-eye-off');

    togglePasswordButton.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        iconEye.classList.toggle('hidden');
        iconEyeOff.classList.toggle('hidden');
        feather.replace();
    });
</script>
@endsection
