<aside class="w-64 bg-white p-6 flex-col hidden md:flex shadow-lg">
    <div class="text-center mb-12">
        <a href="#" class="text-2xl font-extrabold tracking-wider text-indigo-600">STOCKIFY</a>
    </div>

    <nav class="flex flex-col space-y-3">
        @php
            $currentRoute = request()->route()->getName();
        @endphp

        @if(Auth::check() && Auth::user()->role == 'admin')
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg transition-colors {{ $currentRoute == 'admin.dashboard' ? 'active' : 'hover:bg-gray-100' }}">
                <i data-feather="home" class="w-5 h-5"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.barang.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg transition-colors {{ $currentRoute == 'admin.barang.index' ? 'active' : 'hover:bg-gray-100' }}">
                <i data-feather="archive" class="w-5 h-5"></i>
                <span>Manajemen Barang</span>
            </a>
            <a href="{{ route('admin.peminjaman') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg transition-colors {{ $currentRoute == 'admin.peminjaman' ? 'active' : 'hover:bg-gray-100' }}">
                <i data-feather="git-pull-request" class="w-5 h-5"></i>
                <span>Manajemen Peminjaman</span>
            </a>
            <a href="{{ route('admin.riwayat') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg transition-colors {{ $currentRoute == 'admin.riwayat' ? 'active' : 'hover:bg-gray-100' }}">
                <i data-feather="clock" class="w-5 h-5"></i>
                <span>Riwayat</span>
            </a>
        @endif

        @if(Auth::check() && Auth::user()->role == 'peminjam')
            <a href="{{ route('peminjam.dashboard') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg transition-colors {{ $currentRoute == 'peminjam.dashboard' ? 'active' : 'hover:bg-gray-100' }}">
                <i data-feather="home" class="w-5 h-5"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('peminjam.barang') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg transition-colors {{ $currentRoute == 'peminjam.barang' ? 'active' : 'hover:bg-gray-100' }}">
                <i data-feather="shopping-bag" class="w-5 h-5"></i>
                <span>Pinjam Barang</span>
            </a>
            <a href="{{ route('peminjam.riwayat') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg transition-colors {{ $currentRoute == 'peminjam.riwayat' ? 'active' : 'hover:bg-gray-100' }}">
                <i data-feather="clock" class="w-5 h-5"></i>
                <span>Riwayat Saya</span>
            </a>
        @endif
    </nav>

    <div class="flex-grow"></div>

    <div class="mt-auto space-y-2">
        <a href="{{ Auth::check() && Auth::user()->role == 'admin' ? route('admin.profil') : route('peminjam.profil') }}" class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg transition-colors {{ str_contains($currentRoute, 'profil') ? 'active' : 'hover:bg-gray-100' }}">
            <i data-feather="user" class="w-5 h-5"></i>
            <span>Profil Saya</span>
        </a>
        <a href="{{ route('logout') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-red-500 hover:bg-red-50 transition-colors">
            <i data-feather="log-out" class="w-5 h-5"></i>
            <span>Logout</span>
        </a>
    </div>
</aside>
